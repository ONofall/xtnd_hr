<?php

class User extends BaseModel
{
//    protected $table = 'users';

    public function getUserById($id)
    {
        $conn = $this->getConnection();
        $id = mysqli_real_escape_string($conn, $id);

        $sql = "SELECT {$this->getTable()}.*, roles.name as role_name, jobs.name as job_name
                FROM `{$this->getTable()}`
                INNER JOIN jobs ON {$this->getTable()}.job_id = jobs.id
                INNER JOIN roles ON {$this->getTable()}.role_id = roles.id
                WHERE {$this->getTable()}.id = '$id'";

        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function search($conditions, $page = 1, $records_per_page = 10)
    {
        $offset = ($page - 1) * $records_per_page;

        $conn = $this->getConnection();
        $sql = "SELECT SQL_CALC_FOUND_ROWS {$this->getTable()}.*, roles.name as role_name, jobs.name as job_name 
                FROM `{$this->getTable()}`
                INNER JOIN jobs ON {$this->getTable()}.job_id = jobs.id 
                INNER JOIN roles ON {$this->getTable()}.role_id = roles.id 
                WHERE 1=1";

        if (!empty($conditions['name'])) {
            $name = mysqli_real_escape_string($conn, $conditions['name']);
            $sql .= " AND users.name LIKE '%$name%'";
        }
        if (!empty($conditions['email'])) {
            $email = mysqli_real_escape_string($conn, $conditions['email']);
            $sql .= " AND users.email LIKE '%$email%'";
        }
        if (!empty($conditions['phone'])) {
            $phone = mysqli_real_escape_string($conn, $conditions['phone']);
            $sql .= " AND users.phone LIKE '%$phone%'";
        }
        if (!empty($conditions['role_id'])) {
            $role_id = mysqli_real_escape_string($conn, $conditions['role_id']);
            $sql .= " AND users.role_id = $role_id";
        }
        if (!empty($conditions['job_id'])) {
            $job_id = mysqli_real_escape_string($conn, $conditions['job_id']);
            $sql .= " AND users.job_id = $job_id";
        }
        $sql .= " ORDER BY {$this->getTable()}.id ASC LIMIT $offset, $records_per_page";

        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $total_result = mysqli_query($conn, "SELECT FOUND_ROWS() as total");
        $total = mysqli_fetch_assoc($total_result)['total'];

        return ['data' => $rows, 'total' => $total];
    }

}
