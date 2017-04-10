<?php

/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 2/16/2017 AD
 * Time: 00:42
 */
class Member
{
    function GetDetailMember($memberID=''){
        $strQuery = "SELECT * FROM member WHERE member_id = '{$memberID}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetDetailMember เพื่อแสดงรายละเอียดข้อมูลผู้ใช้';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

}