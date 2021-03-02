<?php 
include('connection.php');
// error_reporting(0);
// ini_set('display_errors', 0);
$user = $_COOKIE['login'];
$userToFollow =  $_COOKIE['toFollow'];
$userLower = strtolower($user);
$userToFollowLower = strtolower($userToFollow);
$resultFollow = $mysql->query("SELECT * FROM `aanton_followers` WHERE `kes` = '$user' AND `keda` = '$userToFollow'");
$userFollow = $resultFollow->fetch_assoc();

$rows = mysqli_num_rows($resultFollow);
echo $rows;
if ($rows == 1) {
    $mysql->query("DELETE FROM `aanton_followers` WHERE LOWER(`keda`) = '$userToFollow' AND LOWER(`kes`) = '$userLower'");
    header('Location: /~aanton/prax4/my_page.php');
    exit();
}
$mysql->query("INSERT INTO `aanton_followers` (`kes`, `keda`) VALUES('$user', '$userToFollow')");
$mysql->close();
setcookie('toFollow', $user['login'], time() - 3600, "/");
header('Location: /~aanton/prax4/my_page.php');
echo "inserted";
?>