<?php

require_once __DIR__ . '/Persona.php';
require_once __DIR__ . '/Servicio.php';

class Cliente extends Persona {
    private string $table_cliente = 'Cliente';
    private string $table_direccion = 'Direccion';
    private string $table_peticion = 'Peticion';
    private string $table_metodo_pago = 'MetodoPago';
    private string $table_peticion_metodo_pago = 'PeticionMetodoPago';
    private string $table_servicio = 'Servicio';
    private string $table_empleado = 'Empleado';
    public int $id_cliente;
    public Servicio $servicio;

    public function __construct(PDO $db) {
        parent::__construct($db);
        $this->servicio = new Servicio($db);
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

    

    public function getHistorial(int $id_persona): ?array {
        $query = 'SELECT hp.id_peticion, hp.fechapeticion, hp.tiposervicio, hp.descripcion, hp.instruccionesextra,
                         hp.estado, hp.fechaprogramada, hp.horaprogramada
                  FROM ' . $this->table_cliente . ' c
                  JOIN ' . $this->table_peticion . ' p ON c.id_cliente = p.id_cliente
                  JOIN historialpeticion hp ON p.id_peticion = hp.id_peticion
                  WHERE c.id_persona = :id_persona
                  ORDER BY hp.fechapeticion DESC';
    
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_persona', $id_persona, PDO::PARAM_INT);
            $stmt->execute();
            
            $historial = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $historial ?: null;
        } catch (PDOException $e) {
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null; 
        }
    }
    
    
    
    public function getHistorialServicios(int $id_persona): ?array {
        return $this->getHistorial($id_persona);
    }



    public function makeSolicitud(array $data): bool {
        try {
            $this->conn->beginTransaction();
    
            $queryCheckExists = 'SELECT COUNT(*) FROM MetodoPago WHERE NumeroTarjeta = :NumeroTarjeta';
            $stmtCheckExists = $this->conn->prepare($queryCheckExists);
            $stmtCheckExists->bindParam(':NumeroTarjeta', $data['NumeroTarjeta']);
            $stmtCheckExists->execute();
            $count = $stmtCheckExists->fetchColumn();
    
            if ($count > 0) {
                echo "La tarjeta con número " . $data['NumeroTarjeta'] . " ya está registrada.";
                $this->conn->rollBack(); 
                return false; 
            }
    
            $queryDireccion = 'INSERT INTO Direccion (id_cliente, Direccion) VALUES (:id_cliente, :Direccion)';
            $stmtDireccion = $this->conn->prepare($queryDireccion);
            $stmtDireccion->bindParam(':id_cliente', $data['id_cliente']);
            $stmtDireccion->bindParam(':Direccion', $data['Direccion']);
            $stmtDireccion->execute();
            $id_direccion = $this->conn->lastInsertId();
    
            $queryMetodoPago = 'INSERT INTO MetodoPago (NumeroTarjeta, NombreTitular, FechaExpiracion, CVV) 
                                VALUES (:NumeroTarjeta, :NombreTitular, :FechaExpiracion, :CVV)';
            $stmtMetodoPago = $this->conn->prepare($queryMetodoPago);
            $stmtMetodoPago->bindParam(':NumeroTarjeta', $data['NumeroTarjeta']);
            $stmtMetodoPago->bindParam(':NombreTitular', $data['NombreTitular']);
            $stmtMetodoPago->bindParam(':FechaExpiracion', $data['FechaExpiracion']);
            $stmtMetodoPago->bindParam(':CVV', $data['CVV']);
            $stmtMetodoPago->execute();
            $id_metodo_pago = $this->conn->lastInsertId();
    
            $queryPeticion = 'INSERT INTO Peticion (id_cliente, id_direccion, TipoServicio, Descripcion, InstruccionesExtra, FechaProgramada, HoraProgramada, FechaPeticion, Estado) 
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
    
            $queryPeticionMetodoPago = 'INSERT INTO PeticionMetodoPago (id_peticion, numerotarjeta, Estado) 
                                        VALUES (:id_peticion, :numerotarjeta, :Estado)';
            $stmtPeticionMetodoPago = $this->conn->prepare($queryPeticionMetodoPago);
            $stmtPeticionMetodoPago->bindParam(':id_peticion', $id_peticion);
            $stmtPeticionMetodoPago->bindParam(':numerotarjeta', $data['NumeroTarjeta']); // Asegúrate de pasar el número de tarjeta correcto aquí
            $stmtPeticionMetodoPago->bindParam(':Estado', $data['Estado']);
            $stmtPeticionMetodoPago->execute();
    
            $queryHistorialPeticion = 'INSERT INTO historialpeticion (id_peticion, id_cliente, id_direccion, TipoServicio, Descripcion, InstruccionesExtra, FechaProgramada, HoraProgramada, FechaPeticion, Estado) 
            VALUES (:id_peticion, :id_cliente, :id_direccion, :TipoServicio, :Descripcion, :InstruccionesExtra, :FechaProgramada, :HoraProgramada, :FechaPeticion, :Estado)';
            $stmtHistorialPeticion = $this->conn->prepare($queryHistorialPeticion);
            $stmtHistorialPeticion->bindParam(':id_peticion', $id_peticion);
            $stmtHistorialPeticion->bindParam(':id_cliente', $data['id_cliente']);
            $stmtHistorialPeticion->bindParam(':id_direccion', $id_direccion);
            $stmtHistorialPeticion->bindParam(':TipoServicio', $data['TipoServicio']);
            $stmtHistorialPeticion->bindParam(':Descripcion', $data['Descripcion']);
            $stmtHistorialPeticion->bindParam(':InstruccionesExtra', $data['InstruccionesExtra']);
            $stmtHistorialPeticion->bindParam(':FechaProgramada', $data['FechaProgramada']);
            $stmtHistorialPeticion->bindParam(':HoraProgramada', $data['HoraProgramada']);
            $stmtHistorialPeticion->bindParam(':FechaPeticion', $data['FechaPeticion']);
            $stmtHistorialPeticion->bindParam(':Estado', $data['Estado']);
            $stmtHistorialPeticion->execute();
            $id_historial_peticion = $this->conn->lastInsertId();
                
            $this->conn->commit();

            $id_empleado = $this->servicio->getEmpleadoDisponible();
            if ($id_empleado !== null) {
                $queryServicio = 'INSERT INTO ' . $this->table_servicio . ' (id_empleado, id_peticion, TipoServicio, Estado, Costo, Precio) 
                                  VALUES (:id_empleado, :id_peticion, :TipoServicio, :Estado, :Costo, :Precio)';
                $stmtServicio = $this->conn->prepare($queryServicio);
                $stmtServicio->bindParam(':id_empleado', $id_empleado);
                $stmtServicio->bindParam(':id_peticion', $id_peticion);
                $stmtServicio->bindParam(':TipoServicio', $data['TipoServicio']);
                $stmtServicio->bindParam(':Estado', $data['Estado']);
                $stmtServicio->bindParam(':Costo', $data['Costo']);
                $stmtServicio->bindParam(':Precio', $data['Precio']);
                $stmtServicio->execute();
            }
    
            return true;
        } catch (PDOException $e) {
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

    public function getFactura(int $id_persona): ?array {
        $query = 'SELECT hs.id_servicio, e.id_persona as id_empleado, p.Nombre as nombre_empleado, p.ApellidoPaterno, p.ApellidoMaterno,
                         hp.tiposervicio, hp.descripcion,hp.estado,
                         hs.horainicio, hs.horafin, hs.costo, hs.precio, hs.calificacion, hs.observaciones
                  FROM ' . $this->table_cliente . ' c
                  JOIN ' . $this->table_peticion . ' ptn ON c.id_cliente = ptn.id_cliente
                  JOIN historialservicio hs ON ptn.id_peticion = hs.id_peticion
                  JOIN ' . $this->table_empleado . ' e ON hs.id_empleado = e.id_empleado
                  JOIN ' . $this->table . ' p ON e.id_persona = p.id_persona
                  JOIN historialpeticion hp ON ptn.id_peticion = hp.id_peticion
                  WHERE c.id_persona = :id_persona
                  ORDER BY hs.id_servicio DESC';
    
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_persona', $id_persona, PDO::PARAM_INT);
            $stmt->execute();
    
            $historial = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $historial ?: null;
        } catch (PDOException $e) {
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null; 
        }
    }

    public function getDirecciones(int $id_cliente): ?array {
        $query = 'SELECT * FROM ' . $this->table_direccion . ' WHERE id_cliente = :id_cliente';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calificar(array $data): bool {
        try {
            // Obtener id_cliente desde historialpeticion
            $query = 'SELECT id_cliente FROM historialpeticion WHERE id_peticion = :id_peticion';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_peticion', $data['id_peticion']);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return false; // Si no se encontró id_cliente, retornar falso
            }

            $id_cliente = $result['id_cliente'];

            // Actualizar calificación en historialservicio
            $query_update = 'UPDATE historialservicio 
                             SET calificacion = :calificacion,
                                 observaciones = :observaciones
                             WHERE id_peticion = :id_peticion';
            $stmt_update = $this->conn->prepare($query_update);
            $stmt_update->bindParam(':calificacion', $data['calificacion']);
            $stmt_update->bindParam(':observaciones', $data['observaciones']);
            $stmt_update->bindParam(':id_peticion', $data['id_peticion']);
            
            return $stmt_update->execute();
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

?>