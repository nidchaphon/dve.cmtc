<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/19/2016 AD
 * Time: 21:09
 */

include ("../../config/dbconnection.php");
include ("../../config/php_config.php");

if (isset($_POST['updateUser'])) {
    $sqlUpdateUser = "UPDATE member SET
                        member_username = '".$_POST['txtUsername']."',
                        member_password = '".$_POST['txtPassword']."'
                      WHERE Member_ID = '".$_GET['memberID']."'";
    mysql_query($sqlUpdateUser) or die(mysql_error());

    if ($_GET['memberStatus'] == 'teacher' || $_GET['status'] == 'teacher2'){
        $sqlUpdateTeacher = "UPDATE teacher SET
                              teacher_firstname = '".$_POST['txtFirstname']."',
                              teacher_lastname = '".$_POST['txtLastname']."',
                              teacher_tel = '".$_POST['txtTel']."',
                              teacher_email = '".$_POST['txtEmail']."'
                             WHERE member_id = '".$_GET['memberID']."'";
        mysql_query($sqlUpdateTeacher);
    }
    if ($_GET['memberStatus'] == 'trainer'){
        $sqlUpdateTrainer = "UPDATE trainer SET
                              trainer_firstname = '".$_POST['txtFirstname']."',
                              trainer_lastname = '".$_POST['txtLastname']."',
                              trainer_tel = '".$_POST['txtTel']."',
                              trainer_email = '".$_POST['txtEmail']."',
                              company_id = '".$_POST['txtCompany']."'
                             WHERE member_id = '".$_GET['memberID']."'";
        mysql_query($sqlUpdateTrainer);
    }
    if ($_GET['memberStatus'] == 'student'){
        $birthDate = ThaiDate2DBDate($_POST['txtBirthdate']);
        $sqlUpdateStudent = "UPDATE student SET
                              student_firstname = '".$_POST['txtFirstname']."',
                              student_lastname = '".$_POST['txtLastname']."',
                              student_code = '".$_POST['txtStdCode']."',
                              student_degree = '".$_POST['txtDegree']."',
                              student_year = '".$_POST['txtYear']."',
                              student_department = '".$_POST['txtDepartment']."',
                              student_group = '".$_POST['txtGroup']."',
                              student_birthdate = '".$birthDate."',
                              student_address = '".$_POST['txtAddress']."',
                              student_tel = '".$_POST['txtTel']."',
                              student_email = '".$_POST['txtEmail']."',
                              teacher_id = '".$_POST['txtTeacher']."',
                              teacher2_id = '".$_POST['txtTeacher2']."',
                              trainer_id = '".$_POST['txtTrainer']."',
                              company_id = '".$_POST['txtCompany']."'
                             WHERE member_id = '".$_GET['memberID']."'";
        mysql_query($sqlUpdateStudent);
    }

    header("refresh:1; url=../index.php?page=admin_user_list");
}

if (isset($_POST['updateCompany'])){
    $sqlUpdateCompany = "UPDATE company SET
                            company_name = '".$_POST['txtCompanyName']."',
                            company_detail = '".$_POST['txtCompanyDetail']."',
                            company_address = '".$_POST['txtCompanyAddress']."',
                            company_tel = '".$_POST['txtCompanyTel']."',
                            company_email = '".$_POST['txtCompanyEmail']."',
                            company_website = '".$_POST['txtCompanyWebsite']."',
                            company_lat = '".$_POST['txtCompanyLat']."',
                            company_lon = '".$_POST['txtCompanyLon']."'
                         WHERE company_id = '".$_GET['companyID']."'";
    mysql_query($sqlUpdateCompany) or die(mysql_error());

    header("refresh:1; url=../index.php?page=admin_company_list");
}

include ("../load_page.html");
?>
