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
                <form action="">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="text" class="form-control" name="password" placeholder="Your Password" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile:</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Mobile" required>
                    </div>
                    <div class="form-group">
                        <label for="photo">Upload Photo:</label>
                        <input type="file" class="form-control" name="photo" placeholder="Enter Photo" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Address:</label>
                        <textarea class="form-control" name="address" rows="3" cols="46" id=""></textarea>
                    </div>
                    <div class="container mt-4">
                        <button class="btn btn-primary" type="submit" name="register">Register</button>
                        <span class="mt-3">Already Register? </span><a href="login.php">Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>