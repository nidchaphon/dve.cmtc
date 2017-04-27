<?php

$classNotification = new Notification();
$classStudent = new Student();
$classTeacher = new Teacher();
$classTrainer = new Trainer();

$valStudent = $classStudent->GetDetailStudent($_COOKIE['memberID'],$studentID);
$valTeacher = $classTeacher->GetDetailTeacher($_COOKIE['memberID'],$teacherID);
$valTrainer = $classTrainer->GetDetailTrainer($_COOKIE['memberID'],$trainerID);
$valNotification = $classNotification->GetDetailNotification($_POST['idNoti']);

$valNumNotiStudent = $classNotification->GetNumNotification($_COOKIE['memberID'],"leave");
$valNumNotiTeacher = $classNotification->GetNumNotification($_COOKIE['memberID'],"appointment");
$valNumNotiTrainer = $classNotification->GetNumNotification($_COOKIE['memberID'],"absent");
$valNumNotiTrainer2 = $classNotification->GetNumNotification($_COOKIE['memberID'],"scoretrainer");


    if ($_COOKIE['memberStatus'] == "admin") {
        $txtStatus = "ผู้ดูแลระบบ";
        $titleProfile = "Admin";
        $linkToProfile = "";
        $imageProfile = "admin.png";
    } elseif ($_COOKIE['memberStatus'] == "teacher") {
        $txtStatus = $valTeacher['teacher_firstname']." ".$valTeacher['teacher_lastname'];
        $linkProfile = "index.php?page=teacher_profile";
        $linkToProfile = "<a href='index.php?page=teacher_profile'>ข้อมูลส่วนตัว</a>";
        $imageProfile = $valTeacher['teacher_picture'];
    } elseif ($_COOKIE['memberStatus'] == "teacher2") {
        $txtStatus = $valTeacher['teacher_firstname']." ".$valTeacher['teacher_lastname'];
        $linkProfile = "index.php?page=teacher_profile";
        $linkToProfile = "<a href='index.php?page=teacher_profile'>ข้อมูลส่วนตัว</a>";
        $imageProfile = $valTeacher['teacher_picture'];
    } elseif ($_COOKIE['memberStatus'] == "student") {
        $txtStatus = $valStudent['student_firstname']." ".$valStudent['student_lastname'];
        $linkProfile = "index.php?page=student_profile";
        $linkToProfile = "<a href='index.php?page=student_profile'>ข้อมูลส่วนตัว</a>";
        $imageProfile = $valStudent['student_picture']==''?"profile_men.jpg":$valStudent['student_picture'];
    } elseif ($_COOKIE['memberStatus'] == "trainer") {
        $txtStatus = $valTrainer['trainer_firstname']." ".$valTrainer['trainer_lastname'];
        $linkProfile = "index.php?page=trainer_profile";
        $linkToProfile = "<a href='index.php?page=trainer_profile'>ข้อมูลส่วนตัว</a>";
        $imageProfile = $valTrainer['trainer_picture'];
    }else {
        $titleProfile = "ข้อมูลส่วนตัว";
    }

    if (isset($_POST['idNoti'])){
        if ($_COOKIE['memberStatus'] == 'teacher' || $_COOKIE['memberStatus'] == 'teacher2'){
            if ($valNotification['notification_type'] == "leave"){
                mysql_query("UPDATE diary SET diary_comment_teacher = '1' WHERE diary_id = {$valNotification['notification_type_id']}");
            }if ($valNotification['notification_type'] == "absent"){
                mysql_query("UPDATE diary SET diary_comment_teacher = '1' WHERE diary_id = {$valNotification['notification_type_id']}");
            }
        }if ($_COOKIE['memberStatus'] == 'trainer'){
            if ($valNotification['notification_type'] == "appointment"){
                mysql_query("UPDATE appointment SET appointment_trainer_status = '1' WHERE appointment_id = {$valNotification['notification_type_id']}");
            }if ($valNotification['notification_type'] == "leave"){
                mysql_query("UPDATE diary SET diary_comment_trainer = '1' WHERE diary_id = {$valNotification['notification_type_id']}");
            }
        }if ($_COOKIE['memberStatus'] == 'student'){
            if ($valNotification['notification_type'] == "appointment"){
                mysql_query("UPDATE appointment SET appointment_student_status = '1' WHERE appointment_id = {$valNotification['notification_type_id']}");
            }
        }
        mysql_query("UPDATE notification SET notification_isread = 'yes' WHERE notification_id = '{$_POST['idNoti']}' AND member_id = '{$_COOKIE['memberID']}'");
    }
?>
<div class="app-container">
    <nav class="navbar navbar-default" id="navbar">
        <div class="container-fluid">
            <div class="navbar-collapse collapse in">
                <ul class="nav navbar-nav navbar-mobile">
                    <li>
                        <button type="button" class="sidebar-toggle">
                            <i class="fa fa-bars"></i>
                        </button>
                    </li>
                    <li class="logo">
                        <a class="navbar-brand" href="#">
<!--                            <img src="../images_sys/logoiven1.png" height="60px">-->
                            <font size="2pt"> ระบบสารสนเทศการนิเทศนักศึกษาฝึกประสบการณ์ <br> On The Job Training Observation Online System</font>
                        </a>
                    </li>
                    <li>
                        <button type="button" class="navbar-toggle">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-left">
                    <li class="navbar-title">ระบบสารสนเทศการนิเทศนักศึกษาฝึกประสบการณ์ <br> On The Job Training Observation Online System</li>
                    <!--        <li class="navbar-search hidden-sm">-->
                    <!--          <input id="search" type="text" placeholder="ค้นหา...">-->
                    <!--          <button class="btn-search"><i class="fa fa-search"></i></button>-->
                    <!--        </li>-->
                </ul>

                <ul class="nav navbar-nav navbar-right">

                    <?php if ($_COOKIE['memberStatus'] == "teacher" || $_COOKIE['memberStatus'] == "student") { ?>
                    <li class="dropdown notification <?php if ($valNumNotiTrainer['numNoti'] != 0 || $valNumNotiTrainer2['numNoti'] != 0){echo "danger";} ?>">
                        <a href="index.php?page=notification_report&notiFrom=trainer" class="dropdown-toggle">
                            <div class="icon"><i class="fa fa-bell" aria-hidden="true"></i></div>
                            <div class="title">แจ้งเตือนจากสถานประกอบการ</div>
                            <div class="count" id="numNotiFromTrainer"></div>
                        </a>
                        <div class="dropdown-menu">
                            <ul>
                                <li class="dropdown-header">แจ้งเตือนจากสถานประกอบการ</li>
                            </ul>
                            <ul id="titleNotiFromTrainer"></ul>
                            <ul id="showAllTrainer"></ul>
                        </div>
                    </li>
                    <?php } if ($_COOKIE['memberStatus'] == "trainer" || $_COOKIE['memberStatus'] == "student") { ?>
                    <li class="dropdown notification <?php if ($valNumNotiTeacher['numNoti'] != 0){echo "danger";} ?>">
                        <a href="index.php?page=notification_report&notiFrom=teacher" class="dropdown-toggle">
                            <div class="icon"><i class="fa fa-bell" aria-hidden="true"></i></div>
                            <div class="title">แจ้งเตือนจากอาจารย์นิเทศ</div>
                            <div class="count" id="numNotiFromTeacher"></div>
                        </a>
                        <div class="dropdown-menu">
                            <ul>
                                <li class="dropdown-header">แจ้งเตือนจากอาจารย์นิเทศ</li>
                            </ul>
                            <ul id="titleNotiFromTeacher"></ul>
                            <ul id="showAllTeacher"></ul>
                        </div>
                    </li>
                    <?php } if ($_COOKIE['memberStatus'] == "teacher" || $_COOKIE['memberStatus'] == "trainer"){ ?>
                    <li class="dropdown notification <?php if ($valNumNotiStudent['numNoti'] != 0){echo "danger";} ?>">
                        <a href="index.php?page=notification_report&notiFrom=student" class="dropdown-toggle">
                            <div class="icon"><i class="fa fa-bell" aria-hidden="true"></i></div>
                            <div class="title">แจ้งเตือนจากนักศึกษาฝึกประสบการณ์</div>
                            <div class="count" id="numNotiFromStudent"></div>
                        </a>
                        <div class="dropdown-menu">
                            <ul>
                                <li class="dropdown-header">แจ้งเตือนจากนักศึกษาฝึกประสบการณ์</li>
                            </ul>
                            <ul id="titleNotiFromStudent"></ul>
                            <ul id="showAllStudent"></ul>
                        </div>
                    </li>
                    <?php } ?>

                    <li class="dropdown profile">
                        <a href="<?php echo $linkProfile; ?>">
                            <img class="profile-img" src="../images/member/<?php echo $imageProfile; ?>">
                            <div class="title"><?php echo $txtStatus; ?></div>
                            <div class="nav navbar-nav navbar-mobile navbar-brand"><a href="usermanager/logout.php" title="ออกจากระบบ"><i class="fa fa-sign-out" style="font-size: 1.7em;"></i></a></div>

                        </a>
                        <div class="dropdown-menu">
                            <div class="profile-info">
                                <h4 class="username">
                                    <?php echo $txtStatus; ?>
                                </h4>
                            </div>
                            <ul class="action">
                                <li>
                                    <?php echo $linkToProfile ?>
                                </li>
                                <li>
                                    <a href="usermanager/logout.php"><i class="fa fa-sign-out"></i>ออกจากระบบ</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php include("../common/javascript_notification.php") ?>