<?php 
$menu_2 = "navbar-active";
include_once("_inc_hearder.php");?>

<div class="container">
    <div id="mainpage">
    
        <div class="row">
            <div class="title col-md-12 text-center">แจ้ง เรื่องร้องเรียน-ร้องทุกข์ <br/>ไปยังศูนย์ เรียบร้อยแล้ว</div>
        </div>

        <h4 class="text-center text-success show-ques" style="display:none;">ขอบคุณสำหรับการประเมิมความพึงพอใจ</h4>

        <div class="row ml-2 mr-2" style="margin-bottom:15px;">
            <div class="offset-md-5 col-md-2">
                <div class="text-center" style="border: 1px solid #28a745;padding: 10px 10px 10px 10px;">
                    <?=$code?>   
                    <input type="hidden" value="<?=$code?>" id="myvalue" />
                </div>
            </div>
        </div>
        <div class="row ml-2 mr-2">
            <div class="col-md-12 text-center">
                <p class="form-text text-muted" style="margin-bottom: 0px;">กรุณา คัดลอก <a href="javascript:copyToClipBoard()"><i class="far fa-copy"></i></a> รหัสร้องเรียนไว้เพื่อติดตาม การร้องเรียนของท่านได้</p>
                <p class="form-text text-muted mb-5">ท่าน สามารถติดตามการร้องเรียนของท่านได้ที่ เมนู <a href="<?=base_url()?>complain/follow">ติดตามเรื่องร้องเรียน</a></p>
            </div>
        </div>
    </div>
   
</div>

<div class="showModel"></div>

<link href="<?=base_url()?>../assets/icheck-1.x/skins/square/orange.css" rel="stylesheet">
<script src="<?=base_url()?>../assets/icheck-1.x/icheck.js"></script>
<script>

$(function(){
    $( ".showModel" ).load( "<?php echo base_url() ?>main/showques?type=finish");
})

function copyToClipBoard(){
    var text = document.getElementById('myvalue'); 
    text.select();
        document.execCommand("copy");
}


</script>
<?php include_once("_inc_footer.php");?>
