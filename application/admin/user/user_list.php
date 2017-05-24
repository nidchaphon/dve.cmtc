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
$listUser = $classAdmin->GetListUser();

//echo '<pre>';print_r($userList);echo '</pre>';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body app-heading">
                <div class="app-title">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="title">
                                <span class="highlight">รายชื่อผู้ใช้</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <a href="index.php?page=admin_user_add"><button type="button" class="btn btn-primary">เพิ่มผู้ใช้  <i class='fa fa-plus'></i></button></a>
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
            <div class="card-header"><br><br>
            </div>
            <div class="card-body">
                <table class="datatable table-responsive table-striped table-bordered table-hover" id="dataTables-example"  cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th width="10%" height="50px" style="text-align: center; vertical-align: middle;">รหัส</th>
                        <th width="20%" style="text-align: center; vertical-align: middle;">ชื่อ - สกุล</th>
                        <th width="15%" style="text-align: center; vertical-align: middle;">ชื่อผู้ใช้</th>
                        <th width="15%" style="text-align: center; vertical-align: middle;">สถานนะ</th>
                        <th width="10%" style="text-align: center; vertical-align: middle;">สถานะการล็อกอิน</th>
                        <th width="15%" style="text-align: center; vertical-align: middle;">ใช้งานล่าสุด</th>
                        <th width="10%" style="text-align: center; vertical-align: middle;">จัดการ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        while ($valUser = mysql_fetch_assoc($listUser)){
                            if ($valUser['member_status'] == 'admin'){
                                $status =  "ผู้ดูแลระบบ";
                                $name = "ผู้ดูแลระบบ";
                                $code = "-";
                            } elseif ($valUser['member_status'] == 'teacher'){
                                $status = "อาจารย์นิเทศ";
                                $name = $valUser['teacherName'];
                                $code = $valUser['teacher_code'];
                            } elseif ($valUser['member_status'] == 'student'){
                                $status = "นักศึกษาฝึกงาน";
                                $name = $valUser['studentName'];
                                $code = $valUser['student_code'];
                            } elseif ($valUser['member_status'] == 'trainer'){
                                $status = "ครูฝึก";
                                $name = $valUser['trainerName'];
                                $code = $valUser['trainer_code'];
                            } elseif ($valUser['member_status'] == 'teacher2'){
                                $status = "อาจารย์ที่ปรึกษา";
                                $name = $valUser['teacherName'];
                                $code = $valUser['teacher_code'];
                            }
                    ?>
                    <tr>
                        <td height="30px"><?php echo $code; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $valUser['member_username']; ?></td>
                        <td><?php echo $status; ?></td>
                        <td align="center"><?php
                            if ($valUser['member_loginstatus'] == 1){
                                echo "<span class='badge badge-success badge-icon'><i class='fa fa-sign-in' title='ล็อกอิน'></i></span>";
//                                if ($valUser['member_status'] != 'admin'){
//                                    echo " <i class='fa fa-power-off' title='Logout'></i>";
//                                }
                            }elseif ($valUser['member_loginstatus'] == 0){
                                echo "<span class='badge badge-danger badge-icon'><i class='fa fa-sign-out' title='ไม่ได้ล็อกอิน'></i></span>";
                            }
                            ?> </td>
                        <td align="center"><?php
                            if ($valUser['member_lastupdate'] == '0000-00-00 00:00:00'){
                                echo "ยังไม่เคยเข้าใช้งาน";

                            }else{
                                echo DateTimeThai($valUser['member_lastupdate']);
                            } ?></td>
                        <td align="center">
                            <?php if ($valUser['member_status'] != 'admin'){ ?>
                            <a href="index.php?page=admin_user_detail&memberID=<?php echo $valUser['member_id']; ?>&memberStatus=<?php echo $valUser['member_status']; ?>"> <i class='fa fa-user' title='ข้อมูลผู้ใช้'></i></a> &nbsp
                            <?php } ?>
                            <a href="index.php?page=admin_user_edit&memberID=<?php echo $valUser['member_id']; ?>&memberStatus=<?php echo $valUser['member_status']; ?>"><i class='fa fa-edit (alias)' title='แก้ไขข้อมูล'></i></a>  &nbsp
                            <a href="admin/admin_delete.php?action=deleteUser&memberID=<?php echo $valUser['member_id'];?>&memberStatus=<?php echo $valUser['member_status']; ?>" onclick="return confirm('ต้องการลบผู้ใช้ <?php echo $valUser['member_username']." ".$name; ?> หรือไม่')"><i class='fa fa-trash' title='ลบข้อมูล'></i></a> </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>