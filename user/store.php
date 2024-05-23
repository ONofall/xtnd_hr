<?php

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'role_id' => $_POST['role_id'],
        'job_id' => $_POST['job_id']
    ];
    $user->insert($data);

    if ($user){
        header('location:index.php');

    }
}
