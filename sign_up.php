<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Bootstrap demo</title>
        <link rel="stylesheet" href="css/login.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    </head>

    <body>
        <div class="row vh-100 g-0">
            <!--left side-->
            <div class="col-lg-6 position-relative d-none d-lg-block">
                <p class="text-white position-absolute top-50 start-50 translate-middle fs-1 fw-bold text-center">
                    <a href="index.php" class="sentinel-safe-link">Sentinel Safe</a>
                </p>
                <p class="text-white position-absolute top-50 start-50 translate-middle fs-5 text-center mt-5">Your Gateway to Home Security</p>
                <div class="bg-holder" alt="" style="background-image: url('images/in.jpg');"></div>
            </div>

            <!--right side-->
            <div class="col-lg-6 d-flex align-items-center justify-content-center" style="padding: 20px">
                <div class="col-12 col-sm-8 col-lg-6">
                    <div class="text-center mb-5 mt-3">
                        <h3 class="fw-bold">Sign up</h3>
                        <p class="text-secondary">Create your account.</p>
                    </div>

                    <!--form-->
                    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">User Name</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>                                
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">Sign up</button>
                    </form>

                    <div class="text-center">
                        <small>Already have an account? <a href="login.php" class="fw-bold" style="text-decoration: none;">Login</a></small>
                    </div>

                    <div>
                        <?php
                        require './classes/DbConnector.php';

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $name = $_POST['name'];
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                            $dbcon = new DbConnector();
                            $con = $dbcon->getConnection();

                            // First, check if the email already exists
                            $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
                            $checkStmt = $con->prepare($checkEmailQuery);
                            $checkStmt->bindParam(1, $email);
                            $checkStmt->execute();

                            if ($checkStmt->rowCount() > 0) {
                                // Email already exists, show error message
                                echo "<div class='alert alert-danger mt-3'>This email is already registered. Please use a different email or <a href='login.php' style='text-decoration: none'>login</a>.</div>";
                            } else {
                                // Email doesn't exist, proceed with registration
                                $query = "INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)";
                                $stmt = $con->prepare($query);

                                $stmt->bindParam(1, $name);
                                $stmt->bindParam(2, $username);
                                $stmt->bindParam(3, $email);
                                $stmt->bindParam(4, $password);

                                if ($stmt->execute()) {
                                    echo "<div class='alert alert-success mt-3'>Sign up successful. You can now <a href='login.php' style='text-decoration: none'>Login</a></div>";
                                } else {
                                    echo "<div class='alert alert-danger mt-3'>Sign up failed. Please try again</div>";
                                }
                            }
                        }
                        ?>
                    </div>



                </div>
            </div>
        </div>







        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    </body>

</html>
