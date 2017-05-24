<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/13/2017 AD
 * Time: 10:05
 */

if ($detect->isMobile() || $detect->isTablet()) {
    echo "<script>alert('กรุณาใช้งานอุปกรณ์ของคุณในแนวนอน เพื่อการแสดงผลตารางให้พอดีกับจอภาพ');</script>";
}

$classStudent = new Student();

$valStudent = $classStudent->GetDetailStudent($_COOKIE['memberID'],$studentID);
$listDiary = $classStudent->GetListDiary($valStudent['student_id']);
$maxDateDiary = $classStudent->GetMaxDateDiary($valStudent['student_id']);

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body app-heading">
                <div class="app-title">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="title">
                                <span class="highlight">บันทึกรายงานประจำวัน</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <?php if ($maxDateDiary['maxDate'] != date("Y-m-d")){ ?>
                            <a href="index.php?page=student_diary_add"><button type="button" class="btn btn-primary">เพิ่มบันทึก  <i class='fa fa-plus'></i></button></a>
                            <?php } ?>
                        </div>
                        <div class="col-md-2" style="width: auto;">
                            <a href="student/student_report_time_pdf.php" target="_blank"><button type="button" class="btn btn-success">บัญชีลงเวลา PDF  <i class='fa fa-file-pdf-o'></i></button></a>
                        </div>
                        <div class="col-md-2" style="width: auto;">
                            <a href="student/student_report_diary_pdf.php" target="_blank"><button type="button" class="btn btn-success">บันทึกการปฏิบัติงาน PDF  <i class='fa fa-file-pdf-o'></i></button></a>
                        </div>
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
                        <th style="text-align: center"; width="1%" height="50px">ลำดับ</th>
                        <th style="text-align: center"; width="14%">วันที่</th>
                        <th style="text-align: center"; width="35%">ช่วงเวลา</th>
                        <th style="text-align: center"; width="20%">จำนวนชั่วโมง</th>
                        <th style="text-align: center"; width="5;">สถานะ</th>
                        <th style="text-align: center"; width="5%">ผู้ควบคุม</th>
                        <th style="text-align: center"; width="5%">อาจารย์นิเทศ</th>
                        <th style="text-align: center"; width="16%">จัดการ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=0;
                    while ($valDiary = mysql_fetch_assoc($listDiary)){ $i = $i+1;
                    if ($valDiary['diary_status'] == 'diary' && $valDiary['diary_job'] == ''){
                        echo "<script>alert('กรุณากรอกรายละเอียดบันทึกรายงานประจำวัน วันที่ ".DBThaiShortDate($valDiary['diary_date'])."');</script>";
                    }if (($valDiary['diary_status'] == 'absent' || $valDiary['diary_status'] == 'errand' || $valDiary['diary_status'] == 'sick') && $valDiary['diary_leave'] == ''){
                        echo "<script>alert('กรุณากรอกรายละเอียดบันทึกรายงานประจำวัน วันที่ ".DBThaiShortDate($valDiary['diary_date'])."');</script>";
                    }
                    ?>
                        <tr>
                            <td align="center" height="30px"><?php echo $i; ?></td>
                            <td align="center"><?php echo DBThaiShortDate($valDiary['diary_date']); ?></td>
                            <td align="center"><?php echo $valDiary['diary_time_start']==''?"-":timeThai($valDiary['diary_time_start']) .' - '.timeThai($valDiary['diary_time_end']); ?></td>
                            <td align="center"><?php echo $valDiary['diary_time_start']==''?"-":diff2ShortTime($valDiary['diary_time_end'],$valDiary['diary_time_start']); ?></td>
                            <td align="center">
                                <?php if ($valDiary['diary_status'] == 'diary'){
                                    echo "ฝึกงาน";
                                }if ($valDiary['diary_status'] == 'sick'){
                                    echo "ลาป่วย";
                                }if ($valDiary['diary_status'] == 'errand'){
                                    echo "ลากิจ";
                                }if ($valDiary['diary_status'] == 'absent'){
                                    echo "ขาด";
                                } ?>
                            </td>
                            <td><?php if ($valDiary['diary_comment_trainer'] == ''){
                                echo "<span class='badge badge-danger badge-icon'><i class='fa fa-times' aria-hidden='true'></i><span>ยังไม่รับทราบ</span></span>";
                            }else{
                                echo "<span class='badge badge-success badge-icon'><i class='fa fa-check' aria-hidden='true'></i><span>รับทราบแล้ว</span></span>";} ?> </td>
                            <td><?php if ($valDiary['diary_comment_teacher'] == ''){
                                    echo "<span class='badge badge-danger badge-icon'><i class='fa fa-times' aria-hidden='true'></i><span>ยังไม่รับทราบ</span></span>";
                            }else{
                                    echo "<span class='badge badge-success badge-icon'><i class='fa fa-check' aria-hidden='true'></i><span>รับทราบแล้ว</span></span>";} ?> </td>
                            <td align="center">
                                <a href="index.php?page=student_diary_detail&diaryID=<?php echo $valDiary['diary_id']; ?>"> <i class='fa fa-book' title='รายละเอียด'></i></a> &nbsp
                                <a href="index.php?page=student_diary_edit&diaryID=<?php echo $valDiary['diary_id']; ?>"><i class='fa fa-edit (alias)' title='แก้ไขข้อมูล'></i></a>  &nbsp
                                <a href="student/student_to_db.php?action=deleteDiary&diaryID=<?php echo $valDiary['diary_id']; ?>" onclick="return confirm('ต้องการลบบันทึกประจำวัน วันที่ <?php echo DBThaiShortDate($valDiary['diary_date']); ?> หรือไม่')"><i class='fa fa-trash' title='ลบข้อมูล'></i></a> </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".tip").tooltip({
            placement : 'top'
        });
    });
</script>