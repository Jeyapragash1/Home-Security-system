<?php
require_once './classes/DbConnector.php';
require_once 'classes/visitor.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $visitorId = isset($_POST['visitorId']) ? intval($_POST['visitorId']) : 0;
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $date = isset($_POST['date']) ? trim($_POST['date']) : '';
    $time = isset($_POST['time']) ? trim($_POST['time']) : '';
    $reason = isset($_POST['reason']) ? trim($_POST['reason']) : '';
    $action_taken = isset($_POST['action_taken']) ? trim($_POST['action_taken']) : '';

    if ($visitorId && $name && $date && $time && $reason && $action_taken) {
        try {
            $dbcon = new DbConnector();
            $con = $dbcon->getConnection();
            $result = Visitor::editVisitor($con, $visitorId, $name, $date, $time, $reason, $action_taken);
            if ($result) {
                $_SESSION['success_message'] = "Visitor updated successfully.";
            } else {
                $_SESSION['error_message'] = "Failed to update visitor. Database operation returned false.";
            }
        } catch (Exception $e) {
            $_SESSION['error_message'] = "Error: " . $e->getMessage();
            error_log("Error in editProcess.php: " . $e->getMessage());
        }
    } else {
        $_SESSION['error_message'] = "Invalid or missing data.";
    }
} else {
    $_SESSION['error_message'] = "Invalid request method.";
}

header("Location: editVisitor.php");
exit();