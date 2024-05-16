<?php
trait DatabaseConnection {
    private $conn;

    public function connect() {
        $this->conn = new mysqli('localhost', 'root', 'root', 'xtnd_hr');

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        if (!$this->conn) {
            $this->connect();
        }
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}



?>
