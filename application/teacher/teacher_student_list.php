<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/16/2017 AD
 * Time: 17:14
 */

if ($detect->isMobile()) {
    echo "<script>alert('กรุณาใช้งานอุปกรณ์ของคุณในแนวนอน เพื่อการแสดงผลตารางให้พอดีกับจอภาพ');</script>";
}if($detect->isTablet()){
    echo "<script>alert('กรุณาใช้งานอุปกรณ์ของคุณในแนวนอน เพื่อการแสดงผลตารางให้พอดีกับจอภาพ');</script>";
}

$classTeacher = new Teacher();
$classStudent = new Student();

$listStudent = $classTeacher->GetListStudent($_COOKIE['memberID']);
$listDegree = $classTeacher->GetListStatus('degree');

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body app-heading">
                <div class="app-title">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="title">
                                <span class="highlight">ข้อมูลนักศึกษาฝึกงาน</span>
                            </div>
                        </div>
                        <form name="frmCheangLsit" action="" method="post">
                        <div class="col-md-4">
                            <select class="select2" name="degree" onchange="this.form.submit()">
                                <option value="degreeAll">ระดับชั้นทั้งหมด</option>
                                <?php while ($valDegree = mysql_fetch_assoc($listDegree)){ ?>
                                <option value="<?php echo $valDegree['status_value'];?>" <?php if ($valDegree['status_value'] == $_POST['degree']){echo "SELECTED";}?>><?php echo $valDegree['status_text']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="select2" name="department" onchange="this.form.submit()">
                                <option>สาขา</option>
                            </select>
                        </div>
                        </form>
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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table-responsive table-striped table-bordered table-hover" id="dataTables-example" style="width: 100%; margin: auto;"  cellspacing="0">
                        <thead>
                        <tr>
                            <th style="text-align: center; vertical-align: middle;" width="5%" height="50px">ลำดับ</th>
                            <th style="text-align: center; vertical-align: middle;" width="10%">รหัสนักศึกษา</th>
                            <th style="text-align: center; vertical-align: middle;" width="25%">ชื่อ - สกุล</th>
                            <th style="text-align: center; vertical-align: middle;" width="20%">ระดับชั้น</th>
                            <th style="text-align: center; vertical-align: middle;" width="15%">สาขา</th>
                            <th style="text-align: center; vertical-align: middle;" width="20%">สถานประกอบการ</th>
                            <th style="text-align: center; vertical-align: middle;" width="5%">ข้อมูล</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=0;
                        while ($valStudent = mysql_fetch_assoc($listStudent)){ $i = $i+1;
                            $valDegree = $classStudent->GetStatusDetailStudent($valStudent['student_degree']);
                            ?>
                            <tr>
                                <td align="center" height="30px"><?php echo $i; ?></td>
                                <td><?php echo $valStudent['student_code']; ?></td>
                                <td><?php echo $valStudent['student_sex']=='male'?"นาย":"นางสาว"; echo $valStudent['studentName']; ?></td>
                                <td><?php echo $valDegree['status_text']." ปี ".$valStudent['student_year']; ?></td>
                                <td><?php echo $valStudent['student_department']; ?></td>
                                <td><?php echo $valStudent['company_name']; ?></td>
                                <td align="center"><a href="index.php?page=student_profile&memberID=<?php echo $valStudent['member_id']; ?>"><i class="fa fa-info-circle" title="ข้อมูลนักศึกษา"></i></a>  </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>