<?php

class BaseModel
{
    use DatabaseConnection;

    protected $table;

    public function all()
    {
        $conn = $this->getConnection();
        $sql = "SELECT * FROM {$this->table}";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function insert(array $data)
    {
        $conn = $this->getConnection();
        $columns = [];
        $values = [];

        foreach ($data as $key => $value) {
            $columns[] = "`" . $key . "`"; // Escaping column names with backticks
            $values[] = "'" . mysqli_real_escape_string($conn, $value) . "'";
        }

        $columnsStr = implode(', ', $columns);
        $valuesStr = implode(', ', $values);

        $sql = "INSERT INTO `{$this->table}` ($columnsStr) VALUES ($valuesStr)";
        if (mysqli_query($conn, $sql)) {

            return true;
        }
        return false;
    }
    public function delete($delete_id) {
        $conn = $this->getConnection();
        $delete_id = mysqli_real_escape_string($conn, $delete_id);
        $sql = "DELETE FROM `{$this->table}` WHERE id = $delete_id";

        if (mysqli_query($conn, $sql)) {
            return true;
        }

        return false;
    }
    public function update($id, array $data)
    {
        $conn = $this->getConnection();
        $id = mysqli_real_escape_string($conn, $id);
        $sqlAr = [];
        foreach ($data as $key => $value) {
            $value = mysqli_real_escape_string($conn, $value);
            $sqlAr[] = "$key = '$value'";
        }
        $sql = "UPDATE {$this->table} SET " . implode(', ', $sqlAr) . " WHERE id = '$id'";
        if (mysqli_query($conn, $sql)) {
            return true;
        }
        return false;
    }
}
