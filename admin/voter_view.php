<?php
include('../includes/db_connection.php')
?>
<html>

<body>
    <h3 class="text-center p-3">All Voters</h3>
    <div
        class="table-responsive">
        <table
            class="table table-secondary">
            <thead>
                <tr class="text-center">
                    <th scope="col">S. No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email id</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sno = 1;
                $query = "SELECT * FROM `voters`";
                $result = $conn->query($query);
                while ($voter = $result->fetch_assoc()) {
                    $isActive = $voter['active'];
                ?>
                    <tr class="text-center">
                        <td><?php echo $sno++; ?></td>
                        <td><?php echo $voter['name']; ?></td>
                        <td><?php echo $voter['email']; ?></td>
                        <td><?php echo $voter['mobile']; ?></td>
                        <td><?php echo $voter['address']; ?></td>
                        <td>
                            <a href="voter_edit.php?id=<?php echo $voter['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="voter_delete.php?id=<?php echo $voter['id'] ?>" class="btn btn-sm btn-secondary">Delete</a>
                            <?php
                            if ($isActive) {
                            ?>
                                <a href="voter_active_status.php?id=<?php echo $voter['id']; ?>&active=<?php echo $voter['active']; ?>" class="btn btn-sm btn-danger">Block</a>
                            <?php } else { ?>
                                <a href="voter_active_status.php?id=<?php echo $voter['id']; ?>&active=<?php echo $voter['active']; ?>" class="btn btn-sm btn-warning">Unblock</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>