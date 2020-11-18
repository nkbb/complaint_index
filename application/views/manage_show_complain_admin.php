
<?php 

if( $page == 'accept'){
    $menu_admin_2 = "active";
}else{
    $menu_admin_3 = "active";
}
include_once("_inc_hearder.php");
?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
    <div class="adminpage">
    
  
        <div class="admin-title">
            <?php if( $page == 'accept'){ ?>
                <i class="far fa-paper-plane"></i>  รับเรื่องร้องเรียน-ส่งให้หน่วยดำเนินการ 
            <?php }else if( $page == 'follow'){ ?>
                <i class="far fa-bell"></i>  ติดตามเรื่องร้องเรียน
            <?php }else{?>
                <i class="far fa-bell"></i>  รายละเอียดเรื่องร้องเรียน
            <?php }?>

            <small class="text-primary"><i class="fas fa-angle-right"></i> แสดงรายละเอียด</small>
        </div>

        <div class="row">
            <!-- <div class="col-md-6 offset-md-6" style="margin-bottom: 8px;">
                <span class="results-status type-2">ศูนย์รับเรื่อง</span>
                <span class="results-status type-3">หน่วย รับเรื่อง</span>
                <span class="results-status type-4">หน่วย ดำเนินการ</span>
                <span class="results-status type-5">ศูนย์ยุติ รายงานผู้บริหาร</span>
                <span class="results-status type-6">เสร็จสิ้น</span>
            </div> -->
        </div>
        <div class="admin-bodyqqaze">           
            <div class="row">
                <div class="col-12 view-complain">
                    <!-- <div class="card">
                        <div class="card-header">
                            <a href="javascript:;" class="link-detail">
                                <h5>
                                    <?=$complain_type?>
                                    <?php if($complaint_sub){?><span>(ด้านพฤติกรรมบริการ)</span><?php }?>
                                </h5>
                            </a>
                            <div class="show-date"><i class="far fa-clock"></i> <?=substr($date_add,0,10)?> <?=substr($date_add,11,5)?></div>
                        </div>
                        <div class="card-body">
                        </div>
                        <div class="card-footer">
                            <span class="text-danger">ยังไม่ดำเนินการ</div>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-md-3 offset-md-9 text-center mb-2">
                            <button type="button" onclick="print_complaint('<?=$token?>')" class="btn btn-success"><i class="fas fa-print"></i> พิมพ์</button>
                        </div>
                    </div>

                    <div class="pl-5">รหัสเรื่องร้องเรียน : <?=$code?>
                        <span class="header pl-4">สถานะ :</span> <span class="results-status type-<?=$type?>"><?=$status_name?></span>
                        <div><i class="far fa-clock"></i> <?=$date_add?> <?=$time_add?> น.</div>
                    </div>

                    <div class="title-show mt-4">
                        <div class="row pl-4">
                            <div class="col-12 text-center">
                                ข้อมูลเกี่ยวกับผู้ร้องเรียน
                            </div>
                        </div>
                    </div>

                    <div class="row model-showdata">
                        <label class="col-md-2">การเปิดเผย</label>
                        <div class="col-md-9 model-detail">
                            <?php if($status == 0 ){ ?>
                                <h4 class="text-success">ไม่ปกปิด ข้อมูลผู้ร้องเรียน</h4>
                            <?php }else{ ?>
                                <h4 class="text-danger">ปกปิด ข้อมูลผู้ร้องเรียน</h4>
                            <?php }?>
                        </div>
                    </div>

                    <div class="row model-showdata">
                        <label class="col-md-2">ชื่อ-นามสกุล<span class="input-validation">*</span></label>
                        <div class="col-md-9 model-detail"><?=$fname?> <?=$lname?></div>
                    </div>
                    <div class="row model-showdata">
                        <label class="col-md-2">เพศ<span class="input-validation">*</span> :</label>
                        <div class="col-md-9 model-detail"><?php if($sex==1){ echo "ชาย"; }else if($sex==2){ echo"หญิง";} ?></div>
                    </div>
                    <div class="row model-showdata">
                        <label class="col-md-2">รหัสประจำตัวประชาชน<span class="input-validation">*</span> :</label>
                        <div class="col-md-9 model-detail"><?=$idcard?></div>
                    </div>
                    <div class="row model-showdata">
                        <label class="col-md-2">อาชีพ<span class="input-validation">*</span> :</label>
                        <div class="col-md-9 model-detail"><?=$work?></div>
                    </div>
                    <div class="row model-showdata">
                        <label class="col-md-2">ที่อยู่<span class="input-validation">*</span> :</label>
                        <div class="col-md-10 model-detail"><?=$address?> <?=$addressfull?></div>
                    </div>
                    <div class="row model-showdata">
                        <label class="col-md-2">เบอร์โทร :</label>
                        <div class="col-md-3 model-detail"><?=$tel?></div>
                        <label class="col-md-3">เบอร์โทรศัพท์ :</label>
                        <div class="col-md-4 model-detail"><?=$phone?></div>
                    </div>
                    <div class="row model-showdata">
                        <label class="col-md-2">Email :</label>
                        <div class="col-md-10 model-detail"><?=$email?></div>
                    </div>

                    <div class="title-show">
                        <div class="row pl-4">
                            <div class="col-12 text-center">
                            ข้อมูลเกี่ยวกับเรื่องร้องเรียน
                            </div>
                        </div>
                    </div>
                    <div class="row model-showdata">
                        <label class="col-md-2">ร้องเรียนถึง :</label>
                        <div class="col-md-10 model-detail"><?=$office_name?></div>
                    </div>
                    <div class="row model-showdata">
                        <label class="col-md-2">ประเภทเรื่องร้องเรียน :</label>
                        <div class="col-md-10 model-detail"><?=$complain_type?> 
                            <?php if($complaint_sub){?>
                            (<?=$sub_name['name']?>)
                            <?php }?>
                        </div>
                    </div>
                    <div class="row model-showdata">
                        <label class="col-md-2">หัวข้อเรื่องร้องเรียน :</label>
                        <div class="col-md-10 model-detail"><?=$name?></div>
                    </div>
                    <?php if($type > 1){?>
                    <div class="row model-showdata">
                        <label class="col-md-2">วันที่ร้องเรียน :</label>
                        <div class="col-md-10 model-detail"><?=$show_date_add?></div>
                    </div>
                    <?php }?>

                    <div class="row model-showdata">
                        <label class="col-md-2">รายละเอียดเรื่องร้องเรียน :</label>
                        <div class="col-md-10 model-detail"><?=$description?></div>
                    </div>
                    <div class="row model-showdata">
                        <label class="col-md-2">สิ่งที่ต้องการแก้ไข :</label>
                        <div class="col-md-10 model-detail"><?=$improvement?></div>
                    </div>
                    <div class="row model-showdata">
                        <label class="col-md-2">เอกสารประกอบ :</label>
                        <div class="col-md-10 model-detail">
                            <?php if($files){
                                echo "<a href='".base_url()."assets/files/".$files."' target=\"_blank\">".$files."</a>";
                            }else{
                                echo "<spna class='text-danger'>ไม่มี </spna>";
                            }?>
                        </div>
                    </div>


                    <?php if($type == 5 || $type == 6){?>
                        <div class="row model-showdata">
                            <label class="col-md-2">ข้อความการตอบ-แก้ไข ข้อร้องเรียน :</label>
                            <div class="col-md-10 model-detail"><?=$answer_detail?></div>
                        </div>
                        <div class="row model-showdata">
                            <label class="col-md-2">ไฟล์เอกสารแนบ  :</label>
                            <div class="col-md-10 model-detail">
                                <?php if($files){
                                    echo "<a href='".base_url()."assets/files/".$answer_file."' target=\"_blank\">".$answer_file."</a>";
                                }else{
                                    echo "<spna class='text-danger'>ไม่มี </spna>";
                                }?>
                            </div>
                        </div>
                    <?php }else if($type == 4){?>
                        <div class="row model-showdata">
                            <div class="col-md-12 text-center">
                                <h4 class="text-danger mt-3">รอหน่วยดำเนินการ ตอบ-แก้ไขข้อร้องเรียน</h4>
                            </div>
                        </div>
                    <?php }else{?>
                        <!-- <div class="row model-showdata">
                            <div class="col-md-12 text-center">
                                <h4 class="text-danger mt-3">อยู่ระหว่างดำเนินการ</h4>
                            </div>
                        </div> -->
                    <?php }?>

                    <div class="title-show mt-4">
                        <div class="row pl-4">
                            <div class="col-12">
                            <?php if(count($log) == 0){?>
                                <span class="text-danger">ยังไม่ดำเนินการ</span>
                            <?php }else{?>
                                <span class=" "><?=count($log)?> การดำเนินการ</span>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row pl-4">
                        <?php foreach($log as $k => $v){?>
                            <div class="col-12 mt-2">
                                <div class="show-border">
                                    <p class="text-warning-custom"><?=$v['user_name']?></p>
                                    <div class="log-detail pl-2">
                                        <?php if($v['type'] == 1){?>
                                            <span>แจ้งกลับ/ยกเลิก ข้อร้องเรียน <small> (เจ้าหน้าที่ศูนย์รับเรื่องร้องเรียน)</small></span>
                                        <?php }else if($v['type'] == 2){?>
                                            <span>ส่งข้อร้องเรียนให้ หน่วยกำกับดูแล ชื่อหน่วย : <?=$unit_name?><small> (เจ้าหน้าที่ศูนย์รับเรื่องร้องเรียน)</small> </span>
                                            <?php if(!empty($send_comm)){?>
                                            <div class="pl-3">คำสั่งการ : <?=$send_comm?></div>
                                            <div class="pl-3">
                                            เอกสารสั่งการ : 
                                                <?php if($send_files){
                                                    echo "<a href='".base_url()."assets/files/".$send_files."' target=\"_blank\">".$send_files."</a>";
                                                }else{
                                                    echo "<spna class='text-danger'>ไม่มี </spna>";
                                                }?>
                                            </div>
                                            <?php }?>
                                        <?php }else if($v['type'] == 3){?>
                                            <span>หน่วยกำกับดูแลรับเรื่องร้องเรียน </span>
                                            <?php if($type == 4 ){?>
                                                <button type="button" class="btn btn-info btn-sm" onclick="sendComment('<?=$token?>')">สอบถามการดำเนินการ</button>
                                            <?php } ?>
                                        <?php }else if($v['type'] == 4){?>
                                            <span>หน่วยกำกับดูแล บันทึกการแก้ไขเรื่องร้องเรียน </span>
                                            <div class="pl-3">รายละเอียด : <?=$answer_detail?></div>
                                            <div class="pl-3">
                                            เอกสารแนบ : 
                                                <?php if($answer_file){
                                                    echo "<a href='".base_url()."assets/files/".$answer_file."' target=\"_blank\">".$answer_file."</a>";
                                                }else{
                                                    echo "<spna class='text-danger'>ไม่มี </spna>";
                                                }?>
                                            </div>
                                        <?php }else if($v['type'] == 5){?>
                                            <span>ศูนย์รับเรื่อง ยุติเรื่องร้องเรียน <small> (เจ้าหน้าที่ศูนย์รับเรื่องร้องเรียน)</small></span>
                                        <?php }else if($v['type'] == 6){?>
                                            <span>ศูนย์รับเรื่อง สอบถามการดำเนินการ <small> (เจ้าหน้าที่ศูนย์รับเรื่องร้องเรียน)</small></span>
                                            <?php if(isset($v['ask_unit'])){?>
                                                <div class="pl-4"><span class="text-info"><i class="fas fa-question-circle"></i> ข้อซักถาม : </span><?=$v['ask_unit']?></div>
                                                <div class="pl-4 mb-2">เวลา : <?=$v['date_ask']?> <?=$v['time_ask']?></div>
                                                
                                                <?php if($v['comment_type'] == 2){?>
                                                    <div class="pl-4"><span class="text-info"><i class="fas fa-university"></i> คำตอบจากหน่วย : </span><?=$v['comment_unit']?></div>
                                                    <div class="pl-4 mb-2">เวลา : <?=$v['date_com']?> <?=$v['time_com']?></div>
                                                <?php }else{?>
                                                    <div class="pl-4 mb-2"><span class="text-info"><i class="fas fa-university"></i> คำตอบจากหน่วย : </span><span class="text-danger">หน่วยยังไม่ตอบข้อซักถาม...</span></div>
                                                <?php }?>
                                            <?php }?>

                                            
                                        <?php }else if($v['type'] == 7){?>
                                            <span>แจ้งกลับ/ยกเลิก ข้อร้องเรียน <small> (เจ้าหน้าที่ศูนย์รับเรื่องร้องเรียน)</small></span>
                                        <?php }else if($v['type'] == 8){?>
                                            <span>เรียกข้อร้องเรียนกลับมาใช้งาน <small> (เจ้าหน้าที่ศูนย์รับเรื่องร้องเรียน)</small></span>
                                        <?php }?>
                                    </div>
                                    <div class="log-date pl-2 ">
                                        <div class="pl-3"><i class="far fa-clock"></i> <?=$v['date_add']?> <?=substr($v['date_time'],11,5)?> น.</div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </div>

                    <div>
                </div>
                            <style>
                            .show-border{
                                border: 1px solid #eee;
                                padding: 16px 6px 8px 16px;
                                font-size: 14px;
                            }
                            .text-warning-custom{
                                color: #007bff;
                            }
                            </style>
                <div class="col-12">
                    <div class="text-center mt-3 mb-4">
                        <button onclick="BackPage()" type="button" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> ย้อนกลับ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="showModel"></div>

<script src="<?=base_url()?>../assets/bootstrap/js/sweetalert.min.js"></script>
<link href="<?=base_url()?>../assets/bootstrap/css/sweetalert.css" rel="stylesheet">
<script>
function sendComment(token){
    $( ".showModel" ).load( "<?php echo base_url() ?>manage/sendcomment?token="+token);
}
</script>
<?php include_once("_inc_footer.php");?>


