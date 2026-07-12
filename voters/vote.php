<?php
session_start();
include('../includes/db_connection.php');
$total_vote = 0;

$query = "SELECT total_vote FROM `groups` WHERE gid = '$_GET[gid]'";
$result = $conn->query($query);
$group = $result->fetch_assoc();
$total_vote = $group['total_vote'];

// Update total vote for group
$query = "UPDATE `groups` SET total_vote = $total_vote + 1 WHERE gid = '$_GET[gid]'";
$result = $conn->query($query);
if ($result) {
    $query = "UPDATE voters set voting = 'Yes' where id='$_SESSION[id]'";
    $result = $conn->query($query);
    echo "<script>
    alert('Vote Saved Successfully!')</script>";
} else {
    echo "<script>
    alert('Error, Try again !')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../voters/style.css">
    <!-- bootstrap file -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>

<body>

</body>

</html>