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
}if ($_GET[page] == 'admin_file_list' || $_GET[page] == 'admin_file_add' || $_GET[page] == 'admin_file_edit'){
    $active_admin_file = 'class="active"';
}if ($_GET[page] == 'admin_evaluation_list' || $_GET[page] == 'admin_evaluation_add' || $_GET[page] == 'admin_evaluation_add_question' || $_GET[page] == 'admin_evaluation_edit' || $_GET[page] == 'admin_evaluation_edit_question'){
    $active_admin_evaluation = 'class="active"';
}if ($_GET[page] == 'student_diary_report' || $_GET[page] == 'student_diary_add' || $_GET[page] == 'student_diary_detail' || $_GET[page] == 'student_diary_edit'){
    $active_student_diary = 'class="active"';
}if ($_GET[page] == 'teacher_appointment_report' || $_GET[page] == 'teacher_appointment_add' || $_GET[page] == 'teacher_appointment_edit' || $_GET[page] == 'teacher_appointment_detail') {
    $active_teacher_appointment = 'class="active"';
}if ($_GET[page] == 'company_list' || $_GET[page] == 'company_detail' || $_GET[page]=='admin_company_edit') {
    $active_company = 'class="active"';
}if ($_GET[page] == 'file_list') {
    $active_file = 'class="active"';
}if ($_GET[page] == 'trainer_score_student_list' || $_GET[page] == 'trainer_score_student_save' || $_GET[page] == 'trainer_score_student_report') {
    $active_trainer_score = 'class="active"';
}if ($_GET[page] == 'teacher_score_student_list' || $_GET[page] == 'teacher_score_student_save' || $_GET[page] == 'teacher_score_student_report') {
    $active_teacher_score = 'class="active"';
}if ($_GET[page] == 'trainer_student_list' || $_GET[page] == 'student_profile') {
    $active_trainer_student = 'class="active"';
}if ($_GET[page] == 'teacher_student_list' || $_GET[page] == 'student_profile' || $_GET[page] == 'student_profile_edit' || $_GET[page] == 'teacher_score_student_list' || $_GET[page] == 'teacher_score_student_save' || $_GET[page] == 'teacher_score_student_report' || $_GET[page] == 'teacher_grade_student_save' || $_GET[page] == 'teacher_grade_student_report') {
    $active_teacher_student = 'active';
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <title>ระบบสารสนเทศการนิเทศนักศึกษาฝึกงาน</title>

    <meta name="keyword" content="ระบบสารสนเทศการนิเทศนักศึกษาฝึกประสบการณ์ , ฝึกงาน , ระบบสารสนเทศ , ทวิภาคี , ฝึกประสบการณ์">
    <meta name="DESCRIPTION" content="ระบบจัดการข้อมูลการฝึกประสบการณ์ของนักศึกษาฝึกประสบการณ์ อาจารย์นิเทศ และสถานประกอบการ">
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
                    <li <?php echo $active_admin_evaluation; ?>>
                        <a href="index.php?page=admin_evaluation_list">
                            <div class="icon">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            </div>
                            <div class="title">จัดการแบบประเมิน</div>
                        </a>
                    </li>
                    <li <?php echo $active_admin_file; ?>>
                        <a href="index.php?page=admin_file_list">
                            <div class="icon">
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </div>
                            <div class="title">จัดการไฟล์ดาวน์โหลด</div>
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

                    <li class="dropdown <?php echo $active_teacher_student; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <div class="icon">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <div class="title">นักศึกษาฝึกประสบการณ์</div>
                        </a>
                        <div class="dropdown-menu">
                            <ul>
                                <li class="section"><i class="fa fa-folder-open" aria-hidden="true"></i>ข้อมูล</li>
                                <li><a href="index.php?page=teacher_student_list">ข้อมูลนักศึกษาฝึกประสบการณ์</a></li>
                                <li class="line"></li>
                                <li class="section"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>ประเมิน</li>
                                <li><a href="index.php?page=teacher_score_student_list&result=score">แบบประเมินการฝึกประสบการณ์</a></li>
                                <li><a href="index.php?page=teacher_score_student_list&result=grade">การวัดผลและประเมินผลการฝึกประสบการณ์</a></li>
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
                            <div class="title">นักศึกษาฝึกประสบการณ์</div>
                        </a>
                    </li>

                    <li <?php echo $active_trainer_score; ?>>
                        <a href="index.php?page=trainer_score_student_list">
                            <div class="icon">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </div>
                            <div class="title">ประเมินนักศึกษาฝึกประสบการณ์</div>
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

                    <li <?php echo $active_file; ?>>
                        <a href="index.php?page=file_list">
                            <div class="icon">
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </div>
                            <div class="title">ดาวน์โหลดไฟล์</div>
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