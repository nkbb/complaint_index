<?php


if($gd['tag']){
			
				if($gd['tag'] and !$gd['sub']){
					$c_data = $tags_db->selone("name","where ind = '$gd[tag]'");
					$data['showtitle'] = $c_data['name'];
				}else if($gd['tag'] and $gd['sub']){
					$c_data = $tagsub_db->selone("name","where ind = '$gd[sub]'");
					$data['showtitle'] = $c_data['name'];
				}

			if($gd['page']=='1' or !$gd['page']){
				$start = 0;
				$end = 25;
				$page = 1;
			}else{
				$start = ($gd['page']-1)*25;
				$end = 25;
				$page = $gd['page'];
			}

			$wh = "";
			$limit = "limit $start,$end";
			$ct['count'] = $count['ct'];
			$ct['page'] = $page;
			$data['ct'] = $ct;

?>
<script>
	function doPaging(currentPageInput) {
	$("#page_nav").val("");
		var count = "<?=$ct['count']?>";
		if(count >= 1){
			var currentPage = currentPageInput, // input
				range       = 25,  // amount of links displayed 
				start       = 1;  // default
			var totalPages  = Math.floor(count / 25)+1;

			if(totalPages < range){
				range = totalPages;
			}
			//if(total

			var html = "";      // output variable

			// Don't use negative values, force start at 1
			if (currentPage < (range / 2) + 1 ) {
				start = 1;

			// Don't go beyond the last page 
			} else if (currentPage >= (totalPages - (range / 2) )) {
				start = Math.floor(totalPages - range + 1);

			} else {
				start = (currentPage - Math.floor(range / 2));
			}

			if(currentPage > 1){
				var back = currentPage-1;
				html += "<li><a href=\"javascript:goPage('"+back+"')\">«</a></li>";
			}

			for (var i = start; i <= ((start + range) - 1); i++) {
				if (i == currentPage) {
					//paging.push(`[${i}]`); // add brackets to indicate current page 
					html+= "<li class='active'><a href='#'>"+i+"</a></li>";
				} else {
					//paging.push(i.toString());			
					html+= "<li><a href=\"javascript:goPage('"+i+"')\">"+i+"</a></li>";
				}
			}

			if(currentPage < totalPages){
				var next = Math.floor(currentPage) + 1;
				html += "<li><a href=\"javascript:goPage('"+next+"')\">»</a></li>";
			}
			//return paging;
			$("#page_nav").html(html);
		}
	}


	function goPage(page){
		$("#page").val(page);
		$("#myForm").submit();
	}

	function ResearchData(){
		$("#s_author").val("");
		$("#s_name").val("");
		$("#page").val(1);
		$("#myForm").submit();
	}

	function searchData(){
		$("#page").val("1");
		$("#myForm").submit();
		
	}
</script>