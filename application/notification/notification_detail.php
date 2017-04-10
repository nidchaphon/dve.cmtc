<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 2/24/2017 AD
 * Time: 23:16
 */

$classNotification = new Notification();
$valNotification = $classNotification->GetDetailNotification($_GET['notificationID']);

if ($_COOKIE['memberStatus'] == 'teacher' || $_COOKIE['memberStatus'] == 'teacher2'){
    if ($valNotification['notification_type'] == "diary"){
        mysql_query("UPDATE diary SET diary_comment_teacher = '1' WHERE diary_id = {$valNotification['notification_type_id']}");
    }
}if ($_COOKIE['memberStatus'] == 'trainer'){
    if ($valNotification['notification_type'] == "appointment"){
        mysql_query("UPDATE appointment SET appointment_trainer_status = '1' WHERE appointment_id = {$valNotification['notification_type_id']}");
    }
}if ($_COOKIE['memberStatus'] == 'student'){
    if ($valNotification['notification_type'] == "appointment"){
        mysql_query("UPDATE appointment SET appointment_student_status = '1' WHERE appointment_id = {$valNotification['notification_type_id']}");
    }
}

mysql_query("UPDATE notification SET notification_isread = 'yes' WHERE notification_id = '{$valNotification['notification_id']}' AND member_id = '{$_COOKIE['memberID']}'");

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">แจ้งเตือน<?php if ($valNotification['notification_type'] == 'appointment'){echo "การนัดหมายการนิเทศ";}?></div>
            </div>
            <div class="card-body">
                <p style="text-indent: 30px;"><?php echo $valNotification['notification_message'];?></p>
                <div class="row">
                    <div class="col-md-12" style="text-align: center">
                        <?php if ($valNotification['notification_type'] == 'diary' && $_COOKIE['memberStatus'] == 'student'){
                            echo '<a href="index.php?page=student_diary_edit&diaryID='.$valNotification['notification_type_id'].'"><button class="btn btn-primary">แจ้งสาเหตุการขาด</button></a>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="index.php?page=notification_detail" data-target="notificaton">dddd</a>
<div class="col-sm-12">
    <div class="modal fade" id="notificaton" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">แจ้งเตือน<?php if ($valNotification['notification_type'] == 'appointment'){echo "การนัดหมายการนิเทศ";}if ($valNotification['notification_type'] == 'absent'){echo "การขาดฝึกงานของนักศึกษาฝึกงาน";}if ($valNotification['notification_type'] == 'leave'){echo "การลาของนักศึกษาฝึกงาน";}?></h4>
                </div>
                <div class="modal-body">
                    <p style="text-indent: 30px;"><?php echo $_GET['d'];echo $valNotification['notification_message'];?></p>
                </div>
                <div class="modal-footer">
                    <?php if ($valNotification['notification_type'] == 'absent' && $_COOKIE['memberStatus'] == 'student'){
                        echo '<a href="index.php?page=student_diary_edit&diaryID='.$valNotification['notification_type_id'].'"><button class="btn btn-sm btn-primary">แจ้งสาเหตุการขาด</button></a>';
                    } ?>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!--<a href="" data-toggle="modal" data-target="#myModal" data-id="--><?php //echo $valNotification['notification_message'];?><!--" data-id2="2" class="test"> Click </a>-->
<!--<!-- Modal -->-->
<!--<div id="myModal" class="modal fade" role="dialog">-->
<!--    <div class="modal-dialog">-->
<!---->
<!--        <!-- Modal content-->-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!--                <h4 class="modal-title">Modal Header --><?php //echo $_GET['modal_billing_id'];?><!--</h4>-->
<!--            </div>-->
<!--            <form action="" method="post" name="fmBillingPrint" id="fmBillingPrint">-->
<!--                <div class="modal-body">-->
<!--                    <p id="id"></p>-->
<!--<!--                    <p>-->-->
<!--<!--                        <input type="text" name="namesend" id="id" value="" />-->-->
<!--<!--                        <input type="text" name="idsend" id="id2" value="" />-->-->
<!--<!--                    <div id="modalContent"></div>-->-->
<!--<!--                    </p>-->-->
<!--                </div>-->
<!--                <div class="modal-footer">-->
<!--                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--                    <button type="button" class="btn btn-primary">Save changes</button>-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
<!---->
<!--    </div>-->
<!--</div>-->
<!---->
<!---->
<!--<script type="text/javascript">-->
<!--    $(document).ready(function(){-->
<!--        $(".test").click(function (){-->
<!--            $(".modal-body #id").val( id );-->
<!--//            $("#id").val($(this).data('id'));-->
<!--            $("#id2").val($(this).data('id2'));-->
<!--        });-->
<!--    });-->
<!--</script>-->

<a href="#" data-toggle="modal" data-target="#formEditCustomer" class="edit-customer"
   data-id="<?php echo $c['id']; ?>"
   data-firstname="<?php echo $valNotification['notification_message'];?>"
   data-lastname="<?php echo $c['last_name']; ?>"
   data-email="<?php echo $c['email']; ?>"
   data-country="<?php echo $c['country']; ?>"
   data-ip="<?php echo $c['ip_address']; ?>">
    Edit
</a>

<!-- Modal Zone -->
<div class="modal fade" id="formEditCustomer">
    <div class="modal-dialog">
        <form action="save.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Customer</h4>
                </div>
                <div class="modal-body">
                    <!-- Hidden Zone -->
                    <input type="hidden" name="id" id="id" value="">

                    <p id="firstname"></p>
                    <div class="form-group">
<!--                        <label for="firstname">Firstname</label>-->
                        <input type="text" id="firstname" name="firstname" readonly>
                    </div>

                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" id="lastname" name="lastname">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" id="country" name="country">
                    </div>

                    <div class="form-group">
                        <label for="ip">IP Address</label>
                        <input type="text" id="ip" name="ip">
                    </div>

                </div><!--/.modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                    <input type="submit" class="btn btn-primary" value="Save">
                </div><!--/.modal-footer-->
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    $('.edit-customer').click(function(){
// set value to modal
        $("#id").(id);
        $("#firstname").html(firstname);
        $("#lastname").val(lastname);
        $("#email").val(email);
        $("#country").val(country);
        $("#ip").val(ip);
    });
</script>

<a data-toggle="modal" data-message="<?php echo $valNotification['notification_message'];?>" title="Add this item" class="open-AddBookDialog btn btn-primary" href="#addBookDialog">test</a>
<div class="col-sm-12">
    <div class="modal fade" id="addBookDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">แจ้งเตือน<?php if ($valNotification['notification_type'] == 'appointment'){echo "การนัดหมายการนิเทศ";}if ($valNotification['notification_type'] == 'absent'){echo "การขาดฝึกงานของนักศึกษาฝึกงาน";}if ($valNotification['notification_type'] == 'leave'){echo "การลาของนักศึกษาฝึกงาน";}?></h4>
                </div>
                <div class="modal-body">
                    <span id="messageNoti"></span>
<!--                    <p style="text-indent: 30px;">--><?php //echo $_GET['d'];echo $valNotification['notification_message'];?><!--</p>-->
                </div>
                <div class="modal-footer">
                    <?php if ($valNotification['notification_type'] == 'absent' && $_COOKIE['memberStatus'] == 'student'){
                        echo '<a href="index.php?page=student_diary_edit&diaryID='.$valNotification['notification_type_id'].'"><button class="btn btn-sm btn-primary">แจ้งสาเหตุการขาด</button></a>';
                    } ?>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        $(document).on("click", ".open-AddBookDialog", function () {
            var txtMessage = $(this).data('message');
            $(".modal-body #messageNoti").html( txtMessage );
        });
    </script>