<?php
include('connection.php');
include('includes/header.php');

            
error_reporting(0);
ini_set('display_errors', 0);

if (isset($_COOKIE['login'])) {
    $login = $_COOKIE['login'];
}
else {
    $login = "";
}
if (isset($_COOKIE['desc'])) {
    $desc = $_COOKIE['desc'];
}
if (isset($_FILES['img']['type'])) {
    $img_type = $_FILES['img']['type'];
}
$result = $mysql->query("SELECT * FROM `aanton_twr` WHERE `login` = '$login'");
$user = $result->fetch_assoc();
$resultFollow = $mysql->query("SELECT * FROM `aanton_followers` WHERE `kes` = '$login'");
$userFollow = $resultFollow->fetch_assoc();
            
            

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
</head>
<body>
    <script src="script.js"></script>
    <div class='tweets'>
        <?php
            if (!isset($_COOKIE['login'])):
        ?>
        <h1 align=center>You are not logged in!</h1>
        <h3 align=center>To visit your page please log in.</h3>
            <?php  else: ?>
            <div align=right><a href="settings.php"><button>Settings</button></a></div>
            <p class="user">
                <h1><?php echo $login; ?></h1>
                <img style="border-radius: 20%;" width="200" height="200" src="data:image/jpeg;base64, <?php echo base64_encode($user['img']);?>" alt ="">
                <h1>About Myself:</h1>
                <h2><?php echo $desc; ?></h2>
            </p>
            <div align=right><a href="logout.php"><button>Log out</button></a></div>
        <?php endif;?>
    </div>

    <?php
            if (!isset($_COOKIE['login'])):
    ?>   
    <?php else:?>         
    <div class='tweets'>
        <h1>Following</h1>
        <?php
        ?> <div class="tweets2"> <?php echo $userFollow['keda']; ?></div> <?php
        $rows = mysqli_num_rows($resultFollow);
        echo "<br>";
        for ($x = 0; $x < $rows; $x++) {
            $row = mysqli_fetch_row($resultFollow);
            // echo $user['tweetText'];
            if (!strlen($row[2]) == 0) {
                ?> <div   class="tweets2"> <?php echo $row[2]; ?></div>  <?php
                echo "<br>";
            }
        }
        ?>
    </div>
    <?php endif;?>


    <?php
        if (!isset($_COOKIE['login'])):
    ?>
        <?php  else: ?>
    <div class="tweets">
    <h1>New Clitt</h1>
    <form action="tweet.php" method="post">
        <textarea name="newtweet" cols="100" rows="10"></textarea>
        <p align=right>
            <input type="submit" name="submit" value="Clitt">
        </p>
    </form>
    <?php
    $tweet = $_POST['newtweet'];
    $tweet2 = stripslashes($tweet);
    $tweetFiltered = htmlspecialchars($tweet2);
    ?>
    </div>


    <div class="tweets">
    <h1>My Clitts</h1>
        <?php 
            $login = $_COOKIE['login'];
            $result = $mysql->query("SELECT * FROM `aanton_tweets` WHERE `sentBy` = '$login'");
            $user = $result->fetch_assoc();
            // echo sizeof($user);
            $rows = mysqli_num_rows($result);
            // print_r($result);
            echo "<br>" .'<div class="tweets2">' . $user['tweetText'] . '</div>';
            echo "<br>";
            for ($x = 0; $x < $rows; $x++) {
                $row = mysqli_fetch_row($result);
                // echo $user['tweetText'];
                if (!strlen($row[1]) == 0) {
                    echo '<div class="tweets2">' . $row[1] . '</div>';
                    echo "<br>";
                }
            }
            $mysql->close();
        ?>
    </div>
    <?php endif;?>
</body>

</html>