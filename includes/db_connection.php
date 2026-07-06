<?php
// DB connectivity
$conn = mysqli_connect("localhost:3308", "root", "");
$db = mysqli_select_db($conn, "voting");
