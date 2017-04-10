<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 2/25/2017 AD
 * Time: 01:07
 */

$classNotification - new Notification();
$listNotification = $classNotification->GetListNotification($_COOKIE['memberID'],$_GET['notiType']);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <?php
                    if ($_GET['notiFrom'] == 'teacher'){
                        echo "แจ้งเตือนจากอาจารย์นิเทศทั้งหมด";
                    }if ($_GET['notiFrom'] == 'trainer'){
                        echo "แจ้งเตือนจากสถานประกอบการทั้งหมด";
                    }if ($_GET['notiFrom'] == 'leave'){
                        echo "แจ้งเตือนจากนักศึกษาฝึกงานทั้งหมด";
                    }
                    ?>
                </div>
            </div>
            <div class="card-body">
                <?php
                if ($_GET['notiFrom'] == 'teacher'){
                    echo '<div id="listNotiFromTeacher"></div>';
                }if ($_GET['notiFrom'] == 'trainer'){
                    echo '<div id="listNotiFromTrainer"></div>';
                }if ($_GET['notiFrom'] == 'leave'){
                    echo '<div id="listNotiFromStudent"></div>';
                }
                ?>
<!--                <div class="col-md-6 col-sm-12">-->
<!--                    <div class="alert alert-info" role="alert">-->
<!---->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>
    </div>
</div>

<?php include ("../common/ajax/javascript_notification.php")?>