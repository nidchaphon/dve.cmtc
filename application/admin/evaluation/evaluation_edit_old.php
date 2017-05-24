<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 5/22/2017 AD
 * Time: 10:41
 */

$classAdmin = new Admin();
$valEvaluation = $classAdmin->GetDetailEvaluation($_GET['evaluationID']);

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                เพิ่มแบบประเมินนักศึกษาฝึกประสบการณ์
            </div>
            <div class="card-body">

                <form name="frmAddEvaluation" class="form form-horizontal" action="admin/admin_update.php?evaluationID=<?php echo $valEvaluation['evaluation_id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="section">
                        <?php if ($_GET['evaluationType'] == 'score'){ ?>
                            <div class="section-title">แบบประเมินนักศึกษาฝึกประสบการณ์</div>
                            <div class="section-body">
                                <div class="row" align="center">
                                    <table id="myTbl" width="90%" border="0" cellspacing="5" cellpadding="0">
                                        <tr class="firstTr">
                                            <td width="70%">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">หัวข้อการประเมิน</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="topic" class="form-control" value="<?php echo $valEvaluation['evaluation_topic']; ?>"  />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">รายละเอียดการพิจารณา</label>
                                                    <div class="col-md-8">
                                                        <textarea name="detail" class="form-control"><?php echo $valEvaluation['evaluation_detail']; ?></textarea>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="30%">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label" style="width: auto;">&nbsp;&nbsp;&nbsp; คะแนนเต็ม</label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="score" class="form-control" value="<?php echo $valEvaluation['evaluation_score']; ?>" />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        <?php } if ($_GET['evaluationType'] == 'check'){ ?>
                            <div class="section-title">แบบประเมินความพึงพอใจ</div>
                            <div class="section-body">
                                <div class="row" align="center">
                                    <table id="myTbl" width="90%" border="0" cellspacing="5" cellpadding="0">
                                        <tr class="firstTr">
                                            <td width="70%">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">หัวข้อการประเมิน</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="topic" class="form-control" value="<?php echo $valEvaluation['evaluation_topic']; ?>" />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        <?php } ?>
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