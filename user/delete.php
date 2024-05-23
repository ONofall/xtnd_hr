<?php
$user = new User();
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];
    $delete = $user->delete($delete_id);
    if ($delete){
        header("Location: index.php");
    }
}
