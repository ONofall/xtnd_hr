<?php
global $conn;
include("connection.php");
$sqlr = "SELECT * FROM role ";
$resultr = mysqli_query($conn, $sqlr);
$roles = mysqli_fetch_all($resultr, MYSQLI_ASSOC);

$sqlj = "SELECT * FROM jobs ";
$resultj = mysqli_query($conn, $sqlj);
$joob = mysqli_fetch_all($resultj, MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    // Update form data
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $role_id = mysqli_real_escape_string($conn, $_POST['role_id']);
    $job_id = mysqli_real_escape_string($conn, $_POST['job_id']);

    // Update query
    $sql = "UPDATE users
            SET name = '$name',
                email = '$email',
                phone = '$phone',
                role_id = '$role_id',
                job_id = '$job_id'
            WHERE id = '$id'";

    // Execute query
    if (mysqli_query($conn, $sql)) {
        header('location:index.php');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Fetch user data
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT users.*, role.name as role_name, jobs.name as job_name, vacation.from, vacation.to
            FROM users
            INNER JOIN jobs ON users.job_id = jobs.id
            INNER JOIN role ON users.role_id = role.id
            INNER JOIN vacation ON vacation.user_id = users.id
            WHERE users.id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        echo "No user found with ID: $id";
        exit;
    }
} else {
    header('location:index.php');
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
            <input class="form-control" type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
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
                <option <?php if ($row['role_id'] == $rolee['id']) { echo 'selected'; } ?>
                        value="<?php echo $rolee['id'] ?>"><?php echo $rolee['name'] ?></option>
            <?php } ?>
        </select>

        <label class="text-white" for="job_id">Title:</label>
        <select name="job_id" class="test">
            <?php foreach ($joob as $jooob) { ?>
                <option <?php if ($row['job_id'] == $jooob['id']) { echo 'selected'; } ?>
                        value="<?php echo $jooob['id'] ?>"><?php echo $jooob['name'] ?></option>
            <?php } ?>
        </select>


        <div class="d-flex align-items-center justify-content-center pt-3">
            <input type="submit" name="submit" value="Update">
        </div>
    </form>
</div>
</body>
</html>






