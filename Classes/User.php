<?php
include_once('Connection.php');

class User
{

    use DatabaseConnection;

    protected $table = 'users';

    public function read()
    {
        $conn = $this->getConnection();
        $sqlu = "SELECT * FROM {$this->table} ";
        $resultu = mysqli_query($conn, $sqlu);
        return mysqli_fetch_all($resultu, MYSQLI_ASSOC);
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
        // Execute query
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
            return true;
        }
        return false;
    }

    public function add(array $data)
    {
        $conn = $this->getConnection();
        $columns = [];
        $values = [];
        
        foreach ($data as $key => $value) {
            $columns[] = $key;
            $values[] = "'" . mysqli_real_escape_string($conn, $value) . "'";
        }
        $columnsStr = implode(', ', $columns);
        $valuesStr = implode(', ', $values);

        // Insert query
        $sql = "INSERT INTO {$this->table} ($columnsStr) VALUES ($valuesStr)";
        // Execute query
        if (mysqli_query($conn, $sql)) {
            header('location:index.php');
        } else {
            echo "Error adding record: " . mysqli_error($conn);
        }
    }

    public function delete($delete_id)
    {
        $conn = $this->getConnection();

        $delete_id = mysqli_real_escape_string($conn, $delete_id);
        $sql_user = "DELETE FROM {$this->table} WHERE id = $delete_id";

        if (mysqli_query($conn, $sql_user)) {
            header('location:index.php');
            return true;
        } else {
            return false;
        }
    }

    public function read_user_job_role()
    {
        $conn = $this->getConnection();

        $sql = "SELECT {$this->table}.*, role.name as role_name , jobs.name as job_name , vacation.from , vacation.to FROM {$this->table}  JOIN jobs ON {$this->table}.job_id = jobs.id INNER JOIN role ON {$this->table}.role_id = role.id left JOIN vacation ON vacation.user_id = {$this->table}.id;
";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);

    }

    public function getUserById($id)
    {
        $conn = $this->getConnection();

        $id = mysqli_real_escape_string($conn, $id);
        $sql = "SELECT {$this->table}.*, role.name as role_name, jobs.name as job_name
                FROM {$this->table}
                INNER JOIN jobs ON {$this->table}.job_id = jobs.id
                INNER JOIN role ON {$this->table}.role_id = role.id
                WHERE {$this->table}.id = '$id'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result);
    }
}

?>