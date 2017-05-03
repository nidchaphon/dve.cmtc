<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 2/11/2017 AD
 * Time: 13:39
 */
ob_start();

require ('../../config/dbconnection.php');
require ('../../config/php_config.php');
require_once('../../common/mpdf/mpdf.php');
include ("../../common/class/student/class.student.php");
include ("../../common/class/trainer/class.trainer.php");
include ("../../common/class/teacher/class.teacher.php");
include ("../../common/class/company/class.company.php");

$classTrainer = new Trainer();
$classStudent = new Student();
$classTeacher = new Teacher();
$classCompany = new Company();

$valStudent = $classTrainer->GetDetailStudentScoreForm($_GET['studentID']);
$valDegree = $classStudent->GetStatusDetailStudent($valStudent['student_degree']);
$valDepartment = $classStudent->GetStatusDetailStudent($valStudent['student_department']);
$valScore = $classTrainer->GetStudentScore($_GET['studentID']);
$valTeacher = $classTeacher->GetDetailTeacher($_COOKIE['memberID'],$teacherID);
$valCompany = $classCompany->GetDetailCompany($valStudent['company_id']);

$scoreTrainer = $valScore['score_trainer_1_1']+$valScore['score_trainer_1_2']+$valScore['score_trainer_1_3']+$valScore['score_trainer_2_1']+$valScore['score_trainer_2_2']+$valScore['score_trainer_3_1'];
$scoreTeacher = $valScore['score_teacher_1']+$valScore['score_teacher_2']+$valScore['score_teacher_3'];
$scoreTotal = $scoreTrainer+$scoreTeacher+$valScore['score_report']+$valScore['score_join'];

if ($scoreTotal >= 80 && $scoreTotal <= 100){
    $grade = "4.0";
}elseif ($scoreTotal >= 75 && $scoreTotal <= 79){
    $grade = "3.5";
}elseif ($scoreTotal >= 70 && $scoreTotal <= 74){
    $grade = "3.0";
}elseif ($scoreTotal >= 65 && $scoreTotal <= 69){
    $grade = "2.5";
}elseif ($scoreTotal >= 60 && $scoreTotal <= 64){
    $grade = "2.0";
}elseif ($scoreTotal >= 55 && $scoreTotal <= 59){
    $grade = "1.5";
}elseif ($scoreTotal >= 50 && $scoreTotal <= 54){
    $grade = "1.0";
}elseif ($scoreTotal >= 0 && $scoreTotal <= 49){
    $grade = "0";
}

?>

<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">

<style type="text/css">
    <!--
    @page rotated { size: landscape; }
    .style1 {
        font-family: "TH SarabunPSK";
        font-size: 18pt;
        font-weight: bold;
    }
    .style2 {
        font-family: "TH SarabunPSK";
        font-size: 16pt;
        font-weight: bold;
    }
    .style3 {
        font-family: "TH SarabunPSK";
        font-size: 16pt;
    }
    -->
</style>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</head>
<body>
<div class=Section2>
    <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td width="291" height="50" align="center"><span class="style1"><strong>การวัดผลและประเมินผลการฝึกประสบการณ์</strong></span></td>
        </tr>
        <tr>
            <td height="27" align="center"><span class="style2"><?php if ($valStudent['student_sex']=='male'){echo "นาย";}if ($valStudent['student_sex']=='female'){echo "นางสาว";} echo $valStudent['studentName']." ระดับ ".$valDegree['status_text']." ปี ".$valStudent['student_year']." แผนกวิชา ".$valDepartment['status_text'];?></span></td>
        </tr>
        <tr>
            <td height="27" align="center"><span class="style2"><?php echo "รหัสนักศึกษา ".$valStudent['student_code']." "." ชื่อสถานประกอบการ ".$valCompany['company_name']; ?></span></td>
        </tr>
    </table><br>

    <table bordercolor="#424242" width="100%" height="78" border="1"  align="center" cellpadding="3" cellspacing="0" class="style3">
        <thead>
        <tr style="background: rgba(0,0,0,0.07);">
            <th height="50" width="50%" style="text-align: center; vertical-align: middle;">แนวทางเกณฑ์การวัดผลและประเมินผล</th>
            <th width="10%" style="text-align: center; vertical-align: middle;">คะแนนเต็ม</th>
            <th width="10%" style="text-align: center; vertical-align: middle;">คะแนนที่ได้</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td height="35" style="text-align: left">&nbsp;แบบประเมินการฝึกประสบการณ์โดยสถานประกอบการ</td>
            <td style="text-align: center; vertical-align: middle;">50</td>
            <td style="text-align: center; vertical-align: middle;">
                <?php echo $scoreTrainer;?>
            </td>
        </tr>
        <tr>
            <td height="35" style="text-align: left">&nbsp;แบบประเมินการฝึกประสบการณ์โดยอาจารย์นิเทศ</td>
            <td style="text-align: center; vertical-align: middle;">20</td>
            <td style="text-align: center; vertical-align: middle;">
                <?php echo $scoreTeacher;?>
            </td>
        </tr>
        <tr>
            <td height="35" style="text-align: left">&nbsp;รายงานฉบับสมบูรณ์</td>
            <td style="text-align: center; vertical-align: middle;">20</td>
            <td style="text-align: center; vertical-align: middle;">
                <?php echo $valScore['score_report'];?>
            </td>
        </tr>
        <tr>
            <td height="35" style="text-align: left">&nbsp;การเข้าร่วมปฐมนิเทศ, ปัจฉิมนิเทศที่วิทยาลัย</td>
            <td style="text-align: center; vertical-align: middle;">10</td>
            <td style="text-align: center; vertical-align: middle;">
                <?php echo $valScore['score_join'];?>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr style="background: rgba(0,0,0,0.07);">
            <th height="40" style="text-align: right">คะแนนรวมทั้งสิ้น&nbsp;</th>
            <th style="text-align: center">100</th>
            <th style="text-align: center"><?php echo $scoreTotal;?></th>
        </tr>
        <tr style="background: rgba(0,0,0,0.07);">
            <th height="40" style="text-align: right" colspan="2">ระดับเกรด&nbsp;</th>
            <th style="text-align: center"><?php echo $grade;?></th>
        </tr>
        </tfoot>
    </table>

    <br><br>
    <table width="100%" border="0">
        <tr>
            <td width="15%"></td>
            <td width="10%" style="text-align: right; vertical-align: top;" >ลงชื่อ</td>
            <td width="40%" align="center">.............................................  <br><br> <?php echo "( ".$valTeacher['teacher_firstname']." ".$valTeacher['teacher_lastname']." ) <br><br> ........../....................../............." ?> </td>
            <td width="40%" align="left" style="vertical-align: top;">อาจารย์นิเทศ</td>
        </tr>
    </table>

    <br><br>
    <table width="100%" border="0">
        <tr>
            <td width="15%"></td>
            <td width="10%" style="text-align: right; vertical-align: top;" >ลงชื่อ</td>
            <td width="35%" align="center">.............................................  <br><br> <?php echo "( .............................................) <br><br> ........../....................../............." ?> </td>
            <td width="40%" align="left" style="vertical-align: top;">อาจารย์ผู้ควบคุมการฝึกประสบการณ์ประจำแผนก</td>
        </tr>
    </table>
    <br>
    <hr>
    <table width="100%" border="0">
        <thead>
        <tr>
            <td colspan="5" align="center"><strong>เกณฑ์การให้ค่าระดับคะแนน</strong></td>
        </tr>
        <tr>
            <td align="center" width="25%"><strong>คะแนนดิบ</strong></td>
            <td align="center" width="24%"><strong>ระดับเกรด</strong></td>
            <td rowspan="5" width="1%" style="border-right:1px dotted #000;"></td>
            <td align="center" width="25%"><strong>คะแนนดิบ</strong></td>
            <td align="center" width="25%"><strong>ระดับเกรด</strong></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td align="center">80 - 100</td>
            <td align="center">4.0</td>

            <td align="center">60 - 64</td>
            <td align="center">2.0</td>
        </tr>
        <tr>
            <td align="center">75 - 79</td>
            <td align="center">4.5</td>

            <td align="center">55 - 59</td>
            <td align="center">1.5</td>
        </tr>
        <tr>
            <td align="center">70 - 74</td>
            <td align="center">3.0</td>

            <td align="center">50 - 54</td>
            <td align="center">1.0</td>
        </tr>
        <tr>
            <td align="center">65 - 69</td>
            <td align="center">2.5</td>

            <td align="center">0 - 49</td>
            <td align="center">0</td>
        </tr>
        </tbody>
    </table>
    <hr>
</div>
</body>
</html>
<?Php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', 'THSaraban');
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->SetTitle('การวัดผลและประเมินผลการฝึกประสบการณ์');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>
<!--ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF/MyPDF.pdf">คลิกที่นี้</a>-->