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
$classStudent = new Student();

$listReportDiaryTime = $classStudent->GetReportTimeDiary($_COOKIE['memberID']);
$valDiaryTime = $classStudent->GetTitleRepeotTimeDiary($_COOKIE['memberID']);
$valDegree = $classStudent->GetStatusDetailStudent($valDiaryTime['student_degree']);

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
            <td width="291" height="50" align="center"><span class="style1"><strong>บัญชีลงเวลาการปฏิบัติงานของนักศึกษาฝึกงาน</strong></span></td>
        </tr>
        <tr>
            <td height="27" align="center"><span class="style2"><?php echo "<strong>ระดับชั้น</strong> ".$valDegree['status_text']." <strong>แผนกวิชา</strong> ".$valDiaryTime['student_department'];?></span></td>
        </tr>
        <tr>
            <td height="25" align="center"><span class="style2"><?php echo "<strong>ระหว่างวันที่</strong> ".DBThaiLongDateFull($valDiaryTime['beginDate'])." <strong>ถึง</strong> ".DBThaiLongDateFull($valDiaryTime['endDate']); ?></span></td>
        </tr>
    </table>
    <table width="200" border="0" align="center">
        <tbody>
        <tr>
            <td align="center">&nbsp;</td>
        </tr>
        </tbody>
    </table>
    <table bordercolor="#424242" width="100%" height="78" border="1"  align="center" cellpadding="0" cellspacing="0" class="style3">
        <tr align="center">
            <td width="15%" height="50" align="center" bgcolor="#D5D5D5"><strong>วัน เดือน ปี</strong></td>
            <td width="25%" align="center" bgcolor="#D5D5D5"><strong>ชื่อ - นามสกุล</strong></td>
            <td width="10%" align="center" bgcolor="#D5D5D5"><strong>เวลามา</strong></td>
            <td width="10%" align="center" bgcolor="#D5D5D5"><strong>เวลากลับ</strong></td>
            <td width="20%" align="center" bgcolor="#D5D5D5"><strong>ผู้ควบคุม</strong></td>
            <td width="20%" align="center" bgcolor="#D5D5D5"><strong>หมายเหตุ</strong></td>
        </tr>
        <?php while ($valReportTime = mysql_fetch_assoc($listReportDiaryTime)){ ?>
        <tr>
            <td height="30" align="center"><?php echo DBThaiShortDate($valReportTime['diary_date']); ?></td>
            <td align="left" class="style3">&nbsp;<?php echo $valReportTime['studentName']; ?></td>
            <td align="center" class="style3"><?php echo $valReportTime['diary_time_start']==''?"-":TimeThai($valReportTime['diary_time_start']); ?></td>
            <td align="center" class="style3"><?php echo $valReportTime['diary_time_end']==''?"-":TimeThai($valReportTime['diary_time_end']); ?></td>
            <td align="left" class="style3">&nbsp;<?php echo " ".$valReportTime['trainerName']; ?></td>
            <td align="left" class="style3">&nbsp;<?php
                if ($valReportTime['diary_status'] == 'errand'){echo "ลากิจ - ".$valReportTime['diary_leave'];}
                if ($valReportTime['diary_status'] == 'sick'){echo "ลาป่าย - ".$valReportTime['diary_leave'];}
                if ($valReportTime['diary_status'] == 'absent'){echo "ขาด - ".$valReportTime['diary_leave'];}
            ?></td>
        </tr>
        <?php $studentName = $valReportTime['studentName']; $trainerName = $valReportTime['trainerName']; } ?>
    </table>
    <br>
    <table width="100%" border="0">
        <tbody>
        <tr>
            <td width="80%"></td>
            <td width="12%" align="right">นักศึกษาเข้าฝึกงานจริง</td>
            <td width="5%" align="center"><?php echo $valDiaryTime['numDiary']; ?></td>
            <td width="3%" align="right">วัน</td>
        </tr>
        <tr>
            <td width="80%"></td>
            <td width="12%" align="right">ลาป่วย</td>
            <td width="5%" align="center"><?php echo $valDiaryTime['numSick']; ?></td>
            <td width="3%" align="right">วัน</td>
        </tr>
        <tr>
            <td width="80%"></td>
            <td width="12%" align="right">ลากิจ</td>
            <td width="5%" align="center"><?php echo $valDiaryTime['numErrand']; ?></td>
            <td width="3%" align="right">วัน</td>
        </tr>
        <tr>
            <td width="80%"></td>
            <td width="12%" align="right">ขาด</td>
            <td width="5%" align="center"><?php echo $valDiaryTime['numAbsent']; ?></td>
            <td width="3%" align="right">วัน</td>
        </tr>
        </tbody>
    </table>
    <br>
    <table width="100%" border="0">
        <tr>
            <td align="center">ลงชื่อ .............................................  <br> <?php echo "( ".$studentName." )"; ?> <br><br> นักศึกษาฝึกงาน</td>
            <td align="center">ลงชื่อ .............................................  <br> <?php echo "( ".$trainerName." )"; ?> <br><br> ผู้ควบคุมการฝึกงาน</td>
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
$pdf->SetTitle('บัญชีลงเวลาการปฏิบัติงานของนักศึกษาฝึกงาน');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>
<!--ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF/MyPDF.pdf">คลิกที่นี้</a>-->