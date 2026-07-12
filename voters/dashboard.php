<?php
session_start();
include('../includes/db_connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Dashboard</title>
    <link rel="stylesheet" href="../voters/style.css">
    <!-- bootstrap file -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Header Part -->
    <div class="container-fluid header">
        <h3>Online Voting System</h3>
    </div>
    <!-- Main Container -->
    <div class="row d-flex justify-content-center">
        <div class="col-md-4" id="left-side">
            <center>
                <h3>Voter Details</h3>
            </center>
            <div class="table-responsive">
                <div class="table">
                    <?php
                    $voting_flag = "";
                    $query = "SELECT * FROM voters where id='$_SESSION[id]'";
                    $result = $conn->query($query);
                    while ($voters = $result->fetch_assoc()) {
                        $voting_flag = $voters['voting'];
                    ?>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="../voters/images/<?php echo $voters['image']; ?>" alt="Voters Image" width="105" height="100" class="img-thumbnail">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Name:</td>
                                    <td><?php echo $voters['name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><?php echo $voters['email']; ?></td>
                                </tr>
                                <tr>
                                    <td>Mobile:</td>
                                    <td><?php echo $voters['mobile']; ?></td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td><?php echo $voters['address']; ?></td>
                                </tr>
                                <tr>
                                    <td>Voting Status:</td>
                                    <td><?php if ($voters['voting'] == "No") {
                                            echo "<span class='text-danger'>Not Voted</span>";
                                        } else {
                                            echo "<span class='text-success'>Voted</span>";
                                        } ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="left-side-button">
                            <a href="" class="btn btn-primary btn-sm">Edit Profile</a>
                            <a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6" id="right-side">
            <h3>Available Groups for voting</h3>
            <div class="table-responsive">
                <div class="table">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>S No.</td>
                                <td>Group Image</td>
                                <td>Group Name</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sno = 1;
                            $query = "SELECT * FROM `groups`";
                            $result = $conn->query($query);
                            while ($group = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td class="pt-4"><?php echo $sno++; ?></td>
                                    <td><img src="../admin/images/<?php echo $group['image']; ?>" alt="group Image" width="60" srcset=""></td>
                                    <td class="pt-4"><?php echo $group['name'] ?></td>
                                    <?php if ($voting_flag == 'Yes') { ?>
                                        <td class="pt-4"><a href="vote.php?gid=<?php echo $group['gid'] ?>&tv=<?php echo $group['total_vote'] ?>" class="btn btn-primary btn-sm btn-danger" style="pointer-events:none;">Voted</a></td>
                                    <?php } else { ?>
                                        <td class="pt-4"><a href="vote.php?gid=<?php echo $group['gid'] ?>&tv=<?php echo $group['total_vote'] ?>" class="btn btn-primary btn-sm">Vote</a></td>
                                    <?php } ?>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>