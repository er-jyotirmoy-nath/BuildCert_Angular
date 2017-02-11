/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function () {
    checkContainer();
});
function checkContainer() {
    if ($('#dash').is(':visible')) {

        dash = [];
        dash[0] = "Ok";
        dash[1] = "show";
        dash[2] = "now";
        $.ajax({
            url: 'ajax_160120171725.php',
            method: 'POST',
            data: {dash: dash},
            beforeSend: function (msg) {
                $("#dash").html("<i class=\"fa fa-spinner fa-pulse fa-5x fa-fw\" style=\"margin-left: 50%;	margin-top: 15%;\"></i><span class=\"sr-only\">Loading...</span>");
            },
            afterSend: function (msg) {
                $("#dash").html("<i class=\"fa fa-spinner fa-pulse fa-5x fa-fw\" style=\"margin-left: 50%;	margin-top: 15%;\"></i><span class=\"sr-only\">Loading...</span>");
            },
            success: function (msg) {
                $("#dash").html(msg);
                $('#example').DataTable({});
            }
        });


    }
}
$(document.body).on("click", "#cert_issue", function () {
    issue_cert = [];
    issue_cert[0] = "Ok";
    issue_cert[1] = $("#sample_number").val();
    issue_cert[2] = $("#issue_cert").val();
    $("#sample").html($("#sample_number").val());
    $.ajax({
        url: 'ajax_160120171725.php',
        method: 'POST',
        data: {issue_cert: issue_cert},
        beforeSend: function (msg) {
            $("#cert_show").html("<i class=\"fa fa-refresh fa-spin\" style=\"font-size:24px;\" ></i>");
        },
        afterSend: function (msg) {
            $("#cert_show").html("<i class=\"fa fa-refresh fa-spin\" style=\"font-size:24px;\" ></i>");
        },
        success: function (msg) {

            $("#cert_show").html(msg);
        }
    });

});
function update_status(sample, hit) {
    upstatus = [];
    upstatus[0] = "stats";
    upstatus[1] = sample;
    upstatus[2] = hit;
    alert("Updating Status for:" + upstatus[1] + upstatus[2]);
    $.ajax({
        url: 'ajax_160120171725.php',
        method: 'POST',
        data: {upstatus: upstatus},
        beforeSend: function (msg) {
            if (upstatus[2] == 'a') {
                $("#checked" + upstatus[1] + "1").html("<i class=\"fa fa-spinner fa-pulse fa-1x fa-fw\"></i> ");
            }
            if (upstatus[2] == 'b') {
                $("#checked" + upstatus[1] + "2").html("<i class=\"fa fa-spinner fa-pulse fa-1x fa-fw\"></i>");
            }
            if (upstatus[2] == 'c') {
                $("#checked" + upstatus[1] + "3").html("<i class=\"fa fa-spinner fa-pulse fa-1x fa-fw\"></i>");
            }
        },
        afterSend: function (msg) {
            if (upstatus[2] == 'a') {
                $("#checked" + upstatus[1] + "1").html("<i class=\"fa fa-spinner fa-pulse fa-1x fa-fw\"></i>");
            }
            if (upstatus[2] == 'b') {
                $("#checked" + upstatus[1] + "2").html("<i class=\"fa fa-spinner fa-pulse fa-1x fa-fw\"></i>");
            }
            if (upstatus[2] == 'c') {
                $("#checked" + upstatus[1] + "3").html("<i class=\"fa fa-spinner fa-pulse fa-1x fa-fw\"></i>");
            }
        },
        success: function (msg) {
            if (upstatus[2] == 'a') {
                if (msg == 'done') {
                    $("#checked" + upstatus[1] + "1").html("<i class=\"fa fa-check-square\"></i> Test reports are adequate");
                } else {
                    $("#checked1").html(msg);
                }
            }
            if (upstatus[2] == 'b') {
                if (msg == 'done') {
                    $("#checked" + upstatus[1] + "2").html("<i class=\"fa fa-check-square\"></i> Fully complaint materials");
                } else {
                    $("#checked2").html(msg);
                }
            }
            if (upstatus[2] == 'c') {
                if (msg == 'done') {
                    $("#checked" + upstatus[1] + "3").html("<i class=\"fa fa-check-square\"></i> Quality System varified");
                } else {
                    $("#checked3").html(msg);
                }
            }
        }
    });


}

//$(document.body).on("click", "#checkbox1", function () {
//   if (this.checked) {
//      
//   }
//  }) 