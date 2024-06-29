<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Empleado.php';

class EmpleadoController {
    private PDO $conn;
    private Empleado $empleado;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
        $this->empleado = new Empleado($this->conn);
    }

    public function registerEmpleado(array $data): bool {
        $this->empleado->Nombre = $data['nombre'];
        $this->empleado->ApellidoMaterno = $data['apellido_materno'];
        $this->empleado->ApellidoPaterno = $data['apellido_paterno'];
        $this->empleado->FechaNacimiento = $data['fecha_nacimiento'];
        $this->empleado->Correo = $data['correo'];
        $this->empleado->Telefono = $data['telefono'];
        $this->empleado->Clave = password_hash($data['contrasena'], PASSWORD_DEFAULT);
        $this->empleado->id_bodega = $data['id_bodega'];
        $this->empleado->NumeroEmpleado = $data['numero_empleado'];
        $this->empleado->Especializacion = $data['especializacion'];

        if ($this->empleado->register()) {
            session_start();
            $_SESSION['user_id'] = $this->empleado->id_persona;
            $_SESSION['user_name'] = $this->empleado->Nombre;
            $_SESSION['worker_id'] = $this->empleado->id_empleado;
            $_SESSION['user_role'] = 'cliente';
            return true;
        }

        return false;
    }

    public function loginEmpleado(string $correo, string $contrasena): bool {
        $user = $this->empleado->login($correo, $contrasena);

        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id_persona'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['worker_id'] = $user['id_empleado'];
            $_SESSION['user_role'] = 'empleado';
            return true;
        }

        return false;
    }

    public function getProfile(int $id): ?array {
        return $this->empleado->getProfile($id);
    }

    public function updateProfile(array $data): bool {
        return $this->empleado->update($data);
    }

    // public function deleteProfile(int $id): bool {
    //     return $this->empleado->delete($id);
    // }

    public function getServiciosAsignados(int $id_empleado): array {
        return $this->empleado->getServiciosAsignados($id_empleado);
    }

    public function logoutEmpeleado(): void {
        session_start();
        session_unset();
        session_destroy();
    }
}
?>
