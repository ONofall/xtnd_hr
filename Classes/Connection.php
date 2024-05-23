<?php

trait DatabaseConnection
{
    private $conn;

    public function connect()
    {
        $this->conn = new \mysqli('localhost', 'root', 'root', 'xtnd_hr');
    }

    /**
     *
     * @return mixed
     */
    public function getConnection()
    {
        if (!$this->conn) {
            $this->connect();
        }

        return $this->conn;
    }
}

