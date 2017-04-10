<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/20/2016 AD
 * Time: 23:50
 */

if ($_GET[page] == ''){
    $active = 'class="active"';
}if ($_GET[page] == '' || $_GET[page] == 'main'){
    $active_main = 'class="active"';
}if ($_GET[page] == 'message'){
    $active_massgae = 'class="active"';
}if ($_GET[page] == 'admin_user_list' || $_GET[page] == 'admin_user_detail' || $_GET[page] == 'admin_user_add' || $_GET[page] == 'admin_user_edit'){
    $active_admin_user = 'class="active"';
}if ($_GET[page] == 'admin_company_list' || $_GET[page] == 'admin_company_add' || $_GET[page] == 'admin_company_edit' || $_GET[page] == 'company_detail'){
    $active_admin_company = 'class="active"';
}if ($_GET[page] == 'student_diary_report' || $_GET[page] == 'student_diary_add' || $_GET[page] == 'student_diary_detail' || $_GET[page] == 'student_diary_edit'){
    $active_student_diary = 'class="active"';
}if ($_GET[page] == 'teacher_appointment_report' || $_GET[page] == 'teacher_appointment_add' || $_GET[page] == 'teacher_appointment_edit' || $_GET[page] == 'teacher_appointment_detail') {
    $active_teacher_appointment = 'class="active"';
}if ($_GET[page] == 'company_list' || $_GET[page] == 'company_detail') {
    $active_company = 'class="active"';
}if ($_GET[page] == 'trainer_score_student_list' || $_GET[page] == 'trainer_score_student_complete' || $_GET[page] == 'trainer_score_student_report') {
    $active_trainer_score = 'class="active"';
}if ($_GET[page] == 'teacher_score_student_list' || $_GET[page] == 'teacher_score_student_complete' || $_GET[page] == 'teacher_score_student_report') {
    $active_teacher_score = 'class="active"';
}if ($_GET[page] == 'trainer_student_list' || $_GET[page] == 'student_profile') {
    $active_trainer_student = 'class="active"';
}if ($_GET[page] == 'teacher_student_list' || $_GET[page] == 'student_profile' || $_GET[page] == 'teacher_score_student_list' || $_GET[page] == 'teacher_score_student_complete' || $_GET[page] == 'teacher_score_student_report' || $_GET[page] == 'teacher_grade_student_complete' || $_GET[page] == 'teacher_grade_student_report') {
    $active_teacher_student = 'active';
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <title>ระบบสารสนเทศการนิเทศนักศึกษาฝึกงาน</title>

    <meta name="keyword" content="ระบบสารสนเทศการนิเทศนักศึกษาฝึกงาน , ฝึกงาน , ระบบสารสนเทศ , ทวิภาคี">
    <meta name="DESCRIPTION" content="ระบบจัดการข้อมูลการฝึกงานของนักศึกษาฝึกงาน อาจารย์นิเทศ และสถานประกอบการ">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link href="../images_sys/icon_iven1.ico" rel="favicon" />
    <link href="../images_sys/icon_iven1.ico" rel="shortcut icon" />
    <link rel=”shortcut icon” href="../images_sys/icon_iven1.ico" />
    <link rel="stylesheet" type="text/css" href="../common/css/vendor.css" />
    <link rel="stylesheet" type="text/css" href="../common/css/style.css" />
    <link rel="stylesheet" href="../common/datepicker/jquery-ui/jquery-ui.css">

</head>
<body>
<div class="app app-default">
    <aside class="app-sidebar" id="sidebar">
        <div class="sidebar-header">
            <a class="sidebar-brand" href="index.php"><img src="../images_sys/logoiven1.png" height="70px">
<!--     <span class="highlight">ระบบสารสนเทศการนิเทศนักศึกษาฝึกงาน</span> On The Job Training Observation Online System-->
            </a>
            <button type="button" class="sidebar-toggle"><i class="fa fa-times"></i></button>
        </div>
        <div class="sidebar-menu">
            <ul class="sidebar-nav">
                <li <?php echo $active_main; ?>>
                    <a href="index.php?page=main">
                        <div class="icon">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                        </div>
                        <div class="title">หน้าหลัก</div>
                    </a>
                </li>
                <?php if (isset($_COOKIE['memberStatus'])) { if ($_COOKIE['memberStatus']=="admin") { ?>
                    <li <?php echo $active_admin_user; ?>>
                        <a href="index.php?page=admin_user_list">
                            <div class="icon">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div>
                            <div class="title">จัดการข้อมูลผู้ใช้</div>
                        </a>
                    </li>
                    <li <?php echo $active_admin_company; ?>>
                        <a href="index.php?page=admin_company_list">
                            <div class="icon">
                                <i class="fa fa-building" aria-hidden="true"></i>
                            </div>
                            <div class="title">จัดการข้อมูลสถานประกอบการ</div>
                        </a>
                    </li>
                <?php } if ($_COOKIE['memberStatus']=='teacher'){ ?>
                    <li <?php echo $active_teacher_appointment; ?>>
                        <a href="index.php?page=teacher_appointment_report">
                            <div class="icon">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </div>
                            <div class="title">นัดหมายการนิเทศ</div>
                        </a>
                    </li>
<!--              <li --><?php //echo $active_teacher_score; ?><!-->
<!--                  <a href="index.php?page=teacher_score_student_list">-->
<!--                      <div class="icon">-->
<!--                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>-->
<!--                      </div>-->
<!--                      <div class="title">ประเมินนักศึกษาฝึกงาน</div>-->
<!--                  </a>-->
<!--              </li>-->
<!--              <li --><?php //echo $active_teacher_student; ?><!-->
<!--                  <a href="index.php?page=teacher_student_list">-->
<!--                      <div class="icon">-->
<!--                          <i class="fa fa-users" aria-hidden="true"></i>-->
<!--                      </div>-->
<!--                      <div class="title">นักศึกษาฝึกงาน</div>-->
<!--                  </a>-->
<!--              </li>-->

                    <li class="dropdown <?php echo $active_teacher_student; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <div class="icon">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <div class="title">นักศึกษาฝึกงาน</div>
                        </a>
                        <div class="dropdown-menu">
                            <ul>
                                <li class="section"><i class="fa fa-folder-open" aria-hidden="true"></i>ข้อมูล</li>
                                <li><a href="index.php?page=teacher_student_list">ข้อมูลนักศึกษาฝึกงาน</a></li>
                                <li class="line"></li>
                                <li class="section"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>ประเมิน</li>
                                <li><a href="index.php?page=teacher_score_student_list&result=score">แบบประเมินการฝึกงาน</a></li>
                                <li><a href="index.php?page=teacher_score_student_list&result=grade">การวัดผลและประเมินผลการฝึกงาน</a></li>
                            </ul>
                        </div>
                    </li>

                    <li <?php echo $active_company; ?>>
                        <a href="index.php?page=company_list">
                            <div class="icon">
                                <i class="fa fa-building" aria-hidden="true"></i>
                            </div>
                            <div class="title">ข้อมูลสถานประกอบการ</div>
                        </a>
                    </li>

                <?php } if ($_COOKIE['memberStatus']=='trainer'){ ?>
                    <li <?php echo $active_trainer_student; ?>>
                        <a href="index.php?page=trainer_student_list">
                            <div class="icon">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <div class="title">นักศึกษาฝึกงาน</div>
                        </a>
                    </li>

                    <li <?php echo $active_trainer_score; ?>>
                        <a href="index.php?page=trainer_score_student_list">
                            <div class="icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                            <div class="title">ประเมินนักศึกษาฝึกงาน</div>
                        </a>
                    </li>

                <?php } if ($_COOKIE['memberStatus']=='student'){ ?>
                    <li <?php echo $active_student_diary; ?>>
                        <a href="index.php?page=student_diary_report">
                            <div class="icon">
                                <i class="fa fa-book" aria-hidden="true"></i>
                            </div>
                            <div class="title">บันทึกประจำวัน</div>
                        </a>
                    </li>

                    <li <?php echo $active_company; ?>>
                        <a href="index.php?page=company_list">
                            <div class="icon">
                                <i class="fa fa-building" aria-hidden="true"></i>
                            </div>
                            <div class="title">ข้อมูลสถานประกอบการ</div>
                        </a>
                    </li>

                <?php } } ?>
                <?php if ($_COOKIE['memberStatus'] != 'admin'){ ?>
                    <li <?php echo $active_massgae; ?>>
                        <a href="index.php?page=message">
                            <div class="icon">
                                <i class="fa fa-comments" aria-hidden="true"></i>
                            </div>
                            <div class="title">ข้อความ</div>
                        </a>
                    </li>
                <?php } ?>

            </ul>
        </div>
<!--  <div class="sidebar-footer">-->
<!--    <ul class="menu">-->
<!--      <li>-->
<!--        <a href="/" class="dropdown-toggle" data-toggle="dropdown">-->
<!--          <i class="fa fa-cogs" aria-hidden="true"></i>-->
<!--        </a>-->
<!--      </li>-->
<!---->
<!--    </ul>-->
<!--  </div>-->
    </aside>

<!--    <script type="text/ng-template" id="sidebar-dropdown.tpl.html">-->
<!--        <div class="dropdown-background">-->
<!--            <div class="bg"></div>-->
<!--        </div>-->
<!--        <div class="dropdown-container">-->
<!--            {{list}}-->
<!--        </div>-->
<!--    </script>-->