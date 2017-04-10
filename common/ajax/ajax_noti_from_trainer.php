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

$where = "WHERE member_id = '{$_COOKIE['memberID']}' AND (notification_type = 'absent' OR notification_type = 'scoretrainer') AND notification_isread = 'no'";
$data = mysql_query("SELECT * FROM notification {$where} ORDER BY notification_datetime DESC");
while ($valData = mysql_fetch_assoc($data)){
    if ($valData['notification_type']=='absent'){
        $linkToEditAbsent = '<a href="index.php?page=student_diary_edit&diaryID='.$valData['notification_type_id'].'" class="btn btn-sm btn-primary">แจ้งสาเหตุการขาด</a>';
    }
    $json_data[]=array(
        "idnoti"=>$valData['notification_id'],
        "txttitle"=>$valData['notification_title'],
        "txtdate"=>$valData['notification_title_date'],
        "txtmessage"=>$valData['notification_message'],
        "txttype"=>$valData['notification_type'],
        "txtheadnoti"=>'แจ้งเตือนจากสถานประกอบการ',
        "linkabsent"=>$linkToEditAbsent
    );
}
$json= json_encode($json_data);
echo $json;
exit;
?>