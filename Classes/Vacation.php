<?php

class Vacation extends BaseModel
{
    public function updateStatus(array $data)
    {
        $conn = $this->getConnection();
        foreach ($data as $update) {
            $id = mysqli_real_escape_string($conn, $update['update_id']);
            $new_status = ($update['update'] == 'Accept') ? 'Accept' : 'Reject';

            $sql_status = "UPDATE {$this->getTable()} SET status = '$new_status' WHERE id = $id";

            if (!mysqli_query($conn, $sql_status)) {
                return false;
            }
        }
        return true;
    }



    public function read()
    {
        $conn = $this->getConnection();
        $sql = "SELECT users.*, vacations.from, vacations.to, vacations.status , vacations.id AS vacation_id FROM users INNER JOIN vacations ON vacations.user_id = users.id";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
