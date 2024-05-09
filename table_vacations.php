<?php
global $conn;
include('connection.php');

$sql = "SELECT users.*, vacation.from , vacation.to FROM users INNER JOIN vacation ON vacation.user_id = users.id ";

$result = mysqli_query($conn, $sql);

$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


</head>
<body>
<div class="container-xl py-5">
    <div class="py-4 d-flex align-items-center justify-content-center gap-4">
        <button class="btn btn-dark py-3 px-5"><a class="text-decoration-none text-white" href="vacations.php" >Add Vacations</a></button>

    </div>
    <table class="table table-dark table-hover">
        <tr>
            <th>Name</th>
            <th>Vacation from</th>
            <th>to</th>
        </tr>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo $user['name'] ?></td>
                <td><?php echo $user['from'] ?></td>
                <td><?php echo $user['to'] ?></td>
            </tr>
        <?php } ?>

    </table>
</div>
</body>
</html>