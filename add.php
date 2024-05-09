<?php
global $conn;
include ('connection.php');

$name = $email = $phone = $role_id = $job_id = '';

$sqlr = "SELECT * FROM role ";
$resultr = mysqli_query($conn, $sqlr);
$roles = mysqli_fetch_all($resultr, MYSQLI_ASSOC);

$sqlj = "SELECT * FROM jobs ";
$resultj = mysqli_query($conn, $sqlj);
$joob = mysqli_fetch_all($resultj, MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    // Add form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $role_id = mysqli_real_escape_string($conn, $_POST['role_id']);
    $job_id = mysqli_real_escape_string($conn, $_POST['job_id']);

    // Insert query
    $sql = "INSERT INTO users ( name, email, phone, role_id, job_id) VALUES ( '$name', '$email', '$phone', '$role_id', '$job_id')";

    // Execute query
    if (mysqli_query($conn, $sql)) {
        header('location:index.php');
    } else {
        echo "Error adding record: " . mysqli_error($conn);
    }
};





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container-xl py-5 bg-secondary">
    <button><a class="text-decoration-none text-black" href="index.php">Home</a></button>
    <div class="d-flex align-items-center justify-content-center pt-3">

        <h2 class="text-white">Add Data</h2>
    </div>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="d-flex align-items-center gap-4">
        <label class="text-white" for="name">Name:</label>
        <input class="form-control" type="text" name="name" value="<?php echo htmlspecialchars($name) ?>" required><br><br>
    </div>
    <div class="d-flex align-items-center gap-4">
        <label class="text-white" for="email">Email:</label>
        <input class="form-control" type="text" name="email" value="<?php echo htmlspecialchars($email) ?>" required><br><br>
    </div>
    <div class="d-flex align-items-center gap-3">
        <label class="text-white" for="phone">Phone:</label>
        <input class="form-control" type="text" name="phone" value="<?php echo htmlspecialchars($phone) ?>" required><br><br>
    </div>
    <label class="text-white" for="role_id">Role:</label>
    <select name="role_id" class="test" required>
        <?php foreach ($roles as $rolee) { ?>
            <option value="<?php echo htmlspecialchars($rolee['id']); ?>"><?php echo $rolee['name']; ?></option>
        <?php } ?>
    </select>
    <label class="text-white" for="job_id">Title:</label>
    <select name="job_id" class="test" required>
        <?php foreach ($joob as $jooob) { ?>
            <option value="<?php echo htmlspecialchars($jooob['id']); ?>"><?php echo $jooob['name']; ?></option>
        <?php } ?>
    </select>

    <div class="d-flex align-items-center justify-content-center pt-3">
        <input type="submit" name="submit" value="Add">
    </div>
</form>
</div>
</body>
</html>
