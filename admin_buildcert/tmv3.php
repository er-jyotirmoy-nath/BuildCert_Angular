<?php 
session_start();
include("connections/wrc_new.php");
mb_internal_encoding("iso-8859-1");
mb_http_output( "UTF-8" );
ob_start("mb_output_handler");


$filter = @$_POST['filter'];


$discon = @$_POST['discon'];
$edit = @$_SESSION['edit'];

if($filter=="yes"){

	$HPB = @$_POST["HPB"];
	$HPS = @$_POST["HPS"];
	$HPW = @$_POST["HPW"];
	$HPT44 = @$_POST["HPT44"];
	$HPT46 = @$_POST["HPT46"];
	$HPD44 = @$_POST["HPD44"];
	$HPD46 = @$_POST["HPD46"];
	$LPB = @$_POST["LPB"];
	$LPS = @$_POST['LPS'];
	$LPW = @$_POST['LPW'];
	$LPT44 = @$_POST['LPT44'];
	$LPT46 = @$_POST['LPT46'];
	$LPD44 = @$_POST['LPD44'];
	$LPD46 = @$_POST['LPD46'];
}

if($filter ==""){

	$HPB = "";
	$HPS = "";
	$HPW = "";
	$HPT44 = "";
	$HPT46 = "";
	$HPD44 = "";
	$HPD46 = "";
	$LPB = "";
	$LPS = "";
	$LPW = "";
	$LPT44 = "";
	$LPT46 = "";
	$LPD44 = "";
	$LPD46 = "";
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
  </style>
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
      
  .sidebar-nav li a {
    display: block;
    text-decoration: none;
    color: #fff;
}

  </style>
    <style type="text/css">
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
                <li>
                    <a href="tmv2.php">TMV2</a>
                </li>
                <li class="active">
                    <a href="tmv3.php" >TMV3</a>
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
                        <h1><span class="glyphicon glyphicon-user"></span> BUILDCERT - TMV3 APPROVAL</h1><hr>
                        <div class="row">
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="form-inline">
                        <div class="col-md-4">
                        <h4>High Pressure 1.0 - 5.0 bar dynamic (HP)</h4>
                         <div class="checkbox"><label><input name="HPB" type="checkbox" value="1" <?php if(@$HPB =="1"){ echo "checked=\"yes\"";} else {} ?>/><b>B</b></label></div>
						 <div class="checkbox"><label><input name="HPS" type="checkbox" value="1" <?php if(@$HPS =="1"){ echo "checked=\"yes\"";} else {} ?>/><b>S</b></label></div>
						 <div class="checkbox"><label><input name="HPW" type="checkbox" value="1" <?php if(@$HPW =="1"){ echo "checked=\"yes\"";} else {} ?>/><b>W</b></label></div>
						 <div class="checkbox"><label><input name="HPT44" type="checkbox" value="1" <?php if(@$HPT44 =="1"){ echo "checked=\"yes\"";} else {} ?>/><b>T 44</b></label></div>
						 <div class="checkbox"><label><input name="HPT46" type="checkbox" value="1" <?php if(@$HPT46 =="1"){ echo "checked=\"yes\"";} else {} ?>/><b>T 46</b></label></div>
						 <div class="checkbox"><label><input name="HPD44" type="checkbox" value="1" <?php if(@$HPD44 =="1"){ echo "checked=\"yes\"";} else {} ?>/><b>D 44</b></label></div>
						 <div class="checkbox"><label><input name="HPD46" type="checkbox" value="1" <?php if(@$HPD46 =="1"){ echo "checked=\"yes\"";} else {} ?>/><b>D 46</b></label></div>
                        </div>
                        <div class="col-md-4">
                        <h4>Low Pressure 0.2 - 1.0 bar dynamic (LP)</h4>
                        <div class="checkbox"><label><input name="LPB" type="checkbox" value="1" <?php if(@$LPB =="1"){ echo "checked=\"yes\"";} else {} ?>/><b>B</b></label></div>
						<div class="checkbox"><label><input name="LPS" type="checkbox" value="1" <?php if(@$LPS =="1"){ echo "checked=\"yes\"";} else {} ?>/><b>S</b></label></div>
						<div class="checkbox"><label><input name="LPW" type="checkbox" value="1" <?php if(@$LPW =="1"){ echo "checked=\"yes\"";} else {} ?>/><b>W</b></label></div>
						<div class="checkbox"><label><input name="LPT44" type="checkbox" value="1" <?php if(@$LPT44 =="1"){ echo "checked=\"yes\"";} else {} ?>/></<b>T 44</b></label></div>
						<div class="checkbox"><label><input name="LPT46" type="checkbox" value="1" <?php if(@$LPT46 =="1"){ echo "checked=\"yes\"";} else {} ?>/><b>T 46</b></label></div>
						<div class="checkbox"><label><input name="LPD44" type="checkbox" value="1" <?php if(@$LPD44 =="1"){ echo "checked=\"yes\"";} else {} ?>/><b>D 44</b></label></div>
						<div class="checkbox"><label><input name="LPD46" type="checkbox" value="1" <?php if(@$LPD46 =="1"){ echo "checked=\"yes\"";} else {} ?>/><b>D 46</b></label></div>
                        </div>
                        <div class="col-md-4">
                          <div class="row">  <div class="col-lg-6">
                        <input type="hidden" name="discon" value="1"/>	
						<input type="hidden" name="filter" value="yes"/>
						<input type="submit" class="btn btn-default" value="Search Approvals"/>
						</form>
                        </div><div class="col-lg-6">
                         <form action="tmv2.php" method="post">
                        <input type="hidden" name="discon" value=" "/>	
			<input type="hidden" name="filter" value="yes"/>
                        <button type="submit" class="btn btn-default">Discontinued Approvals</button></form>
                        </div></div></div>
                        </div></div>
                        <div class="row"><div class="col-md-12">
                         
                        <?php

							if($filter=="yes"){ 
							echo "<br><table id=\"example\" class=\"table table-bordered\">
					    <thead>
					      <tr>
					        <th>Factor</th>
					        <th>Mixing Valve</th>
					        <th>Unique ID</th>
							<th>Certificate</th>
							<th>Comments</th>
							<th></th>
					      </tr>
					    </thead>
					    <tbody>";
							}
							
							
							
							
							if($filter=="yes"){
							
								
							if(isset($HPB)){$HPB = "AND HPB='1'";}else{$HPB="";}
							if(isset($HPS)){$HPS = "AND HPS='1'";}else{$HPS="";}
							if(isset($HPW)){$HPW = "AND HPW='1'";}else{$HPW="";}
							if(isset($HPT44)){$HPT44 = "AND HPT44='1'";}else{$HPT44="";}
							if(isset($HPT46)){$HPT46 = "AND HPT46='1'";}else{$HPT46="";}
							if(isset($HPD44)){$HPD44 = "AND HPD44='1'";}else{$HPD44="";}
							if(isset($HPD46)){$HPD46 = "AND HPD46='1'";}else{$HPD46="";}
							if(isset($LPB)){$LPB = "AND LPB='1'";}else{$LPB="";}
							if(isset($LPS)){$LPS = "AND LPS='1'";}else{$LPS="";}
							if(isset($LPW)){$LPW = "AND LPW='1'";}else{$LPW="";}
							if(isset($LPT44)){$LPT44 = "AND LPT44='1'";}else{$LPT44="";}
							if(isset($LPT46)){$LPT46 = "AND LPT46='1'";}else{$LPT46="";}
							if(isset($LPD44)){$LPD44 = "AND LPD44='1'";}else{$LPD44="";}
							if(isset($LPD46)){$LPD46 = "AND LPD46='1'";}else{$LPD46="";}
							
						
						$query = "SELECT * FROM wrc.BUILDCERT_APPROVALS WHERE Remove_from_Website != '1' $HPB $HPS $HPW $HPT44 $HPT46 $HPD44 $HPD46 $LPB $LPS $LPW $LPT44 $LPT46 $LPD44 $LPD46 AND Discontinued_Withdrawn !='$discon' and type_app = 'tmv3' ORDER BY Factor ASC ";
						
						//$query = "SELECT * FROM wrc.TMV3";
							$result = $dbh->query($query);
							
							while ($row = $result->fetch(PDO::FETCH_ASSOC))
							{
								$cert_id = isset($cert_id_2)?$cert_id_2:"";
								$previous = isset($Factor)?$Factor:"";
								$Manufacturer = trim($row['MANUFACTURER']);
								$Factor = $row['FACTOR'];
								$Approved_Mixing_Valve = isset($row["APPROVED_MIXING_VALVE"])?stream_get_contents($row["APPROVED_MIXING_VALVE"]):"";
								$Approved_Mixing_Valve = trim($Approved_Mixing_Valve);
								$Certificate_Letters = $row["CERTIFICATE_LETTERS"];
								$Certificate_Number = $row["CERTIFICATE_NUMBER"];
								$Certificate_Date = $row["CERTIFICATE_DATE"];
								$Comments = $row['COMMENTS'];
								$Extended_Comments = $row['EXTENDED_COMMENTS'];
								$Unique_ID = stream_get_contents($row['UNIQUE_ID']);
								$Unique_ID = trim($Unique_ID);
								$cert_id_2 = $row['CERT_ID'];
								$HPB = $row['HPB'];
								$HPB_comment = $row['HPB_COMMENT'];
								$HPS = $row['HPS'];
								$HPS_comment = $row['HPS_COMMENT'];
								$HPW = $row['HPW'];
								$HPW_comment = $row['HPW_COMMENT'];
								$HPT44 = $row['HPT44'];
								$HPT44_comment = $row['HPT44_COMMENT'];
								$HPT46 = $row['HPT46'];
								$HPT46_comment = $row['HPT46_COMMENT'];
								$HPD44 = $row['HPD44'];
								$HPD44_comment = $row['HPD44_COMMENT'];
								$HPD46 = $row['HPD46'];
								$HPD46_comment = $row['HPD46_COMMENT'];
								$LPB = $row['LPB'];
								$LPB_comment = $row['LPB_COMMENT'];
								$LPS = $row['LPS'];
								$LPS_comments = $row['LPS_COMMENT'];
								$LPW = $row['LPW'];
								$LPW_comment = $row['LPW_COMMENT'];
								$LPT44 = $row['LPT44'];
								$LPT44_comment = $row['LPT44_COMMENT'];
								$LPT46 = $row['LPT46'];
								$LPT46_comment = $row['LPT46_COMMENT'];
								$LPD44 = $row['LPD44'];
								$LPD44_comment = $row['LPD44_COMMENT'];
								$LPD46 = $row['LPD46'];
								$LPD46_comment = $row['LPD46_COMMENT'];	
								$Pts_Comments = $row['PTS_COMMENTS'];
								$Primary_or_Secondary = $row['PRIMARY_OR_SECONDARY'];
								$First_Audit = $row['FIRST_AUDIT'];
								$First_Completed = $row['FIRST_COMPLETED'];                  
								$Second_Audit = $row['SECOND_AUDIT'];             
								$Second_Completed = $row['SECOND_COMPLETED'];
								$Discontinued_Withdrawn = $row['DISCONTINUED_WITHDRAWN'];               
								$Remove_from_Website = $row['REMOVE_FROM_WEBSITE'];        
								$New = $row['NEW'];  
								$Expiry_Date = $row['EXPIRY_DATE'];
								
							
								if($Certificate_Number < 100){
								$Certificate_Number = "0$Certificate_Number";	
								}	
								if($Certificate_Date < 1000){
								$Certificate_Date = "0$Certificate_Date";	
								}	
							
							
							if($cert_id != $cert_id_2){
									
									echo "<tr ><td >"; if($Factor == $previous){echo"";}else{echo $Factor;}
									
											echo"</td>".
							    		 "<td >".$Approved_Mixing_Valve ;
											echo "<br>";
											if($HPB =="1" || $HPS =="1" || $HPW =="1" || $HPT44 =="1" || $HPT46 =="1" || $HPD44 =="1" || $HPD46 =="1"){echo"<b><u>High Pressure</u></b>";}
											if($HPB =="1"){echo"<b> B - </b>". $HPB_comment;}
											if($HPS =="1"){echo"<b> S - </b>". $HPS_comment;}
											if($HPW =="1"){echo"<b> W - </b>". $HPW_comment;}
											if($HPT44 =="1"){echo"<b> T44 - </b>". $HPT44_comment;}
											if($HPT46 =="1"){echo"<b> T46 - </b>". $HPT46_comment;}
											if($HPD44 =="1"){echo"<b> D44 - </b>". $HPD46_comment;}
											if($HPD46 =="1"){echo"<b> D46 - </b>". $HPD46_comment;}
												
											if($LPB =="1" || $LPS =="1" || $LPW =="1" || $LPT44 =="1" || $LPT46 =="1" || $LPD44 =="1" || $LPD46 =="1"){echo"<br/><b><u>Low Pressure</u></b>";}
											if($LPB =="1"){echo"<b> B - </b>". $LPB_comment;}
											if($LPS =="1"){echo"<b> S - </b>". $LPS_comments;}
											if($LPW =="1"){echo"<b> W - </b>". $LPW_comment;}
											if($LPT44 =="1"){echo"<b> T44 - </b>". $LPT44_comment;}
											if($LPT46 =="1"){echo"<b> T46 - </b>". $LPT46_comment;}
											if($LPD44 =="1"){echo"<b> D44 - </b>". $LPD44_comment;}
											if($LPD46 =="1"){echo"<b> D46 - </b>". $LPT46_comment;}
							    		 echo "</td>" .
										 "<td > $Unique_ID </td>" .  
										 "<td a> $Certificate_Letters $Certificate_Number/$Certificate_Date</td>" .
										 "<td > $Comments $Extended_Comments</td>";
										
										 echo
									 	 "<td valign =\"center\" colspan=\"2\"><form>
							    	 	  <input type = \"hidden\" name=\"cert_id\" value= \"$cert_id_2\" />
							    	 	  <input type = \"hidden\" name=\"scheme\" value= \"TMV3\" />
							    	 	  <a data-toggle=\"modal\" data-id=\"$row[BUILD_APP_ID]\" href=\"#viewlisting\" class=\"open-listings btn btn-primary\" ><i class=\"fa fa-eye\" aria-hidden=\"true\"></i> View Listing</a></form></td></form>";
								
								
							}
							
							
						
						
									
							}			
							echo '   </tbody>  </table>';
							}
							
							
							?>
                        
                        
                        </div></div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
  

    <!-- Menu Toggle Script -->
     <script>
    $(".open-listings").click(function(){
    	var certid = $(this).data('id');
		tmv3data = [];
		tmv3data[0] = certid;
		tmv3data[1] = "certdate";
		tmv3data[2] = "certnum";
                tmv3data[3] = "get";
		$.ajax({
			url: "ajax_191220161212.php",
			method: "post",
			data: {tmv3data:tmv3data},
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

<?php ?>