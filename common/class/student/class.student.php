<?php

/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/20/2016 AD
 * Time: 21:35
 */
class Student
{
    function GetMaxStudentID(){
        $strQuery = "SELECT MAX(student_id) AS maxID FROM student";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getMaxStudentID เพื่อแสดง ID ของนักศึกษาฝึกงานล่าสุด';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetDetailStudent($memberID='',$studentID=''){
        if (isset($studentID)){
            $wherebyID = "student.student_id = '".$studentID."'";
        }else{
            $wherebyID = "student.member_id = '".$memberID."'";
        }
        $strQuery = "SELECT * FROM student 
                        LEFT JOIN teacher ON (student.teacher_id=teacher.teacher_id)
                        LEFT JOIN trainer ON (student.trainer_id=trainer.trainer_id)
                        LEFT JOIN company ON (student.company_id=company.company_id)
                      WHERE {$wherebyID}";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getStudentDetail เพื่อแสดง รายละเอียดของนักศึกฝึกงาน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetStatusDetailStudent($value=''){
        $strQuery = "SELECT * FROM status WHERE status_value = '$value'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetStatusDetailStudent เพื่อแสดง ชื่อสถานะ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetDetailCompany($companyID=''){
        $strQuery = "SELECT * FROM company WHERE company_id = '$companyID'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getCompany เพื่อแสดง รายละเอียดสถานประกอบการ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetListCompany(){
        $strQuery = "SELECT * FROM company";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getCompanyList เพื่อแสดงรายชื่อสถานประกอบการ ListBox';
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
            echo 'คิวรี่ GetListTeacher เพื่อแสดงรายชื่อครูฝึกใน ListBox';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListDiary($studentID=''){
        $strQuery = "SELECT * FROM diary WHERE student_id = '{$studentID}' ORDER BY diary_date DESC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListDiary เพื่อแสดงรายการบันทึกรายงานประจำวัน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetMaxDateDiary($studentID=''){
        $strQuery = "SELECT MAX(diary_date) AS maxDate FROM diary WHERE student_id = '{$studentID}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetDetailDiary เพื่อแสดงรายละเอียดบันทึกรายงานประจำวัน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetDetailDiary($diaryID=''){
        $strQuery = "SELECT * FROM diary WHERE diary_id = '$diaryID'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetDetailDiary เพื่อแสดงรายละเอียดบันทึกรายงานประจำวัน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetReportTimeDiary($memberID=''){
        $strQuery = "SELECT
	                    diary.diary_date ,
	                    diary.diary_time_start ,
	                    diary.diary_time_end ,
	                    diary.diary_status,
	                    diary.diary_leave,
	                    CONCAT(student.student_firstname ,' ' ,student.student_lastname) AS studentName,
	                    CONCAT(trainer.trainer_firstname,' ',trainer.trainer_lastname) AS trainerName
                      FROM diary
                        INNER JOIN student ON(diary.student_id = student.student_id)
                        LEFT JOIN trainer ON(student.trainer_id=trainer.trainer_id)
                      WHERE student.member_id = '{$memberID}'
                      ORDER BY diary.diary_date ASC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GatReportTimeDiary เพื่อแสดงรายงานตารางเวลาปฏิบัติงานของนักศึกษาฝึกงาน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetReportDiary($memberID=''){
        $strQuery = "SELECT
	                    diary.diary_date,
	                    diary.diary_job,
	                    diary.diary_problem,
	                    CONCAT(student.student_firstname ,' ' ,student.student_lastname) AS studentName,
	                    CONCAT(trainer.trainer_firstname,' ',trainer.trainer_lastname) AS trainerName,
	                    CONCAT(teacher.teacher_firstname,' ',teacher.teacher_lastname) AS teacherName
                      FROM diary
                        INNER JOIN student ON(diary.student_id = student.student_id)
                        LEFT JOIN trainer ON(student.trainer_id=trainer.trainer_id)
                        LEFT JOIN teacher ON(student.teacher_id=teacher.teacher_id)
                      WHERE diary.diary_status = 'diary' AND student.member_id = '{$memberID}'
                      ORDER BY diary.diary_date ASC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetReportDiary เพื่อแสดงบันทึกการปฏิบัติงานของนักศึกษาฝึกงาน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetTitleRepeotTimeDiary($memberID=''){
        $strQuery = "SELECT
	                    student.student_degree ,
	                    student.student_department,
	                    MIN(diary.diary_date) AS beginDate,
	                    MAX(diary.diary_date) AS endDate,
	                    COUNT(IF(diary.diary_status='diary',1,NULL)) AS numDiary,
	                    COUNT(IF(diary.diary_status='errand',1,NULL)) AS numErrand,
	                    COUNT(IF(diary.diary_status='absent',1,NULL)) AS numAbsent,
	                    COUNT(IF(diary.diary_status='sick',1,NULL)) AS numSick
                      FROM student
                        INNER JOIN diary ON(student.student_id = diary.student_id)
                      WHERE student.member_id = '{$memberID}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GatTitleRepeotTimeDiary เพื่อแสดงข้อมูลหัวตารางเวลาปฏิบัติงานของนักศึกษาฝึกงาน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetListDegree(){
        $strQuery = "SELECT * FROM status WHERE status_type = 'degree'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListDegree เพื่อแสดงรายการสถานนะ ระดับชั้น ใน Listbox';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListGroup(){
        $strQuery = "SELECT * FROM status WHERE status_type = 'group'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListGroup เพื่อแสดงรายการสถานนะ กลุ่ม ใน Listbox';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListSex(){
        $strQuery = "SELECT * FROM status WHERE status_type = 'sex'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListSex เพื่อแสดงรายการสถานนะ เพศ ใน RadioButton';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListNational(){
        $strQuery = "SELECT * FROM status WHERE status_type = 'national'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListNational เพื่อแสดงรายการสถานนะ สัญชาติ ใน Listbox';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListReligion(){
        $strQuery = "SELECT * FROM status WHERE status_type = 'religion'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListReligion เพื่อแสดงรายการสถานนะ ศาสนา ใน Listbox';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListBlood(){
        $strQuery = "SELECT * FROM status WHERE status_type = 'blood'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListReligion เพื่อแสดงรายการสถานนะ กรุ๊ปเลือด ใน Listbox';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListRestday(){
        $strQuery = "SELECT * FROM status WHERE status_type = 'restday'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListRestday เพื่อแสดงรายการสถานนะ การลา ใน Listbox';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetDetailDiaryInMain($studentID=''){
        $strQuery = "SELECT * FROM diary
                      WHERE diary_date = CURDATE()
                      AND student_id = '{$studentID}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GatTitleRepeotTimeDiary เพื่อแสดงข้อมูลหัวตารางเวลาปฏิบัติงานของนักศึกษาฝึกงาน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetNumStudentInCompany(){
        $strQuery = "SELECT
	                    COUNT(student.student_id) AS numStudent ,
	                    company.company_name
                      FROM student
                        LEFT JOIN company ON(student.company_id = company.company_id)
                      GROUP BY company.company_id
                      ORDER BY company.company_name ASC LIMIT 10";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetNumStudentInCompany เพื่อแสดงจำนวนนักศึกษาฝึกงานในสถานประกอบการ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

}