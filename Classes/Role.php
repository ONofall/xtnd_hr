<?php
include_once('Connection.php');
class Roles
{
   use DatabaseConnection;

    public function getRoles()
    {
        $conn = $this->getConnection();
        $sqlr = "SELECT * FROM role ";
        $resultr = mysqli_query($conn, $sqlr);

        return mysqli_fetch_all($resultr, MYSQLI_ASSOC);
    }
}

?>