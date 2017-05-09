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

    if($_FILES['fileLogo']['name']!=""){
        unlink("../../images/logo_company/".$_POST['txtCompanyLogo']."");
        $imgName=UpImg($_FILES['fileLogo'],"../../images/logo_company/");
        $sqlUpdateLogoCompany = "UPDATE company SET company_logo = '".$imgName."' WHERE company_id = '".$_GET['companyID']."'";
        mysql_query($sqlUpdateLogoCompany) or die(mysql_error());
    }

    $sqlUpdateCompany = "UPDATE company SET
                            company_name = '".$_POST['txtCompanyName']."',
                            company_detail = '".$_POST['txtCompanyDetail']."',
                            company_address = '".$_POST['txtCompanyAddress']."',
                            company_tel = '".$_POST['txtCompanyTel']."',
                            company_email = '".$_POST['txtCompanyEmail']."',
                            company_website = '".$_POST['txtCompanyWebsite']."',
                            company_manager_name = '" . $_POST['txtManagerName'] . "',
                            company_manager_rank = '" . $_POST['txtManagerRank'] . "',
                            company_manager_tel = '" . $_POST['txtManagerTel'] . "',
                            company_manager_email = '" . $_POST['txtManagerEmail'] . "',
                            company_manager_facebook = '" . $_POST['txtManagerFacebook'] . "',
                            company_manager_line = '" . $_POST['txtManagerLine'] . "',
                            company_lat = '".$_POST['txtCompanyLat']."',
                            company_lon = '".$_POST['txtCompanyLon']."'
                         WHERE company_id = '".$_GET['companyID']."'";
    mysql_query($sqlUpdateCompany) or die(mysql_error());

    for($i=0;$i<count($_FILES["imgCompany"]["name"]);$i++)
    {
        if($_FILES["imgCompany"]["name"][$i] != "")
        {
            if(move_uploaded_file($_FILES["imgCompany"]["tmp_name"][$i],"../../images/company/".$_FILES["imgCompany"]["name"][$i]))
            {
                mysql_query("INSERT INTO picture SET 
                                    picture_name = '".$_FILES["imgCompany"]["name"][$i]."',
                                    picture_type = 'company',
                                    picture_type_id = '".$_GET['companyID']."'");
            }
        }
    }

    header("refresh:1; url=../index.php?page=admin_company_list");
}

if (isset($_POST['updateFile'])){

    $user = implode(',' , $_POST[user]);

    mysql_query("UPDATE file SET
                        file_user = '".$user."'
                        WHERE file_id = '".$_GET['fileID']."'");

    header("refresh:1; url=../index.php?page=admin_file_list");
}

include ("../load_page.html");
?>
