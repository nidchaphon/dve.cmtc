<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/13/2017 AD
 * Time: 10:12
 */

$memberID = $_COOKIE['memberID'];

$classStudent = new Student();

$valStudent = $classStudent->GetDetailStudent($memberID,$studentID);
$listRestday = $classStudent->GetListRestday();
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
                <h3>เพิ่มบันทึกรายงานประจำวัน</h3>
            </div>
            <div class="card-body">
                <div class="section">
                    <div class="section-body">
                        <div class="section-title">ข้อมูลนักศึกษา</div>
                        <div class="row">
                            <label class="col-md-3 control-label">รหัสนักศึกษา</label>
                            <div class="col-md-5">
                                <input type="text" name="txtCodeSTD" class="form-control" value="<?php echo $valStudent['student_code']; ?>" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 control-label">ชื่อ - สกุล</label>
                            <div class="col-md-5">
                                <input type="text" name="txtNameSTD" class="form-control" value="<?php echo $valStudent['student_firstname'].' '.$valStudent['student_lastname']; ?>" disabled>
                            </div>
                        </div>
                        <div class="section-title">รายงานประจำวัน</div>
                        <form name="frmSelectRestday" class="form form-horizontal" action="index.php?page=student_diary_add" method="post">
                            <div class="form-group">
                                <label class="col-md-3 control-label">บันทึกข้อมูล</label>
                                <div class="col-md-3">
                                    <select name="addDiary" class="select2" onchange="this.form.submit()">
                                        <option value="">เลือกรายการบันทึก</option>
                                        <option value="diary" <?php if ($_POST['addDiary']=='diary'){echo "SELECTED";} ?>>บันทึกการปฏิบัติงาน</option>
                                        <?php while ($valRestday = mysql_fetch_assoc($listRestday)){ ?>
                                            <option value="<?php echo $valRestday['status_value'];?>"<?php if ($_POST['addDiary']==$valRestday['status_value']){echo "SELECTED";} ?>><?php echo $valRestday['status_text'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <form name="frmAddUser" class="form form-horizontal" action="student/student_to_db.php" method="post">
                            <input type="hidden" name="txtID" value="<?php echo $valStudent['student_id']; ?>">
                            <?php if ($_POST['addDiary'] == 'diary'){ ?>
                                <input type="hidden" name="txtStatus" value="diary">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">วันที่</label>
                                    <div class="col-md-3">
                                        <input type="text" id="date" name="txtDate" class="form-control" value="<?php echo DBThaiDate(date("Y-m-d")); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">เวลา</label>
                                    <div class="col-md-2">
                                        <input type="text" name="txtTimeStart" placeholder="00:00" class="form-control" onkeyup="autoTab(this)"  />
                                    </div>
                                    <div class="col-md-1">ถึง</div>
                                    <div class="col-md-2">
                                        <input type="text" name="txtTimeEnd" placeholder="00:00" class="form-control" onkeyup="autoTab(this)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ลักษณะงานที่ปฏิบัติ</label>
                                    <div class="col-md-5">
                                        <textarea class="form-control" name="txtJob"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ปัญหาที่พบ / แนวทางการแก้ไข</label>
                                    <div class="col-md-5">
                                        <textarea class="form-control" name="txtProblem"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ความรู้ที่ได้รับจากการปฏิบัติงาน</label>
                                    <div class="col-md-5">
                                        <textarea class="form-control" name="txtKnowledge"></textarea>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button type="submit" name="insertDiary" class="btn btn-primary">บันทึก</button> &nbsp
                                            <button type="reset" class="btn btn-default">ยกเลิก</button>
                                        </div>
                                    </div>
                                </div>
                            <?php } if ($_POST['addDiary'] == 'errand' || $_POST['addDiary'] == 'sick' || $_POST['addDiary'] == 'absent'){ ?>
                                <?php if ($_POST['addDiary'] == 'errand') {
                                    echo "<input type=\"hidden\" name=\"txtStatus\" value=\"errand\">";
                                }if ($_POST['addDiary'] == 'sick') {
                                    echo "<input type=\"hidden\" name=\"txtStatus\" value=\"sick\">";
                                } ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">วันที่</label>
                                    <div class="col-md-3">
                                        <input type="text" id="date" name="txtDate" class="form-control" value="<?php echo DBThaiDate(date("Y-m-d")); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">สาเหตุผลการ<?php if ($_POST['addDiary'] == 'sick'){echo "ลาป่วย";}if ($_POST['addDiary'] == 'errand'){echo "ลากิจ";}if ($_POST['addDiary'] == 'absent'){echo "ขาด";} ?></label>
                                    <div class="col-md-5">
                                        <textarea class="form-control" name="txtLeave"></textarea>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button type="submit" name="insertLeave" class="btn btn-primary">บันทึก</button> &nbsp
                                            <button type="reset" class="btn btn-default">ยกเลิก</button>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>