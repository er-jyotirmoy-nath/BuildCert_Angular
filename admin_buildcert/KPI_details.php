<?php 
session_start();
date_default_timezone_set('Europe/London');
ini_set('display_errors','0');
include("../lab_control_v2/connections/wrc_new.php"); 
include("../lab_control_v2/session_check_new.php");

$step = $_GET['step'];
$contract_number = $_GET['contract'];
$date3 = $_GET['date3'];
$date = $_GET['date'];
$PM = $_GET['PM'];
/*
function cleanDataForDB($data) {	$data = trim(htmlentities(strip_tags($data)));		
if (get_magic_quotes_gpc())		
$data = stripslashes($data);		
$data = mysql_real_escape_string($data);		
return $data;}

foreach($_GET as $key => $value) {	$clean[$key] = cleanDataForDB($value);}
*/

if(!isset($_SESSION['staff_number'])){
header("location: login.php");
exit();}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Lab Control v2, lab breakdown full</title>
<meta name="description" content="" />
<link href="styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {background-image:url('../css/tileable_red_brick_texture.png');}
</style>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-9371285-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</head>
<?php include("../lab_control_v2/email_header.php"); ?>
<div id="content">

<?php

// Last action date to be added.

// Has buttons in the page header which performs different functions including; view all files & view all of my file initially.

// Outputs are sample number, next action, next action due date & overdue showing how many days over.


$counter=1;
$counter_alt=0;
$counter_alt_2=0;
$testing_started_counter = 0;
$product_testing_complete_counter = 0;
$testing_report_complete_counter = 0;
$colour1="FFFFFF";
$colour2="F2F2F2";
		
//////////////////////////////////////////////////////////////////////////////////////////////////// ?>

		<table width="1000" border="0" cellspacing="0" align="center">
	
		<?php




if($PM=="all" || $PM==""){
	
if($contract_number !="" && $contract_number !="202"){
$sql="SELECT sample_number, PM, file_created, contract_number FROM Full_details WHERE file_created_basic LIKE '%$date%' AND contract_number='$contract_number' ORDER BY sample_number DESC"; 
$sql2="SELECT sample_number, PM, awaiting_test_added, contract_number, PMT FROM Full_details WHERE awaiting_test_added LIKE '%$date%' AND contract_number='$contract_number' ORDER BY awaiting_test_added_data DESC";
$sql4="SELECT sample_number, PM, pag_sent, contract_number, PMT, rating FROM Full_details WHERE pag_sent LIKE '%$date%' AND contract_number='$contract_number' ORDER BY pag_sent_data DESC";

}
if($contract_number ==""){
$sql="SELECT sample_number, PM, file_created, contract_number FROM Full_details WHERE file_created_basic LIKE '%$date%' AND contract_number!='202'  AND contract_number!='401' AND contract_number!='402' AND contract_number!='403'ORDER BY sample_number DESC";  
$sql2="SELECT sample_number, PM, awaiting_test_added, contract_number, PMT FROM Full_details WHERE awaiting_test_added LIKE '%$date%' AND contract_number!='202'  AND contract_number!='401' AND contract_number!='402' AND contract_number!='403'ORDER BY awaiting_test_added_data DESC";  
$sql4="SELECT sample_number, PM, pag_sent, contract_number, PMT, rating FROM Full_details WHERE pag_sent LIKE '%$date%' AND contract_number!='202'  AND contract_number!='401' AND contract_number!='402' AND contract_number!='403'ORDER BY pag_sent_data DESC";  
}

$sql3="SELECT sample_number, PM, test_inspector, testing_report_complete, testing_report_complete_data, contract_number, TIT FROM Full_details WHERE testing_report_complete LIKE '%$date%' AND contract_number!='202' AND contract_number!='401' AND contract_number!='402' AND contract_number!='403' ORDER BY testing_report_complete_data DESC";  
$sql7="SELECT sample_number, PM, materials_ok, contract_number FROM Full_details WHERE materials_ok LIKE '%$date%' AND contract_number!='202' AND contract_number!='401' AND contract_number!='402' AND contract_number!='403' ORDER BY materials_ok_data DESC";  
$sql8="SELECT sample_number, PM, testing_checked, contract_number, PMT, rating FROM Full_details WHERE testing_checked LIKE '%$date%' AND contract_number!='202' AND contract_number!='401' AND contract_number!='402' AND contract_number!='403' ORDER BY testing_checked_data DESC";

}
else{

if($contract_number !="" && $contract_number !="202"){
$sql="SELECT sample_number, PM, file_created, contract_number FROM Full_details WHERE file_created_basic LIKE '%$date%' AND contract_number='$contract_number' AND PM='$PM' ORDER BY sample_number DESC"; 
$sql2="SELECT sample_number, PM, awaiting_test_added, contract_number, PMT FROM Full_details WHERE awaiting_test_added LIKE '%$date%' AND contract_number='$contract_number' AND PM='$PM' ORDER BY awaiting_test_added_data DESC";
$sql4="SELECT sample_number, PM, pag_sent, contract_number, PMT, rating FROM Full_details WHERE pag_sent LIKE '%$date%' AND contract_number='$contract_number' AND PM='$PM' ORDER BY pag_sent_data DESC";
}
if($contract_number ==""){
$sql="SELECT sample_number, PM, file_created, contract_number FROM Full_details WHERE file_created_basic LIKE '%$date%' AND PM='$PM' AND contract_number!='202' AND contract_number!='401' AND contract_number!='402' AND contract_number!='403' ORDER BY sample_number DESC";  
$sql2="SELECT sample_number, PM, awaiting_test_added, contract_number, PMT FROM Full_details WHERE awaiting_test_added LIKE '%$date%' AND PM='$PM' AND contract_number!='202' AND contract_number!='401' AND contract_number!='402' AND contract_number!='403' ORDER BY awaiting_test_added_data DESC"; 
$sql4="SELECT sample_number, PM, pag_sent, contract_number, PMT, rating FROM Full_details WHERE pag_sent LIKE '%$date%' AND PM='$PM' AND contract_number!='202' AND contract_number!='401' AND contract_number!='402' AND contract_number!='403' ORDER BY pag_sent_data DESC";   
}		

$sql3="SELECT sample_number, PM, test_inspector, testing_report_complete, testing_report_complete_data, contract_number, TIT FROM Full_details WHERE testing_report_complete LIKE '%$date%' AND PM='$PM' AND contract_number!='202' AND contract_number!='401' AND contract_number!='402' AND contract_number!='403' ORDER BY testing_report_complete_data DESC";
$sql7="SELECT sample_number, PM, materials_ok, contract_number FROM Full_details WHERE materials_ok LIKE '%$date%' AND PM='$PM' AND contract_number!='202' AND contract_number!='401' AND contract_number!='402' AND contract_number!='403' ORDER BY materials_ok_data DESC";	
$sql8="SELECT sample_number, PM, testing_checked, contract_number, PMT, rating FROM Full_details WHERE testing_checked LIKE '%$date%' AND PM='$PM' AND contract_number!='202' AND contract_number!='401' AND contract_number!='402' AND contract_number!='403' ORDER BY testing_checked_data DESC";  

}

$owain_count = 0;
$chris_count=0;
$corrie_count=0;
$jo_count=0;
$lee_count=0;
$nigel_count=0;
$stan_count=0;
$mary_count=0;
$rui_count=0;
$stephen_count=0;
$bobbie_count=0;


$owain_correction = 0;
$chris_correction=0;
$corrie_correction=0;
$jo_correction=0;
$lee_correction=0;
$nigel_correction=0;
$richard_correction=0;
$stan_correction=0;
$mary_correction=0;
$rui_correction=0;
$stephen_correction=0;
$bobbie_correction=0;


$owain_rating = 0;
$chris_rating=0;
$corrie_rating=0;
$jo_rating=0;
$lee_rating=0;
$nigel_rating=0;
$richard_rating=0;

$owain_rating=0;
$mary_rating=0;
$rui_rating=0;
$stephen_rating=0;
$bobbie_rating=0;

$corrie_total=0;
$chris_total=0;
$jo_total=0;
$lee_total=0;
$nigel_total=0;
$richard_total=0;
$stan_total=0;
$mary_total=0;
$rui_total=0;
$stephen_total=0;
$bobbie_total=0;
$owain_total =0;

$owain_tit = 0;
$corrie_tit=0;
$chris_tit=0;
$jo_tit=0;
$lee_tit=0;
$nigel_tit=0;
$richard_tit=0;
$stan_tit=0;
$mary_tit=0;
$rui_tit=0;
$stephen_tit=0;
$bobbie_tit=0;

$adam_total=0;	
$dale_total=0;
$dan_total=0;
$ianh_total=0;
$ianj_total=0;
$jay_total=0;
$mat_total=0;
$mike_total=0;
$neth_total=0;
$shaun_total=0;
$steve_total=0;
$otehr_total=0;
		
$adam_count=0;	
$dale_count=0;
$dan_count=0;
$ianj_count=0;
$jay_count=0;
$mat_count=0;
$neth_count=0;
$steve_count=0;
$other_count=0;

$luke_count=0;
$paul_count=0;
$nick_count=0;


$adam_tit=0;	
$dale_tit=0;
$dan_tit=0;
$ianj_tit=0;
$jay_tit=0;
$mat_tit=0;
$neth_tit=0;
$steve_tit=0;
$other_tit=0;

$luke_tit=0;
$paul_tit=0;
$nick_tit=0;

if($step =="apps_received"){
	?>
	
		 <tr><td></td><td><b>Sample Number</b></td><td><b>PM</b></td><td><b>File Created</b></td><td><b>Contract Number</b></td><td></td></tr>  	

<?php
$counter=1;
$total_time = 0;

$stmt = $dbh->query($sql);
 
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

		$sample_number = $row['SAMPLE_NUMBER'];		
		$PM = trim($row['PM']);
		$file_created = $row['FILE_CREATED'];
		$contract_number = $row['CONTRACT_NUMBER'];
		$rating = $row['RATING'];
		
	echo "<tr>
	<td width=\"50\"> $counter.</td>
	<td width=\"100\"><a href=\"look_up.php?sample_number=$sample_number&look_up=sample_number\" target=\"_blank\">$sample_number</a></td>
	<td width=\"175\">$PM</td>
	<td width=\"150\">$file_created</td>
	<td width=\"100\">$contract_number</td>		
	</tr>";
	
	$counter++;
	
	if($PM=="Richard Davies"){$richard_count++;}
	if($PM=="Chris Davies"){$chris_count++;}
	if($PM=="Jo Ralph"){$jo_count++;}
	if($PM=="Lee Nichols"){$lee_count++;}
	if($PM=="Stan Gray"){$stan_count++;}
	if($PM=="Mary Ann Taylor"){$mary_count++;}
	if($PM=="Rui Dias"){$rui_count++;}
	if($PM=="Stephen Speirs"){$stephen_count++;}
	if($PM=="Bobbie Johnson"){$bobbie_count++;}
	if($PM=="Owain Richards-green"){$owain_count++;}


	
			}
	echo "<tr>
	<td width=\"50\">  </td>
	<td width=\"100\"> </td>
	<td width=\"175\"><hr>
		Bobbie Johnson $bobbie_count <br/>	
		Chris Davies $chris_count <br/>
		Jo Ralph $jo_count <br/>
		Lee Nichols $lee_count <br/>
		Mary Ann Taylor $mary_count <br/>
		Owain Richards-Green $owain_count <br/>
		Richard Davies $richard_count <br/> 
		Rui Dias $rui_count <br/>
		Stan Gray $stan_count <br/>
		Stephen Speirs $stephen_count <br/>
 
						<hr>
		Total ", $counter - 1 ."
	</td>
	<td width=\"150\"> </td>
	<td width=\"100\"> </td>		
	</tr>";


}
if($step =="apps_ok"){
	?>
	
		 <tr><td></td><td><b>Sample Number</b></td><td><b>PM</b></td><td><b>File OK'd</b></td><td><b>Contract Number</b></td><td></td></tr>  	

<?php
$counter=1;
$total_time = 0;

$stmt = $dbh->query($sql7);
 
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {	

		$sample_number = $row['SAMPLE_NUMBER'];		
		$PM = trim($row['PM']);
		$materials_ok = $row['MATERIALS_OK'];
		$contract_number = $row['CONTRACT_NUMBER'];
		$rating = $row['RATING'];
		
	echo "<tr>
	<td width=\"50\"> $counter.</td>
	<td width=\"100\"><a href=\"look_up.php?sample_number=$sample_number&look_up=sample_number\" target=\"_blank\">$sample_number</a></td>
	<td width=\"175\">$PM</td>
	<td width=\"150\">$materials_ok</td>
	<td width=\"100\">$contract_number</td>		
	</tr>";
	
	$counter++;
	
	if($PM=="Richard Davies"){$richard_count++;}
	if($PM=="Chris Davies"){$chris_count++;}
	if($PM=="Jo Ralph"){$jo_count++;}
	if($PM=="Lee Nichols"){$lee_count++;}
	if($PM=="Stan Gray"){$stan_count++;}
	if($PM=="Owain Richards-Green"){$mary_count++;}
	if($PM=="Rui Dias"){$rui_count++;}
	if($PM=="Stephen Speirs"){$stephen_count++;}
	if($PM=="Bobbie Johnson"){$bobbie_count++;}
	if($PM=="Bobbie Johnson"){$owain_count++;}
			}
	echo "<tr>
	<td width=\"50\">  </td>
	<td width=\"100\"> </td>
	<td width=\"175\"><hr>
		Bobbie Johnson $bobbie_count <br/>	
		Chris Davies $chris_count <br/>
		Jo Ralph $jo_count <br/>
		Lee Nichols $lee_count <br/>
		Mary Ann Taylor $mary_count <br/>
		Owain Richards-Green $owain_count <br/>
		Richard Davies $richard_count <br/> 
		Rui Dias $rui_count <br/>
		Stan Gray $stan_count <br/>
		Stephen Speirs $stephen_count <br/>
		<hr>
		Total ", $counter - 1 ."
	</td>
	<td width=\"150\"> </td>
	<td width=\"100\"> </td>		
	</tr>";

}
if($step =="apps_forwarded"){
	?>
	
		 <tr><td></td><td><b>Sample Number</b></td><td><b>PM</b></td><td><b>Time Spent</b></td><td><b>Forwarded for test</b></td><td><b>Contract Number</b></td><td></td></tr>  	

<?php
$counter=1;
$total_time = 0;
$num = 0;
$stmt = $dbh->query($sql2);
 
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {	

		$sample_number = $row['SAMPLE_NUMBER'];		
		$PM = trim($row['PM']);
		$PMT = $row['PMT'];
		$awaiting_test_added = $row['AWAITING_TEST_ADDED'];
		$contract_number = $row['CONTRACT_NUMBER'];		
		$rating = $row['RATING'];

$stmt2 = $dbh->query("SELECT invoice_value FROM Invoicing WHERE sample_number = '$sample_number' AND (credited = NULL OR credited=' ')");
 
 $invoice_value = 0;
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
	$invoice_value2 = $row2['INVOICE_VALUE'];
	$invoice_value = $invoice_value + $invoice_value2; 
}
		
	echo "<tr>
	<td width=\"50\"> $counter.</td>
	<td width=\"100\"><a href=\"look_up.php?sample_number=$sample_number&look_up=sample_number\" target=\"_blank\">$sample_number</a></td>
	<td width=\"100\">&pound;".number_format($invoice_value,2)."</td>
	<td width=\"175\">$PM</td>
	<td width=\"150\">$awaiting_test_added</td>
	<td width=\"100\">$contract_number</td>		
	</tr>";
	
	$counter++;
	
	if($PM=="Richard Davies"){$richard_count++; $richard_total = $richard_total + $invoice_value; $richard_tit = $richard_tit + $PMT;}
	if($PM=="Chris Davies"){$chris_count++; $chris_total = $chris_total + $invoice_value; $chris_tit = $chris_tit + $PMT;}
	if($PM=="Bobbie Johnson"){$bobbie_count++; $bobbie_total = $bobbie_total + $invoice_value; $bobbie_tit = $bobbie_tit + $PMT;}
	if($PM=="Jo Ralph"){$jo_count++; $jo_total = $jo_total + $invoice_value; $jo_tit = $jo_tit + $PMT;}
	if($PM=="Lee Nichols"){$lee_count++; $lee_total = $lee_total + $invoice_value; $lee_tit = $lee_tit + $PMT;}
	if($PM=="Stephen Speirs"){$stephen_count++; $stephen_total = $stephen_total + $invoice_value; $stephen_tit = $stephen_tit + $PMT;}

	if($PM=="Stan Gray"){$stan_count++; $stan_total = $stan_total + $invoice_value; $stan_tit = $stan_tit + $PMT;}
	if($PM=="Mary Ann Taylor"){$mary_count++; $mary_total = $mary_total + $invoice_value; $mary_tit = $mary_tit + $PMT;}
	if($PM=="Rui Dias"){$rui_count++; $rui_total = $rui_total + $invoice_value; $rui_tit = $rui_tit + $PMT;}
	if($PM=="Owain Richards-green"){$owain_count++; $owain_total = $owain_total + $invoice_value; $owain_tit = $owain_tit + $PMT;}


	
	$total = $total + $invoice_value;
	$total_time = $total_time + $PMT;
	$num++;
			}
	echo "<tr>
	<td width=\"50\">  </td>
	<td width=\"100\"> </td>

	<td width=\"100\"><hr>
		&pound; ". number_format($bobbie_total,2)."<br/>	
		&pound; ". number_format($chris_total,2)."<br/>
		&pound; ". number_format($jo_total,2)."<br/>
		&pound; ". number_format($lee_total,2)."<br/>
		&pound; ". number_format($mary_total,2)."<br/>
		&pound; ". number_format($owain_total,2)."<br/> 
		&pound; ". number_format($richard_total,2)."<br/>
		&pound; ". number_format($rui_total,2)."<br/>
		&pound; ". number_format($stan_total,2)."<br/> 
		&pound; ". number_format($stephen_total,2)."<br/>
		
		<hr>
		&pound; ". number_format($total,2)."
	</td>
		
	<td width=\"175\"><hr>
		Bobbie Johnson $bobbie_count <br/>	
		Chris Davies $chris_count <br/>
		Jo Ralph $jo_count <br/>
		Lee Nichols $lee_count <br/>
		Mary Ann Taylor $mary_count <br/>
		Owain Richards-Green $owain_count <br/>
		Richard Davies $richard_count <br/> 
		Rui Dias $rui_count <br/>
		Stan Gray $stan_count <br/>
		Stephen Speirs $stephen_count <br/>

		<hr>
		Total files $num
		
	</td>
	<td width=\"125\">
	</td>
	<td width=\"100\"> 
	</td>		
	</tr>";

}
if($step =="apps_tested"){
	?>
		 <tr><td></td><td><b>Sample Number</b></td><td><b>Value</b></td><td><b>PM</b></td><td><b>TI</b></td><td><b>Testing Time Spent</b></td><td><b>Testing Complete</b></td><td><b>Contract Number</b></td><td></td></tr>  	
<?php
$counter=1;
$total_time = 0;
$num = 0;
$stmt = $dbh->query($sql3);
 
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

		$sample_number = $row['SAMPLE_NUMBER'];		
		$PM = trim($row['PM']);
		$test_inspector = trim($row['TEST_INSPECTOR']);
		$testing_report_complete = $row['TESTING_REPORT_COMPLETE'];
		$testing_report_complete_data = $row['TESTING_REPORT_COMPLETE_DATA'];
		$contract_number = $row['CONTRACT_NUMBER'];
		$TIT = $row['TIT'];
		$rating = $row['RATING'];

$stmt2 = $dbh->query("SELECT invoice_value FROM Invoicing WHERE sample_number = '$sample_number' AND (credited = NULL OR credited=' ')");
 
 $invoice_value = 0;
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
	$invoice_value2 = $row2['INVOICE_VALUE'];
	$invoice_value = $invoice_value + $invoice_value2; 
}
	
	echo "<tr>
	<td width=\"50\"> $counter.</td>
	<td width=\"100\"><a href=\"look_up.php?sample_number=$sample_number&look_up=sample_number\" target=\"_blank\">$sample_number</a></td>
	<td width=\"100\">&pound;".number_format($invoice_value,2)."</td>
	<td width=\"175\">$PM</td>
	<td width=\"125\">$test_inspector</td>
	<td width=\"125\">$TIT</td>
	<td width=\"150\">$testing_report_complete</td>
	<td width=\"100\">$contract_number</td>		
	</tr>";
	
	$counter++;
	

	if($test_inspector=="Adam Cooksey"){$adam_count++; $adam_total = $adam_total + $invoice_value; $adam_tit = $adam_tit + $invoice_value;}
	if($test_inspector=="Dale Roberts"){$dale_count++; $dale_total = $dale_total + $invoice_value; $dale_tit = $dale_tit + $invoice_value;}
	if($test_inspector=="Daniel Atkins"){$dan_count++; $dan_total = $dan_total + $invoice_value; $dan_tit = $dan_tit + $invoice_value;}
	if($test_inspector=="Ian Jones"){$ianj_count++; $ianj_total = $ianj_total + $invoice_value; $ianj_tit = $ianj_tit + $invoice_value;}
	if($test_inspector=="Jay Manning"){$jay_count++; $jay_total = $jay_total + $invoice_value; $jay_tit = $jay_tit + $invoice_value;}
	
	if($test_inspector=="Mathew Mcgovern"){$mat_count++; $mat_total = $mat_total + $invoice_value; $mat_tit = $mat_tit + $invoice_value;}
	if($test_inspector=="Nethan Nichols"){$neth_count++; $neth_total = $neth_total + $invoice_value; $neth_tit = $neth_tit + $invoice_value;}
	if($test_inspector=="Stephen Mccann"){$steve_count++; $steve_total = $steve_total + $invoice_value; $steve_tit = $steve_tit + $invoice_value;}
	
	if($test_inspector=="Nick Evans"){$nick_count++; $snick_total = $nick_total + $invoice_value; $nick_tit = $nick_tit + $invoice_value;}
	if($test_inspector=="Luke Yates"){$luke_count++; $luke_total = $luke_total + $invoice_value; $luke_tit = $luke_tit + $invoice_value;}
	if($test_inspector=="Paul Smith"){$paul_count++; $paul_total = $paul_total + $invoice_value; $paul_tit = $paul_tit + $invoice_value;}
	
	if($test_inspector!="Stephen Mccann" &&
	$test_inspector!="Nick Evans" &&
	$test_inspector!="Nethan Nichols" &&
	$test_inspector!="Luke Yates" &&
	$test_inspector!="Mathew Mcgovern" &&
	$test_inspector!="Jay Manning" &&
	$test_inspector!="Ian Jones" &&
	$test_inspector!="Paul Smith" &&
	$test_inspector!="Daniel Atkins" &&
	$test_inspector!="Dale Roberts" && 
	$test_inspector!="Adam Cooksey"){
		$other_count++; $other_total = $other_total + $invoice_value; $other_tit = $other_tit + $TIT;
	}
	
	$total = $total + $invoice_value;
	$total_time = $total_time + $TIT;
	$num++;
			}
	echo "<tr>
	<td width=\"50\">  </td>
	<td width=\"100\"> </td>

	<td width=\"100\"><hr>
		&pound; ". number_format($adam_total,2)."<br/>	
		&pound; ". number_format($dale_total,2)."<br/>
		&pound; ". number_format($dan_total,2)."<br/>
		
		&pound; ". number_format($ianj_total,2)."<br/>
		&pound; ". number_format($jay_total,2)."<br/>
		 
		&pound; ". number_format($luke_total,2)."<br/>
		&pound; ". number_format($mat_total,2)."<br/>
		
		&pound; ". number_format($neth_total,2)."<br/>
		&pound; ". number_format($nick_total,2)."<br/>
		&pound; ". number_format($paul_total,2)."<br/>
		
		&pound; ". number_format($steve_total,2)."<br/> 
		&pound; ". number_format($other_total,2)."<br/> 		
		<hr>
		&pound; ". number_format($total,2)."
	</td>
	<td width=\"125\"> </td>	
	<td width=\"125\"><hr>
		Adam Cooksey $adam_count <br/>	
		Dale Roberts $dale_count <br/>
		Dan Atkins $dan_count <br/>
		
		Ian Jones $ianj_count <br/>
		Jay Manning $jay_count <br/>
		 
		Luke Yates $luke_count <br/>
		Mathew Mcgovern $mat_count <br/>
		
		Nethan Nichols $neth_count <br/>
		Nick Evans $nick_count <br/>
		Paul Smith $paul_count <br/>
		
		Stephen Mccann $steve_count <br/>
		Other $other_count <br/> 		 
		<hr>
		Total files $num
		
	</td>
	<td width=\"125\"><hr>
		 ". number_format($adam_tit / 3600,2)." <br/>	
		 ". number_format($dale_tit / 3600,2)." <br/>
		 ". number_format($dan_tit / 3600,2)." <br/>
		 ". number_format($ianj_tit / 3600,2)."<br/>
		 ". number_format($jay_tit / 3600,2)." <br/> 
		 ". number_format($luke_tit / 3600,2)." <br/>
		 ". number_format($mat_tit / 3600,2)." <br/>
		 ". number_format($neth_tit / 3600,2)." <br/>
		 ". number_format($nick_tit / 3600,2)." <br/>
		 ". number_format($paul_tit / 3600,2)." <br/>
		 ". number_format($steve_tit / 3600,2)." <br/>
		 ". number_format($other_tit / 3600,2)." <br/> 		 
		<hr>
		 ". number_format($total_time / 3600,2)."
		
	</td>
	<td width=\"100\"> </td>		
	</tr>";


}
		if($step=="apps_returned"){
	?>
	
		 <tr><td></td><td><b>Sample Number</b></td><td><b>PM</b></td><td><b>Time Spent</b></td><td><b>Returned From Lab</b></td><td><b>Contract Number</b></td><td></td></tr>  	

<?php
$counter=1;
$total_time = 0;
$num = 0;
$stmt = $dbh->query($sql8);
 
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {	

		$sample_number = $row['SAMPLE_NUMBER'];		
		$PM = trim($row['PM']);
		$PMT = $row['PMT'];
		$testing_checked = $row['TESTING_CHECKED'];
		$contract_number = $row['CONTRACT_NUMBER'];		
		$rating = $row['RATING'];
		
	echo "<tr>
	<td width=\"50\"> $counter.</td>
	<td width=\"100\"><a href=\"look_up.php?sample_number=$sample_number&look_up=sample_number\" target=\"_blank\">$sample_number</a></td>
	<td width=\"175\">$PM</td>
	<td width=\"125\">".number_format($PMT/3600,2)." (hours)</td>
	<td width=\"150\">$testing_checked</td>
	<td width=\"100\">$contract_number</td>		
	</tr>";
	
	$counter++;

	if($PM=="Richard Davies"){$richard_count++; $richard_total = $richard_total + $invoice_value; $richard_tit = $richard_tit + $PMT;}
	if($PM=="Chris Davies"){$chris_count++; $chris_total = $chris_total + $invoice_value; $chris_tit = $chris_tit + $PMT;}
	if($PM=="Bobbie Johnson"){$bobbie_count++; $bobbie_total = $bobbie_total + $invoice_value; $bobbie_tit = $bobbie_tit + $PMT;}
	if($PM=="Jo Ralph"){$jo_count++; $jo_total = $jo_total + $invoice_value; $jo_tit = $jo_tit + $PMT;}
	if($PM=="Lee Nichols"){$lee_count++; $lee_total = $lee_total + $invoice_value; $lee_tit = $lee_tit + $PMT;}
	if($PM=="Stephen Speirs"){$stephen_count++; $stephen_total = $stephen_total + $invoice_value; $stephen_tit = $stephen_tit + $PMT;}

	if($PM=="Stan Gray"){$stan_count++; $stan_total = $stan_total + $invoice_value; $stan_tit = $stan_tit + $PMT;}
	if($PM=="Mary Ann Taylor"){$mary_count++; $mary_total = $mary_total + $invoice_value; $mary_tit = $mary_tit + $PMT;}
	if($PM=="Rui Dias"){$rui_count++; $rui_total = $rui_total + $invoice_value; $rui_tit = $rui_tit + $PMT;}
	if($PM=="Owain Richards-green"){$owain_count++; $owain_total = $owain_total + $invoice_value; $owain_tit = $owain_tit + $PMT;}
	
	
	
	$total = $total + $invoice_value;
	$total_time = $total_time + $PMT;
	$num++;
			}
	echo "<tr>
	<td width=\"50\">  </td>
	<td width=\"100\"> </td>
		
	<td width=\"175\"><hr>
		Bobbie Johnson $bobbie_count <br/>	
		Chris Davies $chris_count <br/>
		Jo Ralph $jo_count <br/>
		Lee Nichols $lee_count <br/>
		Mary Ann Taylor $mary_count <br/>
		Owain Richards-Green $owain_count <br/>
		Richard Davies $richard_count <br/> 
		Rui Dias $rui_count <br/>
		Stan Gray $stan_count <br/>
		Stephen Speirs $stephen_count <br/>
		<hr>
		Total files $num
		
	</td>
	<td width=\"125\"><hr>
		Total Time : ". number_format($bobbie_tit / 3600,2)."  <br/>	
		Total Time : ". number_format($chris_tit / 3600,2)." <br/>
		Total Time : ". number_format($jo_tit / 3600,2)." <br/>
		Total Time : ". number_format($lee_tit / 3600,2)." <br/>
		Total Time : ". number_format($mary_tit / 3600,2)."<br/>
		Total Time : ". number_format($owain_tit / 3600,2)." <br/> 	 
		Total Time : ". number_format($richard_tit / 3600,2)." <br/>
		Total Time : ". number_format($rui_tit / 3600,2)." <br/>
		Total Time : ". number_format($stan_tit / 3600,2)."<br/>
		Total Time : ". number_format($stephen_tit / 3600,2)." <br/> 	 
		
				<hr>
		Total Time : ". number_format($total_time / 3600,2)."
		
	</td>
	<td width=\"100\"> 
	<hr>
		Ave Time/File : ". number_format(($bobbie_tit/$corrie_count) / 3600,2)."  <br/>	
		Ave Time/File : ". number_format(($chris_tit/$chris_count) / 3600,2)." <br/>
		Ave Time/File : ". number_format(($jo_tit/$jo_count) / 3600,2)." <br/>
		Ave Time/File : ". number_format(($lee_tit/$lee_count) / 3600,2)." <br/>
		Ave Time/File : ". number_format(($mary_tit/$nigel_count) / 3600,2)."<br/>
		Ave Time/File : ". number_format(($owain_tit/$richard_count) / 3600,2)." <br/> 	 
		Ave Time/File : ". number_format(($richard_tit/$jo_count) / 3600,2)." <br/>
		Ave Time/File : ". number_format(($rui_tit/$lee_count) / 3600,2)." <br/>
		Ave Time/File : ". number_format(($stan_tit/$nigel_count) / 3600,2)."<br/>
		Ave Time/File : ". number_format(($stephen_tit/$richard_count) / 3600,2)." <br/> 	
				<hr>
		Ave Time/File : ". number_format(($total_time/$num) / 3600,2)."	
	
	
	</td>		
	</tr>";

}

		if($step=="apps_pag"){
	?>
	
		 <tr><td></td><td><b>Sample Number</b></td><td><b>PM</b></td><td><b>Time Spent</b></td><td><b>Forwarded to PAG</b></td><td><b>Contract Number</b></td><td></td></tr>  	

<?php
$counter=1;
$total_time = 0;
$num = 0;
$num2 = 0;
$stmt = $dbh->query($sql4);
 
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {	

		$sample_number = $row['SAMPLE_NUMBER'];		
		$PM = trim($row['PM']);
		$PMT = $row['PMT'];
		$pag_sent = $row['PAG_SENT'];
		$contract_number = $row['CONTRACT_NUMBER'];	
		$rating = $row['RATING'];	
		
	echo "<tr>
	<td width=\"50\"> $counter.</td>
	<td width=\"100\"><a href=\"look_up.php?sample_number=$sample_number&look_up=sample_number\" target=\"_blank\">$sample_number</a></td>
	<td width=\"175\">$PM</td>
	<td width=\"125\">".number_format($PMT/3600,2)." (hours)</td>
	<td width=\"150\">$pag_sent</td>
	<td width=\"100\">$contract_number</td>		
	";
	if($session_email=="agreen@nsf.org" || $session_email=="jprice@nsf.org" || $session_email=="gmapp@nsf.org")
	{
	echo"	
	<td>$rating</td>";}
	echo"
	
	</tr>";
	
	$counter++;
	

	if($PM=="Richard Davies"){$richard_count++; $richard_total = $richard_total + $invoice_value; $richard_tit = $richard_tit + $PMT;}
	if($PM=="Chris Davies"){$chris_count++; $chris_total = $chris_total + $invoice_value; $chris_tit = $chris_tit + $PMT;}
	if($PM=="Bobbie Johnson"){$bobbie_count++; $bobbie_total = $bobbie_total + $invoice_value; $bobbie_tit = $bobbie_tit + $PMT;}
	if($PM=="Jo Ralph"){$jo_count++; $jo_total = $jo_total + $invoice_value; $jo_tit = $jo_tit + $PMT;}
	if($PM=="Lee Nichols"){$lee_count++; $lee_total = $lee_total + $invoice_value; $lee_tit = $lee_tit + $PMT;}
	if($PM=="Stephen Speirs"){$stephen_count++; $stephen_total = $stephen_total + $invoice_value; $stephen_tit = $stephen_tit + $PMT;}

	if($PM=="Stan Gray"){$stan_count++; $stan_total = $stan_total + $invoice_value; $stan_tit = $stan_tit + $PMT;}
	if($PM=="Mary Ann Taylor"){$mary_count++; $mary_total = $mary_total + $invoice_value; $mary_tit = $mary_tit + $PMT;}
	if($PM=="Rui Dias"){$rui_count++; $rui_total = $rui_total + $invoice_value; $rui_tit = $rui_tit + $PMT;}
	if($PM=="Owain Richards-green"){$owain_count++; $owain_total = $owain_total + $invoice_value; $owain_tit = $owain_tit + $PMT;}

	$total = $total + $invoice_value;
	$total_time = $total_time + $PMT;
	$total_rating = $total_rating + $rating;
	
	if($contract_number > 411 && $contract_number < 500){
	$num2++;	
	}
	
	$num++;
			}
	echo "<tr>
	<td width=\"50\">  </td>
	<td width=\"100\"> </td>
		
	<td width=\"175\"><hr>
		Bobbie Johnson $bobbie_count <br/>	
		Chris Davies $chris_count <br/>
		Jo Ralph $jo_count <br/>
		Lee Nichols $lee_count <br/>
		Mary Ann Taylor $mary_count <br/>
		Owain Richards-Green $owain_count <br/>
		Richard Davies $richard_count <br/> 
		Rui Dias $rui_count <br/>
		Stan Gray $stan_count <br/>
		Stephen Speirs $stephen_count <br/>
		
		<hr>
		Total files $num
		
	</td>
	<td width=\"125\"><hr>
		Total Time : ". number_format($bobbie_tit / 3600,2)."  <br/>	
		Total Time : ". number_format($chris_tit / 3600,2)." <br/>
		Total Time : ". number_format($jo_tit / 3600,2)." <br/>
		Total Time : ". number_format($lee_tit / 3600,2)." <br/>
		Total Time : ". number_format($mary_tit / 3600,2)."<br/>
		Total Time : ". number_format($owain_tit / 3600,2)." <br/> 	 
		Total Time : ". number_format($richard_tit / 3600,2)." <br/>
		Total Time : ". number_format($rui_tit / 3600,2)." <br/>
		Total Time : ". number_format($stan_tit / 3600,2)."<br/>
		Total Time : ". number_format($stephen_tit / 3600,2)." <br/> 
		<hr>
		Total Time : ". number_format($total_time / 3600,2)."
		
	</td>
	<td width=\"100\"> 
	<hr>
		Ave Time/File : ". number_format(($bobbie_tit/$corrie_count) / 3600,2)."  <br/>	
		Ave Time/File : ". number_format(($chris_tit/$chris_count) / 3600,2)." <br/>
		Ave Time/File : ". number_format(($jo_tit/$jo_count) / 3600,2)." <br/>
		Ave Time/File : ". number_format(($lee_tit/$lee_count) / 3600,2)." <br/>
		Ave Time/File : ". number_format(($mary_tit/$nigel_count) / 3600,2)."<br/>
		Ave Time/File : ". number_format(($owain_tit/$richard_count) / 3600,2)." <br/> 	 
		Ave Time/File : ". number_format(($richard_tit/$jo_count) / 3600,2)." <br/>
		Ave Time/File : ". number_format(($rui_tit/$lee_count) / 3600,2)." <br/>
		Ave Time/File : ". number_format(($stan_tit/$nigel_count) / 3600,2)."<br/>
		Ave Time/File : ". number_format(($stephen_tit/$richard_count) / 3600,2)." <br/> 	 
		<hr>
		Ave Time/File : ". number_format(($total_time/$num2) / 3600,2)."	
	
	
	</td>	
</tr>";

}

			  		
//$query  = "SELECT * FROM Full_details WHERE sample_number > '110000' INTO OUTFILE 'C:/Users/agreen/Desktop/result.txt' FIELDS TERMINATED BY ','";

//$result = mysql_query($query);
		?>
		</table>
</div>
<?php include("../lab_control_v2/footer.php"); ?>
</html>

