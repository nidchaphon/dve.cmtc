<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/20/2016 AD
 * Time: 21:59
 */

$memberID = $_COOKIE['memberID'];

$classTrainer = new Trainer();
$valTrainer = $classTrainer->GetDetailTrainer($memberID,$trainerID);
$valCompany = $classTrainer->GetDetailCompany($valTrainer['company_id']);

//echo '<pre>';print_r($data);echo'</pre>';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body app-heading">
                <img class="profile-img" src="../images/member/<?php echo $valTrainer['trainer_picture']==''?"profile_men.jpg":$valTrainer['trainer_picture'];?>">
                <div class="app-title">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="title"><span class="highlight">
                                    <?php if ($valTrainer['trainer_prefix']=='mr'){echo "นาย";}elseif ($valTrainer['trainer_prefix']=='miss'){echo "นาง";}elseif ($valTrainer['trainer_prefix']=='mrs'){echo "นางสาว";};
                                    echo $valTrainer['trainer_firstname']==''?"ชื่อ ":$valTrainer['trainer_firstname']." ";
                                    echo $valTrainer['trainer_lastname']==''?" นามสกุล":$valTrainer['trainer_lastname']; ?></span></div>
                            <div class="description"><?php echo $valTrainer['trainer_rank']." / ".$valCompany['company_name']; ?></div>
                        </div>
                        <div class="col-md-4">
                            <a href="index.php?page=trainer_profile_edit"><button type="button" class="btn btn-primary">แก้ไขข้อมูล &nbsp <i class='fa fa-edit (alias)'></i></button></a>
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
                    <li role="tab1" class="active" style="width: auto;">
                        <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">ข้อมูล</a>
                    </li>
                    <!--                    <li role="tab2">-->
                    <!--                        <a href="#tab3" aria-controls="tab2" role="tab" data-toggle="tab">Timeline</a>-->
                    <!--                    </li>-->
                    <!--                    <li role="tab3">-->
                    <!--                        <a href="#tab4" aria-controls="tab3" role="tab" data-toggle="tab">Setting</a>-->
                    <!--                    </li>-->
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
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>บริษัท</strong></p></div>
                                        <div class="col-md-7"><?php echo $valCompany['company_name']==''?"-":$valCompany['company_name']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>ที่อยู่</strong></p></div>
                                        <div class="col-md-7"><?php echo $valCompany['company_address']==''?"-":$valCompany['company_address']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--                <div role="tabpanel" class="tab-pane" id="tab2">-->
                <!--                   </div>-->
                <!--                <div role="tabpanel" class="tab-pane" id="tab3">-->
                <!--                    </div>-->
            </div>
        </div>
    </div>
</div>
