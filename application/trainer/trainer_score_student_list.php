<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/16/2017 AD
 * Time: 17:14
 */

if ($detect->isMobile() || $detect->isTablet()) {
    echo "<script>alert('กรุณาใช้งานอุปกรณ์ของคุณในแนวนอน เพื่อการแสดงผลตารางให้พอดีกับจอภาพ');</script>";
}

$classTrainer = new Trainer();
$classStudent = new Student();

$listStudent = $classTrainer->GetListStudentScore($_COOKIE['memberID']);

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body app-heading">
                <div class="app-title">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="title">
                                <span class="highlight">ประเมินการฝึกประสบการณ์</span>
                            </div>
                        </div>
<!--                        <div class="col-md-8">-->
<!--                            <a href="index.php?page=teacher_appointment_add"><button type="button" class="btn btn-primary">เพิ่มนัดหมาย  <i class='fa fa-plus'></i></button></a>-->
<!--                        </div>-->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header"><br><br></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table-responsive table-striped table-bordered table-hover " id="dataTables-example" style="width: 100%; margin: auto;"  cellspacing="0">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="5%" height="50px">ลำดับ</th>
                            <th style="text-align: center" width="30%">ชื่อ - สกุล</th>
                            <th style="text-align: center" width="15%">ระดับชั้น</th>
                            <th style="text-align: center" width="20%">สาขา</th>
                            <th style="text-align: center" width="15%">สถานะ</th>
                            <th style="text-align: center" width="15%">ประเมิน</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=0;
                        while ($valStudent = mysql_fetch_assoc($listStudent)){ $i = $i+1;
                        $valDegree = $classStudent->GetStatusDetailStudent($valStudent['student_degree']);
                        $valDepartment = $classStudent->GetStatusDetailStudent($valStudent['student_department']);
                        ?>
                            <tr>
                                <td align="center" height="30px"><?php echo $i; ?></td>
                                <td><?php if ($valStudent['student_sex']=='male'){echo "นาย";}if ($valStudent['student_sex']=='female'){echo "นางสาว";} echo $valStudent['student_firstname']." ".$valStudent['student_lastname']; ?></td>
                                <td><?php echo $valDegree['status_text']; ?></td>
                                <td><?php echo $valDepartment['status_text']; ?></td>
                                <?php
                                if ($valStudent['score_trainer_1_1'] == '' || $valStudent['score_trainer_1_2'] == '' || $valStudent['score_trainer_1_3'] == '' || $valStudent['score_trainer_2_1'] == '' || $valStudent['score_trainer_2_2'] == '' || $valStudent['score_trainer_3_1'] == '' || $valStudent['score_trainer_rate1'] == '' || $valStudent['score_trainer_rate2'] == '' || $valStudent['score_trainer_rate3'] == '' ||
                                    $valStudent['score_trainer_1_1'] == '0' || $valStudent['score_trainer_1_2'] == '0' || $valStudent['score_trainer_1_3'] == '0' || $valStudent['score_trainer_2_1'] == '0' || $valStudent['score_trainer_2_2'] == '0' || $valStudent['score_trainer_3_1'] == '0' || $valStudent['score_trainer_rate1'] == '0' || $valStudent['score_trainer_rate2'] == '0' || $valStudent['score_trainer_rate3'] == '0'
                                ){
                                    echo '<td style="text-align: center">';
                                    echo "ยังไม่มีการประเมิน";
                                    echo '</td>';
                                    echo '<td align="center"><a href="index.php?page=trainer_score_student_complete&studentID='.$valStudent['student_id'].'"><i class="fa fa-edit (alias)" title="ประเมินนักศึกษา"></i></a>';
                                    echo '</td>';
                                }else{
                                    echo '<td style="text-align: center">';
                                    echo "ประเมินแล้ว";
                                    echo '</td>';
                                    echo '<td align="center">
                                        <a href="index.php?page=trainer_score_student_report&studentID='.$valStudent['student_id'].'"><i class="fa fa-book" title="ข้อมูลการประเมินนักศึกษา"></i></a> &nbsp;
                                        <a href="trainer/trainer_score_student_report_pdf.php?studentID='.$valStudent['student_id'].'" target="_blank"><i class="fa fa-file-pdf-o" title="รายงานแบบประเมินการฝึกงานโดยสถานประกอบการเป็นไฟล์ PDF"></i></a>
                                        ';
                                    echo '</td>';
                                    } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>