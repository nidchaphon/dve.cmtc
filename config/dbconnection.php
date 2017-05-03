<?php
/**
 * User: nidchaphon
 * Date: 12/13/2016 AD
 * Time: 22:17
 */

$host = "localhost";
$username = "jtoosystem";
$password = "dve2560";
$database = "jtoosystem";

$connect = mysql_connect($host,$username,$password) or die ("<center>ไม่สามารถเชื่ออมต่อฐานข้อมูลได้</center>");
$select_db = mysql_select_db($database,$connect) or die ("<center>ไม่พบฐานข้อมูล</center>");

mysql_query("SET NAMES utf8",$connect);
mysql_query("SET character_set_connection=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_resiles=utf8");

date_default_timezone_set('Asia/Bangkok');


//--------อัพเดตเวลาใช้งานล่าสุดของ Member----------//
$intRejectTime = 10; // Minute
mysql_query("UPDATE member SET member_loginstatus = '0',member_lastupdate = NOW()  WHERE 1 AND member_id = '{$_COOKIE['memberID']}' AND DATE_ADD(member_lastupdate, INTERVAL $intRejectTime MINUTE) <= NOW()") or die(mysql_error());

//----------อัพเดตสถานะการนิเทศของอาจารย์------------//
//$resultAppointment = mysql_query("SELECT * FROM appointment");
//while ($valAppointment = mysql_fetch_assoc($resultAppointment)){
//    if ($valAppointment['appointment_date'] <= date("Y-m-d") && $valAppointment['appointment_time'] <= date("H:i:s")){
//        mysql_query("UPDATE appointment SET appointment_status = '1', appointment_student_status = '1', appointment_trainer_status = '1' WHERE appointment_id = '{$valAppointment['appointment_id']}'") or die(mysql_error());
//        mysql_query("UPDATE notification SET notification_datetime = '".date("Y-m-d H:i:s")."', notification_isread = 'yes' WHERE notification_type_id = '{$valAppointment['appointment_id']}'");
//        mysql_query("DELETE FROM notification WHERE notification_type_id = '{$valAppointment['appointment_id']}'");
//    }
//}