<?php 

date_default_timezone_set('Europe/London');

$target_name = $_SESSION['email_doc'];
unset($_SESSION['email_doc']);


	$last_viewed_applicant = "";
	
	$to = "";
	$company = "";
	$passcode = "";
	$product_description = "";
	$extra_contact = "";
	$extra_contact_access = "";

$sql2="SELECT * FROM Full_details WHERE sample_number = '$sample_number'"; 
$result2=$dbh->query($sql2); 

while($row = $result2->fetch(PDO::FETCH_ASSOC)) {

	$last_viewed_applicant = $row['LAST_EMAILED'];
	
	$to = $row['CONTACT_EMAIL'];
	$company = $row['COMPANY'];
	$passcode = $row['PASSCODE'];
	$product_description = stream_get_contents($row['PRODUCT_DESCRIPTION']);
	$extra_contact = $row['EXTRA_CONTACT'];
	$extra_contact_access = $row['EXTRA_CONTACT_ACCESS'];

}


$sql= "SELECT company_email FROM Company WHERE Company ='$company'";
$result4 = $dbh->query($sql);
while($row = $result4->fetch(PDO::FETCH_ASSOC)) {
	$company_email = $row['COMPANY_EMAIL'];
}

// send e-mail to ...
if($to ==""){
$to = $company_email;
}

// Your subject
$subject="Your WRAS approval testing invoice for sample number $sample_number has been raised";

// From
$header = 'from: noreply@wrcnsf.com'. "\r\n";
$header .= 'MIME-Version: 1.0' . "\r\n";
$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Your message
$message = "<html>
<body>
<p>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=\"#000099\" face=\"arial\" size=\"7\"><b>NSF-WRc</b> </font><br/><br/>


&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=\"#CCCCCC\">_____________________________________________________________________________</font><br/><br/>


<font face=\"arial\">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Application</b><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$company <br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$product_description <br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sample Number $sample_number <br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;For Water Regulations Advisory Scheme (WRAS) Product Approval.<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>The testing invoice for this application has been raised.</b><br/><br/>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please <a target=\"_blank\"href=\"http://www.wrcnsf.com/lab_control_v2/shared_documents/$sample_number/$target_name\">click here</a> to view the invoice<br/><br/<br/>
</font>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=\"#CCCCCC\">_____________________________________________________________________________</font><br/><br/>



<font color=\"#BBBBBB\" face=\"arial\">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>WRc-NSF</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;30 Fern Close, Pen-y-Fan Industrial Estate, Oakdale, Gwent, NP12 3EH, UK <br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T +44 (0) 1495 236 260 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; F +44 (0) 1495 249 499 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; W www.wrcnsf.com <br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WRc-NSF Ltd is company registered in England and Wales, number 3754780<br/>
</font>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=\"#CCCCCC\">_____________________________________________________________________________</font><br/><br/>



&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size =\"2\" color=\"#BBBBBB\" face=\"arial\">
If you do not wish to receive further application status updated please contact your Project Manager.</font><br/>


&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=\"#CCCCCC\">_____________________________________________________________________________</font><br/>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font size =\"1\" color=\"#BBBBBB\" face=\"arial\">
&copy; WRc-NSF Ltd 2013
</font>

</body>
</html>";
//end of message


// send email

$sentmail = mail($to,$subject,$message,$header);

if(	$extra_contact !="" && $extra_contact_access =="1"){
$sentmail2 = mail($extra_contact,$subject,$message,$header);
}


		$date_minutes = date("i", strtotime("now"));
		$date_hours = date("H", strtotime("now"));
		$date_day = date("d", strtotime("now"));
		$date_month = date("m", strtotime("now"));
		$date_year = date("Y", strtotime("now"));
		$last_emailed = $date_minutes + ($date_hours*60) + (($date_day*24)*60) + ((($date_month * 31)*24)*60) + ((($date_year * 372)*24)*60); 

$dbh->exec("UPDATE Full_details SET last_emailed = '$last_emailed' WHERE sample_number = '$sample_number'") or die(mysql_error());


?>