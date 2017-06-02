<?php

///* set the cache limiter to 'verify_user' */
//session_cache_limiter('verify_user');
//$cache_limiter = session_cache_limiter();
///* set the cache expire to 60 minutes */
//session_cache_expire(60);
//$cache_expire = session_cache_expire();
///* start the session */
//session_start();
ob_start();
if (!isset($_COOKIE['username']) && $_COOKIE['username'] == ''){
//    echo "<script>alert('หมดเวาลาการเข้าใช้งาน กรุณาเข้าสู่ระบบใหม่อีกครั้ง');</script>";
    echo "<meta http-equiv='refresh' content='0;url=usermanager/login.php'>";
    exit();
}

date_default_timezone_set('Asia/Bangkok');

require_once("../config/dbconnection.php");
require_once("../config/php_config.php");
include ("../common/class/mobile_detect.php");
include ("../common/class/notification/class.notification.php");
include ("../common/class/admin/class.admin.php");
include ("../common/class/student/class.student.php");
include ("../common/class/teacher/class.teacher.php");
include ("../common/class/trainer/class.trainer.php");
include ("../common/class/message/class.message.php");
include ("../common/class/company/class.company.php");
include ("../common/class/member/class.member.php");
include ("../common/class/file_download/class.filedownload.php");

$detect = new Mobile_Detect();
$classMember = new Member();

$valMember = $classMember->GetDetailMember($_COOKIE['memberID']);

$sqlUpdateTimeMember = "UPDATE member SET member_loginstatus = '1', member_lastupdate = NOW() WHERE member_id = '".$_COOKIE['memberID']."' ";
mysql_query($sqlUpdateTimeMember);

//if ($valMember['member_loginstatus'] == '0'){
//    echo "<script>alert('ยังไม่ได้ล็อกอิน กรุณาล็อกอินใหม่อีกครั้ง');</script>";
//    unset($_COOKIE['username']);
//    unset($_COOKIE['memberID']);
//    unset($_COOKIE['memberStatus']);
//    setcookie('username','', time() - 3600, "/");
//    setcookie('memberID','', time() - 3600, "/");
//    setcookie('memberStatus','', time() - 3600, "/");
//    echo "<meta http-equiv='refresh' content='0;url=../index.html'>";
//    exit();
//}

//echo $_COOKIE['username'];
//echo $_COOKIE['memberID'];
//echo $_COOKIE['memberStatus'];

include "sidebar_left.php";
include "header.php";

if ($_GET[page] == '' || $_GET[page] == 'main'){ include('main.php');}

//--Admin--//
if ($_GET[page] == 'admin_user_list'){include ('admin/user/user_list.php');}
if ($_GET[page] == 'admin_user_detail'){include ('admin/user/user_detail.php');}
if ($_GET[page] == 'admin_user_add'){include ('admin/user/user_add.php');}
if ($_GET[page] == 'admin_user_edit'){include ('admin/user/user_edit.php');}
if ($_GET[page] == 'admin_user_edit_password'){include ('admin/user/user_edit_password.php');}
if ($_GET[page] == 'admin_company_list'){include ('admin/company/company_list.php');}
if ($_GET[page] == 'admin_company_add'){include ('admin/company/company_add.php');}
if ($_GET[page] == 'admin_company_edit'){include ('admin/company/company_edit.php');}
if ($_GET[page] == 'admin_file_list'){include ('admin/file_download/file_list.php');}
if ($_GET[page] == 'admin_file_add'){include ('admin/file_download/file_add.php');}
if ($_GET[page] == 'admin_file_edit'){include ('admin/file_download/file_edit.php');}
if ($_GET[page] == 'admin_evaluation_list'){include ('admin/evaluation/evaluation_list.php');}
if ($_GET[page] == 'admin_evaluation_add'){include ('admin/evaluation/evaluation_add.php');}
if ($_GET[page] == 'admin_evaluation_add_question'){include ('admin/evaluation/evaluation_add_question.php');}
if ($_GET[page] == 'admin_evaluation_edit'){include ('admin/evaluation/evaluation_edit.php');}
if ($_GET[page] == 'admin_evaluation_edit_question'){include ('admin/evaluation/evaluation_edit_question.php');}

//--Teacher--//
if ($_GET[page] == 'teacher_profile'){include ('teacher/teacher_profile.php');}
if ($_GET[page] == 'teacher_profile_edit'){include ('teacher/teacher_profile_edit.php');}
if ($_GET[page] == 'teacher_appointment_report'){include ('teacher/teacher_appointment_report.php');}
if ($_GET[page] == 'teacher_appointment_add'){include ('teacher/teacher_appointment_add.php');}
if ($_GET[page] == 'teacher_appointment_edit'){include ('teacher/teacher_appointment_edit.php');}
if ($_GET[page] == 'teacher_appointment_detail'){include ('teacher/teacher_appointment_detail.php');}
if ($_GET[page] == 'teacher_score_student_list'){include ('teacher/teacher_score_student_list.php');}
if ($_GET[page] == 'teacher_score_student_save'){include ('teacher/teacher_score_student_save.php');}
if ($_GET[page] == 'teacher_score_student_report'){include ('teacher/teacher_score_student_report.php');}
if ($_GET[page] == 'teacher_grade_student_save'){include ('teacher/teacher_grade_student_save.php');}
if ($_GET[page] == 'teacher_grade_student_report'){include ('teacher/teacher_grade_student_report.php');}
if ($_GET[page] == 'teacher_student_list'){include ('teacher/teacher_student_list.php');}

//--Trainer--//
if ($_GET[page] == 'trainer_profile'){include ('trainer/trainer_profile.php');}
if ($_GET[page] == 'trainer_profile_edit'){include ('trainer/trainer_profile_edit.php');}
if ($_GET[page] == 'trainer_score_student_list'){include ('trainer/trainer_score_student_list.php');}
if ($_GET[page] == 'trainer_score_student_save'){include ('trainer/trainer_score_student_save.php');}
if ($_GET[page] == 'trainer_score_student_report'){include ('trainer/trainer_score_student_report.php');}
if ($_GET[page] == 'trainer_student_list'){include ('trainer/trainer_student_list.php');}

//--Student--//
if ($_GET[page] == 'student_profile'){include ('student/student_profile.php');}
if ($_GET[page] == 'student_profile_edit'){include ('student/student_profile_edit.php');}
if ($_GET[page] == 'student_diary_report'){include ('student/student_diary_report.php');}
if ($_GET[page] == 'student_diary_add'){include ('student/student_diary_add.php');}
if ($_GET[page] == 'student_diary_detail'){include ('student/student_diary_detail.php');}
if ($_GET[page] == 'student_diary_edit'){include ('student/student_diary_edit.php');}

//--Company--//
if ($_GET[page] == 'company_list'){include ('company/company_list.php');}
if ($_GET[page] == 'company_detail'){include ('company/company_detail.php');}

//--Message--//
if ($_GET[page] == 'message'){include ('message.php');}

//--FileDownload--//
if ($_GET[page] == 'file_list'){include ('file_download/file_list.php');}

//--Notification--//
if ($_GET[page] == 'notification_detail'){include ('notification/notification_detail.php');}
if ($_GET[page] == 'notification_report'){include ('notification/notification_report.php');}

include "footer.php";

?>