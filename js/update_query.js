$(document.body).on("click","#updatecias",function(){
		updbuild = [];
		updbuild[0] = $("#cias_mfc").val();
		updbuild[1] = $("#cias_desc").val();
		updbuild[2] = $("#cias_sizes").val();
		updbuild[3] = $("#cias_certnum").val();
		updbuild[4] = $("#cias_certid").val();
		updbuild[5] = "cias";
		$.ajax({
			url :"ajax_191220161212.php",
			method: "POST",
			data: {updbuild:updbuild},
			beforeSend:function(msg){$("#cias_update_res").html("Saving..");},
			afterSend:function(msg){$("#cias_update_res").html("Saving..");},
			success:function(msg){
				$("#cias_update_res").html(msg);

			}

		});
	});

$(document.body).on("click","#updatepdcert",function(){
	updbuild = [];
	updbuild[0] = $("#pdcert_company").val();
	updbuild[1] = $("#pdcert_specification").val();
	updbuild[2] = $("#pdcert_description").val();
	updbuild[3] = $("#pdcert_cert_no").val();
	updbuild[4] = $("#pdcert_certid").val();
	updbuild[5] = "pdcert";
	updbuild[6] = $("#pdcert_expiry_d").val();
	
	$.ajax({
		url :"ajax_191220161212.php",
		method: "POST",
		data: {updbuild:updbuild},
		beforeSend:function(msg){$("#pdcert_update_res").html("Saving..");},
		afterSend:function(msg){$("#pdcert_update_res").html("Saving..");},
		success:function(msg){
			$("#pdcert_update_res").html(msg);

		}

	});
});

$(document.body).on("click","#updatetmv2",function(){
	updbuild = [];
	
	updbuild[0] = $("#Manufacturer").val();
	updbuild[1] = $("#certnum").val();
	updbuild[2] = $("#Certificate_Letters").val();
	updbuild[3] = $("#certdate").val();
	updbuild[4] = $("#cert_id").val();
	updbuild[5] = "tmv2";
	updbuild[6] = $("#HP_1111").val();
	updbuild[7] = $("#HPB").val();
	updbuild[8] = $("#HPB_comment").val();
	updbuild[9] = $("#HPS").val();
	updbuild[10] = $("#HPS_comment").val();
	updbuild[11] = $("#HPW").val();
	updbuild[12] = $("#HPW_comment").val();
	updbuild[13] = $("#HPT").val();
	updbuild[14] = $("#HPT_comment").val();
	updbuild[15] = $("#Cold_isol_46_hp").val();
	updbuild[16] = $("#LP_1287").val();
	updbuild[17] = $("#LPB").val();
	updbuild[18] = $("#LPB_comment").val();
	updbuild[19] = $("#LPS").val();
	updbuild[20] = $("#LPS_comment").val();
	updbuild[21] = $("#LPW").val();
	updbuild[22] = $("#LPW_comment").val();
	updbuild[23] = $("#LPT").val();
	updbuild[24] = $("#LPT_comment").val();
	updbuild[25] = $("#LPTx").val();
	updbuild[26] = $("#LPTx_comment").val();
	updbuild[27] = $("#Cold_isol_46_lp").val();
	updbuild[28] = $("#Comments").val();
	updbuild[29] = $("#Extended_Comments").val();
	updbuild[30] = $("#Primary_or_Secondary").val();
	updbuild[31] = $("#First_Audit").val();
	updbuild[32] = $("#First_Completed").val();
	updbuild[33] = $("#Second_Audit").val();
	updbuild[34] = $("#Second_Completed").val();
	updbuild[35] = $("#Discontinued_Withdrawn").val();
	updbuild[36] = $("#Remove_from_Website").val();
	updbuild[37] = $("#New").val();
	updbuild[38] = $("#Expiry_Date").val();
	updbuild[39] = $("#update").val();
	updbuild[40] = $("#Approved_Mixing_Valve").val();
	updbuild[41] = $("#Unique_ID").val();
	updbuild[42] = $("#licensee").val();
	$.ajax({
		url :"ajax_191220161212.php",
		method: "POST",
		data: {updbuild:updbuild},
		beforeSend:function(msg){$("#tmv2_update_res").html("Saving..");},
		afterSend:function(msg){$("#tmv2_update_res").html("Saving..");},
		success:function(msg){
			$("#tmv2_update_res").html(msg);

		}

	});
});