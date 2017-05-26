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

$classTeacher = new Teacher();
$classStudent = new Student();

if (isset($_GET['degree'])){
    $degree = $_GET['degree'];
}else{
    $degree = $_POST['degree'];
}
if (isset($_GET['department'])){
    $department = $_GET['department'];
}else{
    $department = $_POST['department'];
}
if (isset($_GET['year'])){
    $year = $_GET['year'];
}else{
    $year = $_POST['year'];
}

$listStudent = $classTeacher->GetDetailStudentScoreForm($_COOKIE['memberID'],$degree,$department,$year);
$listDegree = $classTeacher->GetListDegree();
$listDepartment = $classTeacher->GetListDepartment();
$listYear = $classTeacher->GetListSTDYear();

if ($_GET['result'] == 'score'){
    $title = "ประเมินการฝึกประสบการณ์";
}if ($_GET['result'] == 'grade'){
    $title = "การวัดผลและประเมินผลการฝึกประสบการณ์";
}

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body app-heading">
                <div class="app-title">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="title">
                                <span class="highlight"><?php echo $title; ?></span>
                            </div>
                        </div>
                    </div>

                    <?php if (!isset($_GET['degree'])){ ?>
                        <br>
                    <div class="row">
                        <form name="frmCheangLsit" action="" method="post">
                            <div class="col-md-4">
                                <select class="select2" name="degree" onchange="this.form.submit()">
                                    <option value="">ระดับชั้นทั้งหมด</option>
                                    <?php while ($valDegree = mysql_fetch_assoc($listDegree)){ ?>
                                        <option value="<?php echo $valDegree['status_value'];?>" <?php if ($valDegree['status_value'] == $degree){echo "SELECTED";}?>><?php echo $valDegree['status_text']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="select2" name="department" onchange="this.form.submit()">
                                    <option value="">สาขาทั้งหมด</option>
                                    <?php while ($valDepartment = mysql_fetch_assoc($listDepartment)){ ?>
                                        <option value="<?php echo $valDepartment['status_value'];?>" <?php if ($valDepartment['status_value'] == $department){echo "SELECTED";}?>><?php echo $valDepartment['status_text']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="select2" name="year" onchange="this.form.submit()">
                                    <option value="">รุ่นปีทั้งหมด</option>
                                    <?php while ($valYear = mysql_fetch_assoc($listYear)){ ?>
                                        <option value="<?php echo $valYear['stdYear'];?>" <?php if ($valYear['stdYear'] == $year){echo "SELECTED";}?>><?php echo "รุ่นปี 25".$valYear['stdYear']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <?php } ?>

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
                            <th style="text-align: center; vertical-align: middle;" width="5%" height="50px">ลำดับ</th>
                            <th style="text-align: center; vertical-align: middle;" width="15%">รหัสนักศึกษา</th>
                            <th style="text-align: center; vertical-align: middle;" width="25%">ชื่อ - สกุล</th>
                            <th style="text-align: center; vertical-align: middle;" width="15%">ระดับชั้น</th>
                            <th style="text-align: center; vertical-align: middle;" width="18%">สาขา</th>
                            <th style="text-align: center; vertical-align: middle;" width="15%">สถานะ</th>
                            <th style="text-align: center; vertical-align: middle;" width="15%">ประเมิน</th>
                            <th style="text-align: center; vertical-align: middle;" width="12%">ผู้ควบคุม</th>
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
                                <td><?php echo $valStudent['student_code']; ?></td>
                                <td><?php if ($valStudent['student_sex']=='male'){echo "นาย";}if ($valStudent['student_sex']=='female'){echo "นางสาว";} echo $valStudent['student_firstname']." ".$valStudent['student_lastname']; ?></td>
                                <td><?php echo $valDegree['status_text']." "; echo $valStudent['student_year']==''?"":"ปี ".$valStudent['student_year'];; ?></td>
                                <td><?php echo $valDepartment['status_text']; ?></td>
                                <?php
                                if ($_GET['result'] == 'score'){
                                    if ($valStudent['student_score_teacher'] != 'complete'){
                                        echo '<td style="text-align: center">';
                                        echo "<span class='badge badge-danger badge-icon'><i class='fa fa-times' aria-hidden='true'></i><span>ยังไม่มีการประเมิน</span>";
                                        echo '</td>';
                                        echo '<td align="center"><a href="index.php?page=teacher_score_student_save&studentID='.$valStudent['student_id'].'"><i class="fa fa-edit (alias)" title="ประเมินนักศึกษา"></i></a>';
                                        echo '</td>';
                                    }else{
                                        echo '<td style="text-align: center">';
                                        echo "<span class='badge badge-success badge-icon'><i class='fa fa-check' aria-hidden='true'></i><span>ประเมินแล้ว</span>";
                                        echo '</td>';
                                        echo '<td align="center">
                                              <a href="index.php?page=teacher_score_student_report&studentID='.$valStudent['student_id'].'"><i class="fa fa-book" title="ข้อมูลการประเมินนักศึกษา"></i></a> &nbsp;
                                              <a href="teacher/teacher_score_student_report_pdf.php?studentID='.$valStudent['student_id'].'" target="_blank"><i class="fa fa-file-pdf-o" title="รายงานแบบประเมินการฝึกงานโดยอาจารย์นิเทศเป็นไฟล์ PDF"></i></a>
                                              ';
                                        echo '</td>';
                                    }
                                }if ($_GET['result'] == 'grade'){
                                    if ($valStudent['score_report'] == '' || $valStudent['score_join'] == '' || $valStudent['score_report'] == '0' || $valStudent['score_join'] == '0'){
                                        echo '<td style="text-align: center">';
                                        echo "<span class='badge badge-danger badge-icon'><i class='fa fa-times' aria-hidden='true'></i><span>ยังไม่มีการประเมิน</span>";
                                        echo '</td>';
                                        echo '<td align="center"><a href="index.php?page=teacher_grade_student_complete&studentID='.$valStudent['student_id'].'"><i class="fa fa-edit (alias)" title="ประเมินนักศึกษา"></i></a>';
                                        echo '</td>';
                                    }else{
                                        echo '<td style="text-align: center">';
                                        echo "<span class='badge badge-success badge-icon'><i class='fa fa-check' aria-hidden='true'></i><span>ประเมินแล้ว</span>";
                                        echo '</td>';
                                        echo '<td align="center">
                                              <a href="index.php?page=teacher_grade_student_report&studentID='.$valStudent['student_id'].'"><i class="fa fa-book" title="ข้อมูลการประเมินนักศึกษา"></i></a> &nbsp;
                                              <a href="teacher/teacher_grade_student_report_pdf.php?studentID='.$valStudent['student_id'].'" target="_blank"><i class="fa fa-file-pdf-o" title="รายงานการวัดผลและประเมินผลการฝึกงานเป็นไฟล์ PDF"></i></a>
                                        ';
                                        echo '</td>';
                                    }
                                } ?>
                                <?php
                                if ($valStudent['score_trainer_1_1'] == '' || $valStudent['score_trainer_1_2'] == '' || $valStudent['score_trainer_1_3'] == '' || $valStudent['score_trainer_2_1'] == '' || $valStudent['score_trainer_2_2'] == '' || $valStudent['score_trainer_3_1'] == '' || $valStudent['score_trainer_rate1'] == '' || $valStudent['score_trainer_rate2'] == '' || $valStudent['score_trainer_rate3'] == '' ||
                                $valStudent['score_trainer_1_1'] == '0' || $valStudent['score_trainer_1_2'] == '0' || $valStudent['score_trainer_1_3'] == '0' || $valStudent['score_trainer_2_1'] == '0' || $valStudent['score_trainer_2_2'] == '0' || $valStudent['score_trainer_3_1'] == '0' || $valStudent['score_trainer_rate1'] == '0' || $valStudent['score_trainer_rate2'] == '0' || $valStudent['score_trainer_rate3'] == '0'
                                ){
                                    echo '<td style="text-align: center">';
                                    echo "<span class='badge badge-danger badge-icon'><i class='fa fa-times' aria-hidden='true'></i><span>ยังไม่มีการประเมิน</span>";
                                    echo '</td>';
                                }else{
                                    echo '<td align="center">
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