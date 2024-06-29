<?php

class Disponibilidad {
    private PDO $conn;
    private string $table = 'Disponibilidad';

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function getDisponibilidad(int $id_empleado): array {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id_empleado = :id_empleado';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_empleado', $id_empleado);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addDisponibilidad(array $data): bool {
        $query = 'INSERT INTO ' . $this->table . ' (id_empleado, Fecha, HoraInicio, HoraFin) VALUES (:id_empleado, :Fecha, :HoraInicio, :HoraFin)';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_empleado', $data['id_empleado']);
        $stmt->bindParam(':Fecha', $data['Fecha']);
        $stmt->bindParam(':HoraInicio', $data['HoraInicio']);
        $stmt->bindParam(':HoraFin', $data['HoraFin']);

        return $stmt->execute();
    }
}
?>
