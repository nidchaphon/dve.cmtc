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
        $strQuery = "SELECT company.company_id,
                            company.company_name,
                            company.company_tel,
                            company.company_email,
                            COUNT(student_id) AS numStudent
                      FROM company 
                      LEFT JOIN student ON (company.company_id=student.company_id) 
                      GROUP BY company.company_id 
                      ORDER BY company_name ASC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getCompanyList เพื่อแสดงข้อมูลสถานประกอบการ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetDetailCompany($companyID=''){
        $strQuery = "SELECT *,COUNT(student_id) AS numStudent
                      FROM company LEFT JOIN student ON (company.company_id=student.company_id) 
                      WHERE company.company_id = '$companyID'
                      GROUP BY company.company_id ";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getCompanyDetail เพื่อแสดงรายละเอียดสถานประกอบการ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetListStudent($companyID=''){
        $strQuery = "SELECT * 
                      FROM student
                      WHERE company_id = '{$companyID}'
                      ORDER BY student_code ASC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getCompanyList เพื่อแสดงรายชื่อนักศึกษาในสถานประกอบการ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListPicture($companyID=''){
        $strQuery = "SELECT * 
                      FROM picture
                      WHERE picture_type_id = '{$companyID}'
                      ORDER BY picture_id DESC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getCompanyList เพื่อแสดงรูปภาพสถานประกอบการ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

}