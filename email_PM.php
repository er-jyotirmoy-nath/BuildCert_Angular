<?php 
date_default_timezone_set('Europe/London');
	$PM = lcwords($PM);
	$PM = str_replace(array(' '),'.',$PM);
	$PM = "$PM@wrcnsf.com";

$to = $PM;
// send e-mail to ...

// Your subject
$subject="There has been an update on sample number $sample_number";

// From
$header = 'from: noreply@wrcnsf.com'. "\r\n";
$header .= 'MIME-Version: 1.0' . "\r\n";
$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Your message
$message = "<html>
<body>
<h2>There has been an update on sample number $sample_number</h2>
</body>
</html>";
//end of message


// send email
$sentmail = mail($to,$subject,$message,$header);
?>