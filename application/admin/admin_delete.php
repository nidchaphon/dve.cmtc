<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/19/2016 AD
 * Time: 22:20
 */

include ("../../config/dbconnection.php");

if ($_GET['action'] == 'deleteUser'){
    $member_id = $_GET['memberID'];
    $sqlDeleteUser = "DELETE FROM member WHERE member_id = '$member_id'";
    mysql_query($sqlDeleteUser) or die(mysql_error());

    $status = $_GET['memberStatus'];
    if ($status == 'teacher'){
        $sqlDeleteTeacher = "DELETE FROM teacher WHERE member_id = '$member_id'";
        mysql_query($sqlDeleteTeacher) or die(mysql_error());
    }elseif ($status == 'trainer'){
        $sqlDeleteTrainer = "DELETE FROM trainer WHERE member_id = '$member_id'";
        mysql_query($sqlDeleteTrainer) or die(mysql_error());
    }elseif ($status == 'student'){
        $sqlDeleteStudent = "DELETE FROM student WHERE member_id = '$member_id'";
        mysql_query($sqlDeleteStudent) or die(mysql_error());
    }

    header("refresh:1; url=../index.php?page=admin_user_list");
}

if ($_GET['action'] == 'delCompany'){

    unlink("../../images/logo_company/".$_GET['companyLogo']."");
    $company_id = $_GET['companyID'];
    $sqlDeleteCompany = "DELETE FROM company WHERE company_id = '$company_id'";
    mysql_query($sqlDeleteCompany) or die(mysql_error());

    header("refresh:1; url=../index.php?page=admin_company_list");
}

include ("../load_page.html");
?>