<?php
require_once './classes/DbConnector.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}

$dbcon = new DbConnector();
$con = $dbcon->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $_SESSION['error_message'] = "New passwords do not match.";
    } else {
        $email = $_SESSION['email'];

        $query = "SELECT * FROM users WHERE email = ?";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $email);
        $pstmt->execute();

        $row = $pstmt->fetch(PDO::FETCH_OBJ);
        if (!empty($row) && password_verify($current_password, $row->password)) {
            $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);
            $update_query = "UPDATE users SET password = ? WHERE email = ?";
            $update_stmt = $con->prepare($update_query);
            $update_stmt->bindValue(1, $new_password_hash);
            $update_stmt->bindValue(2, $email);

            if ($update_stmt->execute()) {
                $_SESSION['success_message'] = "Password changed successfully.";
            } else {
                $_SESSION['error_message'] = "Error updating password. Please try again.";
            }
        } else {
            $_SESSION['error_message'] = "Current password is incorrect.";
        }
    }
    header("location: settings.php");
    exit();
}
?>
