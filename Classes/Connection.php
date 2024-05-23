<?php

trait DatabaseConnection
{
    private $conn;
    private $hostname = 'localhost';
    private $username = 'root';
    private $password = 'root';
    private $database = 'xtnd_hr';
    public function connect()
    {
        $this->conn = new \mysqli($this->hostname, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        if (!$this->conn) {
            $this->connect();
        }

        return $this->conn;
    }
}
