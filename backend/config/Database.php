<?php

class Database {
    private string $host = 'dpg-cpubo3hu0jms7389el6g-a.oregon-postgres.render.com';
    private string $db_name = 'proyectoweb_sxwb';
    private string $username = 'friopana777';
    private string $password = 'btZ5TG9erWirugZKLXBm60hy7fO27uBm';
    private ?PDO $conn = null;

    public function connect(): ?PDO {
        $this->conn = null;

        try {
            $this->conn = new PDO('pgsql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}

?>
