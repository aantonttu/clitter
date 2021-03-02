<?php
include('connection.php');
error_reporting(0);
ini_set('display_errors', 0);
setcookie('login', $user['login'], time() - 3600, "/");
include('includes/header.php');
header('Location: /~aanton/prax4/index.php');
?>