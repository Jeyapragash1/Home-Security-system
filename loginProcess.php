<?php

require './classes/DbConnector.php';

session_start();

if (isset($_SESSION['email']) || isset($_COOKIE['u_name'])) {
    header("location:welcome.php");
    exit();
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $dbcon = new DbConnector();
    $con = $dbcon->getConnection();

    $query = "SELECT * FROM users WHERE email =?";

    try {
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $email);
        $pstmt->execute();

        $row = $pstmt->fetch(PDO::FETCH_OBJ);
        if (!empty($row)) {
            $pwdhash = $row->password;
            if (password_verify($password, $pwdhash)) {
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $row->name;

                if (isset($_POST['checkbox'])) {
                    setcookie('u_name', $row->username, time() + 30, '/');
                    setcookie('name', $row->name, time() + 30, '/');
                }

                header("location:dashboard.php");
                exit();
            } else {
                header("location:login.php?error=invalid_credentials");
                exit();
            }
        } else {
            header("location:login.php?error=invalid_credentials");
            exit();
        }
    } catch (Exception $ex) {
        die("Error!" . $ex->getMessage());
    }
}
?>
