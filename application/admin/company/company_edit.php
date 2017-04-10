<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/18/2016 AD
 * Time: 23:14
 */

$classCompany = new Company();
$detailCompany = $classCompany->GetDetailCompany($_GET['companyID']);

//echo '<pre>';print_r($detail);echo '</pre>';

?>
<style type="text/css">
    /* css กำหนดความกว้าง ความสูงของแผนที่ */
    #map_canvas {
        position:relative;
        width:100%;
        height:400px;
        margin:auto;
    }
    /* css สำหรับ div คลุม google map อีกที */
    #contain_map{
        position:relative;
        width:80%;
        height:400px;
        margin:auto;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                แก้ไขข้อมูลสถานประกอบการ
            </div>
            <div class="card-body">
                <form name="frmAddUser" class="form form-horizontal" action="admin/admin_update.php?companyID=<?php echo $detailCompany['company_id']?>" method="post">
                    <div class="section">
                        <div class="section-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">ชื่อสถานประกอบการ</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtCompanyName" class="form-control" placeholder="ชื่อสถานประกอบการ" value="<?php echo $detailCompany['company_name']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">รายละเอียดของสถานประกอบการ</label>
                                <div class="col-md-5">
                                    <textarea type="text" name="txtCompanyDetail" class="form-control" placeholder="รายละเอียดของสถานประกอบการ"><?php echo $detailCompany['company_detail']?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ที่อยู่</label>
                                <div class="col-md-8">
                                    <input type="text" name="txtCompanyAddress" class="form-control" placeholder="ที่อยู่" value="<?php echo $detailCompany['company_address']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">เบอร์โทรศัพท์</label>
                                <div class="col-md-5">
                                    <input type="tel" minlength="10" name="txtCompanyTel" class="form-control" placeholder="เบอร์โทรศัพท์" maxlength="10" value="<?php echo $detailCompany['company_tel']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">อีเมลล์</label>
                                <div class="col-md-5">
                                    <input type="email" name="txtCompanyEmail" class="form-control" placeholder="อีเมลล์" value="<?php echo $detailCompany['company_email']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">เว็บไซต์</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtCompanyWebsite" class="form-control" placeholder="เว็บไต์" value="<?php echo $detailCompany['company_website']?>">
                                </div>
                            </div>
                            <div id="contain_map">
                                <div id="map_canvas"></div>
                            </div><br>
                            <div class="row" style="text-align: center; color: #fb0000;">
                                ลากจุดมาร์คสีแดงเพื่อแก้ไขตำแหน่งของสถานประกอบการ
                            </div><br>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ค่าละติจุด</label>
                                <div class="col-md-5">
                                    <input name="txtCompanyLat" type="text" id="lat_value" class="form-control" placeholder="Latitude" value="<?php echo $detailCompany['company_lat']?>" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ค่าลองติจุด</label>
                                <div class="col-md-5">
                                    <input name="txtCompanyLon" type="text" id="lon_value" class="form-control" placeholder="Longitude" value="<?php echo $detailCompany['company_lon']?>" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" name="updateCompany" class="btn btn-primary">บันทึก</button> &nbsp
                                <button type="reset" class="btn btn-default">ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
    var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
    var my_Marker;
    function initialize() { // ฟังก์ชันแสดงแผนที่
        GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
        // กำหนดจุดเริ่มต้นของแผนที่
        var my_Latlng  = new GGM.LatLng(<?php if ($detailCompany['company_lat'] == '' && $detailCompany['company_lon'] == ''){echo "18.792964,98.983499";} else{echo $detailCompany['company_lat'].",".$detailCompany['company_lon'];}?>);
        var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
        // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
        var my_DivObj=$("#map_canvas")[0];
        // กำหนด Option ของแผนที่
        var myOptions = {
            zoom: 15, // กำหนดขนาดการ zoom
            center: my_Latlng , // กำหนดจุดกึ่งกลาง
            mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่
        };
        map = new GGM.Map(my_DivObj,myOptions);// สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map

        my_Marker = new GGM.Marker({ // สร้างตัว marker
            position: my_Latlng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
            map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
            draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้
            title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
        });

        // กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร
        GGM.event.addListener(my_Marker, "dragend", function() {
            var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
            map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker
            $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
            $("#lon_value").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
            $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
        });

        // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
        GGM.event.addListener(map, "zoom_changed", function() {
            $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
        });

        // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
        GGM.event.addListener(map, "click", function(e) {
            var latClick=e.latLng.lat(); // e.latLng.lat().toFixed(6);
            var lonClick=e.latLng.lng();
            var latlonClck=new GGM.LatLng(latClick,lonClick);
            my_Marker.setPosition(latlonClck);
            var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
            map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker
            $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
            $("#lon_value").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
            $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
        });

    }
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