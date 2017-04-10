<?php
//	session_start();
ob_start();
	require_once("../../config/dbconnection.php");

	$strSQL = "SELECT * FROM member WHERE member_username = '".$_POST['txtUsername']."' and member_password = '".$_POST['txtPassword']."'";
	$objQuery = mysql_query($strSQL);
	$memberResult = mysql_fetch_array($objQuery);

$username = $memberResult['member_username'];
$password = $memberResult['member_password'];
$id = $memberResult['member_id'];
$status = $memberResult['member_status'];

$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;

if ($_POST['txtUsername'] != '' && $_POST['txtPassword'] != ''){
    if ($_POST['txtUsername'] == $username && $_POST['txtPassword'] == $password){
        if ($_POST['rememberme'] != ''){
            setcookie('username',$username,time()+3600*24*356, '/', $domain, false);
            setcookie('memberID',$id,time()+3600*24*356, '/', $domain, false);
            setcookie('memberStatus',$status,time()+3600*24*356, '/', $domain, false);
        }else{
            setcookie('username',$username,time()+3600*24, '/', $domain, false);
            setcookie('memberID',$id,time()+3600*24, '/', $domain, false);
            setcookie('memberStatus',$status,time()+3600*24, '/', $domain, false);
        }
        $sql = "UPDATE member SET member_loginstatus = '1' , member_lastupdate = NOW() WHERE member_id = '".$id."' ";
        mysql_query($sql);
        header("refresh:1; url=../index.php");
    }else{
//        echo "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
        echo "<script>alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');</script>";
        echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    }
}else{
//    echo "กรุณากรอกข้อมูลให้ครบ";
    echo "<script>alert('กรุณากรอกข้อมูลให้ครบ');</script>";
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
}
//echo $_COOKIE['username'];

//    if(!$objResult)
//	{
//        echo "<script>alert('Username หรือรหัสผ่านไม่ถูกต้อง');</script>";
//        echo "<meta http-equiv='refresh' content='0;url=login.php'>";
//		exit();
//	}
//	else
//	{
//		if($objResult["member_loginstatus"] == "1")
//		{
//            echo "<script>alert('ผู้ใช้ ".$strUsername." กำลังใช้งานอยู่!');</script>";
//            echo "<meta http-equiv='refresh' content='0;url=login.php'>";
//			exit();
//		}
//		else
//		{
//			//*** Update Status Login
//			$sql = "UPDATE member SET member_loginstatus = '1' , member_lastupdate = NOW() WHERE member_id = '".$objResult["member_id"]."' ";
//			$query = mysql_query($sql);
//
//			//*** Session
//			$_SESSION['user'] = $objResult;
//			session_write_close();
//
//			//*** Go to Main page
//			header("refresh:1; url=../index.php");
//		}
//    }

include ("../load_page.html");


//$cookie_name = "my cookie";
//$cookie_value = "my value";
//$cookie_new_value = "my new value";
//
//// Create a cookie,
//setcookie($cookie_name, $cookie_value , time() + (86400 * 30), "/"); //86400 = 24 hours in seconds
//
//// Get value in a cookie,
//$cookie_value = $_COOKIE[$cookie_name];
//
//// Update a cookie,
//setcookie($cookie_name, $cookie_new_value , time() + (86400 * 30), "/");
//
//// Delete a cookie,
//setcookie($cookie_name, '' , time() - 3600, "/"); //  time() - 3600 means, set the cookie expiration date to the past hour.
?>