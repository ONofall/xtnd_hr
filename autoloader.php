<?php

$file = [
    '/home/nofal/PhpstormProjects/myshop/Classes/Connection.php',
    '/home/nofal/PhpstormProjects/myshop/Classes/User.php',
    '/home/nofal/PhpstormProjects/myshop/Classes/Role.php',
    '/home/nofal/PhpstormProjects/myshop/Classes/Job.php',
    '/home/nofal/PhpstormProjects/myshop/Classes/Vacation.php'
];

foreach ($file as $filePath) {

    require_once $filePath;
}


?>