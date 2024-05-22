<?php


global $conn;

$vacation = new vacation($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $user_id = $_POST['user_id'];

    $vacation->addVacation($from, $to, $user_id);
}





?>