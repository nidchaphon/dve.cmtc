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
$valTrainer = $classTrainer->GetDetailTrainer($memberID,$valScore['trainer_id']);

if ($valTrainer['trainer_prefix'] == 'mr'){
    $prefix = "นาย";
}if ($valTrainer['trainer_prefix'] == 'mrs'){
    $prefix = "นาง";
}if ($valTrainer['trainer_prefix'] == 'miss'){
    $prefix = "นางสาว";
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
            <td width="291" height="50" align="center"><span class="style1"><strong>แบบประเมินการฝึกประสบการณ์โดยสถานประกอบการ</strong></span></td>
        </tr>
        <tr>
            <td height="27" align="center"><span class="style2"><?php if ($valStudent['student_sex']=='male'){echo "นาย";}if ($valStudent['student_sex']=='female'){echo "นางสาว";}; echo $valStudent['studentName']." ระดับ ".$valDegree['status_text']." ปี ".$valStudent['student_year']." แผนกวิชา ".$valDepartment['status_text']; ?></span></td>
        </tr>
        <tr>
            <td height="27" align="center"><span class="style2"><?php echo "ระยะเวลาฝึกประสบการณ์ระหว่าง ".DBThaiLongDateFull($valStudent['student_training_start'])." ถึง ".DBThaiLongDateFull($valStudent['student_training_end']);?></span></td>
        </tr>
        <tr>
            <td height="27" align="center"><span class="style2"><?php echo "รวมวัน ฝึกประสบการณ์จริง ".$valStudent['numWork']." วัน ลากิจ ".$valStudent['numErrand']." วัน ลาป่วย ".$valStudent['numSick']." วัน ขาด ".$valStudent['numAbsent']." วัน";?></span></td>
        </tr>
    </table><br>

    <table bordercolor="#424242" width="100%" height="78" border="1"  align="center" cellpadding="0" cellspacing="0" class="style3">
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
            <td height="80" style="text-align: left; vertical-align: top;"><br><strong>1. เจตคติ</strong><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.1 ความประพฤติ</td>
            <td style="text-align: left"><ul>
                    <li>ตรงต่อเวลา และมาปฏิบัติงานอย่างสม่ำเสมอ</li>
                    <li>การแต่งกายสุภาพเรียบร้อย แลถูกระเบียบ</li>
                    <li>ซื่อสัตย์ สุจริต รักษาความลับของสถานประกอบการ</li>
                </ul>
            </td>
            <td style="text-align: center; vertical-align: middle;">10</td>
            <td style="text-align: center; vertical-align: middle;">
                <?php echo $valScore['score_trainer_1_1'];?>
            </td>
        </tr>
        <tr>
            <td height="100" style="text-align: left; vertical-align: top;"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.2 ความตั้งใจและความ<br>รับผิดชอบ</td>
            <td style="text-align: left"><ul>
                    <li>มีความตั้งใจ อดทน และขยันขันแข็งในการทำงาน</li>
                    <li>ปฏิบัติงานตามคำสั่ง และวางตนอยู่ในระเบียบวินัย</li>
                    <li>สามารถแสดงความคิดเห็นและข้อเสนอแนะได้ดี</li>
                    <li>มีทัศนคติที่ดีต่องานและหน่วยฝึกงาน</li>
                </ul>
            </td>
            <td style="text-align: center; vertical-align: middle;">10</td>
            <td style="text-align: center; vertical-align: middle;">
                <?php echo $valScore['score_trainer_1_2'];?>
            </td>
        </tr>
        <tr>
            <td height="80" style="text-align: left; vertical-align: top;"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.3 ความมีมนุษย์สัมพันธ์</td>
            <td style="text-align: left"><ul>
                    <li>มีน้ำใจให้ความร่วมมือ และทำงานร่วมกับผู้อื่นได้ดี</li>
                    <li>สามารถปรับตัวเข้ากับสภาพแวดล้อม</li>
                    <li>สุภาพอ่อนน้อม</li>
                </ul>
            </td>
            <td style="text-align: center; vertical-align: middle;">5</td>
            <td style="text-align: center; vertical-align: middle;">
                <?php echo $valScore['score_trainer_1_3'];?>
            </td>
        </tr>
        <tr>
            <td height="100" style="text-align: left; vertical-align: top;"><br>&nbsp;<strong>2. ทักษะการทำงาน</strong><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.1 ความรู้พื้นฐานทางด้าน<br>เทคนิคและการใช้เครื่องมือเครื่องใช้</td>
            <td style="text-align: left"><ul>
                    <li>ปฏิบัติงานถูกต้องตามลักษณะงาน</li>
                    <li>คำนึงถึงความปลอดภัยในขณะปฏิบัติงาน</li>
                    <li>รู้จักใช้เครื่องมือ อุปกรณ์ต่างๆ อย่างถูกต้องและระมัดระวัง</li>
                </ul>
            </td>
            <td style="text-align: center; vertical-align: middle;">10</td>
            <td style="text-align: center; vertical-align: middle;">
                <?php echo $valScore['score_trainer_2_1'];?>
            </td>
        </tr>
        <tr>
            <td height="80" style="text-align: left; vertical-align: top;"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.2 การประยุกต์ใช้ความรู้ <br>ที่ศึกษามาปฏิบัติงาน</td>
            <td style="text-align: left"><ul>
                    <li>มีความคิดริเริ่มสร้างสรรค์</li>
                    <li>สามารถแก้ปัญหาเฉพาะหน้าในการทำงานได้ดี</li>
                    <li>รู้จักใช้วัสดุอย่างประหยัด</li>
                </ul>
            </td>
            <td style="text-align: center; vertical-align: middle;">5</td>
            <td style="text-align: center; vertical-align: middle;">
                <?php echo $valScore['score_trainer_2_2'];?>
            </td>
        </tr>
        <tr>
            <td height="100" style="text-align: left; vertical-align: top;"><br>&nbsp;<strong>3. ผลงาน</strong><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.1 คุณภาพของงานและ<br>ปริมาณ</td>
            <td style="text-align: left"><ul>
                    <li>ผลงานได้มาตรฐาน</li>
                    <li>มีความรอบคอบในการทำงาน</li>
                    <li>ทำได้ถูกต้องตามขั้นตอน</li>
                    <li>สามารถปฏิบัติงานเสร็จเรียบร้อยภายในเวลาที่กำหนด</li>
                </ul>
            </td>
            <td style="text-align: center; vertical-align: middle;">10</td>
            <td style="text-align: center; vertical-align: middle;">
                <?php echo $valScore['score_trainer_3_1'];?>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr style="background: rgba(0,0,0,0.07);">
            <th height="40" colspan="2" style="text-align: right">คะแนนรวมทั้งสิ้น &nbsp;</th>
            <th style="text-align: center">50</th>
            <th style="text-align: center"><span id="sum"><?php echo $valScore['score_trainer_1_1']+$valScore['score_trainer_1_2']+$valScore['score_trainer_1_3']+$valScore['score_trainer_2_1']+$valScore['score_trainer_2_2']+$valScore['score_trainer_3_1'];?></span></th>
        </tr>
        </tfoot>
    </table>

    <br><br><br><br><br><br><br><br><br><br>
    <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td width="291" height="50" align="center"><span class="style1"><strong>ความพึงพอใจของท่านต่อนักศึกษาฝึกประสบการณ์ <br><br> สถานบันการอาชีวะศึกษาภาคเหนือ 1 / วิทยาลัยเทคนิคเชียงใหม่</strong></span></td>
        </tr>
    </table><br>

    <table bordercolor="#424242" width="100%" height="78" border="1"  align="center" cellpadding="0" cellspacing="0" class="style3">
        <thead>
        <tr style="background: rgba(0,0,0,0.07);">
            <th height="50" width="50%" style="text-align: center; vertical-align: middle;">ความพึงพอใจ</th>
            <th width="10%" style="text-align: center; vertical-align: middle;">มากที่สุด</th>
            <th width="10%" style="text-align: center; vertical-align: middle;">มาก</th>
            <th width="10%" style="text-align: center; vertical-align: middle;">ปานกลาง</th>
            <th width="10%" style="text-align: center; vertical-align: middle;">น้อย</th>
            <th width="10%" style="text-align: center; vertical-align: middle;">น้อยที่สุด</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td height="35">&nbsp;1. ด้านความประพฤติ</td>
            <td style="text-align: center;">
                <?php if ($valScore['score_trainer_rate1'] == '5'){echo "/";} ?>
            </td>
            <td style="text-align: center;">
                <?php if ($valScore['score_trainer_rate1'] == '4'){echo "/";} ?>
            </td>
            <td style="text-align: center;">
                <?php if ($valScore['score_trainer_rate1'] == '3'){echo "/";} ?>
            </td>
            <td style="text-align: center;">
                <?php if ($valScore['score_trainer_rate1'] == '2'){echo "/";} ?>
            </td>
            <td style="text-align: center;">
                <?php if ($valScore['score_trainer_rate1'] == '1'){echo "/";} ?>
            </td>
        </tr>
        <tr>
            <td height="35">&nbsp;2. ด้านทฤษฎี (ความรู้ ความเข้าใจ)</td>
            <td style="text-align: center;">
                <?php if ($valScore['score_trainer_rate2'] == '5'){echo "/";} ?>
            </td>
            <td style="text-align: center;">
                <?php if ($valScore['score_trainer_rate2'] == '4'){echo "/";} ?>
            </td>
            <td style="text-align: center;">
                <?php if ($valScore['score_trainer_rate2'] == '3'){echo "/";} ?>
            </td>
            <td style="text-align: center;">
                <?php if ($valScore['score_trainer_rate2'] == '2'){echo "/";} ?>
            </td>
            <td style="text-align: center;">
                <?php if ($valScore['score_trainer_rate2'] == '1'){echo "/";} ?>
            </td>
        </tr>
        <tr>
            <td height="35">&nbsp;3. ด้านปฏิบัติ (ทักษะการทำงานเป็น)</td>
            <td style="text-align: center;">
                <?php if ($valScore['score_trainer_rate3'] == '5'){echo "/";} ?>
            </td>
            <td style="text-align: center;">
                <?php if ($valScore['score_trainer_rate3'] == '4'){echo "/";} ?>
            </td>
            <td style="text-align: center;">
                <?php if ($valScore['score_trainer_rate3'] == '3'){echo "/";} ?>
            </td>
            <td style="text-align: center;">
                <?php if ($valScore['score_trainer_rate3'] == '2'){echo "/";} ?>
            </td>
            <td style="text-align: center;">
                <?php if ($valScore['score_trainer_rate3'] == '1'){echo "/";} ?>
            </td>
        </tr>
        </tbody>
    </table>
    <p><strong>ข้อเสนอแนะอื่นๆ </strong></p>
    <p style="text-align: justify; text-indent: 50px;"><?php echo nl2br($valScore['score_trainer_counsel']==''?"-":$valScore['score_trainer_counsel']);?></p>
    <br><br>
    <table width="100%" border="0">
        <tr>
            <td width="20%"></td>
            <td width="5%" style="text-align: right; vertical-align: top;" >ลงชื่อ</td>
            <td width="30%" align="center">.............................................  <br><br> <?php echo "( ".$prefix.$valTrainer['trainer_firstname']." ".$valTrainer['trainer_lastname']." )<br> <br>ตำแหน่ง ".$valTrainer['trainer_rank']."<br><br>........../....................../............."; ?> </td>
            <td width="40%" align="left" style="vertical-align: top;">ผู้ประเมิน (ผู้ควบคุมการฝึกประสบการณ์)</td>
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
$pdf->SetTitle('แบบประเมินการฝึกประสบการณ์โดยสถานประกอบการ');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>
<!--ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF/MyPDF.pdf">คลิกที่นี้</a>-->