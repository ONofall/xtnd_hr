<?php
global $conn;
include('Classes/User.php');
include('Classes/Role.php');
include('Classes/Job.php');

$user = new User();
$role = new Roles();
$job = new Jobs();
$roles = $role->getRoles();
$jobs = $job->getJobs();
$records_per_page = 3;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$search_query_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';
$search_query_email = isset($_GET['search_email']) ? $_GET['search_email'] : '';
$search_query_phone = isset($_GET['search_phone']) ? $_GET['search_phone'] : '';
$search_query_role = isset($_GET['search_role']) ? $_GET['search_role'] : '';
$search_query_job = isset($_GET['search_job']) ? $_GET['search_job'] : '';

$search_conditions = [
    'name' => $search_query_name,
    'email' => $search_query_email,
    'phone' => $search_query_phone,
    'role_id' => $search_query_role,
    'job_id' => $search_query_job,
];

$search_results = $user->search($search_conditions, $page, $records_per_page);
$getdata = $search_results['data'];
$total_records = $search_results['total'];
$total_pages = ceil($total_records / $records_per_page);

if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];
    $delete = $user->delete($delete_id);
    header("Location: index.php");
    exit();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container-xl py-5">
    <div class="py-4">

        <div class="py-4 d-flex align-items-center justify-content-center gap-4">
            <button class="btn btn-dark py-3 px-5"><a class="text-decoration-none text-white" href="add.php">Add
                    User</a></button>
            <button class="btn btn-secondary  py-3 px-5"><a class="text-decoration-none text-white" href="index.php">Home</a>
            </button>
            <button class="btn btn-primary py-3 px-5"><a class="text-decoration-none text-white"
                                                         href="table_vacations.php">Vacations</a></button>
        </div>
        <div class="d-flex justify-content-around align-items-center">
            <form action="index.php" method="GET" class="d-flex">
                <input type="text" name="search_name" class="form-control" placeholder="Search by name"
                       value="<?php echo htmlspecialchars($search_query_name); ?>" />
                <input type="text" name="search_email" class="form-control ms-2" placeholder="Search by email"
                       value="<?php echo htmlspecialchars($search_query_email); ?>" />
                <input type="text" name="search_phone" class="form-control ms-2" placeholder="Search by Phone"
                       value="<?php echo htmlspecialchars($search_query_phone); ?>" />

                <select name="search_role" class="form-control ms-2 bg-secondary">
                    <option value="">Select Role</option>
                    <?php foreach ($roles as $role) { ?>
                        <option value="<?php echo $role['id']; ?>" <?php if ($search_query_role == $role['id']) echo 'selected'; ?>><?php echo $role['name']; ?></option>
                    <?php } ?>
                </select>
                <select name="search_job" class="form-control ms-2 bg-secondary">
                    <option value="">Select Job</option>
                    <?php foreach ($jobs as $job) { ?>
                        <option value="<?php echo $job['id']; ?>" <?php if ($search_query_job == $job['id']) echo 'selected'; ?>><?php echo $job['name']; ?></option>
                    <?php } ?>
                </select>

                <input type="submit" value="Search" class="btn btn-primary ms-2"/>
            </form>

        </div>
    </div>

    <table class="table table-dark table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Title</th>
            <th>Action</th>
        </tr>
        <?php foreach ($getdata as $user) { ?>
            <tr>
                <td><?php echo $user['id'] ?></td>
                <td><?php echo $user['name'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['phone'] ?></td>
                <td><?php echo $user['role_name'] ?></td>
                <td><?php echo $user['job_name'] ?></td>
                <td class="d-flex justify-content-around">
                    <button class="btn btn-secondary"><a class="text-decoration-none text-white px-3"
                                                         href="edit.php?id=<?php echo $user['id'] ?>">Edit</a></button>
                    <form action="index.php" method="POST">
                        <input type="hidden" name="delete_id" value="<?php echo $user['id'] ?>">
                        <input type="submit" name="delete" value="Delete" class="btn btn-danger px-3">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
    <!-- Pagination controls -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php if ($page > 1) { ?>
                <li class="page-item">
                    <a class="page-link"
                       href="?page=<?php echo $page - 1; ?>&search_name=<?php echo urlencode($search_query_name); ?>&search_email=<?php echo urlencode($search_query_email); ?>&search_phone=<?php echo urlencode($search_query_phone); ?>">Previous</a>
                </li>
            <?php } ?>

            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link"
                       href="?page=<?php echo $i; ?>&search_name=<?php echo urlencode($search_query_name); ?>&search_email=<?php echo urlencode($search_query_email); ?>&search_phone=<?php echo urlencode($search_query_phone); ?>"><?php echo $i; ?></a>
                </li>
            <?php } ?>

            <?php if ($page < $total_pages) { ?>
                <li class="page-item">
                    <a class="page-link"
                       href="?page=<?php echo $page + 1; ?>&search_name=<?php echo urlencode($search_query_name); ?>&search_email=<?php echo urlencode($search_query_email); ?>&search_phone=<?php echo urlencode($search_query_phone); ?>">Next</a>
                </li>
            <?php } ?>
        </ul>
    </nav>

</div>
</body>
</html>
