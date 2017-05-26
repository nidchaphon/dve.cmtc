<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 5/22/2017 AD
 * Time: 10:41
 */

$classAdmin = new Admin();
$classStudent = new Student();

$valEvaluation = $classAdmin->GetDetailEvaluation($_GET['evaluationID']);
$listQuestion = $classAdmin->GetListQuestion($_GET['evaluationID']);
$listDegree = $classStudent->GetListStatus('degree');
$listDepartment = $classStudent->GetListStatus('major');

$explodeDegree = explode(',',$valEvaluation['evaluation_std_degree']);
$explodeDepartment = explode(',',$valEvaluation['evaluation_std_department']);
$explodeYear = explode(',',$valEvaluation['evaluation_std_year']);

while ($degree = mysql_fetch_assoc($listDegree)){
    $resultDegree[] = $degree;
}
while ($department = mysql_fetch_assoc($listDepartment)){
    $resultDepartment[] = $department;
}

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <?php
                if ($valEvaluation['evaluation_type']=='score'){
                    echo "แบบประเมินนักศึกษาฝึกประสบการณ์";
                } elseif ($valEvaluation['evaluation_type']=='check'){
                    echo "แบบประเมินความพึงพอใจ";
                }
                if ($valEvaluation['evaluation_assessor'] == 'teacher'){
                    echo "สำหรับ อาจารย์นิเทศ";
                } elseif ($valEvaluation['evaluation_assessor'] == 'trainer'){
                    echo " สำหรับ ผู้ควบคุมการฝึกประสบการณ์";
                }
                ?>

            </div>
            <div class="card-body">
                <div class="section">
                    <div class="section-title">นักศึกษาฝึกประสบการณ์</div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-2"><p><strong>ระดับชั้น</strong></p></div>
                            <div class="col-md-8">
                                <ul>
                                    <?php
                                    foreach ($explodeDegree AS $epDegree) {
                                        $textDegree = $classAdmin->GetTextStatusType($epDegree);
                                        foreach ($resultDegree AS $valDegree){
                                            if ($valDegree['status_value'] == $textDegree['status_value']){
                                                echo "<li>".$valDegree['status_text']."</li>";
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"><p><strong>สาขา</strong></p></div>
                            <div class="col-md-8">
                                <ul>
                                    <?php
                                    foreach ($explodeDepartment AS $epDepartment){
                                        $textDepartment = $classAdmin->GetTextStatusType($epDepartment);
                                        foreach ($resultDepartment AS $valDepartment){
                                            if ($valDepartment['status_value'] == $textDepartment['status_value']){
                                                echo "<li>".$valDepartment['status_text']."</li>";
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"><p><strong>รุ่นปี</strong></p></div>
                            <div class="col-md-8">
                                <ul>
                                    <?php
                                    foreach ($explodeYear AS $epYear){
                                        echo "<li>".$epYear."</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <form name="frmAddEvaluation" class="form form-horizontal" action="admin/admin_insert.php?evaluationID=<?php echo $valEvaluation['evaluation_id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="section">
                        <div class="section-title">แบบประเมิน</div>
                        <div class="section-body">
                            <div class="row" align="center">
                                <table class="table table-hover table-bordered" id="degree" width="90%" border="0" cellspacing="5" cellpadding="0" >
                                    <tr style="background: #e9e9ec;">
                                        <th width="35%" style="text-align: center;">หัวข้อการประเมิน</th>
                                        <th width="45%" style="text-align: center;">รายละเอียดการพิจารณา</th>
                                        <th width="20%" style="text-align: center;">คะแนนเต็ม</th>
                                        <th>จัดการ</th>
                                    </tr>
                                    <?php
                                    $numRowQuestion = mysql_num_rows($listQuestion);
                                    $numTopic = 0;
                                    while ($valQuestion = mysql_fetch_assoc($listQuestion)){
                                        $numTopic = $numTopic+1;
                                        ?>
                                        <tr style="background: #f8f8fb;">
                                            <td><strong><?php echo $numTopic.". ".$valQuestion['question_topic']; ?></strong></td>
                                            <td><?php echo nl2br($valQuestion['question_detail']); ?></td>
                                            <td align="center"><?php if ($valQuestion['question_score'] == '' || $valQuestion['question_score'] == '0'){ echo ""; }else { echo $valQuestion['question_score']; } ?></td>
                                            <td>
                                                <a href="index.php?page=admin_evaluation_edit_question&questionID=<?php echo $valQuestion['question_id']; ?>"><i class='fa fa-edit (alias)' title='แก้ไขข้อมูล'></i></a>  &nbsp
                                                <a href="admin/admin_delete.php?action=delQuestion&questionID=<?php echo $valQuestion['question_id']; ?>&evaluationID=<?php echo $valEvaluation['evaluation_id']; ?>&type=maintopic" onclick="return confirm('ต้องการลบหัวข้อการประเมิน <?php echo $valQuestion['question_topic']; ?> หรือไม่')"><i class='fa fa-trash' title='ลบข้อมูล'></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        $listSubQuestion = $classAdmin->GetListSubQuestion($valQuestion['evaluation_id'],$valQuestion['question_id']);
                                        $numSubTopic = 0;
                                        while ($valSubQuestion = mysql_fetch_assoc($listSubQuestion)){
                                            $numSubTopic = $numSubTopic+1;
                                            ?>
                                            <tr>
                                                <td style="text-align: justify; text-indent: 50px;"><?php echo $numTopic.".".$numSubTopic." ".$valSubQuestion['question_topic']; ?></td>
                                                <td><?php echo nl2br($valSubQuestion['question_detail']); ?></td>
                                                <td align="center"><?php echo $valSubQuestion['question_score']; ?></td>
                                                <td>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } if ($numRowQuestion == '0' || $_GET['action'] == "add"){ ?>
                                    <tr class="firstTr1">
                                        <td>
                                            <input type="text" class="form-control" name="topic[]" id="topic[]">
                                        </td>
                                        <td>
                                            <textarea class="form-control" name="detail[]" id="detail[]"></textarea>
                                        </td>
                                        <td>
                                            <input class="form-control" name="score[]" id="score[]" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';} ">
                                        </td>
                                        <td><input type="hidden" name="type[]" value="maintopic"></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                                <?php if ($numRowQuestion == '0' || $_GET['action'] == "add"){ ?>
                                <i id="addRowDegree" class="fa fa-plus-square fa-2x" style="color: rgb(12,201,19);"></i>&nbsp;
                                <i id="removeRowDegree" class="fa fa-minus-square fa-2x" style="color: rgb(255,17,24);"></i>
                                <br><br>
                                <div class="form-footer">
                                    <div class="form-group">
                                        <div class="col-md-12" style="text-align: center;">
                                            <button type="submit" name="insertQuestion" class="btn btn-primary">บันทึก</button> &nbsp
                                            <a href="index.php?page=admin_evaluation_add_question&evaluationID=<?php echo $valEvaluation['evaluation_id'] ?>"><button type="button" class="btn btn-default">ยกเลิก</button></a>
                                        </div>
                                    </div>
                                </div>
                                <?php } else { ?>
                                    <a href="index.php?page=admin_evaluation_add_question&action=add&evaluationID=<?php echo $valEvaluation['evaluation_id']; ?>"><button type="button" class="btn btn-primary">เพิ่มหัวข้อการประเมิน</button></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){

        $("#addRowDegree").click(function(){
            // ส่วนของการ clone ข้อมูลด้วย jquery clone() ค่า true คือ
            // การกำหนดให้ ไม่ต้องมีการ ดึงข้อมูลจากค่าเดิมมาใช้งาน
            // รีเซ้ตเป็นค่าว่าง ถ้ามีข้อมูลอยู่แล้ว ทั้ง select หรือ input
            $(".firstTr1:eq(0)").clone(true)
                .find("input:text.form-control").attr("value","").end()
                .find("textarea.form-control").attr("value","").end()
                .appendTo($("#degree"));
        });
        $("#removeRowDegree").click(function(){
            // // ส่วนสำหรับการลบ
            if($("#degree tr").size()><?php echo $numRowQuestion+2 ?>){ // จะลบรายการได้ อย่างน้อย ต้องมี 1 รายการ
                $("#degree tr:last").remove(); // ลบรายการสุดท้าย
            }else{
                // เหลือ 1 รายการลบไม่ได้
                alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
            }
        });

    });

</script>