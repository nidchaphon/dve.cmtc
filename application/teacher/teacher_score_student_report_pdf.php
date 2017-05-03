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

$classTrainer = new Trainer();
$classStudent = new Student();
$classTeacher = new Teacher();

$valStudent = $classTrainer->GetDetailStudentScoreForm($_GET['studentID']);
$valDegree = $classStudent->GetStatusDetailStudent($valStudent['student_degree']);
$valDepartment = $classStudent->GetStatusDetailStudent($valStudent['student_department']);
$valScore = $classTrainer->GetStudentScore($_GET['studentID']);
$valTeacher = $classTeacher->GetDetailTeacher($memberID,$valScore['teacher_id']);

//echo strtotime("2008-10-31");
//echo date("w",strtotime("2017-02-15"));
?>

<!--<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">-->

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
            <td width="291" height="50" align="center"><span class="style1"><strong>แบบประเมินการฝึกประสบการณ์โดยอาจารย์นิเทศ</strong></span></td>
        </tr>
        <tr>
            <td height="27" align="center"><span class="style2"><?php if ($valStudent['student_sex']=='male'){echo "นาย";}if ($valStudent['student_sex']=='female'){echo "นางสาว";} echo $valStudent['studentName']." ระดับ ".$valDegree['status_text']." ปี ".$valStudent['student_year']." แผนกวิชา ".$valDepartment['status_text'];?></span></td>
        </tr>
    </table><br>
    <table bordercolor="#424242" width="100%" height="78" border="1"  align="center" cellpadding="3" cellspacing="0" class="style3">
        <thead>
        <tr style="background: rgba(0,0,0,0.07);">
            <th width="26%" height="50" style="text-align: center; vertical-align: middle;">หัวข้อการประเมิน</th>
            <th width="50%" style="text-align: center; vertical-align: middle;">รายละเอียดการพิจารณา</th>
            <th width="12%" style="text-align: center; vertical-align: middle;">คะแนนเต็ม</th>
            <th width="12%" style="text-align: center; vertical-align: middle;">คะแนนที่ได้</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td height="100" style="text-align: left; vertical-align: top;"><br><strong>&nbsp;1. เจตคติ</strong></td>
            <td style="text-align: left"><ul>
                    <li><p>ตรงต่อเวลา และมาปฏิบัติงานอย่างสม่ำเสมอ</p></li>
                    <li><p>การแต่งกายสุภาพเรียบร้อย และถูกระเบียบ</p></li>
                    <li>มีความตั้งใจ อดทน และขยันขันแข็งในการทำงาน</li>
                    <li>มีทัศนคติที่ดีต่องานและหน่วยฝึกงาน</li>
                </ul>
            </td>
            <td style="text-align: center; vertical-align: middle;">5</td>
            <td style="text-align: center; vertical-align: middle;">
                <?php echo $valScore['score_teacher_1'];?>
            </td>
        </tr>
        <tr>
            <td height="110" style="text-align: left; vertical-align: top;"><br><strong>&nbsp;2. ทักษะการทำงาน</strong></td>
            <td style="text-align: left"><ul>
                    <li>ปฏิบัติงานถูกต้องตามลักษณะงาน</li>
                    <li>คำนึงถึงความปลอดภัยในขณะปฏิบัติงาน</li>
                    <li>รู้จักใช้เครื่องมือ อุปกรณ์ต่างๆ อย่างถูกต้องและระมัดระวัง</li>
                    <li>มีความคิดริเริ่มสร้างสรรค์</li>
                </ul>
            </td>
            <td style="text-align: center; vertical-align: middle;">5</td>
            <td style="text-align: center; vertical-align: middle;">
                <?php echo $valScore['score_teacher_2'];?>
            </td>
        </tr>
        <tr>
            <td height="80" style="text-align: left; vertical-align: top;"><br><strong>&nbsp;3. การบันทึกการฝึกงาน</strong></td>
            <td style="text-align: left"><ul>
                    <li>บันทึกข้อมูลประวัติครบถ้วนชัดเจน</li>
                    <li>ลงเวลาปฏิบัติงานถูกต้อง</li>
                    <li>บันทึกการปฏิบัติงานละเอียดสมบูรณ์</li>
                </ul>
            </td>
            <td style="text-align: center; vertical-align: middle;">10</td>
            <td style="text-align: center; vertical-align: middle;">
                <?php echo $valScore['score_teacher_3'];?>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr style="background: rgba(0,0,0,0.07);">
            <th colspan="2" height="40" style="text-align: center">คะแนนรวมทั้งสิ้น</th>
            <th style="text-align: center">20</th>
            <th style="text-align: center"><span id="sum"><?php echo $valScore['score_teacher_1']+$valScore['score_teacher_2']+$valScore['score_teacher_3'];?></span></th>
        </tr>
        </tfoot>
    </table>

    <p style="text-align: justify; text-indent: 50px;"><strong>ข้อบกพร่องที่ควรแก้ไขปรับปรุง </strong><?php echo nl2br($valScore['score_teacher_defect']==''?"-":$valScore['score_teacher_defect']);?></p><br>
    <p style="text-align: justify; text-indent: 50px;"><strong>ข้อเสนอแนะอื่นๆ </strong><?php echo nl2br($valScore['score_teacher_counsel']==''?"-":$valScore['score_teacher_counsel']);?></p>
    <br>
    <table width="100%" border="0">
        <tr>
            <td width="20%"></td>
            <td width="5%" style="text-align: right; vertical-align: top;" >ลงชื่อ</td>
            <td width="35%" align="center">.............................................  <br><br> <?php echo "( ".$valTeacher['teacher_firstname']." ".$valTeacher['teacher_lastname']." )<br> <br>ตำแหน่ง ".$valTeacher['teacher_rank']."<br><br>........../....................../............."; ?> </td>
            <td width="40%" align="left" style="vertical-align: top;">ผู้ประเมิน (อาจารย์นิเทศ)</td>
        </tr>
    </table>
</div>
</body>
</html>
<?Php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', 'THSaraban');
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->SetTitle('แบบประเมินการฝึกประสบการณ์โดยอาจารย์นิเทศก์');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>
<!--ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF/MyPDF.pdf">คลิกที่นี้</a>-->