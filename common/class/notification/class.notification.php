<?php

/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/26/2017 AD
 * Time: 09:34
 */
class Notification
{

    function GetDetailNotification($notificationID=''){
        $strQuery = "SELECT * FROM notification WHERE notification_id = '{$notificationID}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetDetailNotification เพื่อแสดงรายละเอียดการแจ้งเตือน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetListNotification($memberID='',$type=''){
        $strQuery = "SELECT * FROM notification WHERE member_id = '{$memberID}' AND notification_type = '{$type}' ORDER BY notification_isread ASC,notification_datetime DESC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListNotification เพื่อแสดงรายการแจ้งเตือน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetNumNotification($memberID='',$type=''){
        $strQuery = "SELECT COUNT(notification_id) AS numNoti FROM notification WHERE member_id = '{$memberID}' AND notification_type = '{$type}' AND notification_isread = 'no'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListNotification เพื่อแสดงรายการแจ้งเตือน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }


}