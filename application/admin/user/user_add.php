<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/18/2016 AD
 * Time: 23:14
 */

$classAdmin = new Admin();
$maxNum = $classAdmin->GetMaxMemberID();
$listStatus = $classAdmin->GetListStatus();
$listCompany = $classAdmin->GetListCompany();
$listTeacher = $classAdmin->GetListTeacher();
$listTeacher2 = $classAdmin->GetListTeacher();
$listTrainer = $classAdmin->GetListTrainer();
$listDegree = $classStudent->GetListDegree();
$listGroup = $classStudent->GetListGroup();
//echo '<pre>';print_r($status);echo '</pre>';

//------------กำหนดค่าไอดีใหม่---------------//
$code = "MB";
$yearMonth = substr(date("Y")+543, -2).date("m");
$maxId = substr($maxNum['maxID'], -4);
$maxId = ($maxId + 1);
$maxId = substr("0000".$maxId, -4);
$nextId = $code.$yearMonth.$maxId;

?>
<script language="JavaScript">
    function resutName(CompanyID)
    {
        switch(CompanyID)
        {
        <?php while($valTrainer = mysql_fetch_array($listTrainer)){ ?>
            case "<?php echo $valTrainer["company_id"];?>":
                frmAddUser.txtTrainerName.value = "<?php echo $valTrainer["trainer_firstname"]." ".$valTrainer["trainer_lastname"];?>";
                frmAddUser.txtTrainer.value = "<?php echo $valTrainer["trainer_id"];?>";
                break;
        <?php } ?>
            default:
                frmAddUser.txtTrainer.value = "";
        }
    }

    function check() {

        if(document.frmAddUser.txtCode.value=="") {
            alert("กรุณากรอก รหัส เพื่อใช้เป็นชื่อผู้ใช้") ;
            document.frmAddUser.txtCode.focus() ;
            return false ;
        }if(document.frmAddUser.txtPassword.value=="") {
            alert("กรุณากรอก รหัสผ่าน");
            document.frmAddUser.txtPassword.focus();
            return false;
        }
        else
            return true ;
    }
</script>
<div class="row">
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3>เพิ่มผู้ใช้</h3>
        </div>
        <div class="card-body">
            <div class="section">
                <div class="section-body">
                    <form name="frmSubmitStatus" class="form form-horizontal" action="" method="post">
                        <div class="form-group">
                            <label class="col-md-3 control-label">สถานะผู้ใช้</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <select class="select2" name="status" onchange="this.form.submit()">
                                        <option value="">เลือกสถานะผู้ใช้</option>
                                        <?php while ($valStatus = mysql_fetch_assoc($listStatus)) { ?>
                                            <option value="<?php echo $valStatus['status_value'];?>"<?php if ($_POST['status']==$valStatus['status_value']){echo "SELECTED";}?>><?php echo $valStatus['status_text'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php if ($_POST['status'] == 'teacher' || $_POST['status'] == 'teacher2'){ ?>
                    <form name="frmAddUser" class="form form-horizontal" action="admin/admin_insert.php" method="post" onSubmit="JavaScript:return check();">
                        <input type="hidden" name="txtID" value="<?php echo $nextId; ?>">
                        <input type="hidden" name="txtStatus" value="<?php echo $_POST['status']; ?>">
                        <div class="section-title">ข้อมูลผู้ใช้</div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">รหัสประจำตัวอาจารย์</label>
                            <div class="col-md-5">
                                <input type="text" name="txtCode" class="form-control" placeholder="รหัสประจำตัวอาจารย์ / เลขบัตรประชาชน (ใช้เป็น Username)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">รหัสผ่าน</label>
                            <div class="col-md-5">
                                <input type="text" name="txtPassword" class="form-control" placeholder="รหัสผ่าน">
                            </div>
                        </div>
                        <div class="section-title">ข้อมูลส่วนตัว</div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">ชื่อ - สกุล</label>
                            <div class="col-md-3">
                                <input type="text" name="txtFirstname" class="form-control" placeholder="ชื่อ">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="txtLastname" class="form-control" placeholder="สกุล">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">ตำแหน่ง</label>
                            <div class="col-md-5">
                                <input type="text" name="txtRank" class="form-control" placeholder="ตำแหน่ง">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">เบอร์โทรศัพท์</label>
                            <div class="col-md-5">
                                <input type="tel" name="txtTel" class="form-control" maxlength="10" placeholder="เบอร์โทรศัพท์">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">อีเมลล์</label>
                            <div class="col-md-5">
                                <input type="email" name="txtEmail" class="form-control" placeholder="อีเมลล์">
                            </div>
                        </div>

                        <div class="form-footer">
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" name="insertTeacher" class="btn btn-primary">บันทึก</button> &nbsp
                                    <button type="reset" class="btn btn-default">ยกเลิก</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php } ?>

                    <?php if ($_POST['status'] == 'trainer'){ ?>
                        <form name="frmAddUser" class="form form-horizontal" action="admin/admin_insert.php" method="post" onSubmit="JavaScript:return check();">
                            <input type="hidden" name="txtID" value="<?php echo $nextId; ?>">
                            <input type="hidden" name="txtStatus" value="<?php echo $_POST['status']; ?>">
                            <div class="section-title">ข้อมูลผู้ใช้</div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">รหัสประจำตัวครูฝึก</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtCode" class="form-control" placeholder="รหัสประจำตัวครูฝึก / เลขบัตรประชาชน (ใช้เป็น Username)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">รหัสผ่าน</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtPassword" class="form-control" placeholder="รหัสผ่าน">
                                </div>
                            </div>
                            <div class="section-title">ข้อมูลส่วนตัว</div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ชื่อ - สกุล</label>
                                <div class="col-md-3">
                                    <input type="text" name="txtFirstname" class="form-control" placeholder="ชื่อ">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="txtLastname" class="form-control" placeholder="สกุล">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ตำแหน่ง</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtRank" class="form-control" placeholder="ตำแหน่ง">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">เบอร์โทรศัพท์</label>
                                <div class="col-md-5">
                                    <input type="tel" name="txtTel" class="form-control" maxlength="10" placeholder="เบอร์โทรศัพท์">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">อีเมลล์</label>
                                <div class="col-md-5">
                                    <input type="email" name="txtEmail" class="form-control" placeholder="อีเมลล์">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">สถานประกอบการ</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <select name="txtCompany" class="select2">
                                            <option value="">เลือกสถานประกอบการ</option>
                                            <?php while ($valCompany = mysql_fetch_assoc($listCompany)){ ?>
                                                <option value="<?php echo $valCompany['company_id']?>"><?php echo $valCompany['company_name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer">
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" name="insertTrainer" class="btn btn-primary">บันทึก</button> &nbsp
                                        <button type="reset" class="btn btn-default">ยกเลิก</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php } ?>

                    <?php if ($_POST['status'] == 'student'){ ?>

                        <form name="frmAddUser" class="form form-horizontal" action="admin/admin_insert.php" method="post" onSubmit="JavaScript:return check();">
                            <input type="hidden" name="txtID" value="<?php echo $nextId; ?>">
                            <input type="hidden" name="txtStatus" value="<?php echo $_POST['status']; ?>">
                            <div class="section-title">ข้อมูลผู้ใช้</div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">รหัสประจำตัวนักศึกษา</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtCode" class="form-control" placeholder="รหัสนักศึกษา (ใช้เป็น Username)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">รหัสผ่าน</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtPassword" class="form-control" placeholder="รหัสผ่าน">
                                </div>
                            </div>
                            <div class="section-title">ข้อมูลส่วนตัว</div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ชื่อ - สกุล</label>
                                <div class="col-md-3">
                                    <input type="text" name="txtFirstname" class="form-control" placeholder="ชื่อ">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="txtLastname" class="form-control" placeholder="สกุล">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ระดับชั้น</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <select name="txtDegree" class="select2">
                                            <option value="">เลือกระดับชั้น</option>
                                            <?php while ($valDegree = mysql_fetch_assoc($listDegree)){ ?>
                                                <option value="<?php echo $valDegree['status_value'];?>"><?php echo $valDegree['status_text'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">ปี</div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <select name="txtYear" class="select2">
                                            <option value="">เลือกชั้นปี</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">สาขาวิชา</label>
                                <div class="col-md-3">
                                    <input type="text" name="txtDepartment" class="form-control" placeholder="สาขาวิชา">
                                </div>
                                <label class="col-md-1 control-label">กลุ่ม</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <select name="txtGroup" class="select2">
                                            <option value="">เลือกกลุ่ม</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">วัน/เดือน/ปี เกิด</label>
                                <div class="col-md-3">
                                    <input type="text" id="date" name="txtBirthdate" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="section-title">ข้อมูลการติดต่อ</div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ที่อยู่</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtAddress" class="form-control" placeholder="ที่อยู่">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">เบอร์โทรศัพท์</label>
                                <div class="col-md-5">
                                    <input type="tel" name="txtTel" class="form-control" maxlength="10" placeholder="เบอร์โทรศัพท์">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">อีเมลล์</label>
                                <div class="col-md-5">
                                    <input type="email" name="txtEmail" class="form-control" placeholder="อีเมลล์">
                                </div>
                            </div>
                            <div class="section-title">ข้อมูลการฝึกงาน</div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">อาจารย์ที่ปรึกษา</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <select name="txtTeacher2" class="select2">
                                            <option value="">เลือกอาจารย์ที่ปรึกษา</option>
                                            <?php while ($valTeacher2 = mysql_fetch_assoc($listTeacher2)){ ?>
                                                <option value="<?php echo $valTeacher2['teacher_id']?>"><?php echo "อาจารย์".$valTeacher2['teacher_firstname']." ".$valTeacher2['teacher_lastname']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">อาจารย์นิเทศ</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <select name="txtTeacher" class="select2">
                                            <option value="">เลือกอาจารย์นิเทศ</option>
                                            <?php while ($valTeacher = mysql_fetch_assoc($listTeacher)){ ?>
                                                <option value="<?php echo $valTeacher['teacher_id']?>"><?php echo "อาจารย์".$valTeacher['teacher_firstname']." ".$valTeacher['teacher_lastname']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">สถานประกอบการ</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <select name="txtCompany" class="select2" OnChange="resutName(this.value);">
                                            <option value="">เลือกสถานประกอบการ</option>
                                            <?php while ($valCompany = mysql_fetch_assoc($listCompany)){ ?>
                                                <option value="<?php echo $valCompany['company_id']?>"><?php echo $valCompany['company_name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ผู้ควบคุมการฝึกงาน</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" name="txtTrainerName" class="form-control" value="<?php echo $prefix.$valStudent['trainer_firstname']." ".$valStudent['trainer_lastname'];?>" disabled>
                                        <input type="hidden" name="txtTrainer" value="">
                                    </div>
                                </div>
                            </div>

<!--                            <div class="form-group">-->
<!--                                <label class="col-md-3 control-label">ครูฝึก</label>-->
<!--                                <div class="col-md-4">-->
<!--                                    <div class="input-group">-->
<!--                                        <select name="txtTrainer" class="select2">-->
<!--                                            <option value="">เลือกครูฝึก</option>-->
<!--                                            --><?php //while ($valTrainer = mysql_fetch_assoc($listTrainer)){ ?>
<!--                                                <option value="--><?php //echo $valTrainer['trainer_id']?><!--">--><?php //echo "คุณ".$valTrainer['trainer_firstname']." ".$valTrainer['trainer_lastname']?><!--</option>-->
<!--                                            --><?php //} ?>
<!--                                        </select>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->

                            <div class="form-footer">
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" name="insertStudent" class="btn btn-primary">บันทึก</button> &nbsp
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