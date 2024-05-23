<?php

$updateStatus = new Vacation();

if (isset($_POST['update'])) {
    $update_id = $_POST['update_id'];
    $new_status = ($_POST['update'] == 'Accept') ? 'Accept' : 'Reject';

    $update = $updateStatus->updateStatus($update_id, $new_status);
    if ($new_status){
        header('location: index.php');

    }
}