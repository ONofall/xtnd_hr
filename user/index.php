<?php
require_once '../autoloader.php';
include 'ajax.php';

// Fetch initial data for roles and jobs
$role = new Role();
$job = new Job();
$roles = $role->all();
$jobs = $job->all();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="container-xl py-5">
    <div class="py-4">
        <div class="py-4 d-flex align-items-center justify-content-center gap-4">
            <button class="btn btn-dark py-3 px-5"><a class="text-decoration-none text-white" href="create.php">Add User</a></button>
            <button class="btn btn-secondary py-3 px-5"><a class="text-decoration-none text-white" href="index.php">Home</a></button>
            <button class="btn btn-primary py-3 px-5"><a class="text-decoration-none text-white" href="../vacations/index.php">Vacations</a></button>
        </div>
        <div class="d-flex justify-content-around align-items-center">
            <form action="index.php" method="GET" class="d-flex" id="search_form">
                <input type="text" name="search_name" class="form-control" placeholder="Search by name" id="search_name"/>
                <input type="text" name="search_email" class="form-control ms-2" placeholder="Search by email" id="search_email"/>
                <input type="text" name="search_phone" class="form-control ms-2" placeholder="Search by Phone" id="search_phone"/>
                <select name="search_role" class="form-control ms-2 bg-secondary" id="search_role">
                    <option value="">Select Role</option>
                    <?php foreach ($roles as $role) { ?>
                        <option value="<?php echo $role['id']; ?>"><?php echo $role['name']; ?></option>
                    <?php } ?>
                </select>
                <select name="search_job" class="form-control ms-2 bg-secondary" id="search_job">
                    <option value="">Select Job</option>
                    <?php foreach ($jobs as $job) { ?>
                        <option value="<?php echo $job['id']; ?>"><?php echo $job['name']; ?></option>
                    <?php } ?>
                </select>
            </form>
        </div>
        <div class="d-flex justify-content-center py-4">
            <h1>Users : <?php echo $total_records ?></h1>
        </div>
    </div>
    <div id="searchresult">
        <!-- The table content will be loaded here via AJAX -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        function fetchResults(page = 1) {
            let searchParams = {
                search_name: $("#search_name").val(),
                search_email: $("#search_email").val(),
                search_phone: $("#search_phone").val(),
                search_role: $("#search_role").val(),
                search_job: $("#search_job").val(),
                page: page
            };
            $.ajax({
                url: "table.php",
                method: "GET",
                data: searchParams,
                success: function (data) {
                    $("#searchresult").html(data);
                }
            });
        }

        // Fetch initial results
        fetchResults();

        // Attach event handlers for search inputs
        $("#search_name, #search_email, #search_phone, #search_role, #search_job").on('keyup change', function () {
            fetchResults();
        });

        // Attach click event listener to pagination links
        $(document).on("click", ".page-link", function (e) {
            e.preventDefault();
            let page = $(this).data("page");
            fetchResults(page);
        });
    });
</script>

</body>
</html>
