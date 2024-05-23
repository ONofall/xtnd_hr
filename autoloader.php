<?php

$file = [
    __DIR__ . '/Classes/Connection.php',
    __DIR__ . '/Classes/Basemodel.php',
    __DIR__ . '/Classes/User.php',
    __DIR__ . '/Classes/Role.php',
    __DIR__ . '/Classes/Job.php',
    __DIR__ . '/Classes/Vacation.php'


];

foreach ($file as $filePath) {

    require_once $filePath;
}
