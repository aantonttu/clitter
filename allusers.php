<?php
include('connection.php');
include('includes/header.php');
$result = $mysql->query("SELECT * FROM `aanton_twr`");
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <?php
    
    ?> 
    <h1>Here are all Usernames.</h1>
    <h3 >To visit their pages - enter Username to searchbox.</h3>
    <div class="tweets"> <?php echo $user['login']; ?></div> <?php
    echo "<br>";
    $rows = mysqli_num_rows($result);
    for ($x = 0; $x < $rows; $x++) {
            $row = mysqli_fetch_row($result);
            // echo $user['tweetText'];
            if (!strlen($row[1]) == 0) {
                ?> <div   class="tweets"> <?php echo $row[1]; ?></div>  <?php
                echo "<br>";
            }
        }
        $mysql->close();
    ?>
    </body>

</html>