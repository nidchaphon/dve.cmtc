<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/13/2017 AD
 * Time: 15:32
 */

$classStudent = new Student();

$valStudent = $classStudent->GetDetailStudent($_COOKIE['memberID'],$studentID);
$valDiary = $classStudent->GetDetailDiary($_GET['diaryID']);

mysql_query("UPDATE notification SET notification_isread = 'yes' WHERE notification_id = '{$_POST['idNoti']}' AND member_id = '{$_COOKIE['memberID']}'");

if ($valDiary['diary_status'] == 'errand'){$leave =  "ลากิจ";}if ($valDiary['diary_status'] == 'sick'){$leave = "ลาป่วย";}if ($valDiary['diary_status'] == 'absent'){$leave = "ขาด";}
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
                <h3>แก้ไขบันทึกรายงานประจำวัน</h3>
            </div>
            <div class="card-body">
                <div class="section">
                    <div class="section-body">
                        <?php if ($valDiary['diary_status'] == 'diary'){ ?>
                        <form name="frmAddUser" class="form form-horizontal" action="student/student_to_db.php?diaryID=<?php echo $_GET['diaryID']; ?>" method="post">
                            <div class="section-title">รายงานประจำวัน</div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">วันที่</label>
                                <div class="col-md-3">
                                    <input id="date" type="text" name="txtDate" class="form-control" value="<?php echo DBThaiDate($valDiary['diary_date']);?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">เวลา</label>
                                <div class="col-md-2">
                                    <input type="time" name="txtTimeStart" class="form-control" onkeyup="autoTab(this)" value="<?php echo substr($valDiary['diary_time_start'],0,5);?>">
                                </div>
                                <div class="col-md-1">ถึง</div>
                                <div class="col-md-2">
                                    <input type="time" name="txtTimeEnd" class="form-control" onkeyup="autoTab(this)" value="<?php echo substr($valDiary['diary_time_end'],0,5);?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ลักษณะงานที่ปฏิบัติ</label>
                                <div class="col-md-5">
                                    <textarea class="form-control" name="txtJob" value="<?php echo $valDiary['diary_job'];?>"><?php echo $valDiary['diary_job']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ปัญหาที่พบ / แนวทางการแก้ไข</label>
                                <div class="col-md-5">
                                    <textarea class="form-control" name="txtProblem" value="<?php echo $valDiary['diary_problem'];?>"><?php echo $valDiary['diary_problem'];?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ความรู้ที่ได้รับจากการปฏิบัติงาน</label>
                                <div class="col-md-5">
                                    <textarea class="form-control" name="txtKnowledge" value="<?php echo $valDiary['diary_knowledge'];?>"><?php echo $valDiary['diary_knowledge'];?></textarea>
                                </div>
                            </div>

                            <div class="form-footer">
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" name="updateDiary" class="btn btn-primary">บันทึก</button> &nbsp
                                        <button type="reset" class="btn btn-default">ยกเลิก</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php } ?>
                        <?php if ($valDiary['diary_status'] == 'errand' || $valDiary['diary_status'] == 'sick' || $valDiary['diary_status'] == 'absent'){ ?>
                            <form name="frmAddUser" class="form form-horizontal" action="student/student_to_db.php?diaryID=<?php echo $_GET['diaryID']; ?>" method="post">
                                <div class="section-title">รายงานประจำวัน</div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">วันที่</label>
                                    <div class="col-md-3">
                                        <input id="date" type="text" name="txtDate" class="form-control" value="<?php echo DBThaiDate($valDiary['diary_date']);?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">สาเหตุการ<?php echo $leave;?></label>
                                    <div class="col-md-5">
                                        <textarea class="form-control" name="txtLeave" value="<?php echo $valDiary['diary_leave'];?>"><?php echo $valDiary['diary_leave']; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-footer">
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button type="submit" name="updateLeaveDiary" class="btn btn-primary">บันทึก</button> &nbsp
                                            <button type="reset" class="btn btn-default">ยกเลิก</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
