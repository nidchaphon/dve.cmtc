<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/18/2016 AD
 * Time: 23:14
 */

$classCompany = new Company();
$detailCompany = $classCompany->GetDetailCompany($_GET['companyID']);
$listPicture = $classCompany->GetListPicture($_GET['companyID']);

//echo '<pre>';print_r($detail);echo '</pre>';

?>
<script language="JavaScript">
    function showPreview(ele)
    {
        $('#imgAvatar').attr('src', ele.value); // for IE
        if (ele.files && ele.files[0]) {

            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imgAvatar').attr('src', e.target.result);
            }

            reader.readAsDataURL(ele.files[0]);
        }
    }

</script>

<style type="text/css">
    /* css สำหรับ div คลุม google map อีกที */
    #contain_map{
        position:relative;
        width:80%;
        height:400px;
        margin:auto;
    }
    /* css กำหนดความกว้าง ความสูงของแผนที่ */
    #map_canvas {
        top:0px;
        width:100%;
        height:400px;
        margin:auto;
    }
    /*css กำหนดรูปแบบ ของ input สำหรับพิมพ์ค้นหา effect */
    .controls_tools {
        margin-top: 16px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    /*css กำหนดรูปแบบ ของ input สำหรับพิมพ์ค้นหา*/
    #pac-input {
        background-color: #fff;
        padding: 0 11px 0 13px;
        width: 60%;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        text-overflow: ellipsis;
    }
    /*css กำหนดรูปแบบ ของ input สำหรับพิมพ์ค้นหา ขณะ focus*/
    #pac-input:focus {
        width: 60%;
        border-color: #4d90fe;
        margin-left: -1px;
        padding-left: 14px;  /* Regular padding-left + 1. */
    }

    .thumbnail_div img{height:100px;margin:5px;}
    canvas{border:1px solid red;}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                แก้ไขข้อมูลสถานประกอบการ
            </div>
            <div class="card-body">
                <form name="frmAddUser" class="form form-horizontal" action="admin/admin_update.php?companyID=<?php echo $_GET['companyID'];?>" method="post" enctype="multipart/form-data">
                    <div class="section">
                        <div class="section-body">
                            <div class="section-title">ข้อมูลทั่วไป</div>
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
                                <label class="col-md-3 control-label">โลโก้สถานประกอบการ</label>
                                <div class="col-md-5">
                                    <input type="file" name="fileLogo" class="form-control-file" aria-describedby="fileHelp" OnChange="showPreview(this)">
                                </div>
                                <div class="col-md-3">
                                    <img id="imgAvatar" <?php if ($detailCompany['company_logo'] != ''){ echo 'src="../images/logo_company/'.$detailCompany['company_logo'].'"';}else { echo ''; } ?> width="150px">
                                    <input type="hidden" name="txtCompanyLogo" value="<?php echo $detailCompany['company_logo']?>">
                                </div>
                            </div>
                            <div class="section-title">ข้อมูลการติดต่อ</div>
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
                            <div class="section-title">ข้อมูลผู้บริหาร</div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ชื่อผู้บริหาร</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtManagerName" class="form-control" placeholder="ชื่อผู้บริหาร" value="<?php echo $detailCompany['company_manager_name']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ตำแหน่ง</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtManagerRank" class="form-control" placeholder="ตำแหน่ง" value="<?php echo $detailCompany['company_manager_rank']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">เบอร์โทรศัพท์</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtManagerTel" class="form-control" placeholder="เบอร์โทรศัพท์" value="<?php echo $detailCompany['company_manager_tel']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">อีเมลล์</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtManagerEmail" class="form-control" placeholder="อีเมลล์" value="<?php echo $detailCompany['company_manager_email']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Facebook</label>
                                <div class="col-md-3" align="right">
                                    http://www.facebook.com/
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="txtManagerFacebook" class="form-control" placeholder="FacebookID" value="<?php echo $detailCompany['company_manager_facebook']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">LineID</label>
                                <div class="col-md-5">
                                    <input type="text" name="txtManagerLine" class="form-control" placeholder="LineID" value="<?php echo $detailCompany['company_manager_line']?>">
                                </div>
                            </div>
                            <div class="section-title">รูปสถานประกอบการ</div>
                            <div class="row">
                                <?php while ($valPicture = mysql_fetch_assoc($listPicture)){ ?>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="thumbnail">
                                            <img src="../images/company/<?php echo $valPicture['picture_name'];?>" class="img-responsive">
                                            <div class="caption">
<!--                                                <a href="" class="btn btn-success btn-xs" role="button">ขยายรูป</a>-->
                                                <a href="admin/admin_delete.php?action=delPicture&pictureID=<?php echo $valPicture['picture_id'] ?>&pictureName=<?php echo $valPicture['picture_name'] ?>&companyID=<?php echo $valPicture['picture_type_id']; ?>" class="btn btn-light btn-danger btn-xs" role="button">ลบรูป</a>
                                            </div>
                                        </div>
                                    </div>
<!--                                    <div class="col-md-3 col-sm-6">-->
<!--                                        <img src="../images/company/--><?php //echo $valPicture['picture_name'];?><!--" class="img-responsive">-->
<!--                                    </div>-->
                                <?php } ?>
                            </div>
                            <div class="row" align="center">
                                <table id="myTbl" width="650" border="0" cellspacing="5" cellpadding="0">
                                    <tr class="firstTr">
                                        <td>
                                            <input type="file" name="imgCompany[]" class="browse_file" />
                                        </td>
                                        <td>
                                            <div class="thumbnail_div"></div>
                                            <input name="h_item_id[]" type="hidden" id="h_item_id[]" value="" />
                                        </td>
                                    </tr>
                                </table>
                                <br />
                                <button id="addRow" type="button" class="btn btn-success">เพิ่มรายการ</button>
                                &nbsp;
                                <button id="removeRow" type="button" class="btn btn-primary">ลบรายการ</button>
                                <input name="h_all_id_data" type="hidden" id="h_all_id_data" value="<?=$all_id_data?>" />

                            </div>
                            <div class="section-title">ข้อมูลที่ตั้งในแผนที่ Google Map</div>
                            <div id="contain_map">
                                <input id="pac-input" class="controls_tools" type="text"placeholder="ค้นหาสถานประกอบการ">
                                <div id="map_canvas">&nbsp;</div>
                            </div>
                            <br>
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

        $(".browse_file").on("change",function(e){
            var files = this.files
            var indexObj = $(".browse_file").index(this);
            var obj = 'thumbnail_div'
            showThumbnail(files,obj,indexObj);
        });

        function showThumbnail(files,obj,indexObj){

            $("."+obj).eq(indexObj).html("");
            for(var i=0;i<files.length;i++){
                var file = files[i]
                var imageType = /image.*/
                if(!file.type.match(imageType)){
                    //     console.log("Not an Image");
                    continue;
                }

                var image = document.createElement("img");
                var thumbnail = document.getElementsByClassName(obj)[indexObj];
                image.file = file;
                thumbnail.appendChild(image)

                var reader = new FileReader()
                reader.onload = (function(aImg){
                    return function(e){
                        aImg.src = e.target.result;
                    };
                }(image))

                var ret = reader.readAsDataURL(file);
                var canvas = document.createElement("canvas");
                ctx = canvas.getContext("2d");
                image.onload= function(){
                    ctx.drawImage(image,100,100)
                }
            } // end for loop

        } // end showThumbnail

    });

    var geocoder; // กำหนดตัวแปรสำหรับ เก็บ Geocoder Object ใช้แปลงชื่อสถานที่เป็นพิกัด
    var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
    var my_Marker; // กำหนดตัวแปรสำหรับเก็บตัว marker
    var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
    var inputSearch; // กำหนดตัวแปร สำหรับ อ้างอิง input สำหรับพิมพ์ค้นหา
    var infowindow;// กำหนดตัวแปร สำหรับใช้แสดง popup สถานที่ ที่ค้นหาเจอ
    var autocomplete; // กำหนดตัวแปร สำหรับเก็บค่า การใช้งาน places Autocomplete
    function initialize() { // ฟังก์ชันแสดงแผนที่
        GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
        geocoder = new GGM.Geocoder(); // เก็บตัวแปร google.maps.Geocoder Object
        // กำหนดจุดเริ่มต้นของแผนที่
        var my_Latlng  = new GGM.LatLng(<?php if ($detailCompany['company_lat'] == '' && $detailCompany['company_lon'] == ''){echo "18.792964,98.983499";} else{echo $detailCompany['company_lat'].",".$detailCompany['company_lon'];}?>);
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

        inputSearch = $("#pac-input")[0]; // เก็บตัวแปร dom object โดยใช้ jQuery
        // จัดตำแหน่ง input สำหรับการค้นหา ด้วย คำสั่งของ google map
        map.controls[GGM.ControlPosition.TOP_LEFT].push(inputSearch);

        // เรียกใช้งาน Autocomplete โดยส่งค่าจากข้อมูล input ชื่อ inputSearch
        autocomplete = new GGM.places.Autocomplete(inputSearch);
        autocomplete.bindTo('bounds', map);

        infowindow = new GGM.InfoWindow();// เก็บ InfoWindow object ไว้ในตัวแปร infowindow
        // เก็บ Marker object พร้อมกำหนดรูปแบบ ไว้ในตัวแปร my_Marker
        my_Marker = new GGM.Marker({
            anchorPoint: new GGM.Point(0, -29),
            position: my_Latlng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
            map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
            draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้
            title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
        });

        // เมื่อแผนที่มีการเปลี่ยนสถานที่ จากการค้นหา
        GGM.event.addListener(autocomplete, 'place_changed', function() {
            infowindow.close();// เปิด ข้อมูลตัวปักหมุด (infowindow)
            my_Marker.setVisible(false);// ซ่อนตัวปักหมุด (marker)
            var place = autocomplete.getPlace();// เก็บค่าสถานที่จากการใช้งาน autocomplete ไว้ในตัวแปร place
            if (!place.geometry) {// ถ้าไม่มีข้อมูลสถานที่
                return;
            }

            // ถ้ามีข้อมูลสถานที่  และรูปแบบการแสดง  ให้แสดงในแผนที่
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else { // ให้แสดงแบบกำหนดเอง
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // แผนที่ขยายที่ขนาด 17 ถือว่าเหมาะสม
            }
//            my_Marker.setIcon(/** // กำหนดรูปแบบของ icons การแสดงสถานที่ */({
//                url: place.icon,
//                size: new GGM.Size(71, 71),
//                origin: new GGM.Point(0, 0),
//                anchor: new GGM.Point(17, 34),
//                scaledSize: new GGM.Size(35, 35)
//            }));

            // ปักหมุด (marker) ตำแหน่ง สถานที่ที่เลือก
            my_Marker.setPosition(place.geometry.location);
            my_Marker.setVisible(true);// แสดงตัวปักหมุด จากการซ่อนในการทำงานก่อนหน้า

            var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
            map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker
            $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
            $("#lon_value").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
            $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value

            // สรัางตัวแปร สำหรับเก็บชื่อสถานที่ จากการรวม ค่าจาก array ข้อมูล
            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            // แสดงข้อมูลในตัวปักหมุด (infowindow)
            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, my_Marker);// แสดงตัวปักหมุด (infowindow)

        });

        // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
        GGM.event.addListener(map, "zoom_changed", function() {
            $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
        });

        // กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร
        GGM.event.addListener(my_Marker, "dragend", function() {
            var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
            map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker
            $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
            $("#lon_value").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
            $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
        });

        // กำหนด event ให้กับตัว marker เมื่อมีการคลิ๊กตัว marker ให้ทำงานอะไร
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
            src: "http://maps.google.com/maps/api/js?key=AIzaSyD8cw-Pf7wl1jgdwVSVHARSUoYckq0xu0s&callback=initMap&v=3.2&sensor=false&language=th&callback=initialize&libraries=places"
        }).appendTo("body");
    });
</script>