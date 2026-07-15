<?php
include("../includes/db_connection.php");

$isActive = $_GET['active'];
$id = $_GET['id'];

if ($isActive) {
    $query = "UPDATE `voters` SET active=0 where id = $id ";
} else {
    $query = "UPDATE `voters` SET active=1 where id = $id ";
}
$result = $conn->query($query);

if ($result) {
    echo "<script>alert('Active Status update Successfully..')
    window.location.href='dashboard.php'</script>";
} else {
    echo "<script>alert('Error, Please try again.')
    window.location.href='dashboard.php'</script>";
}
