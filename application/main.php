<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/16/2016 AD
 * Time: 00:07
 */

$classStudent = new Student();
$classTrainer = new Trainer();
$classTeacher = new Teacher();

$listChat = $classStudent->GetNumStudentInCompany();

while ($valChat = mysql_fetch_assoc($listChat)){
    $numStudent[] = $valChat['numStudent'];
    if ($valChat['company_name'] == ''){
        $companyName[] = "ยังไม่ได้เลือกสถานประกอบการ";
    }else{
        $companyName[] = $valChat['company_name'];
    }
}
?>

<style>
    #container {
        min-width: 320px;
        max-width: 600px;
        margin: 0 auto;
    }
</style>

<div class="row" style="text-align: center;">
    <div class="col-md-12" style="text-align: center;">
        <div class="alert alert-danger" role="alert">
            <h4><strong><?php echo FullThaiDate(strtotime(date("Y-m-d")));?></strong></h4>
        </div>
    </div>
</div>
<?php if ($_COOKIE['memberStatus'] == 'teacher'){
    $listStudent = $classTeacher->GetListStudent($_COOKIE['memberID'],$_POST['degree'],$_POST['department'],$_POST['year']);
    $listDegree = $classTeacher->GetListDegree();
    $listDepartment = $classTeacher->GetListDepartment();
    $listYear = $classTeacher->GetListSTDYear();
//    $listStudentEnd = $classTeacher->GetListStudent($_COOKIE['memberID']);
    $listAppointment = $classTeacher->GetListAppointment();
    $listStudentGroup = $classTeacher->GetListNumStudentInYear($_COOKIE['memberID']);

    while ($valAppointment = mysql_fetch_assoc($listAppointment)){
        if ($valAppointment['appointment_status'] == '0'){
            $appointment[] = $valAppointment['appointment_id'];
        }
    }
    $numAppointment = count($appointment);

//    while ($valStudentEnd = mysql_fetch_assoc($listStudentEnd)){
//        if ($valStudentEnd['student_training_end'] <= date("Y-m-d") && $valStudentEnd['student_score_teacher'] == ''){
//            $studnet[] = $valStudentEnd['student_id'];
//        }
//    }
//    $numStudentEnd = count($studnet);

    ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a href="index.php?page=teacher_appointment_report" class="card card-banner card-green-light">
                <div class="card-body">
                    <i class="icon fa fa-calendar fa-4x"></i>
                    <div class="content">
                        <div class="title"><h4>มีนัดหมายนิเทศนักศึกษาฝึกประสบการณ์</h4></div>
                        <div class="value"><?php echo $numAppointment." รายการ"; ?></div>
                    </div>
                </div>
            </a><br>

            <?php while ($valStudentGroup = mysql_fetch_assoc($listStudentGroup)){
                $valDegree = $classTeacher->GetDetailStatusType($valStudentGroup['student_degree']);
                $valDepartment = $classTeacher->GetDetailStatusType($valStudentGroup['student_department']);
                ?>
            <a href="index.php?page=teacher_score_student_list&result=score&degree=<?php echo $valStudentGroup['student_degree'];?>&department=<?php echo $valStudentGroup['student_department']; ?>&year=<?php echo $valStudentGroup['yearCode']; ?>" class="card card-banner card-blue-light">
                <div class="card-body">
                    <i class="icon fa fa-pencil-square-o fa-4x"></i>
                    <div class="content">
                        <div class="title">ต้องประเมินนักศึกษา <?php echo $valDegree['status_text']." ".$valDepartment['status_text']." รุ่นปี 25".$valStudentGroup['yearCode']; ?></div>
                        <div class="value"><?php echo $valStudentGroup['totalNotScore']." / ".$valStudentGroup['totalStd']." คน"; ?></div>
                    </div>
                </div>
            </a>
                <br>
            <?php } ?>
        </div>
        <div class="col-md-6">
            <div id="container"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card card-mini">
                <div class="card-header">
                    <div class="card-title">
                        <div class="row">นักศึกษาฝึกประสบการณ์</div>
                        <br>
                        <div class="row">
                            <form name="frmCheangLsit" action="" method="post">
                                <div class="col-md-4">
                                    <select class="select2" name="degree" onchange="this.form.submit()">
                                        <option value="">ระดับชั้นทั้งหมด</option>
                                        <?php while ($valDegree = mysql_fetch_assoc($listDegree)){ ?>
                                            <option value="<?php echo $valDegree['status_value'];?>" <?php if ($valDegree['status_value'] == $_POST['degree']){echo "SELECTED";}?>><?php echo $valDegree['status_text']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="select2" name="department" onchange="this.form.submit()">
                                        <option value="">สาขาทั้งหมด</option>
                                        <?php while ($valDepartment = mysql_fetch_assoc($listDepartment)){ ?>
                                            <option value="<?php echo $valDepartment['status_value'];?>" <?php if ($valDepartment['status_value'] == $_POST['department']){echo "SELECTED";}?>><?php echo $valDepartment['status_text']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="select2" name="year" onchange="this.form.submit()">
                                        <option value="">รุ่นปีทั้งหมด</option>
                                        <?php while ($valYear = mysql_fetch_assoc($listYear)){ ?>
                                            <option value="<?php echo $valYear['stdYear'];?>" <?php if ($valYear['stdYear'] == $_POST['year']){echo "SELECTED";}?>><?php echo "รุ่นปี 25".$valYear['stdYear']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </form>
                        </div>

                    </div>
                    <ul class="card-action">
                        <li>
                            <a href="index.php">
                                <i class="fa fa-refresh"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body no-padding table-responsive">
                    <table class="table card-table table-hover table-striped">
                        <thead>
                        <tr>
                            <th width="5%" style="text-align: center;">รหัสนักศึกษา</th>
                            <th width="25%" style="text-align: center;">ชื่อ</th>
                            <th width="15%" style="text-align: center;">ระดับ</th>
                            <th width="15%" style="text-align: center;">สาขา</th>
                            <th width="20%" style="text-align: center;">สถานประกอบการ</th>
                            <th width="20%" style="text-align: center;">วันนี้</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=0;
                        while ($valStudent = mysql_fetch_assoc($listStudent)){ $i = $i+1;
                            $valDegree = $classStudent->GetStatusDetailStudent($valStudent['student_degree']);
                            $valDepartment = $classStudent->GetStatusDetailStudent($valStudent['student_department']);
                            ?>
                            <tr>
                                <td><?php echo $valStudent['student_code']; ?></td>
                                <td><?php if ($valStudent['student_sex']=='male'){echo "นาย";}if ($valStudent['student_sex']=='female'){echo "นางสาว";} echo $valStudent['studentName']; ?></td>
                                <td><?php echo $valDegree['status_text']; ?></td>
                                <td><?php echo $valDepartment['status_text']; ?></td>
                                <td><?php echo $valStudent['company_name']; ?></td>
                                <td style="text-align: center;"><?php
                                    if ($valStudent['diary_status'] == 'diary'){
                                        echo '<a href="index.php?page=student_diary_detail&diaryID='.$valStudent['diary_id'].'&studentID='.$valStudent['student_id'].'" ><span class="badge badge-success badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>ฝึกประสบการณ์</span></span></a><br>'.timeThai($valStudent['diary_time_start'])." - ".timeThai($valStudent['diary_time_end']);
                                    }elseif ($valStudent['diary_status'] == 'errand'){
                                        echo '<a href="index.php?page=student_diary_detail&diaryID='.$valStudent['diary_id'].'&studentID='.$valStudent['student_id'].'" ><span class="badge badge-info badge-icon"><i class="fa fa-credit-card" aria-hidden="true"></i><span>ลากิจ</span></span></a>';
                                    }elseif ($valStudent['diary_status'] == 'sick'){
                                        echo "ลาป่วย";
                                    }elseif ($valStudent['diary_status'] == 'absent'){
                                        echo '<a href="index.php?page=student_diary_detail&diaryID='.$valStudent['diary_id'].'&studentID='.$valStudent['student_id'].'" > <span class="badge badge-danger badge-icon"><i class="fa fa-times" aria-hidden="true"></i><span>ขาด</span></span></a>';
                                    }
                                    else {
                                        echo '';
//                                        echo '<span class="badge badge-warning badge-icon"><i class="fa fa-clock-o" aria-hidden="true"></i><span>ไม่ได้ฝึกงาน</span></span>';
//                                        echo " <br> <a href='trainer/trainer_to_db.php?action=addDiaryStudent&studentID=".$valStudent['student_id']."&memberID=".$valStudent['member_id']."'><button class='btn btn-default btn-xs'>เช็คขาด</button></a> ";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php }   ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<?php if ($_COOKIE['memberStatus'] == 'trainer'){
    $listStudent = $classTrainer->GetListStudent($_COOKIE['memberID']);
    $listStudentEnd = $classTrainer->GetListStudent($_COOKIE['memberID']);

    while ($valStudentEnd = mysql_fetch_assoc($listStudentEnd)){
        if ($valStudentEnd['student_training_end'] <= date("Y-m-d") && $valStudentEnd['student_score_trainer'] == ''){
            $studnet[] = $valStudentEnd['student_id'];
        }
    }
    $numStudentEnd = count($studnet);

    ?>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a href="index.php?page=trainer_score_student_list&result=score" class="card card-banner card-blue-light">
                <div class="card-body">
                    <i class="icon fa fa-pencil-square-o fa-4x"></i>
                    <div class="content">
                        <div class="title"><h4>นักศึกษาที่ต้องประเมินการฝึกประสบการณ์</h4></div>
                        <div class="value"><?php echo $numStudentEnd==''?"0":$numStudentEnd." คน"; ?></div>
                    </div>
                </div>
            </a>
        </div>
<!--        <div class="col-md-6">-->
<!--            <div id="container"></div>-->
<!--        </div>-->
    </div>
<div class="row">
    <div class="col-xs-12">
        <div class="card card-mini">
            <div class="card-header">
                <div class="card-title">นักศึกษาฝึกประสบการณ์</div>
                <ul class="card-action">
                    <li>
                        <a href="index.php">
                            <i class="fa fa-refresh"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body no-padding table-responsive">
                <table class="table card-table">
                    <thead>
                    <tr>
                        <th style="text-align: center;">รหัสนักศึกษา</th>
                        <th style="text-align: center;">ชื่อ</th>
                        <th style="text-align: center;">ระดับ</th>
                        <th style="text-align: center;">สาขา</th>
                        <th style="text-align: center;">วันนี้</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=0;
                    while ($valStudent = mysql_fetch_assoc($listStudent)){ $i = $i+1;
                    $valDegree = $classStudent->GetStatusDetailStudent($valStudent['student_degree']);
                    $valDepartment = $classStudent->GetStatusDetailStudent($valStudent['student_department']);
                    ?>
                    <tr>
                        <td><?php echo $valStudent['student_code']; ?></td>
                        <td><?php if ($valStudent['student_sex']=='male'){echo "นาย";}if ($valStudent['student_sex']=='female'){echo "นางสาว";} echo $valStudent['studentName']; ?></td>
                        <td><?php echo $valDegree['status_text']; ?></td>
                        <td><?php echo $valDepartment['status_text']; ?></td>
                        <td style="text-align: center;"><?php
                            if ($valStudent['diary_status'] == 'diary'){
                                echo '<a href="index.php?page=student_diary_detail&diaryID='.$valStudent['diary_id'].'&studentID='.$valStudent['student_id'].'"> <span class="badge badge-success badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>มาฝึกงาน</span></span></a>';
                            }elseif ($valStudent['diary_status'] == 'errand'){
                                echo '<span class="badge badge-info badge-icon"><i class="fa fa-credit-card" aria-hidden="true"></i><span>ลากิจ</span></span>';
                            }elseif ($valStudent['diary_status'] == 'sick'){
                                echo "ลาป่วย";
                            }elseif ($valStudent['diary_status'] == 'absent'){
                                echo '<span class="badge badge-danger badge-icon"><i class="fa fa-times" aria-hidden="true"></i><span>ขาด</span></span>';
                            }
                            else {
                                echo '<span class="badge badge-warning badge-icon"><i class="fa fa-clock-o" aria-hidden="true"></i><span>ไม่มาฝึกงาน</span></span>';
                                echo " <br> <a href='trainer/trainer_to_db.php?action=addDiaryStudent&studentID=".$valStudent['student_id']."&memberID=".$valStudent['member_id']."'><button class='btn btn-default btn-xs'>เช็คขาด</button></a> ";
                            }
                            ?>
                            </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php } ?>

<?php if ($_COOKIE['memberStatus'] == 'student'){
    $valStudent = $classStudent->GetDetailStudent($_COOKIE['memberID'],$studentID);
    $maxDateDiary = $classStudent->GetMaxDateDiary($valStudent['student_id']);
    $valDiary = $classStudent->GetDetailDiaryInMain($valStudent['student_id']);

    ?>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php if ($valDiary['diary_status'] == "absent" || $valDiary['diary_status'] == "errand" || $valDiary['diary_status'] == "sick" && $valDiary['diary_status'] != "diary"){?>
                <a class="card card-banner card-green-light" href="index.php?page=student_diary_edit&diaryID=<?php echo $valDiary['diary_id'];?>">
                    <div class="card-body">
                        <i class="icon fa fa-calendar-check-o fa-4x"></i>
                        <div class="content">
                            <div class="title"><h3>วันนี้นักศึกษาฝึกประสบการณ์</h3></div>
                            <div class="value"><?php if ($valDiary['diary_status'] == "absent"){echo "ขาด";}if ($valDiary['diary_status'] == "errand"){echo "ลากิจ";}if ($valDiary['diary_status'] == "sick"){echo "ลาป่วย";} ?></div>
                        </div>
                    </div>
                </a>
            <?php } ?>
            <?php if ($maxDateDiary['maxDate'] != date("Y-m-d") && $valDiary['diary_time_start']=='' && $valDiary['diary_time_end']==''){ ?>
                <a class="card card-banner card-green-light" href="student/student_to_db.php?addTimeDiary=checkin&studentID=<?php echo $valStudent['student_id'];?>">
                    <div class="card-body">
                        <i class="icon fa fa-calendar-check-o fa-4x"></i>
                        <div class="content">
                            <div class="title"><h3>ลงเวลาเข้างาน</h3></div>
                            <div class="value"><div id="css_time_run"><?=date("H:i:s")?></div></div>
                        </div>
                    </div>
                </a>
            <?php } ?>
            <?php if ($maxDateDiary['maxDate'] == date("Y-m-d") && $valDiary['diary_time_start']!='' && $valDiary['diary_time_end']==''){ ?>
                <a class="card card-banner card-blue-light" href="index.php?page=student_diary_edit&diaryID=<?php echo $valDiary['diary_id'];?>">
                    <div class="card-body">
                        <i class="icon fa fa-calendar-check-o fa-4x"></i>
                        <div class="content">
                            <div class="title"><h3>เวลาเข้างาน</h3></div>
                            <div class="value"><?php echo TimeThai($valDiary['diary_time_start']); ?></div>
                        </div>
                    </div>
                </a>
                <br>
                <a class="card card-banner card-green-light" href="student/student_to_db.php?addTimeDiary=checkout&studentID=<?php echo $valStudent['student_id'];?>&diaryID=<?php echo $valDiary['diary_id']; ?>">
                    <div class="card-body">
                        <i class="icon fa fa-calendar-check-o fa-4x"></i>
                        <div class="content">
                            <div class="title"><h3>ลงเวลาออกงาน</h3></div>
                            <div class="value"><div id="css_time_run"><?=date("H:i:s")?></div></div>
                        </div>
                    </div>
                </a>
            <?php } ?>
            <?php if ($maxDateDiary['maxDate'] == date("Y-m-d") && $valDiary['diary_time_start']!='' && $valDiary['diary_time_end']!='' && $valDiary['diary_status'] == "diary"){ ?>
                <a class="card card-banner card-blue-light" href="index.php?page=student_diary_edit&diaryID=<?php echo $valDiary['diary_id'];?>">
                    <div class="card-body">
                        <i class="icon fa fa-calendar-check-o fa-4x"></i>
                        <div class="content">
                            <div class="title"><h3>เวลาเข้างาน</h3></div>
                            <div class="value"><h1><?php echo TimeThai($valDiary['diary_time_start'])." - ".TimeThai($valDiary['diary_time_end']); ?></h1></div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
        <div class="col-md-6">
            <div id="container"></div>
        </div>
    </div>

<?php } ?>

<?php if ($_COOKIE['memberStatus'] == 'admin'){ ?>
    <div class="row">
        <div class="col-md-12">
            <div id="container"></div>
        </div>
    </div>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
    $(function(){
        var nowDateTime=new Date("<?=date("m/d/Y H:i:s")?>");
        var d=nowDateTime.getTime();
        var mkHour,mkMinute,mkSecond;
        setInterval(function(){
            d=parseInt(d)+1000;
            var nowDateTime=new Date(d);
            mkHour=new String(nowDateTime.getHours());
            if(mkHour.length==1){
                mkHour="0"+mkHour;
            }
            mkMinute=new String(nowDateTime.getMinutes());
            if(mkMinute.length==1){
                mkMinute="0"+mkMinute;
            }
            mkSecond=new String(nowDateTime.getSeconds());
            if(mkSecond.length==1){
                mkSecond="0"+mkSecond;
            }
            var runDateTime=mkHour+":"+mkMinute+":"+mkSecond;
            $("#css_time_run").html(runDateTime);
        },1000);
    });

    var chart = Highcharts.chart('container', {

        title: {
            text: '<?php if ($_COOKIE['memberStatus'] == 'student'){ echo "สถิติการเลือกสถานประกอบการของนักศึกษาฝึกประสบการณ์"; } else { echo "จำนวนนักศึกษาในสถานประกอบการ"; } ?>'
        },

        subtitle: {
            text: ''
        },

//        chart: {
//            inverted: true,
//            polar: false
//        },


        xAxis: {
            categories: ['<?php echo $companyName[0]; ?>', '<?php echo $companyName[1]; ?>', '<?php echo $companyName[2]; ?>', '<?php echo $companyName[3]; ?>', '<?php echo $companyName[4]; ?>', '<?php echo $companyName[5]; ?>', '<?php echo $companyName[6]; ?>', '<?php echo $companyName[7]; ?>', '<?php echo $companyName[8]; ?>', '<?php echo $companyName[9]; ?>']
        },

        yAxis: {
            min: 0,
            title: {
                text: 'จำนวนนักศึกษา'
            }
        },

        series: [{
            name: 'จำนวน',
            type: 'column',
            colorByPoint: true,
            data: [<?php echo $numStudent[0]; ?>, <?php echo $numStudent[1]; ?>, <?php echo $numStudent[2]; ?>, <?php echo $numStudent[3]; ?>, <?php echo $numStudent[4]; ?>, <?php echo $numStudent[5]; ?>, <?php echo $numStudent[6]; ?>, <?php echo $numStudent[7]; ?>, <?php echo $numStudent[8]; ?>, <?php echo $numStudent[9]; ?>],
            showInLegend: false
        }]

    });

</script>