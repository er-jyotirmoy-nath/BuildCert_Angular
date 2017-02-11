<?php 
session_start();
include("../../lab_control_v2/connections/wrc_new.php");



$filter = $_POST['filter'];
$discon = $_POST['discon'];
$edit = $_SESSION['edit'];


if($filter=="yes"){

$HP_1111 = $_POST['HP_1111'];
$HPB = $_POST["HPB"];
$HPS = $_POST["HPS"];
$HPW = $_POST["HPW"];
$HPT = $_POST['HPT'];
$Cold_isol_46_hp = $_POST['Cold_isol_46_hp'];
$LP_1287 = $_POST['LP_1287'];
$LPB = $_POST['LPB'];
$LPS = $_POST['LPS'];
$LPW = $_POST['LPW'];
$LPT = $_POST['LPT'];
$LPTx = $_POST['LPTx'];
$Cold_isol_46_lp = $_POST['Cold_isol_46_lp'];
}

if($filter ==""){

$HP_1111 = "";
$HPBSW = "";
$HPT = "";
$Cold_isol_46_hp = "";
$LP_1287 = "";
$LPB = "";
$LPS = "";
$LPW = "";
$LPT = "";
$LPTx = "";
$Cold_isol_46_lp = "";
}

?>


<html>

<!-- #BeginTemplate "template.dwt" -->

<head>
<meta http-equiv="Content-Language" content="en-gb">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<style>p {margin-top: 3pt; margin-bottom:3pt; margin-left:10pt; margin-right:10pt; color:#000000; font-family:"arial"; font-size:11pt; font-style: normal; text-align: left}
li {margin-top: 3pt; margin-bottom:3pt; margin-left:10pt; margin-right:10pt; color:#000000; font-family:"arial"; font-size:11pt; font-style: normal; text-align: left}
h1 {margin-top:10pt; margin-bottom:25pt; margin-left:10pt; margin-right:10pt; color:#2859a6; font-family:"arial"; font-size:30pt; font-style: bold; text-align: left}
h2 {margin-top:6pt; margin-bottom:6pt; margin-left:10pt; margin-right:10pt; color:#000000; font-family:"arial"; font-size:14pt; font-style: bold; text-align: left}
h3 {margin-top:3pt; margin-bottom:3pt; margin-left:10pt; margin-right:10pt; color:#ffffff; font-family:"arial"; font-size:10pt; font-style: normal; text-align: left}
h4 {margin-top:7pt; margin-bottom:0pt; margin-left:10pt; margin-right:10pt; color:#ffffff; font-family:"arial"; font-size:10pt; font-style: normal; text-align: centre}
h5 {margin-top:7pt; margin-bottom:0pt; margin-left:10pt; margin-right:10pt; color:#000000; font-family:"arial"; font-size:8pt; font-style: bold; text-align: left}
h6 {margin-top:2pt; margin-bottom:2pt; margin-left:10pt; margin-right:10pt; color:#000000; font-family:"arial"; font-size:8pt; font-style: normal; text-align: left}
address  {margin-top:0pt; margin-bottom:0pt; margin-left:0pt; margin-right:0pt; color:#2859a6; font-family:"arial"; font-size:7pt; text-align: left; font-style: normal}
</style>
<!-- #BeginEditable "doctitle" -->
<!-- #EndEditable -->
</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" bgcolor="#FFFFFF">

<table border="0" width="100%" cellspacing="0" cellpadding="0" height="200">
	<tr>
		<td style="background-image: url('images/shared/lower_line.jpg'); background-repeat: repeat-x">&nbsp;</td>
		<td width="800">
		<a href="index.htm">
		<img border="0" src="images/shared/header.jpg" width="800" height="200"></a></td>
		<td style="background-image: url('images/shared/upper_line.jpg'); background-repeat: repeat-x">&nbsp;</td>
	</tr>
</table>
<div align="center">
	<table border="0" width="800" cellspacing="0" cellpadding="0" height="90">
		<tr>
			<td width="200" background="images/shared/button.jpg" align="center">
			<h4 style="margin-left: 6pt; margin-right: 14pt; margin-top: 5pt"><a href="check_an_approval.htm" style="text-decoration: none">
			<font color="#FFFFFF" size="4">Check a BuildCert <br>
			Approval</font></a></h4>
			</td>
			<td width="200" background="images/shared/button.jpg" align="center">
			<h4 style="margin-left: 6pt; margin-right: 14pt; margin-top: 5pt"><a href="about_buildcert.htm" style="text-decoration: none">
			<font color="#FFFFFF" size="4">More about <br>
			BuildCert</font></a></h4>
			</td>
			<td width="200" background="images/shared/button.jpg" align="center">
			<h4 style="margin-left: 6pt; margin-right: 14pt; margin-top: 5pt">
			<a href="why_get_buildcert_approval.htm" style="text-decoration: none">
			<font color="#FFFFFF" size="4">Apply for <br>
			BuildCert Approval</font></a></h4>
			</td>
			<td width="200" background="images/shared/button.jpg" align="center">
			<h4 style="margin-left: 6pt; margin-right: 14pt; margin-top: 5pt">
			<a style="text-decoration: none" href="login.php">
			<font color="#FFFFFF" size="4">BuildCert Approval Holders Area</font></a></h4>
			</td>
		</tr>
	</table>
</div>
<div align="center">
						<!-- #BeginEditable "text" -->
	<table border="0" width="800" cellspacing="0" cellpadding="0">
		<tr>
			<td width="600" valign="top">
		<h1>TMV2</h1>
<table align="center" style="width: 800">
<tr>

<td align="center" colspan="5">High Pressure 0.5 - 5 bar dynamic (HP)<br/> BS EN 1111:1999</td>
<td colspan="1"></td>
<td align="center" colspan="6">Low Pressure 0.1 - 1.0 bar dynamic (LP)<br/> BS EN 1287:1999</td>
</tr>
<tr>
<td align="center" width="33"><b>B</b></td>
<td align="center" width="33"><b>S</b></td>
<td align="center" width="33"><b>W</b></td>
<td align="center" width="25"></td>
<td align="center" width="50"><b>T</b></td>
<td width="25"></td>
<td align="center" width="75"><b>Cold Isol 46</b></td>
<td align="center" width="100"></td>
<td align="center" width="25"><b>B</b></td>
<td align="center" width="25"><b>S</b></td>
<td align="center" width="25"><b>W</b></td>
<td align="center" width="25"><b>T</b></td>
<td align="center" width="75"><b>T 0.2</b></td>
<td align="center" width="75"><b>Cold Isol 46</b></td>
</tr>
<form action="" method="post">
<tr>
<td align="center"><input name="HPB" type="checkbox" value="1" <?php if($HPB =="1"){ echo "checked=\"yes\"";} else {} ?>/></td>
<td align="center"><input name="HPS" type="checkbox" value="1" <?php if($HPS =="1"){ echo "checked=\"yes\"";} else {} ?>/></td>
<td align="center"><input name="HPW" type="checkbox" value="1" <?php if($HPW =="1"){ echo "checked=\"yes\"";} else {} ?>/></td>
<td align="center"></td>
<td align="center"><input name="HPT" type="checkbox" value="1" <?php if($HPT =="1"){ echo "checked=\"yes\"";} else {} ?>/></td>
<td align="center"></td>
<td align="center"><input name="Cold_isol_46_hp" type="checkbox" value="1" <?php if($Cold_isol_46_hp =="1"){ echo "checked=\"yes\"";} else {} ?>/></td>
<td></td>
<td align="center"><input name="LPB" type="checkbox" value="1" <?php if($LPB =="1"){ echo "checked=\"yes\"";} else {} ?>/></td>
<td align="center"><input name="LPS" type="checkbox" value="1" <?php if($LPS =="1"){ echo "checked=\"yes\"";} else {} ?>/></td>
<td align="center"><input name="LPW" type="checkbox" value="1" <?php if($LPW =="1"){ echo "checked=\"yes\"";} else {} ?>/></td>
<td align="center"><input name="LPT" type="checkbox" value="1" <?php if($LPT =="1"){ echo "checked=\"yes\"";} else {} ?>/></td>
<td align="center"><input name="LPTx" type="checkbox" value="1" <?php if($LPTx =="1"){ echo "checked=\"yes\"";} else {} ?>/></td>
<td align="center"><input name="Cold_isol_46_lp" type="checkbox" value="1" <?php if($Cold_isol_46_lp =="1"){ echo "checked=\"yes\"";} else {} ?>/></td>
</tr>
<tr>
<td align="center" colspan="12">
<br>
<input type="hidden" name="discon" value="1"/>
<input type="hidden" name="filter" value="yes"/>
<input type="submit" value="Search Approvals"/>
</form>
<form action="" method="post">
<input type="hidden" name="discon" value="1"/>	
<input type="hidden" name="filter" value="yes"/>
<input type="submit" value="Show All Approvals"/>
</form>
<form action="" method="post">
<input type="hidden" name="discon" value="0"/>	
<input type="hidden" name="filter" value="yes"/>
<input type="submit" value="Discontinued Approvals"/>
</form>
<?php if($edit=="Xyretdqwofror7304"){ ?>
<form action="TMV2_insert.php" method="post">
<input type="hidden" name="edit" value="yes"/>
<input type="submit" value="Add to TMV2 Database"/>
</form>
<?php if(isset($_SESSION['cert_id'])){
	
	echo $_SESSION['cert_id'];
	unset($_SESSION['cert_id']);
}} ?>	
</td>
</tr>

</tr>





<?php

if($filter=="yes"){
echo "<tr>
<td colspan=\"3\"><b>Approval Holder</b></td>
<td colspan=\"3\"><b>Mixing Valve</b></td>
<td colspan=\"1\"><b>Unique ID</b></td>
<td colspan=\"1\"><b>Certificate</b></td>
<td colspan=\"6\"><b>Comments</b></td>
</tr>";
}




$counter=0;
$colour1="FFFFFF";
$colour2="F0F0F0";


if($filter=="yes"){

if(isset($HP_1111)){$HP_1111 = "AND HP_1111='1'";}else{$HP_1111="";}
if(isset($HPB)){$HPB = "AND HPB='1'";}else{$HPB="";}
if(isset($HPS)){$HPS = "AND HPS='1'";}else{$HPS="";}
if(isset($HPW)){$HPW = "AND HPW='1'";}else{$HPW="";}
if(isset($HPT)){$HPT = "AND HPT='1'";}else{$HPT="";}
if(isset($Cold_isol_46_hp)){$Cold_isol_46_hp = "AND Cold_isol_46_hp='1'";}else{$Cold_isol_46_hp="";}
if(isset($LP_1287)){$LP_1287 = "AND LP_1287='1'";}else{$LP_1287="";}
if(isset($LPB)){$LPB = "AND LPB='1'";}else{$LPB="";}
if(isset($LPS)){$LPS = "AND LPS='1'";}else{$LPS="";}
if(isset($LPW)){$LPW = "AND LPW='1'";}else{$LPW="";}
if(isset($LPT)){$LPT = "AND LPT='1'";}else{$LPT="";}
if(isset($LPTx)){$LPTx = "AND LPTx='1'";}else{$LPTx="";}
if(isset($Cold_isol_46_lp)){$Cold_isol_46_lp = "AND Cold_isol_46_lp='1'";}else{$Cold_isol_46_lp="";}

$query = "SELECT * FROM TMV2 WHERE Remove_from_Website != '1' $HP_1111 $HPB $HPS $HPW $HPT $Cold_isol_46_hp $LP_1287 $LPB $LPS $LPW $LPT $LPTx $Cold_isol_46_lp AND Discontinued_Withdrawn !='$discon' ORDER BY Licensee ASC ";


$result = $dbh->query($query);

while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
	
	$cert_id = $cert_id_2;
	$previous = $Licensee;
	$Manufacturer = $row['MANUFACTURER'];
	$Licensee = $row['LICENSEE'];
	$Approved_Mixing_Valve = stream_get_contents($row["APPROVED_MIXING_VALVE"]);
	$Certificate_Letters = $row["CERTIFICATE_LETTERS"];
	$Certificate_Number = $row["CERTIFICATE_NUMBER"];
	$Certificate_Date = $row["CERTIFICATE_DATE"];
	$Comments = $row['COMMENTS'];
	$Extended_Comments = $row['EXTENDED_COMMENTS'];
	$Unique_ID = stream_get_contents($row['UNIQUE_ID']);
	$cert_id_2 = $row['CERT_ID'];
	$HP_1111 = $row["HP_1111"];
	$HPB = $row["HPB"];
	$HPB_comment = $row['HPB_COMMENT'];
	$HPS = $row["HPS"];
	$HPS_comment = $row['HPS_COMMENT'];
	$HPW = $row["HPW"];
	$HPW_comment = $row['HPW_COMMENT'];
	$HPT = $row["HPT"];
	$HPT_comment = $row['HPT_COMMENT'];
	$LP_1287 = $row['LP_1287'];
	$LPB = $row['LPB'];
	$LPB_comment = $row['LPB_COMMENT'];
	$LPS = $row['LPS'];
	$LPS_comment = $row['LPS_COMMENT'];
	$LPW = $row['LPW'];
	$LPW_comment = $row['LPW_COMMENT'];
	$LPT = $row['LPT'];
	$LPT_comment = $row['LPT_COMMENT'];
	$LPTx = $row['LPTx'];
	$LPTx_comment = $row['LPTx_COMMENT'];
	$Comments = $row['COMMENTS'];
	$Extended_Comments = $row['EXTENDED_COMMENTS'];
	$Pts_Comments = $row['PTS_COMMENTS'];
	$Primary_or_Secondary = $row['PRIMARY_OR_SECONDARY'];
	$First_Audit = $row['FIRST_AUDIT'];
	$First_Completed = $row['FIRST_COMPLETED'];                  
	$Second_Audit = $row['SECOND_AUDIT'];             
	$Second_Completed = $row['SECOND_COMPLETED'];
	$Discontinued_Withdrawn = $row['DISCONTINUED_WITHDRAWN'];               
	$Remove_from_Website = $row['REMOVE_FROM_WEBSITE'];        
	$New = $row['NEW'];  
	$Cold_isol_46_lp = $row['COLD_ISOL_46_LP'];                    
	$Cold_isol_46_hp = $row['COLD_ISOL_46_HP'];
	$Expiry_Date = $row['EXPIRY_DATE'];
	
	if($Certificate_Number < 100){
	$Certificate_Number = "0$Certificate_Number";	
	}	
	if($Certificate_Date < 1000){
	$Certificate_Date = "0$Certificate_Date";	
	}

if($cert_id != $cert_id_2){
		$row_colour = ($counter % 2) ? $colour1 : $colour2;
		echo "<tr bgcolor =\"$row_colour\"><td colspan=\"3\"><b>"; if($Licensee == $previous){echo"";}else{echo $Licensee;}echo"</b></td>".
    		 "<td colspan=\"3\"> $Approved_Mixing_Valve </td>".
			 "<td colspan=\"1\"> $Unique_ID </td>".
			 "<td align=\"center\" colspan=\"1\"> $Certificate_Letters $Certificate_Number/$Certificate_Date</td>" .
			 "<td colspan=\"6\"> $Comments $Extended_Comments</td>";
			 if($edit=="Xyretdqwofror7304"){echo
		 	 "<td valign =\"center\" colspan=\"1\"><form method = \"post\" action = \"file_edit.php\" target=\"_blank\"/>
    	 	  <input type = \"hidden\" name=\"cert_id\" value= \"$cert_id_2\" />
    	 	  <input type = \"hidden\" name=\"scheme\" value= \"TMV2\" />
    	 	  <input type = \"hidden\" name=\"edit\" value= \"Xyretdqwofror7304\" />
    	 	  <input type=\"submit\" value=\"Edit Listing\" /></form></td>";}
			 echo
		 	 "<td valign =\"center\" colspan=\"1\"><form method = \"post\" action = \"file_edit.php\"/>
    	 	  <input type = \"hidden\" name=\"cert_id\" value= \"$cert_id_2\" />
    	 	  <input type = \"hidden\" name=\"scheme\" value= \"TMV2\" />
    	 	  <input type=\"submit\" value=\"View Listing\" /></form></td></tr>";
echo"<tr bgcolor =\"$row_colour\"><td colspan=\"3\"></td><td valign =\"center\" colspan=\"11\">";
	
	if($HPB =="1" || $HPS =="1" || $HPW =="1" || $HPT =="1" || $Cold_isol_46_hp =="1"){echo"<b><u>HP_1111</u></b>";}
	if($HPB =="1"){echo"<b> B - </b>". $HPB_comment;}
	if($HPS =="1"){echo"<b> S - </b>". $HPS_comment;}
	if($HPW =="1"){echo"<b> W - </b>". $HPW_comment;}		
	if($HPT =="1"){echo"<b>T - </b>". $HPT_comment;}
	if($Cold_isol_46_hp =="1"){echo"<b>Cold Isol 46 </b>";}echo"</br>";
	if($LPB =="1" || $LPS =="1" || $LPW =="1" || $LPT =="1" || $LPTx =="1" || $Cold_isol_46_lp =="1"){echo"<b><u>LP_1287</u></b>";}
	if($LPB =="1"){echo"<b> B - </b>". $LPB_comment;}
	if($LPS =="1"){echo"<b> S - </b>". $LPS_comment;}
	if($LPW =="1"){echo"<b> W - </b>". $LPW_comment;}
	if($LPT =="1"){echo"<b> T - </b>". $LPT_comment;}
	if($LPTx =="1"){echo"<b>T 0.2 - </b>". $LPTx_comment;}
	if($Cold_isol_46_lp =="1"){echo"<b>Cold Isol 46 </b>";}echo"
	</td></tr><tr><td> &nbsp;</td></tr>";
}}
		     "</font>";
		
			$counter++;	
			
		
}


?>

</table>
</table>

		<p>&nbsp;<p></td>
			&nbsp;
		</tr>
	</table>
						<!-- #EndEditable -->
</div>
<table border="0" width="100%" cellspacing="0" cellpadding="0" height="200">
	<tr>
		<td style="background-image: url('images/shared/lower_line.jpg'); background-repeat: repeat-x">&nbsp;</td>
		<td width="800">
		<table border="0" width="800" cellspacing="0" cellpadding="0" height="200">
			<tr>
				<td style="background-image: url('images/shared/lower_line.jpg'); background-repeat: repeat-x" width="100">&nbsp;</td>
				<td width="570">
				<img border="0" src="images/shared/footer.jpg" width="570" height="200"></td>
				<td width="130" style="background-image: url('images/shared/upper_line.jpg'); background-repeat: repeat-x" valign="bottom">
				<address>BuildCert Ltd<br>
				30 Fern Close, <br>
				Pen-y-Fan Industrial Estate, <br>
				Oakdale,</address>
				<address>Gwent, NP11 3EH. <br>
				Tel: +44 (0)1495 236 260<br>
				e-mail: buildcert@wrcnsf.com<br>
					<a href="TandC.htm" style="text-decoration: none">
					<font color="#2859A6">Terms and Conditions of Use</font></a><br>
					� BuildCert Ltd 2009</address></td>
			</tr>
		</table>
		</td>
		<td style="background-image: url('images/shared/upper_line.jpg'); background-repeat: repeat-x">&nbsp;</td>
	</tr>
</table>

</body>

<!-- #EndTemplate -->

</html>
