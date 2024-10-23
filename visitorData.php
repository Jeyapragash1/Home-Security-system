<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Security Dashboard</title>
        <!-- ======= Styles ====== -->

        <link href="css/dashboard.css" rel="stylesheet" type="text/css"/>
        <link href="css/maindash.css" rel="stylesheet" type="text/css"/>
        <link href="css/navbar.css" rel="stylesheet" type="text/css"/>
        <link href="css/visitorData.css" rel="stylesheet" type="text/css"/>


        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <?php
        session_start();

        if (isset($_SESSION['email'])) {
            $name = $_SESSION['name'];
        } elseif (isset($_COOKIE['u_name'])) {
            $name = $_COOKIE['name'];
        } else {
            header("location:login.php");
            exit();
        }


        $message = '';
        $messageType = '';

        if (isset($_SESSION['success_message'])) {
            $message = $_SESSION['success_message'];
            $messageType = 'success';
            unset($_SESSION['success_message']);
        } elseif (isset($_SESSION['error_message'])) {
            $message = $_SESSION['error_message'];
            $messageType = 'error';
            unset($_SESSION['error_message']);
        }
        ?>



    </head>




    <body>
        <!-- =============== Navigation ================ -->
        <div class="section" >
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
            <div>
                <div class="main" style="background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url('images/security.jpg');
                     background-size: cover;
                     background-position: right;
                     background-repeat: no-repeat;
                     background-attachment: fixed;
                     min-height: 100vh;
                     font-family: 'Arial', sans-serif;">
                    <div class="topbar">
                        <div class="toggle">
                            <ion-icon name="menu-outline"></ion-icon>
                        </div>
                    </div>

                    <div class="container" >
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <div class="form-container">
                                    <h1 class="text-center" id="formTitle">
                                        <i class=" me-2"></i>Add Visitor's Data
                                    </h1>
                                    <form id="dataForm" class="needs-validation" novalidate method="POST" action="saveVisitor.php">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">
                                                        <i class="fas fa-user me-2"></i>Name:
                                                    </label>
                                                    <input type="text" class="form-control" id="name" name="name" required placeholder="Enter visitor's name">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="date" class="form-label">
                                                        <i class="fas fa-calendar-alt me-2"></i>Date:
                                                    </label>
                                                    <input type="date" class="form-control" id="date" name="date" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="time" class="form-label">
                                                        <i class="fas fa-clock me-2"></i>Time:
                                                    </label>
                                                    <input type="time" class="form-control" id="time" name="time" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="reason" class="form-label">
                                                        <i class="fas fa-comment me-2"></i>Reason:
                                                    </label>
                                                    <textarea class="form-control" id="reason" name="reason" rows="4" required placeholder="Purpose of visit"></textarea>
                                                </div>

                                                <div class="mb-3 ">
                                                    <label for="action" class="form-label" style="margin-top: 14px">
                                                        <i class="fas fa-tasks me-2"></i>Action Taken:
                                                    </label>
                                                    <select class="form-select" id="action" name="action" required>
                                                        <option value="">Select action</option>
                                                        <option value="checked_in">Checked In</option>
                                                        <option value="checked_out">Checked Out</option>
                                                        <option value="reported">Reported</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="table-container mt-5">
                            <h1 class="text-center mb-4 mt-3">
                                <i class="fas fa-list-alt me-2"></i>Visitor Records
                            </h1>
                            <div class="table-responsive">
                                <table class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th><i class="fas fa-user me-2"></i>Name</th>
                                            <th><i class="fas fa-calendar-alt me-2"></i>Date</th>
                                            <th><i class="fas fa-clock me-2"></i>Time</th>
                                            <th><i class="fas fa-comment me-2"></i>Reason</th>
                                            <th><i class="fas fa-tasks me-2"></i>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="visitorTableBody">
                                        <?php
                                        require_once './classes/DbConnector.php';
                                        require_once 'classes/visitor.php';

                                        try {
                                            $dbcon = new DbConnector();
                                            $con = $dbcon->getConnection();

                                            $visitors = Visitor::getAllVisitors($con);

                                            if ($visitors === false) {
                                                echo "<tr><td colspan='5' class='text-center text-danger'>Error: Unable to fetch visitor data.</td></tr>";
                                            } elseif (empty($visitors)) {
                                                echo "<tr><td colspan='5' class='text-center'>No visitor records found.</td></tr>";
                                            } else {
                                                foreach ($visitors as $visitor) {
                                                    echo "<tr>";
                                                    echo "<td>" . htmlspecialchars($visitor['name']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($visitor['date']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($visitor['time']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($visitor['reason']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($visitor['action_taken']) . "</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        } catch (Exception $e) {
                                            echo "<tr><td colspan='5' class='text-center text-danger'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                                            error_log("Error: " . $e->getMessage());
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="messageModalLabel">Message</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="modalBody">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
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
<?php if (!empty($message)): ?>
                    var myModal = new bootstrap.Modal(document.getElementById('messageModal'));
                    var modalBody = document.getElementById('modalBody');
                    modalBody.textContent = <?php echo json_encode($message); ?>;
                    modalBody.classList.add(<?php echo json_encode($messageType); ?>);
                    myModal.show();
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