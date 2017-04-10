<?php
//if (!isset($_SESSION)){
//    session_start();
//}
//
//if (isset($_POST)){
//    include "config/dbconnection.php";
//
//    $user = @$_POST['txtUsername'];
//    $pass = @$_POST['txtPassword'];
//
//    $sql = "SELECT * Member
//            WHERE Member_Username='".@$user."'
//            AND Member_Username = '".@$pass."'";
//    $result = mysql_query($sql);
//    $rs = mysql_fetch_array($result);
//
//    if (empty($rs)){
//        echo "Username หรือ Password ไม่ถูกต้อง";
//    } else {
//        $_SESSION['user']=@$rs;
//    }
//}

//echo $_COOKIE['username'];
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <title>ระบบสารสนเทศการนิเทศนักศึกษาฝึกงาน</title>
    <meta name="keyword" content="ระบบสารสนเทศการนิเทศนักศึกษาฝึกงาน , ฝึกงาน , ระบบสารสนเทศ , ทวิภาคี">
    <meta name="DESCRIPTION" content="ระบบจัดการข้อมูลการฝึกงานของนักศึกษาฝึกงาน อาจารย์นิเทศ และสถานประกอบการ">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link href="../../images_sys/icon_iven1.ico" rel="favicon" />
    <link href="../../images_sys/icon_iven1.ico" rel="shortcut icon" />
    <link rel=”shortcut icon” href="../../images_sys/icon_iven1.ico" />
    <link rel="stylesheet" type="text/css" href="../../common/css/vendor.css">
    <link rel="stylesheet" type="text/css" href="../../common/css/style.css">

</head>
<body>
<div class="app app-default">
    <div class="app-container app-login">
        <div class="flex-center">
            <div class="app-header"></div>
            <div class="app-body">
                <div class="app-block">
                    <div class="app-form">
                        <div class="form-header" style="font-size: 20px;">
                            <div class="app-brand">
                                <center>
                                    <img src="../../images_sys/logoiven1.png" width="120px"> <br><br>
                                    <span class="highlight">ระบบสารสนเทศการนิเทศนักศึกษาฝึกงาน</span><br> On The Job Training Observation Online System
                                </center>
                            </div>
                        </div>
                        <form name="Login" action="check_login.php<?php //echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                <input type="text" name="txtUsername" class="form-control" placeholder="ชื่อผู้ใช้" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-key" aria-hidden="true"></i></span>
                                <input type="password" name="txtPassword" class="form-control" placeholder="รหัสผ่าน" aria-describedby="basic-addon2">
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" id="rememberme" name="rememberme">
                                <label for="rememberme">จำข้อมูลการเข้าสู่ระบบ</label>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary btn-submit" value="เข้าสู่ระบบ">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="app-footer"></div>
        </div>
    </div>
</div>
  
<script type="text/javascript" src="../../commom/js/vendor.js"></script>
<script type="text/javascript" src="../../commom/js/app.js"></script>

</body>
</html>