$(document.body).on("click",".open-editbuildcert",function(){
                 $("#pdcert_update_res").html("");
	
		var certnum = $(this).data('certnum');
		pdcert_data = [];
		pdcert_data[0] = "Ok";
		pdcert_data[1] = "set";
		pdcert_data[2] = certnum;
		$.ajax({
			url: "ajax_191220161212.php",
			method: "post",
			data: {pdcert_data:pdcert_data},
			beforeSend:function(n){$("#pdcert_get_res").html("<span style=\"text-align:center;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
			afterSend:function(n){$("#pdcert_get_res").html("<span style=\"text-align:center;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
			success:function(data){
				$("#pdcert_get_res").html(data);
                                 $('[data-toggle="tooltip"]').tooltip(); 
				}
			});
		});

$(document.body).on("click",".open-editcias",function(){
	var certnum = $(this).data('cias');
	cias_data = [];
	cias_data[0] = "Ok";
	cias_data[1] = "set";
	cias_data[2] = certnum;
        cias_data[3] = "cias";
	$.ajax({
		url: "ajax_191220161212.php",
		method: "post",
		data: {cias_data:cias_data},
		beforeSend:function(n){$("#cias_get_res").html("<span style=\"text-align:center;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
		afterSend:function(n){$("#cias_get_res").html("<span style=\"text-align:center;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
		success:function(data){
			$("#cias_get_res").html(data);
                        $('[data-toggle="tooltip"]').tooltip(); 
			}
		
		});
	});
$(document.body).on("click",".open-editdtc",function(){
        $("#dtc_update_res").html("");
	var certnum = $(this).data('dtc');
	dtc_data = [];
	dtc_data[0] = "Ok";
	dtc_data[1] = "set";
	dtc_data[2] = certnum;
        dtc_data[3] = "dtc";
	$.ajax({
		url: "ajax_191220161212.php",
		method: "post",
		data: {dtc_data:dtc_data},
		beforeSend:function(n){$("#dtc_get_res").html("<span style=\"text-align:center;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
		afterSend:function(n){$("#dtc_get_res").html("<span style=\"text-align:center;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
		success:function(data){
			$("#dtc_get_res").html(data);
                        $('[data-toggle="tooltip"]').tooltip(); 
			}
		
		});
	});
$(document.body).on("click",".open-edittmv2",function(){
	var certid = $(this).data('id');
	tmv2data = [];
	tmv2data[0] = certid;
	tmv2data[1] = "certdate";
	tmv2data[2] = "certnum";
	tmv2data[3] = "get";
	$.ajax({
		url: "ajax_191220161212.php",
		method: "post",
		data: {tmv2data:tmv2data},
		beforeSend:function(n){$("#tmv2_get_res").html("<span style=\"text-align:center;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
		afterSend:function(n){$("#tmv2_get_res").html("<span style=\"text-align:center;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
		success:function(data){
			$("#tmv2_get_res").html(data);
			}
		
		});
	});
$(document.body).on("click",".open-edittmv3",function(){
   
	var certid = $(this).data('id');
	tmv3data = [];
	tmv3data[0] = certid;
	tmv3data[1] = "certdate";
	tmv3data[2] = "certnum";
	tmv3data[3] = "show";
	$.ajax({
		url: "ajax_191220161212.php",
		method: "post",
		data: {tmv3data:tmv3data},
		beforeSend:function(n){$("#tmv3_get_res").html("<span style=\"text-align:center;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
		afterSend:function(n){$("#tmv3_get_res").html("<span style=\"text-align:center;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
		success:function(data){
			$("#tmv3_get_res").html(data);
			}
		
		});
	});