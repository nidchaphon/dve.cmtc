<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 2/8/2017 AD
 * Time: 22:33
 */

$classCompany = new Company();
$classStudent = new Student();
$valCompany = $classCompany->GetDetailCompany($_GET['companyID']);
$listStudent = $classCompany->GetListStudent($_GET['companyID']);
$listPicture = $classCompany->GetListPicture($_GET['companyID']);

$numPicture = mysql_num_rows($listPicture);

$placeTo = "18.830775,99.016754"

?>

<link href="../common/lightbox/lightbox.css" rel="stylesheet">

<style type="text/css">
    /* css สำหรับ div คลุม google map */
    #contain_map{
        position:relative;
        width:80%;
        height:400px;
        margin:auto;
    }
    /* css กำหนดความกว้าง ความสูงของแผนที่ */
    #map_canvas {
        position:relative;
        width:100%;
        height:400px;
        margin:auto;
    }
    /* css ของส่วนแสดงคำแนะนำเส้นทางการเดินทาง */
    #directionsPanel{
        width:80%;
        margin:auto;
        clear:both;
        background-color: rgba(238, 78, 61, 0.1);
    }
    /* css ในส่วนข้อมูลการแนะนำเส้นทาง เพิ่มเติม ถ้าต้องการกำหนด */
    .adp-placemark{
        background-color: rgba(238, 78, 61, 0.64);
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body app-heading">
                <div class="app-title">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="title">
                                <span class="highlight">ข้อมูลสถานประกอบการ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-tab">
            <div class="card-body ">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="section">
                            <div class="row">
                                <div class="col-md-12" align="center">
                                    <?php if ($valCompany['company_logo'] != ''){
                                        echo '<img src="../images/logo_company/'.$valCompany['company_logo'].'" width="150px">';
                                    }else{
                                        echo '';
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="section-title">ข้อมูลทั่วไป</div>
                            <div class="section-body">
                                <div class="row">
                                    <div class="col-md-2"><p><strong>ชื่อสถานประกอบการ</strong></p></div>
                                    <div class="col-md-8"><?php echo $valCompany['company_name']==''?"-":$valCompany['company_name'] ; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"><p><strong>รายละเอียดของสถานประกอบการ</strong></p></div>
                                    <div class="col-md-8"><?php echo $valCompany['company_detail']==''?"-":$valCompany['company_detail'] ; ?></div>
                                </div>
                            </div>

                            <div class="section-title">ข้อมูลการติดต่อ</div>
                            <div class="section-body">
                                <div class="row">
                                    <div class="col-md-2"><p><strong>ที่อยู่</strong></p></div>
                                    <div class="col-md-8"><?php echo $valCompany['company_address']==''?"-":$valCompany['company_address'] ; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"><p><strong>เบอร์โทรศัพท์</strong></p></div>
                                    <div class="col-md-8"><?php echo $valCompany['company_tel']==''?"-":$valCompany['company_tel'] ; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"><p><strong>อีเมลล์</strong></p></div>
                                    <div class="col-md-8"><?php echo $valCompany['company_email']==''?"-":$valCompany['company_email'] ; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"><p><strong>เว็บไซต์</strong></p></div>
                                    <div class="col-md-8"><a href="<?php echo $valCompany['company_website'] ; ?>" target="_blank"><?php echo $valCompany['company_website']==''?"-":$valCompany['company_website'] ; ?></a></div>
                                </div>
                            </div>

                            <div class="section-title">ข้อมูลผู้บริหาร</div>
                            <div class="section-body">
                                <div class="row">
                                    <div class="col-md-2"><p><strong>ชื่อผู้บริหาร</strong></p></div>
                                    <div class="col-md-8"><?php echo $valCompany['company_manager_name']==''?"-":$valCompany['company_manager_name'] ; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"><p><strong>ตำแหน่ง</strong></p></div>
                                    <div class="col-md-8"><?php echo $valCompany['company_manager_rank']==''?"-":$valCompany['company_manager_rank'] ; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"><p><strong>เบอร์โทรศัพท์</strong></p></div>
                                    <div class="col-md-8"><?php echo $valCompany['company_manager_tel']==''?"-":$valCompany['company_manager_tel'] ; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"><p><strong>อีเมลล์</strong></p></div>
                                    <div class="col-md-8"><?php echo $valCompany['company_manager_email']==''?"-":$valCompany['company_manager_email'] ; ?></div>
                                </div>
                                <?php if ($valCompany['company_manager_facebook'] != ''){
                                    echo '
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>Facebook</strong></p></div>
                                        <div class="col-md-8"><a href="https://www.facebook.com/'.$valCompany['company_manager_facebook'].'" target="_blank">https://www.facebook.com/'.$valCompany['company_manager_facebook'].'&nbsp;&nbsp;<img src="../images_sys/icon_facebook.png" width="30px" height="30px"></a>
                                        </div>
                                    </div>';}
                                    else{
                                    echo ''; }
                                    if ($valCompany['company_manager_line'] != ''){
                                    echo '
                                    <div class="row">
                                        <div class="col-md-2"><p><strong>Line</strong></p></div>
                                        <div class="col-md-8"><a href="http://line.me/ti/p/~'.$valCompany['company_manager_line'].'" target="_blank">'.$valCompany['company_manager_line'].'&nbsp;&nbsp;<img src="../images_sys/icon_line.png" width="30px" height="30px"></a>
                                        </div>
                                    </div>';}
                                    else{
                                        echo ''; }
                                        ?>

                            </div>

                            <?php if ($numPicture != '0'){ ?>
                            <div class="section-title">รูปสถานประกอบการ</div>
                            <div class="row">
                                <?php while ($valPicture = mysql_fetch_assoc($listPicture)){?>
                                    <div class="col-md-3 col-sm-6">
                                        <a href="../images/company/<?php echo $valPicture['picture_name'];?>" data-toggle="lightbox" data-gallery="example-gallery" class="thumbnail">
                                            <img src="../images/company/<?php echo $valPicture['picture_name'];?>" class="img-responsive">
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php } ?>

                            <div class="section-title">แผนที่และการเดินทาง</div>
                            <div class="row">
                                <div class="col-md-12" style="text-align: center">
                                    <?php if ($valCompany['company_lat'] != '' && $valCompany['company_lon'] != ''){
                                        echo "<strong><font color='#0eb011'>จุด A คือ วิทยาลัยเทคนิคเชียงใหม่</font><br><font color='#ff0000'>จุด B คือ ".$valCompany['company_name']."</font></strong>";
                                    }else{
                                        echo "ไม่ได้ระบุตำแหน่งในแผนที่";
                                    } ?>
                                </div>
                            </div><br>
                            <div id="contain_map">
                                <div id="map_canvas"></div>
                            </div>
                            <div id="directionsPanel"></div>
                            <br>
                            <div class="section-title">นักศึกษาในสถานประกอบการ</div>
                            <?php if ($valCompany['numStudent'] != '0'){ ?>
                            <div class="section-body">
                                <div class="row">
                                    <div class="col-md-3"><p><strong>จำนวนนักศึกษาฝึกประสบการณ์</strong></p></div>
                                    <div class="col-md-8"><?php echo $valCompany['numStudent']." คน"; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"><p><strong>รายชื่อนักศึกษา</strong></p></div>
                                    <div class="col-md-8">
                                        <ol>
                                        <?php while ($valStudent = mysql_fetch_assoc($listStudent)){
                                            $valDegree = $classStudent->GetStatusDetailStudent($valStudent['student_degree']);
                                            $valDepartment = $classStudent->GetStatusDetailStudent($valStudent['student_department']);
                                            echo "<li>".$valStudent['student_code']." <a href='index.php?page=student_profile&memberID=".$valStudent['member_id']."'>";
                                            if ($valStudent['student_sex']== 'male'){echo "นาย";}elseif ($valStudent['student_sex']== 'female'){echo "นางสาว";}
                                            echo $valStudent['student_firstname']." ".$valStudent['student_lastname']."</a> ".$valDegree['status_text']." ปี ".$valStudent['student_year']." ".$valDepartment['status_text']."</li>";
                                        }  ?>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <?php } else { echo "ไม่มีนักศึกษาฝึกประสบการณ์"; } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script src="../common/lightbox/lightbox.js"></script>

<!-- for documentation only -->
<script src="//cdnjs.cloudflare.com/ajax/libs/anchor-js/3.2.1/anchor.min.js"></script>

<script type="text/javascript">

    $(document).ready(function ($) {
        // delegate calls to data-toggle="lightbox"
        $(document).on('click', '[data-toggle="lightbox"]:not([data-gallery="navigateTo"])', function(event) {
            event.preventDefault();
            return $(this).ekkoLightbox({
                onShown: function() {
                    if (window.console) {
                        return console.log('Checking our the events huh?');
                    }
                },
                onNavigate: function(direction, itemIndex) {
                    if (window.console) {
                        return console.log('Navigating '+direction+'. Current item: '+itemIndex);
                    }
                }
            });
        });

        //Programmatically call
        $('#open-image').click(function (e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });
        $('#open-youtube').click(function (e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });

        // navigateTo
        $(document).on('click', '[data-toggle="lightbox"][data-gallery="navigateTo"]', function(event) {
            event.preventDefault();

            return $(this).ekkoLightbox({
                onShown: function() {

                    this.modal().on('click', '.modal-footer a', function(e) {

                        e.preventDefault();
                        this.navigateTo(2);

                    }.bind(this));

                }
            });
        });


        /**
         * Documentation specific - ignore this
         */
        anchors.options.placement = 'left';
        anchors.add('h3');
        $('code[data-code]').each(function() {

            var $code = $(this),
                $pair = $('div[data-code="'+$code.data('code')+'"]');

            $code.hide();
            var text = $code.text($pair.html()).html().trim().split("\n");
            var indentLength = text[text.length - 1].match(/^\s+/)
            indentLength = indentLength ? indentLength[0].length : 24;
            var indent = '';
            for(var i = 0; i < indentLength; i++)
                indent += ' ';
            if($code.data('trim') == 'all') {
                for (var i = 0; i < text.length; i++)
                    text[i] = text[i].trim();
            } else  {
                for (var i = 0; i < text.length; i++)
                    text[i] = text[i].replace(indent, '    ').replace('    ', '');
            }
            text = text.join("\n");
            $code.html(text).show();

        });
    });

    var directionShow; // กำหนดตัวแปรสำหรับใช้งาน กับการสร้างเส้นทาง
    var directionsService; // กำหนดตัวแปรสำหรับไว้เรียกใช้ข้อมูลเกี่ยวกับเส้นทาง
    var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
    var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
    var my_Latlng; // กำหนดตัวแปรสำหรับเก็บจุดเริ่มต้นของเส้นทางเมื่อโหลดครั้งแรก
    var initialTo; // กำหนดตัวแปรสำหรับเก็บจุดปลายทาง เมื่อโหลดครั้งแรก
    var searchRoute; // กำหนดตัวแปร ไว้เก็บฃื่อฟังก์ชั้น ให้สามารถใช้งานจากส่วนอื่นๆ ได้
    function initialize() { // ฟังก์ชันแสดงแผนที่
        GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
        directionShow=new  GGM.DirectionsRenderer({draggable:true});
        directionsService = new GGM.DirectionsService();
        // กำหนดจุดเริ่มต้นของแผนที่ //วิทยาลัยเทคนิคเชียงใหม่
        my_Latlng  = new GGM.LatLng(18.792964,98.983499);
        // กำหนดตำแหน่งปลายทาง สำหรับการโหลดครั้งแรก
        initialTo=new GGM.LatLng(<?php echo $valCompany['company_lat'].",".$valCompany['company_lon']; ?>);
        var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
        // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
        var my_DivObj=$("#map_canvas")[0];
        // กำหนด Option ของแผนที่
        var myOptions = {
            zoom: 13, // กำหนดขนาดการ zoom
            center: my_Latlng , // กำหนดจุดกึ่งกลาง จากตัวแปร my_Latlng
            mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่ จากตัวแปร my_mapTypeId
        };
        map = new GGM.Map(my_DivObj,myOptions); // สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map
        directionShow.setMap(map); // กำหนดว่า จะให้มีการสร้างเส้นทางในแผนที่ที่ชื่อ map
        // ส่วนสำหรับกำหนดให้แสดงคำแนะนำเส้นทาง
        directionShow.setPanel($("#directionsPanel")[0]);

        if(map){ // เงื่่อนไขถ้ามีการสร้างแผนที่แล้ว
            searchRoute(my_Latlng,initialTo); // ให้เรียกใช้ฟังก์ชัน สร้างเส้นทาง
        }

        // กำหนด event ให้กับเส้นทาง กรณีเมื่อมีการเปลี่ยนแปลง
        GGM.event.addListener(directionShow, 'directions_changed', function() {
            var results=directionShow.directions; // เรียกใช้งานข้อมูลเส้นทางใหม่
        });

    }
    $(function(){
        // ส่วนของฟังก์ชัน สำหรับการสร้างเส้นทาง
        searchRoute=function(FromPlace,ToPlace){ // ฟังก์ชัน สำหรับการสร้างเส้นทาง
            if(!FromPlace && !ToPlace){ // ถ้าไม่ได้ส่งค่าเริ่มต้นมา ให้ใฃ้ค่าจากการค้นหา
                var FromPlace=$("#namePlace").val();// รับค่าชื่อสถานที่เริ่มต้น
                var ToPlace=$("#toPlace").val(); // รับค่าชื่อสถานที่ปลายทาง
            }
            // กำหนด option สำหรับส่งค่าไปให้ google ค้นหาข้อมูล
            var request={
                origin:FromPlace, // สถานที่เริ่มต้น
                destination:ToPlace, // สถานที่ปลายทาง
                travelMode: GGM.DirectionsTravelMode.DRIVING // กรณีการเดินทางโดยรถยนต์
            };
            // ส่งคำร้องขอ จะคืนค่ามาเป็นสถานะ และผลลัพธ์
            directionsService.route(request, function(results, status){
                if(status==GGM.DirectionsStatus.OK){ // ถ้าสามารถค้นหา และสร้างเส้นทางได้
                    directionShow.setDirections(results); // สร้างเส้นทางจากผลลัพธ์
                }else{
                    // กรณีไม่พบเส้นทาง หรือไม่สามารถสร้างเส้นทางได้
                    // โค้ดตามต้องการ ในทีนี้ ปล่อยว่าง
                }
            });
        }

    });
    $(function(){
        // โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว
        // ค่าตัวแปร ที่ส่งไปในไฟล์ google map api
        // v=3.2&sensor=false&language=th&callback=initialize
        //  v เวอร์ชัน่ 3.2
        //  sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false
        //  language ภาษา th ,en เป็นต้น
        //  callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize
        $("<script/>", {
            "type": "text/javascript",
            src: "http://maps.google.com/maps/api/js?key=AIzaSyD8cw-Pf7wl1jgdwVSVHARSUoYckq0xu0s&callback=initMap&v=3.2&sensor=false&language=th&callback=initialize"
        }).appendTo("body");
    });
</script>