<?php 
session_start();
date_default_timezone_set('Europe/London');
ini_set('display_errors','0');
include("../lab_control_v2/connections/wrc_new.php"); 
include("../lab_control_v2/session_check_new.php");

$email_online_app = $session_email;

if(isset($_POST['sample_number']))
	{$sample_number = $_POST['sample_number'];
	 $_SESSION['sample_number'] = $sample_number;}
elseif(isset($_GET['sample_number']))
	{$sample_number = $_GET['sample_number'];
	 $_SESSION['sample_number'] = $sample_number;}
elseif(isset($_SESSION['sample_number']))
		{$sample_number = $_SESSION['sample_number'];}
else $sample_number=="";

if($sample_number==""){

if($_POST['unique_app_id']!="")
	{$unique_app_id = $_POST['unique_app_id'];
	 $_SESSION['unique_app_id'] = $unique_app_id;}
elseif($_GET['unique_app_id']!='')
	{$unique_app_id = $_GET['unique_app_id'];
	 $_SESSION['unique_app_id'] = $unique_app_id;}
elseif($_SESSION['unique_app_id'])
	{$unique_app_id = $_SESSION['unique_app_id'];}
}


if(isset($sample_number)){
$sql="SELECT unique_app_id, PM, contact_email FROM Full_details WHERE sample_number = '$sample_number'"; 
$result=$dbh->query($sql); 
while($row = $result->fetch(PDO::FETCH_ASSOC)){
$email_online_app = $row['CONTACT_EMAIL'];
$unique_app_id = $row['UNIQUE_APP_ID'];
$_SESSION['unique_app_id'] = $unique_app_id;
$PM = $row['PM'];
}
}
if(!isset($sample_number) && $unique_app_id!=""){
$sql="SELECT sample_number, PM, contact_email FROM Full_details WHERE unique_app_id = '$unique_app_id'"; 
$result=$dbh->query($sql); 
while($row = $result->fetch(PDO::FETCH_ASSOC)){
$email_online_app = $row['CONTACT_EMAIL'];	
$sample_number = $row['SAMPLE_NUMBER'];
$PM = $row['PM'];
}
}


if($_SESSION['unique_app_id']=="" && $_SESSION['sample_number']==""){
header("Location: login.php");
}


$staff_checking = $_SESSION['staff_number'];


if($staff_checking==1){
$dbh->query("UPDATE Online_applications SET page = '6' WHERE unique_app_id = '$unique_app_id'");	
}


if(isset($_POST['page6_issue'])){$dbh->query("UPDATE Online_applications SET page6_issue = '$page6_issue' WHERE unique_app_id = '$row' AND version='$version1'");}


$sql="select * from(SELECT * FROM Online_applications WHERE unique_app_id = '$unique_app_id' ORDER BY version DESC) where rownum=1"; 
$result=$dbh->query($sql); 

while($row = $result->fetch(PDO::FETCH_ASSOC)){
	
$company = $row['COMPANY'];
$contact = $row['CONTACT'];
$manufacturer = $row['MANUFACTURER'];
$basic_temp = $row['BASIC_TEMP'];
$approval_temp = $row['APPROVAL_TEMP'];
$mim_pressure = $row['MIM_PRESSURE'];
$max_pressure = $row['MAX_PRESSURE'];
$version = $row['VERSION'];
$description = stream_get_contents($row['DESCRIPTION']);

$page1_issue = $row['PAGE1_ISSUE'];
$page2_issue = $row['PAGE2_ISSUE'];
$page3_issue = $row['PAGE3_ISSUE'];
$page4_issue = $row['PAGE4_ISSUE'];
$page5_issue = $row['PAGE5_ISSUE'];
$page6_issue = $row['PAGE6_ISSUE'];
$page7_issue = $row['PAGE7_ISSUE'];
$page8_issue = $row['PAGE8_ISSUE'];
$page9_issue = $row['PAGE9_ISSUE'];
$page10_issue = $row['PAGE10_ISSUE'];

}




if(isset($sample_number)){
$sql0="SELECT * FROM Allocated_pm WHERE primary_pm = '$PM'"; 	
}
else{
$sql0="SELECT * FROM Allocated_pm WHERE contact = '$email_online_app'"; 	
}


$result0=$dbh->query($sql0); 

while($row = $result0->fetch(PDO::FETCH_ASSOC)){
	 
$primary_pm = $row['PRIMARY_PM'];
$primary_pm_phone = $row['PRIMARY_PM_PHONE'];
$primary_pm_email= $row['PRIMARY_PM_EMAIL'];
$secondary_pm = $row['SECONDARY_PM'];
$secondary_pm_phone = $row['SECONDARY_PM_PHONE'];
$secondary_pm_email= $row['SECONDARY_PM_EMAIL'];

}


?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Online Application, Page 6</title>

<link href="styles.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
    var zIndexNumber = 1000;
    // Put your target element(s) in the selector below!
    $("div").each(function() {
            $(this).css('zIndex', zIndexNumber);
            zIndexNumber -= 10;
    });
});
</script>



<?php if($staff_checking>1){?>
<SCRIPT type="text/javascript">
<!--


$(document).ready(function (e) {
   setInterval ( RunUpdate, 5000 ); // Run once every 5 second
});
function RunUpdate() {
		$("#PMT").load('../lab_control_v2/PMT.php');
};



-->
</SCRIPT>


<script type="text/javascript">
idleTime = 0;
$(document).ready(function () {
    //Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });
});

function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 14) { // 15 minutes
        window.location.href = '../lab_control_v2/look_up.php?sample_number=<?php echo"$sample_number";?>';
    }
}
</script>   
<?php }?>

</head>
<?php include("../lab_control_v2/header_new.php"); ?>
<style type="text/css">

.thumbnail{
position: relative;
z-index: 0;
}

.thumbnail:hover{
background-color: transparent;
z-index: 50;
}

.thumbnail span{ /*CSS for enlarged image*/
position: absolute;
background-color: white;
padding: 5px;
left: -1000px;
border: 1px solid black;
visibility: hidden;
color: black;
text-decoration: none;
}

.thumbnail span img{ /*CSS for enlarged image*/
border-width: 0;
padding: 2px;
}

.thumbnail:hover span{ /*CSS for enlarged image on hover*/
visibility: visible;
top: -150px;
left: 60px; /*position where enlarged image should offset horizontally */

}


</style>
  <style>
.nav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #617a9e;
    border-color: #617a9e;
}

.linav {
    float: left;
}

.linav .linknav, .dropbtn {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.linav .linknav:hover, .dropdown:hover .dropbtn {
    background-color: #1c4074;
    color: white;
}

.linav.dropdown {
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content .linknav:hover {background-color:#1c4074}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>
<div id="content">
	
<?php if(isset($sample_number) && $sample_number!=""){ ?>	
<div id="usefullinks_file_update">
<table>
<tr><td align="center">
		<?php
	if($staff_name!=""){
	$_SESSION['sample_number'] = $sample_number;
	$PMT2 = gmdate("H:i:s", $PMT);
	?>
	PM: <?php echo"<b>$PM</b>"; ?> <div id="PMT">Timer: <b><?php echo "$PMT2"; ?></b></div>	
	<?php } ?>
				
<font size="3"><b>Sample Number <br/></font><font size="5"><?php echo $sample_number?></b></font>
<font size="3">
<?php if(isset($approval_number)){echo" Approved Under <b>$approval_number</b>";}?>
</font>	
	<br/>
<form method="post" action="../lab_control_v2/file_update7.php?page=application">
<input type="hidden" name="user" value="verified"/> 
<input type="hidden" name="sample_number" value="<?php echo $sample_number?>"/>
<input type="submit" value="Return To File Overview"/>
</form>	
	<br/>

<?php /* if($staff_checking==""){ ?>
<form method="post" action="../lab_control_v2/checks_complete.php">
<input type="hidden" name="sample_number" value="<?php echo $sample_number?>"/>
<input type="submit" value="Save Changes"/>
</form>	
<?php } */ if($staff_checking>1){?>
<form method="post" action="../lab_control_v2/checks_complete2.php">
<input type="hidden" name="sample_number" value="<?php echo $sample_number?>"/>
<input type="submit" value="Save Changes &amp; Notify Customer"/>
</form>	<br/>
<form method="post" action="../lab_control_v2/checks_complete2.php">
<input type="hidden" name="progress_with_issues" value="yes"/>
<input type="hidden" name="sample_number" value="<?php echo $sample_number?>"/>
<input type="submit" value="Progress With Issues &amp Notify"/>
</form>		<?php } ?>	
</td></tr></table></div>


<?php include("side_bar.php"); }?>

<div id="textblock">
		
<?php 

if(isset($_SESSION['app_message_3'])){echo "<tr><td colspan=\"3\">". $_SESSION['app_message_3']. "</td></tr>" ;}
include("online_app_title.php"); ?>	
<table width="800" align="center">
	<tr><td>
		<table width="600" align="top">	
	<?php

if(isset($_POST['row'])){
$row = $_POST['row'];
$image_name2 = $_POST['image_name2'];
	
	
if(isset($_POST['delete'])){
$dbh->query("UPDATE Online_application_images SET deleted='1' WHERE unique_id = '$row'");	
}	


if(isset($_POST['restore'])){
$dbh->query("UPDATE Online_application_images SET deleted='0' WHERE unique_id = '$row'");	
}	

	
}

echo"<tr><td colspan=\"8\">
Please upload schematic drawings to cover all models in the application.

<br/>
<i>N.B. If there are any sub components used which do not have WRAS approval, we will require schematic drawings of these also.</i>
<br/><b><u>Range description</u></b><br/><br/> $description</td><tr>"; ?>





<?php 

if($unique_app_id!=" "){
$sql="SELECT * FROM Online_application_images WHERE unique_id LIKE '%$unique_app_id%' AND image_type='schematic' AND deleted='0' ORDER BY image_number ASC"; 
$sql2="SELECT count(*) FROM Online_application_images WHERE unique_id LIKE '%$unique_app_id%' AND image_type='schematic' AND deleted='0' ORDER BY image_number ASC"; 

$result=$dbh->query($sql); 
$result2=$dbh->query($sql2);

$row_count1 = $result2->fetchColumn(); 
}
$counter=0;
if($row_count1 > 0){
echo"<tr><td colspan=\"4\"><b><u>Uploaded Schematic &amp; Sub Component Drawings</u></b></td></tr><tr>";	
}

while($row = $result->fetch(PDO::FETCH_ASSOC)){
	
	 
$image_name = stream_get_contents($row['IMAGE_NAME']);
$image_title = stream_get_contents($row['IMAGE_TITLE']);
$unique_id = $row['UNIQUE_ID'];
$counter ++;
if($counter % 4 == 0){
$wrap = "</tr><tr><td colspan=\"4\"><hr></td></tr><tr>";	
}
else{
$wrap = "";	
}
$time = time(); 

?>

<script type="text/javascript">
<!--

$(document).ready(function(){
var app_id = <?php echo json_encode($unique_id) ?>;

var counter = <?php echo json_encode($counter) ?>;

$("#image_title" + counter).change(function() {
var usr = $("#image_title" + counter).val();
    $.ajax({
    type: "POST",
    url: "drawing_title_change.php",
    data: "image_title=" + usr + "&unique_id=" + app_id,
    success: function(msg){
 }  }); });

});
</script>

<?php


if (strpos($image_name,'.pdf') !== false) {
	
echo"<td width=\"150\" align=\"center\"><form><input type=\"text\" name=\"image_title\" id=\"image_title$counter\" value=\"$image_title\"/></form>
<a><img src=\"../online_application/images/pdf.png\" height=\"50\"></a><br/>
<a href=\"../online_application/$image_name\" target=\"_blank\">Open in new window</a><br/>

<form action=\"drawing_replace.php\" method=\"post\" style=\"display: inline;\">
<input type=\"image\" src=\"../online_application/images/update.png\" height=\"25\" alt=\"Update Image\" title=\"Update Image\"/>
<input type=\"hidden\" name=\"original_image\" value=\"$image_name\"/>
<input type=\"hidden\" name=\"image_title\" value=\"$image_title\"/>
</form>


<form action=\"page4_1.php\" method=\"post\" style=\"display: inline;\">	
<input type=\"hidden\" name=\"row\" value=\"$unique_id\"/>
<input type=\"hidden\" name=\"image_name2\" value=\"$image_name\"/>
<input type=\"hidden\" name=\"delete\" value=\"delete\"/>
<input type=\"image\" src=\"../online_application/images/delete.png\" height=\"25\" alt=\"Delete Image\" title=\"Delete Image\"/></form>";

}
else{
	
echo"<td width=\"150\" align=\"center\"><form><input type=\"text\" name=\"image_title\" id=\"image_title$counter\" value=\"$image_title\"/></form>
<a class=\"thumbnail\"  ><img src=\"../online_application/$image_name?$time\" height=\"50\" style=\"height:150px;width:150px; \"><span>
<img src=\"../online_application/$image_name?$time\" height=\"350\"/>$image_title</span><br/></a>
<a href=\"../online_application/$image_name\" target=\"_blank\">Open in new window</a><br/>


<form action=\"drawing_replace.php\" method=\"post\" style=\"display: inline;\">
<input type=\"image\" src=\"../online_application/images/update.png\" height=\"27\" alt=\"Update Image\" title=\"Update Image\"/>
<input type=\"hidden\" name=\"original_image\" value=\"$image_name\"/>
<input type=\"hidden\" name=\"image_title\" value=\"$image_title\"/>
</form>

<form action=\"counter_rotate.php\" method=\"post\" style=\"display: inline;\">
<input type=\"hidden\" name=\"counter\" value=\"$image_name\"/>
<input type=\"hidden\" name=\"page\" value=\"4_1\"/>
<input type=\"image\" src=\"../online_application/images/left.png\" height=\"27\" alt=\"Rotate Image Counter Clockwise\" title=\"Rotate Image Counter Clockwise\"/></form>

<form action=\"clock_rotate.php\" method=\"post\" style=\"display: inline;\">
<input type=\"hidden\" name=\"clock\" value=\"$image_name\"/>
<input type=\"hidden\" name=\"page\" value=\"4_1\"/>
<input type=\"image\" src=\"../online_application/images/right.png\" height=\"27\" alt=\"Rotate Image Clockwise\" title=\"Rotate Image Clockwise\"/>	
</form>	

<form action=\"page4_1.php\" method=\"post\" style=\"display: inline;\">	
<input type=\"hidden\" name=\"row\" value=\"$unique_id\"/>
<input type=\"hidden\" name=\"image_name2\" value=\"$image_name\"/>
<input type=\"hidden\" name=\"delete\" value=\"delete\"/>
<input type=\"image\" src=\"../online_application/images/delete.png\" height=\"27\" alt=\"Delete Image\" title=\"Delete Image\"/></form>";

}

echo"
</td>$wrap";
}

if($row_count1 > 0){
echo"</tr>";	
}
	
	?>		
	</table>
</td>
<td>
		
<?php 

	if($unique_app_id!=""){
$sql="SELECT * FROM Online_application_images WHERE image_type='schematic' AND unique_id LIKE '%$unique_app_id%' AND deleted='1' ORDER BY image_number ASC"; 
$result=$dbh->query($sql); 
$row_count = $result->fetch(PDO::FETCH_NUM); 
	}
if($row_count > 0){
echo"
<table width=\"200\" align=\"top\" bgcolor=\"#E0E0E0\">
<tr><td><b><u>Deleted Images</u></b></td></tr><tr>";	
}
$counter =1;
while($row = $result->fetch(PDO::FETCH_ASSOC)){
	 
$image_name2 = stream_get_contents($row['IMAGE_NAME']);
$image_title2 = stream_get_contents($row['IMAGE_TITLE']);
$unique_id2 = $row['UNIQUE_ID'];	
if($counter % 1 == 0){
$wrap = "</tr><tr>";	
}
else{
$wrap = "";	
}
$time = time(); 
echo"
<td width=\"100\" align=\"center\">
$image_title2 <br/>
<img src=\"../online_application/$image_name2?$time\" height=\"50\"><br/>

<form action=\"page4_1.php\" method=\"post\" style=\"display: inline;\">	
<input type=\"hidden\" name=\"row\" value=\"$unique_id2\"/>
<input type=\"hidden\" name=\"image_name2\" value=\"$image_name2\"/>
<input type=\"hidden\" name=\"restore\" value=\"restore\"/>
<input type=\"Submit\" value=\"Restore Image\"/></form>

</td>$wrap";
/*
<div>
<object data="test.pdf" type="application/pdf" width="300" height="200">
alt : <a href="test.pdf">test.pdf</a>
</object>
</div>
*/
$counter ++;
}

if($row_count > 0){
echo"</td></tr></table>";	
}

?>		
		
		
		</td>
</tr>


<form action="confirm.php" enctype="multipart/form-data" method="post">
	<input type="hidden" name="page" value="41"/>
<table width="800"align="center">
	
	
  <tr><td colspan="3">
  	<?php if(isset($_SESSION['app_message_3'])){ echo "<font color=\"red\" size=\"4\" weight=\"bolder\">*</font>";}else{echo"<font size=\"4\" weight=\"bolder\">*</font>";}?>
  	<font color="red">What is the title of this drawing?</font>
  	<br/>
  	<i>N.B. This title will be used on the Schedule of Materials for cross referencing</i></td><td align="left">
  	<textarea rows="2" cols="46" name="drawing_title" wrap="physical" placeholder="Please ensure all model numbers in the range are covered"></textarea>

	<br/><br/></td></tr>  
	
	
  <tr><td colspan="3">
  	<?php if(isset($_SESSION['app_message_3'])){ echo "<font color=\"red\" size=\"4\" weight=\"bolder\">*</font>";}else{echo"<font size=\"4\" weight=\"bolder\">*</font>";}?>
  	Please upload a schematic drawing of your product.<br/>
  	<i>The accepted file formats are .pdf, .png &amp; .jpeg</i></td><td align="left">
	<input name="uploaded" type="file" />
	<input type="submit" name="next_page" value="Upload" />
	</form>
	 <br/>
	</td></tr>  


  <tr><td colspan="4">
<form action="confirm.php" enctype="multipart/form-data" method="post">

</td></tr>

	<tr><td>
	<br/>
	
	<input type="hidden" name="page" value="41"/>
	<input type="submit" name="exit" value="Save &amp; Exit" /></td><td></td><td></td><td align="right"><br/>
	<?php if($row_count1 > 0){ ?>
		<?php if($sample_number==""){?>
	<input type="submit" name="next_page" value="Next Page"/>
	<?php } else {?>
	<input type="submit" name="next_page" value="Next Page / Save Changes"/>	
		 <?php } ?>
	<?php }else{ ?>
	Please upload a drawing before progressing
	<?php }?>
	</form>
	</td></tr>
</table>	
<?php if(isset($_SESSION['app_message_3'])){ unset($_SESSION['app_message_3']);}?>	

</div>


</div>

</html>	