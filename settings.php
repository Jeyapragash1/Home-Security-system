<?php
require_once './classes/DbConnector.php';
require_once 'classes/visitor.php';

session_start();

if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}

$dbcon = new DbConnector();
$con = $dbcon->getConnection();

$visitors = Visitor::getAllVisitors($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <!-- ======= Styles ====== -->

    <link href="css/dashboard.css" rel="stylesheet" type="text/css"/>
    <link href="css/maindash.css" rel="stylesheet" type="text/css"/>
    <link href="css/navbar.css" rel="stylesheet" type="text/css"/>
    <link href="css/editVisitor.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <?php
    if (isset($_SESSION['email'])) {
        $name = $_SESSION['name'];
    } elseif (isset($_COOKIE['u_name'])) {
        $name = $_COOKIE['name'];
    } else {
        header("location:login.php");
        exit();
    }
    ?>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="section">
        <div class="navigation">
            <ul>
                <li>
                    <a href="dashboard.php">
                        <span class="icon" style="color: #2a2185;">
                            <ion-icon name="cash-outline"></ion-icon>                                
                        </span>
                        <img src="images/logo.png" alt="" style="width: 150px; height: 50px; margin-top: 20px"/>
                    </a>
                </li>

                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <span class="material-symbols-outlined">dashboard</span>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="visitorData.php">
                        <span class="icon">
                            <ion-icon name="cash-outline"></ion-icon>
                        </span>
                        <span class="title">Visitors</span>
                    </a>
                </li>

                <li>
                    <a href="editVisitor.php">
                        <span class="icon">
                            <ion-icon name="card-outline"></ion-icon>
                        </span>
                        <span class="title">Edit</span>
                    </a>
                </li>

                <li>
                    <a href="settings.php">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="logout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Log Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            
            <div class="topbar">
                    <div class="toggle">
                        <ion-icon name="menu-outline"></ion-icon>
                    </div>
                </div>
            

           

            <form method="POST" action="settingProcess.php" style="padding: 20px">
                <h2>Change Password</h2>
                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>

            <!-- Error Modal -->
            <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="errorModalLabel">Error</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger" role="alert"><?php echo isset($_SESSION['error_message']) ? $_SESSION['error_message'] : ''; ?></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Modal -->
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="successModalLabel">Success</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-success" role="alert"><?php echo isset($_SESSION['success_message']) ? $_SESSION['success_message'] : ''; ?></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="js/js.js" type="text/javascript"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php if (isset($_SESSION['success_message'])): ?>
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error_message'])): ?>
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
            <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>
        });
    </script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>

</html>
