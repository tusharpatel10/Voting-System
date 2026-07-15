<?php
$update = false;
session_start();
include("../includes/db_connection.php");
$vid = $_GET['id'];
if (isset($_POST['update'])) {
    // Get From Data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    $query = "UPDATE voters set name='$name', email='$email',mobile=$mobile,address='$address' where id = $vid";
    $result = $conn->query($query);

    if ($result) {
        echo "<script type='text/javascript'>
        alert('Voter updated successfully..');
        window.location.href = 'dashboard.php';</script>";
        $update = true;
    } else {
        echo "Something went wrong.";
    }
}
$query = "SELECT * FROM voters where id = $_GET[id]";
$result = $conn->query($query);
$voter = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- External CSS -->
    <link rel="stylesheet" href="../voters/style.css">
    <!-- bootstrap file -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Alert Message Functionalities -->
    <?php
    if ($result) {
        echo "<div id='autoCloseAlert' class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Update!</strong> Profile Updated Successfully.!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
    ?>
    <script>
        // Wait for the DOM to completely load
        document.addEventListener("DOMContentLoaded", function() {
            const alertElement = document.getElementById("autoCloseAlert");
            if (alertElement) {
                // Set a timer for 3000 milliseconds (3 seconds)
                setTimeout(function() {
                    // Fetch or initialize the Bootstrap Alert instance
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alertElement);
                    // Programmatically close the alert and remove it from the DOM
                    bsAlert.close();
                }, 3000);
            }
        });
    </script>



    <div class="container">
        <div class="row">
            <div class="col-md-4 mt-4 m-auto" id="edit-profile">
                <center>
                    <h4><u>Edit Voter Profile</u></h4>
                </center>
                <form action="" method="post" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $voter['name']; ?>">
                        <span id="nameError" class="form-text"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $voter['email'] ?>">
                        <span id="emailError" class="form-text"></span>
                    </div>

                    <div class="form-group">
                        <label for="mobile">Mobile:</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $voter['mobile'] ?>">
                        <span id="mobileError" class="form-text"></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Address:</label>
                        <textarea class="form-control" id="address" name="address" rows="3" cols="46"><?php echo $voter['address'] ?></textarea>
                        <span id="addressError" class="form-text"></span>
                    </div>
                    <div class="container mt-4">
                        <button class="btn btn-primary mt-2" type="submit" name="update">Update</button>
                        <a href="dashboard.php" class="btn btn-success mt-2 ms-3">Go to Dashboard</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    function validateForm() {
        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value;
        const mobile = document.getElementById("mobile").value;
        const photo = document.getElementById("photo").value.trim();
        const address = document.getElementById("address").value.trim();

        const nameReg = /^[a-zA-Z\s-]+$/;
        // const emailReg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const emailReg = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
        const mobileReg = /^[6-9]\d{9}$/;
        const passwordReg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;

        let isValid = true;

        // Clear previous messages
        document.querySelectorAll(".form-text").forEach(span => {
            span.innerText = "";
            span.classList.remove("text-danger", "text-success");
        });

        // Name
        if (name === "") {
            showError("nameError", "Name is required.");
            isValid = false;
        } else if (!nameReg.test(name)) {
            showError("nameError", "Name should contain only letters.");
            isValid = false;
        } else {
            showSuccess("nameError", "Valid name.");
        }

        // Email
        if (email === "") {
            showError("emailError", "Email is required.");
            isValid = false;
        } else if (!emailReg.test(email)) {
            showError("emailError", "Invalid email address.");
            isValid = false;
        } else {
            showSuccess("emailError", "Valid email.");
        }

        // Password
        if (password === "") {
            showError("passError", "Password is required.");
            isValid = false;
        } else if (!passwordReg.test(password)) {
            showError(
                "passError",
                "Password must be at least 8 characters and contain uppercase, lowercase, and a number."
            );
            isValid = false;
        } else {
            showSuccess("passError", "Strong password.");
        }

        // Mobile
        if (mobile === "") {
            showError("mobileError", "Mobile number is required.");
            isValid = false;
        } else if (!mobileReg.test(mobile)) {
            showError("mobileError", "Enter a valid 10-digit Indian mobile number.");
            isValid = false;
        } else {
            showSuccess("mobileError", "Valid mobile number.");
        }

        // Photo
        if (photo === "") {
            showError("photoError", "Please upload a photo.");
            isValid = false;
        } else {
            showSuccess("photoError", "Photo selected.");
        }

        // Address
        if (address === "") {
            showError("addressError", "Address is required.");
            isValid = false;
        } else {
            showSuccess("addressError", "Valid address.");
        }

        return isValid;
    }

    function showError(id, message) {
        const element = document.getElementById(id);
        element.innerText = message;
        element.classList.add("text-danger");
        element.classList.remove("text-success");
    }

    function showSuccess(id, message) {
        const element = document.getElementById(id);
        element.innerText = message;
        element.classList.add("text-success");
        element.classList.remove("text-danger");
    }
</script>

</html>