<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/15/2016 AD
 * Time: 22:03
 */

if ($detect->isMobile() || $detect->isTablet()) {
    echo "<script>alert('กรุณาใช้งานอุปกรณ์ของคุณในแนวนอน เพื่อการแสดงผลตารางให้พอดีกับจอภาพ');</script>";
}

$classAdmin = new Admin();
$listFileDownload  = $classAdmin->GetListFileDownload();

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body app-heading">
                <div class="app-title">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="title">
                                <span class="highlight">ข้อมูลไฟล์ดาวน์โหลด​</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <a href="index.php?page=admin_file_add"><button type="button" class="btn btn-primary">เพิ่มไฟล์  <i class='fa fa-plus'></i></button></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <br><br>
            </div>
            <div class="card-body">
                <table class="datatable table-responsive table-striped table-bordered table-hover" id="dataTables-example"  cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th style="text-align: center" height="50px">ชื่อไฟล์</th>
                        <th style="text-align: center">User ที่ดาวน์โหลดได้</th>
                        <th style="text-align: center">ไฟล์เมื่อวันที่</th>
                        <th width="15%" style="text-align: center">จัดการ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($valFileDownload = mysql_fetch_assoc($listFileDownload)){
                        $userExplode = explode(',',$valFileDownload['file_user']);
                        ?>
                        <tr>
                            <td height="30px"><?php echo $valFileDownload['file_name']; ?></td>
                            <td>
                                <ul>
                                    <?php  foreach ($userExplode AS $valUser){
                                        $textUser = $classAdmin->GetTextStatusType($valUser);
                                        echo "<li>".$textUser['status_text']."</li>";
                                    } ?>
                                </ul>

                            </td>
                            <td><?php echo DateTimeThai($valFileDownload['file_date']); ?></td>
                            <td align="center">
                                <a href="../file_download/<?php echo $valFileDownload['file_name'] ?>" onclick="return confirm('ต้องการดาวน์โหลดไฟล์ <?php echo $valFileDownload['file_name']; ?> หรือไม่')"><i class='fa fa-download' title='ดาวน์โหลด'></i></a> &nbsp
                                <a href="index.php?page=admin_file_edit&fileID=<?php echo $valFileDownload['file_id']; ?>"><i class='fa fa-edit (alias)' title='แก้ไขข้อมูล'></i></a>  &nbsp
                                <a href="admin/admin_delete.php?action=delFile&fileID=<?php echo $valFileDownload['file_id']; ?>&fileName=<?php echo $valFileDownload['file_name'] ?>" onclick="return confirm('ต้องการลบไฟล์ <?php echo $valFileDownload['file_name'] ?> หรือไม่')"><i class='fa fa-trash' title='ลบข้อมูล'></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>