<?php
session_start();
require_once 'classes/DbConnector.php';
require_once 'classes/visitor.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $reason = $_POST['reason'] ?? '';
    $action = $_POST['action'] ?? '';

    // Validate inputs (you can add more validation as needed)
    if (empty($name) || empty($date) || empty($time) || empty($reason) || empty($action)) {
        $_SESSION['error_message'] = "All fields are required";
        header("Location: visitorData.php");
        exit();
    }

    try {
        $visitor = new Visitor($name, $date, $time, $reason, $action);
        
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();        

        if ($visitor->addVisitor($con)) {
            $_SESSION['success_message'] = "Visitor data saved successfully";
        } else {
            $_SESSION['error_message'] = "Error saving visitor data";
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Database error: " . $e->getMessage();
    }
} else {
    $_SESSION['error_message'] = "Invalid request method";
}

// Redirect back to the visitor data page
header("Location: visitorData.php");
exit();