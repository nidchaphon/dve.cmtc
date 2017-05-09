<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 2/27/2017 AD
 * Time: 19:10
 */
?>

<div class="modal fade" id="notification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span id="head"></span> </h4>
            </div>
            <div class="modal-body">
                <span id="messageNoti"></span>
            </div>
            <div class="modal-footer">
                <form action="#" method="post">
                    <input type="hidden" id="id" name="idNoti">
                    <?php if ($_COOKIE['memberStatus'] == "student"){
                        echo '<span id="linkToAbsent"></span>';
                    } ?>
                    <button type="submit" class="btn btn-sm btn-default" data-dismiss="modal" onclick="this.form.submit()">รับทราบแล้ว</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
    $(function(){

        setInterval(function(){
            $.ajax({
                    type: 'GET',
                    url: '../common/ajax/ajax_noti_from_teacher.php',
                    data: { get_param: 'value' },
                    dataType: 'json',
                    success: function (data) {
                if (data==null || data.length == 0){
                    $("#numNotiFromTeacher").html("0");
                    $("#titleNotiFromTeacher").html("<li class='dropdown-header' style='text-align: center'>ไม่มีแจ้งเตือนจากอาจารย์นิเทศ</li>");
                    $("#listNotiFromTeacher").html("<li class='dropdown-header' style='text-align: center'>ไม่มีแจ้งเตือนจากอาจารย์นิเทศ</li>");
                }else {
                    $("#numNotiFromTeacher").html(data.length);
                    $("#titleNotiFromTeacher").html('');
                    $("#listNotiFromTeacher").html('');
                    for(var k=0;k<5;k++) {
//                                $("#messageNotiFromTeacher").append("<li><a href='index.php?page=notification_detail&notificationID="+data[k].idnoti+"'><div class='message'><div class='content'><div class='title'>"+data[k].txtmessage+"</div><div class='description'>"+data[k].txtdate+"</div></div></div></a></li>");
                        $("#titleNotiFromTeacher").append("<li><a data-toggle='modal' data-head='"+data[k].txtheadnoti+"' data-message='"+data[k].txtmessage+"' data-id='"+data[k].idnoti+"' class='open-NotiDialog' href='#notification'><div class='message'><div class='content'><div class='title'>"+data[k].txttitle+"</div><div class='description'>"+data[k].txtdate+"</div></div></div></a></li>");
                        $("#listNotiFromTeacher").append("<a data-toggle='modal' data-head='"+data[k].txtheadnoti+"' data-message='"+data[k].txtmessage+"' data-id='"+data[k].idnoti+"' class='open-NotiDialog' href='#notification'><div class='col-md-6 col-sm-12'><div class='alert alert-info' role='alert'>"+data[k].txttitle+" "+data[k].txtdate+"</div></div></a>");
                    }
//                            if (data.length>5){
//                                $("#showAllTeacher").html("<li class='dropdown-footer'><a href='index.php?page=notification_report&notiType="+data[0].txttype+"'>แสดงทั้งหมด <i class='fa fa-angle-right' aria-hidden='true'></i></a></li>");
//                            }else {
//                                $("#showAllTeacher").html('');
//                            }
                        }
            }
                });

                $.ajax({
                    type: 'GET',
                    url: '../common/ajax/ajax_noti_from_trainer.php',
                    data: { get_param: 'value' },
                    dataType: 'json',
                    success: function (data) {
                if (data==null || data.length == 0){
                    $("#numNotiFromTrainer").html("0");
                    $("#titleNotiFromTrainer").html("<li class='dropdown-header' style='text-align: center'>ไม่มีแจ้งเตือนจากสถานประกอบการ</li>");
                    $("#listNotiFromTrainer").html("<li class='dropdown-header' style='text-align: center'>ไม่มีแจ้งเตือนจากสถานประกอบการ</li>");
                }else {
                    $("#numNotiFromTrainer").html(data.length);
                    $("#titleNotiFromTrainer").html('');
                    $("#listNotiFromTrainer").html('');
                    for(var k=0;k<5;k++) {
                        $("#titleNotiFromTrainer").append("<li><a data-toggle='modal' data-head='"+data[k].txtheadnoti+"' data-message='"+data[k].txtmessage+"' data-id='"+data[k].idnoti+"' data-linkabsent='"+data[k].linkabsent+"' class='open-NotiDialog' href='#notification'><div class='message'><div class='content'><div class='title'>"+data[k].txttitle+"</div><div class='description'>"+data[k].txtdate+"</div></div></div></a></li>");
                        $("#listNotiFromTrainer").append("<a data-toggle='modal' data-head='"+data[k].txtheadnoti+"' data-message='"+data[k].txtmessage+"' data-id='"+data[k].idnoti+"' data-linkabsent='"+data[k].linkabsent+"' class='open-NotiDialog' href='#notification'><div class='col-md-6 col-sm-12'><div class='alert alert-info' role='alert'>"+data[k].txttitle+" "+data[k].txtdate+"</div></div></a>");
                    }
//                            if (data.length>5){
//                                $("#showAllTrainer").html("<li class='dropdown-footer'><a href='index.php?page=notification_report&notiType="+data[0].txttype+"'>แสดงทั้งหมด <i class='fa fa-angle-right' aria-hidden='true'></i></a></li>");
//                            }else {
//                                $("#showAllTrainer").html('');
//                            }
                        }
            }
                });

                $.ajax({
                    type: 'GET',
                    url: '../common/ajax/ajax_noti_from_student.php',
                    data: { get_param: 'value' },
                    dataType: 'json',
                    success: function (data) {
                if (data==null || data.length == 0){
                    $("#numNotiFromStudent").html("0");
                    $("#titleNotiFromStudent").html("<li class='dropdown-header' style='text-align: center'>ไม่มีแจ้งเตือนจากนักศึกษาฝึกงาน</li>");
                    $("#listNotiFromStudent").html("<li class='dropdown-header' style='text-align: center'>ไม่มีแจ้งเตือนจากนักศึกษาฝึกงาน</li>");
                }else {
                    $("#numNotiFromStudent").html(data.length);
                    $("#titleNotiFromStudent").html('');
                    $("#listNotiFromStudent").html('');
                    for(var k=0;k<5;k++) {
                        $("#titleNotiFromStudent").append("<li><a data-toggle='modal' data-head='"+data[k].txtheadnoti+"' data-message='"+data[k].txtmessage+"' data-id='"+data[k].idnoti+"' class='open-NotiDialog' href='#notification'><div class='message'><div class='content'><div class='title'>"+data[k].txttitle+"</div><div class='description'>"+data[k].txtdate+"</div></div></div></a></li>");
                        $("#listNotiFromStudent").append("<a data-toggle='modal' data-head='"+data[k].txtheadnoti+"' data-message='"+data[k].txtmessage+"' data-id='"+data[k].idnoti+"' class='open-NotiDialog' href='#notification'><div class='col-md-6 col-sm-12'><div class='alert alert-info' role='alert'>"+data[k].txttitle+" "+data[k].txtdate+"</div></div></a>");
                    }
//                            if (data.length>5){
//                                $("#showAllStudent").html("<li class='dropdown-footer'><a href='index.php?page=notification_report&notiType="+data[0].txttype+"'>แสดงทั้งหมด <i class='fa fa-angle-right' aria-hidden='true'></i></a></li>");
//                            }else {
//                                $("#showAllStudent").html('');
//                            }
                        }
            }
                });

            },1000);
    });

        $(document).on("click", ".open-NotiDialog", function () {
            var txtHead = $(this).data('head');
            $(".modal-header #head").html( txtHead );
            var txtMessage = $(this).data('message');
            $(".modal-body #messageNoti").html( txtMessage );
            var id = $(this).data('id');
            $("#id").val( id );
            var linkToAbsent = $(this).data('linkabsent');
            $(".modal-footer #linkToAbsent").html( linkToAbsent );
        });

    </script>