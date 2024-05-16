<?php
global $conn;
include('Classes/User.php');

$user = new User($conn);
$getdata = $user->read_user_job_role();

if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    $delete = $user->delete($delete_id);
}

?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>HR</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    </head>
    <body>
    <div class="container-xl py-5">
        <div class="py-4 d-flex align-items-center justify-content-center gap-4">
            <button class="btn btn-dark py-3 px-5" ><a class="text-decoration-none text-white"  href="add.php">Add User</a></button>
            <button class="btn btn-primary py-3 px-5"><a class="text-decoration-none text-white" href="table_vacations.php" >Vacations</a></button>

        </div>
    <table class="table table-dark table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Title</th>
    <!--        <th>Vacation from</th>-->
    <!--        <th>to</th>-->
            <th>Action</th>
        </tr>
        <?php foreach ($getdata as $user){ ?>
        <tr>
            <td><?php echo $user['id']?></td>
            <td><?php echo $user['name']?></td>
            <td><?php echo $user['email']?></td>
            <td><?php echo $user['phone']?></td>
            <td><?php echo $user['role_name']?></td>
            <td><?php echo $user['job_name']?></td>
    <!--        <td>--><?php //echo $user['from']?><!--</td>-->
    <!--        <td>--><?php //echo $user['to']?><!--</td>-->

            <td class="d-flex justify-content-around">

                <button class="btn btn-secondary "><a class="text-decoration-none text-white px-3" href="edit.php?id=<?php echo  $user['id']?>" >Edit</a></button>

                <form action="index.php" method="POST">
                    <input type="hidden" name="delete_id" value="<?php echo $user['id'] ?>">
                    <input type="submit" name="delete" value="Delete" class="btn btn-danger px-3">
                </form>
            </td>
        </tr>
        <?php } ?>

    </table>
    </div>
    </body>
    </html>
