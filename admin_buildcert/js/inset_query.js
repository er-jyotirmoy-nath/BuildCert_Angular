$(document.body).on("click", "#add_cias", function () {

    insbuildcert = [];
    insbuildcert[0] = $("#cias_mfc1").val();
    insbuildcert[1] = $("#cias_desc1").val();
    insbuildcert[2] = $("#cias_sizes1").val();
    insbuildcert[3] = "cias";
    insbuildcert[4] = $("#cias_certid2").val();
    insbuildcert[5] = $("#timestamp1").val();
    insbuildcert[6] = $("#cias_certid1").val() + " " + $("#cias_certid2").val() + "/" + $("#cias_certid3").val();
    $.ajax({
        url: "ajax_191220161212.php",
        method: "post",
        data: {insbuildcert: insbuildcert},
        beforeSend: function (n) {
            $("#cias_res").html("Working...");
        },
        afterSend: function (n) {
            $("#cias_res").html("Working...");
        },
        success: function (data) {
            if (data == 'Ok') {
                $("#cias_res").html("Done");
                $("#cform")[0].reset();
            } else {
                $("#cias_res").html(data);
                $("#cform")[0].reset();
                $("#cias_mfc").focus();
            }

        }


    });
});
$(document.body).on("click", "#add_dtc", function () {

    insbuildcert = [];
    insbuildcert[0] = $("#dtc_mfc").val();
    insbuildcert[1] = $("#dtc_app_valve").val();
    insbuildcert[2] = $("#dtc_desc").val();
    insbuildcert[3] = "dtc";
    insbuildcert[4] = $("#dtc_unique").val();
    insbuildcert[5] = $("#dtc_certid2").val();
    insbuildcert[6] = $("#dtc_certid1").val() + " " + $("#dtc_certid2").val() + "/" + $("#dtc_certid3").val();
    insbuildcert[7] = $("#dtc_expiry").val();
    $.ajax({
        url: "ajax_191220161212.php",
        method: "post",
        data: {insbuildcert: insbuildcert},
        beforeSend: function (n) {
            $("#dtc_res").html("Working...");
        },
        afterSend: function (n) {
            $("#dtc_res").html("Working...");
        },
        success: function (data) {
            if (data == 'Ok') {
                $("#dtc_res").html("Done");
                $("#dform")[0].reset();
            } else {
                $("#dtc_res").html(data);
                $("#dform")[0].reset();
                $("#dtc_mfc").focus();
            }

        }


    });
});

$(document.body).on("click", "#add_buildcert", function () {
    $("#buildcert_res").html("");
    $("#pdcert_mfc").focus();
    insbuildcert = [];
    insbuildcert[0] = $("#pdcert_mfc").val();
    insbuildcert[1] = $("#pdcert_spc").val();
    insbuildcert[2] = $("#pdcert_dsc").val();
    insbuildcert[3] = "pdcert";
    insbuildcert[4] = $("#pdcert_certid2").val();
    insbuildcert[5] = $("#pdcert_exp_d").val();
    insbuildcert[6] = $("#pdcert_timestamp").val();
    insbuildcert[7] = $("#pdcert_certid1").val() + " " + $("#pdcert_certid2").val() + "/" + $("#pdcert_certid3").val();
    $.ajax({
        url: "ajax_191220161212.php",
        method: "post",
        data: {insbuildcert: insbuildcert},
        beforeSend: function (n) {
            $("#buildcert_res").html("Working...");
        },
        afterSend: function (n) {
            $("#buildcert_res").html("Working...");
        },
        success: function (data) {
            if (data == 'Ok') {
                $("#buildcert_res").html("Done");
            } else {
                $("#buildcert_res").html(data);
                $("#bform")[0].reset();
                $("#pdcert_mfc").focus();
            }
        }


    });
});


$(document.body).on("click", "#add_tmv2", function () {
    //alert("");
    insbuildcert = [];
    insbuildcert[1] = $("#licensee").val();
    insbuildcert[2] = $("#Manufacturer").val();
    insbuildcert[3] = 'tmv2';
    insbuildcert[4] = $("#Unique_ID").val();
    insbuildcert[5] = $("#certnumber").val();
    insbuildcert[6] = $("#certdate").val();
    insbuildcert[7] =  ($("#HP_1111").is(':checked'))?"1":"0";
    insbuildcert[8] = ($("#HPB").is(':checked'))?"1":"0";
    insbuildcert[9] = $("#HPB_comment").val();
    insbuildcert[10] =  ($("#HPS").is(':checked'))?"1":"0";
    insbuildcert[11] = $("#HPS_comment").val();
    insbuildcert[12] = ($("#HPW").is(':checked'))?"1":"0";
    insbuildcert[13] = $("#HPW_comment").val();
    insbuildcert[14] =  ($("#HPT").is(':checked'))?"1":"0";
    insbuildcert[15] = $("#HPT_comment").val();
    insbuildcert[16] =  ($("#Cold_isol_46_hp").is(':checked'))?"1":"0";
    insbuildcert[17] =  ($("#LP_1287").is(':checked'))?"1":"0";
    insbuildcert[18] =  ($("#LPB").is(':checked'))?"1":"0";
    insbuildcert[19] = $("#LPB_comment").val();
    insbuildcert[20] =  ($("#LPS").is(':checked'))?"1":"0";
    insbuildcert[21] = $("#LPS_comment").val();
    insbuildcert[22] =  ($("#LPW").is(':checked'))?"1":"0";
    insbuildcert[23] = $("#LPW_comment").val();
    insbuildcert[24] =  ($("#LPT").is(':checked'))?"1":"0";
    insbuildcert[25] = $("#LPT_comment").val();
    insbuildcert[26] =  ($("#LPTx").is(':checked'))?"1":"0";
    insbuildcert[27] = $("#LPTx_comment").val();
    insbuildcert[28] =  ($("#Cold_isol_46_lp").is(':checked'))?"1":"0";
    insbuildcert[29] = $("#Comments").val();
    insbuildcert[30] = $("#Extended_Comments").val()+"@"+$("#imgurl").val()+"@"+$("#url_app").val();
    insbuildcert[31] = $("#Pts_Comments").val();
    insbuildcert[32] = $("#Primary_or_Secondary").val();
    insbuildcert[33] = $("#First_Audit").val();
    insbuildcert[34] = $("#First_Completed").val();
    insbuildcert[35] = $("#Second_Audit").val();
    insbuildcert[36] = $("#Second_Completed").val();
    insbuildcert[37] =  ($("#Discontinued_Withdrawn").is(':checked'))?"1":"0";
    insbuildcert[38] =  ($("#Remove_from_Website").is(':checked'))?"1":"0";
    insbuildcert[39] =  ($("#New").is(':checked'))?"1":"0";
    insbuildcert[40] = $("#Expiry_Date").val();
    insbuildcert[41] = $("#Approved_Mixing_Valve").val();
    insbuildcert[42] = $("#Certificate_Letters").val();
    insbuildcert[43] = $("#Cert_id").val();
    $.ajax({
        url: "ajax_191220161212.php",
        method: "post",
        data: {insbuildcert: insbuildcert},
        beforeSend: function (n) {
            $("#res_tmv2").html("Working..");
        },
        afterSend: function (n) {
            $("#res_tmv2").html("Working..");
        },
        success: function (data) {
            $("#res_tmv2").html(data);
            //if(data == "Ok")$("#res_tmv2").html("Success");	else $("#res_tmv2").html("Failure");	

        }


    });
});
$(document.body).on("click", "#add_tmv3", function () {
    insbuildcert = [];
    insbuildcert[1] = $("#TMV3_Factor").val();
    insbuildcert[2] = $("#TMV3_Manufacturer").val();
    insbuildcert[3] = 'tmv3';
    insbuildcert[4] = $("#TMV3_Approved_Mixing_Valve").val();
    insbuildcert[5] = $("#TMV3_Unique_ID").val();
    insbuildcert[6] = $("#TMV3_Certificate_Number").val();
    insbuildcert[7] = $("#TMV3_Certificate_Date").val();
    insbuildcert[8] = ($("#TMV3_HPB").is(':checked'))?"1":"0";
    insbuildcert[9] = $("#TMV3_HPB_comment").val();
    insbuildcert[10] = ($("#TMV3_HPS").is(':checked'))?"1":"0";
    insbuildcert[11] = $("#TMV3_HPS_comment").val();
    insbuildcert[12] = ($("#TMV3_HPW").is(':checked'))?"1":"0";
    insbuildcert[13] = $("#TMV3_HPW_comment").val();
    insbuildcert[14] = ($("#TMV3_HPT44").is(':checked'))?"1":"0";
    insbuildcert[15] = $("#TMV3_HPT44_comment").val();
    insbuildcert[16] = ($("#TMV3_HPT46").is(':checked'))?"1":"0";
    insbuildcert[17] = $("#TMV3_HPT46_comment").val();
    insbuildcert[18] = ($("#TMV3_HPD44").is(':checked'))?"1":"0";
    insbuildcert[19] = $("#TMV3_HPD44_comment").val();
    insbuildcert[20] = ($("#TMV3_HPD46").is(':checked'))?"1":"0";
    insbuildcert[21] = $("#TMV3_HPD46_comment").val();
    insbuildcert[22] = ($("#TMV3_LPB").is(':checked'))?"1":"0";
    insbuildcert[23] = $("#TMV3_LPB_comment").val();
    insbuildcert[24] = ($("#TMV3_LPS").is(':checked'))?"1":"0";
    insbuildcert[25] = $("#TMV3_LPS_comment").val();
    insbuildcert[26] = ($("#TMV3_LPW").is(':checked'))?"1":"0";
    insbuildcert[27] = $("#TMV3_LPW_comment").val();
    insbuildcert[28] = ($("#TMV3_LPT44").is(':checked'))?"1":"0";
    insbuildcert[29] = $("#TMV3_LPT44_comment").val();
    insbuildcert[30] = ($("#TMV3_LPT46").is(':checked'))?"1":"0";
    insbuildcert[31] = $("#TMV3_LPT46_comment").val();
    insbuildcert[32] = ($("#TMV3_LPD44").is(':checked'))?"1":"0";
    insbuildcert[33] = $("#TMV3_LPD44_comment").val();
    insbuildcert[34] = ($("#TMV3_LPD46").is(':checked'))?"1":"0";
    insbuildcert[35] = $("#TMV3_LPD46_comment").val();
    insbuildcert[36] = $("#TMV3_Comments").val();
    insbuildcert[37] = $("#TMV3_Extended_Comments").val()+"@"+$("#imgurl").val()+"@"+$("#tmv3_url_app").val();
    insbuildcert[38] = $("#TMV3_Pts_Comments").val();
    insbuildcert[39] = $("#TMV3_Primary_or_Secondary").val();
    insbuildcert[40] = $("#TMV3_First_Audit").val();
    insbuildcert[41] = $("#TMV3_First_Completed").val();
    insbuildcert[42] = $("#TMV3_Second_Audit").val();
    insbuildcert[43] = $("#TMV3_Second_Completed").val();
    insbuildcert[44] = ($("#TMV3_Discontinued_Withdrawn").is(':checked'))?"1":"0";
    insbuildcert[45] = ($("#TMV3_Remove_from_Website").is(':checked'))?"1":"0";
    insbuildcert[46] = ($("#TMV3_New").is(':checked'))?"1":"0";
    insbuildcert[47] = $("#TMV3_Expiry_Date").val();
    insbuildcert[48] = $("#TMV3_Certificate_Letters").val();
    insbuildcert[49] = $("#TMV3_timestamp").val();
    $.ajax({
        url: "ajax_191220161212.php",
        method: "post",
        data: {insbuildcert: insbuildcert},
        beforeSend: function (n) {
            $("#res_tmv3").html("Working..");
        },
        afterSend: function (n) {
            $("#res_tmv3").html("Working..");
        },
        success: function (data) {
            $("#res_tmv3").html(data);
            //if(data == "Ok")$("#res_tmv2").html("Success");	else $("#res_tmv2").html("Failure");	

        }


    });
});
function dash_click() {

    dash = [];
    dash[0] = "Ok";
    dash[1] = "Show";
    dash[2] = "Now";
    $.ajax({
        url: "ajax_160120171725.php",
        method: "post",
        data: {dash: dash},
        beforeSend: function (n) {
            $("#reg4_res").html("Working...");
        },
        afterSend: function (n) {
            $("#reg4_res").html("Working...");
        },
        success: function (data) {
            $("#reg4_res").html(data);
            var table = $('#example').DataTable({
               dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
             {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ],
        columnDefs: [ {
            targets: -1,
            visible: false
        } ]
            });

            table.buttons().container()
                    .appendTo('#example_wrapper .col-sm-6:eq(0)');
        }


    });
}
$(document.body).on("click", "#add_link", function () {

    inslink = [];
    inslink[0] = $("#section").val();
    inslink[1] = $("#down_title").val();
    inslink[2] = $("#down_name").val();
    inslink[3] = $("#down_link").val();
    inslink[4] = $("#optradio").val();
    if (inslink[1] == "" && inslink[3] == "") {
        $("#down_res").html("<font style=\"color:red;\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i> Title and Link are required</font>");
    }
    //inslink[4] = $("#down_file").val();
    else {
        $.ajax({
            url: "addlink.php",
            method: "post",
            data: {inslink: inslink},
            beforeSend: function (n) {
                $("#down_res").html("Saving...");
            },
            afterSend: function (n) {
                $("#down_res").html("Saving...");
            },
            success: function (data) {
                if (data == 'Done') {
                    $("#addlinkfr")[0].reset();
                    $("#down_res").html("");
                    $("#up_res").html("");
                } else
                    $("#down_res").html(data);
            }


        });
    }
});
$(document.body).on("change", "#down_file", function () {
    var file_data = $('#down_file').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    alert(form_data);
    $.ajax({
        url: 'upload.php', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        beforeSend: function (n) {
            $("#up_res").html("<i class=\"fa fa-spinner fa-pulse fa-1x fa-fw\"></i> Uploading...");
        },
        afterSend: function (n) {
            $("#up_res").html("<i class=\"fa fa-spinner fa-pulse fa-1x fa-fw\"></i> Uploading...");
        },
        success: function (data) {
            $("#up_res").html('<div class="form-group input-group"><input type="text" id="url" class="form-control" value="' + data + '" readonly="readonly"><span class="input-group-btn"><button class="btn btn-default" onclick="copyul()" type="button"><i class="fa fa-link" ></i></button></span></div>');
            $('#down_file').val("");// display response from the PHP script, if any
        }
    });
});
$(document.body).on("change", "#img_file", function () {
    var file_data = $('#img_file').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    alert(form_data);
    $.ajax({
        url: 'upload_image.php', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        beforeSend: function (n) {
            $("#img_link").html("<i class=\"fa fa-spinner fa-pulse fa-1x fa-fw\"></i> Uploading...");
        },
        afterSend: function (n) {
            $("#img_link").html("<i class=\"fa fa-spinner fa-pulse fa-1x fa-fw\"></i> Uploading...");
        },
        success: function (data) {
            $("#img_link").html('<img src="http://nsfaaws6.nsf.org/lab_control_v2/uploaded_documents/buildcert/image_app/'+data+'" alt="img" style="width:30px;height:30px;"/><input type="hidden" id="imgurl" value="'+data+'"/> <a href="#" onclick="un_click()"><i class="fa fa-window-close" aria-hidden="true"></i></a>');
            
        }
    });
});
function copyul() {
    var ul = $("#url").val();
    $("#down_link").val(ul);
}
function un_click() {
    $("#img_file").val("");
    $("#img_link").html("<input type=\"hidden\" id=\"imgurl\" value=\"\"/>");
}