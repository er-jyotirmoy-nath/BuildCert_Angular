  <?php 
session_start();
include("connections/wrc_new.php");
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
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
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
      margin: 0px 0 !important;
      border: 1px solid #f4511e !important;
      background-color: #f4511e !important;
      color: #fff !important;
  }
  </style>
    <style type="text/css">
  .btn:hover {
      border: 1px solid #f4511e !important;
      background-color: #fff !important;
      color: #f4511e !important;
  }
  .btn {
      margin: 0px 0 !important;
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
                <li>
                    <a href="tmv3.php">TMV3</a>
                </li>
                <li>
                    <a href="pdcert.php">Product Certification</a>
                </li>
                <li class="active">
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
                        <h1>
<span class="glyphicon glyphicon-user"></span> BUILDCERT- CIAS APPROVAL</h1><hr>
                  <div class="row"><div class="col-md-6">
                        
                        </div><div class="col-md-6"></div></div>    
                        <div class="row">
                          <div class="col-md-12">
                            <table id="example" class="table table-bordered">
                            <thead>
                              <th>Company</th>
                              <th>Description</th>
                              <th>Sizes</th>
                              <th>Certificate Number</th>
                              <th></th>
                            </thead><tbody>
                            <?php
                              
                              $stmt_cis = $dbh->query("SELECT BUILD_APP_ID,MANUFACTURER,DESCRIPTION_PRODCERT,SIZES_CIAS,CERTIFICATE_NUMBER,BUILD_APP_ID FROM BUILDCERT_APPROVALS WHERE TYPE_APP = 'cias'");
                                while ($res = $stmt_cis->fetch(PDO::FETCH_ASSOC)) {
                                  # code...
                                  echo '<tr>';
                                    echo "<td>".$res["MANUFACTURER"]."</td>";
                                    echo "<td>".$res["DESCRIPTION_PRODCERT"]."</td>";
                                    echo "<td>".$res["SIZES_CIAS"]."</td>";
                                    echo "<td>".$res["CERTIFICATE_NUMBER"]."</td>";
                                     echo "<td><a data-toggle=\"modal\" data-cias=\"$res[BUILD_APP_ID]\" href=\"#viewlisting\" class=\"open-listings btn btn-primary\" ><i class=\"fa fa-eye\" aria-hidden=\"true\"></i> View Listing</a></td>";
                                  
                                  echo "</tr>";
                                }
                            ?>
                            </tbody>
                              </table>
                          </div>

                        </div>  
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
      <script>
    $(".open-listings").click(function(){
    	var certid = $(this).data('cias');
		cias_data = [];
		cias_data[0] = "certid";
		cias_data[1] = "get";
		cias_data[2] = certid;
                cias_data[3] = "cias";
		$.ajax({
			url: "ajax_191220161212.php",
			method: "post",
			data: {cias_data:cias_data},
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
</body>
</html>
<?php
