<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Servicio.php';

class ServicioController {
    private PDO $conn;
    private Servicio $servicio;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
        $this->servicio = new Servicio($this->conn);
    }

    public function getServiciosPendientes(int $id_empleado): array {
        return $this->servicio->getServiciosPendientes($id_empleado);
    }

    public function actualizarServicio(int $id_servicio, string $observaciones): bool {
        return $this->servicio->actualizarServicio($id_servicio, $observaciones);
    }
}
?>
