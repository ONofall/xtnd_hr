<?php

global $conn;
$updateStatus = new vacation($conn);

if (isset($_POST['update'])) {
    $update_id = $_POST['update_id'];
    $new_status = ($_POST['update'] == 'Accept') ? 'Accept' : 'Reject';

    $update = $updateStatus->updateStatus($update_id, $new_status);
}




?>