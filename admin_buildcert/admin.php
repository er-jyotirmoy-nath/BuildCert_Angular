 <?php 
 session_start();
 include("connections/wrc_new.php");
 mb_internal_encoding("iso-8859-1");
 mb_http_output( "UTF-8" );
 ob_start("mb_output_handler");

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
<link href="css/build_admin.css" rel="stylesheet">
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
                <li>
                    <a href="cias.php">CIAS</a>
                </li>
                <li>
                    <a href="dtc.php">DTC</a>
                </li>
              
                <li class="active">
                    <a href="admin.php" >Admin</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="row">
                    <div class="col-md-12"><h1><span class="glyphicon glyphicon-user"></span> BUILDCERT - Admin</h1></div>
                    </div>    <hr>
                        
                        <?php if(!isset($_SESSION["logid"]) && empty($_SESSION["logid"])){?>
						<div class="row">
							<div class="col-md-4 col-md-offset-4">
								<div class="login-panel panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Please Sign In</h3>
									</div>
									<div class="panel-body">
										<form role="form">
											<fieldset>
												<div class="form-group">
													<input class="form-control" placeholder="E-mail"
														name="uname" id="uname" autofocus="">
												</div>
												<div class="form-group">
													<input class="form-control" placeholder="Password"
														name="psw" id="psw" type="password" value="">
												</div>
												<div class="checkbox">
													<label> <input name="remember" type="checkbox"
														value="Remember Me">Remember Me
													</label>
												</div>
												<!-- Change this to a button or input when using this as a form -->
												<button type="button"
													class="btn btn-lg btn-primary btn-block" id="login">
													<span id="button"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> Login</span>
												</button>

											</fieldset>
										</form>
									</div>
								</div>
							</div>
						</div>
						<?php } else {?>
                       <div class="row">
                       <div class="col-md-6">
                       		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" class="form-inline">
                       		<div class="form-group">
                                            <label>Select Type:</label>
                                            <select id="type_filter" name="type_filter" class="form-control" style="width: 200px;">
                                               <option value="tmv2">TMV2</option>
                                               <option value="tmv3">TMV3</option>
                                               <option value="cias">CIAS</option>
                                               <option value="buildcert">Build Cert</option>
                                               <option value="dtc">DTC</option>
                                                <option value="reg4">Reg4</option>
                                                <option value="downloads">Downloads and Info</option>
                                            </select>
                                        </div>
                       		<input type="button" id="filter" name="filter" class="btn btn-default" value="Submit"/>
                       		<!-- <input type="submit" name="add_tmv2" value="Add TMV 2" class="btn btn-primary" /> -->
                       		</form>	
                       		
                       </div> <div class="col-md-6" style="text-align: right;"><?php if(isset($_SESSION["logid"]) && !empty($_SESSION["logid"])){ echo '<input type="button" class="btn btn-default" id="logout" value="Logout">'; } ?></div>
                       </div><HR>
                       
                       <div id="getdatatable"></div>
                  
                        
                        
                        <?php }?>
                        <?php if(isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["type"]) && !empty($_GET["type"]) && isset($_SESSION["logid"]) && !empty($_SESSION["logid"])){
                        	
                        	include 'edit_data.php';
                        }?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
<script type="text/javascript" class="init">
	$(document).ready(function() {	} );
</script>

	
        <!-- Menu Toggle Script -->	
        <script type="text/javascript" src="js/app.js"></script>
	<!-- Edit Panels -->
	<script type="text/javascript" src="js/edit_modal.js"></script>
	<!-- Show Panels -->
	<script type="text/javascript" src="js/show_modal.js">	</script>
	<!--Update Date-->
	<script type="text/javascript" src="js/update_query.js"></script>
	<!-- Insert Scripts -->
	<script type="text/javascript" src="js/inset_query.js"></script>
        <script type="text/javascript" src="js/reg4.js"  ></script>
        <script type="text/javascript">
        $(".modal").on("hidden.bs.modal", function(){
    $(".modal-body").html("");
});
        </script>
</body>
</html>
<?php include 'include/edit_modals.php';?>

<!-- Add Modals -->
<?php include 'include/add_modal.php';?>
<?php
