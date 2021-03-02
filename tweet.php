<?php
include('connection.php');
// require "my_page.php";
$tweet = htmlspecialchars($_POST['newtweet'], ENT_QUOTES, 'UTF-8');;
$tweetBy = $_COOKIE['login'];

$mysql = new mysqli('localhost', 'st2014', 'progress', 'st2014');
if (strlen($tweet) > 0){
    $mysql->query("INSERT INTO `aanton_tweets` (`sentBy`, `tweetText`) VALUES('$tweetBy', '$tweet')");
    $mysql->close();
    header('Location: /~aanton/prax4/my_page.php');    
    exit();
}
?>