<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/16/2017 AD
 * Time: 22:32
 */

$classTrainer = new Trainer();
$classStudent = new Student();

$valStudent = $classTrainer->GetDetailStudentScoreForm($_GET['studentID']);
$valDegree = $classStudent->GetStatusDetailStudent($valStudent['student_degree']);
$valDepartment = $classStudent->GetStatusDetailStudent($valStudent['student_department']);
$valScore = $classTrainer->GetStudentScore($_GET['studentID']);
$valTrainer = $classTrainer->GetDetailTrainer($_COOKIE['memberID'],$trainerID);

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
                        <div class="section">
                            <div class="section-title">แบบประเมินการฝึกประสบกาณ์โดยสถานประกอบการ</div>
                            <div class="section-body">
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center;"><p><?php if ($valStudent['student_sex']=='male'){echo "นาย";}if ($valStudent['student_sex']=='female'){echo "นางสาว";}; echo $valStudent['studentName']." ระดับ ".$valDegree['status_text']." ปี ".$valStudent['student_year']." แผนกวิชา ".$valDepartment['status_text']; ?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center;"><p><?php echo "ระยะเวลาฝึกประสบกาณ์ระหว่าง ".DBThaiLongDateFull($valStudent['student_training_start'])." ถึง ".DBThaiLongDateFull($valStudent['student_training_end'])." เป็นเวลา ".CalDateStartToEnd($valStudent['student_training_start'],$valStudent['student_training_end']);?></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center;"><p><?php echo "รวมวัน ฝึกประสบการณ์จริง ".$valStudent['numWork']." วัน ลากิจ ".$valStudent['numErrand']." วัน ลาป่วย ".$valStudent['numSick']." วัน ขาด ".$valStudent['numAbsent']." วัน";?></p></div>
                                </div>
                                <br>
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
                                        <tr>
                                            <td style="text-align: left"><strong>1. เจตคติ</strong><br><p style="text-indent: 30px;">1.1 ความประพฤติ</p></td>
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
                                            <td style="text-align: left"><p style="text-indent: 30px;">1.2 ความตั้งใจและความรับผิดชอบ</p></td>
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
                                            <td style="text-align: left"><p style="text-indent: 30px;">1.3 ความมีมนุษย์สัมพันธ์</p></td>
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
                                            <td style="text-align: left"><strong>2. ทักษะการทำงาน</strong><br><p style="text-indent: 30px;">2.1 ความรู้พื้นฐานทางด้านเทคนิคและการใช้เครื่องมือเครื่องใช้</p></td>
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
                                            <td style="text-align: left"><p style="text-indent: 30px;">2.2 การประยุกต์ใช้ความรู้ที่ศึกษามาปฏิบัติงาน</p></td>
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
                                            <td style="text-align: left"><strong>3. ผลงาน</strong><br><p style="text-indent: 30px;">3.1 คุณภาพของงานและปริมาณ</p></td>
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
                                            <th colspan="2" style="text-align: right">คะแนนรวมทั้งสิ้น</th>
                                            <th style="text-align: center">50</th>
                                            <th style="text-align: center"><span id="sum"><?php echo $valScore['score_trainer_1_1']+$valScore['score_trainer_1_2']+$valScore['score_trainer_1_3']+$valScore['score_trainer_2_1']+$valScore['score_trainer_2_2']+$valScore['score_trainer_3_1'];?></span></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="section-title">ความพึงพอใจของท่านต่อนักศึกษาฝึกประสบการณ์  สถานบันการอาชีวะศึกษาภาคเหนือ 1 / วิทยาลัยเทคนิคเชียงใหม่</div>
                            <div class="section-body">
                                <div class="row">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="50%" style="text-align: center; vertical-align: middle;">ความพึงพอใจ</th>
                                            <th width="10%" style="text-align: center; vertical-align: middle;">มากที่สุด</th>
                                            <th width="10%" style="text-align: center; vertical-align: middle;">มาก</th>
                                            <th width="10%" style="text-align: center; vertical-align: middle;">ปานกลาง</th>
                                            <th width="10%" style="text-align: center; vertical-align: middle;">น้อย</th>
                                            <th width="10%" style="text-align: center; vertical-align: middle;">น้อยที่สุด</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1. ด้านความประพฤติ</td>
                                            <td style="text-align: center;">
                                                <?php if ($valScore['score_trainer_rate1'] == '5'){echo ' <i class="fa fa-check" aria-hidden="true"></i>';} ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($valScore['score_trainer_rate1'] == '4'){echo ' <i class="fa fa-check" aria-hidden="true"></i>';} ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($valScore['score_trainer_rate1'] == '3'){echo ' <i class="fa fa-check" aria-hidden="true"></i>';} ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($valScore['score_trainer_rate1'] == '2'){echo ' <i class="fa fa-check" aria-hidden="true"></i>';} ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($valScore['score_trainer_rate1'] == '1'){echo ' <i class="fa fa-check" aria-hidden="true"></i>';} ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2. ด้านทฤษฎี (ความรู้ ความเข้าใจ)</td>
                                            <td style="text-align: center;">
                                                <?php if ($valScore['score_trainer_rate2'] == '5'){echo ' <i class="fa fa-check" aria-hidden="true"></i>';} ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($valScore['score_trainer_rate2'] == '4'){echo ' <i class="fa fa-check" aria-hidden="true"></i>';} ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($valScore['score_trainer_rate2'] == '3'){echo ' <i class="fa fa-check" aria-hidden="true"></i>';} ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($valScore['score_trainer_rate2'] == '2'){echo ' <i class="fa fa-check" aria-hidden="true"></i>';} ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($valScore['score_trainer_rate2'] == '1'){echo ' <i class="fa fa-check" aria-hidden="true"></i>';} ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3. ด้านปฏิบัติ (ทักษะการทำงานเป็น)</td>
                                            <td style="text-align: center;">
                                                <?php if ($valScore['score_trainer_rate3'] == '5'){echo ' <i class="fa fa-check" aria-hidden="true"></i>';} ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($valScore['score_trainer_rate3'] == '4'){echo ' <i class="fa fa-check" aria-hidden="true"></i>';} ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($valScore['score_trainer_rate3'] == '3'){echo ' <i class="fa fa-check" aria-hidden="true"></i>';} ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($valScore['score_trainer_rate3'] == '2'){echo ' <i class="fa fa-check" aria-hidden="true"></i>';} ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($valScore['score_trainer_rate3'] == '1'){echo ' <i class="fa fa-check" aria-hidden="true"></i>';} ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="section-title">ข้อเสนอแนะอื่นๆ</div>
                                <div class="section-body" style="text-align: justify; text-indent: 30px;">
                                    <?php echo nl2br($valScore['score_trainer_counsel']);?>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center;">
                                        <a href="index.php?page=trainer_score_student_complete&studentID=<?php echo $_GET['studentID']; ?>"><button type="button" class="btn btn-primary">แก้ไขแบบประเมิน  <i class='fa fa-edit'></i></button></a>
                                    </div>
                                </div>
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