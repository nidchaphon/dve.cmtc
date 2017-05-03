<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/19/2016 AD
 * Time: 21:09
 */

include ("../../config/dbconnection.php");
include ("../../config/php_config.php");
include ("../../common/class/teacher/class.teacher.php");
include ("../../common/class/trainer/class.trainer.php");
include ("../../common/class/student/class.student.php");

$teacher = new Teacher();
$maxNumTC = $teacher->getMaxTeacherID();

$trainer = new Trainer();
$maxNumTN = $trainer->getMaxTrainerID();

$student = new Student();
$maxNumSTD = $student->getMaxStudentID();

$yearMonth = substr(date("Y")+543, -2).date("m");

$codeTC = "TC";
$maxIdTC = substr($maxNumTC['maxID'], -4);
$maxIdTC = ($maxIdTC + 1);
$maxIdTC = substr("0000".$maxIdTC, -4);
$nextIdTC = $codeTC.$yearMonth.$maxIdTC;

$codeSTD = "ST";
$maxIdSTD = substr($maxNumSTD['maxID'], -4);
$maxIdSTD = ($maxIdSTD + 1);
$maxIdSTD = substr("0000".$maxIdSTD, -4);
$nextIdSTD = $codeSTD.$yearMonth.$maxIdSTD;

$codeTN = "TN";
$maxIdTN = substr($maxNumTN['maxID'], -4);
$maxIdTN = ($maxIdTN + 1);
$maxIdTN = substr("0000".$maxIdTN, -4);
$nextIdTN = $codeTN.$yearMonth.$maxIdTN;

if (isset($_POST['insertTeacher'])){
    $sqlAddMember = "INSERT INTO member SET 
                        member_id = '".$_POST['txtID']."',
                        member_username = '".$_POST['txtCode']."',
                        member_password = '".$_POST['txtPassword']."',
                        member_status = '".$_POST['txtStatus']."'";
    mysql_query($sqlAddMember) or die(mysql_error());
    $sqlAddTeacher = "INSERT INTO teacher SET
                        teacher_id = '$nextIdTC',
                        teacher_code = '".$_POST['txtCode']."',
                        teacher_firstname = '".$_POST['txtFirstname']."',
                        teacher_lastname = '".$_POST['txtLastname']."',
                        teacher_rank = '".$_POST['txtRank']."',
                        teacher_tel = '".$_POST['txtTel']."',
                        teacher_email = '".$_POST['txtEmail']."',
                        member_id = '".$_POST['txtID']."'";
    mysql_query($sqlAddTeacher) or die(mysql_error());
    header("refresh:1; url=../index.php?page=admin_user_list");
}

if (isset($_POST['insertTrainer'])){
    $sqlAddMember = "INSERT INTO member SET 
                        member_id = '".$_POST['txtID']."',
                        member_username = '".$_POST['txtCode']."',
                        member_password = '".$_POST['txtPassword']."',
                        member_status = '".$_POST['txtStatus']."'";
    mysql_query($sqlAddMember) or die(mysql_error());
    $sqlAddTrainer = "INSERT INTO trainer SET
                        trainer_id = '$nextIdTN',
                        trainer_code = '".$_POST['txtCode']."',
                        trainer_firstname = '".$_POST['txtFirstname']."',
                        trainer_lastname = '".$_POST['txtLastname']."',
                        trainer_rank = '".$_POST['txtRank']."',
                        trainer_tel = '".$_POST['txtTel']."',
                        trainer_email = '".$_POST['txtEmail']."',
                        company_id = '".$_POST['txtCompany']."',
                        member_id = '".$_POST['txtID']."'";
    mysql_query($sqlAddTrainer) or die(mysql_error());
    header("refresh:1; url=../index.php?page=admin_user_list");
}

if (isset($_POST['insertStudent'])){
    $birthDate = ThaiDate2DBDate($_POST['txtBirthdate']);
    $sqlAddMember = "INSERT INTO member SET 
                        member_id = '".$_POST['txtID']."',
                        member_username = '".$_POST['txtCode']."',
                        member_password = '".$_POST['txtPassword']."',
                        member_status = '".$_POST['txtStatus']."'";
    mysql_query($sqlAddMember) or die(mysql_error());
    $sqlAddStudent = "INSERT INTO student SET
                        student_id = '$nextIdSTD',
                        student_code = '".$_POST['txtCode']."',
                        student_firstname = '".$_POST['txtFirstname']."',
                        student_lastname = '".$_POST['txtLastname']."',
                        student_degree = '".$_POST['txtDegree']."',
                        student_year = '".$_POST['txtYear']."',
                        student_department = '".$_POST['txtDepartment']."',
                        student_group = '".$_POST['txtGroup']."',
                        student_birthdate = '".$birthDate."',
                        student_address = '".$_POST['txtAddress']."',
                        student_tel = '".$_POST['txtTel']."',
                        student_email = '".$_POST['txtEmail']."',
                        member_id = '".$_POST['txtID']."',
                        teacher_id = '".$_POST['txtTeacher']."',
                        teacher2_id = '".$_POST['txtTeacher2']."',
                        trainer_id = '".$_POST['txtTrainer']."',
                        company_id = '".$_POST['txtCompany']."'";
    mysql_query($sqlAddStudent) or die(mysql_error());

    $sqlAddIDToScoreTrianer = "INSERT INTO score SET
                                  student_id = '$nextIdSTD'";
    mysql_query($sqlAddIDToScoreTrianer)or die(mysql_error());

    header("refresh:1; url=../index.php?page=admin_user_list");
}

if (isset($_POST['insertCompany'])){

    $sqlAddCompany = "INSERT INTO company SET ";
    $sqlAddCompany .= "company_name = '" . $_POST['txtCompanyName'] . "',
                        company_detail = '" . $_POST['txtCompanyDetail'] . "',
                        company_address = '" . $_POST['txtCompanyAddress'] . "',
                        company_tel = '" . $_POST['txtCompanyTel'] . "',
                        company_email = '" . $_POST['txtCompanyEmail'] . "',
                        company_website = '" . $_POST['txtCompanyWebsite'] . "',
                        company_manager_name = '" . $_POST['txtManagerName'] . "',
                        company_manager_rank = '" . $_POST['txtManagerRank'] . "',
                        company_manager_tel = '" . $_POST['txtManagerTel'] . "',
                        company_manager_email = '" . $_POST['txtManagerEmail'] . "',
                        company_manager_facebook = '" . $_POST['txtManagerFacebook'] . "',
                        company_manager_line = '" . $_POST['txtManagerLine'] . "',
                        company_lat = '" . $_POST['txtCompanyLat'] . "',
                        company_lon = '" . $_POST['txtCompanyLon'] . "'";

    if($_FILES['fileLogo']['name']!="") {
        $imgName = UpImg($_FILES['fileLogo'], "../../images/logo_company/");
        $sqlAddCompany .= ",company_logo = '" . $imgName . "'";
        mysql_query($sqlAddCompany) or die(mysql_error());
    }else {
        mysql_query($sqlAddCompany) or die(mysql_error());
    }

    header("refresh:1; url=../index.php?page=admin_company_list");
}

include ("../load_page.html");
?>