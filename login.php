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
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="text" class="form-control" name="password" placeholder="Your Password" required>
                    </div>
                    <div class="container mt-4">
                        <button class="btn btn-primary" type="submit" name="login">Login</button>
                        <span class="mt-3">Haven't Registered yet? </span><a href="register.php">Register Here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>