<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 2/22/2017 AD
 * Time: 01:33
 */

require_once("../../config/dbconnection.php");
header("Content-type:text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

$where = "WHERE member_id = '{$_COOKIE['memberID']}' AND notification_type = 'appointment' AND notification_isread = 'no'";
$data = mysql_query("SELECT * FROM notification {$where} ORDER BY notification_datetime DESC");
while ($valData = mysql_fetch_assoc($data)){
    if ($valData['notification_type']=='appointment'){
        $headNoti = "แจ้งเตือนจากอาจารย์นิเทศ";
    }if ($valData['notification_type']=='absent'){
        $headNoti = "แจ้งเตือนจากสถานประกอบการ";
    }if ($valData['notification_type']=='leave'){
        $headNoti = "แจ้งเตือนจากนักศึกษาฝึกงาน";
    }
    $json_data[]=array(
        "idnoti"=>$valData['notification_id'],
        "txttitle"=>$valData['notification_title'],
        "txtdate"=>$valData['notification_title_date'],
        "txtmessage"=>$valData['notification_message'],
        "txttype"=>$valData['notification_type'],
        "txtheadnoti"=>'แจ้งเตือนจากอาจารย์นิเทศ'
    );
}
$json= json_encode($json_data);
echo $json;
exit;
?>