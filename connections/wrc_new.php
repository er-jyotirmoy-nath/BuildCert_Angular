<?php
ini_set('display_errors','1');

// connection to test database
$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = dbserv13vm)(PORT = 1521)))(CONNECT_DATA=(SID=certtest)))" ;

$dbh = new PDO('oci:dbname='.$db, 'agreen[wrcapp]', 'alex797', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); 


// Connection to dev database
//$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = dbserv1)(PORT = 1521)))(CONNECT_DATA=(SID=certdev)))" ;

//$dbh = new PDO('oci:dbname='.$db, 'wrcapp', 'wrcapp12');

?>