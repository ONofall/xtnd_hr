<?php
require_once '../autoloader.php';
include 'ajax.php';
?>

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
                <button class="btn btn-secondary"><a class="text-decoration-none text-white px-3" href="edit.php?id=<?php echo $user['id'] ?>">Edit</a></button>
                <form action="delete.php" method="POST">
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
                <a class="page-link" href="#" data-page="<?php echo $page - 1; ?>">Previous</a>
            </li>
        <?php } ?>

        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                <a class="page-link" href="#" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php } ?>

        <?php if ($page < $total_pages) { ?>
            <li class="page-item">
                <a class="page-link" href="#" data-page="<?php echo $page + 1; ?>">Next</a>
            </li>
        <?php } ?>
    </ul>
</nav>
