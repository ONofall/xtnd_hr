<?php



class User
{
    use DatabaseConnection;

    protected $table = 'users';

    public function read()
    {
        $conn = $this->getConnection();
        $sqlu = "SELECT * FROM {$this->table}";
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

        $sql = "INSERT INTO {$this->table} ($columnsStr) VALUES ($valuesStr)";
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
            header('location:/home/nofal/PhpstormProjects/myshop/user/index.php');
            return true;
        } else {
            return false;
        }
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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function search($conditions, $page = 1, $records_per_page = 10)
    {
        $offset = ($page - 1) * $records_per_page;

        $conn = $this->getConnection();
        $sql = "SELECT SQL_CALC_FOUND_ROWS {$this->table}.*, role.name as role_name, jobs.name as job_name 
                FROM {$this->table}
                INNER JOIN jobs ON {$this->table}.job_id = jobs.id 
                INNER JOIN role ON {$this->table}.role_id = role.id where 1=1 ";

        if (!empty($conditions['name'])) {
            $sql .= " and users.name LIKE '%" . $conditions['name'] . "%'";
        }
        if (!empty($conditions['email'])) {
            $sql .= " and users.email LIKE '%" . $conditions['email'] . "%'";
        }
        if (!empty($conditions['phone'])) {
            $sql .= " and users.phone LIKE '%" . $conditions['phone'] . "%'";
        }
        if (!empty($conditions['role_id'])) {
            $sql .= " and users.role_id = " . $conditions['role_id'];
        }
        if (!empty($conditions['job_id'])) {
            $sql .= " and users.job_id = " . $conditions['job_id'];
        }
        $sql .= " ORDER BY {$this->table}.id ASC  LIMIT $offset, $records_per_page";

        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $total_result = mysqli_query($conn, "SELECT FOUND_ROWS() as total");
        $total = mysqli_fetch_assoc($total_result)['total'];

        return ['data' => $rows, 'total' => $total];
    }



//    public function usersCount()
//    {
//        $conn = $this->getConnection();
//        $sql = "SELECT COUNT(id) FROM {$this->table}";
//        $result = mysqli_query($conn, $sql);
//        $rows = mysqli_fetch_row($result);
//        return $rows[0];
//    }

}

?>
