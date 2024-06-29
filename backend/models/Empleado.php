<?php

require_once __DIR__ . '/Persona.php';

class Empleado extends Persona {
    private string $table_empleado = 'Empleado';
    private string $table_servicio = 'Servicio';
    private string $table_peticion = 'Peticion';

    public int $id_bodega;
    public int $id_empleado;
    public string $NumeroEmpleado;
    public string $Especializacion;

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
                $this->id_empleado = $this->conn->lastInsertId();
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

    public function getServiciosAsignados(int $id_empleado): array {
        $query = 'SELECT s.*, p.TipoServicio, p.Descripcion, p.InstruccionesExtra, p.FechaProgramada, p.HoraProgramada 
                  FROM ' . $this->table_servicio . ' s
                  JOIN ' . $this->table_peticion . ' p ON s.id_peticion = p.id_peticion
                  WHERE s.id_empleado = :id_empleado';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_empleado', $id_empleado);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProfile(int $id_persona): ?array {
        $query = 'SELECT p.*, e.id_bodega, e.NumeroEmpleado, e.Especializacion FROM ' . $this->table . ' p 
                  JOIN ' . $this->table_empleado . ' e ON p.id_persona = e.id_persona 
                  WHERE p.id_persona = :id_persona';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_persona', $id_persona);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(array $data): bool {
        $query = 'UPDATE ' . $this->table . ' 
                  SET Nombre = :Nombre, ApellidoMaterno = :ApellidoMaterno, ApellidoPaterno = :ApellidoPaterno, 
                      Correo = :Correo, Telefono = :Telefono 
                  WHERE id_persona = :id_persona';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':ApellidoMaterno', $data['ApellidoMaterno']);
        $stmt->bindParam(':ApellidoPaterno', $data['ApellidoPaterno']);
        $stmt->bindParam(':Correo', $data['Correo']);
        $stmt->bindParam(':Telefono', $data['Telefono']);
        $stmt->bindParam(':id_persona', $data['id_persona']);

        return $stmt->execute();
    }
}
?>
