$(document.body).on("click","#add_cias",function(){
		
		insbuildcert = [];
		insbuildcert[0] = $("#cias_mfc").val();
		insbuildcert[1] = $("#cias_desc").val();
		insbuildcert[2] = $("#cias_sizes").val();
		insbuildcert[3] = "cias";
		insbuildcert[4] = $("#cias_certnum").val();
		insbuildcert[5] = $("#timestamp").val();
		insbuildcert[6] = $("#cias_certid").val();
		$.ajax({
			url: "ajax_191220161212.php",
			method: "post",
			data: {insbuildcert:insbuildcert},
			beforeSend:function(n){$("#cias_res").html("Working...");},
			afterSend:function(n){$("#cias_res").html("Working...");},
			success:function(data){
				if(data == 'Ok')$("#cias_res").html("Done");else $("#cias_res").html(data);
				}
			

			});
		});


$(document.body).on("click","#add_buildcert",function(){
	
	insbuildcert = [];
	insbuildcert[0] = $("#pdcert_company").val();
	insbuildcert[1] = $("#pdcert_specification").val();
	insbuildcert[2] = $("#pdcert_description").val();
	insbuildcert[3] = "pdcert";
	insbuildcert[4] = $("#pdcert_cert_no").val();
	insbuildcert[5] = $("#pdcert_expiry_d").val();
	insbuildcert[6] = $("#pdcert_timestamp").val();
	insbuildcert[7] = $("#pdcert_certid").val();
	$.ajax({
		url: "ajax_191220161212.php",
		method: "post",
		data: {insbuildcert:insbuildcert},
		beforeSend:function(n){$("#buildcert_res").html("Working...");},
		afterSend:function(n){$("#buildcert_res").html("Working...");},
		success:function(data){
			if(data == 'Ok')$("#buildcert_res").html("Done");else $("#buildcert_res").html(data);
			}
		

		});
	});


$(document.body).on("click","#add_tmv2",function(){
    //alert("");
	insbuildcert = [];
	insbuildcert[1] = $("#licensee").val();
	insbuildcert[2] = $("#Manufacturer").val();
	insbuildcert[3] = $("#type_app").val();
	insbuildcert[4] = $("#Unique_ID").val();
	insbuildcert[5] = $("#certnumber").val();
	insbuildcert[6] = $("#certdate").val();
	insbuildcert[7] = $("#HP_1111").val();
	insbuildcert[8] = $("#HPB").val();
	insbuildcert[9] = $("#HPB_comment").val();
	insbuildcert[10] = $("#HPS").val();
	insbuildcert[11] = $("#HPS_comment").val();
	insbuildcert[12] = $("#HPW").val();
	insbuildcert[13] = $("#HPW_comment").val();
	insbuildcert[14] = $("#HPT").val();
	insbuildcert[15] = $("#HPT_comment").val();
	insbuildcert[16] = $("#Cold_isol_46_hp").val();
	insbuildcert[17] = $("#LP_1287").val();
	insbuildcert[18] = $("#LPB").val();
	insbuildcert[19] = $("#LPB_comment").val();
	insbuildcert[20] = $("#LPS").val();
	insbuildcert[21] = $("#LPS_comment").val();
	insbuildcert[22] = $("#LPW").val();
	insbuildcert[23] = $("#LPW_comment").val();
	insbuildcert[24] = $("#LPT").val();
	insbuildcert[25] = $("#LPT_comment").val();
	insbuildcert[26] = $("#LPTx").val();
	insbuildcert[27] = $("#LPTx_comment").val();
	insbuildcert[28] = $("#Cold_isol_46_lp").val();
	insbuildcert[29] = $("#Comments").val();
	insbuildcert[30] = $("#Extended_Comments").val();
	insbuildcert[31] = $("#Pts_Comments").val();
	insbuildcert[32] = $("#Primary_or_Secondary").val();
	insbuildcert[33] = $("#First_Audit").val();
	insbuildcert[34] = $("#First_Completed").val();
	insbuildcert[35] = $("#Second_Audit").val();
	insbuildcert[36] = $("#Second_Completed").val();
	insbuildcert[37] = $("#Discontinued_Withdrawn").val();
	insbuildcert[38] = $("#Remove_from_Website").val();
	insbuildcert[39] = $("#New").val();
	insbuildcert[40] = $("#Expiry_Date").val();
	insbuildcert[41] = $("#Approved_Mixing_Valve").val();
	insbuildcert[42] = $("#Certificate_Letters").val();
	insbuildcert[43] = $("#Cert_id").val();
	$.ajax({
		url: "ajax_191220161212.php",
		method: "post",
		data: {insbuildcert:insbuildcert},
		beforeSend:function(n){$("#res_tmv2").html("Working..");},
		afterSend:function(n){$("#res_tmv2").html("Working..");},
		success:function(data){
		    $("#res_tmv2").html(data);
			//if(data == "Ok")$("#res_tmv2").html("Success");	else $("#res_tmv2").html("Failure");	
			
			}
		

		});
	}); 