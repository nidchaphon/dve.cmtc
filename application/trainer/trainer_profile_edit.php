<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/20/2016 AD
 * Time: 21:59
 */

$memberID = $_COOKIE['memberID'];

$classTrainer = new Trainer();
$valTrainer = $classTrainer->GetDetailTrainer($memberID,$trainerID);
$valCompany = $classTrainer->GetDetailCompany($valTrainer["company_id"]);
$listCompany = $classTrainer->GetListCompany($companyID);
$listPrefix = $classTrainer->GetListPrefix();

//echo '<pre>';print_r($data);echo'</pre>';
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
</script>
<div class="row">
    <form name="frmAddUser" class="form form-horizontal" action="trainer/trainer_to_db.php" method="post" enctype="multipart/form-data">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header app-heading">
                    <div class="row">
                        <div class="col-md-3" align="center">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <img class="profile-img" id="imgAvatar" src="../images/member/<?php echo $valTrainer['trainer_picture']==''?"profile_men.jpg":$valTrainer['trainer_picture'];?>">
                                    <input type="hidden" name="txtPicture" value="<?php echo $valTrainer['trainer_picture']; ?>">
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <?php  $idrd=0; while ($valPrefix = mysql_fetch_assoc($listPrefix)){ $idrd = $idrd+1; ?>
                                            <div class="radio radio-inline">
                                                <input type="radio" name="txtPrefix" id="radio<?php echo $idrd; ?>" value="<?php echo $valPrefix['status_value'];?>" <?php if ($valTrainer['trainer_prefix']==$valPrefix['status_value']){echo "checked";} ?>>
                                                <label for="radio<?php echo $idrd; ?>"><?php echo $valPrefix['status_text'];?></label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="txtFirstname" class="form-control" placeholder="ชื่อ" value="<?php echo $valTrainer['trainer_firstname']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="txtLastname" class="form-control" placeholder="นามสกุล" value="<?php echo $valTrainer['trainer_lastname']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        ตำแหน่ง
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="txtRank" class="form-control" placeholder="ตำแหน่ง" value="<?php echo $valTrainer['trainer_rank']; ?>">
                                    </div>
                                </div>
<!--                                <div class="description">ครูฝึก/--><?php //echo $valCompany['company_name']; ?><!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section">
                                <div class="section-title">ข้อมูลการติดต่อ</div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">เบอร์โทรศัพท์</label>
                                    <div class="col-md-4">
                                        <input type="tel" maxlength="10" name="txtTel" class="form-control" placeholder="เบอร์โทรศัพท์" value="<?php echo $valTrainer['trainer_tel']; ?>">
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
                                            <option value="">เลือกสถานประกอบการ</option>
                                            <?php while ($valListCompany = mysql_fetch_assoc($listCompany)){ ?>
                                                <option value="<?php echo $valListCompany['company_id']; ?>"<?php if ($valCompany['company_id']==$valListCompany['company_id']){echo "SELECTED";} ?>><?php echo $valListCompany['company_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" name="editTrainer" class="btn btn-primary">บันทึก</button> &nbsp
                                <a href="index.php?page=student_profile"><button type="button" class="btn btn-default">ยกเลิก</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<br>