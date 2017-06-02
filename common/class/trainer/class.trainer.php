<?php

/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/20/2016 AD
 * Time: 21:35
 */
class Trainer
{
    function GetMaxTrainerID(){
        $strQuery = "SELECT MAX(trainer_id) AS maxID FROM Trainer";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getMaxTrainerID เพื่อแสดง ID ของครูฝึก/สถานประกอบการล่าสุด';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetDetailTrainer($memberID='',$trainerID=''){
        if (isset($trainerID)){
            $wherebyID = "trainer_id = '".$trainerID."'";
        }else{
            $wherebyID = "member_id = '".$memberID."'";
        }
        $strQuery = "SELECT * FROM trainer WHERE $wherebyID";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getTrainerDetail เพื่อแสดง รายละเอียดของครูฝึก';
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

    function GetListCompany($companyID=''){
        $strQuery = "SELECT * FROM company WHERE company_id != '$companyID'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ getCompanyList เพื่อแสดงข้อมูลสถานประกอบการ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListStudentScore($memberID=''){
        $strQuery = "SELECT * FROM student 
                        LEFT JOIN trainer ON (student.trainer_id=trainer.trainer_id) 
                        LEFT JOIN score ON (student.student_id=score.student_id)
                      WHERE trainer.member_id = '{$memberID}'
                      ";
//        AND student.student_training_end <= CURDATE()
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStudentScore เพื่อแสดงรายชื่อนักศึกษาฝึกงาน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetDetailStudentScoreForm($studentID=''){
        $strQuery = "SELECT 
                        student.student_code,
                        student.student_sex,
                        CONCAT(student.student_firstname,' ',student.student_lastname) AS studentName,
                        student.student_degree,
                        student.student_year,
                        student.student_department,
                        student.student_group,
                        student.student_training_start,
                        student.student_training_end,
                        student.company_id,
                        COUNT(IF(diary.diary_status='diary',1,NULL)) AS numWork,
                        COUNT(IF(diary.diary_status='sick',1,NULL)) AS numSick,
                        COUNT(IF(diary.diary_status='errand',1,NULL)) AS numErrand,
                        COUNT(IF(diary.diary_status='absent',1,NULL)) AS numAbsent
                      FROM student LEFT JOIN diary ON (student.student_id=diary.student_id)
                      WHERE student.student_id = '{$studentID}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetDetailStudentScoreForm เพื่อแสดง รายละเอียดนักศึกษาฝึกงาน ในแบบประเมินการฝึกงาน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

    function GetListPrefix(){
        $strQuery = "SELECT * FROM status WHERE status_type = 'prefix_name'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListPrefix เพื่อแสดงรายการสถานนะ คำนำหน้าชื่อ ใน RadioButton';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListStudent($memberID='',$degree='',$department=''){
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
        $strQuery = "SELECT student.student_id,
                            student.student_code,
                            CONCAT(student.student_firstname ,' ',student.student_lastname) AS studentName ,
                            student.student_sex,
	                        student.student_degree ,
	                        student.student_year ,
	                        student.student_department ,
	                        student.member_id,
	                        student.student_training_start,
	                        student.student_training_end,
	                        student.student_score_trainer,
	                        diary.diary_status,
	                        diary.diary_id
                      FROM student 
                            LEFT JOIN trainer ON (student.trainer_id=trainer.trainer_id)
                            LEFT JOIN diary ON(student.student_id=diary.student_id AND diary.diary_date = curdate())
                      WHERE trainer.member_id = '{$memberID}' {$whereDegree} {$whereDepartment}
                      ORDER BY student.student_degree ASC,
	                            student.student_year DESC,
	                            student_department ASC
                     ";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStudent เพื่อแสดงรายชื่อนักศึกษาฝึกงาน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListMainEvaluation($degree='',$depatrment='',$year=''){
        $strQuery = "SELECT * FROM evaluation
                      JOIN evaluation_question ON (evaluation.evaluation_id=evaluation_question.evaluation_id)
                      WHERE 1
                        AND evaluation.evaluation_assessor = 'trainer'
                        AND evaluation.evaluation_type = 'score'
                        AND evaluation_question.question_type = 'maintopic'
                        AND evaluation.evaluation_std_degree LIKE '%{$degree}%'
                        AND evaluation.evaluation_std_department LIKE '%{$depatrment}%'
                        AND evaluation.evaluation_std_year LIKE '%{$year}%'
                      ORDER BY evaluation_question.question_topic ASC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListMainQuestion เพื่อแสดงรายการแบบประเมินหัวข้อหลัก';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListSubEvaluation($evaluationID='',$questionID=''){
        $strQuery = "SELECT * FROM evaluation_question
                      WHERE evaluation_id = '{$evaluationID}' 
                        AND question_sub_id = '{$questionID}' 
                        AND question_type = 'subtopic'
                      ORDER BY question_topic ASC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListQuestion เพื่อแสดงรายการแบบประเมิน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListMainQuestion($degree='',$depatrment='',$year=''){
        $strQuery = "SELECT * FROM evaluation
                      JOIN evaluation_question ON (evaluation.evaluation_id=evaluation_question.evaluation_id)
                      WHERE 1
                        AND evaluation.evaluation_assessor = 'trainer'
                        AND evaluation.evaluation_type = 'check'
                        AND evaluation_question.question_type = 'maintopic'
                        AND evaluation.evaluation_std_degree LIKE '%{$degree}%'
                        AND evaluation.evaluation_std_department LIKE '%{$depatrment}%'
                        AND evaluation.evaluation_std_year LIKE '%{$year}%'
                      ORDER BY evaluation_question.question_topic ASC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListMainQuestion เพื่อแสดงรายการแบบประเมินหัวข้อหลัก';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListScore($studentID='',$questionID=''){
        $strQuery = "SELECT * FROM evaluation_score
                      WHERE 1
                        AND student_id = '$studentID'
                        AND question_id = '{$questionID}' ";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListQuestion เพื่อแสดงรายการแบบประเมิน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetEvaluationComment($studentID='',$assessorID=''){
        $strQuery = "SELECT * FROM evaluation_comment 
                      WHERE 1 
                       AND student_id = '{$studentID}'
                       AND comment_assessor_id = '{$assessorID}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetEvaluationComment เพื่อแสดง คอมเม้นในแบบประเมิน';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }

}