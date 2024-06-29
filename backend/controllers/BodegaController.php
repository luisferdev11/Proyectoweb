<?php

require_once __DIR__ . '/../config/Database.php';

class BodegaController {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getBodegas(): array {
        $query = 'SELECT id_bodega, Ubicacion FROM Bodega';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
