<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 5/22/2017 AD
 * Time: 10:29
 */

if ($detect->isMobile() || $detect->isTablet()) {
    echo "<script>alert('กรุณาใช้งานอุปกรณ์ของคุณในแนวนอน เพื่อการแสดงผลตารางให้พอดีกับจอภาพ');</script>";
}

$classAdmin = new Admin();
$listEvaluation = $classAdmin->GetListEvaluation();

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body app-heading">
                <div class="app-title">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="title">
                                <span class="highlight">แบบประเมินนักศึกษาฝึกประสบการณ์​</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <a href="index.php?page=admin_evaluation_add"><button type="button" class="btn btn-primary">เพิ่มแบบประเมิน  <i class='fa fa-plus'></i></button></a>
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
            <div class="card-header">
                <br><br>
            </div>
            <div class="card-body">
                <table class="datatable table-responsive table-striped table-bordered table-hover" id="dataTables-example"  cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th style="text-align: center" height="50px">แบบประเมินนักศึกษาฝึกประสบการณ์</th>
                        <th style="text-align: center">แบบประเมินสำหรับ</th>
                        <th style="text-align: center">ประเภท</th>
                        <th width="15%" style="text-align: center">จัดการ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($valEvaluation = mysql_fetch_assoc($listEvaluation)){
                        $explodeDegree = explode(',',$valEvaluation['evaluation_std_degree']);
                        $explodeDepartment = explode(',',$valEvaluation['evaluation_std_department']);
                        ?>
                        <tr>
                            <td height="30px">
                                <a href="index.php?page=admin_evaluation_add_question&evaluationID=<?php echo $valEvaluation['evaluation_id']; ?>">
                                <?php
                                echo "ระดับ "; foreach ($explodeDegree AS $valDegree){
                                    $textDegree = $classAdmin->GetTextStatusType($valDegree);
                                    echo $textDegree['status_text']." , ";
                                }
                                echo "สาขา "; foreach ($explodeDepartment AS $valDepartment){
                                    $textDepartment = $classAdmin->GetTextStatusType($valDepartment);
                                    echo $textDepartment['status_text']." , ";
                                }

                                echo "รุ่นปี ".$valEvaluation['evaluation_std_year']; ?>
                                </a>
                            </td>
                            <td><?php if ($valEvaluation['evaluation_assessor'] == 'teacher'){ echo "อาจารย์นิเทศ"; } elseif ($valEvaluation['evaluation_assessor'] == 'trainer'){ echo "ผู้ควบคุมการฝึกประสบการณ์"; } ?></td>
                            <td><?php if ($valEvaluation['evaluation_type'] == 'score'){ echo "ให้คะแนน"; } elseif($valEvaluation['evaluation_type'] == 'check'){ echo "ความพึงพอใจ"; } ?></td>
                            <td align="center">
                                <a href="index.php?page=admin_evaluation_edit&evaluationID=<?php echo $valEvaluation['evaluation_id']; ?>&evaluationType=<?php echo $valEvaluation['evaluation_type']; ?>"><i class='fa fa-edit (alias)' title='แก้ไขข้อมูล'></i></a>  &nbsp
                                <a href="admin/admin_delete.php?action=delEvaluation&evaluationID=<?php echo $valEvaluation['evaluation_id']; ?>" onclick="return confirm('ต้องการลบแบบประเมินนี้ หรือไม่')"><i class='fa fa-trash' title='ลบข้อมูล'></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>