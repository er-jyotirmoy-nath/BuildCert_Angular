 <?php 
session_start();
include("connections/wrc_new.php");
mb_internal_encoding("iso-8859-1");
mb_http_output( "UTF-8" );
ob_start("mb_output_handler");


$filter = @$_POST['filter'];
$discon = @$_POST['discon'];
//$edit = $_SESSION['edit'];


if($filter=="yes"){
	
$HP_1111 = @$_POST['HP_1111'];
$HPB = @$_POST["HPB"];
$HPS = @$_POST["HPS"];
$HPW = @$_POST["HPW"];
$HPT = @$_POST['HPT'];
$Cold_isol_46_hp = @$_POST['Cold_isol_46_hp'];
$LP_1287 = @$_POST['LP_1287'];
$LPB = @$_POST['LPB'];
$LPS = @$_POST['LPS'];
$LPW = @$_POST['LPW'];
$LPT = @$_POST['LPT'];
$LPTx = @$_POST['LPTx'];
$Cold_isol_46_lp = @$_POST['Cold_isol_46_lp'];

}

if($filter ==""){

$HP_1111 = "";
$HPBSW = "";
$HPT = "";
$Cold_isol_46_hp = "";
$LP_1287 = "";
$LPB = "";
$LPS = "";
$LPW = "";
$LPT = "";
$LPTx = "";
$Cold_isol_46_lp = "";
}

?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
  <title>BUILDCERT MEMBER AREA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://blackrockdigital.github.io/startbootstrap-simple-sidebar/css/simple-sidebar.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.bootstrap.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js">	</script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
			<script type="text/javascript" class="init">
	

$(document).ready(function() {
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
} );
	</script>
  <style type="text/css">


  </style>
  <style type="text/css">
.sidebar-nav li.active a {
    color: #2b5aa3 !important;
    background-color: #fff !important;
    font-weight: bold;
} 
  .sidebar-nav li a {
    display: block;
    text-decoration: none;
} 
  .btn:hover {
      border: 1px solid #f4511e !important;
      background-color: #fff !important;
      color: #f4511e !important;
  }
  .btn {
      margin: 15px 0 !important;
      border: 1px solid #f4511e !important;
      background-color: #f4511e !important;
      color: #fff !important;
  }
   body{
  font-family: 'Roboto', sans-serif;
  }
  </style>
</head>
<body>

   <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper" style="background: #2b5aa3;">
            <ul class="sidebar-nav">
                <li class="sidebar-brand" style="color: #fff;">
                    <a href="index.php" style="color: #fff;">
                     <span class="glyphicon 	glyphicon glyphicon-th-list"></span>   <strong>BUILD</strong>CERT
                    </a>
                </li>
                <li class="active">
                    <a href="tmv2.php" >TMV2</a>
                </li>
                <li>
                    <a href="tmv3.php">TMV3</a>
                </li>
                <li>
                    <a href="pdcert.php">Product Certification</a>
                </li>
                <li>
                    <a href="cias.php">CIAS</a>
                </li>
                <li>
                    <a href="dtc.php">DTC</a>
                </li>
              
                <li>
                    <a href="admin.php">Admin</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
           
                <div class="row">
                    <div class="col-lg-12">
                        <h1><span class="glyphicon glyphicon-user"></span> BUILDCERT- TMV2 APPROVAL </h1><hr>
                       <div class="row"> <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="form-inline">
                        <div class="col-md-4">
                        <h4>High Pressure 0.5 - 5 bar dynamic (HP) <small>BS EN 1111:1999</small></h4>
                        
                        <div class="checkbox">
						  <label><input name="HPB" type="checkbox" value="1" <?php if(@$HPB =="1"){ echo "checked=\"yes\"";} else {} ?>/> B</label>
						</div>
						<div class="checkbox">
						  <label><input name="HPS" type="checkbox" value="1" <?php if(@$HPS =="1"){ echo "checked=\"yes\"";} else {} ?>/> S</label>
						</div>
						<div class="checkbox">
						  <label><input name="HPW" type="checkbox" value="1" <?php if(@$HPW =="1"){ echo "checked=\"yes\"";} else {} ?>/> W</label>
						</div>
						<div class="checkbox">
						  <label><input name="HPT" type="checkbox" value="1" <?php if(@$HPT =="1"){ echo "checked=\"yes\"";} else {} ?>/> T</label>
						</div>
						<div class="checkbox">
						  <label><input name="Cold_isol_46_hp" type="checkbox" value="1" <?php if(@$Cold_isol_46_hp =="1"){ echo "checked=\"yes\"";} else {} ?>/> Cold Isol 46</label>
						</div>
						
                       
                        
                        </div><div class="col-md-4"><h4>Low Pressure 0.1 - 1.0 bar dynamic (LP) <small>BS EN 1287:1999</small></h4>
                        <div class="checkbox"><label><input name="LPB" type="checkbox" value="1" <?php if($LPB =="1"){ echo "checked=\"yes\"";} else {} ?>/> B</label></div>
						<div class="checkbox"><label><input name="LPS" type="checkbox" value="1" <?php if($LPS =="1"){ echo "checked=\"yes\"";} else {} ?>/> S</label></div>
						<div class="checkbox"><label><input name="LPW" type="checkbox" value="1" <?php if($LPW =="1"){ echo "checked=\"yes\"";} else {} ?>/> W</label></div>
						<div class="checkbox"><label><input name="LPT" type="checkbox" value="1" <?php if($LPT =="1"){ echo "checked=\"yes\"";} else {} ?>/> T</label></div>
						<div class="checkbox"><label><input name="LPTx" type="checkbox" value="1" <?php if($LPTx =="1"){ echo "checked=\"yes\"";} else {} ?>/> T at 0.2b</label></div>
						<div class="checkbox"><label><input name="Cold_isol_46_lp" type="checkbox" value="1" <?php if($Cold_isol_46_lp =="1"){ echo "checked=\"yes\"";} else {} ?>/> Cold Isol 46</label></div>
                         
                        </div>
                        <div class="col-md-4">
                       <div class="row"><div class="col-md-6">
                       <input type="hidden" name="discon" value="1"/>
						<input type="hidden" name="filter" value="yes"/>
                        <button type="submit" class="btn btn-default">Search Approvals</button>
                       </form>
                       </div>
                        <div class="col-md-6">
                        <form action="tmv2.php" method="post">
                        <input type="hidden" name="discon" value=" "/>	
						<input type="hidden" name="filter" value="yes"/>
                        <button type="submit" class="btn btn-default">Discontinued Approvals</button></form></div>
                        </div></div>
                        </div>
                        
                      
                        
                    </div>
                </div> 
                <div class="row"><div class="col-md-12">
                		   
                        <?php

						if($filter=="yes"){
						echo "<br> <table id=\"example\" class=\"table table-bordered\">
					    <thead>
					      <tr>
					        <th>Approval Holder</th>
					        <th>Mixing Valve</th>
					        <th>Unique ID</th>
					        <th>Certificate</th>
					        <th>Comments</th>
							<th></th>
							
					      </tr>
					    </thead><tbody>";
		
						
						if(isset($HP_1111)){$HP_1111 = "AND HP_1111='1'";}else{$HP_1111="";}
						if(isset($HPB)){$HPB = "AND HPB='1'";}else{$HPB="";}
						if(isset($HPS)){$HPS = "AND HPS='1'";}else{$HPS="";}
						if(isset($HPW)){$HPW = "AND HPW='1'";}else{$HPW="";}
						if(isset($HPT)){$HPT = "AND HPT='1'";}else{$HPT="";}
						if(isset($Cold_isol_46_hp)){$Cold_isol_46_hp = "AND Cold_isol_46_hp='1'";}else{$Cold_isol_46_hp="";}
						if(isset($LP_1287)){$LP_1287 = "AND LP_1287='1'";}else{$LP_1287="";}
						if(isset($LPB)){$LPB = "AND LPB='1'";}else{$LPB="";}
						if(isset($LPS)){$LPS = "AND LPS='1'";}else{$LPS="";}
						if(isset($LPW)){$LPW = "AND LPW='1'";}else{$LPW="";}
						if(isset($LPT)){$LPT = "AND LPT='1'";}else{$LPT="";}
						if(isset($LPTx)){$LPTx = "AND LPTx='1'";}else{$LPTx="";}
						if(isset($Cold_isol_46_lp)){$Cold_isol_46_lp = "AND Cold_isol_46_lp='1'";}else{$Cold_isol_46_lp="";}
						try{
						
						$query = "SELECT * FROM BUILDCERT_APPROVALS WHERE Remove_from_Website != '1' $HP_1111 $HPB $HPS $HPW $HPT $Cold_isol_46_hp $LP_1287 $LPB $LPS $LPW $LPT $LPTx $Cold_isol_46_lp AND Discontinued_Withdrawn !='$discon' and type_app = 'tmv2' ORDER BY Licensee ASC ";
//						$stmt_ch = $dbh->query("DELETE FROM BUILDCERT_APPROVALS WHERE type_app = 'tmv2' ");
//						
//						
//							$query = "SELECT * FROM TMV2 WHERE Remove_from_Website != '1' $HP_1111 $HPB $HPS $HPW $HPT $Cold_isol_46_hp $LP_1287 $LPB $LPS $LPW $LPT $LPTx $Cold_isol_46_lp AND Discontinued_Withdrawn !='$discon' ORDER BY Licensee ASC ";
//						
						//$query = "SELECT * FROM TMV2";
						//echo $query;
						$quer_fetch =  $dbh->prepare($query);
						
						$quer_fetch->execute();
						
						while ($row = $quer_fetch->fetch(PDO::FETCH_ASSOC))
						{
							
							 if(isset($cert_id_2))$cert_id = $cert_id_2; else $cert_id="";
							 if(isset($Licensee))$previous = $Licensee; else $previous="";
							
							$Manufacturer = $row['MANUFACTURER'];
							$Licensee = $row['LICENSEE'];
							$Approved_Mixing_Valve = isset($row["APPROVED_MIXING_VALVE"]) ? stream_get_contents($row["APPROVED_MIXING_VALVE"]) : "";
							$Certificate_Letters = $row["CERTIFICATE_LETTERS"];
							$Certificate_Number = $row["CERTIFICATE_NUMBER"];
							$Certificate_Date = $row["CERTIFICATE_DATE"];
							$Comments = $row['COMMENTS'];
							$Extended_Comments = $row['EXTENDED_COMMENTS'];
							$Unique_ID = stream_get_contents($row['UNIQUE_ID']);
							$cert_id_2 = $row['CERT_ID'];
							$HP_1111 = $row["HP_1111"];
							$HPB = $row["HPB"];
							$HPB_comment = $row['HPB_COMMENT'];
							$HPS = $row["HPS"];
							$HPS_comment = $row['HPS_COMMENT'];
							$HPW = $row["HPW"];
							$HPW_comment = $row['HPW_COMMENT'];
							$HPT = $row["HPT"];
							$HPT_comment = $row['HPT_COMMENT'];
							$LP_1287 = $row['LP_1287'];
							$LPB = $row['LPB'];
							$LPB_comment = $row['LPB_COMMENT'];
							$LPS = $row['LPS'];
							$LPS_comment = $row['LPS_COMMENT'];
							$LPW = $row['LPW'];
							$LPW_comment = $row['LPW_COMMENT'];
							$LPT = $row['LPT'];
							$LPT_comment = $row['LPT_COMMENT'];
							$LPTx = $row['LPTX'];
							$LPTx_comment = $row['LPTX_COMMENT'];
							$Comments = $row['COMMENTS'];
							$Extended_Comments = $row['EXTENDED_COMMENTS'];
							$Pts_Comments = $row['PTS_COMMENTS'];
							$Primary_or_Secondary = $row['PRIMARY_OR_SECONDARY'];
							$First_Audit = $row['FIRST_AUDIT'];
							$First_Completed = $row['FIRST_COMPLETED'];                  
							$Second_Audit = $row['SECOND_AUDIT'];             
							$Second_Completed = $row['SECOND_COMPLETED'];
							$Discontinued_Withdrawn = $row['DISCONTINUED_WITHDRAWN'];               
							$Remove_from_Website = $row['REMOVE_FROM_WEBSITE'];        
							$New = $row['NEW'];  
							$Cold_isol_46_lp = $row['COLD_ISOL_46_LP'];                    
							$Cold_isol_46_hp = $row['COLD_ISOL_46_HP'];
							$Expiry_Date = $row['EXPIRY_DATE'];
							$time_stamp = $row['TIMESTAMP'];
							$row_count = $row['ROW_COUNT'];
							if($Certificate_Number < 100){
							$Certificate_Number = "0$Certificate_Number";	
							}	
							if($Certificate_Date < 1000){
							$Certificate_Date = "0$Certificate_Date";	
							}
						
						if($cert_id != $cert_id_2){
								//$row_colour = ($counter % 2) ? $colour1 : $colour2;
								echo "<tr >
                        		<td >"; if($Licensee == $previous){echo"";}else{echo $Licensee;}echo"</td>".
						    		 "<td > $Approved_Mixing_Valve ";
								echo"<br>";
									
								if($HPB =="1" || $HPS =="1" || $HPW =="1" || $HPT =="1" || $Cold_isol_46_hp =="1"){echo"<b><u>HP_1111</u></b>";}
								if($HPB =="1"){echo"<b> B - </b>". $HPB_comment;}
								if($HPS =="1"){echo"<b> S - </b>". $HPS_comment;}
								if($HPW =="1"){echo"<b> W - </b>". $HPW_comment;}
								if($HPT =="1"){echo"<b>T - </b>". $HPT_comment;}
								if($Cold_isol_46_hp =="1"){echo"<b>Cold Isol 46 </b>";}echo"</br>";
								if($LPB =="1" || $LPS =="1" || $LPW =="1" || $LPT =="1" || $LPTx =="1" || $Cold_isol_46_lp =="1"){echo"<b><u>LP_1287</u></b>";}
								if($LPB =="1"){echo"<b> B - </b>". $LPB_comment;}
								if($LPS =="1"){echo"<b> S - </b>". $LPS_comment;}
								if($LPW =="1"){echo"<b> W - </b>". $LPW_comment;}
								if($LPT =="1"){echo"<b> T - </b>". $LPT_comment;}
								if($LPTx =="1"){echo"<b>T 0.2 - </b>". $LPTx_comment;}
								if($Cold_isol_46_lp =="1"){echo"<b>Cold Isol 46 </b>";}
						    		 echo"</td>".
									 "<td > $Unique_ID </td>".
									 "<td > $Certificate_Letters $Certificate_Number/$Certificate_Date</td>" .
									 "<td > $Comments $Extended_Comments</td>";
									 echo
								 	 "<td ><form >
						    	 	  <input type = \"hidden\" name=\"cert_id\" value= \"$cert_id_2\" />
						    	 	  <input type = \"hidden\" name=\"scheme\" value= \"TMV2\" />
						    	 	 <a data-toggle=\"modal\" data-id=\"$row[BUILD_APP_ID]\"  href=\"#viewlisting\" class=\"open-listings btn btn-primary\" ><i class=\"fa fa-eye\" aria-hidden=\"true\"></i> View Listing</a></form></td></form>";
						
						}
						
					
						
						
						}
								   
						}
						catch (Exception $e){echo $e->getMessage();}
									
									
									echo'</tbody> </table>';
						}
						
						
						?>
                
                </div></div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
   

    <!-- Bootstrap Core JavaScript -->
    

    <!-- Menu Toggle Script -->
    <script>
    $(".open-listings").click(function(){
    	var certid = $(this).data('id');
		
		tmv2data = [];
		tmv2data[0] = certid;
		tmv2data[1] = "certdate";
		tmv2data[2] = "certnum";
		tmv2data[3] = "show";
		$.ajax({
			url: "ajax_191220161212.php",
			method: "post",
			data: {tmv2data:tmv2data},
			beforeSend:function(n){$("#view_list_res").html("<span style=\"text-align:center;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
			afterSend:function(n){$("#view_list_res").html("<span style=\"text-align:center;\" ><img alt=\"\" src=\"../images/download.gif\" /></span>");},
			success:function(data){
				$("#view_list_res").html(data);
				}
			

			});
		});
    </script>

</body>
</html>
<div id="viewlisting" class="modal" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Data Record</h4>
			</div>
			<div class="modal-body" id="view_list_res"></div>
			<div class="modal-footer">
			
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>
<?php
