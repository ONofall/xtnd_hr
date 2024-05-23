<?php

$editUser = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'role_id' => $_POST['role_id'],
        'job_id' => $_POST['job_id']
    ];

    $editUser->update($id, $data);
}

