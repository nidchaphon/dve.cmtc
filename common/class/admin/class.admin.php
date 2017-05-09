<?php

/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/17/2016 AD
 * Time: 21:02
 */
class Admin
{
    function GetListUser(){
        $strQuery = "SELECT
                        CONCAT(student_firstname,' ',student_lastname) AS studentName,
                        CONCAT(trainer_firstname,' ',trainer_lastname) AS trainerName,
                        CONCAT(teacher_firstname,' ',teacher_lastname) AS teacherName,
                        student_code,
                        trainer_code,
                        teacher_code,
                        member.member_id,
                        member_username,
                        member_status,
                        member_loginstatus,
                        member_lastupdate 
                    FROM member 
                      LEFT JOIN teacher ON (member.member_id=teacher.member_id)
                      LEFT JOIN trainer ON (member.member_id=trainer.member_id)
                      LEFT JOIN student ON (member.member_id=student.member_id)";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getUserDetail เพื่อแสดงรายชื่อ User';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetDetailUser($member_id){
        $strQuery = "SELECT * FROM member WHERE member_id = '$member_id'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getUserDetail เพื่อแสดงรายชื่อ User';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetListStatus(){
        $strQuery = "SELECT * FROM status WHERE status_type = 'member'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getUserStatus เพื่อแสดงรายการสถานะ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }


    function GetMaxMemberID(){
        $strQuery = "SELECT MAX(member_id) AS maxID FROM member";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getMaxMemberID เพื่อแสดง ID ของผู้ใช้ล่าสุด';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetListCompany(){
        $strQuery = "SELECT * FROM company";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getCompanyList เพื่อแสดงข้อมูลสถานประกอบการ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListTeacher(){
        $strQuery = "SELECT * FROM teacher";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListTeacher เพื่อแสดงรายชื่ออาจารย์นิเทศใน ListBox';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListTrainer(){
        $strQuery = "SELECT * FROM trainer";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListTeacher เพื่อแสดงรายชื่ออาจารย์นิเทศใน ListBox';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListStatusType($statusType=''){
        $strQuery = "SELECT * FROM status 
                     WHERE status_type = '{$statusType}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStatus เพื่อแสดงรายการสถานะ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListFileDownload(){
        $strQuery = "SELECT * FROM file ";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStatus เพื่อแสดงรายการไฟล์ดาวน์โหลด';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetTextStatusType($value=''){
        $strQuery = "SELECT * FROM status WHERE status_value = '{$value}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getMaxMemberID เพื่อแสดง ข้อความสถานะ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetDetailFileDownload($fileID=''){
        $strQuery = "SELECT * FROM file WHERE file_id = '{$fileID}' ORDER BY file_name ASC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getMaxMemberID เพื่อแสดง ข้อมูลไฟล์ดาวน์โหลด';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

}