<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/18/2016 AD
 * Time: 23:14
 */

$classAdmin = new Admin();
$listUser = $classAdmin->GetListStatusType('member');

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                เพิ่มไฟล์ดาวน์โหลด
            </div>
            <div class="card-body">
                <form name="frmAddFile" class="form form-horizontal" action="admin/admin_insert.php" method="post" enctype="multipart/form-data">
                    <div class="section">
                        <div class="section-title">ไฟล์ดาวน์โหลด</div>
                        <div class="section-body">
                            <div class="row" align="center">
                                <table id="myTbl" width="650" border="0" cellspacing="5" cellpadding="0">
                                    <tr class="firstTr">
                                        <td>
                                            <input type="file" name="file[]" class="browse_file" />
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
                        <div class="section-title">User ที่สามารถดาวน์โหลดไฟล์ได้</div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-7">
                                    <?php while ($valUser = mysql_fetch_assoc($listUser)){ ?>
                                        <div class="checkbox">
                                            <input type="checkbox" id="<?php echo $valUser['status_value'];?>" name="user[]" value="<?php echo $valUser['status_value'];?>">
                                            <label for="<?php echo $valUser['status_value'];?>">
                                                <?php echo $valUser['status_text'];?>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" name="insertFile" class="btn btn-primary">บันทึก</button> &nbsp
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
                .find(".thumbnail_div").html("").end()
                .find("input:file.browse_file").attr("value","").end()
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