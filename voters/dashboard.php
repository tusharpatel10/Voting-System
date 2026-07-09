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
    <div class="row">
        <div class="col-md-4" id="left-side">
            <h3>Voter Details</h3>
            <div class="table-responsive">
                <div class="table">
                    <?php
                    $query = "SELECT * FROM voters where id='$_SESSION[id]'";
                    $result = $conn->query($query);
                    while ($voters = $result->fetch_assoc()) {
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
                                    <td><?php echo $voters['voting']; ?></td>
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
        <div class="col-md-8" id="right-side">
        </div>
    </div>
</body>

</html>