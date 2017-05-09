<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/18/2016 AD
 * Time: 23:14
 */

$classAdmin = new Admin();
$listUser = $classAdmin->GetListStatusType('member');

$valFileDownload = $classAdmin->GetDetailFileDownload($_GET['fileID']);

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                แก้ไขไฟล์ดาวน์โหลด
            </div>
            <div class="card-body">
                <form name="frmAddFile" class="form form-horizontal" action="admin/admin_update.php?fileID=<?php echo $valFileDownload['file_id'];?>" method="post" enctype="multipart/form-data">
                    <div class="section">
                        <div class="section-title">ชื่อไฟล์</div>
                        <div class="section-body">
                            <div class="row" align="center">
                                <?php echo $valFileDownload['file_name']; ?>
                            </div>
                        </div>
                        <div class="section-title">User ที่สามารถดาวน์โหลดไฟล์ได้</div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-7">
                                    <?php
                                    $userExplode = explode(',',$valFileDownload['file_user']);
                                    while ($valUser = mysql_fetch_assoc($listUser)){  ?>
                                        <div class="checkbox">
                                            <input type="checkbox" id="<?php echo $valUser['status_value'];?>" name="user[]" value="<?php echo $valUser['status_value'];?>" <?php foreach ($userExplode AS $valUserValue){ if ($valUser['status_value']==$valUserValue){ echo "CHECKED";} } ?>>
                                            <label for="<?php echo $valUser['status_value'];?>">
                                                <?php echo $valUser['status_text'];?>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" name="updateFile" class="btn btn-primary">บันทึก</button> &nbsp
                                <button type="reset" class="btn btn-default">ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>