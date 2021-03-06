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
                เพิ่มแบบประเมินนักศึกษาฝึกประสบการณ์
            </div>
            <div class="card-body">

                <form name="frmAddEvaluation" class="form form-horizontal" action="admin/admin_update.php?evaluationID=<?php echo $valEvaluation['evaluation_id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <select class="select2" name="type">
                                    <option value="">เลือกแบบประเมิน</option>
                                    <option value="score"<?php if ($valEvaluation['evaluation_type']=='score'){echo "SELECTED";}?>>แบบประเมินนักศึกษาฝึกประสบการณ์</option>
                                    <option value="check"<?php if ($valEvaluation['evaluation_type']=='check'){echo "SELECTED";}?>>แบบประเมินความพึงพอใจ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="section">
                        <div class="section-title">นักศึกษาฝึกประสบการณ์</div>
                        <div class="section-body">
                            <div class="row" align="center">
                                <strong>ระดับชั้น</strong>
                                <table id="degree" width="90%" border="0" cellspacing="5" cellpadding="0">
                                    <?php
                                    foreach ($explodeDegree AS $epDegree){
                                    $textDegree = $classAdmin->GetTextStatusType($epDegree);
                                    ?>
                                    <tr class="firstTr1">
                                        <td align="center">
                                            <p>
                                                <select name="degree[]" id="degree[]" class="degree">
                                                    <option value="">เลือกระดับชั้น</option>
                                                    <?php foreach ($resultDegree AS $valDegree){ ?>
                                                        <option value="<?php echo $valDegree['status_value'];?>" <?php if ($valDegree['status_value'] == $textDegree['status_value']){ echo "SELECTED"; } ?>><?php echo $valDegree['status_text']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </p>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                                <br />
                                <i id="addRowDegree" class="fa fa-plus-square fa-2x" style="color: rgb(12,201,19);"></i>&nbsp;
                                <i id="removeRowDegree" class="fa fa-minus-square fa-2x" style="color: rgb(255,17,24);"></i>
                            </div>
                            <br>
                            <div class="row" align="center">
                                <strong>สาขา</strong>
                                <table id="department" width="90%" border="0" cellspacing="5" cellpadding="0">
                                    <?php
                                    foreach ($explodeDepartment AS $epDepartment){
                                    $textDepartment = $classAdmin->GetTextStatusType($epDepartment);
                                    ?>
                                    <tr class="firstTr2">
                                        <td align="center">
                                            <p>
                                                <select name="department[]" id="department[]" class="department">
                                                    <option value="">เลือกสาขา</option>
                                                    <?php foreach ($resultDepartment AS $valDepartment){ ?>
                                                        <option value="<?php echo $valDepartment['status_value'];?>" <?php if ($valDepartment['status_value'] == $textDepartment['status_value']){ echo "SELECTED"; } ?>><?php echo $valDepartment['status_text']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </p>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                                <br />
                                <i id="addRowDepartment" class="fa fa-plus-square fa-2x" style="color: rgb(12,201,19);"></i>&nbsp;
                                <i id="removeRowDepartment" class="fa fa-minus-square fa-2x" style="color: rgb(255,17,24);"></i>
                            </div>
                            <br>
                            <div class="row" align="center">
                                <strong>รุ่นปี</strong>
                                <table id="year" width="90%" border="0" cellspacing="5" cellpadding="0">
                                    <?php
                                    foreach ($explodeYear AS $epYear){
                                    ?>
                                    <tr class="firstTr3">
                                        <td align="center">
                                            <p>
                                                <select name="year[]" id="year[]" class="year">
                                                    <option value="">เลือกรุ่นปี</option>
                                                    <?php foreach (range (2550, date("Y")+543) as $valYear) { ?>
                                                        <option value="<?php echo $valYear; ?>" <?php if ($epYear == $valYear){ echo "SELECTED"; } ?>><?php echo $valYear; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </p>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                                <br />
                                <i id="addRowYear" class="fa fa-plus-square fa-2x" style="color: rgb(12,201,19);"></i>&nbsp;
                                <i id="removeRowYear" class="fa fa-minus-square fa-2x" style="color: rgb(255,17,24);"></i>
                            </div>
                        </div>
                        <div class="section-title">แบบประเมินสำหรับ</div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-7">
                                    <div class="radio">
                                        <input type="radio" name="assessor" id="assessor1" value="teacher" <?php if ($valEvaluation['evaluation_assessor'] == 'teacher'){ echo "CHECKED"; } ?>>
                                        <label for="assessor1">
                                            อาจารย์นิเทศ
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="assessor" id="assessor2" value="trainer" <?php if ($valEvaluation['evaluation_assessor'] == 'trainer'){ echo "CHECKED"; } ?>>
                                        <label for="assessor2">
                                            ผู้ควบคุมการฝึกประสบการณ์
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" name="updateEvaluation" class="btn btn-primary">บันทึก</button> &nbsp
                                <button type="reset" class="btn btn-default">ยกเลิก</button>
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
                .find("select.degree").attr("value","").end()
                .appendTo($("#degree"));
        });
        $("#removeRowDegree").click(function(){
            // // ส่วนสำหรับการลบ
            if($("#degree tr").size()>1){ // จะลบรายการได้ อย่างน้อย ต้องมี 1 รายการ
                $("#degree tr:last").remove(); // ลบรายการสุดท้าย
            }else{
                // เหลือ 1 รายการลบไม่ได้
                alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
            }
        });

        $("#addRowDepartment").click(function(){
            // ส่วนของการ clone ข้อมูลด้วย jquery clone() ค่า true คือ
            // การกำหนดให้ ไม่ต้องมีการ ดึงข้อมูลจากค่าเดิมมาใช้งาน
            // รีเซ้ตเป็นค่าว่าง ถ้ามีข้อมูลอยู่แล้ว ทั้ง select หรือ input
            $(".firstTr2:eq(0)").clone(true)
                .find("select.department").attr("value","").end()
                .appendTo($("#department"));
        });
        $("#removeRowDepartment").click(function(){
            // // ส่วนสำหรับการลบ
            if($("#department tr").size()>1){ // จะลบรายการได้ อย่างน้อย ต้องมี 1 รายการ
                $("#department tr:last").remove(); // ลบรายการสุดท้าย
            }else{
                // เหลือ 1 รายการลบไม่ได้
                alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
            }
        });

        $("#addRowYear").click(function(){
            // ส่วนของการ clone ข้อมูลด้วย jquery clone() ค่า true คือ
            // การกำหนดให้ ไม่ต้องมีการ ดึงข้อมูลจากค่าเดิมมาใช้งาน
            // รีเซ้ตเป็นค่าว่าง ถ้ามีข้อมูลอยู่แล้ว ทั้ง select หรือ input
            $(".firstTr3:eq(0)").clone(true)
                .find("select.year").attr("value","").end()
                .appendTo($("#year"));
        });
        $("#removeRowYear").click(function(){
            // // ส่วนสำหรับการลบ
            if($("#year tr").size()>1){ // จะลบรายการได้ อย่างน้อย ต้องมี 1 รายการ
                $("#year tr:last").remove(); // ลบรายการสุดท้าย
            }else{
                // เหลือ 1 รายการลบไม่ได้
                alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
            }
        });

    });

</script>