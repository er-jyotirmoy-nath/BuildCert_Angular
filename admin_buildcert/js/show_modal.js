	$(document.body).on("click",".open-addtmv2",function(){
		tmv2show = [];
		tmv2show[0] = "ok";
		tmv2show[1] = "1";
		tmv2show[2] = "show";
		$.ajax({
			url: "ajax_191220161212.php",
			method: "post",
			data: {tmv2show:tmv2show},
			beforeSend:function(n){$("#tmv2_add_res").html("<span style=\"text-align:center;margin-left:0px;margin-right:0px;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
			afterSend:function(n){$("#tmv2_add_res").html("<span style=\"text-align:center;margin-left:0px;margin-right:0px;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
			success:function(data){
				$("#tmv2_add_res").html(data);
				}
			

			});
		});
	
	$(document.body).on("click",".open-addtmv3",function(){
		tmv3show = [];
		tmv3show[0] = "ok";
		tmv3show[1] = "1";
		tmv3show[2] = "show";
		$.ajax({
			url: "ajax_191220161212.php",
			method: "post",
			data: {tmv3show:tmv3show},
			beforeSend:function(n){$("#tmv3_add_res").html("<span style=\"text-align:center;margin-left:0px;margin-right:0px;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
			afterSend:function(n){$("#tmv3_add_res").html("<span style=\"text-align:center;margin-left:0px;margin-right:0px;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
			success:function(data){
				$("#tmv3_add_res").html(data);
				}
			

			});
		});
	
	$(document.body).on("click",".open-addcias",function(){
		cias_show = [];
		cias_show[0] = "ok";
		cias_show[1] = "1";
		cias_show[2] = "show";
		$.ajax({
			url: "ajax_191220161212.php",
			method: "post",
			data: {cias_show:cias_show},
			beforeSend:function(n){$("#cias_add_res").html("<span style=\"text-align:center;margin-left:0px;margin-right:0px;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
			afterSend:function(n){$("#cias_add_res").html("<span style=\"text-align:center;margin-left:0px;margin-right:0px;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
			success:function(data){
				$("#cias_add_res").html(data);
				}
			

			});
		});
	
	$(document.body).on("click",".open-addbuildcert",function(){
             $("#buildcert_res").html("");
                
		build_show = [];
		build_show[0] = "ok";
		build_show[1] = "1";
		build_show[2] = "show";
		$.ajax({
			url: "ajax_191220161212.php",
			method: "post",
			data: {build_show:build_show},
			beforeSend:function(n){$("#buildcert_add_res").html("<span style=\"text-align:center;margin-left:0px;margin-right:0px;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
			afterSend:function(n){$("#buildcert_add_res").html("<span style=\"text-align:center;margin-left:0px;margin-right:0px;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
			success:function(data){
				$("#buildcert_add_res").html(data);
                                $("#dtc_mfc").focus();
				}
			

			});
		});
                
                $(document.body).on("click",".open-adddtc",function(){
                    $("#dtc_res").html("");
		dtc_show = [];
		dtc_show[0] = "ok";
		dtc_show[1] = "1";
		dtc_show[2] = "show";
		$.ajax({
			url: "ajax_191220161212.php",
			method: "post",
			data: {dtc_show:dtc_show},
			beforeSend:function(n){$("#dtc_add_res").html("<span style=\"text-align:center;margin-left:0px;margin-right:0px;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
			afterSend:function(n){$("#dtc_add_res").html("<span style=\"text-align:center;margin-left:0px;margin-right:0px;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
			success:function(data){
				$("#dtc_add_res").html(data);
				}
			

			});
		});