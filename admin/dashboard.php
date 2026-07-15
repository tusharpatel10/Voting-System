<?php
session_start();
include('../includes/db_connection.php');

// Total Register Voters
$total_reg_voters = 0;
// Total Active Voters
$total_act_voters = 0;
// Total Register Groups
$total_reg_groups = 0;
// Total Active Groups
$total_act_groups = 0;

// Get Total Register Voters
$query = "SELECT count(*) as `total_reg_voters` FROM `voters`";
$result = $conn->query($query);
$voter = $result->fetch_assoc();
$total_reg_voters = $voter['total_reg_voters'];

// Get Total Active Voters
$query = "SELECT count(*) as `total_act_voters` FROM `voters` WHERE active= 1 ";
$result = $conn->query($query);
$voter = $result->fetch_assoc();
$total_act_voters = $voter['total_act_voters'];

// Get Total Register Groups
$query = "SELECT count(*) as `total_reg_groups` FROM `groups` ";
$result = $conn->query($query);
$voter = $result->fetch_assoc();
$total_reg_groups = $voter['total_reg_groups'];

// Get Total Active Groups
$query = "SELECT count(*) as `total_act_groups` FROM `groups` WHERE active= 1 ";
$result = $conn->query($query);
$voter = $result->fetch_assoc();
$total_act_groups = $voter['total_act_groups'];


if (isset($_POST['register_group'])) {
    // GET Form Data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $mobile = $_POST['mobile'];
    $image = $_FILES['photo']['name'];
    $address = $_POST['address'];

    // Move voter image to folder
    $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    if (!in_array($ext, $allowed)) die("invalid file type");
    $image = $_POST['name'] . '_' . random_int(1111, 9999) . '.' . $ext;
    $img_path = "images/" . $image;
    move_uploaded_file($_FILES['photo']['tmp_name'], $img_path);


    // Prepare and execute query
    $query = "INSERT INTO `groups` values(null,'$name', '$email', '$password', $mobile, '$image', '$address',0,0,1)";
    $result = $conn->query($query);
    if ($result) {
        echo "<script>
        alert('Group Registered successfully..');
        window.location.href='dashboard.php';
        </script>";
    } else {
        echo "<script>
            alert('Error, Please try again.');
            window.location.href='dashboard.php';
            </script>";
    }
}

// Reset Functionality
if (isset($_POST['reset_group'])) {
    $query = "DELETE FROM `groups`";
    $result = $conn->query($query);
    if ($result) {
        echo "<script>alert('All Groups Deleted Successfully..');
        window.location.href = 'dashboard.php';</script>";
    } else {
        echo "<script>alert('Error, Please try again later');
        window.location.href= 'dashboard.php';</script>";
    }
}

// set voting status of all the voters to Not Voted
if (isset($_POST['reset_voting_status'])) {
    $query = "UPDATE `voters` SET voting='No'";
    $result = $conn->query($query);

    if ($result) {
        echo "<script>alert('Voting Reset Successfully...');
        window.location.href='dashboard.php'</script>";
    } else {
        echo "<script>alert('Error, Please try again..');
        window.location.href='dashboard.php';</script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./style.css">
    <!-- bootstrap file -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../includes/jquery.js"></script>
</head>

<body>
    <!-- Header Part -->
    <div class="container-fluid header">
        <h3>Online Voting System Admin</h3>
    </div>
    <!-- Main Container -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="left-side">
                <h3>Menu</h3>
                <a href="dashboard.php" class="btn btn-primary">Dashboard</a>
                <a id="add_group" class="btn btn-secondary mt-3">Add Group</a>
                <a id="group_view" class="btn btn-secondary mt-3">Group View</a>
                <a id="voter_view" class="btn btn-secondary mt-3">Voters View</a>
                <a id="result_view" class="btn btn-secondary mt-3">Result View</a>
                <a id="reset_voting" class="btn btn-secondary mt-3">Reset Voting</a><br>
                <a href="../logout.php" class="btn btn-danger mt-3">Logout</a>
            </div>

            <div class="col-md-10 mt-5" id="right-side">
                <h2 class="pb-3 mt-4 ms-4 text-decoration-underline">Admin Dashboard Page</h2>
                <div class="row d-flex flex-wrap mx-3">
                    <div class="card text-white bg-primary col-md-3  m-2 p-4  ">
                        <div class="card-body">
                            <h3 class="card-title">Total Registered Voters</h3>
                            <h4 class="card-text"><?php echo $total_reg_voters ?></h4>
                        </div>
                    </div>
                    <div class="card text-white bg-dark col-md-3  m-2 p-4  ">
                        <div class="card-body">
                            <h3 class="card-title">Total Active Voters</h3>
                            <h4 class="card-text"><?php echo $total_act_voters ?></h4>
                        </div>
                    </div>
                    <div class="card text-white bg-secondary col-md-3  m-2 p-4  ">
                        <div class="card-body">
                            <h3 class="card-title">Total Registered Groups</h3>
                            <h4 class="card-text"><?php echo $total_reg_groups ?></h4>
                        </div>
                    </div>
                    <div class="card text-white bg-success col-md-3  m-2 p-4  ">
                        <div class="card-body">
                            <h3 class="card-title">Total Active Group</h3>
                            <h4 class="card-text"><?php echo $total_act_groups ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $("#add_group").click(function() {
            $("#right-side").load('group_register.php');
        });
    });

    $(document).ready(function() {
        $('#group_view').click(function() {
            $('#right-side').load('group_view.php');
        });
    });
    $(document).ready(function() {
        $('#voter_view').click(function() {
            $('#right-side').load('voter_view.php');
        });
    });
    $(document).ready(function() {
        $('#result_view').click(function() {
            $('#right-side').load('result_view.php');
        });
    });
    $(document).ready(function() {
        $('#reset_voting').click(function() {
            $('#right-side').load('reset_voting.php');
        });
    });
</script>

</html>