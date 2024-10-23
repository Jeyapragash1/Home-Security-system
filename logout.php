<?php

session_start();
session_unset();
session_destroy();

setcookie('u_name', '', time()-30, '/');
setcookie('name', '', time()-30, '/');

header("location:login.php");