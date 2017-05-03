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
$valDegree = $classStudent->GetStatusDetailStudent($valStudent['student_degree']);

if ($valStudent['student_sex'] == "male"){
    $prefix = "นาย";
} elseif ($valStudent['student_sex'] == "female"){
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
        word-wrap:break-word;
    }

    table {
        table-layout: fixed;
    }
    table td {
        word-wrap: break-word;
    }

    .hard_break{
        white-space: pre-wrap; /* css-3 */
        white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
        white-space: -pre-wrap; /* Opera 4-6 */
        white-space: -o-pre-wrap; /* Opera 7 */
        word-wrap: break-word; /* Internet Explorer 5.5+ */
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
            <td height="27" align="center"><span class="style2"><?php echo "<strong>ชื่อ - สกุล</strong> ".$prefix.$valStudent['student_firstname']." ".$valStudent['student_lastname']." <strong>ระดับชั้น</strong> ".$valDegree['status_text'];?></span></td>
        </tr>
    </table>
    <table width="200" border="0" align="center">
        <tbody>
        <tr>
            <td align="center">&nbsp;</td>
        </tr>
        </tbody>
    </table>

    <table bordercolor="#424242" width="100%" height="78" border="1"  align="center" cellpadding="5" cellspacing="0" class="style3">
        <tr align="center">
            <td width="20%" height="50" align="center" bgcolor="#D5D5D5"><strong>วัน เดือน ปี</strong></td>
            <td width="55%" align="center" bgcolor="#D5D5D5"><strong>บันทึกรายงานการปฏิบัติงาน</strong></td>
            <td width="25%" align="center" bgcolor="#D5D5D5"><strong>หมายเหตุ</strong></td>
        </tr>

        <?php while ($valReportDiary = mysql_fetch_assoc($listReportDiary)){
            $valJob=iconv('iso-8859-11', 'utf-8', wordwrap(iconv('utf-8', 'iso-8859-11', $valReportDiary['diary_job']), 50, "\r\n", true));
            $valProblem=iconv('iso-8859-11', 'utf-8', wordwrap(iconv('utf-8', 'iso-8859-11', $valReportDiary['diary_problem']), 20, "\r\n", true));
            ?>
        <tr>
            <td height="70" align="left" style="vertical-align: top;"><?php echo FullThaiDate(strtotime($valReportDiary['diary_date'])); ?></td>
            <td align="left" class="style3 hard_break" style="vertical-align: top;"><p><?php echo nl2br($valJob); ?></p></td>
            <td align="left" class="style3" style="vertical-align: top; "><?php echo nl2br($valProblem); ?></td>
        </tr>
        <?php $trainerName = $valReportDiary['trainerName']; $teacherName = $valReportDiary['teacherName'];
            if ($valReportDiary['trainer_prefix'] == "mr"){
                $prefixTrainer = "นาย";
            }elseif ($valReportDiary['trainer_prefix'] == "mrs"){
                $prefixTrainer = "นาง";
            }elseif ($valReportDiary['trainer_prefix'] == "miss"){
                $prefixTrainer = "นาวสาว";
            }
        } ?>
    </table>


    <br>

    <table width="100%" border="0">
        <tr>
            <td align="center">ลงชื่อ .............................................  <br> <?php echo "( ".$prefixTrainer.$trainerName." )"; ?> <br><br> ผู้ควบคุมการฝึกประสบการณ์</td>
            <td align="center">ลงชื่อ .............................................  <br> <?php echo "( ".$teacherName." )"; ?> <br><br> อาจารย์นิเทศ</td>
        </tr>
    </table>

</div>
</body>
</html>
<?Php
$html = ob_get_contents();
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', 'THSaraban');
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->SetTitle('บันทึกการปฏิบัติงาน');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>
<!--ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF/MyPDF.pdf">คลิกที่นี้</a>-->