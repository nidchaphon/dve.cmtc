<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 2/8/2017 AD
 * Time: 22:16
 */

if ($detect->isMobile() || $detect->isTablet()) {
    echo "<script>alert('กรุณาใช้งานอุปกรณ์ของคุณในแนวนอน เพื่อการแสดงผลตารางให้พอดีกับจอภาพ');</script>";
}

$classCompany = new Company();
$listCompany = $classCompany->GetListCompany();

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
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header"><br><br></div>
            <div class="card-body" >
                <div class="table-responsive">
                    <table class="datatable table-responsive table-striped table-bordered table-hover" id="dataTables-example"  cellspacing="0" width="100%" align="center">
                        <thead>
                        <tr>
                            <th style="text-align: center" height="50px">ชื่อสถานประกอบการ</th>
                            <th style="text-align: center">เบอร์โทรศัพท์</th>
                            <th style="text-align: center">อีเมลล์</th>
                            <th style="text-align: center">จำนวนนักศึกษา</th>
<!--                            <th width="15%" style="text-align: center">รายละเอียด</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($valCompany = mysql_fetch_assoc($listCompany)){ ?>
                            <tr>
                                <td height="30px"><a href="index.php?page=company_detail&companyID=<?php echo $valCompany['company_id']; ?>"><?php echo $valCompany['company_name'] ?></a></td>
                                <td><?php echo $valCompany['company_tel'] ?></td>
                                <td><?php echo $valCompany['company_email'] ?></td>
                                <td align="center"><?php if ($valCompany['numStudent'] == '0'){echo "ไม่มีนักศึกษาฝึกประสบการณ์";}else{echo $valCompany['numStudent']." คน";} ?></td>
<!--                                <td align="center">-->
<!--                                    <a href="index.php?page=company_detail&companyID=--><?php //echo $valCompany['company_id']; ?><!--"><i class='fa fa-institution (alias)' title='ข้อมูลสถานประกอบการ'></i></a>-->
<!--                                </td>-->
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>