<?php
    include('connection.php');
    include('includes/header.php');
?>




<!DOCTYPE html>
<html>
    <head>
    <title>Register</title>
    </head>
    <body>
        <?php 
            if (!isset($_COOKIE['authError'])):
        ?>
        <?php else:
            ?> <div class="tweets" style="background: red; text-align: center;"><?php echo $_COOKIE["authError"]; 
            setcookie('authError', $_COOKIE["authError"], time() - 3600, "/");
            ?></div>

        <?php endif; ?>
        <h2 align=center>Sign Up</h2>
        <form action="save_user.php" method="post" enctype="multipart/form-data" align=center>
            <p>
                <label>Login<br></label>
                <input name="login1" type="text" size="15" maxlength="15">
            </p>
            <p>
                <label>E-mail<br></label>
                <input name="mail" type="email" size="30" maxlength="30">
            </p>
            <p>
                <label>Password<br></label>
                <input name="password" type="password" size="20" maxlength="20" required>
            </p>
            <p>
                <label>Profile Picture<br></label>
                <input type="file" name="img">
            </p>
            <p>
                <label>Write Something About Yourself<br></label>
                <textarea name="description" type="description" rows="10" cols="45">
                    
                </textarea>
            </p>
            <p>
                <input type="submit" name="submit" value="Sign Up">
            </p>
            
        </form>
    </body>
</html>