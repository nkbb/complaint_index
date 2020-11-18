  <div class="panel-footer bg-light">
    <div class="container">
      <div class="text-secondary text-center">
        Copyright 2020 ศูนย์รับเรื่องร้องเรียน สำนักงานเลขานุการกรม กรมสุขภาพจิต <br/>
        <span>80/20 หมู่ 4 ถนนติวานนท์ อำเภอเมือง จังหวัดนนทบุรี 11000 | All Rights Reserved.</span>
      </div>
    </div>
  </div>

<script>
function doPaging(currentPageInput,count) {
  $("#page_nav").val("");
    if(count >= 1){
      var currentPage = currentPageInput, 
        range       = 15,  
        start       = 1;  
      var totalPages  = Math.floor(count / 15)+1;

      if(totalPages < range){
        range = totalPages;
      }
     
      var html = "";      
      if (currentPage < (range / 2) + 1 ) {
        start = 1;
      } else if (currentPage >= (totalPages - (range / 2) )) {
        start = Math.floor(totalPages - range + 1);
      } else {
        start = (currentPage - Math.floor(range / 2));
      }

      if(currentPage > 1){
        var back = currentPage-1;
        html += "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:goPage('"+back+"')\" aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a></li>";
      }

      for (var i = start; i <= ((start + range) - 1); i++) {
        if (i == currentPage) {
          html+= "<li class=\"page-item\"><a class=\"page-link active\" href=\"javascript:void()\">"+i+"</a></li>";
        } else {
          html+= "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:goPage('"+i+"')\">"+i+"</a></li>";
        }
      }

      if(currentPage < totalPages){
        var next = Math.floor(currentPage) + 1;
        html += "<li class=\"page-item\"><a class=\"page-link\" href=\"javascript:goPage('"+next+"')\" aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a></li>";
      }
      $("#page_nav").html(html);
      $(".list-count").html(count);
    }
}

function goPage(page){
  $("#page").val(page);
  searchData();
}

function print_complaint(token = ''){

  popup("<?=base_url()?>prints/appeal/"+token);
}

function showmaual($type){
  if($type == 'appeal'){
    popup("<?=base_url()?>assets/files/pdf/web/viewer.html?file=../manual_appeal.pdf");
  }else if($type == 'trace'){
    popup("<?=base_url()?>assets/files/pdf/web/viewer.html?file=../manual_trace.pdf");
  }else if($type == 'unit'){
    popup("<?=base_url()?>assets/files/pdf/web/viewer.html?file=../manual_unit.pdf");
  }else if($type == 'admin'){
    popup("<?=base_url()?>assets/files/pdf/web/viewer.html?file=../manual_admin.pdf");
  }
}

function popup(url) 
{
  params  = 'width=750';
  params += ', height=850';
  params += ', top=10, left=100'
  params += ', fullscreen=yes';
  params += ', menubar=yes';
  params += ', titlebar=yes';
  params += ', toolbar=yes';
  params += ', location=yes';
  params += ', directories=yes';
  params += ', channelmode=yes';
  //params += ', type=fullWindow';
  params += ', scrollbars=yes';

  newwin=window.open(url,'windowname4', params);
  if (window.focus) {newwin.focus()}
  return false;

}

function BackPage(){
  window.history.back()
}

</script>
  </body>
</html>