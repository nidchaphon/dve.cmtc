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
?>
<script type="text/javascript">
    function autoTab(obj){
        var pattern=new String("__:__"); // กำหนดรูปแบบในนี้
        var pattern_ex=new String(":"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
        var returnText=new String("");
        var obj_l=obj.value.length;
        var obj_l2=obj_l-1;
        for(i=0;i<pattern.length;i++){
            if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){
                returnText+=obj.value+pattern_ex;
                obj.value=returnText;
            }
        }
        if(obj_l>=pattern.length){
            obj.value=obj.value.substr(0,pattern.length);
        }
    }
</script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>แก้ไขนัดหมายการนิเทศ</h3>
            </div>
            <div class="card-body">
                <div class="section">
                    <div class="section-body">
                        <form name="frmAddAppointment" class="form form-horizontal" action="teacher/teacher_to_db.php?appointmentID=<?php echo $valAppointment['appointment_id'];?>" method="post">
                            <div class="form-group">
                                <label class="col-md-2 control-label">วันที่</label>
                                <div class="col-md-3">
                                    <input type="text" id="date2" name="txtDate" class="form-control" value="<?php echo DBThaiDate($valAppointment['appointment_date']); ?>">
                                    <input type="hidden" name="txtDateOld" value="<?php echo $valAppointment['appointment_date']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">เวลา</label>
                                <div class="col-md-2">
                                    <input type="time" name="txtTime" class="form-control" placeholder="00:00" onkeyup="autoTab(this)" value="<?php echo substr($valAppointment['appointment_time'],0,5); ?>">
                                    <input type="hidden" name="txtTimeOld" value="<?php echo substr($valAppointment['appointment_time'],0,5); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">สถานประกอบการที่จะนิเทศนักศึกษาฝึกประสบการณ์</label>
                                <div class="col-md-5">
                                    <select class="select2" name="txtCompany">
                                        <option value="">เลือกสถานประกอบการ</option>
                                        <?php while ($valCompany = mysql_fetch_assoc($listCompany)) { ?>
                                            <option value="<?php echo $valCompany['company_id'];?>" <?php if ($valAppointment['company_id'] == $valCompany['company_id']){echo "SELECTED";} ?>><?php echo $valCompany['company_name'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-footer">
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" name="editAppointment" class="btn btn-primary">บันทึก</button> &nbsp
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