<?php 
$menu_admin_6 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="far fa-file-excel"></i> รายงาน</div>
    <div class="admin-body">

    	<div class="setting-menu mt-4">
    		<div class="row">
            <div class="col-12">
                <h4 class="text-center m-4">ส่งออก Excel รายการร้องเรียนร้องทุกข์</h4>
                <div class=" row mt-5">
                    <div class="offset-md-2 col-md-2">
                    ประเภทการร้องเรียน
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="type" id="type">
                            <option value="">== ทั้งหมด ==</option>
                            <?php foreach($type as $v){
                                echo '<option value="'.$v['ind'].'">'.$v['name'].'</optin>';
                            }?>
                        </select>

                    </div>
                </div>
                <div class=" row mt-2">
                    <div class="offset-md-2 col-md-2">
                    จากวันที่
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control dateadd" id="date_from" name="date_from" autocomplete="off">

                    </div>
                    <div class="col-md-1">
                    ถึง
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control dateadd" id="date_to" name="date_to" autocomplete="off">

                    </div>
                </div>

                <div class="row mt-4 mb-4">
                    <div class="col-12 text-center">
                        <button type="button"  onclick="ExportData()" class="btn btn-success"><i class="far fa-file-excel"></i> ส่งออก Excel</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
</div>
</div>
 
</div>

<div class="loading" style="display:none;">Loading&#8230;</div>


<?php include_once("_inc_footer.php");?>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/datetimepicker-master/jquery.datetimepicker.css" />
<script src="<?=base_url()?>assets/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
<script>

    function ExportData(){
        $(".loading").show();
        var URL ="<?=base_url()?>report/exportExcel";     
            $.ajax({
            type: "GET",
            dataType: "html",
            cache: false,
            data:{
                "type": $("#type").val(),
                "date_from": $("#date_from").val(),
                "date_to": $("#date_to").val(),
            },
            url: URL,
            success: function(data) {          
                window.location.href = "<?=base_url()?>assets/files/export/"+data+".xlsx";   
                $(".loading").hide();
            },
            error: function () {          
                $(".loading").hide();
                alert("ผิดพลาดไม่สามารถส่งออกได้");
            }

        });
    }

  
    jQuery.datetimepicker.setLocale('th');
    jQuery('#date_from').datetimepicker({
    format:'Y-m-d',
    onShow:function( ct ){
    this.setOptions({
        maxDate:jQuery('#date_to').val()?jQuery('#date_to').val():false
    })
    },
    timepicker:false
    });
    jQuery('#date_to').datetimepicker({
    format:'Y-m-d',
    onShow:function( ct ){
    this.setOptions({
        minDate:jQuery('#date_from').val()?jQuery('#date_from').val():false
    })
    },
    timepicker:false
    });
</script>
<style>
/* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 150ms infinite linear;
  -moz-animation: spinner 150ms infinite linear;
  -ms-animation: spinner 150ms infinite linear;
  -o-animation: spinner 150ms infinite linear;
  animation: spinner 150ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>