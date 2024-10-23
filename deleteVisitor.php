<?php
require_once './classes/DbConnector.php';
require_once 'classes/visitor.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $visitorId = intval($_GET['id']);

    try {
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();
        $result = Visitor::deleteVisitor($con, $visitorId);

        if ($result) {
            $_SESSION['success_message'] = "Visitor deleted successfully.";
        } else {
            $_SESSION['error_message'] = "Failed to delete visitor.";
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Error: " . $e->getMessage();
        error_log("Error in deleteVisitor.php: " . $e->getMessage());
    }
} else {
    $_SESSION['error_message'] = "Invalid request.";
}

header("Location: editVisitor.php");
exit();