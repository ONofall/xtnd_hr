<?php

class Vacation extends BaseModel
{
    protected $table = 'vacations';

    public function updateStatus()
    {
        $conn = $this->getConnection();
        $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
        $new_status = ($_POST['update'] == 'Accept') ? 'Accept' : 'Reject';

        $sql_status = "UPDATE {$this->table} SET status = '$new_status' WHERE id = $update_id";

        if (mysqli_query($conn, $sql_status)) {
            return true;
        }
        return false;

    }

    public function read()
    {
        $conn = $this->getConnection();
        $sql = "SELECT users.*, vacations.from, vacations.to, vacations.status , vacations.id AS vacation_id FROM users INNER JOIN vacations ON vacations.user_id = users.id";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
