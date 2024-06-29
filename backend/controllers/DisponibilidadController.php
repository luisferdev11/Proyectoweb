<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Disponibilidad.php';

class DisponibilidadController {
    private PDO $conn;
    private Disponibilidad $disponibilidad;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
        $this->disponibilidad = new Disponibilidad($this->conn);
    }

    public function getDisponibilidad(int $id_empleado): array {
        return $this->disponibilidad->getDisponibilidad($id_empleado);
    }

    public function addDisponibilidad(array $data): bool {
        return $this->disponibilidad->addDisponibilidad($data);
    }
}
?>
