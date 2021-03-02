<?php
include('connection.php');
global $USER_ERROR;
$login = filter_var(trim($_POST['login1']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

$pass = md5($pass);

$result = $mysql->query("SELECT * FROM `aanton_twr` WHERE `login` = '$login' AND `pass` = '$pass'");

$user = $result->fetch_assoc();

if (count($user) == 0) {
    setcookie('authError', "User does not exist!", time() + 3600, "/");
    $mysql->close();
    header('Location: /~aanton/prax4/login.php');
    exit();
}

setcookie('login', $user['login'], time() + 3600, "/");
setcookie('id', $user['id'], time() + 3600, "/");
setcookie('desc', $user['description'], time() + 3600, "/");

$mysql->close();
header('Location: /~aanton/prax4/my_page.php');
?>