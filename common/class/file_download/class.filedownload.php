<?php

/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 5/9/2017 AD
 * Time: 15:31
 */
class FileDownload
{
    function GetListFileDownload(){
        $strQuery = "SELECT * FROM file ";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStatus เพื่อแสดงรายการไฟล์ดาวน์โหลด';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

}