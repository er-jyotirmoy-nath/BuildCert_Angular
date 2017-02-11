$(document.body).on("click",".open-editbuildcert",function(){
		var certnum = $(this).data('certnum');
		pdcert_data = [];
		pdcert_data[0] = "Ok";
		pdcert_data[1] = "Set";
		pdcert_data[2] = certnum;
		$.ajax({
			url: "ajax_191220161212.php",
			method: "post",
			data: {pdcert_data:pdcert_data},
			beforeSend:function(n){$("#pdcert_get_res").html("<span style=\"text-align:center;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
			afterSend:function(n){$("#pdcert_get_res").html("<span style=\"text-align:center;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
			success:function(data){
				$("#pdcert_get_res").html(data);
				}
			
			});
		});

$(document.body).on("click",".open-editcias",function(){
	var certnum = $(this).data('certnum');
	cias_data = [];
	cias_data[0] = "Ok";
	cias_data[1] = "Set";
	cias_data[2] = certnum;
	$.ajax({
		url: "ajax_191220161212.php",
		method: "post",
		data: {cias_data:cias_data},
		beforeSend:function(n){$("#cias_get_res").html("<span style=\"text-align:center;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
		afterSend:function(n){$("#cias_get_res").html("<span style=\"text-align:center;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
		success:function(data){
			$("#cias_get_res").html(data);
			}
		
		});
	});

$(document.body).on("click",".open-edittmv2",function(){
	var certid = $(this).data('id');
	var certdate = $(this).data('certdate');
	var certnum = $(this).data('certnum');
	tmv2data = [];
	tmv2data[0] = certid;
	tmv2data[1] = certdate;
	tmv2data[2] = certnum;
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