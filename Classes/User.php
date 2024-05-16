<?php
include_once('Connection.php');

class User
{

    use DatabaseConnection;

    public function read()
    {
        $conn = $this->getConnection();
        $sqlu = "SELECT * FROM users ";
        $resultu = mysqli_query($conn, $sqlu);
        return mysqli_fetch_all($resultu, MYSQLI_ASSOC);
    }

    public function update($id, array $data  )
    {
        $standard = ['name', 'email', 'phone', 'role_id', 'job_id'];
        $conn = $this->getConnection();

        $id = mysqli_real_escape_string($conn, $_POST['id']);

        $sqlAr =[];

        foreach ($standard as $stand) {
            if (isset($data[$stand])) {
                $value = mysqli_real_escape_string($conn, $data[$stand]);
                $sqlAr[] = "$stand = '$value'";
            }
        }
        $sql = "UPDATE users SET " . implode(', ', $sqlAr) . " WHERE id = '$id'";

        // Execute query
        if (mysqli_query($conn, $sql)) {
            header('location:index.php');
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    public function add(array $data)
    {
        $conn = $this->getConnection();
//
        $standard = ['name', 'email', 'phone', 'role_id', 'job_id'];
        $columns = [];
        $values = [];

        foreach ($standard as $field) {
            if (isset($data[$field])) {
                $columns[] = $field;
                $values[] = "'" . mysqli_real_escape_string($conn, $data[$field]) . "'";
            }
        }
        $columnsStr = implode(', ', $columns);
        $valuesStr = implode(', ', $values);

        // Insert query
        $sql = "INSERT INTO users ($columnsStr) VALUES ($valuesStr)";
        // Execute query
        if (mysqli_query($conn, $sql)) {
            header('location:index.php');
        } else {
            echo "Error adding record: " . mysqli_error($conn);
        }
    }

    public function Delete($delete_id)
    {
        $conn = $this->getConnection();

        $delete_id = mysqli_real_escape_string($conn, $delete_id);
        $sql_user = "DELETE FROM users WHERE id = $delete_id";

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

        $sql = "SELECT users.*, role.name as role_name , jobs.name as job_name , vacation.from , vacation.to FROM users  JOIN jobs ON users.job_id = jobs.id INNER JOIN role ON users.role_id = role.id left JOIN vacation ON vacation.user_id = users.id;
";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);

    }

    public function getUserById($id)
    {
        $conn = $this->getConnection();

        $id = mysqli_real_escape_string($conn, $id);
        $sql = "SELECT users.*, role.name as role_name, jobs.name as job_name
                FROM users
                INNER JOIN jobs ON users.job_id = jobs.id
                INNER JOIN role ON users.role_id = role.id
                WHERE users.id = '$id'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result);
    }
}

?>