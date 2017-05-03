<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/23/2016 AD
 * Time: 22:01
 */

$memberID = $_GET['memberID'];
$status = $_GET['memberStatus'];

$classAdmin = new Admin();
$classTeacher = new teacher();
$classTrainer = new trainer();
$classStudent = new student();

$valMember = $classAdmin->GetDetailUser($memberID)

//echo '<pre>';print_r($status);echo '</pre>';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>ข้อมูลผู้ใช้</h3>
            </div>
            <div class="card-body">
                <div class="section">
<!--                //-----ส่วนแสดงผลข้อมูล อาจารย์นิเทศ/อาจารย์ที่ปรึกษา-----//-->
                <?php if ($status == 'teacher' || $status == 'teacher2'){
                    $valTeacher = $classTeacher->GetDetailTeacher($memberID,$teacherID);   ?>
                    <div class="section-title">ข้อมูลผู้ใช้</div>
                    <div class="section-body">
                    <div class="row">
                        <div class="col-md-2"><p><strong>Username</strong></p></div>
                        <div class="col-md-8"><?php echo $valMember['member_username']; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><p><strong>Password</strong></p></div>
                        <div class="col-md-8"><?php echo $valMember['member_password']; ?></div>
                    </div>
                    </div>
                    <div class="section-title">ข้อมูลส่วนตัว</div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-2"><p><strong>ชื่อ - สกุล</strong></p></div>
                            <div class="col-md-8"><?php echo $valTeacher['teacher_firstname']." ".$valTeacher['teacher_lastname']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>ตำแหน่ง</strong></p></div>
                            <div class="col-md-8"><?php echo $valTeacher['teacher_rank']==''?"-":$valTeacher['teacher_rank']; ?></div>
                        </div>
                    </div>
                    <div class="section-title">ข้อมูลการติดต่อ</div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-2"><p><strong>เบอร์โทรศัพท์</strong></p></div>
                            <div class="col-md-8"><?php echo $valTeacher['teacher_tel']==''?"-":$valTeacher['teacher_tel']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>อีเมลล์</strong></p></div>
                            <div class="col-md-8"><?php echo $valTeacher['teacher_email']==''?"-":$valTeacher['teacher_email']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>Facebook</strong></p></div>
                            <div class="col-md-8"><?php if ($valTeacher['teacher_facebook'] != ''){ echo '<a href="https://www.facebook.com/'.$valTeacher['teacher_facebook'].'" target="_blank">https://www.facebook.com/'.$valTeacher['teacher_facebook'].'&nbsp;&nbsp;<img src="../images_sys/icon_facebook.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>Line</strong></p></div>
                            <div class="col-md-8"><?php if ($valTeacher['teacher_line'] != ''){ echo '<a href="http://line.me/ti/p/~'.$valTeacher['teacher_line'].'" target="_blank">'.$valTeacher['teacher_line'].'&nbsp;&nbsp;<img src="../images_sys/icon_line.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>Instagram</strong></p></div>
                            <div class="col-md-8"><?php if ($valTeacher['teacher_instagram'] != ''){ echo '<a href="https://www.instagram.com/'.$valTeacher['teacher_instagram'].'" target="_blank">'.$valTeacher['teacher_instagram'].'&nbsp;&nbsp;<img src="../images_sys/icon_instagram.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                        </div><div class="row">
                            <div class="col-md-2"><p><strong>Twitter</strong></p></div>
                            <div class="col-md-8"><?php if ($valTeacher['teacher_twitter'] != ''){ echo '<a href="https://twitter.com/'.$valTeacher['teacher_twitter'].'" target="_blank">https://twitter.com/'.$valTeacher['teacher_twitter'].'&nbsp;&nbsp;<img src="../images_sys/icon_twitter.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                        </div>
                    </div>
                <?php } ?>
<!--                //-----ส่วนแสดงผลข้อมูล ครูฝึก-----//-->
                <?php if ($status == 'trainer'){
                    $valTrainer = $classTrainer->GetDetailTrainer($memberID,$trainerID);
                    $companyID = $valTrainer['company_id'];
                    $valCompany = $classTrainer->GetDetailCompany($companyID);
                    ?>
                    <div class="section-title">ข้อมูลผู้ใช้</div>
                    <div class="section-body">
                    <div class="row">
                        <div class="col-md-2"><p><strong>Username</strong></p></div>
                        <div class="col-md-8"><?php echo $valMember['member_username']; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><p><strong>Password</strong></p></div>
                        <div class="col-md-8"><?php echo $valMember['member_password']; ?></div>
                    </div>
                    </div>
                    <div class="section-title">ข้อมูลส่วนตัว</div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-2"><p><strong>ชื่อ - สกุล</strong></p></div>
                            <div class="col-md-8"><?php echo $valTrainer['trainer_firstname']." ".$valTrainer['trainer_lastname']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>บริษัท</strong></p></div>
                            <div class="col-md-8"><?php echo $valCompany['company_name']; ?></div>
                        </div>
                    </div>
                    <div class="section-title">ข้อมูลการติดต่อ</div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-2"><p><strong>ที่อยู่</strong></p></div>
                            <div class="col-md-7"><?php echo $valCompany['company_address']==''?"-":$valCompany['company_address']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>เบอร์โทรศัพท์</strong></p></div>
                            <div class="col-md-7"><?php echo $valTrainer['trainer_tel']==''?"-":$valTrainer['trainer_tel']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>อีเมลล์</strong></p></div>
                            <div class="col-md-7"><?php echo $valTrainer['trainer_email']==''?"-":$valTrainer['trainer_email']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>Facebook</strong></p></div>
                            <div class="col-md-8"><?php if ($valTrainer['trainer_facebook'] != ''){ echo '<a href="https://www.facebook.com/'.$valTrainer['trainer_facebook'].'" target="_blank">https://www.facebook.com/'.$valTrainer['trainer_facebook'].'&nbsp;&nbsp;<img src="../images_sys/icon_facebook.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>Line</strong></p></div>
                            <div class="col-md-8"><?php if ($valTrainer['trainer_line'] != ''){ echo '<a href="http://line.me/ti/p/~'.$valTrainer['trainer_line'].'" target="_blank">'.$valTrainer['trainer_line'].'&nbsp;&nbsp;<img src="../images_sys/icon_line.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>Instagram</strong></p></div>
                            <div class="col-md-8"><?php if ($valTrainer['trainer_instagram'] != ''){ echo '<a href="https://www.instagram.com/'.$valTrainer['trainer_instagram'].'" target="_blank">'.$valTrainer['trainer_instagram'].'&nbsp;&nbsp;<img src="../images_sys/icon_instagram.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                        </div><div class="row">
                            <div class="col-md-2"><p><strong>Twitter</strong></p></div>
                            <div class="col-md-8"><?php if ($valTrainer['trainer_twitter'] != ''){ echo '<a href="https://twitter.com/'.$valTrainer['trainer_twitter'].'" target="_blank">https://twitter.com/'.$valTrainer['trainer_twitter'].'&nbsp;&nbsp;<img src="../images_sys/icon_twitter.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                        </div>
                    </div>
                <?php }?>
<!--                //-----ส่วนแสดงผลข้อมูล นักศึกษาฝึกงาน-----//-->
                <?php if ($status == 'student'){
                    $valStudent = $classStudent->GetDetailStudent($memberID,$studentID);
                    $valTeacher2 = $classTeacher->GetDetailTeacher($memberID,$valStudent['teacher2_id']);
                    $valDegree = $classStudent->GetStatusDetailStudent($valStudent['student_degree']);
                    $valDepartment = $classStudent->GetStatusDetailStudent($valStudent['student_department']);
                    $valGroup = $classStudent->GetStatusDetailStudent($valStudent['student_group']);
                    $valNational = $classStudent->GetStatusDetailStudent($valStudent['student_national']);
                    $valReligion = $classStudent->GetStatusDetailStudent($valStudent['student_religion']);
                    $valBlood = $classStudent->GetStatusDetailStudent($valStudent['student_blood']); ?>
                    <div class="section-title">ข้อมูลผู้ใช้</div>
                    <div class="section-body">
                    <div class="row">
                        <div class="col-md-2"><p><strong>Username</strong></p></div>
                        <div class="col-md-8"><?php echo $valMember['member_username']; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><p><strong>Password</strong></p></div>
                        <div class="col-md-8"><?php echo $valMember['member_password']; ?></div>
                    </div>
                    </div>

                    <div class="section-title">ข้อมูลส่วนตัว</div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-2"><p><strong>ชื่อ</strong></p></div>
                            <div class="col-md-2"><?php echo $valStudent['sex']==''?"-":$valStudent['sex']=='male'?"นาย":"นางสาว";
                            echo $valStudent['student_firstname']==''?"-":$valStudent['student_firstname']; ?></div>
                            <div class="col-md-1"><strong>นามสกุล</strong></div>
                            <div class="col-md-3"><?php echo $valStudent['student_lastname']==''?"-":$valStudent['student_lastname']; ?> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>รหัสนักศึกษา</strong></p></div>
                            <div class="col-md-2"><?php echo $valStudent['student_code']==''?"-":$valStudent['student_code']; ?></div>
                            <div class="col-md-1"><strong>ระดับชั้น</strong></div>
                            <div class="col-md-2"><?php echo $valStudent['student_degree']==''?"-":$valDegree['status_text']; echo $valStudent['student_year']==''?"-":" ปี ".$valStudent['student_year'];?>  </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>สาขา</strong></p></div>
                            <div class="col-md-2"><?php echo $valStudent['student_department']==''?"-":$valDepartment['status_text']; ?> </div>
                            <div class="col-md-1"><strong>กลุ่ม</strong></div>
                            <div class="col-md-2"><?php echo $valStudent['student_group']==''?"-":$valGroup['status_text']; ?> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>วัน/เดือน/ปี เกิด</strong></p></div>
                            <div class="col-md-2"><?php echo $valStudent['student_birthdate']==''?"-":DBThaiLongDate($valStudent['student_birthdate']); ?></div>
                            <div class="col-md-1"><strong>อายุ </strong></div>
                            <div class="col-md-3"><?php echo $valStudent['student_birthdate']==''||$valStudent['student_birthdate']=='0000-00-00'?"-":GetAge($valStudent['student_birthdate'])." ปี"; ?> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>น้ำหนัก</strong></p></div>
                            <div class="col-md-2"><?php echo $valStudent['student_weight']==''?"-":$valStudent['student_weight']." กิโลกรัม"; ?></div>
                            <div class="col-md-1"><strong>ส่วนสูง</strong></div>
                            <div class="col-md-3"><?php echo $valStudent['student_height']==''?"-":$valStudent['student_height']." เซนติเมตร"; ?> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>เชื้อชาติ</strong></p></div>
                            <div class="col-md-2"><?php echo $valStudent['student_national']==''?"-":$valNational['status_text']; ?></div>
                            <div class="col-md-1"><strong>ศาสนา</strong></div>
                            <div class="col-md-3"><?php echo $valStudent['student_religion']==''?"-":$valReligion['status_text']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>กรุ๊ปเลือด</strong></p></div>
                            <div class="col-md-8"><?php echo $valStudent['student_blood']==''?"-":$valBlood['status_text']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>โรคประจำตัว</strong></p></div>
                            <div class="col-md-5"><?php echo $valStudent['student_disease']==''?"-":$valStudent['student_disease']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>ยาที่แพ้</strong></p></div>
                            <div class="col-md-5"><?php echo $valStudent['student_medicine']==''?"-":$valStudent['student_medicine']; ?></div>
                        </div>
                    </div>
                    <div class="section-title">ข้อมูลการติดต่อ</div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-2"><p><strong>ที่อยู่</strong></p></div>
                            <div class="col-md-8"><?php echo $valStudent['student_address']==''?"-":$valStudent['student_address']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>เบอร์โทรศัพท์</strong></p></div>
                            <div class="col-md-8"><?php echo $valStudent['student_tel']==''?"-":$valStudent['student_tel']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>อีเมลล์</strong></p></div>
                            <div class="col-md-8"><?php echo $valStudent['student_email']==''?"-":$valStudent['student_email']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>Facebook</strong></p></div>
                            <div class="col-md-8"><?php if ($valStudent['student_facebook'] != ''){ echo '<a href="https://www.facebook.com/'.$valStudent['student_facebook'].'" target="_blank">https://www.facebook.com/'.$valStudent['student_facebook'].'&nbsp;&nbsp;<img src="../images_sys/icon_facebook.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>Line</strong></p></div>
                            <div class="col-md-8"><?php if ($valStudent['student_line'] != ''){ echo '<a href="http://line.me/ti/p/~'.$valStudent['student_line'].'" target="_blank">'.$valStudent['student_line'].'&nbsp;&nbsp;<img src="../images_sys/icon_line.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>Instagram</strong></p></div>
                            <div class="col-md-8"><?php if ($valStudent['student_instagram'] != ''){ echo '<a href="https://www.instagram.com/'.$valStudent['student_instagram'].'" target="_blank">'.$valStudent['student_instagram'].'&nbsp;&nbsp;<img src="../images_sys/icon_instagram.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                        </div><div class="row">
                            <div class="col-md-2"><p><strong>Twitter</strong></p></div>
                            <div class="col-md-8"><?php if ($valStudent['student_twitter'] != ''){ echo '<a href="https://twitter.com/'.$valStudent['student_twitter'].'" target="_blank">https://twitter.com/'.$valStudent['student_twitter'].'&nbsp;&nbsp;<img src="../images_sys/icon_twitter.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                        </div>
                    </div>
                    <div class="section-title">ข้อมูลเพื่อนสนิท</div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-2"><p><strong>เพื่อนสนิทชื่อ</strong></p></div>
                            <div class="col-md-8"><?php echo $valStudent['student_friend_name']==''?"-":$valStudent['student_friend_name']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>ที่อยู่</strong></p></div>
                            <div class="col-md-8"><?php echo $valStudent['student_friend_address']==''?"-":$valStudent['student_friend_address']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>เบอร์โทรศัพท์</strong></p></div>
                            <div class="col-md-8"><?php echo $valStudent['student_friend_tel']==''?"-":$valStudent['student_friend_tel']; ?></div>
                        </div>
                    </div>
                    <div class="section-title">ข้อมูลบิดา - มารดา</div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-2"><p><strong>ชื่อบิดา</strong></p></div>
                            <div class="col-md-3"><?php echo $valStudent['student_father_name']==''?"-":$valStudent['student_father_name']; ?></div>
                            <div class="col-md-1"><p><strong>อายุ</strong></p></div>
                            <div class="col-md-2"><?php echo $valStudent['student_father_age']==''?"-":$valStudent['student_father_age']." ปี"; ?> </div>
                            <div class="col-md-1"><p><strong>อาชีพ</strong></p></div>
                            <div class="col-md-2"><?php echo $valStudent['student_father_career']==''?"-":$valStudent['student_father_career']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>ชื่อมารดา</strong></p></div>
                            <div class="col-md-3"><?php echo $valStudent['student_mother_name']==''?"-":$valStudent['student_mother_name']; ?></div>
                            <div class="col-md-1"><p><strong>อายุ</strong></p></div>
                            <div class="col-md-2"><?php echo $valStudent['student_mother_age']==''?"-":$valStudent['student_mother_age']." ปี"; ?> </div>
                            <div class="col-md-1"><p><strong>อาชีพ</strong></p></div>
                            <div class="col-md-2"><?php echo $valStudent['student_mother_career']==''?"-":$valStudent['student_mother_career']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>ที่อยู่บิดา - มารดา</strong></p></div>
                            <div class="col-md-8"><?php echo $valStudent['student_father_address']==''?"-":$valStudent['student_father_address']; ?></div>
                        </div>
                    </div>
                    <div class="section-title">ข้อมูลผู้ปกครองขณะศึกษาอยู่</div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-2"><p><strong>ชื่อ - สกุล</strong></p></div>
                            <div class="col-md-3"><?php echo $valStudent['student_parent_name']==''?"-":$valStudent['student_parent_name']; ?></div>
                            <div class="col-md-1" style="width: auto;"><p><strong>เกี่ยวข้องเป็น</strong></p></div>
                            <div class="col-md-3"><?php echo $valStudent['student_parent_connect']==''?"-":$valStudent['student_parent_connect']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>ที่อยู่</strong></p></div>
                            <div class="col-md-8"><?php echo $valStudent['student_parent_address']==''?"-":$valStudent['student_parent_address']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>เบอร์โทรศัพท์</strong></p></div>
                            <div class="col-md-8"><?php echo $valStudent['student_parent_tel']==''?"-":$valStudent['student_parent_tel']; ?></div>
                        </div>
                    </div>
                    <div class="section-title">ข้อมูลบุคคลที่สามารถให้ข้อมูลเกี่ยวกับนักศึกษาได้</div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-2"><p><strong>ชื่อ - สกุล</strong></p></div>
                            <div class="col-md-3"><?php echo $valStudent['student_giveinfo_name']==''?"-":$valStudent['student_giveinfo_name']; ?></div>
                            <div class="col-md-1" style="width: auto;"><p><strong>อาชีพ</strong></p></div>
                            <div class="col-md-3"><?php echo $valStudent['student_giveinfo_career']==''?"-":$valStudent['student_giveinfo_career']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>ที่อยู่</strong></p></div>
                            <div class="col-md-8"><?php echo $valStudent['student_giveinfo_address']==''?"-":$valStudent['student_giveinfo_address']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>เบอร์โทรศัพท์</strong></p></div>
                            <div class="col-md-8"><?php echo $valStudent['student_giveinfo_tel']==''?"-":$valStudent['student_giveinfo_tel']; ?></div>
                        </div>
                    </div>
                    <div class="section-title">ข้อมูลการฝึกงาน</div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-2"><p><strong>ระยะเวลาฝึกงาน</strong></p></div>
                            <div class="col-md-3"><?php echo $valStudent['student_training_start']=='0000-00-00'?"-":DBThaiLongDateFull($valStudent['student_training_start']); ?></div>
                            <div class="col-md-1"><p><strong>ถึง</strong></p></div>
                            <div class="col-md-3"><?php echo $valStudent['student_training_end']=='0000-00-00'?"-":DBThaiLongDateFull($valStudent['student_training_end']); ?></div>
                            <div class="col-md-1"><p><strong>เป็นเวลา</strong></p></div>
                            <div class="col-md-2"><?php echo $valStudent['student_training_start']=='0000-00-00'?"-":CalDateStartToEnd($valStudent['student_training_start'],$valStudent['student_training_end']); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>อาจารย์ที่ปรึกษา</strong></p></div>
                            <div class="col-md-8"><?php echo $valTeacher2['teacher_firstname']==''?"-":"อาจารย์".$valTeacher2['teacher_firstname']." ".$valTeacher2['teacher_lastname']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>อาจารย์นิเทศ</strong></p></div>
                            <div class="col-md-8"><?php echo $valStudent['teacher_firstname']==''?"-":"อาจารย์".$valStudent['teacher_firstname']." ".$valStudent['teacher_lastname']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>สถานประกอบการ</strong></p></div>
                            <div class="col-md-8"><?php echo $valStudent['company_name']==''?"-":$valStudent['company_name']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><p><strong>ครูฝึก</strong></p></div>
                            <div class="col-md-8"><?php echo $valStudent['trainer_firstname']==''?"-":$valStudent['trainer_firstname']; echo " "; echo $valStudent['trainer_lastname']==''?"-":$valStudent['trainer_lastname']; ?></div>
                        </div>
                    </div>
                <?php }?>

                </div>
            </div>
        </div>
    </div>
</div>