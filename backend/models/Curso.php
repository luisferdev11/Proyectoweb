<?php

class Curso {
    private PDO $conn;
    private string $table = 'Cursos';

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function getCursosPorEmpleado(int $numero_empleado): array {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE NumeroEmpleado = :numero_empleado';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':numero_empleado', $numero_empleado);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarCurso(array $data): bool {
        $query = 'INSERT INTO ' . $this->table . ' (Nombre, Organizacion, NumeroEmpleado, FechaExpedicion, FechaExpiracion, Descripcion) 
                  VALUES (:Nombre, :Organizacion, :NumeroEmpleado, :FechaExpedicion, :FechaExpiracion, :Descripcion)';
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':Organizacion', $data['Organizacion']);
        $stmt->bindParam(':NumeroEmpleado', $data['NumeroEmpleado']);
        $stmt->bindParam(':FechaExpedicion', $data['FechaExpedicion']);
        $stmt->bindParam(':FechaExpiracion', $data['FechaExpiracion']);
        $stmt->bindParam(':Descripcion', $data['Descripcion']);

        return $stmt->execute();
    }
}
?>
