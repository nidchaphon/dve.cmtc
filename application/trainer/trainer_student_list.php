<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/16/2017 AD
 * Time: 17:14
 */

if ($detect->isMobile() || $detect->isTablet()) {
    echo "<script>alert('กรุณาใช้งานอุปกรณ์ของคุณในแนวนอน เพื่อการแสดงผลตารางให้พอดีกับจอภาพ');</script>";
}

$classTrainer = new Trainer();
$classStudent = new Student();

$listStudent = $classTrainer->GetListStudent($_COOKIE['memberID'],$_POST['degree'],$_POST['department']);
$listDegree = $classStudent->GetListStatus('degree');
$listDepartment = $classStudent->GetListStatus('major');

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body app-heading">
                <div class="app-title">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="title">
                                <span class="highlight">ข้อมูลนักศึกษาฝึกประสบการณ์</span>
                            </div>
                        </div>
                        <form name="frmCheangLsit" action="" method="post">
                            <div class="col-md-3">
                                <select class="select2" name="degree" onchange="this.form.submit()">
                                    <option value="">ระดับชั้นทั้งหมด</option>
                                    <?php while ($valDegree = mysql_fetch_assoc($listDegree)){ ?>
                                        <option value="<?php echo $valDegree['status_value'];?>" <?php if ($valDegree['status_value'] == $_POST['degree']){echo "SELECTED";}?>><?php echo $valDegree['status_text']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="select2" name="department" onchange="this.form.submit()">
                                    <option value="">สาขาทั้งหมด</option>
                                    <?php while ($valDepartment = mysql_fetch_assoc($listDepartment)){ ?>
                                        <option value="<?php echo $valDepartment['status_value'];?>" <?php if ($valDepartment['status_value'] == $_POST['department']){echo "SELECTED";}?>><?php echo $valDepartment['status_text']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header"><br><br></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table-responsive table-striped table-bordered table-hover " id="dataTables-example" style="width: 100%; margin: auto;"  cellspacing="0">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="5%" height="50px">ลำดับ</th>
                            <th style="text-align: center" width="30%">ชื่อ - สกุล</th>
                            <th style="text-align: center" width="15%">ระดับชั้น</th>
                            <th style="text-align: center" width="20%">สาขา</th>
<!--                            <th style="text-align: center" width="15%">ฝึกงานวันนี้</th>-->
<!--                            <th style="text-align: center" width="15%">ข้อมูล</th>-->
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
                                <td align="center" height="30px"><?php echo $i; ?></td>
                                <td><a href="index.php?page=student_profile&memberID=<?php echo $valStudent['member_id']; ?>"><?php if ($valStudent['student_sex']=='male'){echo "นาย";}elseif ($valStudent['student_sex']=='female'){echo "นางสาว";} echo $valStudent['studentName']; ?></a></td>
                                <td><?php echo $valDegree['status_text']." ปี ".$valStudent['student_year']; ?></td>
                                <td><?php echo $valDepartment['status_text']; ?></td>
<!--                                <td align="center">--><?php
//                                    if ($valStudent['diary_status'] == 'diary'){
//                                        echo "ฝึกงาน";
//                                    }elseif ($valStudent['diary_status'] == 'errand'){
//                                        echo "ลากิจ";
//                                    }elseif ($valStudent['diary_status'] == 'sick'){
//                                        echo "ลาป่วย";
//                                    }elseif ($valStudent['diary_status'] == 'absent'){
//                                        echo "ขาด";
//                                    }
//                                    else {
//                                        echo "ไม่มาฝึกงาน <br> <a href='trainer/trainer_to_db.php?action=addDiaryStudent&studentID=".$valStudent['student_id']."&memberID=".$valStudent['member_id']."'><button class='btn btn-default btn-xs'>เช็คขาด</button></a> ";
//                                    }
//                                     ?><!--</td>-->
<!--                                <td align="center"><a href="index.php?page=student_profile&memberID=--><?php //echo $valStudent['member_id']; ?><!--"><i class="fa fa-info-circle" title="ข้อมูลนักศึกษา"></i></a>  </td>-->
<!--                                <td style="text-align: center">-->
<!--                                    --><?php //if ($valStudent['score_trainer_1_1'] == '' || $valStudent['score_trainer_1_2'] == '' || $valStudent['score_trainer_1_3'] == '' || $valStudent['score_trainer_2_1'] == '' || $valStudent['score_trainer_2_2'] == '' || $valStudent['score_trainer_3_1'] == '' || $valStudent['score_trainer_rate1'] == '' || $valStudent['score_trainer_rate2'] == '' || $valStudent['score_trainer_rate3'] == ''){
//                                        echo "ยังไม่มีการประเมิน";
//                                        echo '</td><td align="center">
//                                    <a href="index.php?page=trainer_score_student_complete&studentID='.$valStudent['student_id'].'"><i class="fa fa-edit (alias)" title="ประเมินนักศึกษา"></i></a>
//                                </td>';
//                                    }else{
//                                        echo "ประเมินแล้ว";
//                                        echo '</td><td align="center">
//                                    <a href="index.php?page=trainer_score_student_report&studentID='.$valStudent['student_id'].'"><i class="fa fa-book" title="ข้อมูลการประเมินนักศึกษา"></i></a>
//                                </td>';
///                                   } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>