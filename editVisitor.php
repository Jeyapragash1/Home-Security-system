<?php
require_once './classes/DbConnector.php';
require_once 'classes/visitor.php';

session_start();

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
        <title>Edit Visitor</title>
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
        require_once './classes/DbConnector.php';
        require_once 'classes/visitor.php';



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

                        <div class="table-container ">
                            <h1 class="text-center mb-4 mt-3">
                                <i class="fas fa-list-alt me-2"></i>Edit Visitor Records
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
                                            <th><i class="me-2"></i>edit</th>
                                        </tr>
                                    </thead>
                                    <tbody id="visitorTableBody">
                                        <?php foreach ($visitors as $visitor): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($visitor['name']); ?></td>
                                                <td><?php echo htmlspecialchars($visitor['date']); ?></td>
                                                <td><?php echo htmlspecialchars($visitor['time']); ?></td>
                                                <td><?php echo htmlspecialchars($visitor['reason']); ?></td>
                                                <td><?php echo htmlspecialchars($visitor['action_taken']); ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editVisitorModal" 
                                                            data-id="<?php echo $visitor['visitorId']; ?>"
                                                            data-name="<?php echo htmlspecialchars($visitor['name']); ?>"
                                                            data-date="<?php echo $visitor['date']; ?>"
                                                            data-time="<?php echo $visitor['time']; ?>"
                                                            data-reason="<?php echo htmlspecialchars($visitor['reason']); ?>"
                                                            data-action="<?php echo htmlspecialchars($visitor['action_taken']); ?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" 
                                                            data-id="<?php echo $visitor['visitorId']; ?>">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Visitor Modal -->
                    <div class="modal fade" id="editVisitorModal" tabindex="-1" aria-labelledby="editVisitorModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editVisitorModalLabel">Edit Visitor</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editVisitorForm" action="editProcess.php" method="POST">
                                        <input type="hidden" id="editVisitorId" name="visitorId">
                                        <div class="mb-3">
                                            <label for="editName" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="editName" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editDate" class="form-label">Date</label>
                                            <input type="date" class="form-control" id="editDate" name="date" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editTime" class="form-label">Time</label>
                                            <input type="time" class="form-control" id="editTime" name="time" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editReason" class="form-label">Reason</label>
                                            <textarea class="form-control" id="editReason" name="reason" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editActionTaken" class="form-label">Action Taken</label>
                                            <select class="form-select" id="editActionTaken" name="action_taken" required>
                                                <option value="">Select action</option>
                                                <option value="checked_in">Checked In</option>
                                                <option value="checked_out">Checked Out</option>
                                                <option value="reported">Reported</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this visitor record?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>


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
        </div>

        <!-- =========== Scripts =========  -->
        <script src="js/js.js" type="text/javascript"></script>
        <script>
            document.getElementById('editVisitorModal').addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                var name = button.getAttribute('data-name');
                var date = button.getAttribute('data-date');
                var time = button.getAttribute('data-time');
                var reason = button.getAttribute('data-reason');
                var action = button.getAttribute('data-action');

                var modal = this;
                modal.querySelector('#editVisitorId').value = id;
                modal.querySelector('#editName').value = name;
                modal.querySelector('#editDate').value = date;
                modal.querySelector('#editTime').value = time;
                modal.querySelector('#editReason').value = reason;

                // Update the action taken select element
                var actionSelect = modal.querySelector('#editActionTaken');
                if (actionSelect) {
                    for (var i = 0; i < actionSelect.options.length; i++) {
                        if (actionSelect.options[i].value === action) {
                            actionSelect.options[i].selected = true;
                            break;
                        }
                    }
                }
            });
        </script>

        <script>
            let visitorIdToDelete = null;

            document.getElementById('deleteConfirmModal').addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                visitorIdToDelete = button.getAttribute('data-id');
            });

            document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
                if (visitorIdToDelete) {
                    window.location.href = 'deleteVisitor.php?id=' + visitorIdToDelete;
                }
            });
        </script>

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






