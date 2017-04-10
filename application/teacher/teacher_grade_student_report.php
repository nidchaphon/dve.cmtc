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
$classCompany = new Company();

$valStudent = $classTrainer->GetDetailStudentScoreForm($_GET['studentID']);
$valDegree = $classStudent->GetStatusDetailStudent($valStudent['student_degree']);
$valScore = $classTrainer->GetStudentScore($_GET['studentID']);
$valTeacher = $classTeacher->GetDetailTeacher($_COOKIE['memberID'],$teacherID);
$valCompany = $classCompany->GetDetailCompany($valStudent['company_id']);

$scoreTrainer = $valScore['score_trainer_1_1']+$valScore['score_trainer_1_2']+$valScore['score_trainer_1_3']+$valScore['score_trainer_2_1']+$valScore['score_trainer_2_2']+$valScore['score_trainer_3_1'];
$scoreTeacher = $valScore['score_teacher_1']+$valScore['score_teacher_2']+$valScore['score_teacher_3'];
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>การวัดผลและประเมินผลการฝึกงาน</h3>
            </div>
            <div class="card-body">
                <div class="section">
                    <div class="section-body">
                        <div class="section">
                            <div class="section-body">
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center;"><p><?php echo $valStudent['student_sex']=='male'?"นาย":"นางสาว";echo $valStudent['studentName']." ระดับ ".$valDegree['status_text']." ปี ".$valStudent['student_year']." แผนกวิชา ".$valStudent['student_department']; ?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center;"><p><?php echo "รหัสนักศึกษา ".$valStudent['student_code']." "." ชื่อสถานประกอบการ ".$valCompany['company_name']; ?></p></div>
                                </div>
                                <br>
                                <div class="row">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead>
                                        <tr style="background: rgba(0,0,0,0.07);">
                                            <th width="50%" style="text-align: center; vertical-align: middle;">แนวทางเกณฑ์การวัดผลและประเมินผล</th>
                                            <th width="10%" style="text-align: center; vertical-align: middle;">คะแนนเต็ม</th>
                                            <th width="10%" style="text-align: center; vertical-align: middle;">คะแนนที่ได้</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td style="text-align: left">แบบประเมินการฝึกงานโดยสถานประกอบการ</td>
                                            <td style="text-align: center; vertical-align: middle;">50</td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?php echo $scoreTrainer;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left">แบบประเมินการฝึกงานโดยอาจารย์นิเทศก์</td>
                                            <td style="text-align: center; vertical-align: middle;">20</td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?php echo $scoreTeacher;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left">รายงานฉบับสมบูรณ์</td>
                                            <td style="text-align: center; vertical-align: middle;">20</td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?php echo $valScore['score_report'];?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left">การเข้าร่วมปฐมนิเทศ, ปัจฉิมนิเทศที่วิทยาลัย</td>
                                            <td style="text-align: center; vertical-align: middle;">10</td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?php echo $valScore['score_join'];?>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr style="background: rgba(0,0,0,0.07);">
                                            <th style="text-align: right">คะแนนรวมทั้งสิ้น</th>
                                            <th style="text-align: center">100</th>
                                            <th style="text-align: center"><span id="sum"><?php echo $scoreTrainer+$scoreTeacher+$valScore['score_report']+$valScore['score_join'];?></span></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-12" style="text-align: center;">
                                <a href="index.php?page=teacher_grade_student_complete&studentID=<?php echo $_GET['studentID']; ?>"><button type="button" class="btn btn-primary">แก้ไขแบบประเมิน  <i class='fa fa-edit'></i></button></a>
                            </div>
                        </div>
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