<?php 
session_start();
date_default_timezone_set('Europe/London');
ini_set('display_errors','1');
include("../lab_control_v2/connections/wrc_new.php"); 
include("../lab_control_v2/session_check_new.php");

$testing_list = array(); 
$testing_list_last = array();
$total=0;
$total_last=0;






$sql="SELECT invoicing.sample_number,
CASE 
WHEN sum(invoicing.invoice_value) > 15000 THEN 0
WHEN sum(invoicing.invoice_value) <= 1100 THEN sum(invoicing.invoice_value)/2
WHEN sum(invoicing.invoice_value) > 1100 THEN sum(invoicing.invoice_value) - 1100
END AS testing_value,
MAX(CASE
WHEN invoicing.date_paid != ' ' THEN 1
WHEN invoicing.date_paid = ' ' THEN 0
END) AS invoice_paid, 
to_date(full_details.testing_complete,'DD MONTH YYYY') AS testing_complete
FROM invoicing
RIGHT JOIN full_details ON invoicing.sample_number = full_details.sample_number
WHERE to_char(to_date(full_details.testing_complete,'DD MONTH YYYY'),'fmMonth YYYY')
= to_char(sysdate,'fmMonth YYYY')
AND credited = ' '
AND full_details.contract_number!='401' AND 
full_details.contract_number!='402' AND full_details.contract_number!='403'AND 
full_details.contract_number!='404' AND full_details.contract_number!='405'AND 
full_details.contract_number!='406' AND full_details.contract_number!='407'AND 
full_details.contract_number!='408' AND full_details.contract_number!='409'
group by invoicing.sample_number, testing_complete
order by invoicing.sample_number ASC"; 
$result = $dbh->query($sql);

while($row = $result->fetch(PDO::FETCH_ASSOC)) {

	$sample_number = $row['SAMPLE_NUMBER'];
	$invoice_value = $row['TESTING_VALUE'];
	$paid = $row['INVOICE_PAID'];
	$testing_complete = $row['TESTING_COMPLETE'];	
	//echo "$sample_number | $invoice_value <br/>";
	
	$testing_line = array();
	
	
	$total = $invoice_value + $total; 
	
	$invoice_value = number_format($invoice_value,2);
	
	array_push($testing_line, $sample_number, $invoice_value, "Testing", $paid, $testing_complete); 
	array_push($testing_list, $testing_line);
		
	}



$sql2 = "SELECT invoicing.sample_number,
CASE 
WHEN sum(invoicing.invoice_value) <= 1100 THEN sum(invoicing.invoice_value)/2
WHEN sum(invoicing.invoice_value) > 1100 THEN 1100
END AS am_value,
MAX(CASE
WHEN invoicing.date_paid != ' ' THEN 1
WHEN invoicing.date_paid = ' ' THEN 0
END) AS invoice_paid,
to_date(full_details.awaiting_test_added,'DD MONTH YYYY') AS awaiting_test_added
FROM full_details  
INNER JOIN invoicing ON full_details.sample_number = invoicing.sample_number
WHERE to_char(to_date(full_details.awaiting_test_added,'DD MONTH YYYY'),'fmMonth YYYY')
= to_char(sysdate,'fmMonth YYYY')
AND full_details.contract_number!='401' AND 
full_details.contract_number!='402' AND full_details.contract_number!='403'AND 
full_details.contract_number!='404' AND full_details.contract_number!='405'AND 
full_details.contract_number!='406' AND full_details.contract_number!='407'AND 
full_details.contract_number!='408' AND full_details.contract_number!='409'
AND invoicing.credited=' '
group by invoicing.sample_number, awaiting_test_added
order by invoicing.sample_number ASC";

$result2=$dbh->query($sql2); 

while($row = $result2->fetch(PDO::FETCH_ASSOC)) {

	$sample_number = $row['SAMPLE_NUMBER'];
	$invoice_value = $row['AM_VALUE'];
	$paid = $row['INVOICE_PAID'];
	$testing_complete = $row['AWAITING_TEST_ADDED'];

	//echo "$sample_number | $invoice_value <br/>";
	
	$am_line = array();
	
	$total = $invoice_value + $total;
	 
	$invoice_value = number_format($invoice_value,2);
	
	array_push($am_line, $sample_number, $invoice_value, "AM fees", $paid, $testing_complete); 
	array_push($testing_list, $am_line);
	
	
	}









































$sql="SELECT invoicing.sample_number,
CASE 
WHEN sum(invoicing.invoice_value) > 15000 THEN 0
WHEN sum(invoicing.invoice_value) <= 1100 THEN sum(invoicing.invoice_value)/2
WHEN sum(invoicing.invoice_value) > 1100 THEN sum(invoicing.invoice_value) - 1100
END AS testing_value,
MAX(CASE
WHEN invoicing.date_paid != ' ' THEN 1
WHEN invoicing.date_paid = ' ' THEN 0
END) AS invoice_paid,
to_date(full_details.testing_complete,'DD MONTH YYYY') AS testing_complete
FROM invoicing
RIGHT JOIN full_details ON invoicing.sample_number = full_details.sample_number
WHERE to_char(to_date(full_details.testing_complete,'DD MONTH YYYY'),'fmMonth YYYY')
= to_char(ADD_MONTHS(sysdate, -1),'fmMonth YYYY')
AND credited = ' '
AND full_details.contract_number!='401' AND 
full_details.contract_number!='402' AND full_details.contract_number!='403'AND 
full_details.contract_number!='404' AND full_details.contract_number!='405'AND 
full_details.contract_number!='406' AND full_details.contract_number!='407'AND 
full_details.contract_number!='408' AND full_details.contract_number!='409'
group by invoicing.sample_number, testing_complete
order by invoicing.sample_number ASC"; 
$result = $dbh->query($sql);

while($row = $result->fetch(PDO::FETCH_ASSOC)) {

	$sample_number = $row['SAMPLE_NUMBER'];
	$invoice_value = $row['TESTING_VALUE'];
	$paid = $row['INVOICE_PAID'];
	$testing_complete = $row['TESTING_COMPLETE'];
	
	//echo "$sample_number | $invoice_value <br/>";
	
	$testing_line = array();
	
	
	$total_last = $invoice_value + $total_last; 
	
	$invoice_value = number_format($invoice_value,2);
	
	array_push($testing_line, $sample_number, $invoice_value, "Testing", $paid, $testing_complete); 
	array_push($testing_list_last, $testing_line);
		
	}


$loop=1;
$sql2 = "SELECT invoicing.sample_number,
CASE 
WHEN sum(invoicing.invoice_value) <= 1100 THEN sum(invoicing.invoice_value)/2
WHEN sum(invoicing.invoice_value) > 1100 THEN 1100
END AS am_value,
MAX(CASE
WHEN invoicing.date_paid != ' ' THEN 1
WHEN invoicing.date_paid = ' ' THEN 0
END) AS invoice_paid,
to_date(full_details.awaiting_test_added,'DD MONTH YYYY') AS awaiting_test_added
FROM full_details  
INNER JOIN invoicing ON full_details.sample_number = invoicing.sample_number
WHERE to_char(to_date(full_details.awaiting_test_added,'DD MONTH YYYY'),'fmMonth YYYY')
= to_char(ADD_MONTHS(sysdate, -'$loop'),'fmMonth YYYY')
AND full_details.contract_number!='401' AND 
full_details.contract_number!='402' AND full_details.contract_number!='403'AND 
full_details.contract_number!='404' AND full_details.contract_number!='405'AND 
full_details.contract_number!='406' AND full_details.contract_number!='407'AND 
full_details.contract_number!='408' AND full_details.contract_number!='409'
AND invoicing.credited=' '
group by invoicing.sample_number, awaiting_test_added
order by invoicing.sample_number ASC";

$result2=$dbh->query($sql2); 

while($row = $result2->fetch(PDO::FETCH_ASSOC)) {

	$sample_number = $row['SAMPLE_NUMBER'];
	$invoice_value = $row['AM_VALUE'];
	$paid = $row['INVOICE_PAID'];
	$testing_complete = $row['AWAITING_TEST_ADDED'];
	
	//echo "$sample_number | $invoice_value <br/>";
	
	$am_line = array();
	
	$total_last = $invoice_value + $total_last;
	 
	$invoice_value = number_format($invoice_value,2);
	
	array_push($am_line, $sample_number, $invoice_value, "AM fees", $paid, $testing_complete); 
	array_push($testing_list_last, $am_line);
	
	
	}
	
	
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Lab Control v2, Testing Breakdown</title>
<meta name="description" content="" />
<link href="styles.css" rel="stylesheet" type="text/css" />

</head>
<div id="content">

<table>
	<tr><td valign="top">
		This month <br/>
		<table>
			
		<?php 


usort($testing_list, function($a, $b) {
    return $a['0'] - $b['0'];
});

foreach($testing_list as $value){
	
	if($value[3]=="0"){
		echo 	"<tr><td><font color=\"red\">$value[0] </font></td><td>-</td><td> <font color=\"red\">&pound;$value[1] </font></td><td>-</td><td> <font color=\"red\">$value[2]</font></td><td>-</td><td>$value[4]</td></tr>";
	}else{
		echo 	"<tr><td>$value[0] </td><td>-</td><td> &pound;$value[1] </td><td>-</td><td> $value[2]</td><td>-</td><td>$value[4]</td></tr>";	
	}
	

}

?>

		</table>
<hr/>
		<br/>Total: <?php echo "&pound".number_format($total,2) ?>
	</td>
	<td width="200"> &nbsp;</td>
	<td valign="top">
		Last month <br/>
		<table>
		<?php 


usort($testing_list_last, function($a, $b) {
    return $a['0'] - $b['0'];
});

foreach($testing_list_last as $value){
	
	if($value[3]=="0"){
		echo 	"<tr><td><font color=\"red\">$value[0] </font></td><td>-</td><td> <font color=\"red\">&pound;$value[1] </font></td><td>-</td><td> <font color=\"red\">$value[2]</font></td><td>-</td><td>$value[4]</td></tr>";
	}else{
		echo 	"<tr><td>$value[0] </td><td>-</td><td> &pound;$value[1] </td><td>-</td><td> $value[2]</td><td>-</td><td>$value[4]</td></tr>";	
	}
	
}

?>
</table>
<hr/>
		<br/>Total: <?php echo "&pound".number_format($total_last,2) ?>
	</td>
	
	</tr>

</table>
	

</div>


