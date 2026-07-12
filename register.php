<?php
if (isset($_POST['register'])) {

    // DB connectivity
    include_once('includes/db_connection.php');

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
    $image = uniqid($name, true) . '.' . $ext;
    $img_path = "voters/images/" . $image;
    move_uploaded_file($_FILES['photo']['tmp_name'], $img_path);


    // Prepare and execute query
    $query = "INSERT INTO voters values(null,'$name', '$email', '$password', $mobile, '$image', '$address','No',1)";
    $result = $conn->query($query);
    if ($result) {
        echo "<script>
        alert('Voter Registered successfully..');
        </script>";
        header('location:login.php');
    } else {
        echo "<script>
            alert('Error, Please try again.');
            </script>";
        header('location:register.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- bootstrap file -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Header Part -->
    <div class="container-fluid header">
        <h3>Online Voting System</h3>
    </div>

    <!-- Registration Part -->
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-3 m-auto voter-login-form">
                <center>
                    <h4><u>Voter Registration Form</u></h4>
                </center>
                <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                        <span id="nameError" class="form-text"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                        <span id="emailError" class="form-text"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Your Password">
                        <span id="passError" class="form-text"></span>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile:</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile">
                        <span id="mobileError" class="form-text"></span>
                    </div>
                    <div class="form-group">
                        <label for="photo">Upload Photo:</label>
                        <input type="file" class="form-control" name="photo" id="photo" placeholder="Enter Photo">
                        <span id="photoError" class="form-text"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Address:</label>
                        <textarea class="form-control" id="address" name="address" rows="3" cols="46"></textarea>
                        <span id="addressError" class="form-text"></span>
                    </div>
                    <div class="container mt-4">
                        <button class="btn btn-primary" type="submit" name="register">Register</button>
                        <span class="mt-3">Already Register? </span><a href="login.php" class="link">Login here</a>
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