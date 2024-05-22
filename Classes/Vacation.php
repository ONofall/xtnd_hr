<?php

class vacation
{
    use DatabaseConnection;

    protected $table = 'vacation';

    public function addVacation($from, $to, $user_id)
    {
        $conn = $this->getConnection();
        $from = mysqli_escape_string($conn, $_POST['from']);
        $to = mysqli_escape_string($conn, $_POST['to']);
        $user_id = mysqli_escape_string($conn, $_POST['user_id']);


        $sql = "INSERT INTO {$this->table} ( `from`, `to`,`status`, `user_id`) VALUES ('$from', '$to','Pending', '$user_id');";

        if (mysqli_query($conn, $sql)) {

            header('location: index.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

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
}

class user_vacation
{
    use DatabaseConnection;

    public function vacation_inner()
    {
        $conn = $this->getConnection();
        $sql = "SELECT users.*, vacation.from, vacation.to, vacation.status , vacation.id AS vacation_id FROM users INNER JOIN vacation ON vacation.user_id = users.id";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

?>