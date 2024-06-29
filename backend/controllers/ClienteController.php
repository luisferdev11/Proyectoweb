<?php
session_start();

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Cliente.php';

class ClienteController {
    private PDO $conn;
    private Cliente $cliente;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
        $this->cliente = new Cliente($this->conn);
    }

    public function registerCliente(array $data): bool {
        $this->cliente->Nombre = $data['nombre'];
        $this->cliente->ApellidoMaterno = $data['apellido_materno'];
        $this->cliente->ApellidoPaterno = $data['apellido_paterno'];
        $this->cliente->FechaNacimiento = $data['fecha_nacimiento'];
        $this->cliente->Correo = $data['correo'];
        $this->cliente->Telefono = $data['telefono'];
        $this->cliente->Clave = password_hash($data['contrasena'], PASSWORD_DEFAULT);

        if ($this->cliente->register()) {
            session_start();
            $_SESSION['user_id'] = $this->cliente->id_persona;
            $_SESSION['user_name'] = $this->cliente->Nombre;
            // $_SESSION['client_id'] = $this->cliente->id_cliente;
            return true;
        }

        return false;
    }

    public function loginCliente(string $correo, string $contrasena): bool {
        $user = $this->cliente->login($correo, $contrasena);

        if ($user) {
            
            $_SESSION['user_id'] = $user['id_persona'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['client_id'] = $user['id_cliente'];
            return true;
        }

        return false;
    }

    public function logoutCliente(): void {
        session_start();
        session_unset();
        session_destroy();
    }

    public function getProfile(int $id): ?array {
        return $this->cliente->getProfile($id);
    }

    public function updateProfile(array $data): bool {
    
        return $this->cliente->update($data);
    }

    public function deleteProfile(int $id): bool {
        return $this->cliente->delete($id);
    }

    public function getHistorialServicios(int $id_cliente): ?array {
        return $this->cliente->getHistorialServicios($id_cliente);
    }
    

    public function makeSolicitud(array $data): bool {
        return $this->cliente->makeSolicitud($data);
    }

    public function cancelSolicitud(int $id): bool {
        return $this->cliente->cancelSolicitud($id);
    }

    public function getFactura(int $id): ?array {
        return $this->cliente->getFactura($id);
    }

    public function getDirecciones(int $id_cliente): ?array {
        return $this->cliente->getDirecciones($id_cliente);
    }
}

?>