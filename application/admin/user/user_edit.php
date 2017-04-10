<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/18/2016 AD
 * Time: 23:14
 */

$memberID = $_GET['memberID'];
$statusVal = $_GET['memberStatus'];
$classAdmin = new Admin();
$classTeacher = new Teacher();
$classTrainer = new Trainer();
$classStudent = new Student();

$detailMember = $classAdmin->GetDetailUser($memberID);
$listStatus = $classAdmin->GetListStatus($statusVal);

//echo '<pre>';print_r($detail);echo '</pre>';

//$status = array(
//    "teacher" => array(
//        "value" => teacher,"text" => อาจารย์นิเทศ ),
//    "trainer" => array(
//        "value" => trainer,"text" => สถานประกอบการ ),
//    "student" => array(
//        "value" => student,"text" => นักศึกษาฝึกงาน ),
//    "admin" => array(
//        "value" => admin,"text" => ผู้ดูแลระบบ ) );
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>แก้ไขข้อมูลผู้ใช้</h3>
            </div>
            <div class="card-body">
                <form name="frmAddUser" class="form form-horizontal" action="admin/admin_update.php?memberID=<?php echo $memberID; ?>&memberStatus=<?php echo $statusVal; ?>" method="post">
                    <div class="section">
                        <div class="section-body">
                            <div class="section-title">ข้อมูลผู้ใช้</div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ID ผู้ใช้</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtMemberID" class="form-control" disabled="disabled" placeholder="Member ID" value="<?php echo $detailMember['member_id']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ชื่อผู้ใช้</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtUsername" class="form-control" placeholder="Username" value="<?php echo $detailMember['member_username']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">รหัสผ่าน</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtPassword" class="form-control" placeholder="Password" value="<?php echo $detailMember['member_password']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if ($statusVal == 'teacher' || $statusVal == 'teacher2'){
                        $valTeacher = $classTeacher->GetDetailTeacher($memberID,$teacherID); ?>
                    <div class="section">
                        <div class="section-body">
                            <div class="section-title">ข้อมูลส่วนตัว</div>
                            <div class="section-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ชื่อ - สกุล</label>
                                    <div class="col-md-4">
                                        <input type="text" name="txtFirstname" class="form-control" placeholder="ชื่อ" value="<?php echo $valTeacher['teacher_firstname']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="txtLastname" class="form-control" placeholder="สกุล" value="<?php echo $valTeacher['teacher_lastname']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">เบอร์โทรศัพท์</label>
                                    <div class="col-md-4">
                                        <input type="text" name="txtTel" class="form-control" placeholder="เบอร์โทรศัพท์" value="<?php echo $valTeacher['teacher_tel']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">อีเมลล์</label>
                                    <div class="col-md-4">
                                        <input type="text" name="txtEmail" class="form-control" placeholder="อีเมลล์" value="<?php echo $valTeacher['teacher_email']; ?>">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php } ?>

                    <?php if ($statusVal == 'trainer'){
                        $valTrainer = $classTrainer->GetDetailTrainer($memberID,$trainerID);
                        $companyID = $valTrainer['company_id'];
                        $valCompany = $classTrainer->GetDetailCompany($companyID);
                        $listCompany = $classAdmin->GetListCompany();?>
                        <div class="section">
                            <div class="section-body">
                                <div class="section-title">ข้อมูลส่วนตัว</div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ชื่อ - สกุล</label>
                                    <div class="col-md-4">
                                        <input type="text" name="txtFirstname" class="form-control" placeholder="ชื่อ" value="<?php echo $valTrainer['trainer_firstname']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="txtLastname" class="form-control" placeholder="สกุล" value="<?php echo $valTrainer['trainer_lastname']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">เบอร์โทรศัพท์</label>
                                    <div class="col-md-4">
                                        <input type="tel" name="txtTel" class="form-control" placeholder="เบอร์โทรศัพท์" value="<?php echo $valTrainer['trainer_tel']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">อีเมลล์</label>
                                    <div class="col-md-4">
                                        <input type="email" name="txtEmail" class="form-control" placeholder="อีเมลล์" value="<?php echo $valTrainer['trainer_email']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">บริษัท</label>
                                    <div class="col-md-4">
                                        <select class="select2" name="txtCompany">
                                            <?php while ($valListCompany = mysql_fetch_assoc($listCompany)){ ?>
                                                <option value="<?php echo $valListCompany['company_id']; ?>"<?php if ($valTrainer['company_id']==$valListCompany['company_id']){echo "SELECTED";} ?>><?php echo $valListCompany['company_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($statusVal == 'student'){
                        $valStudent = $classStudent->GetDetailStudent($memberID,$studentID);
                        $valTeacher = $classTeacher->GetDetailTeacher($memberID,$valStudent['teacher2_id']);
                        $listCompany = $classStudent->GetListCompany();
                        $listTeacher = $classStudent->GetListTeacher();
                        $listTeacher2 = $classStudent->GetListTeacher();
                        $listTrainer = $classStudent->GetListTrainer();
                        $listDegree = $classStudent->GetListDegree();
                        $listGroup = $classStudent->GetListGroup(); ?>
                        <div class="section">
                            <div class="section-body">
                                <div class="section-title">ข้อมูลส่วนตัว</div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ชื่อ - สกุล</label>
                                    <div class="col-md-4">
                                        <input type="text" name="txtFirstname" class="form-control" placeholder="ชื่อ" value="<?php echo $valStudent['student_firstname']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="txtLastname" class="form-control" placeholder="สกุล" value="<?php echo $valStudent['student_lastname']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">รหัสนักศึกษา</label>
                                    <div class="col-md-4">
                                        <input type="text" name="txtStdCode" class="form-control" value="<?php echo $valStudent['student_code']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ระดับชั้น</label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <select name="txtDegree" class="select2">
                                                <option value="">เลือกระดับชั้น</option>
                                                <?php while ($valDegree = mysql_fetch_assoc($listDegree)){ ?>
                                                    <option value="<?php echo $valDegree['status_value'];?>"<?php if ($valStudent['student_degree']==$valDegree['status_value']){echo "SELECTED";}?>><?php echo $valDegree['status_text'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">ปี</div>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <select name="txtYear" class="select2">
                                                <option value="">เลือกชั้นปี</option>
                                                <option value="1"<?php if ($valStudent['student_year'] == '1'){echo "SELECTED";}?>>1</option>
                                                <option value="2"<?php if ($valStudent['student_year'] == '2'){echo "SELECTED";}?>>2</option>
                                                <option value="3"<?php if ($valStudent['student_year'] == '3'){echo "SELECTED";}?>>3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">แผนกวิชา</label>
                                    <div class="col-md-4">
                                        <input type="text" name="txtDepartment" class="form-control" value="<?php echo $valStudent['student_department']; ?>">
                                    </div>
                                    <label class="col-md-1 control-label">กลุ่ม</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <select name="txtGroup" class="select2">
                                                <option value="">เลือกกลุ่ม</option>
                                                <?php while ($valGroup = mysql_fetch_assoc($listGroup)){ ?>
                                                    <option value="<?php echo $valGroup['status_value'];?>"<?php if ($valStudent['student_group']==$valGroup['status_value']){echo "SELECTED";}?>><?php echo $valGroup['status_text'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">วัน/เดือน/ปี เกิด</label>
                                    <div class="col-md-4">
                                        <input type="text" id="date" name="txtBirthdate" class="form-control" value="<?php echo DBThaiDate($valStudent['student_birthdate']); ?>">
                                    </div>
                                </div>
                                <div class="section-title">ข้อมูลการติดต่อ</div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ที่อยู่</label>
                                    <div class="col-md-4">
                                        <input type="text" name="txtAddress" class="form-control" placeholder="" value="<?php echo $valStudent['student_address']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">เบอร์โทรศัพท์</label>
                                    <div class="col-md-4">
                                        <input type="text" name="txtTel" class="form-control" placeholder="" value="<?php echo $valStudent['student_tel']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">อีเมลล์</label>
                                    <div class="col-md-4">
                                        <input type="email" name="txtEmail" class="form-control" placeholder="" value="<?php echo $valStudent['student_email']; ?>">
                                    </div>
                                </div>
                                <div class="section-title">ข้อมูลการฝึกงาน</div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">อาจารย์ที่ปรึกษา</label>
                                    <div class="col-md-4">
                                        <select class="select2" name="txtTeacher2">
                                            <option value="">เลือกอาจารย์นิเทศ</option>
                                            <?php while ($valListTechaer2 = mysql_fetch_assoc($listTeacher2)){ ?>
                                                <option value="<?php echo $valListTechaer2['teacher_id']; ?>"<?php if ($valStudent['teacher2_id']==$valListTechaer2['teacher_id']){echo "SELECTED";} ?>><?php echo $valListTechaer2['teacher_firstname']." ".$valListTechaer2['teacher_lastname']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">อาจารย์นิเทศ</label>
                                    <div class="col-md-4">
                                        <select class="select2" name="txtTeacher">
                                            <option value="">เลือกอาจารย์นิเทศ</option>
                                            <?php while ($valListTechaer = mysql_fetch_assoc($listTeacher)){ ?>
                                                <option value="<?php echo $valListTechaer['teacher_id']; ?>"<?php if ($valStudent['teacher_id']==$valListTechaer['teacher_id']){echo "SELECTED";} ?>><?php echo $valListTechaer['teacher_firstname']." ".$valListTechaer['teacher_lastname']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">สถานประกอบการ</label>
                                    <div class="col-md-5">
                                        <select class="select2" name="txtCompany">
                                            <option value="">เลือกสถานประกอบการ</option>
                                            <?php while ($valListCompany = mysql_fetch_assoc($listCompany)){ ?>
                                                <option value="<?php echo $valListCompany['company_id']; ?>"<?php if ($valStudent['company_id']==$valListCompany['company_id']){echo "SELECTED";} ?>><?php echo $valListCompany['company_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ครูฝึก</label>
                                    <div class="col-md-4">
                                        <select class="select2" name="txtTrainer">
                                            <option value="">เลือกครูฝึก</option>
                                            <?php while ($valListTrainer = mysql_fetch_assoc($listTrainer)){ ?>
                                                <option value="<?php echo $valListTrainer['trainer_id']; ?>"<?php if ($valStudent['trainer_id']==$valListTrainer['trainer_id']){echo "SELECTED";} ?>><?php echo $valListTrainer['trainer_firstname']." ".$valListTrainer['trainer_lastname']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="form-footer">
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" name="updateUser" class="btn btn-primary">บันทึก</button>
                                <button type="reset" class="btn btn-default">ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>