<?php

class Vacation
{
    use DatabaseConnection;

    protected $table = 'vacation';


    public function updateStatus()
    {
        $conn = $this->getConnection();
        $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
        $new_status = ($_POST['update'] == 'Accept') ? 'Accept' : 'Reject';

        $sql_status = "UPDATE {$this->table} SET status = '$new_status' WHERE id = $update_id";

        if (mysqli_query($conn, $sql_status)) {
            header('location: index.php');
        }

    }

    public function read()
    {
        $conn = $this->getConnection();
        $sql = "SELECT users.*, vacation.from, vacation.to, vacation.status , vacation.id AS vacation_id FROM users INNER JOIN vacation ON vacation.user_id = users.id";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
