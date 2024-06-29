<?php

require_once __DIR__ . '/Persona.php';

class Empleado extends Persona {
    public int $id_bodega;
    public string $NumeroEmpleado;
    public string $Especializacion;

    private string $table_empleado = 'Empleado';

    public function __construct(PDO $db) {
        parent::__construct($db);
    }

    public function register(): bool {
        if ($this->create()) {
            $query = 'INSERT INTO ' . $this->table_empleado . ' (id_persona, id_bodega, NumeroEmpleado, Especializacion) VALUES (:id_persona, :id_bodega, :NumeroEmpleado, :Especializacion)';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_persona', $this->id_persona);
            $stmt->bindParam(':id_bodega', $this->id_bodega);
            $stmt->bindParam(':NumeroEmpleado', $this->NumeroEmpleado);
            $stmt->bindParam(':Especializacion', $this->Especializacion);

            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->errorInfo()[2]);
        }

        return false;
    }

    public function login(string $correo, string $contrasena): ?array {
        $query = 'SELECT p.*, e.* FROM ' . $this->table . ' p 
                  JOIN ' . $this->table_empleado . ' e ON p.id_persona = e.id_persona 
                  WHERE p.Correo = :correo';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($contrasena, $user['clave'])) {
            return $user;
        }

        return null;
    }
}
?>