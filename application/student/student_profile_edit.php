<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/20/2016 AD
 * Time: 21:59
 */

if (isset($_GET['memberID'])){
    $memberID = $_GET['memberID'];
} else {
    $memberID = $_COOKIE['memberID'];
}

$classStudent = new Student();

$valStudent = $classStudent->GetDetailStudent($memberID,$studentID);
$listCompany = $classStudent->GetListCompany();
$listTeacher = $classStudent->GetListTeacher();
$listTrainer = $classStudent->GetListTrainer();
$listDegree = $classStudent->GetListStatus("degree");
$listGroup = $classStudent->GetListStatus("group");
$listSex = $classStudent->GetListStatus("sex");
$listNational = $classStudent->GetListStatus("national");
$listReligion = $classStudent->GetListStatus("religion");
$listBlood = $classStudent->GetListStatus("blood");
$listDepartment = $classStudent->GetListStatus("major");

//echo '<pre>';print_r($valStudent);echo'</pre>';

if ($valStudent['trainer_prefix'] == 'mr'){
    $prefix = "นาย";
}elseif ($valStudent['trainer_prefix'] == 'mrs'){
    $prefix = "นาง";
}elseif ($valStudent['trainer_prefix'] == 'miss'){
    $prefix = "นางสาว";
}
?>
<script language="JavaScript">
    function showPreview(ele)
    {
        $('#imgAvatar').attr('src', ele.value); // for IE
        if (ele.files && ele.files[0]) {

            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imgAvatar').attr('src', e.target.result);
            }

            reader.readAsDataURL(ele.files[0]);
        }
    }

    function resutName(CompanyID)
    {
        switch(CompanyID)
        {
        <?php while($valTrainer = mysql_fetch_array($listTrainer)){ ?>
            case "<?php echo $valTrainer["company_id"];?>":
                frmAddUser.txtTrainer.value = "<?php echo $valTrainer["trainer_firstname"]." ".$valTrainer["trainer_lastname"];?>";
                frmAddUser.txtTrainerID.value = "<?php echo $valTrainer["trainer_id"];?>";
                break;
        <?php
            }
            ?>
            default:
                frmAddUser.txtTrainer.value = "";
        }
    }
</script>
<div class="row">
    <form name="frmAddUser" class="form form-horizontal" action="student/student_to_db.php?memberID=<?php echo $_GET['memberID']; ?>" method="post" enctype="multipart/form-data">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header app-heading">
                    <div class="row">
                        <div class="col-md-3" align="center">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <img class="profile-img" id="imgAvatar" src="../images/member/<?php echo $valStudent['student_picture']==''?"profile_men.jpg":$valStudent['student_picture'];?>">
                                    <input type="hidden" name="txtPicture" value="<?php echo $valStudent['student_picture']; ?>">
                                    <br><br>
                                </div>
                                <div class="col-md-12">
                                    <input type="file" name="file" class="form-control-file" aria-describedby="fileHelp" OnChange="showPreview(this)">
                                    <small id="fileHelp" class="form-text text-muted">รูปโปรไฟล์ควรมีขนาด 200 X 250 px</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="app-title">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label class="col-md-12 control-label">เลขประจำตัวนักศึกษา</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="txtCodeSTD" class="form-control" value="<?php echo $valStudent['student_code']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">ชื่อ</label>
                                    <div class="col-md-4">
                                        <input type="text" name="txtFirstname" class="form-control" placeholder="ชื่อ" value="<?php echo $valStudent['student_firstname']; ?>">
                                    </div>
                                    <div class="col-md-2" style="width: auto;">นามสกุล</div>
                                    <div class="col-md-4">
                                        <input type="text" name="txtLastname" class="form-control" placeholder="สกุล" value="<?php echo $valStudent['student_lastname']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">ระดับชั้น</div>
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
                                    <div class="col-md-4">
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
                                <div class="row">
                                    <div class="col-md-2">สาขาวิชา</div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <select name="txtDepartment" class="select2">
                                                <option value="">เลือกสาขาวิชา</option>
                                                <?php while ($valDepartment = mysql_fetch_assoc($listDepartment)){ ?>
                                                    <option value="<?php echo $valDepartment['status_value'];?>"<?php if ($valStudent['student_department']==$valDepartment['status_value']){echo "SELECTED";}?>><?php echo $valDepartment['status_text'];?></option>
                                                <?php } ?>
                                            </select>
<!--                                            <input type="text" name="txtDepartment" class="form-control" placeholder="" value="--><?php //echo $valStudent['student_department']; ?><!--">-->
                                        </div>
                                    </div>
                                    <div class="col-md-1">กลุ่ม</div>
                                    <div class="col-md-4">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section">
                                <div class="section-title">ข้อมูลส่วนตัว</div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-md-2"><p>เพศ</p></div>
                                        <div class="col-md-6">
                                        <?php  $idrd=0; while ($valSex = mysql_fetch_assoc($listSex)){ $idrd = $idrd+1; ?>
                                            <div class="radio radio-inline">
                                                <input type="radio" name="txtSex" id="radio<?php echo $idrd; ?>" value="<?php echo $valSex['status_value'];?>" <?php if ($valStudent['student_sex']==$valSex['status_value']){echo "checked";} ?>>
                                                <label for="radio<?php echo $idrd; ?>"><?php echo $valSex['status_text'];?></label>
                                            </div>
                                        <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 control-label">วัน/เดือน/ปี เกิด</div>
                                        <div class="col-md-3"><input type="text" name="txtBirthdate" id="date" class="form-control" value="<?php echo DBThaiDate($valStudent['student_birthdate']) ?>" style="cursor: pointer !important;"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">น้ำหนัก</div>
                                        <div class="col-md-3"><input type="number" name="txtWeight" class="form-control" placeholder="" value="<?php echo $valStudent['student_weight']; ?>"></div>
                                        <div class="col-md-1">ส่วนสูง</div>
                                        <div class="col-md-3"><input type="number" name="txtHeight" class="form-control" placeholder="" value="<?php echo $valStudent['student_height']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">เชื้อชาติ</div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <select name="txtNational" class="select2">
                                                    <option value="">เลือกสัญชาติ</option>
                                                    <?php while ($valNational = mysql_fetch_assoc($listNational)){ ?>
                                                        <option value="<?php echo $valNational['status_value'];?>"<?php if ($valStudent['student_national']==$valNational['status_value']){echo "SELECTED";}?>><?php echo $valNational['status_text'];?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">ศาสนา</div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <select name="txtReligion" class="select2">
                                                    <option value="">เลือกศาสนา</option>
                                                    <?php while ($valReligion = mysql_fetch_assoc($listReligion)){ ?>
                                                        <option value="<?php echo $valReligion['status_value'];?>"<?php if ($valStudent['student_religion']==$valReligion['status_value']){echo "SELECTED";}?>><?php echo $valReligion['status_text'];?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">กรุ๊ปเลือด</div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <select name="txtBlood" class="select2">
                                                    <option value="">เลือกกรุ๊ปเลือด</option>
                                                    <?php while ($valBlood = mysql_fetch_assoc($listBlood)){ ?>
                                                        <option value="<?php echo $valBlood['status_value'];?>"<?php if ($valStudent['student_blood']==$valBlood['status_value']){echo "SELECTED";}?>><?php echo $valBlood['status_text'];?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">โรคประจำตัว</div>
                                        <div class="col-md-3"><input type="text" name="txtDisease" class="form-control" placeholder="" value="<?php echo $valStudent['student_disease']; ?>"></div>
                                        <div class="col-md-1">ยาที่แพ้</div>
                                        <div class="col-md-3"><input type="text" name="txtMedicine" class="form-control" placeholder="" value="<?php echo $valStudent['student_medicine']; ?>"></div>
                                    </div>


                                </div>
                                <div class="section-title">ข้อมูลการติดต่อ</div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-md-2">ที่อยู่</div>
                                        <div class="col-md-8"><input type="text" name="txtAddress" class="form-control" placeholder="" value="<?php echo $valStudent['student_address']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">เบอร์โทรศัพท์</div>
                                        <div class="col-md-4"><input type="tel" maxlength="10" name="txtTel" class="form-control" placeholder="" value="<?php echo $valStudent['student_tel']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">อีเมลล์</div>
                                        <div class="col-md-4"><input type="email" name="txtEmail" class="form-control" placeholder="" value="<?php echo $valStudent['student_email']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">Facebook</div>
                                        <div class="col-md-2" style="width: auto;">https://www.facebook.com/</div>
                                        <div class="col-md-2"><input type="text" name="txtFacebook" class="form-control" placeholder="" value="<?php echo $valStudent['student_facebook']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">LineID</div>
                                        <div class="col-md-4"><input type="text" name="txtLine" class="form-control" placeholder="" value="<?php echo $valStudent['student_line']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">Instagram</div>
                                        <div class="col-md-4"><input type="text" name="txtInstagram" class="form-control" placeholder="" value="<?php echo $valStudent['student_instagram']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">Twitter</div>
                                        <div class="col-md-2" style="width: auto;">https://twitter.com/</div>
                                        <div class="col-md-2"><input type="text" name="txtTwitter" class="form-control" placeholder="" value="<?php echo $valStudent['student_twitter']; ?>"></div>
                                    </div>
                                </div>
                                <div class="section-title">ข้อมูลเพื่อนสนิท</div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-md-2">เพื่อนสนิทชื่อ</div>
                                        <div class="col-md-3"><input type="text" name="txtFriendName" class="form-control" placeholder="" value="<?php echo $valStudent['student_friend_name']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">ที่อยู่</div>
                                        <div class="col-md-8"><input type="text" name="txtFriendAddress" class="form-control" placeholder="" value="<?php echo $valStudent['student_friend_address']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">เบอร์โทรศัพท์</div>
                                        <div class="col-md-3"><input type="tel" maxlength="10" name="txtFriendTel" class="form-control" placeholder="" value="<?php echo $valStudent['student_friend_tel']; ?>"></div>
                                    </div>
                                </div>
                                <div class="section-title">ข้อมูลบิดา - มารดา</div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-md-2">ชื่อบิดา</div>
                                        <div class="col-md-3"><input type="text" name="txtFatherName" class="form-control" placeholder="" value="<?php echo $valStudent['student_father_name']; ?>"></div>
                                        <div class="col-md-1">อายุ</div>
                                        <div class="col-md-2"><input type="text" name="txtFatherAge" class="form-control" placeholder="" value="<?php echo $valStudent['student_father_age']; ?>"></div>
                                        <div class="col-md-1">อาชีพ</div>
                                        <div class="col-md-2"><input type="text" name="txtFatherCareer" class="form-control" placeholder="" value="<?php echo $valStudent['student_father_career']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">ชื่อมารดา</div>
                                        <div class="col-md-3"><input type="text" name="txtMotherName" class="form-control" placeholder="" value="<?php echo $valStudent['student_mother_name']; ?>"></div>
                                        <div class="col-md-1">อายุ</div>
                                        <div class="col-md-2"><input type="text" name="txtMotherAge" class="form-control" placeholder="" value="<?php echo $valStudent['student_mother_age']; ?>"></div>
                                        <div class="col-md-1">อาชีพ</div>
                                        <div class="col-md-2"><input type="text" name="txtMotherCareer" class="form-control" placeholder="" value="<?php echo $valStudent['student_mother_career']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">ที่อยู่บิดา - มารดา</div>
                                        <div class="col-md-8"><input type="text" name="txtFatherAddress" class="form-control" placeholder="" value="<?php echo $valStudent['student_father_address']; ?>"></div>
                                    </div>
                                </div>
                                <div class="section-title">ข้อมูลผู้ปกครองขณะศึกษาอยู่</div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-md-2">ชื่อ - สกุล</div>
                                        <div class="col-md-3"><input type="text" name="txtParentName" class="form-control" placeholder="" value="<?php echo $valStudent['student_parent_name']; ?>"></div>
                                        <div class="col-md-1" style="width: auto;">เกี่ยวข้องเป็น</div>
                                        <div class="col-md-3"><input type="text" name="txtParentConnect" class="form-control" placeholder="" value="<?php echo $valStudent['student_parent_connect']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">ที่อยู่</div>
                                        <div class="col-md-8"><input type="text" name="txtParentAddress" class="form-control" placeholder="" value="<?php echo $valStudent['student_parent_address']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">เบอร์โทรศัพท์</div>
                                        <div class="col-md-3"><input type="tel" maxlength="10" name="txtParentTel" class="form-control" placeholder="" value="<?php echo $valStudent['student_parent_tel']; ?>"></div>
                                    </div>
                                </div>
                                <div class="section-title">ข้อมูลบุคคลที่สามารถให้ข้อมูลเกี่ยวกับนักศึกษาได้</div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-md-2">ชื่อ - สกุล</div>
                                        <div class="col-md-3"><input type="text" name="txtGiveinfoName" class="form-control" placeholder="" value="<?php echo $valStudent['student_giveinfo_name']; ?>"></div>
                                        <div class="col-md-1" style="width: auto;">อาชีพ</div>
                                        <div class="col-md-3"><input type="text" name="txtGiveinfoCareer" class="form-control" placeholder="" value="<?php echo $valStudent['student_giveinfo_career']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">ที่อยู่</div>
                                        <div class="col-md-8"><input type="text" name="txtGiveinfoAddress" class="form-control" placeholder="" value="<?php echo $valStudent['student_giveinfo_address']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">เบอร์โทรศัพท์</div>
                                        <div class="col-md-3"><input type="tel" maxlength="10" name="txtGiveinfoTel" class="form-control" placeholder="" value="<?php echo $valStudent['student_giveinfo_tel']; ?>"></div>
                                    </div>
                                </div>
                                <div class="section-title">ข้อมูลการฝึกงาน</div>
                                <div class="row">
                                    <div class="col-md-2">วันที่เริ่มฝึกงาน</div>
                                    <div class="col-md-3"><input type="text" name="txtTrainingStart" id="dateStart" class="form-control" value="<?php echo DBThaiDate($valStudent['student_training_start']); ?>" style="cursor: pointer !important;"></div>
                                    <div class="col-md-1">ถึง</div>
                                    <div class="col-md-3"><input type="text" name="txtTrainingEnd" id="dateEnd" class="form-control" value="<?php echo DBThaiDate($valStudent['student_training_end']); ?>"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">สถานประกอบการ</div>
                                    <div class="col-md-5">
                                        <select class="select2" name="txtCompany" OnChange="resutName(this.value);">
                                            <option value="">เลือกสถานประกอบการ</option>
                                            <?php while ($valListCompany = mysql_fetch_assoc($listCompany)){ ?>
                                                <option value="<?php echo $valListCompany['company_id']; ?>"<?php if ($valStudent['company_id']==$valListCompany['company_id']){echo "SELECTED";} ?>><?php echo $valListCompany['company_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">ผู้ควบคุมการฝึกงาน</div>
                                    <div class="col-md-5">
                                        <input type="text" name="txtTrainer" class="form-control" value="<?php echo $prefix.$valStudent['trainer_firstname']." ".$valStudent['trainer_lastname'];?>" disabled>
                                        <input type="hidden" name="txtTrainerID" value="<?php echo $valStudent['trainer_id']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" name="editStudent" class="btn btn-primary">บันทึก</button> &nbsp
                                <a href="index.php?page=student_profile"><button type="button" class="btn btn-default">ยกเลิก</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div><br>