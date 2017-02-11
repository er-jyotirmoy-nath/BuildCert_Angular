<?php
session_start();
date_default_timezone_set('Europe/London');
ini_set('display_errors', '1');
include("connections/wrc_new.php");
if(!isset($_GET['id']) || empty($_GET['id']))    header('Location: Reg4_dashboard.php?id=1');
?>

<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" type="text/css"
              href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/reg4.css">
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="sb-admin-2.css" rel="stylesheet">
	<title>Reg4 Management</title>
    </head>
    <body>
        <div id="container-fluid" style="margin-left: 25px; margin-right: 25px;">
            <div class="row" >
                <div class="col-lg-6">
                    <h4> class="page-header" style="margin-top:10px;">
                        <i class="fa fa-th" aria-hidden="true"></i> Reg4  Administration
                    </h4>
   
                </div>
                <div class="col-lg-6">
                    <h2 class="page-header" style="float: right;margin-top:10px;">
                        <div class="dropdown" style="text-size:24px;">
                                 <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="background-color:#114070 !important; "><i class="fa fa-tasks" aria-hidden="true"></i> Select Option
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li> <a href="?id=1" class="list-group-item <?php if ($_GET["id"] == "1") {echo "active";} ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
                              <li> <a href="?id=2" class="list-group-item <?php if ($_GET["id"] == "2") {echo "active";} ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Record</a></li>
                              <li><a href="?id=3" class="list-group-item <?php if ($_GET["id"] == "3") {echo "active";} ?>"><i class="fa fa-floppy-o" aria-hidden="true"></i> Insert Record</a></li>
                               <li><a href="?id=6" class="list-group-item <?php if ($_GET["id"] == "6") {echo "active";} ?>"><i class="fa fa-cog" aria-hidden="true"></i> Tools</a></li>
                            </ul>
                          </div>
                    </h2>
                </div>
            </div>




        </div>
       
       
        <hr style="margin-top:5px;margin-bottom: 5px;">         
         <div class="row" style="padding-top: 5px;">
            <div class="col-lg-12">

                <?php if ($_GET["id"] == "1") { ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="    font-size: 12px;font-weight: bold;"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</h3>
                        </div>
                        <div class="panel-body" id="dash" style=" min-height:800px;">

                        </div>
                    </div>
                <?php } ?>
                <?php if ($_GET["id"] == "2") { ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="    font-size: 12px;font-weight: bold;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Record</h3>
                        </div>
                        <div class="panel-body" id="uprec" style=" min-height:800px;">

                        </div>
                    </div>
                <?php } ?>
                <?php if ($_GET["id"] == "3") { ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="    font-size: 12px;font-weight: bold;"><i class="fa fa-floppy-o" aria-hidden="true"></i> Insert Record</h3>
                        </div>
                        <div class="panel-body" id="inrec" style=" min-height:800px;">

                        </div>
                    </div>
                <?php } ?>


<?php if ($_GET["id"] == "6") { ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="    font-size: 12px;font-weight: bold;"><i class="fa fa-cog" aria-hidden="true"></i> Tools</h3>
                        </div>
                        <div class="panel-body" id="tools" style=" min-height:800px;">

                        </div>
                    </div>
<?php } ?>
<?php if ($_GET["id"] == "7") { ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="    font-size: 12px;font-weight: bold;"><i class="fa fa-clock-o fa-fw"></i> Regs Invoice List</h3>
                        </div>
                        <div class="panel-body" style=" min-height:800px;" id="regs">

                        </div>
                    </div>
<?php } ?>

            </div>


        </div>
        <!-- 3 rows -->


        <!-- <div class="row">
<div class="col-lg-4">
                <div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Events</h3>
</div>
<div class="panel-body" style="overflow-y: scroll; height:400px;">

</div>
</div>
</div>
<div class="col-lg-4">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Events</h3>
</div>
<div class="panel-body" style="overflow-y: scroll; height:400px;">

</div>
</div>
</div>
<div class="col-lg-4">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Events</h3>
</div>
<div class="panel-body">

</div>
</div>
</div>

</div>-->
        <!-- Modal -->

        <!-- Script to save description for sample number -->
        <script type="text/javascript" language="javascript" src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="http://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="js/reg4.js"  ></script>
      
    </body>
    
</html>

