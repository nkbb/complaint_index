
<?php 
$menu_3 = "navbar-active";
include_once("_inc_hearder.php");?>
<style>
  .timeline  ul{ 
    padding: 1em 0 0 2em;
    margin: 0;
    list-style: none;
    position: relative; 
}
.timeline  ul::before{ 
    content: " ";
    height: 100%;
    width: 1px;
    background-color: #d9d9d9;
    position: absolute;
    top: 0;
    left: 2.5em;
    z-index: 1;
}


.timeline  ul li div {
display: inline-block;
margin: 1em 0;
vertical-align: top;
}

.bullet {
    width: 1em;
    height: 1em;
    box-sizing: border-box;
    border-radius: 50%;
    z-index: 2;
    background-color: #fff;
    margin-right: 1em;
    position: relative;

}
.timeline  ul li .pink{ border: 2px solid #f93b69; }
.timeline  ul li .blue{border: 2px solid #007bff;}
.timeline  ul li .orange{border: 2px solid #eb8b6e;}
.timeline  ul li .success{border: 2px solid #28a745;}

.timeline .time {
width: 20%;
font-size: 14px;
padding-top: 0.25em;
}

.timeline .desc {
width: 60%;
}

.timeline h3 {
font-size: 0.9em;
font-weight: 400;
margin: 0;
}

.timeline h4 {
margin: 0;
font-size: 18px;
font-weight: 400;
color: #808080;
}

.timeline .people img {
width: 30px;
height: 30px;
border-radius: 50%;
}

</style>
<div class="container">
  <div id="mainpage">
        <div class="row">
            <div class="title col-md-12 text-center">ติดตามเรื่องร้องเรียน</div>
        </div>
          <div class="pl-5 pr-5"><h4>รหัสเรื่องร้องเรียน <sapn style="color:#fd7e14;font-weight: bold;"><?=$code?></sapn></h4></div>
       
          <div class="row">
              <div class="col-md-12">
                  <div class="panel-text-header mb-3 mt-3">
                      <p>ข้อมูลเกี่ยวกับเรื่องร้องเรียน</p>
                  </div>
              </div>
          </div>
          <div class="pl-5 pr-5">
            <div class="row input-data input-row mt-3">
                <label class="col-md-2">ร้องเรียนถึง :</label>
                <div class="col-md-4 form-group mb-0"><?=$office_name?></div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">ประเภทการร้องเรียน :</label>
                <div class="col-md-4 form-group mb-0"><?=$complain_type?></div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">ร้องเรียนถึงบุคคล :</label>
                <div class="col-md-4 form-group mb-0"><?php if($complaint_person=='1'){echo "แพทย์";}else if($complaint_person=='2'){ echo "พยาบาล";}else if($complaint_person=='3'){ echo "เจ้าหน้าที่"; }else if($complaint_person=="4"){ echo "อื่นๆ"; }?></div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">เรื่องที่ร้องเรียน :</label>
                <div class="col-md-4 form-group mb-0"><?=$name?></div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">รายละเอียดเรื่องที่ร้องเรียน :</label>
                <div class="col-md-8 form-group mb-0"><?=$description?></div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">สิ่งที่ต้องการให้แก้ไข ปรับปรุง :</label>
                <div class="col-md-8 form-group mb-0"><?=$improvement?></div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">ไฟล์เอกสารแนบ :</label>
                <div class="col-md-8 form-group mb-0">
                  <?php if($files){
                      // echo "<a href='".base_url()."assets/files/".$files."' target=\"_blank\">".$files."</a>";
                      echo '<span>มี</span>';
                  }else{
                      echo "<spna class='text-danger'>ไม่มี </spna>";
                  }?>
                </div>
            </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="panel-text-header mb-3 mt-3">
                      <p>กระบวนการดำเนินการ</p>
                  </div>
              </div>
          </div>
          <div class="pl-5 pr-5">
            <?php if($type == 0){
              echo "<div class='text-center text-danger mt-3' style='font-size:18px;'>ศูนยร้องเรียนยุติเรื่อง \"การร้องเรียนของท่าน อาจเข้าข่ายผิดนโยบายการร้องเรียนของกรมสุขภาพจิต\" กรุณาร้องเรียนใหม่อีกครัั้ง</div>";
            }else{?>
            <div class="row">
              <div class="col-md-10 offset-md-2">
                <div class="timeline">
                  <ul>
                    <?php if($type >= 2){?>
                      <li>
                          <div class="bullet pink"></div>
                          <div class="time"><?=$showdate_add?></div>
                          <div class="desc">
                            <h4>ศูนย์ร้องเรียน รับเรื่องร้องเรียน</h4>
                          </div>
                      </li>
                      <?php } ?>
                      <?php if($type==2){?>
                        <li>
                          <div class="bullet pink"></div>
                          <div class="time text-danger">ผ่านไปแล้ว <?=$datediff?> วัน</div>
                          <div class="desc">
                            <h4 class="text-danger">ยังไม่ดำเนินการ</h4>
                            <h3>รอศูนย์ส่งเรื่องให้หน่วยที่รับผิดชอบ ดำเนินการ</h3>
                          </div>
                      }
                      </li>
                      <?php } ?>

                      <?php if($type >= 3){?>
                      <li>
                          <div class="bullet orange"></div>
                          <div class="time"><?=$showdate_send?></div>
                          <div class="desc">
                            <h4>ส่งเรื่องร้องเรียนไปยัง หน่วยที่ร้องเรียน</h4>
                          </div>
                      </li>
                      <?php }
                      if($type==3){
                      ?>
                        <li>
                          <div class="bullet pink"></div>
                          <div class="time text-danger">ผ่านไปแล้ว <?=$datediff?> วัน</div>
                          <div class="desc">
                            <h4 class="text-danger">ยังไม่ดำเนินการ</h4>
                            <h3>รอหน่วยที่รับผิดชอบ รับเรื่องร้องเรียน</h3>
                          </div>
                      </li>
                      <?php }?>

                      <?php if($type >= 4){?>
                      <li>
                          <div class="bullet blue"></div>
                          <div class="time"><?=$showdate_receive?></div>
                          <div class="desc">
                            <h4>หน่วยรับผิดชอบ รับข้อร้องเรียนแล้ว</h4>
                          </div>
                      </li>
                      <?php }

                      if($type==4){
                      ?>
                      <li>
                          <div class="bullet pink"></div>
                          <div class="time text-danger">ผ่านไปแล้ว <?=$datediff?> วัน</div>
                          <div class="desc">
                            <h4 class="text-danger">ยังไม่ดำเนินการ</h4>
                            <h3>รอหน่วยที่รับผิดชอบ ดำเนินการตอบ-แก้ไขข้อร้องเรียน</h3>
                          </div>
                      </li>
                      <?php } ?>


                      <?php if($type >= 5){?>
                      <li>
                          <div class="bullet blue"></div>
                          <div class="time"><?=$showdate_answer?></div>
                          <div class="desc">
                            <h4>หน่วยดำเนินการ ตอบ-แก้ไขข้อร้องเรียน เรียบร้อยแล้ว</h4>
                            <h3>รอศูนย์ร้องเรียน ตรวจสอบข้อมูล</h3>
                          </div>
                      </li>
                      <?php }

                      if($type==5){
                      ?>
                      <li>
                          <div class="bullet pink"></div>
                          <div class="time text-danger">ผ่านไปแล้ว <?=$datediff?> วัน</div>
                          <div class="desc">
                            <h4 class="text-danger">ยังไม่ดำเนินการ</h4>
                            <h3>ศูนย์รับเรื่องร้องเรียน กำลังดำเนินการตรวจสอบ ความถูกต้อง</h3>
                          </div>
                      </li>
                      <?php }?>

                      <?php if($type == 6){?>
                      <li>
                          <div class="bullet success"></div>
                          <div class="time">20 ก.พ. 56</div>
                          <div class="desc">
                            <h4>เสร็จสิ้น</h4>
                            <h3 class="text-success">ระยะเวลาดำเนินการ <?=$datediff?> วัน</h3>
                          </div>
                      </li>
                    <?php }?>
                  </ul>
                </div>  
              </div>
            </div>
            </div>
            <?php }?>
          <?php if($type == 6){?>
           <div class="row">
              <div class="col-md-12">
                  <div class="panel-text-header mb-3 mt-3" style="background-color:#28a745">
                      <p>รายละเอียด การตอบ-แก้ไขข้อร้องเรียน</p>
                  </div>
              </div>
          </div>
          <div class="pl-5 pr-5">
           <div class="row input-data input-row">
              <label class="col-md-2">ตอบ-แก้ไขข้อร้องเรียน :</label>
              <div class="col-md-8 form-group mb-0"><?=$answer_detail?></div>
          </div>
          <div class="row input-data input-row">
              <label class="col-md-2">ไฟล์เอกสารแนบ :</label>
              <div class="col-md-8 form-group mb-0">
                <?php if($answer_file){
                    echo "<a href='".base_url()."assets/files/".$answer_file."' target=\"_blank\">".$answer_file."</a>";
                }else{
                    echo "<spna class='text-danger'>ไม่มี </spna>";
                }?>
              </div>
          </div>
        <?php }?>

          <div class="row">
              <div class="col-md-12 text-center my-5">
                  <button type="button" onClick="window.location = '<?=base_url()?>/complain/follow';" class="btn btn-primary">ย้อนกลับ</button>
              </div>
          </div>
        </div>
  </div>
</div>
<style type="text/css">
  
  .mascot{
    position: fixed;
    right: 1%;
    top: 65%;
    z-index:999;
    display: none;
  }
  .bg-mascot{
    z-index: 888;

    position: fixed;
    top: 0;
    left: 0;
    display: block;
    width: 100%;
    height: 100%;
    overflow: hidden;
    outline: 0;
    background:#000; 
    opacity:.2; filter:alpha(opacity=20);

  }
</style>
<div class="mascot">
  <a href="<?=base_url()?>questionnaire/assessment"><img src="<?=base_url()?>assets/images/mascot2.png" width="300px"></a>
</div>
<script>
  setTimeout(function(){ $(".mascot").show(); }, 2000);

</script>
<?php include_once("_inc_footer.php");?>