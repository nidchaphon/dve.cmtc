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

if ($_GET['action'] == 'delPicture'){
    unlink("../../images/company/".$_GET['pictureName']."");
    $sqlDeletePictureCompany = "DELETE FROM picture WHERE picture_id = '{$_GET['pictureID']}'";
    mysql_query($sqlDeletePictureCompany) or die(mysql_error());

    header("refresh:1; url=../index.php?page=admin_company_edit&companyID=".$_GET['companyID']."");
}

if ($_GET['action'] == 'delFile'){
    unlink("../../file_download/".$_GET['fileName']."");
    $sqlDeleteFile = "DELETE FROM file WHERE file_id = '{$_GET['fileID']}'";
    mysql_query($sqlDeleteFile) or die(mysql_error());

    header("refresh:1; url=../index.php?page=admin_file_list");
}

if ($_GET['action'] == 'delEvaluation'){
    mysql_query("DELETE FROM evaluation WHERE evaluation_id = '{$_GET['evaluationID']}'") or die(mysql_error());
    mysql_query("DELETE FROM evaluation_question WHERE evaluation_id = '{$_GET['evaluationID']}'") or die(mysql_error());

    header("refresh:1; url=../index.php?page=admin_evaluation_list");
}

if ($_GET['action'] == 'delQuestion'){
    $sqlDeleteFile = "DELETE FROM evaluation_question WHERE question_id = '{$_GET['questionID']}'";
    mysql_query($sqlDeleteFile) or die(mysql_error());

    if ($_GET['numRowQuestion'] == '1'){
        mysql_query("UPDATE evaluation_question SET
                            question_sub_id = ''
                            WHERE question_id = '".$_GET['mainQuestionID']."'");
    }

    if ($_GET['type'] == 'maintopic'){
        header("refresh:1; url=../index.php?page=admin_evaluation_add_question&evaluationID=".$_GET['evaluationID']);

    } elseif ($_GET['type'] == 'subtopic'){
        header("refresh:1; url=../index.php?page=admin_evaluation_edit_question&questionID=".$_GET['mainQuestionID']);
    }
}


include ("../load_page.html");
?>