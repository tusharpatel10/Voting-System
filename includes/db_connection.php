<?php
// DB connectivity
$conn = new mysqli("localhost:3308", "root", "", "voting");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
