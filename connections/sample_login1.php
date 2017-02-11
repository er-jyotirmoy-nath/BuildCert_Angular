<?php 

ini_set('display_errors','1');


include("../lab_control_v2/connections/wrc.php"); 
mysql_select_db("wrcnsf");
session_start();

$salt1="*Ox7^";
$salt2="hy%6";

$year = date("y", strtotime("now"));

$timestamp = date("H:i d-m-Y", strtotime("now"));

$staff_number = $_SESSION['staff_number'];
$company1 = $_POST['company'];

$previous_listing = $_POST['previous_listing'];
$section_number = $_POST['section_number'];
$production_stage = $_POST['production_stage'];
$addition_type = $_POST['addition_type'];

if (isset($company1)){
$sql2="SELECT * FROM Company WHERE Company = '$company1' "; 
$result2=mysql_query($sql2); 

while ($row=mysql_fetch_array($result2)) { 

	$address1=$row["Address1"];
	$address2=$row["Address2"];
    $address3=$row["Address3"];
    $address4=$row["Address4"];
    $address5=$row["Address5"];
    $address6=$row["Address6"];
    $address7=$row["Address7"];
    $post_code=$row["Post_Code"];
    $fax=$row["Fax"];
    $website=$row["Website"];
    $company_email=$row["company_email"];
    $contact=$row["Contact"];
    $contact_address1=$row["Contact_address1"];
	$contact_address2=$row["Contact_address2"];
    $contact_address3=$row["Contact_address3"];
    $contact_address4=$row["Contact_address4"];
    $contact_address5=$row["Contact_address5"];
    $contact_address6=$row["Contact_address6"];
    $contact_address7=$row["Contact_address7"];
    $contact_post_code=$row["Contact_post_code"];
    $contact_telephone=$row["Contact_telephone"];
    $contact_fax=$row["Contact_fax"];
    $contact_email=$row["Contact_Email"];
    $contact_mobile=$row["contact_moblie"];
}
}


$sql="SELECT Company FROM Company"; 
$result=mysql_query($sql); 

$options=""; 

while ($row=mysql_fetch_array($result)) { 
    $company=$row["Company"]; 
    $options.="<OPTION VALUE=\"$company\">".$company;
}
$query  = "SELECT sample FROM General WHERE year = '$year' ORDER BY sample DESC LIMIT 0, 1";
$result = mysql_query($query);
while($row = mysql_fetch_assoc($result))
{    $sample = $row['sample']; } 
if ($sample ==""){ $sample = 0; }
else{ $sample = $sample + 1; }
$sample_number = (($year * 10000) + $sample);
$passcode = md5("$salt1$sample_number$salt2");
 
$sql1="SELECT staff_email FROM Staff WHERE clearance = 'Project_Manager' "; 
$result3=mysql_query($sql1); 

$options2="";
while ($row=mysql_fetch_array($result3)) { 
    $PM= $row["staff_email"]; 
	$PM = str_replace(array('@wrcnsf.com', '.'),' ',$PM);
	$PM = ucwords($PM);
    $options2.="<OPTION VALUE=\"$PM\">".$PM; 
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhthttp://ml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<meta name="description" content=""/>
<meta name="keyword" content=""/>
<link href="../WRC/styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
</script>
<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
</head>
<body>
<div id="content">
<table>	
	<tr><td>
	<form action="sample_login1.php" method="post">
	<SELECT NAME="company"> 
	<OPTION VALUE=0>Select Company
	<?=$options?> 
	</SELECT> 
	</td>
	<td><input type="submit" value="Get Full Company Details" />
	</form></td>
		<td>
	<form action="sample_login1.php" method="post">
	<input type="hidden" name="company" value=" " />
	<input name="previous_listing" type="hidden" size="<?php echo $previous_listing?>" />
	<input name="section_number" type="hidden" size="<?php echo $section_number?>" />
	<input name="production_stage" type="hidden" value="<?php echo $production_stage?>" />
	<input name="addition_type" type="hidden" value="<?php echo $addition_type?>" />	
	<input type="submit" value="Clear Company Details" />
		</form>
		</td></tr>
	</table>


<table>
<form action="sample_login_confirm.php" method="post">
<tr><td>Company Name: <input name="address1" type="text" value="<?php echo $company?>" size="20" /></td><td width = "100"></td><td>Contact Name: <input name="contact" type="text" value="<?php echo $contact?>" size="20" /></td></tr>
<tr><td>Address Line 1: <input name="address1" type="text" value="<?php echo $address1?>" size="20" /></td><td width = "100"></td><td>Contact Address Line 1: <input name="contact_address1" type="text" value="<?php echo $contact_address1?>" size="20" /></td></tr>
<tr><td>Address Line 2: <input name="address2" type="text" value="<?php echo $address2?>" size="20" /></td><td width = "100"></td><td>Contact Address Line 2: <input name="contact_address2" type="text" value="<?php echo $contact_address2?>" size="20" /></td></tr>
<tr><td>Address Line 3: <input name="address3" type="text" value="<?php echo $address3?>" size="20" /></td><td width = "100"></td><td>Contact Address Line 3: <input name="contact_address3" type="text" value="<?php echo $contact_address3?>" size="20" /></td></tr>
<tr><td>Address Line 4: <input name="address4" type="text" value="<?php echo $address4?>" size="20" /></td><td width = "100"></td><td>Contact Address Line 4: <input name="contact_address4" type="text" value="<?php echo $contact_address4?>" size="20" /></td></tr>
<tr><td>Address Line 5: <input name="address5" type="text" value="<?php echo $address5?>" size="20" /></td><td width = "100"></td><td>Contact Address Line 5: <input name="contact_address5" type="text" value="<?php echo $contact_address5?>" size="20" /></td></tr>
<tr><td>Address Line 6: <input name="address6" type="text" value="<?php echo $address6?>" size="20" /></td><td width = "100"></td><td>Contact Address Line 6: <input name="contact_address6" type="text" value="<?php echo $contact_address6?>" size="20" /></td></tr>
<tr><td>Address Line 7: <input name="address7" type="text" value="<?php echo $address7?>" size="20" /></td><td width = "100"></td><td>Contact Address Line 7: <input name="contact_address7" type="text" value="<?php echo $contact_address7?>" size="20" /></td></tr>
<tr><td>Post Code: <input name="post_code" type="text" value="<?php echo $post_code?>" size="20" /></td><td width = "100"></td><td>Contact Post Code: <input name="contact_post_code" type="text" value="<?php echo $contact_post_code?>" size="20" /></td></tr>
<tr><td></td><td width = "100"></td><td>Contact Telephone: <input name="contact_telephone" type="text" value="<?php echo $contact_telephone?>" size="20" /></td></tr>
<tr><td>Fax: <input name="fax" type="text" value="<?php echo $fax?>" size="20" /></td><td width = "100"></td><td>Contact Fax: <input name="contact_fax" type="text" value="<?php echo $conatct_fax?>" size="20" /></td></tr>
<tr><td>Website: <input name="website" type="text" value="<?php echo $website?>" size="20" /></td><td width = "100"></td><td>Contact Email: <input name="contact_email" type="text" value="<?php echo $contact_email?>" size="20" /></td></tr>
<tr><td>Company Email: <input name="company_email" type="text" value="<?php echo $company_email?>" size="20" /></td><td width = "100"></td><td>Contact Mobile: <input name="contact_mobile" type="text" value="<?php echo $contact_mobile?>" size="20" /></td></tr>
<tr><td>
</td></tr>

</table>

<table>
<tr><td>Sample Number: <?php echo $sample_number ?></td>
<td>Time Logged: <?php echo $timestamp ?></td></tr>
<tr><td>Previous Listing Number: <input name="previous_listing" type="text" size="10" value="<?php if(isset($previous_listing)){echo $previous_listing;}?>" /></td>
<td>Section Number: <input name="section_number" type="text" size="10" value="<?php if(isset($section_number)){echo $section_number;}?>"/></td></tr>
<tr><td>Prototype <input type="radio" name="production_stage" value="prototype" <?php if($production_stage=="prototype"){echo "checked=\"checked\"";} ?>/></td>
	<td>Pre-Production <input type="radio" name="production_stage" value="pre_production" <?php if($production_stage=="pre_production"){echo "checked=\"checked\"";} ?>/></td>
	<td>Production <input type="radio" name="production_stage" value="production" <?php if($production_stage=="production"){echo "checked=\"checked\"";} ?>/></td></tr>
<tr><td>Modification <input type="radio" name="addition_type" value="modification" /></td>
	<td>Addition to range <input type="radio" name="addition_type" value="addition" /></td>
	<td>Not Applicable <input type="radio" name="addition_type" value="" /></td></tr>
	<tr><td><SELECT NAME="PM"> 
<OPTION VALUE=0>Select Project Manager 
<?=$options2?> 
</SELECT> 
</td></tr>
</table>
<table>
<tr><td>Product Description: <input name="product_description" type="text" size="100" /></td></tr>
</table>
<input value="Save Application" type="submit" /> 
</form>
</div>
</body>
</html>
