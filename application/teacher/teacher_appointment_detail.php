<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/16/2017 AD
 * Time: 22:32
 */

$classTeacher = new Teacher();
$listCompany = $classTeacher->GetListCompany();
$valAppointment = $classTeacher->GetDetailAppointment($_GET['appointmentID']);
$listStudent = $classTeacher->GetListStudentInAppointment($_GET['appointmentID']);
$listTrainer = $classTeacher->GetListTrainerInAppointment($_GET['appointmentID']);

?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>ข้อมูลการนัดหมายการนิเทศ</h3>
            </div>
            <div class="card-body">
                <div class="section">
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-1"><p><strong>วันที่</strong></p></div>
                            <div class="col-md-3">
                                <?php echo DBThaiLongDate($valAppointment['appointment_date']); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"><p><strong>เวลา</strong></p></div>
                            <div class="col-md-2">
                                <?php echo substr($valAppointment['appointment_time'],0,5)." น."; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><p><strong>สถานประกอบการที่จะนิเทศนักศึกษาฝึกประสบการณ์</strong></p></div>
                            <div class="col-md-5"><a href="index.php?page=company_detail&companyID=<?php echo $valAppointment['company_id'];?>"><?php echo $valAppointment['company_name'];?></a></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p><strong>นักศึกษาฝึกประสบการณ์</strong></p></div>
                            <div class="col-md-5">
                                <ol>
                                <?php while ($valStudent = mysql_fetch_assoc($listStudent)){
                                    echo "<li>";
                                    if ($valStudent['student_sex']== 'male'){echo "นาย";}elseif ($valStudent['student_sex']== 'female'){echo "นางสาว";}
                                    echo $valStudent['student_firstname']." ".$valStudent['student_lastname']." เบอร์โทรศัพท์ ".$valStudent['student_tel']."<br>";
                                    echo "</li>";
                                }?>
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p><strong>ผู้ควบคุมการฝึกประสบการณ์</strong></p></div>
                            <div class="col-md-5">
                                <ol>
                                    <?php while ($valTrainer = mysql_fetch_assoc($listTrainer)){
                                        echo "<li>";
                                        if ($valTrainer['trainer_prefix']== 'mr'){echo "นาย";}elseif ($valTrainer['trainer_prefix']== 'miss'){echo "นางสาว";}elseif ($valTrainer['trainer_prefix']== 'mrs'){echo "นาง";}
                                        echo $valTrainer['trainer_firstname']." ".$valTrainer['trainer_lastname']." เบอร์โทรศัพท์ ".$valTrainer['trainer_tel']."<br>";
                                        echo "</li>";
                                    }?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>