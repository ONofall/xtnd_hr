<?php



class BaseModel {
    use DatabaseConnection;

    protected $table;

    public function all() {
        $conn = $this->getConnection();
        $sql = "SELECT * FROM {$this->table}";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // You can add other common methods here, like find, save, delete, etc.
}
?>