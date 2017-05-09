<!--<div class="btn-floating" id="help-actions">-->
<!--  <div class="btn-bg"></div>-->
<!--  <button type="button" class="btn btn-default btn-toggle" data-toggle="toggle" data-target="#help-actions">-->
<!--    <i class="icon fa fa-plus"></i>-->
<!--    <span class="help-text">Shortcut</span>-->
<!--  </button>-->
<!--  <div class="toggle-content">-->
<!--    <ul class="actions">-->
<!--      <li><a href="#">Website</a></li>-->
<!--      <li><a href="#">Documentation</a></li>-->
<!--      <li><a href="#">Issues</a></li>-->
<!--      <li><a href="#">About</a></li>-->
<!--    </ul>-->
<!--  </div>-->
<!--</div>-->


<footer class="app-footer"> 
  <div class="row">
    <div class="col-xs-12">
      <div class="footer-copyright">
        Copyright © 2016 <a href="http://www.facebook.com/jakkrit2939" target="_blank">Nidchaphon Jaipromma.</a>
      </div>
    </div>
  </div>
</footer>

</div></div>

<script type="text/javascript" src="../common/js/vendor.js"></script>
<script type="text/javascript" src="../common/js/app.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>


<?php if ($_GET['page'] == 'teacher_appointment_add' || $_GET['page'] == 'student_diary_add' || $_GET['page'] == 'student_profile_edit' || $_GET['page'] == 'admin_user_add' || $_GET['page'] == 'admin_user_edit'){ ?>
<script src="../common/datepicker/jquery-ui/external/jquery/jquery.js"></script>
<script src="../common/datepicker/jquery-ui/jquery-ui-thai.js"></script>
<script src="../common/datepicker/datepicker.js"></script>

<script>
    $(document).ready(function () {
        var date = new DatePickOne("date");
        date.readonly = false;
        date.maxdate=0;
        date.Create();
        var date2 = new DatePickOne("date2");
        date2.readonly = false;
        date2.mindate=0;
        date2.Create();
        var dateEnd = new DatePickTwo("dateStart","dateEnd");
            dateEnd.readonly = false;
//        dateEnd.maxdate1=0;
//        dateEnd.maxdate2=0;
        dateEnd.Create();
    });
</script>

<?php } ?>


</body>
</html>