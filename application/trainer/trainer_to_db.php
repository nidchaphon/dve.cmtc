<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/20/2016 AD
 * Time: 23:50
 */
ob_start();

include ("../../config/dbconnection.php");
include ("../../config/php_config.php");
include ("../../common/class/student/class.student.php");
include ("../../common/class/teacher/class.teacher.php");
include ("../../common/class/company/class.company.php");
include ("../../common/class/trainer/class.trainer.php");

$classStudent = new Student();
$classTeacher = new Teacher();
$classTrainer = new Trainer();
$classCompany = new Company();

$valStudent = $classStudent->GetDetailStudent($_GET['memberID'],$_GET['studentID']);
$valTeacher = $classTeacher->GetDetailTeacher('',$valStudent['teacher_id']);
$valTeacher2 = $classTeacher->GetDetailTeacher('',$valStudent['teacher2_id']);
$valCompany = $classCompany->GetDetailCompany($valStudent['company_id']);

$memberID = $_COOKIE['memberID'];

if (isset($_POST['editTrainer'])){

    if($_FILES['file']['name']!=""){
        unlink("../../images/member/".$_POST['txtPicture']."");
        $imgName=UpImg($_FILES['file'],"../../images/member/");
        $sqlUpdateImgTrainer = "UPDATE trainer SET trainer_picture = '".$imgName."' WHERE member_id = '$memberID'";
        mysql_query($sqlUpdateImgTrainer) or die(mysql_error());
    }

    $sqlUpdateTrainer = "UPDATE trainer SET
                    trainer_prefix = '".$_POST['txtPrefix']."',
                    trainer_firstname = '".$_POST['txtFirstname']."',
                    trainer_lastname = '".$_POST['txtLastname']."',
                    trainer_rank = '".$_POST['txtRank']."',
                    trainer_tel = '".$_POST['txtTel']."',
                    trainer_email = '".$_POST['txtEmail']."',
                    company_id = '".$_POST['txtCompany']."'
                  WHERE member_id = '$memberID'";
    mysql_query($sqlUpdateTrainer) or die(mysql_error());

    header("refresh:1; url=../index.php?page=trainer_profile");
}

if (isset($_POST['updateScoreStudent'])){
    $sqlUpdateScoreStudent = "UPDATE score SET
                                score_trainer_1_1 = '".$_POST['num11']."',
                                score_trainer_1_2 = '".$_POST['num12']."',
                                score_trainer_1_3 = '".$_POST['num13']."',
                                score_trainer_2_1 = '".$_POST['num21']."',
                                score_trainer_2_2 = '".$_POST['num22']."',
                                score_trainer_3_1 = '".$_POST['num31']."',
                                score_trainer_rate1 = '".$_POST['radioRate1']."',
                                score_trainer_rate2 = '".$_POST['radioRate2']."',
                                score_trainer_rate3 = '".$_POST['radioRate3']."',
                                score_trainer_counsel = '".$_POST['txtCounsel']."',
                                trainer_id = '".$_POST['txtTrainerID']."'
                              WHERE student_id = '".$_GET['studentID']."'
                              ";
    mysql_query($sqlUpdateScoreStudent) or die(mysql_error($sqlUpdateScoreStudent));

    mysql_query("UPDATE student SET student_score_trainer = 'yes' WHERE student_id = '{$_GET['studentID']}'");

    $getMaxIDDiary = "SELECT MAX(score_id) AS maxID FROM score";
    $resultMaxID = mysql_query($getMaxIDDiary);
    $valMaxID = mysql_fetch_assoc($resultMaxID);

    if ($valStudent['student_sex'] == 'male') {
        $prefix = "นาย";
    }elseif ($valStudent['student_sex'] == 'female'){
        $prefix = "นางสาว";
    }
    $studentName = $prefix.$valStudent['student_firstname']." ".$valStudent['student_lastname'];
    $titleStudent = "notification_title = 'มีการประเมินการฝึกงาน จาก {$valCompany['company_name']}'";
    $messageStudent = "notification_message = '{$valCompany['company_name']} ได้ประเมินการฝึกงานของนักศึกษาฝึกงาน ชื่อ {$studentName} เรียบร้อยแล้ว'";
    $titleTeacher = "notification_title = 'มีการประเมินการฝึกงาน จาก {$valCompany['company_name']}'";
    $messageTeacher = "notification_message = '{$valCompany['company_name']} ได้ประเมินการฝึกงานของนักศึกษาฝึกงาน ชื่อ {$studentName} รหัสนักศึกษา {$valStudent['student_code']} เรียบร้อยแล้ว'";
    $valSet = "notification_title_date = 'วันที่ ".DBThaiShortDate(date('Y-m-d'))."',
               notification_datetime = '".date("Y-m-d H:i:s")."',
               notification_type = 'scoretrainer',
               notification_type_id = '{$valMaxID['maxID']}',
               notification_isread = 'no'";

    if ($valStudent['teacher_id'] == $valStudent['teacher2_id']){
        mysql_query("INSERT INTO notification SET {$titleTeacher} , {$messageTeacher} , {$valSet} , member_id = '{$valTeacher['member_id']}'");
    }else{
        mysql_query("INSERT INTO notification SET {$titleTeacher} , {$messageTeacher} , {$valSet} , member_id = '{$valTeacher['member_id']}'");
        mysql_query("INSERT INTO notification SET {$titleTeacher} , {$messageTeacher} , {$valSet} , member_id = '{$valTeacher2['member_id']}'");
    }

//    $sqlInsertNotification = "INSERT INTO notification SET {$titleStudent} , {$messageStudent} , {$valSet} , member_id = '{$valStudent['member_id']}' ";
//    mysql_query($sqlInsertNotification) or die(mysql_error($sqlInsertNotification));

    header("refresh:1; url=../index.php?page=trainer_score_student_list");

}

if ($_GET['action'] == 'addDiaryStudent'){
    $sqlInsertDiaryStudent = "INSERT INTO diary SET
                                diary_date = curdate(),
                                diary_status = 'absent',
                                diary_comment_trainer = '1',
                                student_id = '{$_GET['studentID']}'";
    mysql_query($sqlInsertDiaryStudent);

    $getMaxIDDiary = "SELECT MAX(diary_id) AS maxID FROM diary";
    $resultMaxID = mysql_query($getMaxIDDiary);
    $valMaxID = mysql_fetch_assoc($resultMaxID);

    if ($valStudent['student_sex'] == 'male') {
        $prefix = "นาย";
    }elseif ($valStudent['student_sex'] == 'female'){
        $prefix = "นางสาว";
    }
    $studentName = $prefix.$valStudent['student_firstname']." ".$valStudent['student_lastname'];
    $titleStudent = "notification_title = 'เนื่องจากนักศึกษาไม่มาฝึกงาน ทางสถานประกอบการจึงมีการเช็คขาด'";
    $messageStudent = "notification_message = 'เนื่องจากนักศึกษาไม่มาฝึกงาน ในวันที่ ".DBThaiShortDate(date('Y-m-d'))." ทางสถานประกอบการจึงมีการเช็คขาด'";
    $titleTeacher = "notification_title = 'เนื่องจากนักศึกษาฝึกงาน ชื่อ {$studentName} ไม่มาฝึกงาน ทางสถานประกอบการจึงมีการเช็คขาด'";
    $messageTeacher = "notification_message = 'เนื่องจากนักศึกษาฝึกงาน ชื่อ {$studentName} รหัสนักศึกษา {$valStudent['student_code']} ไม่มาฝึกงาน ที่ {$valCompany['company_name']} ในวันที่ ".DBThaiShortDate(date('Y-m-d'))." ทางสถานประกอบการจึงมีการเช็คขาด'";
    $valSet = "notification_title_date = 'วันที่ ".DBThaiShortDate(date('Y-m-d'))."',
               notification_datetime = '".date("Y-m-d H:i:s")."',
               notification_type = 'absent',
               notification_type_id = '{$valMaxID['maxID']}',
               notification_isread = 'no'";

    if ($valStudent['teacher_id'] == $valStudent['teacher2_id']){
        mysql_query("INSERT INTO notification SET {$titleTeacher} , {$messageTeacher} , {$valSet} , member_id = '{$valTeacher['member_id']}'");
    }else{
        mysql_query("INSERT INTO notification SET {$titleTeacher} , {$messageTeacher} , {$valSet} , member_id = '{$valTeacher['member_id']}'");
        mysql_query("INSERT INTO notification SET {$titleTeacher} , {$messageTeacher} , {$valSet} , member_id = '{$valTeacher2['member_id']}'");
    }

    $sqlInsertNotification = "INSERT INTO notification SET {$titleStudent} , {$messageStudent} , {$valSet} , member_id = '{$_GET['memberID']}' ";
    mysql_query($sqlInsertNotification) or die(mysql_error($sqlInsertNotification));
    header("refresh:1; url=../index.php");
}

include ("../load_page.html");
?>