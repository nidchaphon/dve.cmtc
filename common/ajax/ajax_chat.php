<?php
ob_start();
session_start();
include("../../config/dbconnection.php");
include("../../config/php_config.php");

$user1 = $_COOKIE['memberID'];
$user2 = $_SESSION['memberID2'];

$dateNow = date("Y-m-d");

// ถ้ามี session ของคนที่กำลังใช้งานอยู่ และมีค่า id ของคนที่เป็นจะส่งไปหา และข้อความไม่ว่าง ส่งมาเพิ่มข้อมูล
if($user1 != "" && $user2 != "" && isset($_POST['msg']) && $_POST['msg']!="" ){

    if($_FILES['img']['name']!="") {
        $imgName = UpImg($_FILES['img'], "../../images/message/");

        $sqlInsertChat = "
	INSERT INTO chat SET 
	chat_msg='" . $_POST['msg'] . "',
	chat_user1='" . $user1 . "',  
	chat_user2='" . $_POST['user2'] . "',
	chat_date='" . date("Y-m-d") . "',
	chat_time='" . date("H:i:s") . "',
	chat_status = '0',
	chat_image = '$imgName'
	";
    }else{
        $sqlInsertChat = "
	INSERT INTO chat SET 
	chat_msg='" . $_POST['msg'] . "',
	chat_user1='" . $user1 . "',  
	chat_user2='" . $_POST['user2'] . "',
	chat_date='" . date("Y-m-d") . "',
	chat_time='" . date("H:i:s") . "',
	chat_status = '0'
	";
    }
    mysql_query($sqlInsertChat);
    exit;
}
// ส่งค่ามาเพื่อรับข้อมูลไปแสดง

if(isset($_POST['viewData']) && $_POST['viewData']!=""){
    header("Content-type:application/json; charset=UTF-8");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);

    $sqlUpdateChat="UPDATE chat SET chat_status = '1' WHERE chat_user1='".$user2."' AND chat_user2='".$user1."'";
    mysql_query($sqlUpdateChat);

    if($_POST['viewData']==1){ // เงื่อนไขกรณีส่งค่ามาครั้งแรก แสดงรายการทั้งหมดที่มีอยู่
        // กำหนดเงื่อนไขคำสั่งแสดงรายการทั้งหมดของคู่สนทนา
        $sqlGetChat="
		SELECT * FROM chat WHERE chat_id>'".$_POST['maxID']."' AND
		(
			(chat_user1='".$user1."' AND chat_user2='".$user2."') OR 
			(chat_user1='".$user2."' AND chat_user2='".$user1."')
		)
		ORDER BY chat_id 
		";
//        $sqlUpdateChat="UPDATE chat SET chat_status = '1' WHERE chat_user1='".$user2."' AND chat_user2='".$user1."'";
    }else{ // แสดงทีละรายการกรณีเริ่มสนทนา
        // กำหนดเงื่อนไขแสดงรายการล่าสุดที่ละ 1 รายการที่มีการเพิ่มเข้ามาใหม่
        $sqlGetChat="
		SELECT * FROM chat WHERE chat_id>'".$_POST['maxID']."' AND
		(
			(chat_user1='".$user1."' AND chat_user2='".$user2."') OR 
			(chat_user1='".$user2."' AND chat_user2='".$user1."')
		)	
		ORDER BY chat_id LIMIT 1
		";
    }

    $lsitChat = mysql_query($sqlGetChat);
    if($lsitChat){
        while($valChat = mysql_fetch_assoc($lsitChat)){
            $json_data[]=array(
                "max_id"=>$valChat['chat_id'],
                "data_align"=>($user1==$valChat['chat_user1'])?"right":"left",// ถ้าเป็นข้อความที่ส่งจากผู้ใช้ขณะนั้น
                "data_color"=>($user1==$valChat['chat_user1'])?"#EEEEEE":"rgba(231,76,60,0.23)",// ถ้าเป็นข้อความที่ส่งจากผู้ใช้ขณะนั้น
                "data_msg"=>nl2br($valChat['chat_msg']),
                "data_date"=>DBThaiLongDate($valChat['chat_date']),
                "data_time"=>timeThai($valChat['chat_time']),
                "data_date"=>DBThaiShortDate($valChat['chat_date']),
                "data_status"=>($valChat['chat_status']=='1' and $user1==$valChat['chat_user1'])?"<i class='fa fa-check' aria-hidden='true'></i> อ่านแล้ว":""
            );
        }
    }
    $json =json_encode($json_data);
    echo $json;// ส่งค่ากลับเป็น json object
    exit;
}