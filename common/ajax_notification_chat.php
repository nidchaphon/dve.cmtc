<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/23/2017 AD
 * Time: 16:21
 */

header("Content-type:application/json; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
require_once("../config/dbconnection.php");
$sql = "
SELECT COUNT(IF(chat.chat_status='1',chat.chat_id,NULL)) AS noneRead FROM teacher INNER JOIN chat ON (teacher.member_id=chat_user2)
";
$result = mysql_query($sql);
if($result && mysql_num_rows($result) > 0){
    $row = mysql_fetch_assoc($result);
    $json_data_teacher[] = array(
        "num_total" => $row['noneRead']
    );
}
// แปลง array เป็นรูปแบบ json string
if(isset($json_data_teacher)){
    $json_teacher= json_encode($json_data_teacher);
    if(isset($_GET['callback']) && $_GET['callback']!=""){
        echo $_GET['callback']."(".$json_teacher.");";
    }else{
        echo $json_teacher;
    }
}

?>