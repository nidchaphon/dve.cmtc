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

$valTeacher = $classTeacher->GetDetailTeacher($_COOKIE['memberID'],$teacherID);
$listAppointment = $classTeacher->GetListAppointment($valTeacher['teacher_id']);

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body app-heading">
                <div class="app-title">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="title">
                                <span class="highlight">นัดหมายการนิเทศ</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <a href="index.php?page=teacher_appointment_add"><button type="button" class="btn btn-primary">เพิ่มนัดหมาย  <i class='fa fa-plus'></i></button></a>
                        </div>
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
                    <table class="datatable table-responsive table-striped table-bordered table-hover " id="dataTables-example" style="width: 100%; margin: auto;" cellpadding="5"  cellspacing="0">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="5%" height="50px">ลำดับ</th>
                            <th style="text-align: center" width="17%">วันที่</th>
                            <th style="text-align: center" width="13%">เวลา</th>
                            <th style="text-align: center" width="30%">สถานประกอบการ</th>
                            <th style="text-align: center" width="10%">สถานะ</th>
                            <th style="text-align: center" width="12%">รับทราบ</th>
                            <th style="text-align: center" width="13%">จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=0;
                        while ($valAppointment = mysql_fetch_assoc($listAppointment)){ $i = $i+1;?>
                            <tr>
                                <td align="center" height="30px"><?php echo $i; ?></td>
                                <td align="center"><?php echo DBThaiShortDate($valAppointment['appointment_date']); ?></td>
                                <td><?php echo timeThai($valAppointment['appointment_time']); ?></td>
                                <td><?php echo $valAppointment['company_name']; ?></td>
                                <td align="center"><?php
                                    if ($valAppointment['appointment_status'] == '0'){
                                        echo "<span class='badge badge-danger badge-icon'><i class='fa fa-calendar' aria-hidden='true'></i><span>นัดหมาย</span></span> <a href='teacher/teacher_to_db.php?action=updateAppointment&appointmentID=".$valAppointment['appointment_id']."'><button class='btn btn-default btn-xs'>นิเทศแล้ว</button>";
                                    }else{
                                        echo "<span class='badge badge-success badge-icon'><i class='fa fa-check' aria-hidden='true'></i><span>นิเทศแล้ว</span></span>";} ?> </td>
                                <td align="center"><?php
                                    if ($valAppointment['appointment_trainer_status'] == '0'){
                                        echo "<span class='badge badge-danger badge-icon'><i class='fa fa-times' aria-hidden='true'></i><span>ครูฝึก</span></span>";
                                    }else {
                                        echo "<span class='badge badge-success badge-icon'><i class='fa fa-check' aria-hidden='true'></i><span>ครูฝึก</span></span>";
                                    }
                                    echo "<br>";
                                    if ($valAppointment['appointment_student_status'] == '0'){
                                        echo "<span class='badge badge-danger badge-icon'><i class='fa fa-times' aria-hidden='true'></i><span>นักศึกษา</span></span>";
                                    }else {
                                        echo "<span class='badge badge-success badge-icon'><i class='fa fa-check' aria-hidden='true'></i><span>นักศึกษา</span></span>";
                                    } ?></td>
                                <td align="center">
                                    <a href="index.php?page=teacher_appointment_detail&appointmentID=<?php echo $valAppointment['appointment_id']; ?>"><i class='fa fa-book' title='ข้อมูล'></i></a>  &nbsp
                                    <a href="index.php?page=teacher_appointment_edit&appointmentID=<?php echo $valAppointment['appointment_id']; ?>"><i class='fa fa-edit (alias)' title='แก้ไขข้อมูล'></i></a>  &nbsp
                                    <a href="teacher/teacher_to_db.php?action=deleteAppointment&appointmentID=<?php echo $valAppointment['appointment_id']; ?>" onclick="return confirm('ต้องการลบนัดหมาย วันที่ <?php echo DBThaiShortDate($valAppointment['appointment_date']); ?> หรือไม่')"><i class='fa fa-trash' title='ลบข้อมูล'></i></a> </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>