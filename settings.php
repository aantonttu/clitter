<?php
    include('connection.php');
    include('includes/header.php');
?>




<!DOCTYPE html>
<html>
    <head>
    <title>Settings</title>
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
        <h2 align=center>Settings</h2>
        <form action="save_settings.php" method="post" enctype="multipart/form-data" align=center>
            <p>
                <label>Change Login<br></label>
                <input name="login1" type="text" size="15" maxlength="15">
            </p>
            <p>
                <label>Change E-mail<br></label>
                <input name="mail" type="email" size="30" maxlength="30">
            </p>
            <p>
                <label>Change Password<br></label>
                <input name="password" type="password" size="20" maxlength="20" required>
            </p>
            <p>
                <label>Change Profile Picture<br></label>
                <input type="file" name="img">
            </p>
            <p>
                <label>Change Description<br></label>
                <textarea name="description" type="description" rows="10" cols="45">
                    
                </textarea>
            </p>
            <p>
                <input type="submit" name="submit" value="Confirm">
            </p>
            
        </form>
    </body>
</html>