<?php
include("../includes/db_connection.php");

$id = $_GET['id'];

$query = "DELETE FROM `voters`  where id = $id ";

$result = $conn->query($query);

if ($result) {
    echo "<script>
    alert('Voter Deleted Successfully..')
    window.location.href = 'dashboard.php'
</script>";
} else {
    echo "<script>
    alert('Error, Please try again.')
    window.location.href = 'dashboard.php'
</script>";
}
