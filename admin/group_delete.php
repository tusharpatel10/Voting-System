<?php
include("../includes/db_connection.php");

$gid = $_GET['gid'];

$query = "DELETE FROM `groups`  where gid = $gid ";

$result = $conn->query($query);

if ($result) {
    echo "<script>
    alert('Group Deleted Successfully..')
    window.location.href = 'dashboard.php'
</script>";
} else {
    echo "<script>
    alert('Error, Please try again.')
    window.location.href = 'dashboard.php'
</script>";
}
