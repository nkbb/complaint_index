<?php 
$menu_1 = "navbar-active";
include_once("_inc_hearder.php");?>

<?php if($slide){?>
  <div class="container-fluid" style="padding:0px;">

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php 
        $i = 0;
        foreach ($slide as $key => $value) { ?>
          <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i?>" class="<?php if($i==0){echo"active";}?>"></li>
        <?php $i++; }?>
      </ol>
      <div class="carousel-inner">
        <?php 
        $i = 0;
        foreach ($slide as $key => $value) { ?>
        <div class="carousel-item <?php if($i==0){echo"active";}?>">
          <img src="<?=base_url()?>assets/images/slide/<?=$value['url']?>" style="max-height: 500px;"class="d-block w-100" alt="Slide Images">
        </div>
        <?php $i++; }?>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
<?php }?>

    <div class="container">
      <div class="menu-list text-center mt-5 mb-5">
        <ul>
          <li><a href="#teyp1" class="menutype1 active">การให้บริการ</a></li>
          <li><a href="#teyp2" class="menutype2">แจ้งเรื่องร้องเรียน</a></li>
          <li><a href="#teyp3" class="menutype3">ติดตามเรื่องร้องเรียน</a></li>
        </ul>
      </div>
   
      <div class="row menu-type1">
        <div class="col-md-4">
          <div class="text-center list-type1 mb-3">
            <div style="font-size:90px;"><i class="far fa-list-alt"></i></div>
            <p style="font-size: 14px;">ขั้นตอนที่ 1</p>
            <div style="font-size: 18px;color:#ee7530;">เลือกประเภทการร้องเรียน</div>
          </div>
        </div>
        <div class="col-md-4">
           <div class="text-center list-type1 mb-3">
            <div style="font-size:90px;"><i class="fas fa-chalkboard"></i></div>
            <p style="font-size: 14px;">ขั้นตอนที่ 2</p>
            <div style="font-size: 18px;color:#ee7530;">กรอกแบบฟอร์ม</div>
          </div>
        </div>
        <div class="col-md-4">
           <div class="text-center list-type1 mb-3">
            <div style="font-size:90px;"><i class="far fa-bell"></i></div>
            <p style="font-size: 14px;">ขั้นตอนที่ 3</p>
            <div style="font-size: 18px;color:#ee7530;">ติดตามเรื่องร้องเรียน</div>
          </div>
        </div>
      </div>
      <div class="row menu-type2">
        <div class="col-sm-12 mb-3">
          <div class="row">
            <div class="col-md-3 mb-3">
              <div class="w-100 text-center">
                <div class="img-service-title m-auto" style="background-image: url(<?=base_url()?>assets/images/services/Every-Task-a-Customer-Service-Rep-Must-Do-opengraph.png);"></div>
                <h4 class="mt-3">การให้บริการ</h4>
                <p>การกระทำหรือการดำเนินการอย่างใดอย่างหนึ่ง เพื่อตอบสนองความต้องการของบุคคล หรือองค์กรให้ได้รับความพึงพอใจ</p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="w-100 text-center">
                <div class="img-service-title m-auto" style="background-image: url(<?=base_url()?>assets/images/services/5-growing-careers-public-administration-870x350.jpg);"></div>
                <h4 class="mt-3">การบริหารจัดการ</h4>
                <p>การดำเนินงาน หรือการปฏิบัติงานใดๆ ของหน่วยงานของรัฐ และ/หรือ เจ้าหน้าที่ของรัฐ เช่น การบริหารทรัพยากรบุคคล</p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="w-100 text-center">
                <div class="img-service-title m-auto" style="background-image: url(<?=base_url()?>assets/images/services/violence-in-hospitals.webp);"></div>
                <h4 class="mt-3">การรักษาผิดพลาด</h4>
                <p>การรักษาพยาบาล หมายถึง รูปแบบการรักษาที่ตั้งอยู่บนการสันนิษฐานและการวินิจฉัยของแพทย์ ซึ่งผู้ร้องเรียนอาจเห็นว่าการักษาผิดขั้นตอน</p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="w-100 text-center">
                <div class="img-service-title m-auto" style="background-image: url(<?=base_url()?>assets/images/services/1_JGEOb-zQ70J-hHd1aCz3Gw.png);"></div>
                <h4 class="mt-3">พฤติกรรมส่วนตัว</h4>
                <p>การกระทำ ของบุคคลในทุกลักษณะ ทั้งที่เป็นโดยธรรมชาติทางสรีระและที่จงใจกระทำ</p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="w-100 text-center">
                <div class="img-service-title m-auto" style="background-image: url(<?=base_url()?>assets/images/services/233-2333229_money-bag-emoji-transparent-transparent-background-money-bag.png);"></div>
                <h4 class="mt-3">ค่าตอบแทน</h4>
                <p>ค่าใช้จ่ายต่างๆ ที่องค์การจ่ายให้แก่ผู้ปฏิบัติงาน ค่าใช้จ่ายนี้อาจจ่ายในรูปตัวเงินหรือมิใช่ตัวเงินก็ได้ เพื่อตอบแทนการปฏิบัติงานตามหน้าที่ความรับผิดชอบ </p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="w-100 text-center">
                <div class="img-service-title m-auto" style="background-image: url(<?=base_url()?>assets/images/services/Stop-corruption-Credit-Trinidad-and-Tobago-Transparency-Institute.png);"></div>
                <h4 class="mt-3">การทุจริตของเจ้าหน้าที่</h4>
                <p>การแสวงหาประโยชน์ที่มิควรได้โดยชอบด้วยกฎหมาย สำหรับตนเองหรือผู้อื่น</p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="w-100 text-center">
                <div class="img-service-title m-auto" style="background-image: url(<?=base_url()?>assets/images/services/Every-Task-a-Customer-Service-Rep-Must-Do-opengraph.png);"></div>
                <h4 class="mt-3">วินัยข้าราชการ</h4>
                <p>ข้อบัญญัติที่วางไว้เป็นหลักกำกับพฤติกรรม และมีมาตรการสำหรับควบคุมความประพฤติ และการกระทำของข้าราชการ</p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="w-100 text-center">
                <div class="img-service-title m-auto" style="background-image: url(<?=base_url()?>assets/images/services/Every-Task-a-Customer-Service-Rep-Must-Do-opengraph.png);"></div>
                <h4 class="mt-3">ประชาชนขัดแย้งกับเจ้าหน้าที่ของรัฐ</h4>
                <p>การขัดแย้งหรือความไม่พอใจส่วนตัวของบุคคลใดบุคคลหนึ่ง ต่อเจ้าหน้าที่ของรัฐคนใดคนหนึ่ง</p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="w-100 text-center">
                <div class="img-service-title m-auto" style="background-image: url(<?=base_url()?>assets/images/services/Every-Task-a-Customer-Service-Rep-Must-Do-opengraph.png);"></div>
                <h4 class="mt-3">การคุ้มครองผู้บริโภค</h4>
                <p>การปกป้องดูแลผู้บริโภค ให้ได้รับความปลอดภัย เป็นธรรม และประหยัด จากการบริโภคสินค้าและบริการ</p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="w-100 text-center">
                <div class="img-service-title m-auto" style="background-image: url(<?=base_url()?>assets/images/services/Every-Task-a-Customer-Service-Rep-Must-Do-opengraph.png);"></div>
                <h4 class="mt-3">สวัสดิการของรัฐ</h4>
                <p>รัฐหรือประเทศที่รัฐบาลมีบทบาทสำคัญในการสนับสนุนส่งเสริม และจัดสวัสดิการสังคมให้แก่ประชาชน ในประเทศอย่างจริงจังและเป็นระบบ</p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="w-100 text-center">
                <div class="img-service-title m-auto" style="background-image: url(<?=base_url()?>assets/images/services/Every-Task-a-Customer-Service-Rep-Must-Do-opengraph.png);"></div>
                <h4 class="mt-3">ขอความอนุเคราะห์/ขอความช่วยเหลือ</h4>
                <p>การขอความช่วยเหลือ, ความเอื้อเฟื้อ, ความเกื้อหนุน, ความเจือจุนด้านต่าง ๆ ตามความต้องการของบุคคลนั้น ๆ</p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="w-100 text-center">
                <div class="img-service-title m-auto" style="background-image: url(<?=base_url()?>assets/images/services/Marchh-Suggestion.png);"></div>
                <h4 class="mt-3">ข้อเสนอแนะและชมเชย</h4>
                <p>เรื่องที่ผู้รับบริการหรือผู้มีส่วนได้ส่วนเสียมีข้อเสนอแนะ ข้อคิดเห็นหรือชมเชย เกี่ยวกับการปฏิบัติงาน</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row menu-type3">
        <div class="col-md-4 offset-md-4">
          <div >กรุณากรอก เลขที่ร้องเรียน</div>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
          <small>รหัสนี้จะได้มาเมื่อคุณแจ้งเรื่องร้องเรียน</small>
        </div>
      </div>
    </div>

<div class="container-fluid content-abouts pt-4 pb-5 mt-3">
  <div>
    <h2>ศูนย์รับเรื่องร้องเรียน</h2>
    <div class="row">
      <div class="col-md-4 offset-md-4">
        <hr style="border-top: 2px solid #f8f9fa;">
        <p>ช่องทางการติดต่อ</p>
        <span style="font-size: 24px;background: #fff;padding: 3px 10px 3px 10px;border-radius: 50%;"><i class="far fa-envelope" style="color:#ff6600;"></i></span>
         <span style='font-size:22px;'><?=$abouts["email"]?></span>
      </div>
    </div>
  </div>
</div>

<script>
      $(function(){
        $(".menu-type2").hide();
        $(".menu-type3").hide();
      });

    $(document).ready(function() {
    $('.menutype1').click(function() {
        $(".menu-type1").show();
        $(".menu-type2").hide();
        $(".menu-type3").hide();

        $( ".menutype1" ).addClass( "active" );
        $( ".menutype2" ).removeClass( "active" );
        $( ".menutype3" ).removeClass( "active" );
    });
    $('.menutype2').click(function() {
        $(".menu-type1").hide();
        $(".menu-type2").show();
        $(".menu-type3").hide();

        $( ".menutype1" ).removeClass( "active" );
        $( ".menutype2" ).addClass( "active" );
        $( ".menutype3" ).removeClass( "active" );
    });
    $('.menutype3').click(function() {
        $(".menu-type1").hide();
        $(".menu-type2").hide();
        $(".menu-type3").show();

        $( ".menutype1" ).removeClass( "active" );
        $( ".menutype2" ).removeClass( "active" );
        $( ".menutype3" ).addClass( "active" );
    });
    });
   //http://cdn.livedemo00.template-help.com:82/wt_40702/
</script>

<?php include_once("_inc_footer.php");?>