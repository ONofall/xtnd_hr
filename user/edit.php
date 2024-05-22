<?php
require_once('../autoloader.php');
include 'update.php';



$editUser = new User();
$roles= new Roles();
$Jobs = new Jobs();
$roles = $roles->getRoles();
$jobs = $Jobs->getJobs();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = $editUser->getUserById($id);
} else {
    header('location:index.php');
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container-xl py-5 bg-secondary">
    <button><a class="text-decoration-none text-black" href="index.php">Home</a></button>
    <div class="d-flex align-items-center justify-content-center pt-3">

        <h2 class="text-white">Update Data</h2>
    </div>
    <form action="" method="post"> <!-- Corrected form action -->
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="d-flex align-items-center gap-4">
            <label class="text-white" for="name">Name:</label>
            <input class="form-control" type="text" name="name" value="<?php echo $row['name'];  ?>"><br><br>
        </div>
        <div class="d-flex align-items-center gap-4">
            <label class="text-white" for="email">Email:</label>
            <input class="form-control" type="text" name="email" value="<?php echo $row['email']; ?>"><br><br>
        </div>
        <div class="d-flex align-items-center gap-3">
            <label class="text-white" for="phone">Phone:</label>
            <input class="form-control" type="text" name="phone" value="<?php echo $row['phone']; ?>"><br><br>
        </div>

        <!--        <div class="d-flex align-items-center gap-3">-->
        <!--            <label class="text-white" for="role_id">role:</label>-->
        <!--            <input class="form-control" type="text" name="role_id" value="-->
        <?php //echo $row['role_id']; ?><!--"><br><br>-->
        <!--        </div>-->

        <label class="text-white" for="role_id">Role:</label>
        <select name="role_id" class="test">
            <?php foreach ($roles as $rolee) { ?>
                <option <?php if ($row['role_id'] == $rolee['id']) {
                    echo 'selected';
                } ?>
                        value="<?php echo $rolee['id'] ?>"><?php echo $rolee['name'] ?></option>
            <?php } ?>
        </select>

        <label class="text-white" for="job_id">Title:</label>
        <select name="job_id" class="test">
            <?php foreach ($jobs as $jooob) { ?>
                <option <?php if ($row['job_id'] == $jooob['id']) {
                    echo 'selected';
                } ?>
                        value="<?php echo $jooob['id'] ?>"><?php echo $jooob['name'] ?></option>
            <?php } ?>
        </select>

        <div class="d-flex align-items-center justify-content-center pt-3">
            <input type="submit" name="submit" value="Update" class="btn btn-primary">
        </div>

    </form>
</div>
</body>
</html>






