$("#filter").click(function(){
		var fil = $("#type_filter").val();
		filter = [];
		filter[0] = fil ;
		filter[1] = "filter";
		filter[2] = "Ok";
		$.ajax({
			url: "ajax_191220161212.php",
			method: "POST",
			data: {filter:filter},
			beforeSend: function(msg){
				$("#getdatatable").html("<i class=\"fa fa-spinner fa-pulse fa-2x fa-fw\"></i><span class=\"sr-only\">Loading...</span> Loading...");
				},
			afterSend: function(msg){
				$("#getdatatable").html("<i class=\"fa fa-spinner fa-pulse fa-2x fa-fw\"></i><span class=\"sr-only\">Loading...</span> Loading...");

							},
			success: function(data){
				$("#getdatatable").html(data);
				$('#example').DataTable();
				}
			});
		
		});

$("#login").click(function(){
	var uname = $("#uname").val();
	var psw = $("#psw").val();
	login = [];
	login[0] = uname;
	login[1] = psw;
	login[2] = "login";
	$.ajax({
		url: "ajax_191220161212.php",
		method: "post",
		data: {login:login},
		beforeSend:function(msg){$("#button").html("<span class=\"glyphicon glyphicon-refresh glyphicon-refresh-animate\"></span> Working...");},
		afterSend:function(msg){$("#button").html("<span class=\"glyphicon glyphicon-refresh glyphicon-refresh-animate\"></span> Working...");},
		success:function(msg){
			if(msg == "Ok"){ window.location.replace("admin.php");}
			}
		});
	});

$("#logout").click(function(){
	login=[];
	login[0]="logu";
	login[1]="logp";
	login[2]="logout";
	$.ajax({
		url:"ajax_191220161212.php",
		method:"post",
		data:{login:login},
		success:function(data){
			if(data=="Ok"){window.location.replace("admin.php");}
			}
		});
	});