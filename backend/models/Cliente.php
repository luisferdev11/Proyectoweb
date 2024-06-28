<?php

require_once __DIR__ . '/Persona.php';

class Cliente extends Persona {
    private string $table_cliente = 'Cliente';
    private string $table_direccion = 'Direccion';
    private string $table_peticion = 'Peticion';

    public function __construct(PDO $db) {
        parent::__construct($db);
    }

    public function register(): bool {
        if ($this->create()) {
            $query = 'INSERT INTO ' . $this->table_cliente . ' (id_persona) VALUES (:id_persona)';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_persona', $this->id_persona);

            if ($stmt->execute()) {
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
        $query = 'SELECT * FROM ' . $this->table . ' WHERE Correo = :correo';
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

    public function getHistorialPedidos(int $id_persona): ?array {
        $query = 'SELECT * FROM Pedidos WHERE id_cliente = :id_persona';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_persona', $id_persona);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function makeSolicitud(array $data): bool {
        $query = 'INSERT INTO ' . $this->table_peticion . ' 
                  (id_cliente, id_direccion, TipoServicio, Descripcion, InstruccionesExtra, FechaProgramada, HoraProgramada, FechaPeticion, Estado) 
                  VALUES (:id_cliente, :id_direccion, :TipoServicio, :Descripcion, :InstruccionesExtra, :FechaProgramada, :HoraProgramada, :FechaPeticion, :Estado)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cliente', $data['id_cliente']);
        $stmt->bindParam(':id_direccion', $data['id_direccion']);
        $stmt->bindParam(':TipoServicio', $data['TipoServicio']);
        $stmt->bindParam(':Descripcion', $data['Descripcion']);
        $stmt->bindParam(':InstruccionesExtra', $data['InstruccionesExtra']);
        $stmt->bindParam(':FechaProgramada', $data['FechaProgramada']);
        $stmt->bindParam(':HoraProgramada', $data['HoraProgramada']);
        $stmt->bindParam(':FechaPeticion', $data['FechaPeticion']);
        $stmt->bindParam(':Estado', $data['Estado']);

        return $stmt->execute();
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