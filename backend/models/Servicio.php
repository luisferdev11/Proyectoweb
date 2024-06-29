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

    public function getEmpleadoDisponible(): ?int {
        $query = 'SELECT id_empleado FROM Empleado ORDER BY RANDOM() LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ? $result['id_empleado'] : null;
    }

    public function asignarEmpleado(int $id_servicio, int $id_empleado): bool {
        $query = 'UPDATE ' . $this->table . ' SET id_empleado = :id_empleado WHERE id_servicio = :id_servicio';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_empleado', $id_empleado);
        $stmt->bindParam(':id_servicio', $id_servicio);
        
        return $stmt->execute();
    }

    public function agregarServicio(array $data): bool {
        $id_empleado = $this->getEmpleadoDisponible();
        if ($id_empleado === null) {
            throw new Exception("No hay empleados disponibles");
        }

        $query = 'INSERT INTO ' . $this->table . ' (id_peticion, id_empleado, TipoServicio, Horainicio, Horafin, Estado, Costo, Precio, Calificacion, Observaciones)
                  VALUES (:id_peticion, :id_empleado, :TipoServicio, :Horainicio, :Horafin, :Estado, :Costo, :Precio, :Calificacion, :Observaciones)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_peticion', $data['id_peticion']);
        $stmt->bindParam(':id_empleado', $id_empleado);
        $stmt->bindParam(':TipoServicio', $data['TipoServicio']);
        $stmt->bindParam(':Horainicio', $data['Horainicio']);
        $stmt->bindParam(':Horafin', $data['Horafin']);
        $stmt->bindParam(':Estado', $data['Estado']);
        $stmt->bindParam(':Costo', $data['Costo']);
        $stmt->bindParam(':Precio', $data['Precio']);
        $stmt->bindParam(':Calificacion', $data['Calificacion']);
        $stmt->bindParam(':Observaciones', $data['Observaciones']);

        return $stmt->execute();
    }

    public function getServiciosPorEmpleado($id_empleado) {
        $query = 'SELECT s.*, p.descripcion, p.instruccionesextra, p.fechaprogramada, p.horaprogramada
                  FROM ' . $this->table . ' s
                  JOIN Peticion p ON s.id_peticion = p.id_peticion
                  WHERE s.id_empleado = :id_empleado';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_empleado', $id_empleado);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function marcarComoCompletado($id_servicio) {
        $query = 'UPDATE ' . $this->table . ' 
                  SET estado = \'Completado\', horafin = NOW()
                  WHERE id_servicio = :id_servicio';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_servicio', $id_servicio);
    
        return $stmt->execute();
    }
    
    public function agregarObservaciones($id_servicio, $observaciones) {
        $query = 'UPDATE ' . $this->table . ' 
                  SET observaciones = :observaciones, estado = :estado
                  WHERE id_servicio = :id_servicio';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':observaciones', $observaciones);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id_servicio', $id_servicio);

        return $stmt->execute();
    }
}
?>
