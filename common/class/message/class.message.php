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

    function GetListTrainerForTeacher($memberID=''){
        $strQuery = "SELECT trainer.trainer_prefix,
                            trainer.trainer_firstname,
                            trainer.trainer_lastname,
                            trainer.trainer_picture,
                            trainer.member_id,
                            company.company_name
                      FROM trainer 
                        LEFT JOIN student ON (trainer.trainer_id=student.trainer_id)
                        LEFT JOIN teacher ON (student.teacher_id=teacher.teacher_id)
                        LEFT JOIN company ON (trainer.company_id=company.company_id)
                        LEFT JOIN chat ON trainer.member_id = chat.chat_user2
                      WHERE 1 AND teacher.member_id = '{$memberID}'
                      GROUP BY trainer.trainer_id
                      ORDER BY chat.chat_id DESC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListTrainer เพื่อแสดงรายชื่อครูฝึกสำหรับอาจารย์นิเทศ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListStudentForTeacher($memberID=''){
        $strQuery = "SELECT student.student_code,
                            student.student_degree,
                            student.student_year,
                            student.student_department,
                            student.student_firstname,
                            student.student_lastname,
                            student.student_sex,
                            student.student_picture,
                            student.member_id
                      FROM student 
                        LEFT JOIN teacher ON (student.teacher_id=teacher.teacher_id)
                        LEFT JOIN chat ON student.member_id = chat.chat_user2
                      WHERE 1 AND teacher.member_id = '{$memberID}'
                      GROUP BY student_id
                      ORDER BY chat.chat_id DESC,
                               student_code ASC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListStudent เพื่อแสดงรายชื่อนักศึกษาฝึกงานสำหรับอาจารย์นิเทศ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListTeacherForTrainer($memberID=''){
        $strQuery = "SELECT teacher.teacher_firstname,
                            teacher.teacher_lastname,
                            teacher.member_id,
                            teacher.teacher_picture
                      FROM teacher 
                        LEFT JOIN student ON (teacher.teacher_id=student.teacher_id)
                        LEFT JOIN trainer ON (student.trainer_id=trainer.trainer_id)
                        LEFT JOIN chat ON teacher.member_id = chat.chat_user2
                      WHERE 1 AND trainer.member_id = '{$memberID}'
                      GROUP BY teacher.teacher_id
                      ORDER BY chat.chat_id DESC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListTeacher เพื่อแสดงรายชื่ออาจารย์นิเทศสำหรับครูฝึก';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListStudentForTrainer($memberID=''){
        $strQuery = "SELECT student.student_code,
                            student.student_degree,
                            student.student_department,
                            student.student_firstname,
                            student.student_lastname,
                            student.student_sex,
                            student.student_picture,
                            student.member_id
                      FROM student
                        JOIN company ON student.company_id = company.company_id 
                        JOIN trainer ON company.company_id = trainer.company_id 
                        LEFT JOIN chat ON student.member_id = chat.chat_user2
                      WHERE 1 AND trainer.member_id = '{$memberID}' 
                      GROUP BY student_id
                      ORDER BY chat.chat_id DESC,
                                student.student_code ASC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListTeacher เพื่อแสดงรายชื่อนักศึกษาสำหรับครูฝึก';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListTeacherForStudent($memberID=''){
        $strQuery = "SELECT teacher.teacher_firstname,
                            teacher.teacher_lastname,
                            teacher.teacher_picture,
                            teacher.member_id
                      FROM teacher
                        JOIN student ON teacher.teacher_id = student.teacher_id
                        LEFT JOIN chat ON teacher.member_id = chat.chat_user2
                      WHERE 1 AND student.member_id = '{$memberID}' 
                      GROUP BY teacher.teacher_id
                      ORDER BY chat.chat_id DESC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListTeacher เพื่อแสดงรายชื่ออาจารย์นิเทศสำหรับนักศึกษา';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListTrainerForStudent($memberID=''){
        $strQuery = "SELECT trainer.trainer_prefix,
                            trainer.trainer_firstname,
                            trainer.trainer_lastname,
                            trainer.trainer_picture,
                            trainer.member_id,
                            company.company_name
                      FROM trainer 
                        LEFT JOIN student ON (trainer.trainer_id=student.trainer_id)
                        LEFT JOIN company ON (trainer.company_id=company.company_id)
                        LEFT JOIN chat ON trainer.member_id = chat.chat_user2
                      WHERE 1 AND student.member_id = '{$memberID}'
                      GROUP BY trainer.trainer_id
                      ORDER BY chat.chat_id DESC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListTrainer เพื่อแสดงรายชื่อครูฝึกสำหรับนักศึกษา';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListStudentForStudent($memberID=''){
        $strQuery = "SELECT student.student_code,
                            student.student_degree,
                            student.student_department,
                            student.student_firstname,
                            student.student_lastname,
                            student.student_sex,
                            student.student_picture,
                            student.member_id
                      FROM student
                        LEFT JOIN chat ON (member_id = chat.chat_user2)
                      WHERE 1 
                        AND LEFT(student_code,2) = (SELECT LEFT(student_code,2) AS stdcode FROM student WHERE member_id='{$memberID}')
                        AND student_degree = (SELECT student_degree FROM student WHERE member_id='{$memberID}')
                        AND student_department = (SELECT student_department FROM student WHERE member_id='{$memberID}')
                        AND member_id != '{$memberID}'
                      GROUP BY student_id
                      ORDER BY chat.chat_id DESC, student_code ASC";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListTrainer เพื่อแสดงรายชื่อครูฝึกสำหรับนักศึกษา';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetListTeacher(){
        $strQuery = "SELECT * , COUNT(IF(chat.chat_status='0',chat.chat_id,NULL))AS noneRead FROM teacher INNER JOIN chat ON (teacher.member_id=chat_user1)";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetListTeacher เพื่อแสดงรายชื่ออาจารย์นิเทศสำหรับครูฝึก';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        return $resultQuery;
    }

    function GetDetailContact($status='',$memberID=''){
        $strQuery = "SELECT * 
                      FROM {$status}
                        LEFT JOIN member ON ({$status}.member_id=member.member_id)
                      WHERE member.member_id = '{$memberID}'";
        if ($_GET['debug']=='on'){
            echo 'คิวรี่ GetDetailContact เพื่อแสดงรายละเอียดข้อมูลผู้ติดต่อ';
            echo "<pre>$strQuery</pre>";
        }
        $resultQuery = mysql_query($strQuery);
        $result = mysql_fetch_assoc($resultQuery);
        return $result;
    }


}