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
include ("../../common/class/trainer/class.trainer.php");

$classStudent = new Student();
$classTeacher = new Teacher();
$classTrainer = new Trainer();

$valStudent = $classStudent->GetDetailStudent($_COOKIE['memberID'],$studentID);
$valTeacher = $classTeacher->GetDetailTeacher('',$valStudent['teacher_id']);
$valTeacher2 = $classTeacher->GetDetailTeacher('',$valStudent['teacher2_id']);
$valTrainer = $classTrainer->GetDetailTrainer('',$valStudent['trainer_id']);
$maxDateDiary = $classStudent->GetMaxDateDiary($_GET['studentID']);

if (isset($_GET['memberID'])){
    $memberID = $_GET['memberID'];
} else {
    $memberID = $_COOKIE['memberID'];
}

if (isset($_POST['editStudent'])){
    $birthdte = ThaiDate2DBDate($_POST['txtBirthdate']);
    $dateStart = ThaiDate2DBDate($_POST['txtTrainingStart']);
    $dateEnd = ThaiDate2DBDate($_POST['txtTrainingEnd']);

    if($_FILES['file']['name']!=""){
        unlink("../../images/member/".$_POST['txtPicture']."");
        $imgName=UpImg($_FILES['file'],"../../images/member/");
        $sqlUpdateImgStuent = "UPDATE student SET student_picture = '".$imgName."' WHERE member_id = '$memberID'";
        mysql_query($sqlUpdateImgStuent) or die(mysql_error());
    }
    $sqlUpdateStudent = "UPDATE student SET
                    student_firstname = '".$_POST['txtFirstname']."',
                    student_lastname = '".$_POST['txtLastname']."',
                    student_degree = '".$_POST['txtDegree']."',
                    student_year = '".$_POST['txtYear']."',
                    student_department = '".$_POST['txtDepartment']."',
                    student_group = '".$_POST['txtGroup']."',
                    student_sex = '".$_POST['txtSex']."',
                    student_birthdate = '".$birthdte."',
                    student_weight = '".$_POST['txtWeight']."',
                    student_height = '".$_POST['txtHeight']."',
                    student_national = '".$_POST['txtNational']."',
                    student_religion = '".$_POST['txtReligion']."',
                    student_blood = '".$_POST['txtBlood']."',
                    student_disease = '".$_POST['txtDisease']."',
                    student_medicine = '".$_POST['txtMedicine']."',
                    student_address = '".$_POST['txtAddress']."',
                    student_tel = '".$_POST['txtTel']."',
                    student_email = '".$_POST['txtEmail']."',
                    student_facebook = '".$_POST['txtFacebook']."',
                    student_line = '".$_POST['txtLine']."',
                    student_instagram = '".$_POST['txtInstagram']."',
                    student_twitter = '".$_POST['txtTwitter']."',
                    student_friend_name = '".$_POST['txtFriendName']."',
                    student_friend_address = '".$_POST['txtFriendAddress']."',
                    student_friend_tel = '".$_POST['txtFriendTel']."',
                    student_father_name = '".$_POST['txtFatherName']."',
                    student_father_age = '".$_POST['txtFatherAge']."',
                    student_father_career = '".$_POST['txtFatherCareer']."',
                    student_mother_name = '".$_POST['txtMotherName']."',
                    student_mother_age = '".$_POST['txtMotherAge']."',
                    student_mother_career = '".$_POST['txtMotherCareer']."',
                    student_father_address = '".$_POST['txtFatherAddress']."',
                    student_parent_name = '".$_POST['txtParentName']."',
                    student_parent_connect = '".$_POST['txtParentConnect']."',
                    student_parent_address = '".$_POST['txtParentAddress']."',
                    student_parent_tel = '".$_POST['txtParentTel']."',
                    student_giveinfo_name = '".$_POST['txtGiveinfoName']."',
                    student_giveinfo_career = '".$_POST['txtGiveinfoCareer']."',
                    student_giveinfo_address = '".$_POST['txtGiveinfoAddress']."',
                    student_giveinfo_tel = '".$_POST['txtGiveinfoTel']."',
                    student_training_start = '".$dateStart."',
                    student_training_end = '".$dateEnd."',
                    company_id = '".$_POST['txtCompany']."',
                    trainer_id = '".$_POST['txtTrainerID']."'
                  WHERE member_id = '$memberID'";
    mysql_query($sqlUpdateStudent) or die(mysql_error());

    header("refresh:1; url=../index.php?page=student_profile&memberID=".$_GET['memberID']);
}

if (isset($_POST['insertDiary'])){
    $dateDiary = ThaiDate2DBDate($_POST['txtDate']);

    $sqlAddDiary = "INSERT INTO diary SET 
                         diary_date = '".$dateDiary."',
                         diary_time_start = '".$_POST['txtTimeStart']."',
                         diary_time_end = '".$_POST['txtTimeEnd']."',
                         diary_job = '".$_POST['txtJob']."',
                         diary_problem = '".$_POST['txtProblem']."',
                         diary_knowledge = '".$_POST['txtKnowledge']."',
                         diary_status = '".$_POST['txtStatus']."',
                         student_id = '".$_POST['txtID']."' ";
    mysql_query($sqlAddDiary) or die(mysql_error());

    header("refresh:1; url=../index.php?page=student_diary_report");
}

if ($_GET['addTimeDiary'] == 'checkin'){
    if ($maxDateDiary['maxDate'] == date("Y-m-d")){
        echo "<script>alert('ลงเวลาเข้างานแล้ว');</script>";
        header("refresh:0; url=../index.php");
    }else{
        $sqlAddDiary = "INSERT INTO diary SET 
                         diary_date = '".date("Y-m-d")."',
                         diary_time_start = '".date("H:i")."',
                         diary_status = 'diary',
                         student_id = '".$_GET['studentID']."' ";
        mysql_query($sqlAddDiary) or die(mysql_error());

        header("refresh:1; url=../index.php");
    }

}

if ($_GET['addTimeDiary'] == 'checkout'){
    $sqlAddDiary = "UPDATE diary SET 
                       diary_time_end = '".date("H:i")."'
                    WHERE diary_id = '".$_GET['diaryID']."'";
    mysql_query($sqlAddDiary) or die(mysql_error());

    header("refresh:1; url=../index.php");

}

if (isset($_POST['updateCommentTrainer'])){
    if ($_POST['txtCommentTrainer']!= '') {
        $commentTrainer = $_POST['txtCommentTrainer'];
    }else{
        $commentTrainer = "-";
    }
    $sqlAddDiary = "UPDATE diary SET 
                       diary_comment_trainer = '".$commentTrainer."'
                    WHERE diary_id = '".$_POST['diaryID']."'";
    mysql_query($sqlAddDiary) or die(mysql_error());

    header("refresh:1; url=../index.php");
}

if (isset($_POST['updateCommentTeacher'])){
    if ($_POST['txtCommentTeacher'] != ''){
        $commentTeacher = $_POST['txtCommentTeacher'];
    }else{
        $commentTeacher = "-";
    }
    $sqlAddDiary = "UPDATE diary SET 
                       diary_comment_teacher = '".$commentTeacher."'
                    WHERE diary_id = '".$_POST['diaryID']."'";
    mysql_query($sqlAddDiary) or die(mysql_error());

    header("refresh:1; url=../index.php");
}

if (isset($_POST['insertLeave'])){
    $dateDiary = ThaiDate2DBDate($_POST['txtDate']);

    $sqlAddDiary = "INSERT INTO diary SET 
                         diary_date = '".$dateDiary."',
                         diary_leave = '".$_POST['txtLeave']."',
                         diary_status = '".$_POST['txtStatus']."',
                         student_id = '".$_POST['txtID']."' ";
    mysql_query($sqlAddDiary) or die(mysql_error());

    $getMaxIDDiary = "SELECT MAX(diary_id) AS maxID FROM diary";
    $resultMaxID = mysql_query($getMaxIDDiary);
    $valMaxID = mysql_fetch_assoc($resultMaxID);

    if ($valStudent['student_sex'] == 'male') {
        $prefix = "นาย";
    }elseif ($valStudent['student_sex'] == 'female'){
        $prefix = "นางสาว";
    }
    if ($_POST['txtStatus'] == 'errand'){
        $leave = "ลากิจ";
    }elseif ($_POST['txtStatus'] == 'sick'){
        echo "ลาป่วย";
    }
    $studentName = $prefix.$valStudent['student_firstname']." ".$valStudent['student_lastname'];
    $valSet = "notification_title = '{$studentName} รหัสนักศึกษา {$valStudent['student_code']} {$leave}',
               notification_title_date = 'วันที่ ".DBThaiShortDate($dateDiary)."',
               notification_message = '{$studentName} {$leave} วันที่ ".DBThaiLongDate($dateDiary)."  เนื่องจาก {$_POST['txtLeave']} ',
               notification_datetime = '".date("Y-m-d H:i:s")."',
               notification_type = 'leave',
               notification_type_id = '{$valMaxID['maxID']}',
               notification_isread = 'no'";

    mysql_query("INSERT INTO notification SET {$valSet} , member_id = '{$valTrainer['member_id']}'");

    if ($valStudent['teacher_id'] == $valStudent['teacher2_id']){
        mysql_query("INSERT INTO notification SET {$valSet} , member_id = '{$valTeacher['member_id']}'");
    }else{
        mysql_query("INSERT INTO notification SET {$valSet} , member_id = '{$valTeacher['member_id']}'");
        mysql_query("INSERT INTO notification SET {$valSet} , member_id = '{$valTeacher2['member_id']}'");
    }
    header("refresh:1; url=../index.php?page=student_diary_report");
}

if (isset($_POST['updateDiary'])){
    $dateDiary = ThaiDate2DBDate($_POST['txtDate']);

    $sqlUpdateDiary = "UPDATE diary SET
                          diary_date = '".$dateDiary."',
                          diary_time_start = '".$_POST['txtTimeStart']."',
                          diary_time_end = '".$_POST['txtTimeEnd']."',
                          diary_job = '".$_POST['txtJob']."',
                          diary_problem = '".$_POST['txtProblem']."',
                          diary_knowledge = '".$_POST['txtKnowledge']."'
                        WHERE diary_id = '".$_GET['diaryID']."'";
    mysql_query($sqlUpdateDiary) or die(mysql_error());
    header("refresh:1; url=../index.php?page=student_diary_report");
}

if (isset($_POST['updateLeaveDiary'])){
    $dateDiary = ThaiDate2DBDate($_POST['txtDate']);

    $sqlUpdateDiary = "UPDATE diary SET
                          diary_date = '".$dateDiary."',
                          diary_leave = '".$_POST['txtLeave']."'
                        WHERE diary_id = '".$_GET['diaryID']."'";
    mysql_query($sqlUpdateDiary) or die(mysql_error());


    header("refresh:1; url=../index.php?page=student_diary_report");
}

if ($_GET['action'] == 'deleteDiary'){
    $sqlDeleteDiary = "DELETE FROM diary WHERE diary_id = '".$_GET['diaryID']."'";
    mysql_query($sqlDeleteDiary) or die(mysql_error());
    header("refresh:1; url=../index.php?page=student_diary_report");
}
include ("../load_page.html");
?>