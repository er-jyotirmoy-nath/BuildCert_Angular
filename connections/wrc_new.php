<?php
ini_set('display_errors','1');

// connection to test database
/*$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = dbserv13vm)(PORT = 1521)))(CONNECT_DATA=(SID=certtest)))" ;

$dbh = new PDO('oci:dbname='.$db, 'agreen[wrcapp]', 'alex797', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); 
*/

// Connection to dev database
//$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = dbserv1)(PORT = 1521)))(CONNECT_DATA=(SID=certdev)))" ;

//$dbh = new PDO('oci:dbname='.$db, 'wrcapp', 'wrcapp12');

?>
<?php
$tns = "  
(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = 127.0.0.1)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SERVICE_NAME = XE)
    )
  )
       ";
$db_username = "sa";
$db_password = "sa";
try{
    $dbh = new PDO("oci:dbname=".$tns,$db_username,$db_password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   /*  $sql_seq = "CREATE SEQUENCE wrc.RIG_VAL_SEQ START WITH 1 INCREMENT BY 1 CACHE 100";
    $query_seq = $bdd->prepare($sql_seq);
    $query_seq->execute(); */
   
}catch(PDOException $e){
    echo ($e->getMessage());
   
}
?>