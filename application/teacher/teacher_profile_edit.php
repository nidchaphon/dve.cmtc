<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/20/2016 AD
 * Time: 21:59
 */

$memberID = $_COOKIE['memberID'];

$classTeacher = new Teacher();

$valTeacher = $classTeacher->GetDetailTeacher($memberID,$teacherID);
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
    <form name="frmAddUser" class="form form-horizontal" action="teacher/teacher_to_db.php" method="post" enctype="multipart/form-data">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header app-heading">
                    <div class="row">
                        <div class="col-md-3" align="center">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <img class="profile-img" id="imgAvatar" src="../images/member/<?php echo $valTeacher['teacher_picture']==''?"profile_men.jpg":$valTeacher['teacher_picture'];?>">
                                    <input type="hidden" name="txtPicture" value="<?php echo $valTeacher['teacher_picture']; ?>">
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
                                                <input type="radio" name="txtPrefix" id="radio<?php echo $idrd; ?>" value="<?php echo $valPrefix['status_value'];?>" <?php if ($valTeacher['teacher_prefix']==$valPrefix['status_value']){echo "checked";} ?>>
                                                <label for="radio<?php echo $idrd; ?>"><?php echo $valPrefix['status_text'];?></label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="txtFirstname" class="form-control" placeholder="ชื่อ" value="<?php echo $valTeacher['teacher_firstname']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="txtLastname" class="form-control" placeholder="นามสกุล" value="<?php echo $valTeacher['teacher_lastname']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 control-label">ตำแหน่ง</label>
                                    <div class="col-md-6">
                                        <input type="text" name="txtRank" class="form-control" placeholder="ตำแหน่ง" value="<?php echo $valTeacher['teacher_rank']; ?>">
                                    </div>
                                </div>
<!--                            <div class="description">อาจารย์นิเทศ</div>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section">
                                <div class="section-title">ข้อมูลการติดต่อ</div>
                                <div class="section-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">เบอร์โทรศัพท์</label>
                                        <div class="col-md-5">
                                            <input type="tel" maxlength="10" name="txtTel" class="form-control" placeholder="เบอร์โทรศัพท์" value="<?php echo $valTeacher['teacher_tel']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">อีเมลล์</label>
                                        <div class="col-md-5">
                                            <input type="email" name="txtEmail" class="form-control" placeholder="อีเมลล์" value="<?php echo $valTeacher['teacher_email']; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 control-label">Facebook</div>
                                        <div class="col-md-3" align="right">https://www.facebook.com/</div>
                                        <div class="col-md-2"><input type="text" name="txtFacebook" class="form-control" placeholder="" value="<?php echo $valTeacher['teacher_facebook']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 control-label">LineID</div>
                                        <div class="col-md-5"><input type="text" name="txtLine" class="form-control" placeholder="" value="<?php echo $valTeacher['teacher_line']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 control-label">Instagram</div>
                                        <div class="col-md-5"><input type="text" name="txtInstagram" class="form-control" placeholder="" value="<?php echo $valTeacher['teacher_instagram']; ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 control-label">Twitter</div>
                                        <div class="col-md-3" align="right">https://twitter.com/</div>
                                        <div class="col-md-2"><input type="text" name="txtTwitter" class="form-control" placeholder="" value="<?php echo $valTeacher['teacher_twitter']; ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" name="editTeacher" class="btn btn-primary">บันทึก</button> &nbsp
                                <a href="index.php?page=teacher_profile"><button type="button" class="btn btn-default">ยกเลิก</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<br>
