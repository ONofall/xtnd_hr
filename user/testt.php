<?php

$conn = mysqli_connect('localhost', 'root', 'root', 'xtnd_hr');

if (isset($_POST['input'])) {

    $input = $_POST['input'];
    $sql = "SELECT * FROM users WHERE name LIKE '{$input}%' OR email LIKE '{$input}%' OR phone LIKE '{$input}%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        ?>

        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>

            </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>


                </tr>
            <?php } ?>
            </tbody>
        </table>

    <?php } else { ?>
        <h6 class="text-danger text-center mt-3">No Data Found</h6>
    <?php }
}
?>