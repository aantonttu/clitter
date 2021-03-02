<?php
include('connection.php');
$user = $_COOKIE['login'];
$retweet = ($_POST['hide']);

$retweetChanged = "Retweeted from " . $_COOKIE['toFollow'] . ": " . $retweet;

$mysql->query("INSERT INTO `aanton_tweets` (`sentBy`, `tweetText`) VALUES('$user', '$retweetChanged')");
$mysql->close();
header('Location: /~aanton/prax4/my_page.php');    
exit();