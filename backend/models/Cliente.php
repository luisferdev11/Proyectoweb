<?php

require_once __DIR__ . '/Persona.php';

class Cliente extends Persona {
    private string $table_cliente = 'Cliente';
    private string $table_direccion = 'Direccion';
    private string $table_peticion = 'Peticion';
    private string $table_metodo_pago = 'MetodoPago';
    private string $table_peticion_metodo_pago = 'PeticionMetodoPago';
    private string $table_servicio = 'Servicio';
    private string $table_empleado = 'Empleado';
    public int $id_cliente;

    public function __construct(PDO $db) {
        parent::__construct($db);
    }

    public function register(): bool {
        if ($this->create()) {
            $query = 'INSERT INTO ' . $this->table_cliente . ' (id_persona) VALUES (:id_persona)';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_persona', $this->id_persona);

            if ($stmt->execute()) {
                $this->id_cliente = $this->conn->lastInsertId();
                return true;
            }

            printf("Error: %s.\n", $stmt->errorInfo()[2]);
        }

        return false;
    }

    public function getById(int $id): ?array {
        $query = 'SELECT c.*, p.* FROM ' . $this->table_cliente . ' c 
                  JOIN ' . $this->table . ' p ON c.id_persona = p.id_persona 
                  WHERE c.id_persona = :id_persona';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_persona', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }

    public function login(string $correo, string $contrasena): ?array {
        // $query = 'SELECT * FROM ' . $this->table . ' WHERE Correo = :correo';
        $query = 'SELECT c.id_cliente, p.* FROM ' . $this->table_cliente . ' c 
                  JOIN ' . $this->table . ' p ON c.id_persona = p.id_persona 
                  WHERE p.correo = :correo';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $hash = $user['clave'];
            if (password_verify($contrasena, $hash)) {
                return $user;
            } else {
                error_log("Contraseña incorrecta para el usuario: " . $correo);
            }
        } else {
            error_log("Usuario no encontrado: " . $correo);
        }
    
        return null;
    }


    public function update(array $data): bool {
        $query = 'UPDATE ' . $this->table . ' 
                  SET Nombre = :Nombre, ApellidoMaterno = :ApellidoMaterno, ApellidoPaterno = :ApellidoPaterno, 
                      FechaNacimiento = :FechaNacimiento, Correo = :Correo, Telefono = :Telefono 
                  WHERE id_persona = :id_persona';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':ApellidoMaterno', $data['ApellidoMaterno']);
        $stmt->bindParam(':ApellidoPaterno', $data['ApellidoPaterno']);
        $stmt->bindParam(':FechaNacimiento', $data['FechaNacimiento']);
        $stmt->bindParam(':Correo', $data['Correo']);
        $stmt->bindParam(':Telefono', $data['Telefono']);
        $stmt->bindParam(':id_persona', $data['id_persona']);

        return $stmt->execute();
    }

    public function delete(int $id_persona): bool {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id_persona = :id_persona';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_persona', $id_persona);

        return $stmt->execute();
    }

    public function getProfile(int $id_persona): ?array {
        return $this->getById($id_persona);
    }

    public function getHistorialServicios(int $id_cliente): ?array {
        $query = 'SELECT p.id_peticion, p.FechaPeticion, p.TipoServicio, p.Descripcion, p.InstruccionesExtra, p.Estado, p.FechaProgramada, p.HoraProgramada,
                         e.Nombre AS PlomeroNombre, e.ApellidoPaterno AS PlomeroApellido, d.Direccion,
                         s.id_servicio, s.Costo, s.Calificacion, s.Estado AS ServicioEstado
                  FROM ' . $this->table_peticion . ' p
                  LEFT JOIN ' . $this->table_servicio . ' s ON p.id_peticion = s.id_peticion
                  LEFT JOIN ' . $this->table_empleado . ' e ON s.id_empleado = e.id_empleado
                  LEFT JOIN Direccion d ON p.id_direccion = d.id_direccion
                  WHERE p.id_cliente = :id_cliente
                  ORDER BY p.FechaPeticion DESC';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function makeSolicitud(array $data): bool {
        try {
            $this->conn->beginTransaction();

            
            // Insertar dirección
            $queryDireccion = 'INSERT INTO Direccion (id_cliente, Direccion) VALUES (:id_cliente, :Direccion)';
            $stmtDireccion = $this->conn->prepare($queryDireccion);
            $stmtDireccion->bindParam(':id_cliente', $data['id_cliente']);
            $stmtDireccion->bindParam(':Direccion', $data['Direccion']);
            $stmtDireccion->execute();
            $id_direccion = $this->conn->lastInsertId();

            // Insertar método de pago
            $queryMetodoPago = 'INSERT INTO ' . $this->table_metodo_pago . ' 
                                (NumeroTarjeta, NombreTitular, FechaExpiracion, CVV) 
                                VALUES (:NumeroTarjeta, :NombreTitular, :FechaExpiracion, :CVV)';
            $stmtMetodoPago = $this->conn->prepare($queryMetodoPago);
            $stmtMetodoPago->bindParam(':NumeroTarjeta', $data['NumeroTarjeta']);
            $stmtMetodoPago->bindParam(':NombreTitular', $data['NombreTitular']);
            $stmtMetodoPago->bindParam(':FechaExpiracion', $data['FechaExpiracion']);
            $stmtMetodoPago->bindParam(':CVV', $data['CVV']);
            $stmtMetodoPago->execute();

            // Insertar petición
            $queryPeticion = 'INSERT INTO ' . $this->table_peticion . ' 
                             (id_cliente, id_direccion, TipoServicio, Descripcion, InstruccionesExtra, FechaProgramada, HoraProgramada, FechaPeticion, Estado) 
                             VALUES (:id_cliente, :id_direccion, :TipoServicio, :Descripcion, :InstruccionesExtra, :FechaProgramada, :HoraProgramada, :FechaPeticion, :Estado)';
            $stmtPeticion = $this->conn->prepare($queryPeticion);
            $stmtPeticion->bindParam(':id_cliente', $data['id_cliente']);
            $stmtPeticion->bindParam(':id_direccion', $id_direccion);
            $stmtPeticion->bindParam(':TipoServicio', $data['TipoServicio']);
            $stmtPeticion->bindParam(':Descripcion', $data['Descripcion']);
            $stmtPeticion->bindParam(':InstruccionesExtra', $data['InstruccionesExtra']);
            $stmtPeticion->bindParam(':FechaProgramada', $data['FechaProgramada']);
            $stmtPeticion->bindParam(':HoraProgramada', $data['HoraProgramada']);
            $stmtPeticion->bindParam(':FechaPeticion', $data['FechaPeticion']);
            $stmtPeticion->bindParam(':Estado', $data['Estado']);
            $stmtPeticion->execute();
            $id_peticion = $this->conn->lastInsertId();

            // Insertar relación entre petición y método de pago
            $queryPeticionMetodoPago = 'INSERT INTO ' . $this->table_peticion_metodo_pago . ' 
                                       (id_peticion, NumeroTarjeta, Estado) 
                                       VALUES (:id_peticion, :NumeroTarjeta, :Estado)';
            $stmtPeticionMetodoPago = $this->conn->prepare($queryPeticionMetodoPago);
            $stmtPeticionMetodoPago->bindParam(':id_peticion', $id_peticion);
            $stmtPeticionMetodoPago->bindParam(':NumeroTarjeta', $data['NumeroTarjeta']);
            $stmtPeticionMetodoPago->bindParam(':Estado', $data['Estado']);
            $stmtPeticionMetodoPago->execute();

            $this->conn->commit();

            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo "Failed: " . $e->getMessage();
            return false;
        }
    }

    public function cancelSolicitud(int $id_peticion): bool {
        $query = 'DELETE FROM ' . $this->table_peticion . ' WHERE id_peticion = :id_peticion';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_peticion', $id_peticion);

        return $stmt->execute();
    }

    public function getFactura(int $id_factura): ?array {
        $query = 'SELECT * FROM Factura WHERE id_factura = :id_factura';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_factura', $id_factura);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDirecciones(int $id_cliente): ?array {
        $query = 'SELECT * FROM ' . $this->table_direccion . ' WHERE id_cliente = :id_cliente';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>