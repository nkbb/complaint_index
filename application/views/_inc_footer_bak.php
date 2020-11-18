<footer class="bs-docs-footer">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="pl-2 pt-3">
          <img src="<?=base_url()?>assets/images/logo_footer.png" style="width: 200px;">
        </div>
      </div>
      <div class="col-md-4">
      </div>
      <div class="col-md-4">
        <div class="bs-docs-footer-links">
          <ul>
            <li><i class="fab fa-facebook-square" style="font-size: 24px; color:#4267b2;"></i></li>
            <li><i class="fab fa-twitter" style="font-size: 24px; color:#1da1f3;"></i></li>
            <li><i class="fab fa-line" style="font-size: 24px; color:#00b900;"></i></li>
            <li><i class="far fa-envelope-open" style="font-size: 24px; color:#007bff;"></i></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
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


</script>
</body>
</html>
