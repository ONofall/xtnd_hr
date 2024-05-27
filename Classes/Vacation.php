<?php

class Vacation extends BaseModel
{
    public function updateStatus($data)
    {
        $conn = $this->getConnection();
        foreach ($data as $id => $new_status) {
            $new_status = mysqli_real_escape_string($conn, $new_status);

            $sql_status = "UPDATE {$this->getTable()} SET status = '$new_status' WHERE id = $id";

            if (mysqli_query($conn, $sql_status)) {
                return true;
            }
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
