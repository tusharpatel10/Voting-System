<?php
include('../includes/db_connection.php')
?>
<html>

<body>
    <h3 class="text-center p-3 text-decoration-underline">Registered Groups for Voting</h3>
    <div
        class="table-responsive">
        <table
            class="table table-secondary">
            <thead>
                <tr class="text-center">
                    <th scope="col">S. No</th>
                    <th scope="col">Group Id</th>
                    <th scope="col">Group Name</th>
                    <th scope="col">Group Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sno = 1;
                $query = "SELECT * FROM `groups`";
                $result = $conn->query($query);
                while ($group = $result->fetch_assoc()) {
                    $isActive = $group['active'];
                ?>
                    <tr class="text-center">
                        <td style="padding-top: 25px;"><?php echo $sno++; ?></td>
                        <td style="padding-top: 25px;"><?php echo $group['gid']; ?></td>
                        <td style="padding-top: 25px;"><?php echo $group['name']; ?></td>
                        <td><img src="images/<?php echo $group['image'] ?>" alt="Group_image" width="60"></td>
                        <td style="padding-top: 25px;">
                            <a href="group_delete.php?gid=<?php echo $group['gid'] ?>" class="btn btn-sm btn-secondary">Delete</a>

                            <?php
                            if ($isActive) {
                            ?>
                                <a href="group_active_status.php?gid=<?php echo $group['gid']; ?>&active=<?php echo $group['active']; ?>" class="btn btn-sm btn-danger">Block</a>
                            <?php } else { ?>
                                <a href="group_active_status.php?gid=<?php echo $group['gid']; ?>&active=<?php echo $group['active']; ?>" class="btn btn-sm btn-warning">Unblock</a>
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