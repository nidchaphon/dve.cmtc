<?php

/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/20/2016 AD
 * Time: 21:36
 */
class Teacher
{
    function GetMaxTeacherID(){
        $strQuery = "SELECT MAX(teacher_id) AS maxID FROM teacher";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getMaxTeacherID เพื่อแสดง ID ของอาจารย์นิเทศล่าสุด';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetDetailTeacher($memberID='',$teacherID=''){
        if (isset($teacherID)){
            $wherebyID = "teacher_id = '".$teacherID."'";
        }else{
            $wherebyID = "member_id = '".$memberID."'";
        }
        $strQuery = "SELECT * FROM teacher WHERE $wherebyID";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getTeacherDetail เพื่อแสดง รายละเอียดของอาจารย์นิเทศ';
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

    function GetListAppointment($teacherID){
        $strQuery = "SELECT * FROM appointment 
                      INNER JOIN company ON (appointment.company_id = company.company_id) 
                      WHERE teacher_id = '{$teacherID}'
                      ORDER BY appointment_date DESC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListAppointment เพื่อรายการนัดหมายการนิเทศ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetDetailAppointment($appointmentID=''){
        $strQuery = "SELECT * 
                      FROM appointment 
                        INNER JOIN company ON (appointment.company_id=company.company_id)
                      WHERE appointment_id = '{$appointmentID}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetDetailAppointment เพื่อแสดง ข้อมูลการนัดหมายการนิเทศ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetListStudentInAppointment($appointmentID=''){
        $strQuery = "SELECT * 
                      FROM appointment 
                          INNER JOIN company ON (appointment.company_id=company.company_id)
                          LEFT JOIN student ON (company.company_id=student.company_id)
                      WHERE appointment.appointment_id = '{$appointmentID}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStudentInAppointment เพื่อแสดง รายชื่อนักศึกษาฝึกงานใน ข้อมูลการนัดหมายการนิเทศ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListTrainerInAppointment($appointmentID=''){
        $strQuery = "SELECT * 
                      FROM appointment 
                          INNER JOIN company ON (appointment.company_id=company.company_id)
                          LEFT JOIN trainer ON (trainer.company_id=company.company_id)
                      WHERE appointment.appointment_id = '{$appointmentID}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStudentInAppointment เพื่อแสดง รายชื่อนักศึกษาฝึกงานใน ข้อมูลการนัดหมายการนิเทศ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetDetailStudentScoreForm($memberID='',$degree='',$department='',$year=''){
        if ($degree == ''){
            $whereDegree = "";
        }else{
            $whereDegree = "AND student.student_degree = '".$degree."'";
        }
        if ($department == ''){
            $whereDepartment = "";
        }else{
            $whereDepartment = "AND student.student_department = '".$department."'";
        }
        if ($year == ''){
            $whereYear = "";
        }else{
            $whereYear = "AND LEFT(student.student_code,2) = '".$year."'";
        }
        $strQuery = "SELECT * FROM student 
                        LEFT JOIN teacher ON (student.teacher_id=teacher.teacher_id) 
                        LEFT JOIN score ON (student.student_id=score.student_id)
                      WHERE teacher.member_id = '{$memberID}' {$whereDegree} {$whereDepartment} {$whereYear}
                      ORDER BY  student.student_degree ASC,
	                            student.student_year DESC,
	                            student_department ASC,
	                            student.student_code ASC
                      ";
//        AND student.student_training_end <= CURDATE()
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStudent เพื่อแสดงรายชื่อนักศึกษาฝึกงาน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetStudentScore($studentID=''){
        $strQuery = "SELECT *
                      FROM score
                      WHERE student_id = '{$studentID}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetStudentScore เพื่อแสดง คะแนน แบบประเมินการฝึกงาน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetListStudentInCompany($companyID=''){
        $strQuery = "SELECT * FROM student 
                        LEFT JOIN company ON (student.company_id=company.company_id)
                      WHERE company.company_id = '{$companyID}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStudentInCompany เพื่อแสดงรายชื่อนักศึกษาฝึกงานในสถานประกอบการ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListTrainerInCompany($companyID=''){
        $strQuery = "SELECT * FROM trainer 
                        LEFT JOIN company ON (trainer.company_id=company.company_id)
                      WHERE company.company_id = '{$companyID}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListTrainerInCompany เพื่อแสดงรายชื่อผู้ควบคุม/ครูฝึกในสถานประกอบการ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListStudent($memberID='',$degree='',$department='',$year=''){
        if ($degree == ''){
            $whereDegree = "";
        }else{
            $whereDegree = "AND student.student_degree = '".$degree."'";
        }
        if ($department == ''){
            $whereDepartment = "";
        }else{
            $whereDepartment = "AND student.student_department = '".$department."'";
        }
        if ($year == ''){
            $whereYear = "";
        }else{
            $whereYear = "AND LEFT(student.student_code,2) = '".$year."'";
        }
        $strQuery = "SELECT student.student_id,
                            student.student_code,
                            CONCAT(student.student_firstname ,' ',student.student_lastname) AS studentName ,
                            student.student_sex,
	                        student.student_degree ,
	                        student.student_year ,
	                        student.student_department ,
	                        student.student_training_start,
	                        student.student_training_end,
	                        student.student_score_teacher,
	                        student.member_id,
	                        diary.diary_status,
	                        diary.diary_id,
	                        diary.diary_time_start,
	                        diary.diary_time_end,
	                        company.company_name,
	                        company.company_id
                      FROM student
                            LEFT JOIN teacher ON (student.teacher_id=teacher.teacher_id or student.teacher2_id=teacher.teacher_id)
                            LEFT JOIN diary ON(student.student_id=diary.student_id AND diary.diary_date = curdate())
                            LEFT JOIN company ON(student.company_id=company.company_id)
                      WHERE teacher.member_id = '{$memberID}' {$whereDegree} {$whereDepartment} {$whereYear}
                      ORDER BY  student.student_degree ASC,
	                            student.student_year DESC,
	                            student_department ASC,
	                            student.student_code ASC
                     ";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStudent เพื่อแสดงรายชื่อนักศึกษาฝึกงาน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListStatus($statusType=''){
        $strQuery = "SELECT * FROM status 
                     WHERE status_type = '{$statusType}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStatus เพื่อแสดงรายการสถานะ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListSTDYear(){
        $strQuery = "SELECT LEFT(student_code,2) AS stdYear FROM student GROUP BY LEFT(student_code,2) ORDER BY LEFT(student_code,2) ASC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStatus เพื่อแสดงรายการรุ่นปี';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListDepartment(){
        $strQuery = "SELECT status_text,status_value 
                      FROM student 
                        LEFT JOIN `status` ON status_value=student_department 
                      WHERE 1 AND status_value != ''
                      GROUP BY student_department";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStatus เพื่อแสดงรายการสาขาวิชา';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListDegree(){
        $strQuery = "SELECT status_text,status_value 
                      FROM student 
                        LEFT JOIN `status` ON status_value=student_degree 
                      WHERE 1 AND status_value != ''
                      GROUP BY student_degree";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStatus เพื่อแสดงรายการระดับชั้น';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListNumStudentInYear($memberID=''){
        $strQuery = "SELECT LEFT(student_code,2) AS yearCode,
                        student.student_degree,
                        student.student_department,
                        COUNT(student.student_id) AS totalStd,
                        COUNT(IF(score.teacher_status='0'||score.grade_teacher_status='0',1,NULL)) AS totalNotScore
                      FROM student 
                        LEFT JOIN score ON (student.student_id=score.student_id)
                        JOIN teacher ON (student.teacher_id=teacher.teacher_id)
                      WHERE 1 AND teacher.member_id = '{$memberID}'
                      GROUP BY student.student_department,
                                student.student_degree,
                                LEFT(student_code,2)";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStatus เพื่อแสดงรายการรุ่นปี';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetDetailStatusType($status=''){
        $strQuery = "SELECT * FROM `status` WHERE status_value = '{$status}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetDetailStatusType เพื่อแสดง ข้อมูลสถานะ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

}