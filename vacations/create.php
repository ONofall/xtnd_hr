<?php
require_once('../autoloader.php');
include 'store.php';

$user = new User();
$users = $user->all();
$vacation = new Vacation();
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
        <button class="btn btn-dark py-3 px-5"><a class="text-decoration-none text-white" href="../user/index.php">Home</a>
        </button>

    </div>
    <div class="d-flex align-items-center justify-content-center pt-3">
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
        <div class="d-flex justify-content-center py-4">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
</body>
</html>