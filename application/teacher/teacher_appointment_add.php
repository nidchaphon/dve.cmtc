<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/16/2017 AD
 * Time: 22:32
 */

$classTeacher = new Teacher();

$listCompany = $classTeacher->GetListCompany();
$valTeacher = $classTeacher->GetDetailTeacher($_COOKIE['memberID'],$teacherID);
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

    function check() {

        if(document.frmAddAppointment.txtDate.value=="") {
            alert("กรุณากรอก วันที่นัดหมายการนิเทศ") ;
            document.frmAddAppointment.txtDate.focus() ;
            return false ;
        }if(document.frmAddAppointment.txtTime.value=="") {
            alert("กรุณากรอก เวลานัดหมายการนิเทศ") ;
            document.frmAddAppointment.txtTime.focus() ;
            return false ;
        }if(document.frmAddAppointment.txtCompany.value=="") {
            alert("กรุณากรอก เลือกสถานประกอบการ") ;
            document.frmAddAppointment.txtCompany.focus() ;
            return false ;
        }
        else
            return true ;
    }

</script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>เพิ่มนัดหมายการนิเทศ</h3>
            </div>
            <div class="card-body">
                <div class="section">
                    <div class="section-body">
                        <form name="frmAddAppointment" class="form form-horizontal" action="teacher/teacher_to_db.php" method="post" onSubmit="JavaScript:return check();">
                            <input type="hidden" name="txtTeacherID" value="<?php echo $valTeacher['teacher_id']; ?>">
                            <div class="form-group">
                                <label class="col-md-2 control-label">วันที่</label>
                                <div class="col-md-3">
                                    <input type="text" id="date2" name="txtDate" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">เวลา</label>
                                <div class="col-md-2">
                                    <input type="time" name="txtTime" class="form-control" placeholder="00:00" onkeyup="autoTab(this)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">สถานประกอบการที่จะนิเทศนักศึกษาฝึกประสบการณ์</label>
                                <div class="col-md-5">
                                    <select class="select2" name="txtCompany">
                                        <option value="">เลือกสถานประกอบการ</option>
                                        <?php while ($valCompany = mysql_fetch_assoc($listCompany)) { ?>
                                        <option value="<?php echo $valCompany['company_id'];?>"><?php echo $valCompany['company_name'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-footer">
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" name="insertAppointment" class="btn btn-primary">บันทึก</button> &nbsp
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
