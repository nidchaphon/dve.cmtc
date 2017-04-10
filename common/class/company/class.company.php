<?php

/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 2/8/2017 AD
 * Time: 22:24
 */
class Company
{
    function GetListCompany(){
        $strQuery = "SELECT * FROM company";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getCompanyList เพื่อแสดงข้อมูลสถานประกอบการ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetDetailCompany($company_id){
        $strQuery = "SELECT * FROM company WHERE company_id = '$company_id'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getCompanyDetail เพื่อแสดงรายละเอียดสถานประกอบการ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

}