<?php
    include('connection.php');
    $userName = $_COOKIE['login'];
    $login = filter_var(trim($_POST['login1']), FILTER_SANITIZE_STRING);
    $mail = filter_var(trim($_POST['mail']), FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    $desc = filter_var(trim($_POST['description']));
    $img_type = substr($_FILES['img']['type'], 0, 5);
    $img_size = 3*1024*1024;

    $result = $mysql->query("SELECT * FROM `aanton_twr` WHERE `login` = '$login'");
    $user = $result->fetch_assoc();

    $id = $user['id'];

    if (count($user) > 0 && $login != $userName) {
        setcookie('authError', "Nickname " . $login . " has already been taken!", time() + 3600, "/");
        $mysql->close();
        header('Location: /~aanton/prax4/reg.php');
        exit();
    }

    if (!empty($_FILES['img']['tmp_name']) and $img_type === "image") {
        $img = addslashes(file_get_contents($_FILES['img']['tmp_name']));
    }
    
    if (strlen($login) == 0 || strlen($login) > 15) {
        setcookie('authError', "Login is empty or too long!", time() + 3600, "/");
        $mysql->close();
        header('Location: /~aanton/prax4/reg.php');
        exit();
    }
    if (strlen($mail) == 0 || strlen($mail) > 30) {
        setcookie('authError', "Email is empty or too long!", time() + 3600, "/");
        $mysql->close();
        header('Location: /~aanton/prax4/reg.php');
        exit();
    }
    if (strlen($desc) == 0 || strlen($desc) > 1000) {
        echo strlen($desc);
        setcookie('authError', "Description is empty or too long!", time() + 3600, "/");
        $mysql->close();
        header('Location: /~aanton/prax4/reg.php');
        exit();
    }
    if (strlen($pass) == 0 || strlen($pass) > 15) {
        setcookie('authError', "Password is empty or too long!", time() + 3600, "/");
        $mysql->close();
        header('Location: /~aanton/prax4/reg.php');
        exit();
    }
    
    
    $pass = md5($pass);

    $mysql->query("UPDATE `aanton_twr` SET `pass` = '$pass' WHERE `id` = '$id'");
    $mysql->query("UPDATE `aanton_twr` SET `description` = '$desc' WHERE `id` = '$id'");
    $mysql->query("UPDATE `aanton_twr` SET `mail` = '$mail' WHERE `id` = '$id'");
    $mysql->query("UPDATE `aanton_twr` SET `img` = '$img' WHERE `id` = '$id'");
    $mysql->query("UPDATE `aanton_twr` SET `login` = '$login' WHERE `id` = '$id'");

    // -- (`login`, `pass`, `mail`, `img`,`description`) VALUES('$login', '$pass', '$mail', '$img', '$desc')");
    $mysql->close();
    setcookie('login', $user['login'], time() - 3600, "/");

    header('Location: /~aanton/prax4/login.php');
?>