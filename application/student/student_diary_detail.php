<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/13/2017 AD
 * Time: 14:50
 */

$classStudent = new Student();

$valStudent = $classStudent->GetDetailStudent($_COOKIE['memberID'],$_GET['studentID']);
$valDiary = $classStudent->GetDetailDiary($_GET['diaryID']);
$valDegree = $classStudent->GetStatusDetailStudent($valStudent['student_degree']);
$valGroup = $classStudent->GetStatusDetailStudent($valStudent['student_group']);
$valDepartment = $classStudent->GetStatusDetailStudent($valStudent['student_department']);

if ($valDiary['diary_status'] == 'errand'){$leave =  "ลากิจ";}if ($valDiary['diary_status'] == 'sick'){$leave = "ลาป่วย";}if ($valDiary['diary_status'] == 'absent'){$leave = "ขาด";}
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
                                    <?php echo $valStudent['student_firstname']==''?"ชื่อ":$valStudent['student_firstname'];
                                    echo " ";
                                    echo $valStudent['student_lastname']==''?"นามสกุล":$valStudent['student_lastname']; ?></span></div>
                            <div class="description">
                                <?php echo $valStudent['student_code'];
                                echo " / ";
                                echo $valStudent['student_group']==''?"-":$valDepartment['status_text'];
                                echo " กลุ่ม ";
                                echo $valStudent['student_group']==''?"-":$valGroup['status_text'];
                                echo "<br>";
                                echo $valStudent['student_degree']==''?"-":$valDegree['status_text'];
                                echo " ปี ";
                                echo $valStudent['student_year']==''?"-":$valStudent['student_year']; ?></div>
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
            <div class="card-body ">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="section">
                            <?php if ($valDiary['diary_status'] == 'diary'){ ?>
                            <div class="section-title">บันทึกการปฏิบัติงานประจำวัน</div>
                            <div class="section-body">
                                <div class="row">
                                    <div class="col-md-1"><p><strong>วันที่</strong></p></div>
                                    <div class="col-md-8"><?php echo DBThaiLongDate($valDiary['diary_date']); ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"><p><strong>เวลา</strong></p></div>
                                    <div class="col-md-2"><?php echo TimeThai($valDiary['diary_time_start']); ?></div>
                                    <div class="col-md-1"><strong>ถึง</strong></div>
                                    <div class="col-md-2"><?php echo TimeThai($valDiary['diary_time_end']); ?></div>
                                    <div class="col-md-2"><strong>จำนวน/ชั่วโมง</strong></div>
                                    <div class="col-md-3"><?php echo diff2LongTime($valDiary['diary_time_end'],$valDiary['diary_time_start']); ?></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3"><p><strong>งานที่ปฏิบัติ</strong></p></div>
                                    <div class="col-md-9" style="word-wrap: break-word;"><?php echo nl2br(str_replace("<br />","",$valDiary['diary_job'])); ?></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3"><p><strong>ปัญหาที่พบ / แนวทางการแก้ไข</strong></p></div>
                                    <div class="col-md-9" style="word-wrap: break-word;"><?php echo nl2br($valDiary['diary_problem']); ?></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3"><p><strong>ความรู้ที่ได้รับจากการปฏิบัติงาน</strong></p></div>
                                    <div class="col-md-9" style="word-wrap: break-word;"><?php echo nl2br($valDiary['diary_knowledge']); ?></div>
                                </div>
                                <br>
                            </div>
                            <div class="section-title">ความเห็นผู้ควบการฝึกประสบการณ์</div>
                            <div class="section-body">
                                <div class="row">
                                    <div class="col-md-12" style="word-wrap: break-word; text-align: justify; text-indent: 30px;">
                                    <?php if ($_COOKIE['memberStatus'] == 'trainer' && $valDiary['diary_comment_trainer'] == ''){ ?>
                                        <form name="frmCommentDiary" action="student/student_to_db.php" method="post">
                                            <textarea class="form-control" name="txtCommentTrainer" value="-" placeholder="คิดคิดเห็นของผู้ควบคุมการฝึกงาน"></textarea>
                                            <input type="hidden" name="diaryID" value="<?php echo $valDiary['diary_id']?>">
                                            <button type="submit" name="updateCommentTrainer" class="btn btn-primary">บันทึกความเห็น</button>
                                            <button type="submit" name="updateCommentTrainer" class="btn btn-default">รับทราบแล้ว</button>
                                        </form>
                                    <?php }else{ ?>
                                    <p><?php echo $valDiary['diary_comment_trainer']==''?"-":nl2br($valDiary['diary_comment_trainer']); ?></p>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="section-title">ความเห็นอาจารย์นิเทศ</div>
                            <div class="section-body">
                                <div class="row">
                                    <div class="col-md-12" style="word-wrap: break-word; text-align: justify; text-indent: 30px;">
                                        <?php if ($_COOKIE['memberStatus'] == 'teacher' && $valDiary['diary_comment_teacher'] == ''){ ?>
                                            <form name="frmCommentDiary" action="student/student_to_db.php" method="post">
                                                <textarea class="form-control" name="txtCommentTeacher" placeholder="คิดคิดเห็นของอาจารย์นิเทศ"></textarea>
                                                <input type="hidden" name="diaryID" value="<?php echo $valDiary['diary_id']?>">
                                                <button type="submit" name="updateCommentTeacher" class="btn btn-primary">บันทึกความเห็น</button>
                                                <button type="submit" name="updateCommentTeacher" class="btn btn-default">รับทราบแล้ว</button>
                                            </form>
                                        <?php }else{ ?>
                                        <p><?php echo $valDiary['diary_comment_teacher']==''?"-":nl2br($valDiary['diary_comment_teacher']); ?></p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } if ($valDiary['diary_status'] == 'errand' || $valDiary['diary_status'] == 'sick' || $valDiary['diary_status'] == 'absent'){ ?>
                            <div class="section-title">บันทึกการ<?php echo $leave;?></div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-md-1"><p><strong>วันที่</strong></p></div>
                                <div class="col-md-8"><?php echo DBThaiLongDate($valDiary['diary_date']); ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><p><strong>สาเหตุการ<?php echo $leave;?></strong></p></div>
                                <div class="col-md-8"><?php echo $valDiary['diary_leave']; ?></div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>