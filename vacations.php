<?php
global $conn;
include('connection.php');

$sqlu = "SELECT name FROM users ";
$resultu = mysqli_query($conn, $sqlu);
$users = mysqli_fetch_all($resultu, MYSQLI_ASSOC);

if (isset($_POST['submit'])) {

    $from = mysqli_escape_string($conn, $_POST['from']);
    $to = mysqli_escape_string($conn, $_POST['to']);
    $user_id = mysqli_escape_string($conn, $_POST['user_id']);


    $sql = "INSERT INTO `vacation` ( `from`, `to`, `user_id`) VALUES (= '$from', '$to', '$user_id');";

    header('location:table_vacations.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vacation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container-xl py-5 bg-secondary">
    <div class="py-4 d-flex align-items-center justify-content-center gap-4">
        <button class="btn btn-dark py-3 px-5"><a class="text-decoration-none text-white" href="index.php" >Home</a></button>

    </div>    <div class="d-flex align-items-center justify-content-center pt-3">
        <h2 class="text-white">Add Vacation</h2>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group">
            <label class="text-white" for="from">From:</label>
            <input class="form-control" type="date" name="from" required>
        </div>
        <div class="form-group">
            <label class="text-white" for="to">To:</label>
            <input class="form-control" type="date" name="to" required>
        </div>
        <div class="form-group">
            <label class="text-white" for="user_id">User:</label>
            <select name="user_id" class="form-control" required>
                <?php foreach ($users as $user) { ?>
                    <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>