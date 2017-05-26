<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/16/2017 AD
 * Time: 22:32
 */

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

if (mysql_num_rows($listMainEvaluation) == '0'){
    echo "<script>alert('ยังไม่มีแบบประเมินสำหรับนักศึกษา ระดับ ".$valDegree['status_text']." สาขา ".$valDepartment['status_text']." รุ่นปี ".$year." กรุณาติดต่อ ผู้ดูแลระบบ');</script>";
    echo "<meta http-equiv='refresh' content='0;url=index.php?page=teacher_score_student_list&result=score'>";
    exit();
}

?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>ประเมินการฝึกประสบการณ์</h3>
            </div>
            <div class="card-body">
                <div class="section">
                    <div class="section-body">
                        <form name="frmScoreTrainer" class="form form-horizontal" action="teacher/teacher_to_db.php?studentID=<?php echo $_GET['studentID']; ?>" method="post">
                            <div class="section">
                                <div class="section-title">แบบประเมินการฝึกประสบการณ์โดยอาจารย์นิเทศ</div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-md-12" style="text-align: center;"><p><?php if ($valStudent['student_sex']=='male'){echo "นาย";}if ($valStudent['student_sex']=='female'){echo "นางสาว";} echo $valStudent['studentName']." ระดับ ".$valDegree['status_text']." ปี ".$valStudent['student_year']." แผนกวิชา ".$valDepartment['status_text']; ?></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" style="text-align: center;"><p><?php echo "ระยะเวลาฝึกประสบการณ์ระหว่าง ".DBThaiLongDateFull($valStudent['student_training_start'])." ถึง ".DBThaiLongDateFull($valStudent['student_training_end'])." เป็นเวลา ".CalDateStartToEnd($valStudent['student_training_start'],$valStudent['student_training_end']);?></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" style="text-align: center;"><p><?php echo "รวมวัน ฝึกประสบการณ์จริง ".$valStudent['numWork']." วัน ลากิจ ".$valStudent['numErrand']." วัน ลาป่วย ".$valStudent['numSick']." วัน ขาด ".$valStudent['numAbsent']." วัน";?></p></div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12"><p><strong>คำชี้แจง</strong> กรุณากรอกคะแนนให้นักเรียน นักศึกษาตามความเป็นจริงและเหมาะสม</p></div>
                                    </div>
                                    <div class="row">
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead>
                                            <tr style="background: rgba(0,0,0,0.07);">
                                                <th width="30%" style="text-align: center; vertical-align: middle;">หัวข้อการประเมิน</th>
                                                <th width="50%" style="text-align: center; vertical-align: middle;">รายละเอียดการพิจารณา</th>
                                                <th width="10%" style="text-align: center; vertical-align: middle;">คะแนนเต็ม</th>
                                                <th width="10%" style="text-align: center; vertical-align: middle;">คะแนนที่ได้</th>
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
                                                    $textFieldScore = "";
                                                }else {
                                                    $score = $valMainEvaluation['question_score'];
                                                    $textFieldScore = "show";
                                                }

                                            ?>
                                            <tr>
                                                <td style="text-align: left"><strong><?php echo $numMainEvaluation.". ".$valMainEvaluation['question_topic']; ?></strong></td>
                                                <td style="text-align: left"><?php echo nl2br($valMainEvaluation['question_detail']); ?></td>
                                                <td style="text-align: center; vertical-align: middle;"><?php echo $score;  ?></td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <?php
                                                    if ($textFieldScore == 'show'){ ?>
                                                    <input type="text" class="txt" name="numScore[]" value="<?php while ($valMainScore = mysql_fetch_assoc($listMainScore)) { if ($valMainEvaluation['question_id'] == $valMainScore['question_id']) { echo $valMainScore['score_num'];} $sumMainScore += $valMainScore['score_num']; } ?>" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';} if (this.value > <?php echo $valMainQuestion['question_score']; ?>){alert('กรุณากรอกตัวเลขไม่เกิน <?php echo $valMainQuestion['question_score']; ?>'); this.value='';}"  style="width: 50px; text-align: center;">
                                                    <input type="hidden" name="evaluationID[]" value="<?php echo $valMainEvaluation['question_id']; ?>">
                                                    <?php }  ?>
                                                </td>
                                            </tr>
                                                <?php
                                                $listSubEvaluation = $classTeacher->GetListSubEvaluation($valMainEvaluation['evaluation_id'],$valMainEvaluation['question_id']);
                                                $numSubEvaluation = 0;
                                                while ($valSubEvaluation = mysql_fetch_assoc($listSubEvaluation)){
                                                    $numSubEvaluation = $numSubEvaluation + 1;
                                                    $listSubScore = $classTeacher->GetListScore($_GET['studentID'],$valSubEvaluation['question_id']);
                                                ?>
                                                <tr>
                                                    <td style="text-align: justify; text-indent: 50px;"><?php echo $numMainEvaluation.".".$numSubEvaluation." ".$valSubEvaluation['question_topic']; ?></td>
                                                    <td style="text-align: left"><?php echo nl2br($valSubEvaluation['question_detail']); ?></td>
                                                    <td style="text-align: center; vertical-align: middle;"><?php echo $valSubEvaluation['question_score']; ?></td>
                                                    <td style="text-align: center; vertical-align: middle;">
                                                        <input type="text" class="txt" name="numScore[]" value="<?php while ($valSubScore = mysql_fetch_assoc($listSubScore)) { if ($valSubEvaluation['question_id'] == $valSubScore['question_id']) { echo $valSubScore['score_num'];} $sumSubScore += $valSubScore['score_num']; } ?>" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';} if (this.value > <?php echo $valSubQuestion['question_score']; ?>){alert('กรุณากรอกตัวเลขไม่เกิน <?php echo $valSubQuestion['question_score']; ?>'); this.value='';}"  style="width: 50px; text-align: center;">
                                                        <input type="hidden" name="evaluationID[]" value="<?php echo $valSubEvaluation['question_id']; ?>">
                                                    </td>
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
                                                <th colspan="2" style="text-align: right">คะแนนรวมทั้งสิ้น</th>
                                                <th style="text-align: center"><?php echo $totalScore; ?></th>
                                                <th style="text-align: center"><span id="sum"><?php echo $sumScore; ?></span></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="section-title">ข้อบกพร่องที่ควรแก้ไขปรับปรุง</div>
                                <div class="section-body">
                                    <textarea name="txtDefect" rows="5" class="form-control"><?php echo $valComment['comment_defect'];?></textarea>
                                </div>
                                <div class="section-title">ข้อเสนอแนะอื่นๆ</div>
                                <div class="section-body">
                                    <textarea name="txtCounsel" rows="5" class="form-control"><?php echo $valComment['comment_counsel'];?></textarea>
                                    <input type="hidden" name="txtTeacherID" value="<?php echo $valTeacher['teacher_id'];?>">
                                </div>
                            </div>

                            <div class="form-footer">
                                <div class="form-group">
                                    <div class="col-md-12" style="text-align: center">
                                        <button type="submit" name="insertScoreStudent" class="btn btn-primary">บันทึก</button> &nbsp
                                        <button type="reset" class="btn btn-default">ยกเลิก</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        $(".txt").each(function() {

            $(this).keyup(function(){
                calculateSum();
            });
        });

    });

    function calculateSum() {

        var sum = 0;
        //iterate through each textboxes and add the values
        $(".txt").each(function() {

            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }

        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#sum").html(sum.toFixed(0));
    }
</script>