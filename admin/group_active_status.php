<?php
include("../includes/db_connection.php");

$isActive = $_GET['active'];
$gid = $_GET['gid'];

if ($isActive) {
    $query = "UPDATE `groups` SET active=0 where gid = $gid ";
} else {
    $query = "UPDATE `groups` SET active=1 where gid = $gid ";
}
$result = $conn->query($query);

if ($result) {
    echo "<script>alert('Active Status update Successfully..')
    window.location.href='dashboard.php'</script>";
} else {
    echo "<script>alert('Error, Please try again.')
    window.location.href='dashboard.php'</script>";
}
