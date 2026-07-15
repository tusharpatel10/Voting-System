<?php
include("../includes/db_connection.php");

$total_votes = 0;
$query = "SELECT SUM(total_vote) as `total_votes` FROM `groups`";
$result = $conn->query($query);
$group = $result->fetch_assoc();
$total_votes = $group['total_votes'];

?>
<html>

<body>
    <div class="row">
        <div class="col-md-12">
            <h3>Total Votes Cast = <?php echo $total_votes ?></h3>
            <?php
            // Find the group with the highest voting
            $query = "SELECT name, total_vote FROM `groups` where total_vote = 
            (SELECT MAX(total_vote) FROM `groups`)";
            $result = $conn->query($query);
            while ($group = $result->fetch_assoc()) {
            ?>
                <hr>
                <h5>Highest Vote Cast to - <?php echo $group['name']; ?>(<?php echo $group['total_vote']; ?>)</h5>
            <?php
            }
            ?>
            <hr>
            <div class="table-responsive col-md-6">
                <table
                    class="table table-striped table-hover table-borderless table-primary align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Sr. No</th>
                            <th>Group</th>
                            <th>Total Votes</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        // Get total votes for each Groups
                        $query = "SELECT gid, name, total_vote FROM `groups`";
                        $result = $conn->query($query);
                        $sNo = 1;
                        while ($group = $result->fetch_assoc()) {
                        ?>
                            <tr class="table-primary">
                                <td scope="row"><?php echo $sNo++; ?></td>
                                <td><?php echo $group['name']; ?></td>
                                <td><?php echo $group['total_vote'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>