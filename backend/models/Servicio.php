<?php

class Servicio {
    private PDO $conn;
    private string $table = 'Servicio';

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function getServiciosPendientes(int $id_empleado): array {
        $query = 'SELECT s.*, p.TipoServicio, p.Descripcion AS ServicioDescripcion, p.id_cliente, per.Nombre AS ClienteNombre, d.Direccion
                  FROM ' . $this->table . ' s
                  JOIN Peticion p ON s.id_peticion = p.id_peticion
                  JOIN Cliente c ON p.id_cliente = c.id_cliente
                  JOIN Persona per ON c.id_persona = per.id_persona
                  JOIN Direccion d ON p.id_direccion = d.id_direccion
                  WHERE s.id_empleado = :id_empleado AND s.Estado = \'Pendiente\'';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_empleado', $id_empleado);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function actualizarServicio(int $id_servicio, string $observaciones): bool {
        $query = 'UPDATE ' . $this->table . ' 
                  SET Observaciones = :observaciones, Estado = "Completado"
                  WHERE id_servicio = :id_servicio';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':observaciones', $observaciones);
        $stmt->bindParam(':id_servicio', $id_servicio);

        return $stmt->execute();
    }
}
?>
