<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/15/2016 AD
 * Time: 22:03
 */

if ($detect->isMobile()) {
    echo "<script>alert('กรุณาใช้งานอุปกรณ์ของคุณในแนวนอน เพื่อการแสดงผลตารางให้พอดีกับจอภาพ');</script>";
}if($detect->isTablet()){
    echo "<script>alert('กรุณาใช้งานอุปกรณ์ของคุณในแนวนอน เพื่อการแสดงผลตารางให้พอดีกับจอภาพ');</script>";
}

$classAdmin = new Admin();
$listCompany = $classAdmin->GetListCompany();

//echo '<pre>';print_r($companyList);echo '</pre>';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body app-heading">
                <div class="app-title">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="title">
                                <span class="highlight">ข้อมูลสถานประกอบการ</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <a href="index.php?page=admin_company_add"><button type="button" class="btn btn-primary">เพิ่มสถานประกอบการ  <i class='fa fa-plus'></i></button></a>
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
                        <th style="text-align: center" height="50px">ชื่อสถานประกอบการ</th>
                        <th style="text-align: center">ที่อยู่</th>
                        <th style="text-align: center">เบอร์โทรศัพท์</th>
                        <th style="text-align: center">อีเมลล์</th>
                        <th width="15%" style="text-align: center">จัดการ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($valCompany = mysql_fetch_assoc($listCompany)){ ?>
                        <tr>
                            <td height="30px"><?php echo $valCompany['company_name'] ?></td>
                            <td><?php echo $valCompany['company_address'] ?></td>
                            <td><?php echo $valCompany['company_tel'] ?></td>
                            <td><?php echo $valCompany['company_email'] ?></td>
                            <td align="center">
                                <a href="index.php?page=company_detail&companyID=<?php echo $valCompany['company_id']; ?>"><i class='fa fa-institution (alias)' title='ข้อมูลสถานประกอบการ'></i></a> &nbsp
                                <a href="index.php?page=admin_company_edit&companyID=<?php echo $valCompany['company_id']; ?>"><i class='fa fa-edit (alias)' title='แก้ไขข้อมูล'></i></a>  &nbsp
                                <a href="admin/admin_delete.php?action=delCompany&companyID=<?php echo $valCompany['company_id'];?>" onclick="return confirm('ต้องการลบสถานประกอบการนี้ หรือไม่')"><i class='fa fa-trash' title='ลบข้อมูล'></i></a> </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>