<?php
session_start();

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Administrador.php';

class AdministradorController {
    private PDO $conn;
    private Administrador $administrador;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
        $this->administrador = new Administrador($this->conn);
    }

    // public function registerAdministrador(array $data): bool {
    //     $this->administrador->Nombre = $data['nombre'];
    //     $this->administrador->ApellidoMaterno = $data['apellido_materno'];
    //     $this->administrador->ApellidoPaterno = $data['apellido_paterno'];
    //     $this->administrador->FechaNacimiento = $data['fecha_nacimiento'];
    //     $this->administrador->Correo = $data['correo'];
    //     $this->administrador->Telefono = $data['telefono'];
    //     $this->administrador->Clave = password_hash($data['contrasena'], PASSWORD_DEFAULT);
    //     $this->administrador->NumeroEmpleado = $data['numeroempleado'];
    //     $this->administrador->Bodega = $data['bodega'];
    //     $this->administrador->Especializacion = $data['especializacion'];

    //     if ($this->administrador->register()) {
    //         session_start();
    //         $_SESSION['user_id'] = $this->administrador->id_persona;
    //         $_SESSION['user_name'] = $this->administrador->Nombre;
    //         return true;
    //     }

    //     return false;
    // }

    public function loginAdministrador(string $correo, string $contrasena): bool {
        $user = $this->administrador->login($correo, $contrasena);
        if ($user && isset($user['id_persona'], $user['nombre'], $user['id_empleado'], $user['id_bodega'])) {
            $_SESSION['user_id'] = $user['id_persona'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['Admin_id'] = $user['id_empleado'];
            $_SESSION['Bodega_id'] = $user['id_bodega'];
            $_SESSION['user_role'] = 'administrador';
            return true;
        }

        return false;
    }

    public function logoutAdministrador(): void {
        session_start();
        session_unset();
        session_destroy();
    }

    public function getHorasLaboradas(int $bodega): ?array {
        return $this->administrador->getHorasLaboradas($bodega);
    }

    public function getReportesServicio(int $bodega): ?array {
        return $this->administrador->getReportesServicio($bodega);
    }

    public function getSuministros(int $bodega): ?array {
        return $this->administrador->getSuministros($bodega);
    }

    public function getCostoServicio(int $bodega): ?array {
        return $this->administrador->getCostoServicio($bodega);
    }

    public function getTrabajadores(int $bodega): ?array {
        return $this->administrador->getTrabajadores($bodega);
    }

    public function getProfile(int $id): ?array {
        return $this->administrador->getProfile($id);
    }

    public function updateProfile(array $data): bool {
        return $this->administrador->update($data);
    }

    public function deleteProfile(int $id): bool {
        return $this->administrador->delete($id);
    }

    public function getHistorialServicios(int $id_administrador): ?array {
        return $this->administrador->getHistorialServicios($id_administrador);
    }

    public function makeSolicitud(array $data): bool {
        return $this->administrador->makeSolicitud($data);
    }

    public function cancelSolicitud(int $id): bool {
        return $this->administrador->cancelSolicitud($id);
    }

    public function getFactura(int $id): ?array {
        return $this->administrador->getFactura($id);
    }

    // public function getDirecciones(int $id_administrador): ?array {
    //     return $this->administrador->getDirecciones($id_administrador);
    // }
}
?>