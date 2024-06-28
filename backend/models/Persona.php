<?php

class Persona {
    protected PDO $conn;
    protected string $table = 'Persona';

    public int $id_persona;
    public string $Nombre;
    public string $ApellidoMaterno;
    public string $ApellidoPaterno;
    public string $FechaNacimiento;
    public string $Correo;
    public int $Telefono;
    public string $Clave;

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    protected function create(): bool {
        $query = 'INSERT INTO ' . $this->table . ' 
                  (Nombre, ApellidoMaterno, ApellidoPaterno, FechaNacimiento, Correo, Telefono, Clave) 
                  VALUES (:Nombre, :ApellidoMaterno, :ApellidoPaterno, :FechaNacimiento, :Correo, :Telefono, :Clave)';

        $stmt = $this->conn->prepare($query);

        $this->Nombre = htmlspecialchars(strip_tags($this->Nombre));
        $this->ApellidoMaterno = htmlspecialchars(strip_tags($this->ApellidoMaterno));
        $this->ApellidoPaterno = htmlspecialchars(strip_tags($this->ApellidoPaterno));
        $this->FechaNacimiento = htmlspecialchars(strip_tags($this->FechaNacimiento));
        $this->Correo = htmlspecialchars(strip_tags($this->Correo));
        $this->Telefono = htmlspecialchars(strip_tags($this->Telefono));
        $this->Clave = htmlspecialchars(strip_tags($this->Clave));

        $stmt->bindParam(':Nombre', $this->Nombre);
        $stmt->bindParam(':ApellidoMaterno', $this->ApellidoMaterno);
        $stmt->bindParam(':ApellidoPaterno', $this->ApellidoPaterno);
        $stmt->bindParam(':FechaNacimiento', $this->FechaNacimiento);
        $stmt->bindParam(':Correo', $this->Correo);
        $stmt->bindParam(':Telefono', $this->Telefono);
        $stmt->bindParam(':Clave', $this->Clave);


        if ($stmt->execute()) {
            $this->id_persona = $this->conn->lastInsertId();
            return true;
        }

        printf("Error: %s.\n", $stmt->errorInfo()[2]);

        return false;
    }

    protected function getById(int $id): ?array {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id_persona = :id_persona';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_persona', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }
}

?>
