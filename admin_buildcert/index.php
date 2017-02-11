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
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
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

    <div id="wrapper" ng-app>

        <!-- Sidebar -->
        <div id="sidebar-wrapper" style="background: #2b5aa3;">
            <ul class="sidebar-nav">
                <li class="sidebar-brand" style="color: #fff;" class="active">
                    <a href="index.php" style="color: #fff;" >
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
<span class="glyphicon glyphicon-user"></span> BUILDCERT Member Area</h1><hr>
                        
                        
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

</body>
</html>
<?php
