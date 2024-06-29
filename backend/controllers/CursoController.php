<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Curso.php';

class CursoController {
    private PDO $conn;
    private Curso $curso;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
        $this->curso = new Curso($this->conn);
    }

    public function getCursosPorEmpleado(int $numero_empleado): array {
        return $this->curso->getCursosPorEmpleado($numero_empleado);
    }

    public function agregarCurso(array $data): bool {
        return $this->curso->agregarCurso($data);
    }
}
?>
