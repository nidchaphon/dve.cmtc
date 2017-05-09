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

$classFileDownload = new FileDownload();
$listFileDownload  = $classFileDownload->GetListFileDownload();

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body app-heading">
                <div class="app-title">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="title">
                                <span class="highlight">ดาวน์โหลดไฟล์​</span>
                            </div>
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
                        <th style="text-align: center">ไฟล์เมื่อวันที่</th>
                        <th width="15%" style="text-align: center">ดาวน์โหลด</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($valFileDownload = mysql_fetch_assoc($listFileDownload)){
                        $userExplode = explode(',',$valFileDownload['file_user']);
                        foreach ($userExplode AS $valUser){
                            if ($_COOKIE['memberStatus'] == $valUser){
                        ?>
                        <tr>
                            <td height="30px"><?php echo $valFileDownload['file_name'] ?></td>
                            <td><?php echo DateTimeThai($valFileDownload['file_date']); ?></td>
                            <td align="center">
                                <a href="../file_download/<?php echo $valFileDownload['file_name'] ?>" onclick="return confirm('ต้องการดาวน์โหลดไฟล์ <?php echo $valFileDownload['file_name']; ?> หรือไม่')"><i class='fa fa-download' title='ดาวน์โหลด'></i></a> &nbsp
                            </td>
                        </tr>
                    <?php }}} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>