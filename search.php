<?php
include('connection.php');
include('includes/header.php');
$currentUser = $_COOKIE['login'];
$search = ($_POST['search']);
$result = $mysql->query("SELECT * FROM `aanton_twr` WHERE `login` = '$search'");
$resultFollow = $mysql->query("SELECT * FROM `aanton_followers` WHERE `kes` = '$currentUser' AND `keda` = '$search'");
$user = $result->fetch_assoc();
$userFollow = $result->fetch_assoc();

$rows2 = mysqli_num_rows($resultFollow);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            $rows = mysqli_num_rows($result);
            if ($rows == 0):
        ?>
        <div class="tweets" style="background: red; text-align: center;">No Such User!</div>
                <?php  else: ?>
            <div class='tweets'>
                <p class="user">
                    <h1><?php echo $user['login']; ?></h1>
                    <?php
                        if (!isset($_COOKIE['login'])):
                    ?>
                    <?php
                        elseif (strtolower($_COOKIE['login']) != strtolower($search)):
                    ?>
                    <?php setcookie('toFollow', $user['login'], time() + 3600, "/"); ?>
                        <?php if ($rows2 == 0):?>
                            <div align=right> <a href="following.php"><button>Follow</button></a></div>
                        <?php else:?>
                            <div align=right> <a href="following.php"><button>Unfollow</button></a></div>
                        <?php endif;?>
                    <?php  endif; ?>
                    <img style="border-radius: 20%;" width="200" height="200" src="data:image/jpeg;base64, <?php echo base64_encode($user['img']);?>" alt ="">
                    <h1>About Myself:</h1>
                    <h2><?php echo $user['description']; ?></h2>
                </p>
            </div>
            <div class="tweets">
                <?php
                    if (!isset($_COOKIE['login'])):
                ?>
                <h1>My Clitts</h1>
                <?php 
                    $result = $mysql->query("SELECT * FROM `aanton_tweets` WHERE `sentBy` = '$search'");
                    $user = $result->fetch_assoc();
                    // echo sizeof($user);
                    $rows = mysqli_num_rows($result);
                    // print_r($result);
                    echo "<br>";
                    ?> <div class="tweets2"> <?php echo $user['tweetText']; ?></div> <?php
                    echo "<br>";
                    for ($x = 0; $x < $rows; $x++) {
                        $row = mysqli_fetch_row($result);
                        // echo $user['tweetText'];
                        if (!strlen($row[1]) == 0) {
                            ?> <div   class="tweets2"> <?php echo $row[1]; ?></div>  <?php
                            echo "<br>";
                        }
                    }
                    $mysql->close();
                ?>
                <?php
                    elseif (strtolower($_COOKIE['login']) != strtolower($search)):
                ?>
                <h1>My Clitts</h1>
                <?php 
                    $result = $mysql->query("SELECT * FROM `aanton_tweets` WHERE `sentBy` = '$search'");
                    $user = $result->fetch_assoc();
                    // echo sizeof($user);
                    $rows = mysqli_num_rows($result);
                    // print_r($result);
                    echo "<br>";
                    ?> <div class="tweets2"> <?php echo $user['tweetText']; ?>
                    <form action="retweet.php" method="post" align=right>
                    <textarea name="hide" style="display:none;"> <?php echo $user['tweetText']; ?> </textarea>
                    <p align=right style="display: inline;">
                        <input style="cursor: pointer;" type="submit" name="submit" value="Retweet">
                    </p>
                    </form>
                    </div> <?php
                    echo "<br>";
                    for ($x = 0; $x < $rows; $x++) {
                        $row = mysqli_fetch_row($result);
                        // echo $user['tweetText'];
                        if (!strlen($row[1]) == 0) {
                            ?> <div class="tweets2"> <?php echo $row[1]; ?>
                            <form action="retweet.php" method="post" align=right>
                            <textarea name="hide" style="display:none;"> <?php echo $row[1]; ?> </textarea>
                            <p align=right style="display: inline;">
                                <input style="cursor: pointer;" type="submit" name="submit" value="Retweet">
                            </p>
                            </form>
                            </div>  <?php
                            echo "<br>";
                        }
                    }
                    $mysql->close();
                ?>
                    <?php  else: ?>
                        <h1>My Clitts</h1>
                        <?php 
                            $result = $mysql->query("SELECT * FROM `aanton_tweets` WHERE `sentBy` = '$search'");
                            $user = $result->fetch_assoc();
                            // echo sizeof($user);
                            $rows = mysqli_num_rows($result);
                            // print_r($result);
                            echo "<br>" .'<div class="tweets2">' . $user['tweetText'] . '</div>';
                            echo "<br>";
                            for ($x = 0; $x < $rows; $x++) {
                                $row = mysqli_fetch_row($result);
                                if (!strlen($row[1]) == 0) {
                                    ?> <div class="tweets2"> <?php echo $row[1]; ?></div>  <?php
                                    echo "<br>";
                                }
                            }
                            $mysql->close();    
                        ?>
                <?php endif;?>
            </div>
        <?php endif;?>
    </body>
</html>