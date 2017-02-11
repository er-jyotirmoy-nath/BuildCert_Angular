$(document.body).on("click","#updatecias",function(){
                $("#cias_update_res").html("");
              
		updbuild = [];
		updbuild[0] = $("#cias_mfc").val();
		updbuild[1] = $("#cias_desc").val();
		updbuild[2] = $("#cias_sizes").val();
		updbuild[3] = $("#cias_certid2").val();
		updbuild[4] = $("#cias_certid1").val()+$("#cias_certid2").val()+"/"+$("#cias_certid3").val();
		updbuild[5] = "cias";
                updbuild[6] = $("#build_app_id").val();
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
    $("#pdcert_update_res").html("");
	updbuild = [];
	updbuild[0] = $("#pdcert_company").val();
	updbuild[1] = $("#pdcert_specification").val();
	updbuild[2] = $("#pdcert_description").val();
	updbuild[3] = $("#pdcert_certid2").val();
	updbuild[4] = $("#pdcert_certid1").val()+$("#pdcert_certid2").val()+"/"+$("#pdcert_certid3").val();
	updbuild[5] = "pdcert";
	updbuild[6] = $("#pdcert_expiry_d").val();
	updbuild[7] = $("#build_app_id_pdcert").val(); 
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
$(document.body).on("click","#updatedtc",function(){
    $("#dtc_update_res").html("");
	updbuild = [];
	updbuild[0] = $("#dtc_mfc").val();
	updbuild[1] = $("#dtc_app_valve").val();
	updbuild[2] = $("#dtc_desc").val();
	updbuild[3] = $("#dtc_unique").val();
	updbuild[4] = $("#dtc_certid2").val()
	updbuild[5] = "dtc";
        updbuild[6] = $("#dtc_certid1").val()+$("#dtc_certid2").val()+"/"+$("#dtc_certid3").val();
	updbuild[7] = $("#dtc_expiry").val();
        updbuild[8] = $("#dtc_build_app_id").val();
	
	$.ajax({
		url :"ajax_191220161212.php",
		method: "POST",
		data: {updbuild:updbuild},
		beforeSend:function(msg){$("#dtc_update_res").html("Saving..");},
		afterSend:function(msg){$("#dtc_update_res").html("Saving..");},
		success:function(msg){
			$("#dtc_update_res").html(msg);

		}

	});
});
$(document.body).on("click","#updatetmv2",function(){
    $("#tmv2_update_res").html("");
	updbuild = [];
	
	updbuild[0] = $("#Manufacturer").val();
	updbuild[1] = $("#build_app_id").val();
	updbuild[2] = "cert";
	updbuild[3] = "cert";
	updbuild[4] = "cert";
	updbuild[5] = "tmv2";
	updbuild[6] = ($("#HP_1111").is(':checked'))?"1":"0";
	updbuild[7] =  ($("#HPB").is(':checked'))?"1":"0";
	updbuild[8] = $("#HPB_comment").val();
	updbuild[9] =  ($("#HPS").is(':checked'))?"1":"0";
	updbuild[10] = $("#HPS_comment").val();
	updbuild[11] =  ($("#HPW").is(':checked'))?"1":"0";
	updbuild[12] = $("#HPW_comment").val();
	updbuild[13] =  ($("#HPT").is(':checked'))?"1":"0";
	updbuild[14] = $("#HPT_comment").val();
	updbuild[15] =  ($("#Cold_isol_46_hp").is(':checked'))?"1":"0";
	updbuild[16] =  ($("#LP_1287").is(':checked'))?"1":"0";
	updbuild[17] =  ($("#LPB").is(':checked'))?"1":"0";
	updbuild[18] = $("#LPB_comment").val();
	updbuild[19] =  ($("#LPS").is(':checked'))?"1":"0";
	updbuild[20] = $("#LPS_comment").val();
	updbuild[21] =  ($("#LPW").is(':checked'))?"1":"0";
	updbuild[22] = $("#LPW_comment").val();
	updbuild[23] =  ($("#LPT").is(':checked'))?"1":"0";
	updbuild[24] = $("#LPT_comment").val();
	updbuild[25] =  ($("#LPTx").is(':checked'))?"1":"0";
	updbuild[26] = $("#LPTx_comment").val();
	updbuild[27] =  ($("#Cold_isol_46_lp").is(':checked'))?"1":"0";
	updbuild[28] = $("#Comments").val();
	updbuild[29] = $("#Extended_Comments").val();
	updbuild[30] = $("#Primary_or_Secondary").val();
	updbuild[31] = $("#First_Audit").val();
	updbuild[32] = $("#First_Completed").val();
	updbuild[33] = $("#Second_Audit").val();
	updbuild[34] = $("#Second_Completed").val();
	updbuild[35] = ($("#Discontinued_Withdrawn").is(':checked'))?"1":"0";
	updbuild[36] = ($("#Remove_from_Website").is(':checked'))?"1":"0";
	updbuild[37] = ($("#New").is(':checked'))?"1":"0";
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
$(document.body).on("click","#updatetmv3",function(){
    $("#tmv3_update_res").html("");
	updbuild = [];	
	updbuild[0] = $("#TMV3_Factor").val();
	updbuild[1] = $("#TMV3_Manufacturer").val();
	updbuild[2] = "cert";
	updbuild[3] = "cert";
	updbuild[4] = "cert";
	updbuild[5] = "tmv3";
	updbuild[6] = $("#TMV3_Approved_Mixing_Valve").val();
	updbuild[7] = $("#TMV3_Unique_ID").val();
	updbuild[8] = ($("#TMV3_HPB").is(':checked'))?"1":"0";
	updbuild[9] = $("#TMV3_HPB_comment").val();
	updbuild[10] = ($("#TMV3_HPS").is(':checked'))?"1":"0";
	updbuild[11] = $("#TMV3_HPS_comment").val();
	updbuild[12] = ($("#TMV3_HPW").is(':checked'))?"1":"0";
	updbuild[13] = $("#TMV3_HPW_comment").val();
	updbuild[14] = ($("#TMV3_HPT44").is(':checked'))?"1":"0";
	updbuild[15] = $("#TMV3_HPT44_comment").val();
	updbuild[16] = ($("#TMV3_HPT46").is(':checked'))?"1":"0";
	updbuild[17] = $("#TMV3_HPT46_comment").val();
	updbuild[18] = ($("#TMV3_HPD44").is(':checked'))?"1":"0";
	updbuild[19] = $("#TMV3_HPD44_comment").val();
	updbuild[20] = ($("#TMV3_HPD46").is(':checked'))?"1":"0";
	updbuild[21] = $("#TMV3_HPD46_comment").val();
	updbuild[22] = ($("#TMV3_LPB").is(':checked'))?"1":"0";
	updbuild[23] = $("#TMV3_LPB_comment").val();
	updbuild[24] = ($("#TMV3_LPS").is(':checked'))?"1":"0";
	updbuild[25] = $("#TMV3_LPS_comment").val();
	updbuild[26] = ($("#TMV3_LPW").is(':checked'))?"1":"0";
	updbuild[27] = $("#TMV3_LPW_comment").val();
	updbuild[28] = ($("#TMV3_LPT44").is(':checked'))?"1":"0";
	updbuild[29] = $("#TMV3_LPT44_comment").val();
	updbuild[30] = ($("#TMV3_LPT46").is(':checked'))?"1":"0";
	updbuild[31] = $("#TMV3_LPT46_comment").val();
	updbuild[32] = ($("#TMV3_LPD44").is(':checked'))?"1":"0";
	updbuild[33] = $("#TMV3_LPD44_comment").val();
	updbuild[34] = ($("#TMV3_LPD46").is(':checked'))?"1":"0";
	updbuild[35] = $("#TMV3_LPD46_comment").val();
	updbuild[36] = $("#TMV3_Comments").val();
	updbuild[37] = $("#TMV3_Extended_Comments").val();
	updbuild[38] = $("#TMV3_Pts_Comments").val();
	updbuild[39] = $("#TMV3_Primary_or_Secondary").val();
	updbuild[40] = $("#TMV3_First_Audit").val();
	updbuild[41] = $("#TMV3_First_Completed").val();
        updbuild[42] = $("#TMV3_Second_Audit").val();
	updbuild[43] = $("#TMV3_Second_Completed").val();
	updbuild[44] = ($("#TMV3_Discontinued_Withdrawn").is(':checked'))?"1":"0";
        updbuild[45] = ($("#TMV3_Remove_from_Website").is(':checked'))?"1":"0";
	updbuild[46] = ($("#TMV3_New").is(':checked'))?"1":"0";
	updbuild[47] = $("#TMV3_Expiry_Date").val();
        updbuild[48] = $("#TMV3_build_app_id").val();
	$.ajax({
		url :"ajax_191220161212.php",
		method: "POST",
		data: {updbuild:updbuild},
		beforeSend:function(msg){$("#tmv3_update_res").html("Saving..");},
		afterSend:function(msg){$("#tmv3_update_res").html("Saving..");},
		success:function(msg){
			$("#tmv3_update_res").html(msg);

		}

	});
});