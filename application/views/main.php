<?php
  $menu2 = "active";
  include_once('_inc_header.php');
?>
  <!-- Page Content -->
  <style>
  input[type=text]{
    border-radius: 0px;
  }
  input[type=text]:focus {
        box-shadow: 0 0 5px rgba(81, 203, 238, 1);

  }

.vertical-menu{ margin-top:15px; }
.vertical-menu a {
  background-color: #fff;
  display: block;
  padding: 8px 10px 8px 12px;
  text-decoration: none;
  color:#495057;
}

.vertical-menu a:hover {
  color: #4CAF50;
  border-bottom: 2px solid #4CAF50; 
}

.vertical-menu a.active {
  border-bottom: 2px solid #4CAF50; 
  color: #4CAF50;
}
.card-main{border: solid 1px #eee;border-radius: 5px; margin-top:25px;padding: 20px 10px 10px 10px;
-webkit-box-shadow: 0 12px 34px rgba(0, 0, 0, 0.04);
-moz-box-shadow: 0 12px 34px rgba(0, 0, 0, 0.04);
box-shadow: 0 12px 34px rgba(0, 0, 0, 0.04);
}
.card-main p{font-size: 12px;}
.card-main a:hover img{border-color:#4CAF50;}
.showunit{font-size: 20px; font-weight: bold;text-align: center; color:#3c763d;margin-bottom: 15px;}
.img-thumbnail{padding: 0px;}
table{width: 100%}
td{text-align: center;width: 50%}
  </style>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="mt-5" style="color:#0056b3">หน่วยถืองบประมาณ <?=$umname?></h2>
      </div>
    </div>


    <div class="row" style="margin-top: 25px;">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <div>
                <input type="text" class="form-control form-control-sm" id="search" placeholder="ค้นหาชื่อหน่วย" onkeyup="loadunit();">
            </div>
             <div class="vertical-menu">
              <a href="<?=base_url()?>showbudget/all"><img src="<?=base_url()?>assets/img/icon/rpbs/list2.png"> รายการงบประมาณทั้งหมด</a>
              <a href="<?=base_url()?>showbudget/gfmis"><img src="<?=base_url()?>assets/img/icon/rpbs/gf.jpg"> บัญชีคุม Gfmis</a>
              <a href="<?=base_url()?>showbudget/budgetvsgfmis"><img src="<?=base_url()?>assets/img/icon/rpbs/vs.png"> เทียบบัญชีคุม VS Gfmis</a>
              <a href="<?=base_url()?>showbudget"><img src="<?=base_url()?>assets/img/icon/rpbs/list_bullets.png"> แสดงการเบิกจ่าย</a>
              <a href="<?=base_url()?>setting"><img src="<?=base_url()?>assets/img/icon/rpbs/setting.png"> ตั้งค่า</a>
              <a href="<?=base_url()?>setting/repassword"><img src="<?=base_url()?>assets/img/icon/rpbs/password.png"> เปลี่ยนรหัสผ่าน</a>
            </div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="margin-bottom: 35px;">
            <div class="row showcard"> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('_inc_footer.php') ?>
<script>
  $(function(){
    //alert('ddd');
    loadunit();
  })


  function loadunit(){

    var search = $("#search").val();
    var URL = "<?=base_url()?>main/loadunit?search="+search;
    $.ajax({
      type: "GET",
      //contentType: "json; charset=utf-8",
      dataType: "json",
      contentType: "x-www-form-urlencoded; charset=utf-8",
      cache: false,
      url: URL,
      success: function(data) {

        $(".showcard").html("");

        $.each(data.items, function(i, item) {
          $(".showcard").append("<div class=\"col-lg-4 col-md-6 col-sm-12 col-xs-12\">"+
            "<div class=\"card-main\">"+
            "<table><tr>"+
            "<td><a href=\"<?=base_url()?>showbudget?uid="+item.uid+"\"><img src=\"<?=base_url()?>assets/img/unit/"+item.img+"\" class=\"img-thumbnail\"></a><p>สถานะภาพ</p></td>"+
            "<td><a href=\"<?=base_url()?>plot\"><img src=\"<?=base_url()?>assets/img/unit/plotvs.jpg\" class=\"img-thumbnail\"></a><p>แผนการเบิกจ่าย</p></td>"+
            "</tr></table>"+
            "<div class=\"showunit\">"+item.uname+"</div>"+
            "</div>"+
          "</div>");
        })
      }
    });

  }
</script>
