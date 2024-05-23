<?php
require_once '../autoloader.php';

$updateStatus = new Vacation();

if (isset($_POST['update'])) {
    $update = [
        'update_id' => $_POST['update_id'],
        'update' => $_POST['update']
    ];
    $updates = [$update];
    $result = $updateStatus->updateStatus($updates);
    if ($result) {
        header('Location: index.php');
    }
}
