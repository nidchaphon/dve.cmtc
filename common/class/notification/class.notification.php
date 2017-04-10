<?php

/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/26/2017 AD
 * Time: 09:34
 */
class Notification
{
    function GetNotiTeacherForStudent($studentID='',$numLimit=''){
        if ($numLimit != ''){
            $limit = "LIMIT ".$numLimit;
        }
        $strQuery = "SELECT *
                      FROM appointment
                        LEFT JOIN company ON(appointment.company_id = company.company_id)
                        LEFT JOIN student ON (student.company_id=company.company_id)
                      WHERE appointment_student_status = '0'
                        AND student.student_id = '{$studentID}'
                        {$limit}
                      ";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetNotiTeacherForStudent เพื่อแสดงการแจ้งเตือนจากอาจารย์นิเทศถึงนักศึกษาฝึกงาน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

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


}