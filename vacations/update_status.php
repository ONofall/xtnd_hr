<?php
require_once '../autoloader.php';


$vacation = new Vacation();

if (isset($_POST['update'])) {
    $updates = [
        $_POST['update_id'] => ($_POST['update'] == 'Accept') ? 'Accept' : 'Reject'
    ];

    $result = $vacation->updateStatus($updates);
    if ($result) {
        header('Location: index.php');
    }
}

