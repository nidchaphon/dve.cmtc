<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 5/22/2017 AD
 * Time: 10:41
 */

$classAdmin = new Admin();

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                เพิ่มแบบประเมินนักศึกษาฝึกประสบการณ์
            </div>
            <div class="card-body">
                <form name="frmSubmitTypeEvaluation" class="form form-horizontal" action="" method="post">
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <select class="select2" name="evaluationType" onchange="this.form.submit()">
                                    <option value="">เลือกแบบประเมิน</option>
                                    <option value="score"<?php if ($_POST['evaluationType']=='score'){echo "SELECTED";}?>>แบบประเมินนักศึกษาฝึกประสบการณ์</option>
                                    <option value="check"<?php if ($_POST['evaluationType']=='check'){echo "SELECTED";}?>>แบบประเมินความพึงพอใจ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>

                <form name="frmAddEvaluation" class="form form-horizontal" action="admin/admin_insert.php?evaluationType=<?php echo $_POST['evaluationType']; ?>" method="post" enctype="multipart/form-data">
                    <div class="section">
                        <?php if ($_POST['evaluationType'] == 'score'){ ?>
                            <div class="section-title">แบบประเมินนักศึกษาฝึกประสบการณ์</div>
                            <div class="section-body">
                                <div class="row" align="center">
                                    <table id="myTbl" width="90%" border="0" cellspacing="5" cellpadding="0">
                                        <tr class="firstTr">
                                            <td width="70%">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">หัวข้อการประเมิน</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="topic[]" class="form-control" placeholder="" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">รายละเอียดการพิจารณา</label>
                                                    <div class="col-md-8">
                                                        <textarea name="detail[]" class="form-control" placeholder="" ></textarea>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="30%">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label" style="width: auto;">&nbsp;&nbsp;&nbsp; คะแนนเต็ม</label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="score[]" class="form-control" placeholder="" />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <br />
                                    <button id="addRow" type="button" class="btn btn-success">เพิ่มรายการ</button>
                                    &nbsp;
                                    <button id="removeRow" type="button" class="btn btn-primary">ลบรายการ</button>
                                    <input name="h_all_id_data" type="hidden" id="h_all_id_data" value="<?=$all_id_data?>" />
                                </div>
                            </div>
                        <?php } if ($_POST['evaluationType'] == 'check'){ ?>
                            <div class="section-title">แบบประเมินความพึงพอใจ</div>
                            <div class="section-body">
                                <div class="row" align="center">
                                    <table id="myTbl" width="90%" border="0" cellspacing="5" cellpadding="0">
                                        <tr class="firstTr">
                                            <td width="70%">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">หัวข้อการประเมิน</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="topic[]" class="form-control" placeholder="" />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <br />
                                    <button id="addRow" type="button" class="btn btn-success">เพิ่มรายการ</button>
                                    &nbsp;
                                    <button id="removeRow" type="button" class="btn btn-primary">ลบรายการ</button>
                                    <input name="h_all_id_data" type="hidden" id="h_all_id_data" value="<?=$all_id_data?>" />
                                </div>
                            </div>
                        <?php } ?>
                        <div class="section-title">แบบประเมินสำหรับ</div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-7">
                                    <div class="radio">
                                        <input type="radio" name="assessor" id="assessor1" value="teacher">
                                        <label for="assessor1">
                                            อาจารย์นิเทศ
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="assessor" id="assessor2" value="trainer">
                                        <label for="assessor2">
                                            ผู้ควบคุมการฝึกประสบบการณ์
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" name="insertEvaluation" class="btn btn-primary">บันทึก</button> &nbsp
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

        $("#addRow").click(function(){
            // ส่วนของการ clone ข้อมูลด้วย jquery clone() ค่า true คือ
            // การกำหนดให้ ไม่ต้องมีการ ดึงข้อมูลจากค่าเดิมมาใช้งาน
            // รีเซ้ตเป็นค่าว่าง ถ้ามีข้อมูลอยู่แล้ว ทั้ง select หรือ input
            $(".firstTr:eq(0)").clone(true)
                .find("input:text.form-control").attr("value","").end()
                .find("textarea.form-control").attr("value","").end()
                .appendTo($("#myTbl"));
        });
        $("#removeRow").click(function(){
            // // ส่วนสำหรับการลบ
            if($("#myTbl tr").size()>1){ // จะลบรายการได้ อย่างน้อย ต้องมี 1 รายการ
                $("#myTbl tr:last").remove(); // ลบรายการสุดท้าย
            }else{
                // เหลือ 1 รายการลบไม่ได้
                alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
            }
        });

    });

</script>