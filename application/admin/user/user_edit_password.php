<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/18/2016 AD
 * Time: 23:14
 */

$classAdmin = new Admin();

$detailMember = $classAdmin->GetDetailUser($_COOKIE['memberID']);

?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>แก้ไขข้อมูลผู้ใช้</h3>
            </div>
            <div class="card-body">
                <form name="frmAddUser" class="form form-horizontal" action="admin/admin_update.php" method="post">
                    <div class="section">
                        <div class="section-body">
                            <div class="section-title">ข้อมูลผู้ใช้</div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">ID ผู้ใช้</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtMemberID" class="form-control" disabled="disabled" placeholder="Member ID" value="<?php echo $detailMember['member_id']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">ชื่อผู้ใช้</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtUsername" class="form-control" placeholder="Username" value="<?php echo $detailMember['member_username']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">รหัสผ่าน</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtPassword" class="form-control" placeholder="Password" value="<?php echo $detailMember['member_password']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" name="updateUserPassword" class="btn btn-primary">บันทึก</button>
                                <button type="reset" class="btn btn-default">ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>