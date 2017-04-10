<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/13/2016 AD
 * Time: 23:23
 */
ob_start();

require_once("../../config/dbconnection.php");

$sqlUpdateLoginStatus = "UPDATE member SET member_loginstatus = '0' WHERE member_id = '".$_COOKIE['memberID']."' ";
mysql_query($sqlUpdateLoginStatus);

unset($_COOKIE['username']);
unset($_COOKIE['memberID']);
unset($_COOKIE['memberStatus']);
setcookie('username','', time() - 3600, "/");
setcookie('memberID','', time() - 3600, "/");
setcookie('memberStatus','', time() - 3600, "/");

header("location:login.php");
ob_end_flush();
?>