<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/20/2016 AD
 * Time: 21:59
 */

$memberID = $_COOKIE['memberID'];

$classTeacher = new Teacher();
$valTeacher = $classTeacher->GetDetailTeacher($memberID,$teacherID);

//echo '<pre>';print_r($data);echo'</pre>';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body app-heading">
                <img class="profile-img" src="../images/member/<?php echo $valTeacher['teacher_picture']==''?"profile_men.jpg":$valTeacher['teacher_picture'];?>">
                <div class="app-title">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="title"><span class="highlight">
                                    <?php echo $valTeacher['teacher_firstname']==''?"ชื่อ ":$valTeacher['teacher_firstname']." ";
                                    echo $valTeacher['teacher_lastname']==''?"นามสกุล":$valTeacher['teacher_lastname']; ?></span></div>
                            <div class="description"><?php echo $valTeacher['teacher_rank']==''?"-":$valTeacher['teacher_rank']; ?></div>
                        </div>
                        <div class="col-md-7">
                            <a href="index.php?page=teacher_profile_edit"><button type="button" class="btn btn-primary">แก้ไขข้อมูล &nbsp <i class='fa fa-edit (alias)'></i></button></a>
                        </div>
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
                    <li role="tab1" class="active">
                        <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">ข้อมูล</a>
                    </li>
                </ul>
            </div>
            <div class="card-body no-padding tab-content">
                <div role="tabpanel" class="tab-pane active" id="tab1">
                    <div class="row">
                        <div class="col-md-9 col-sm-12">
                            <div class="section">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
