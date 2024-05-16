<?php
include_once('Connection.php');


class Jobs
{
    use DatabaseConnection;


    public function getJobs()
    {
        $conn = $this->getConnection();
        $sqlj = "SELECT * FROM jobs ";
        $resultj = mysqli_query($conn, $sqlj);
        return mysqli_fetch_all($resultj, MYSQLI_ASSOC);
    }
}


?>