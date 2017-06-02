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
include ("../../common/class/company/class.company.php");
include ("../../common/class/teacher/class.teacher.php");

$classCompany = new Company();
$classTeacher = new Teacher();
$valTeacher = $classTeacher->GetDetailTeacher($_COOKIE['memberID'],$teacherID);
$valCompany = $classCompany->GetDetailCompany($_POST['txtCompany']);
$listStudent = $classTeacher->GetListStudentInCompany($_POST['txtCompany']);
$listTrainer = $classTeacher->GetListTrainerInCompany($_POST['txtCompany']);

$memberID = $_COOKIE['memberID'];

if (isset($_POST['editTeacher'])){
    if($_FILES['file']['name']!=""){
        unlink("../../images/member/".$_POST['txtPicture']."");
        $imgName=UpImg($_FILES['file'],"../../images/member/");
        $sqlUpdateImgTeacher = "UPDATE teacher SET teacher_picture = '".$imgName."' WHERE member_id = '$memberID'";
        mysql_query($sqlUpdateImgTeacher) or die(mysql_error());
    }
    $sqlUpdateTeacher = "UPDATE teacher SET
                    teacher_prefix = '".$_POST['txtPrefix']."',
                    teacher_firstname = '".$_POST['txtFirstname']."',
                    teacher_lastname = '".$_POST['txtLastname']."',
                    teacher_rank = '".$_POST['txtRank']."',
                    teacher_tel = '".$_POST['txtTel']."',
                    teacher_email = '".$_POST['txtEmail']."',
                    teacher_facebook = '".$_POST['txtFacebook']."',
                    teacher_line = '".$_POST['txtLine']."',
                    teacher_instagram = '".$_POST['txtInstagram']."',
                    teacher_twitter = '".$_POST['txtTwitter']."'
                  WHERE member_id = '$memberID'";
    mysql_query($sqlUpdateTeacher) or die(mysql_error());

    header("refresh:1; url=../index.php?page=teacher_profile");
}

if (isset($_POST['insertAppointment'])){
    $dateAppointment = ThaiDate2DBDate($_POST['txtDate']);
    $sqlInsertAppointment = "INSERT INTO appointment SET
                                appointment_date = '".$dateAppointment."',
                                appointment_time = '".$_POST['txtTime']."',
                                appointment_status = '0',
                                appointment_student_status = '0',
                                appointment_trainer_status = '0',
                                company_id = '".$_POST['txtCompany']."',
                                teacher_id = '".$_POST['txtTeacherID']."'";
    mysql_query($sqlInsertAppointment) or die(mysql_error());

    $getMaxIDAppointment = "SELECT MAX(appointment_id) AS maxID FROM appointment";
    $resultMaxID = mysql_query($getMaxIDAppointment);
    $valMaxID = mysql_fetch_assoc($resultMaxID);
    $valCompany = $classCompany->GetDetailCompany($_POST['txtCompany']);
    include ("../../common/send_mail.php");
    $message = "มีการนัดหมายการนิเทศนักศึกษาฝึกประสบการณ์ ที่ ".$valCompany['company_name']." ในวันที่ ".DBThaiLongDate($dateAppointment)." เวลา ".$_POST['txtTime']. " น. <br> จาก อาจารย์ ".$valTeacher['teacher_firstname']." ".$valTeacher['teacher_lastname']."";
    $valSet = "notification_title = 'มีการนัดหมายการนิเทศนักศึกษา ที่ ".$valCompany['company_name']."',
               notification_title_date = 'วันที่ ".DBThaiShortDate($dateAppointment)." เวลา ".$_POST['txtTime']. " น.',
               notification_datetime = '".date("Y-m-d H:i:s")."',
               notification_message = '{$message}',
               notification_type = 'appointment',
               notification_type_id = '".$valMaxID['maxID']."',
               notification_isread = 'no'";
    while ($valTrainer = mysql_fetch_assoc($listTrainer)){
        mysql_query("INSERT INTO notification SET {$valSet} , member_id = '".$valTrainer['member_id']."'");
        $mail->addAddress($valTrainer['trainer_email']);
    }
    while ($valStudent = mysql_fetch_assoc($listStudent)){
        mysql_query("INSERT INTO notification SET {$valSet} , member_id = '".$valStudent['member_id']."'");
        $mail->addAddress($valStudent['student_email']);
    }
    $mail->Subject = 'แจ้งเตือน การเข้าไปนิเทศนักศึกษาฝึกประสบการณ์';
    $mail->msgHTML("{$message}");
    $mail->send();

    header("refresh:1; url=../index.php?page=teacher_appointment_report");
}

if (isset($_POST['editAppointment'])){
    $dateAppointment = ThaiDate2DBDate($_POST['txtDate']);
    $sqlUpdateAppointment = "UPDATE appointment SET
                                appointment_date = '".$dateAppointment."',
                                appointment_time = '".$_POST['txtTime']."',
                                company_id = '".$_POST['txtCompany']."'
                             WHERE appointment_id = '".$_GET['appointmentID']."'";
    mysql_query($sqlUpdateAppointment) or die(mysql_error());

    $resultIDNoti = mysql_query("SELECT * FROM notification WHERE notification_type_id = '".$_GET['appointmentID']."'");

    while ($valIDNoti = mysql_fetch_assoc($resultIDNoti)){
        $sqlUpdateNotification = "UPDATE notification SET 
                                    notification_title = 'มีการเปลี่ยนแปลงการนิเทศนักศึกษา ที่ ".$valCompany['company_name']."',
                                    notification_title_date = 'เป็น วันที่ ".DBThaiShortDate($dateAppointment)." เวลา ".$_POST['txtTime']. " น.',
                                    notification_message = 'มีการเปลี่ยนแปลงการนิเทศนักศึกษา ที่ ".$valCompany['company_name']." จาก วันที่ ".DBThaiShortDate($_POST['txtDateOld'])." เวลา ".$_POST['txtTimeOld']. " น. เป็น วันที่ ".DBThaiShortDate($dateAppointment)." เวลา ".$_POST['txtTime']. " น.',
                                    notification_datetime = '".date("Y-m-d H:i:s")."',
                                    notification_isread = 'no'
                                 WHERE notification_id = '".$valIDNoti['notification_id']."'";
        mysql_query($sqlUpdateNotification);
    }

    header("refresh:1; url=../index.php?page=teacher_appointment_report");
}

if (isset($_POST['updateScoreStudent'])){
    $sqlUpdateScoreStudent = "UPDATE score SET
                                score_teacher_1 = '".$_POST['numScore1']."',
                                score_teacher_2 = '".$_POST['numScore2']."',
                                score_teacher_3 = '".$_POST['numScore3']."',
                                score_teacher_defect = '".$_POST['txtDefect']."',
                                score_teacher_counsel = '".$_POST['txtCounsel']."',
                                teacher_id = '".$_POST['txtTeacherID']."',
                                teacher_status = '1'
                              WHERE student_id = '".$_GET['studentID']."'
                              ";
    mysql_query($sqlUpdateScoreStudent) or die(mysql_error($sqlUpdateScoreStudent));

    mysql_query("UPDATE student SET student_score_teacher = 'yes' WHERE student_id = '{$_GET['studentID']}'");

    header("refresh:1; url=../index.php?page=teacher_score_student_list&result=score");
}


if (isset($_POST['insertScoreStudent'])){

    mysql_query("DELETE FROM evaluation_score WHERE student_id = '".$_GET['studentID']."' AND score_assessor_id = '".$_POST['txtTeacherID']."' ");

    for($i=0;$i<count($_POST['numScore']);$i++) {
        mysql_query("INSERT INTO evaluation_score SET 
                        score_num = '".$_POST['numScore'][$i]."',
                        score_assessor = 'teacher',
                        score_assessor_id = '".$_POST['txtTeacherID']."',
                        question_id = '".$_POST['evaluationID'][$i]."',
                        student_id = '".$_GET['studentID']."'");
    }

    for($i=1;$i<($_POST['numRowQuestion']+1);$i++) {

        mysql_query("INSERT INTO evaluation_score SET 
                        score_num = '".$_POST['questionCheck'.$i]."',
                        score_assessor = 'teacher',
                        score_assessor_id = '".$_POST['txtTeacherID']."',
                        question_id = '".$_POST['questionID'.$i]."',
                        student_id = '".$_GET['studentID']."'");
    }

    mysql_query("DELETE FROM evaluation_comment WHERE student_id = '".$_GET['studentID']."' AND comment_assessor_id = '".$_POST['txtTeacherID']."'");

    mysql_query("INSERT INTO evaluation_comment SET 
                        comment_defect = '".$_POST['txtDefect']."',
                        comment_counsel = '".$_POST['txtCounsel']."',
                        comment_assessor = 'teacher',
                        comment_assessor_id = '".$_POST['txtTeacherID']."',
                        student_id = '".$_GET['studentID']."'");

    mysql_query("UPDATE student SET student_score_teacher = 'complete' WHERE student_id = '{$_GET['studentID']}'");

    header("refresh:1; url=../index.php?page=teacher_score_student_list&result=score");
}

if (isset($_POST['insertGradeStudent'])){

    mysql_query("DELETE FROM score WHERE student_id = '".$_GET['studentID']."'");
    mysql_query("INSERT INTO score SET
                                score_trainer = '".$_POST['numScoreTrainer']."',
                                score_teacher = '".$_POST['numScoreTeacher']."',
                                score_report = '".$_POST['numScoreReport']."',
                                score_join = '".$_POST['numScoreJoin']."',
                                teacher_id = '".$_POST['txtTeacherID']."',
                                student_id = '".$_GET['studentID']."' ") or die(mysql_error());

    mysql_query("UPDATE student SET student_status = 'grade' WHERE student_id = '{$_GET['studentID']}'");

    header("refresh:1; url=../index.php?page=teacher_score_student_list&result=grade");
}

if ($_GET['action'] == 'deleteAppointment'){
    $sqlDeleteAppointment = "DELETE FROM appointment WHERE appointment_id = '".$_GET['appointmentID']."'";
    mysql_query($sqlDeleteAppointment) or die(mysql_error());
    $sqlDeleteNotification = "DELETE FROM notification WHERE notification_type_id = '".$_GET['appointmentID']."'";
    mysql_query($sqlDeleteNotification);

    header("refresh:1; url=../index.php?page=teacher_appointment_report");
}

if ($_GET['action'] == 'updateAppointment'){
    mysql_query("UPDATE appointment SET appointment_status = '1', appointment_student_status = '1', appointment_trainer_status = '1' WHERE appointment_id = '{$_GET['appointmentID']}'") or die(mysql_error());
    mysql_query("DELETE FROM notification WHERE notification_type_id = '{$_GET['appointmentID']}'");

    header("refresh:1; url=../index.php?page=teacher_appointment_report");
}

include ("../load_page.html");
?>