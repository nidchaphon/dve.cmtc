<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/20/2016 AD
 * Time: 21:59
 */

$classStudent = new Student();
$classTeacher = new Teacher();

if (isset($_GET['memberID'])){
    $memberID = $_GET['memberID'];
}else{
    $memberID = $_COOKIE['memberID'];
}

$valStudent = $classStudent->GetDetailStudent($memberID,$sutdentID);
$valTeacher2 = $classTeacher->GetDetailTeacher($memberID,$valStudent['teacher2_id']);
$valDegree = $classStudent->GetStatusDetailStudent($valStudent['student_degree']);
$valGroup = $classStudent->GetStatusDetailStudent($valStudent['student_group']);
$valNational = $classStudent->GetStatusDetailStudent($valStudent['student_national']);
$valReligion = $classStudent->GetStatusDetailStudent($valStudent['student_religion']);
$valBlood = $classStudent->GetStatusDetailStudent($valStudent['student_blood']);
$valDepartment = $classStudent->GetStatusDetailStudent($valStudent['student_department']);

//echo '<pre>';print_r($valStudent);echo'</pre>';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body app-heading">
                <img class="profile-img" src="../images/member/<?php echo $valStudent['student_picture']==''?"profile_men.jpg":$valStudent['student_picture'];?>">
                <div class="app-title">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="title"><span class="highlight">
                                    <?php if ($valStudent['student_sex']=='male'){echo "นาย";}if ($valStudent['student_sex']=='female'){echo "นางสาว";}
                                    echo $valStudent['student_firstname']==''?"ชื่อ":$valStudent['student_firstname'];
                                    echo " ";
                                    echo $valStudent['student_lastname']==''?"นามสกุล":$valStudent['student_lastname']; ?></span></div>
                            <div class="description">
                                <?php echo $valStudent['student_code'];
                                echo " / ";
                                echo $valStudent['student_department']==''?"-":$valDepartment['status_text'];
                                echo " กลุ่ม ";
                                echo $valStudent['student_group']==''?"-":$valGroup['status_text'];
                                echo "<br>";
                                echo $valStudent['student_degree']==''?"-":$valDegree['status_text'];
                                echo " ปี ";
                                echo $valStudent['student_year']==''?"-":$valStudent['student_year'];
                                ?></div>
                        </div>
                        <?php if (!isset($_GET['memberID'])){ ?>
                        <div class="col-md-7">
                            <a href="index.php?page=student_profile_edit"><button type="button" class="btn btn-primary">แก้ไขข้อมูล &nbsp <i class='fa fa-edit (alias)'></i></button></a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-tab">
            <div class="card-header">
                <ul class="nav nav-tabs">
                    <li role="tab1" class="active" style="width: auto;">
                        <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">ประวัตินักศึกษาฝึกประสบการณ์</a>
                    </li>
                    <li role="tab2" style="width: auto;">
                        <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">ข้อมูลการฝึกประสบการณ์</a>
                    </li>
                    <li role="tab3" style="width: auto;">
                        <a href="#tab3" aria-controls="tab2" role="tab" data-toggle="tab">ข้อมูลอาจารย์</a>
                    </li>
                    <li role="tab4" style="width: auto;">
                        <a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">ข้อมูลสถานประกอบการ</a>
                    </li>
                </ul>
            </div>
            <div class="card-body no-padding tab-content">
                <div role="tabpanel" class="tab-pane active" id="tab1">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="section">
                                <div class="section-title">ข้อมูลส่วนตัว</div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>วัน/เดือน/ปี เกิด</strong></p></div>
                                        <div class="col-md-3"><?php echo $valStudent['student_birthdate']==''?"-":DBThaiLongDate($valStudent['student_birthdate']); ?></div>
                                        <div class="col-md-1"><strong>อายุ </strong></div>
                                        <div class="col-md-3"><?php echo $valStudent['student_birthdate']==''||$valStudent['student_birthdate']=='0000-00-00'?"-":GetAge($valStudent['student_birthdate']); ?> ปี</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>น้ำหนัก</strong></p></div>
                                        <div class="col-md-3"><?php echo $valStudent['student_weight']==''?"-":$valStudent['student_weight']; ?> กิโลกรัม</div>
                                        <div class="col-md-1"><strong>ส่วนสูง</strong></div>
                                        <div class="col-md-3"><?php echo $valStudent['student_height']==''?"-":$valStudent['student_height']; ?> เซนติเมตร</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>เชื้อชาติ</strong></p></div>
                                        <div class="col-md-3"><?php echo $valStudent['student_national']==''?"-":$valNational['status_text']; ?></div>
                                        <div class="col-md-1"><strong>ศาสนา</strong></div>
                                        <div class="col-md-3"><?php echo $valStudent['student_religion']==''?"-":$valReligion['status_text']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>กรุ๊ปเลือด</strong></p></div>
                                        <div class="col-md-8"><?php echo $valStudent['student_blood']==''?"-":$valBlood['status_text']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>โรคประจำตัว</strong></p></div>
                                        <div class="col-md-8"><?php echo $valStudent['student_disease']==''?"-":$valStudent['student_disease']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>ยาที่แพ้</strong></p></div>
                                        <div class="col-md-8"><?php echo $valStudent['student_medicine']==''?"-":$valStudent['student_medicine']; ?></div>
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
                                        <div class="col-md-2"><?php echo $valStudent['student_father_age']==''?"-":$valStudent['student_father_age']; ?> ปี</div>
                                        <div class="col-md-1"><p><strong>อาชีพ</strong></p></div>
                                        <div class="col-md-2"><?php echo $valStudent['student_father_career']==''?"-":$valStudent['student_father_career']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>ชื่อมารดา</strong></p></div>
                                        <div class="col-md-3"><?php echo $valStudent['student_mother_name']==''?"-":$valStudent['student_mother_name']; ?></div>
                                        <div class="col-md-1"><p><strong>อายุ</strong></p></div>
                                        <div class="col-md-2"><?php echo $valStudent['student_mother_age']==''?"-":$valStudent['student_mother_age']; ?> ปี</div>
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

                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab2">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="section">
                                <div class="section-title">ข้อมูลการฝึกประสบการณ์</div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-md-3"><p><strong>ระยะเวลาฝึกประสบการณ์</strong></p></div>
                                        <div class="col-md-3"><?php echo $valStudent['student_training_start']=='0000-00-00'?"-":DBThaiLongDateFull($valStudent['student_training_start']); ?></div>
                                        <div class="col-md-1"><p><strong>ถึง</strong></p></div>
                                        <div class="col-md-3"><?php echo $valStudent['student_training_end']=='0000-00-00'?"-":DBThaiLongDateFull($valStudent['student_training_end']); ?></div>
                                        </div>
                                    <div class="row">
                                        <div class="col-md-3"><p><strong>เป็นเวลา</strong></p></div>
                                        <div class="col-md-2"><?php echo $valStudent['student_training_start']==''?"-":CalDateStartToEnd($valStudent['student_training_start'],$valStudent['student_training_end']); ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><p><strong>สถานประกอบการ</strong></p></div>
                                        <div class="col-md-8"><?php echo $valStudent['company_name']==''?"-":$valStudent['company_name']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab3">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="section">
                                <div class="section-title">ข้อมูลอาจารย์ที่ปรึกษา</div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>ชื่ออาจารย์ที่ปรึกษา</strong></p></div>
                                        <div class="col-md-8"><?php echo $valTeacher2['teacher_firstname']==''?"-":"อาจารย์ ".$valTeacher2['teacher_firstname']." ".$valTeacher2['teacher_lastname']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>ตำแหน่ง</strong></p></div>
                                        <div class="col-md-8"><?php echo $valTeacher2['teacher_rank']==''?"-":$valTeacher2['teacher_rank']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>เบอร์โทรศัพท์</strong></p></div>
                                        <div class="col-md-8"><?php echo $valTeacher2['teacher_tel']==''?"-":$valTeacher2['teacher_tel']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>อีเมลล์</strong></p></div>
                                        <div class="col-md-8"><?php echo $valTeacher2['teacher_email']==''?"-":$valTeacher2['teacher_email']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>Facebook</strong></p></div>
                                        <div class="col-md-8"><?php if ($valTeacher2['teacher_facebook'] != ''){ echo '<a href="https://www.facebook.com/'.$valTeacher2['teacher_facebook'].'" target="_blank">https://www.facebook.com/'.$valTeacher2['teacher_facebook'].'&nbsp;&nbsp;<img src="../images_sys/icon_facebook.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>Line</strong></p></div>
                                        <div class="col-md-8"><?php if ($valTeacher2['teacher_line'] != ''){ echo '<a href="http://line.me/ti/p/~'.$valTeacher2['teacher_line'].'" target="_blank">'.$valTeacher2['teacher_line'].'&nbsp;&nbsp;<img src="../images_sys/icon_line.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>Instagram</strong></p></div>
                                        <div class="col-md-8"><?php if ($valTeacher2['teacher_instagram'] != ''){ echo '<a href="https://www.instagram.com/'.$valTeacher2['teacher_instagram'].'" target="_blank">'.$valTeacher2['teacher_instagram'].'&nbsp;&nbsp;<img src="../images_sys/icon_instagram.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                                    </div><div class="row">
                                        <div class="col-md-2"><p><strong>Twitter</strong></p></div>
                                        <div class="col-md-8"><?php if ($valTeacher2['teacher_twitter'] != ''){ echo '<a href="https://twitter.com/'.$valTeacher2['teacher_twitter'].'" target="_blank">https://twitter.com/'.$valTeacher2['teacher_twitter'].'&nbsp;&nbsp;<img src="../images_sys/icon_twitter.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                                    </div>
                                </div>
                                <div class="section-title">ข้อมูลอาจารย์นิเทศ</div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>ชื่ออาจารย์นิเทศ</strong></p></div>
                                        <div class="col-md-8"><?php echo $valStudent['teacher_firstname']==''?"-":"อาจารย์ ".$valStudent['teacher_firstname']." ".$valStudent['teacher_lastname']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>ตำแหน่ง</strong></p></div>
                                        <div class="col-md-8"><?php echo $valStudent['teacher_rank']==''?"-":$valStudent['teacher_rank']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>เบอร์โทรศัพท์</strong></p></div>
                                        <div class="col-md-8"><?php echo $valStudent['teacher_tel']==''?"-":$valStudent['teacher_tel']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>อีเมลล์</strong></p></div>
                                        <div class="col-md-8"><?php echo $valStudent['teacher_email']==''?"-":$valStudent['teacher_email']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>Facebook</strong></p></div>
                                        <div class="col-md-8"><?php if ($valStudent['teacher_facebook'] != ''){ echo '<a href="https://www.facebook.com/'.$valStudent['teacher_facebook'].'" target="_blank">https://www.facebook.com/'.$valStudent['teacher_facebook'].'&nbsp;&nbsp;<img src="../images_sys/icon_facebook.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>Line</strong></p></div>
                                        <div class="col-md-8"><?php if ($valStudent['teacher_line'] != ''){ echo '<a href="http://line.me/ti/p/~'.$valStudent['teacher_line'].'" target="_blank">'.$valStudent['teacher_line'].'&nbsp;&nbsp;<img src="../images_sys/icon_line.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>Instagram</strong></p></div>
                                        <div class="col-md-8"><?php if ($valStudent['teacher_instagram'] != ''){ echo '<a href="https://www.instagram.com/'.$valStudent['teacher_instagram'].'" target="_blank">'.$valStudent['teacher_instagram'].'&nbsp;&nbsp;<img src="../images_sys/icon_instagram.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                                    </div><div class="row">
                                        <div class="col-md-2"><p><strong>Twitter</strong></p></div>
                                        <div class="col-md-8"><?php if ($valStudent['teacher_twitter'] != ''){ echo '<a href="https://twitter.com/'.$valStudent['teacher_twitter'].'" target="_blank">https://twitter.com/'.$valStudent['teacher_twitter'].'&nbsp;&nbsp;<img src="../images_sys/icon_twitter.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab4">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="section">
                                <div class="section-title">ข้อมูลสถานประกอบการ</div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>ชื่อสถานประกอบการ</strong></p></div>
                                        <div class="col-md-8"><?php echo $valStudent['company_name']==''?"-":$valStudent['company_name']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>ที่อยู่</strong></p></div>
                                        <div class="col-md-8"><?php echo $valStudent['company_address']==''?"-":$valStudent['company_address']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>เบอร์โทรศัพท์</strong></p></div>
                                        <div class="col-md-8"><?php echo $valStudent['company_tel']==''?"-":$valStudent['company_tel']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>อีเมลล์</strong></p></div>
                                        <div class="col-md-8"><?php echo $valStudent['company_email']==''?"-":$valStudent['company_email']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>เว็บไซต์</strong></p></div>
                                        <div class="col-md-8"><a href="<?php echo $valStudent['company_website']; ?>" target="_blank"><?php echo $valStudent['company_website']==''?"-":$valStudent['company_website']; ?></a></div>
                                    </div>
                                </div>
                                <div class="section-title">ข้อมูลผู้ควบคุมการฝึกประสบการณ์</div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>ชื่อผู้ควบคุม</strong></p></div>
                                        <div class="col-md-8"><?php echo $valStudent['trainer_firstname']==''?"-":$valStudent['trainer_firstname']." ".$valStudent['trainer_lastname']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>ตำแหน่ง</strong></p></div>
                                        <div class="col-md-8"><?php echo $valStudent['trainer_rank']==''?"-":$valStudent['trainer_rank']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>เบอร์โทรศัพท์</strong></p></div>
                                        <div class="col-md-8"><?php echo $valStudent['trainer_tel']==''?"-":$valStudent['trainer_tel']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>อีเมลล์</strong></p></div>
                                        <div class="col-md-8"><?php echo $valStudent['trainer_email']==''?"-":$valStudent['trainer_email']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>Facebook</strong></p></div>
                                        <div class="col-md-8"><?php if ($valStudent['trainer_facebook'] != ''){ echo '<a href="https://www.facebook.com/'.$valStudent['trainer_facebook'].'" target="_blank">https://www.facebook.com/'.$valStudent['trainer_facebook'].'&nbsp;&nbsp;<img src="../images_sys/icon_facebook.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>Line</strong></p></div>
                                        <div class="col-md-8"><?php if ($valStudent['trainer_line'] != ''){ echo '<a href="http://line.me/ti/p/~'.$valStudent['trainer_line'].'" target="_blank">'.$valStudent['trainer_line'].'&nbsp;&nbsp;<img src="../images_sys/icon_line.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>Instagram</strong></p></div>
                                        <div class="col-md-8"><?php if ($valStudent['trainer_instagram'] != ''){ echo '<a href="https://www.instagram.com/'.$valStudent['trainer_instagram'].'" target="_blank">'.$valStudent['trainer_instagram'].'&nbsp;&nbsp;<img src="../images_sys/icon_instagram.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                                    </div><div class="row">
                                        <div class="col-md-2"><p><strong>Twitter</strong></p></div>
                                        <div class="col-md-8"><?php if ($valStudent['trainer_twitter'] != ''){ echo '<a href="https://twitter.com/'.$valStudent['trainer_twitter'].'" target="_blank">https://twitter.com/'.$valStudent['trainer_twitter'].'&nbsp;&nbsp;<img src="../images_sys/icon_twitter.png" width="30px" height="30px"></a>';}else{ echo '-'; } ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>