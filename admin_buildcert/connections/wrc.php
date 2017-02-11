<?php


$db_host = "192.168.130.38";
$db_name = "CERTDEV";
$db_user = "WRCAPP";
$db_pass = "wrcapp12";
$dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




/*

 $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.130.38)(PORT = 1521)))(CONNECT_DATA=(SID=CERTDEV)))" ;



 if($dbh = OCILogon("WRCAPP", "wrcapp12", $db))
    {
        echo "Successfully connected to Oracle.\n";
        OCILogoff($c);
    }
    else
    {
        $err = OCIError();
        echo "Connection failed." . $err[text];
    }



$dbhost = 'Localhost';
$dbuser = 'wrcns194';
$dbpass = 'Plumb1ng1';
mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
*/
?>