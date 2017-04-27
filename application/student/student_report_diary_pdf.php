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

$listReportDiary = $classStudent->GetReportDiary($_COOKIE['memberID']);
$valStudent = $classStudent->GetDetailStudent($_COOKIE['memberID'],$studentID);
//$valDepartment = $classStudent->GetStatusDetailStudent($valDiaryTime['student_department']);

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
            <td width="291" height="50" align="center"><span class="style1"><strong>บันทึกการปฏิบัติงาน</strong></span></td>
        </tr>
        <tr>
            <td height="27" align="center"><span class="style2"><?php echo "<strong>ชื่อ - สกุล</strong> ".$valStudent['student_firstname']." ".$valStudent['student_lastname']." <strong>ระดับชั้น</strong> ".$valDegree['status_text'];?></span></td>
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
            <td width="10%" height="50" align="center" bgcolor="#D5D5D5"><strong>วัน เดือน ปี</strong></td>
            <td width="60%" align="center" bgcolor="#D5D5D5"><strong>บันทึกรายงานการปฏิบัติงาน</strong></td>
            <td width="20%" align="center" bgcolor="#D5D5D5"><strong>หมายเหตุ</strong></td>
        </tr>
        <?php while ($valReportDiary = mysql_fetch_assoc($listReportDiary)){ ;
//        ?>
            <tr>
                <td height="70" align="left" style="vertical-align: top;"><?php echo FullThaiDate(strtotime($valReportDiary['diary_date'])); ?></td>
                <td align="left" class="style3" style="vertical-align: top; ">&nbsp;<?php echo nl2br(wordwrap($valReportDiary['diary_job'],55,"<br>",true)); ?></td>
                <td align="left" class="style3" style="vertical-align: top; ">&nbsp;<?php echo nl2br(wordwrap($valReportDiary['diary_problem'],17,"<br>",true)); ?></td>
            </tr>
            <?php $trainerName = $valReportDiary['trainerName']; $teacherName = $valReportDiary['teacherName']; } ?>
    </table>
    <br>
    <table width="100%" border="0">
        <tr>
            <td align="center">ลงชื่อ .............................................  <br> <?php echo "( ".$trainerName." )"; ?> <br><br> ผู้ควบคุมการฝึกประสบการณ์</td>
            <td align="center">ลงชื่อ .............................................  <br> <?php echo "( ".$teacherName." )"; ?> <br><br> อาจารย์นิเทศ</td>
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
$pdf->SetTitle('บันทึกการปฏิบัติงาน');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>
<!--ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF/MyPDF.pdf">คลิกที่นี้</a>-->