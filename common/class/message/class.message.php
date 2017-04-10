<?php

/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/17/2017 AD
 * Time: 10:00
 */
class Message
{
    function GetListMember(){
        $strQuery = "SELECT * FROM member";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListMember เพื่อแสดงรายชื่อผู้ใช้งาน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListTeacher(){
        $strQuery = "SELECT * , COUNT(IF(chat.chat_status='0',chat.chat_id,NULL))AS noneRead FROM teacher INNER JOIN chat ON (teacher.member_id=chat_user1)";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListTeacher เพื่อแสดงรายชื่ออาจารย์นิเทศ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListTrainer(){
        $strQuery = "SELECT * FROM trainer INNER JOIN company ON (trainer.company_id=company.company_id)";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListTrainer เพื่อแสดงรายชื่อครูฝึก';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListStudent(){
        $strQuery = "SELECT * FROM student";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStudent เพื่อแสดงรายชื่อนักศึกษาฝึกงาน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetDetailContact($status=''){
        $strQuery = "SELECT * FROM member INNER JOIN $status ON (member.member_id=$status.member_id)";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetDetailContact เพื่อแสดงรายละเอียดข้อมูลผู้ติดต่อ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }


}