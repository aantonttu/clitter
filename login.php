<?php
include('includes/header.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title of the document</title>
    <style>
        a {
            text-align: center;
            display: block;
        }
    </style>
</head>
<body>
    <?php 
        if (!isset($_COOKIE['authError'])):
    ?>
    <?php else:
        ?> <div class="tweets" style="background: red; text-align: center;"><?php echo $_COOKIE["authError"]; 
        setcookie('authError', "User does not exist!", time() - 3600, "/");
        ?></div>

    <?php endif; ?>
    <?php
        if (!isset($_COOKIE['login'])):
    ?>
    <h1 align=center>Login</h1>
        <div>
            <form action="auth.php" method="post" align=center>
                <p>
                    <label>Nickname<br></label>
                    <input name="login1" type="text" size="15" maxlength="15">
                </p>

                <p>
                    <label>Password<br></label>
                    <input name="password" type="password" size="20" maxlength="20">
                </p>
                <p>
                    <input type="submit" name="submit" value="Login">
                </p>
            </form>
        </div>  
        <a href="reg.php">Sign Up</a>
        <?php  else: ?>
        <h1 align=center>You are already logged in as <?=$_COOKIE['login']?>!</h1>
        <h3 align=center>To log out press Log Out button in Navigation Bar.</h3>
    <?php endif;?>
</body>

</html>