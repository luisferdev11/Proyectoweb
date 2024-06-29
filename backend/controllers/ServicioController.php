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


    public function asignarEmpleadoExistente(): bool {
        $query = 'SELECT id_servicio FROM Servicio WHERE id_empleado IS NULL';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($servicios as $servicio) {
            $id_empleado = $this->servicio->getEmpleadoDisponible();
            if ($id_empleado !== null) {
                $this->servicio->asignarEmpleado($servicio['id_servicio'], $id_empleado);
            }
        }

        return true;
    }

    public function getServiciosAsignados($id_empleado) {
        return $this->servicio->getServiciosPorEmpleado($id_empleado);
    }

    public function completarServicio($id_servicio) {
        return $this->servicio->marcarComoCompletado($id_servicio);
    }

    public function generarReporte($id_servicio, $observaciones) {
        return $this->servicio->agregarObservaciones($id_servicio, $observaciones);
    }
}
?>
