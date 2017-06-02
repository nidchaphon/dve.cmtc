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
$valTeacher = $classTeacher->GetDetailTeacher($_COOKIE['memberID'],$teacherID);
$valComment = $classTeacher->GetEvaluationComment($_GET['studentID'],$valTeacher['teacher_id']);

$year =  "25".substr($valStudent['student_code'] ,0 ,2);
$listMainEvaluation = $classTeacher->GetListMainEvaluation($valStudent['student_degree'],$valStudent['student_department'],$year);
$listMainQuestion = $classTeacher->GetListMainQuestion($valStudent['student_degree'],$valStudent['student_department'],$year);

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
    <table bordercolor="#424242" width="100%" height="78" border="1"  align="center" cellpadding="5" cellspacing="0" class="style3">
        <thead>
        <tr style="background: rgba(0,0,0,0.07);">
            <th width="26%" height="50" style="text-align: center; vertical-align: middle;">หัวข้อการประเมิน</th>
            <th width="50%" style="text-align: center; vertical-align: middle;">รายละเอียดการพิจารณา</th>
            <th width="12%" style="text-align: center; vertical-align: middle;">คะแนนเต็ม</th>
            <th width="12%" style="text-align: center; vertical-align: middle;">คะแนนที่ได้</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $numMainEvaluation = 0;
        while ($valMainEvaluation = mysql_fetch_assoc($listMainEvaluation)){
        $numMainEvaluation = $numMainEvaluation + 1;
        $listMainScore = $classTeacher->GetListScore($_GET['studentID'],$valMainEvaluation['question_id']);

        if ($valMainEvaluation['question_sub_id'] == 'yes'){
            $score = "";
            $colSpan = 'colspan="4"';
        }else {
            $score = $valMainEvaluation['question_score'];
            $colSpan = '';
        }

        ?>
        <tr>
            <td style="text-align: left; vertical-align: top;" <?php echo $colSpan; ?>><br><strong><?php echo $numMainEvaluation.". ".$valMainEvaluation['question_topic']; ?></strong></td>
            <td style="text-align: left"><?php echo nl2br($valMainEvaluation['question_detail']); ?></td>
            <td style="text-align: center; vertical-align: middle;"><?php echo $score;  ?></td>
            <td style="text-align: center; vertical-align: middle;"><?php while ($valMainScore = mysql_fetch_assoc($listMainScore)) { if ($valMainEvaluation['question_id'] == $valMainScore['question_id']) { echo $valMainScore['score_num'];} $sumMainScore += $valMainScore['score_num']; $teacherID = $valMainScore['score_assessor_id']; } ?></td>
        </tr>
            <?php
            $listSubEvaluation = $classTeacher->GetListSubEvaluation($valMainEvaluation['evaluation_id'],$valMainEvaluation['question_id']);
            $numSubEvaluation = 0;
            while ($valSubEvaluation = mysql_fetch_assoc($listSubEvaluation)){
                $numSubEvaluation = $numSubEvaluation + 1;
                $listSubScore = $classTeacher->GetListScore($_GET['studentID'],$valSubEvaluation['question_id']);
                ?>
                <tr>
                    <td style="text-align: justify; text-indent: 50px; text-align: left; vertical-align: top;"><?php echo $numMainEvaluation.".".$numSubEvaluation." ".$valSubEvaluation['question_topic']; ?></td>
                    <td style="text-align: left"><?php echo nl2br($valSubEvaluation['question_detail']); ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?php echo $valSubEvaluation['question_score']; ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?php while ($valSubScore = mysql_fetch_assoc($listSubScore)) { if ($valSubEvaluation['question_id'] == $valSubScore['question_id']) { echo $valSubScore['score_num'];} $sumSubScore += $valSubScore['score_num']; $teacherID = $valSubScore['score_assessor_id']; } ?></td>
                </tr>
                <?php
                $subScore += $valSubEvaluation['question_score']; }
            $mainScore += $valMainEvaluation['question_score']; }
        $totalScore = $subScore+$mainScore;
        $sumScore = $sumMainScore+$sumSubScore;
        ?>
        </tbody>
        <tfoot>
        <tr style="background: rgba(0,0,0,0.07);">
            <th colspan="2" height="40" style="text-align: center">คะแนนรวมทั้งสิ้น</th>
            <th style="text-align: center"><?php echo $totalScore; ?></th>
            <th style="text-align: center"><span id="sum"><?php echo $sumScore; ?></span></th>
        </tr>
        </tfoot>
    </table>

    <?php if (mysql_num_rows($listMainQuestion) != '0'){ ?>
    <br>
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
            <td width="291" height="50" align="center"><span class="style1"><strong>ความพึงพอใจของท่านต่อนักศึกษาฝึกประสบการณ์</strong></span></td>
        </tr>
    </table>

    <table bordercolor="#424242" width="100%" height="78" border="1"  align="center" cellpadding="10" cellspacing="0" class="style3">
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
        <?php
        $numMainQuestion = 0;
        $numRowQuestion = 0;
        while ($valMainQuestion = mysql_fetch_assoc($listMainQuestion)){
            $numMainQuestion = $numMainQuestion + 1;
            $listMainCheck = $classTrainer->GetListScore($_GET['studentID'],$valMainQuestion['question_id']);

            $numCheckMain = 0;
            while ($valMainCheck = mysql_fetch_assoc($listMainCheck)) {
                if ($valMainQuestion['question_id'] == $valMainCheck['question_id']) {
                    $numCheckMain = $valMainCheck['score_num'];
                }
                $teacherID = $valMainCheck['score_assessor_id'];
            }

            if ($valMainQuestion['question_sub_id'] == 'yes'){
                $score = "";
                $radioCheck = "";
                $colsapn = 'colspan="6"';
            }else {
                $score = $valMainQuestion['question_score'];
                $radioCheck = "show";
                $colsapn = '';
                $numRowQuestion = $numRowQuestion+1;
            }
            ?>
            <tr>
                <td style="text-align: left; vertical-align: top;" <?php echo $colsapn; ?>><?php echo $numMainQuestion.". ".$valMainQuestion['question_topic']; ?></td>
                <?php if ($radioCheck == 'show'){ ?>
                    <td style="text-align: center;">
                        <?php if ($numCheckMain == '5'){ echo '/'; } ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if ($numCheckMain == '4'){ echo '/'; } ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if ($numCheckMain == '3'){ echo '/'; } ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if ($numCheckMain == '2'){ echo '/'; } ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if ($numCheckMain == '1'){ echo '/'; } ?>
                    </td>
                <?php } ?>
            </tr>
            <?php
            $listSubQuestion = $classTrainer->GetListSubEvaluation($valMainQuestion['evaluation_id'],$valMainQuestion['question_id']);
            $numSubQuestion = 0;
            while ($valSubQuestion = mysql_fetch_assoc($listSubQuestion)){
                $numSubQuestion = $numSubQuestion + 1;
                $numRowQuestion = $numRowQuestion+1;
                $listSubCheck = $classTrainer->GetListScore($_GET['studentID'],$valSubQuestion['question_id']);

                $numCheckSub = 0;
                while ($valSubCheck = mysql_fetch_assoc($listSubCheck)) { if ($valSubQuestion['question_id'] == $valSubCheck['question_id']) { $numCheckSub = $valSubCheck['score_num']; } }
                ?>
                <tr>
                    <td style="text-align: justify; text-indent: 50px; text-align: left; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $numMainQuestion.".".$numSubQuestion." ".$valSubQuestion['question_topic']; ?></td>
                    <td style="text-align: center;">
                        <?php if ($numCheckSub == '5'){ echo '/'; } ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if ($numCheckSub == '4'){ echo '/'; } ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if ($numCheckSub == '3'){ echo '/'; } ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if ($numCheckSub == '2'){ echo '/'; } ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if ($numCheckSub == '1'){ echo '/'; } ?>
                    </td>
                </tr>
            <?php }} ?>
        </tbody>
    </table>
    <?php } ?>

    <p style="text-align: justify; text-indent: 50px;"><strong>ข้อบกพร่องที่ควรแก้ไขปรับปรุง </strong><?php echo nl2br($valComment['comment_defect']==''?"-":$valComment['comment_defect']);?></p><br>
    <p style="text-align: justify; text-indent: 50px;"><strong>ข้อเสนอแนะอื่นๆ </strong><?php echo nl2br($valComment['comment_counsel']==''?"-":$valComment['comment_counsel']);?></p>
    <br>

    <?php
//    $valTeacher = $classTeacher->GetDetailTeacher($memberID,$teacherID);

    if ($valTeacher['teacher_prefix'] == "mr"){
        $prefixTeacher = "นาย";
    }elseif ($valTeacher['teacher_prefix'] == "mrs"){
        $prefixTeacher = "นาง";
    }elseif ($valTeacher['teacher_prefix'] == "miss"){
        $prefixTeacher = "นาวสาว";
    }
    ?>
    <table width="100%" border="0">
        <tr>
            <td width="20%"></td>
            <td width="5%" style="text-align: right; vertical-align: top;" >ลงชื่อ</td>
            <td width="35%" align="center">.............................................  <br><br> <?php echo "( ".$prefixTeacher.$valTeacher['teacher_firstname']." ".$valTeacher['teacher_lastname']." )<br> <br>ตำแหน่ง ".$valTeacher['teacher_rank']."<br><br>........../....................../............."; ?> </td>
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