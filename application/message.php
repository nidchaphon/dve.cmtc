<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/16/2017 AD
 * Time: 23:26
 */
session_start();
$classMessage = new Message();
$classStudent = new Student();

$listTeacher = $classMessage->GetListTeacher();
$listTrainerForTeacher = $classMessage->GetListTrainerForTeacher($_COOKIE['memberID']);
$listStudentForTeacher = $classMessage->GetListStudentForTeacher($_COOKIE['memberID']);
$listTeacherForTrainer = $classMessage->GetListTeacherForTrainer($_COOKIE['memberID']);
$listStudentForTrainer = $classMessage->GetListStudentForTrainer($_COOKIE['memberID']);
$listTeacherForStudent = $classMessage->GetListTeacherForStudent($_COOKIE['memberID']);
$listTrainerForStudent = $classMessage->GetListTrainerForStudent($_COOKIE['memberID']);
$listStudentForStudent = $classMessage->GetListStudentForStudent($_COOKIE['memberID']);
$detailCotact = $classMessage ->GetDetailContact($_GET['status'],$_GET['memberID']);

$_SESSION['memberID2'] = $_GET['memberID'];
$user1 = $_COOKIE['memberID'];
$user2 = $_SESSION['memberID2'];

?>

<style type="text/css">
    div#messagesDiv{
        display: block;
        height: 500px;
        overflow: auto;
        width: 100%;
        margin: 0px 0px;
        /*border: 1px solid #CCC;*/
    }
    #place_total{
        color:red;
        font-weight:bold;
    }

    div#contactDiv{
        display: block;
        height: 500px;
        overflow: auto;
        width: 100%;
        margin: 0px 0px;
    }

</style>

<!--<div style="margin:auto;">-->
<!--    <!--// ใช้ แท็ก a กำนหด id สำหรับอ้างอิง และกำหนด data attrubute ชื่อ totalitem-->
<!--    <a data-totalitem="" id="place_total">0</a>-->
<!--</div>-->
<div class="app-messaging-container">
    <div class="app-messaging" id="collapseMessaging">
        <div class="chat-group">
            <div class="heading">พูดคุย/สอบถาม</div>
            <div id="contactDiv">
            <ul class="group full-height">

                <?php if ($_COOKIE['memberStatus'] == 'teacher'){ ?>
                    <li class="section">ผู้ควบคุมการฝึกประสบการณ์</li>
                    <?php while ($valTrainerForTeacher = mysql_fetch_assoc($listTrainerForTeacher)){
                        if ($valTrainerForTeacher['trainer_prefix'] == "mr"){
                            $prefixTrainer = "นาย";
                        }elseif ($valTrainerForTeacher['trainer_prefix'] == "mrs"){
                            $prefixTrainer = "นาง";
                        }elseif ($valTrainerForTeacher['trainer_prefix'] == "miss"){
                            $prefixTrainer = "นางสาว";
                        }else{
                            $prefixTrainer = "";
                        }
                        ?>
                        <li class="message">
                            <a href="index.php?page=message&memberID=<?php echo $valTrainerForTeacher['member_id'];?>&status=trainer">
                                <span class="badge badge-warning pull-right"></span>
                                <div class="message">
                                    <img class="profile" src="../images/member/<?php echo $valTrainerForTeacher['trainer_picture']==''?"profile_men.jpg":$valTrainerForTeacher['trainer_picture'];?>">
                                    <div class="content">
                                        <div class="title"><?php echo $prefixTrainer.$valTrainerForTeacher['trainer_firstname']." ".$valTrainerForTeacher['trainer_lastname'];?></div>
                                        <div class="description"><?php echo $valTrainerForTeacher['company_name']; ?></div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="section">นักศึกษาฝึกประสบการณ์</li>
                    <?php while ($valStudentForTeacher = mysql_fetch_assoc($listStudentForTeacher)){
                        $valdegree = $classStudent->GetStatusDetailStudent($valStudentForTeacher['student_degree']);
                        $valdepartment = $classStudent->GetStatusDetailStudent($valStudentForTeacher['student_department']);
                        if ($valStudentForTeacher['student_sex'] == "male"){
                            $prefixStudent = "นาย";
                        }elseif ($valStudentForTeacher['student_sex'] == "female"){
                            $prefixStudent = "นางสาว";
                        }else{
                            $prefixStudent = "";
                        }
                        ?>
                        <li class="message">
                            <a href="index.php?page=message&memberID=<?php echo $valStudentForTeacher['member_id'];?>&status=student">
                                <span class="badge badge-warning pull-right"></span>
                                <div class="message">
                                    <img class="profile" src="../images/member/<?php echo $valStudentForTeacher['student_picture']==''?"profile_men.jpg":$valStudentForTeacher['student_picture'];?>">
                                    <div class="content">
                                        <div class="title"><?php echo $prefixStudent.$valStudentForTeacher['student_firstname']." ".$valStudentForTeacher['student_lastname'];?></div>
                                        <div class="description"><?php echo $valStudentForTeacher['student_code']." ".$valdegree['status_text']."<br>".$valdepartment['status_text']; ?></div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>


                <?php if ($_COOKIE['memberStatus'] == 'trainer'){ ?>
                    <li class="section">อาจารย์นิเทศ</li>
                    <?php while ($valTeacherForTrainer = mysql_fetch_assoc($listTeacherForTrainer)){
                        ?>
                        <li class="message">
                            <a href="index.php?page=message&memberID=<?php echo $valTeacherForTrainer['member_id'];?>&status=teacher">
                                <span class="badge badge-warning pull-right"></span>
                                <div class="message">
                                    <img class="profile" src="../images/member/<?php echo $valTeacherForTrainer['teacher_picture']==''?"profile_men.jpg":$valTeacherForTrainer['teacher_picture'];?>">
                                    <div class="content">
                                        <div class="title"><?php echo "อ. ".$valTeacherForTrainer['teacher_firstname']." ".$valTeacherForTrainer['teacher_lastname'];?></div>
                                        <div class="description"></div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="section">นักศึกษาฝึกประสบการณ์</li>
                    <?php while ($valStudentForTrainer = mysql_fetch_assoc($listStudentForTrainer)){
                        $valdegree = $classStudent->GetStatusDetailStudent($valStudentForTrainer['student_degree']);
                        $valdepartment = $classStudent->GetStatusDetailStudent($valStudentForTrainer['student_department']);
                        if ($valStudentForTrainer['student_sex'] == "male"){
                            $prefixStudent = "นาย";
                        }elseif ($valStudentForTrainer['student_sex'] == "female"){
                            $prefixStudent = "นางสาว";
                        }else{
                            $prefixStudent = "";
                        }
                        ?>
                        <li class="message">
                            <a href="index.php?page=message&memberID=<?php echo $valStudentForTrainer['member_id'];?>&status=student">
                                <span class="badge badge-warning pull-right"></span>
                                <div class="message">
                                    <img class="profile" src="../images/member/<?php echo $valStudentForTrainer['student_picture']==''?"profile_men.jpg":$valStudentForTrainer['student_picture'];?>">
                                    <div class="content">
                                        <div class="title"><?php echo $prefixStudent.$valStudentForTrainer['student_firstname']." ".$valStudentForTrainer['student_lastname'];?></div>
                                        <div class="description"><?php echo $valStudentForTrainer['student_code']." ".$valdegree['status_text']."<br>".$valdepartment['status_text']; ?></div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>


                <?php if ($_COOKIE['memberStatus'] == 'student'){ ?>
                    <li class="section">อาจารย์นิเทศ</li>
                    <?php while ($valTeacherForStudent = mysql_fetch_assoc($listTeacherForStudent)){
                        ?>
                        <li class="message">
                            <a href="index.php?page=message&memberID=<?php echo $valTeacherForStudent['member_id'];?>&status=teacher">
                                <span class="badge badge-warning pull-right"></span>
                                <div class="message">
                                    <img class="profile" src="../images/member/<?php echo $valTeacherForStudent['teacher_picture']==''?"profile_men.jpg":$valTeacherForStudent['teacher_picture'];?>">
                                    <div class="content">
                                        <div class="title"><?php echo "อ. ".$valTeacherForStudent['teacher_firstname']." ".$valTeacherForStudent['teacher_lastname'];?></div>
                                        <div class="description"></div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="section">ผู้ควบคุมการฝึกประสบการณ์</li>
                    <?php while ($valTrainerForStudent = mysql_fetch_assoc($listTrainerForStudent)){
                        if ($valTrainerForStudent['trainer_prefix'] == "mr"){
                            $prefixTrainer = "นาย";
                        }elseif ($valTrainerForStudent['trainer_prefix'] == "mrs"){
                            $prefixTrainer = "นาง";
                        }elseif ($valTrainerForStudent['trainer_prefix'] == "miss"){
                            $prefixTrainer = "นางสาว";
                        }else{
                            $prefixTrainer = "";
                        }
                        ?>
                        <li class="message">
                            <a href="index.php?page=message&memberID=<?php echo $valTrainerForStudent['member_id'];?>&status=trainer">
                                <span class="badge badge-warning pull-right"></span>
                                <div class="message">
                                    <img class="profile" src="../images/member/<?php echo $valTrainerForStudent['trainer_picture']==''?"profile_men.jpg":$valTrainerForStudent['trainer_picture'];?>">
                                    <div class="content">
                                        <div class="title"><?php echo $prefixTrainer.$valTrainerForStudent['trainer_firstname']." ".$valTrainerForStudent['trainer_lastname'];?></div>
                                        <div class="description"><?php echo $valTrainerForStudent['company_name']; ?></div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="section">เพื่อนร่วมห้องเรียน</li>
                    <?php while ($valStudentForStudent = mysql_fetch_assoc($listStudentForStudent)){
                        $valdegree = $classStudent->GetStatusDetailStudent($valStudentForStudent['student_degree']);
                        $valdepartment = $classStudent->GetStatusDetailStudent($valStudentForStudent['student_department']);
                        if ($valStudentForStudent['student_sex'] == "male"){
                            $prefixStudent = "นาย";
                        }elseif ($valStudentForStudent['student_sex'] == "female"){
                            $prefixStudent = "นางสาว";
                        }else{
                            $prefixStudent = "";
                        }
                        ?>
                        <li class="message">
                            <a href="index.php?page=message&memberID=<?php echo $valStudentForStudent['member_id'];?>&status=student">
                                <span class="badge badge-warning pull-right"></span>
                                <div class="message">
                                    <img class="profile" src="../images/member/<?php echo $valStudentForStudent['student_picture']==''?"profile_men.jpg":$valStudentForStudent['student_picture'];?>">
                                    <div class="content">
                                        <div class="title"><?php echo $prefixStudent.$valStudentForStudent['student_firstname']." ".$valStudentForStudent['student_lastname'];?></div>
                                        <div class="description"><?php echo $valStudentForStudent['student_code']." ".$valdegree['status_text']."<br>".$valdepartment['status_text']; ?></div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>

<!--                <li class="section">readed</li>-->
<!--                <li class="message">-->
<!--                    <a data-toggle="collapse" href="#collapseMessaging" aria-expanded="false" aria-controls="collapseMessaging">-->
<!--                        <div class="message">-->
<!--                            <img class="profile" src="https://placehold.it/100x100">-->
<!--                            <div class="content">-->
<!--                                <div class="title">"Payment Confirmation.."</div>-->
<!--                                <div class="description">Alan Anderson</div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                </li>-->
            </ul>
            </div>
        </div>


        <div class="messaging">
            <div class="heading">
                <div class="title">
<!--                    <a class="btn-back" data-toggle="collapse" href="#collapseMessaging" aria-expanded="false" aria-controls="collapseMessaging">-->
<!--                        <i class="fa fa-angle-left" aria-hidden="true"></i>-->
<!--                    </a>-->
                    <?php if (isset($_GET['memberID'])){echo "กำลังติดต่อกับ ";} echo $detailCotact[$_GET['status'].'_firstname'].' '.$detailCotact[$_GET['status'].'_lastname'];
                    if ($detailCotact['member_loginstatus'] == '1'){
                        echo "<span class='badge badge-success badge-icon'><i class='fa fa-circle' aria-hidden='true'></i><span>ออนไลน์</span></span>";
                    }else if ($detailCotact['member_loginstatus'] == '0'){
                        echo "<span class='badge badge-danger badge-icon'><i class='fa fa-circle' aria-hidden='true'></i><span>ออฟไลน์</span></span>";
                    }else{
                        echo "";
                    }
                    echo "&nbsp;&nbsp;";
                    if ($detailCotact[$_GET['status'].'_facebook'] != ''){
                        echo '<a href="https://www.facebook.com/messages/t/'.$detailCotact[$_GET['status'].'_facebook'].'" target="_blank"><img src="../images_sys/icon_facebook.png" width="30px" height="30px"></a>';
                    }
                    echo "&nbsp;&nbsp;";
                    if ($detailCotact[$_GET['status'].'_line'] != ''){
                        echo '<a href="http://line.me/ti/p/~'.$detailCotact[$_GET['status'].'_line'].'" target="_blank"><img src="../images_sys/icon_line.png" width="30px" height="30px"></a>';
                    }
                    ?>
                </div>
                <div class="action"></div>
            </div>

            <div id="messagesDiv">

<!--                <ul class="chat" >-->
<!--                    <li class="line">-->
<!--                        <div class="title">24 Jun 2016</div>-->
<!--                    </li>-->
<!---->
<!--                    <li>-->
<!--                        <div class="message" style="word-break: break-all;">Lorem ipsum dolor sit Lorem ipsum dolor sit amet, consectetur adipiscing elit,</div>-->
<!--                        <div class="info">-->
<!--                            <div class="datetime">11.45pm</div>-->
<!--                            <div class="status"><i class="fa fa-check" aria-hidden="true"></i> Read</div>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li class="right">-->
<!--                        <div class="message" style="word-break: break-all;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</div>-->
<!--                        <div class="info">-->
<!--                            <div class="datetime">11.46pm</div>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                </ul>-->

            </div>

            <div class="footer">
<!--                <div class="row" style="text-align: right;">-->
<!--                    <label class="btn right-block btn-file">-->
<!--                        <i class="fa fa-file-image-o fa-2x" aria-hidden="true"></i>-->
<!--                        <input type="file" name="img" id="img" style="display: none;">-->
<!--                    </label>-->
<!--                </div>-->

                <div class="message-box">

                    <input name="userID1" type="hidden" id="userID1" value="<?=$user1?>">
                    <input name="userID2" type="hidden" id="userID2" value="<?=$user2?>">
                    <!--  input hidden สำหรับ เก็บ chat_id ล่าสุดที่แสดง-->
                    <input name="h_maxID" type="hidden" id="h_maxID" value="0">

                    <textarea name="msg" id="msg" placeholder="พิมพ์ข้อความ..." class="form-control"></textarea>
                    <button name="sendMsg" id="sendMsg" class="btn btn-default"><i class="fa fa-paper-plane" aria-hidden="true"></i><span>ส่ง</span></button>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">

    var first_load=1; // กำหนดตัวแปรสำหรับโหลดข้อมูลครั้งแรกให้เท่ากับ 1
    var load_chat; // กำหนดตัวแปร สำหรับเป็นฟังก์ชั่นเรียกข้อมูลมาแสดง
    load_chat = function(userID){
        var maxID = $("#h_maxID").val(); // chat_id ล่าสุดที่แสดง
        $.post("../common/ajax/ajax_chat.php",{
            viewData:first_load,
            userID:userID,
            maxID:maxID
        },function(data){
            if(first_load==1){ // ถ้าเป็นการโหลดครั้งแรก ให้ดึงข้อมูลทั้งหมดที่เคยบันทึกมาแสดง
//                $("#messagesDiv").append("<ul class='chat'><li class='line'><div class='title'>"+data[0].data_date+"</div></li></ul>");
                for(var k=0;k<data.length;k++){ // วนลูปแสดงข้อความ chat ที่เคยบันทึกไว้ทั้งหมด
                    if(parseInt(data[0].max_id)>parseInt(maxID)){ // เทียบว่าข้อมูล chat_id .ใหม่กว่าที่แสดงหรือไม่
                        $("#h_maxID").val(data[k].max_id); // เก็บ chat_id เป็น ค่าล่าสุด
                        // แสดงข้อความการ chat มีการประยุกต์ใช้ ตำแหน่งข้อความ เพื่อจัด css class ของข้อความที่แสดง
                        $("#messagesDiv").append("<ul class='chat'><li class='"+data[k].data_align+"'><div class='message' style='word-break: break-all; background: "+data[k].data_color+";'>"+data[k].data_msg+"</div><div class='info'><div class='datetime'>"+data[k].data_date+" "+data[k].data_time+"</div><div class='status'>"+data[k].data_status+"</div></div></li></ul>");
                        $("#messagesDiv")[0].scrollTop = $("#messagesDiv")[0].scrollHeight; // เลือน scroll ไปข้อความล่าสุด
                    }
                };
            }else{ // ถ้าเป็นข้อมูลที่เพิ่งส่งไปล่าสุด
                if(parseInt(data[0].max_id)>parseInt(maxID)){ // เทียบว่าข้อมูล chat_id .ใหม่กว่าที่แสดงหรือไม่
                    $("#h_maxID").val(data[0].max_id); // เก็บ chat_id เป็น ค่าล่าสุด
                    // แสดงข้อความการ chat มีการประยุกต์ใช้ ตำแหน่งข้อความ เพื่อจัด css class ของข้อความที่แสดง
                    $("#messagesDiv").append("<ul class='chat'><li class='"+data[0].data_align+"'><div class='message' style='word-break: break-all; background: "+data[0].data_color+";'>"+data[0].data_msg+"</div><div class='info'><div class='datetime'>"+data[0].data_date+" "+data[0].data_time+"</div><div class='status'>"+data[0].data_status+"</div></div></li></ul>");
                    $("#messagesDiv")[0].scrollTop = $("#messagesDiv")[0].scrollHeight;   // เลือน scroll ไปข้อความล่าสุด
                }
            }
            first_load++;// บวกค่า first_load
        });
    }
        // กำหนดให้ทำงานทกๆ 1.0 วินาทีเพิ่มแสดงข้อมูลคู่สนทนา
    setInterval(function(){
        var userID = $("#userID2").val(); // id user ของผู้รับ
        load_chat(userID); // เรียกใช้งานฟังก์ช่นแสดงข้อความล่าสุด
    },1000);

    $(function(){
        /// เมื่อพิมพ์ข้อความ แล้วกดส่ง
        $("#sendMsg").click(function () { // เมื่อกดปุ่มส่ง
            var user1 = $("#userID1").val(); // เก็บ id user  ผู้ใช้ที่ส่ง
            var user2 = $("#userID2").val(); // เก็บ id user  ผู้ใช้ที่รับ
            var msg = $("#msg").val();  // เก็บค่าข้อความ
            var img = $("#img").val();
            if (user2 == "") {
                alert('กรุณาเลือกคู่สนทนา!');
            }
            $.post("../common/ajax/ajax_chat.php",{
                user1:user1,
                user2:user2,
                msg:msg,
                img:img
            },function(data){
                load_chat(user2);// เรียกใช้งานฟังก์ช่นแสดงข้อความล่าสุด
                $("#msg").val(""); // ล้างค่าช่องข้อความ ให้พร้อมป้อนข้อความใหม่
            });

        });


//        $("#msg").keypress(function (e) { // เมื่อกดที่ ช่องข้อความ
//            if (e.keyCode == 13 ) { // ถ้ากดปุ่ม enter
//                var user1 = $("#userID1").val(); // เก็บ id user  ผู้ใช้ที่ส่ง
//                var user2 = $("#userID2").val(); // เก็บ id user  ผู้ใช้ที่รับ
//                var msg = $("#msg").val();  // เก็บค่าข้อความ
//                if (user2 == "") {
//                    alert('กรุณาเลือกคู่สนทนา!');
//                }
//                $.post("../common/ajax_chat.php",{
//                    user1:user1,
//                    user2:user2,
//                    msg:msg
//                },function(data){
//                    load_chat(user2);// เรียกใช้งานฟังก์ช่นแสดงข้อความล่าสุด
//                    $("#msg").val(""); // ล้างค่าช่องข้อความ ให้พร้อมป้อนข้อความใหม่
//                });
//
//            }
//        });

    });


//    $(function(){
//
//        // ตัวแปรสำหรับเก็บค่าจำนวนล่าสุด
//        var curentTotal = null;
//        var getNewItem = function(){
//            $.post("../common/ajax_notification_chat.php",function(response){
//                // ถ้ามีการส่งข้อมูลกลับมา
//                if(response && response.length){
//                    // เก็บค่าเดิมจาก data attribute ชื่อ totalitem
//                    curentTotal = $("#place_total").data("totalitem");
//                    if(curentTotal==""){ // ครั้งแรกจะเป็นค่าว่าง
//                        // กำหนด data attribute ชื่อ totalitem  ให้มีค่าเท่ากับค่าที่ได้จาก ajax
//                        $("#place_total").data('totalitem',''+response[0].num_total+'');
//                    }else{
//                        // ถ้าค่าที่ส่งกลับมา มากกว่าค่าเดิม
//                        if(response[0].num_total > curentTotal){
//                            alert("มีรายการมาใหม่");
//                            // กำหนด data attribute ชื่อ totalitem  ให้มีค่าเท่ากับค่าที่ได้จาก ajax ค่าใหม่
//                            $("#place_total").data('totalitem',''+response[0].num_total+'');
//                        }
//                    }
//                    // แสดงข้อความเป้จำนวนรายการทั้งหมด
//                    $("#place_total").text(response[0].num_total);
//                }
//            });
//        };
//
//        // เรียกใช้งานฟังก์ชั่นครั้งแรกเมื่อเข้ามาหน้านี้
//        getNewItem();
//
//        // กำหนดทำงานทุกๆ 7000 เท่ากับ 7 วินาที // 1000 = 1 วินาที
//        setInterval(function(){
//            getNewItem();
//        },1000);
//
//    });
</script>