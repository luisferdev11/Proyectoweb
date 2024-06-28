<?php

require_once __DIR__ . '/Persona.php';

class Cliente extends Persona {
    private string $table_cliente = 'Cliente';

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
                  WHERE c.id_cliente = :id_cliente';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cliente', $id, PDO::PARAM_INT);
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

        if ($user && password_verify($contrasena, $user['Clave'])) {
            return $user;
        }

        return null;
    }
}

?>
