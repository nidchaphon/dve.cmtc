<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 5/22/2017 AD
 * Time: 10:41
 */

$classAdmin = new Admin();
$classStudent = new Student();

$valQuestion = $classAdmin->GetDetailQuestion($_GET['questionID']);
$listQuestion = $classAdmin->GetListSubQuestion($valQuestion['evaluation_id'],$_GET['questionID']);
$sumScoreSubQuestion = $classAdmin->GetListSubQuestion($valQuestion['evaluation_id'],$_GET['questionID']);

$numRowQuestion = mysql_num_rows($listQuestion);

while ($valScore = mysql_fetch_assoc($sumScoreSubQuestion)){
    $totalScore += $valScore['question_score'];
}
if (!$totalScore){
    $totalScore = 0;
}else {
    $totalScore = $totalScore;
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                แก้ไขหัวข้อการประเมิน
            </div>
            <div class="card-body">
                <form name="frmAddEvaluation" class="form form-horizontal" action="admin/admin_update.php?evaluationID=<?php echo $valQuestion['evaluation_id']; ?>&questionID=<?php echo $_GET['questionID']; ?>&type=<?php echo $_GET['type'];?>&mainID=<?php echo $_GET['mainID']; ?>" method="post">
                    <div class="section">
                        <div class="section-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label">หัวข้อการประเมิน</label>
                                <div class="col-md-5">
                                    <input type="text" name="mainTopic" class="form-control" value="<?php echo $valQuestion['question_topic']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">รายละเอียดการพิจารณา</label>
                                <div class="col-md-5">
                                    <textarea name="mainDetail" class="form-control"><?php echo $valQuestion['question_detail']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">คะแนนเต็ม</label>
                                <div class="col-md-2">
                                    <input type="text" name="mainScore" id="total" class="form-control" value="<?php if ($numRowQuestion > 0){ echo $totalScore; }else { echo $valQuestion['question_score']; } ?>" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';} ">
                                </div>
                            </div>
                        </div>
                        <?php if ($valQuestion['question_sub_id'] == "yes" || $_GET['action'] == "add"){ ?>
                            <div class="section-title">แบบประเมินหัวข้อย่อย</div>
                            <div class="section-body">
                                <div class="row" align="center">
                                    <table class="table table-striped table-hover table-bordered" id="degree" width="90%" border="0" cellspacing="5" cellpadding="0" >
                                        <tr>
                                            <th width="35%" style="text-align: center;">หัวข้อการประเมิน</th>
                                            <th width="45%" style="text-align: center;">รายละเอียดการพิจารณา</th>
                                            <th width="20%" style="text-align: center;">คะแนนเต็ม</th>
                                            <th>จัดการ</th>
                                        </tr>
                                        <?php
                                        while ($valQuestion = mysql_fetch_assoc($listQuestion)){ ?>
                                            <tr>
                                                <td><?php echo $valQuestion['question_topic']; ?></td>
                                                <td><?php echo nl2br($valQuestion['question_detail']); ?></td>
                                                <td align="center"><?php echo $valQuestion['question_score']; ?></td>
                                                <td>
                                                    <a href="index.php?page=admin_evaluation_edit_question&questionID=<?php echo $valQuestion['question_id']; ?>&mainID=<?php echo $_GET['questionID']; ?>&type=subtopic"><i class='fa fa-edit (alias)' title='แก้ไขข้อมูล'></i></a>  &nbsp
                                                    <a href="admin/admin_delete.php?action=delQuestion&questionID=<?php echo $valQuestion['question_id']; ?>&mainQuestionID=<?php echo $_GET['questionID']; ?>&type=subtopic&numRowQuestion=<?php echo $numRowQuestion; ?>" onclick="return confirm('ต้องการลบหัวข้อการประเมิน <?php echo $valQuestion['question_topic']; ?> หรือไม่')"><i class='fa fa-trash' title='ลบข้อมูล'></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        } if ($_GET['action'] == "add"){ ?>
                                            <tr class="firstTr1">
                                                <td>
                                                    <input type="text" class="form-control" name="topic[]" id="topic[]">
                                                </td>
                                                <td>
                                                    <textarea class="form-control" name="detail[]" id="detail[]"></textarea>
                                                </td>
                                                <td>
                                                    <input type="text" class="score form-control" name="score[]" id="score[]" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';} ">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="type[]" value="subtopic">
                                                    <input type="hidden" name="subID[]" value="<?php echo $_GET['questionID']; ?>">
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                    <?php if ($_GET['action'] == "add"){ ?>
                                        <i id="addRowDegree" class="fa fa-plus-square fa-2x" style="color: rgb(12,201,19);"></i>&nbsp;
                                        <i id="removeRowDegree" class="fa fa-minus-square fa-2x" style="color: rgb(255,17,24);"></i>
                                        <br><br>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } if ($valQuestion['question_sub_id'] == "" && !isset($_GET['action'])) { ?>
                            <a href="index.php?page=admin_evaluation_edit_question&action=add&questionID=<?php echo $_GET['questionID']; ?>"><button type="button" class="btn btn-success">เพิ่มหัวข้อย่อย</button></a>
                            <br><br>
                        <?php } ?>
                        <div class="form-footer">
                            <div class="form-group">
                                <div class="col-md-12" style="text-align: center;">
                                    <button type="submit" name="updateQuestion" class="btn btn-primary">บันทึก</button> &nbsp
                                    <a href="index.php?page=admin_evaluation_edit_question&questionID=<?php echo $_GET['questionID']; ?>"><button type="button" class="btn btn-default">ยกเลิก</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        $(".score").each(function() {

            $(this).keyup(function(){
                calculateSum();
            });
        });

    });

    function calculateSum() {

        var sum = <?php echo $totalScore; ?>;
        //iterate through each textboxes and add the values
        $(".score").each(function() {

            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }

        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#total").attr("value",sum.toFixed());
    }
</script>

<script>

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
            // ส่วนสำหรับการลบ
            if($("#degree tr").size()> <?php echo $numRowQuestion+2 ?>){ // จะลบรายการได้ อย่างน้อย ต้องมี 1 รายการ
                $("#degree tr:last").remove(); // ลบรายการสุดท้าย
            }else{
            // เหลือ 1 รายการลบไม่ได้
                alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
            }
        });

    });

</script>