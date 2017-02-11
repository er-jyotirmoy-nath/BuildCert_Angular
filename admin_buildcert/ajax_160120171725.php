<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include("connections/wrc_new.php");
date_default_timezone_set('Europe/London');
ini_set('display_errors','1');

?><?php 
if(isset($_POST["dash"][0]) && isset($_POST["dash"][1]) && isset($_POST["dash"][2])){
    $dash_str = '<table id="example" class="table table-striped table-bordered" >
                <thead>
            <tr>
                <th>Project Number</th>
                <th>Company</th>
                <th>Product Description</th>
                <th>Progress</th>
                <th>Contract</th>
                <th>Front sheets</th>
                <th>F2 Form</th>
                <th>Status</th>
                <th>Decision</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
               <th>Project Number</th>
                <th>Company</th>
                <th>Product Description</th>
                <th>Progress</th>
                <th>Contract</th>
                <th>Front sheets</th>
                <th>F2 Form</th>
                <th>Status</th>
                <th>Decision</th>
                <th></th>
            </tr>
        </tfoot>
        <tbody>';
    
        $counter=0;
        $colour1="FFFFFF";
        $colour2="F2F2F2";

        $sql="SELECT SAMPLE_NUMBER,UNIQUE_APP_ID,COMPANY,PRODUCT_DESCRIPTION_SHORT,TESTING_COMPLETE,TEST_INSPECTOR,PM,"
                . "CONTRACT_NUMBER,BS6920_COMPLIANT,WRAS_OK,BS6920_DATE,BS6920_BY,"
                . "MATERIALS_CHECKED,MATERIALS_OK,CONTRACT_REVIEW_COMPLETE,CONTRACT_REVIEW_BY,"
                . "PRODUCT_TESTING_COMPLETE,TESTING_REPORT_COMPLETE,TESTING_COMPLETE,TESTING_CHECKED,"
                . "CERT_ISSUED FROM Full_details WHERE (product_testing_complete!='' OR product_testing_complete IS NOT NULL) AND (testing_report_complete!='' OR testing_report_complete IS NOT NULL) AND (materials_checked!='' OR materials_checked IS NOT NULL) AND (wras_ok!='' OR wras_ok IS NOT NULL) AND PM!='File Closed' AND (approval_number='' OR approval_number IS NULL)  ORDER BY sample_number DESC"; 	

        $result=$dbh->query($sql); 


    while($row = $result->fetch(PDO::FETCH_ASSOC)){
	
	$sample_number = $row['SAMPLE_NUMBER'];
	$unique_app_id = $row['UNIQUE_APP_ID'];
	$company = $row['COMPANY'];
	$product_description_short = $row['PRODUCT_DESCRIPTION_SHORT'];
	$testing_complete = $row['TESTING_COMPLETE'];
	$test_inspector = $row['TEST_INSPECTOR'];
	$PM = $row['PM'];
	$contract_number = $row['CONTRACT_NUMBER'];
	$bs6920_compliant = $row['BS6920_COMPLIANT']; 	// bs6920 compliance 0 not done, 1 ok, 2 not ok
	$wras_ok = $row['WRAS_OK'];
	$bs6920_date = $row['BS6920_DATE']; // record of when BS6920 was confirmed
	$bs6920_by = $row['BS6920_BY']; // and who did it

	
	$materials_checked = $row['MATERIALS_CHECKED']; // use for cert review complete
	$materials_ok = $row['MATERIALS_OK']; // use for cert review complete
	
	$contract_review_complete = $row['CONTRACT_REVIEW_COMPLETE']; // use for cert review complete
	$contract_review_by = $row['CONTRACT_REVIEW_BY']; // use for cert review complete
	
	$product_testing_complete = $row['PRODUCT_TESTING_COMPLETE'];
	$testing_report_complete = $row['TESTING_REPORT_COMPLETE'];
	$testing_complete = $row['TESTING_COMPLETE'];
	$testing_checked = $row['TESTING_CHECKED'];

	$cert_issued = $row['CERT_ISSUED'];

	
	if($materials_checked=="" && $materials_ok==""){
	$col = "class=\"progress-bar progress-bar-warning\"";
	$col_title = "title=\"$PM - Materials not checked or OK'd\"";
	}
	if($materials_checked!="" && $materials_ok==""){
	$col = "class=\"progress-bar progress-bar-danger\"";
	$col_title = "title=\"$PM - Materials checked but not OK'd\"";
	}
	if($materials_checked!="" && $materials_ok!=""){
	$col = "class=\"progress-bar progress-bar-success\"";
	$col_title = "title=\"$PM - Materials checked and OK'd\"";
	}
	
	if($bs6920_compliant==0 || $bs6920_compliant==""){
		$col_one = "class=\"progress-bar progress-bar-warning\"";
		$col_one_title = "title=\"$PM - BS6920 Compliance NOT Confirmed\"";
	}
    if($bs6920_compliant==1 || $wras_ok!=""){
    	$col_one = "class=\"progress-bar progress-bar-success\"";
		$col_one_title = "title=\"$PM - BS6920 Compliance Check Passed / WRAS Check Passed\"";
	}
    if($bs6920_compliant==2){
    	$col_one = "class=\"progress-bar progress-bar-danger\"";
		$col_one_title = "title=\"$PM - BS6920 Compliance Check Failed\"";
	}
	
	if($product_testing_complete=="" || $testing_report_complete==""){
	$col_two = "class=\"progress-bar progress-bar-danger\"";
	$col_two_title = "title=\"$test_inspector - Testing NOT Complete\"";
	}
	if($product_testing_complete!="" && $testing_report_complete!="" && $testing_checked==""){
	$col_two = "class=\"progress-bar progress-bar-warning\"";
	$col_two_title = "title=\"$test_inspector - Testing Complete, Report NOT Signed-off\"";
	}
	if($testing_checked!=""){
	$col_two = "class=\"progress-bar progress-bar-success\"";
	$col_two_title = "title=\"$test_inspector - Testing Complete &amp; Report Signed-off by Supervisor\"";
	}
	
	
	$tab_count=0;
	
	// access front sheets
	
	$sql2="SELECT count(*) FROM WRC.Front_sheets WHERE sample_number LIKE '%$sample_number%'"; 
	$result2=$dbh->query($sql2); 
	$fs_count = $result2->fetchColumn(); 	

	$sql2="SELECT count(*) FROM WRC.Front_sheets WHERE sample_number LIKE '%$sample_number%' AND recommendation IS NOT NULL"; 
	$result2=$dbh->query($sql2); 
	$fs_res_count = $result2->fetchColumn(); 
			
	if($fs_count==0 || $fs_count!=$fs_res_count){
	$col_three = "class=\"progress-bar progress-bar-danger\"";
	$col_three_title = "title=\"$test_inspector - Front Sheet(s) NOT Created / Recommendation(s) NOT Confirmed \"";
	}
	if($fs_count>0 && $fs_count==$fs_res_count && $testing_checked==""){
	$col_three = "class=\"progress-bar progress-bar-warning\"";
	$col_three_title = "title=\"$test_inspector - Front Sheet(s) Created, Awaiting Supervisory Sign-off\"";
	}
	if($fs_count>0 && $fs_count==$fs_res_count && $testing_checked!=""){
	$col_three = "class=\"progress-bar progress-bar-success\"";
	$col_three_title = "title=\"$test_inspector - Front Sheet(s) Created and Signed-off by Supervisor\"";
	}

	
	// access reg4 listings DB
	
	
	

	
	// access invoices
	
		$sql3="SELECT * FROM Invoicing WHERE sample_number = '$sample_number'"; 
		$result3=$dbh->query($sql3); 
		$invoice_count = $result3->fetchColumn(); 
	
		$sql3="SELECT * FROM Invoicing WHERE sample_number = '$sample_number' AND date_paid!=''"; 
		$result3=$dbh->query($sql3); 
		$paid_invoice_count = $result3->fetchColumn(); 
		
			
	if($invoice_count==0){
		$col_four = "class=\"progress-bar progress-bar-danger\"";
		$col_four_title = "title=\"Invoice NOT Raised\"";
	}
	if($invoice_count>0 && $paid_invoice_count==0){
		$col_four = "class=\"progress-bar progress-bar-warning\"";
		$col_four_title = "title=\"Invoice(s) Raised but NOT Paid / NOT Paid in Full\"";
	} 
	if($invoice_count>0 && $invoice_count==$paid_invoice_count){
		$col_four = "class=\"progress-bar progress-bar-success\"";	
		$col_four_title = "title=\"Invoice(s) Raised and Paid\"";
	}
			
	// link to view f2 form if unique app id present
	// link to view test report in beaker once exists
		
	
	// issue cert decision based on status of sample
	$PM = trim($row['PM']);
	
	if(isset($PM) && $PM!="" && $PM!=" " && !empty($PM)){
		
		$PM_sub = explode(" ", $PM);
		$acronym = "";
                foreach ($PM_sub as $w) {
			$acronym .= $w[0];
		}
		
		$PM_sub = ucwords($acronym);
	}
	if(isset($contract_review_by) && $contract_review_by!="" && $contract_review_by!=" "){		
		$contract_rev_sub = explode(" ", "$contract_review_by");
		$acronym = "";

		foreach ($contract_rev_sub as $w) {
			$acronym .= $w[0];
		}
		
		$contract_rev_sub = ucwords($acronym);
	}
        $test_inspector = trim($test_inspector);
	if(isset($test_inspector) && $test_inspector!="" && $test_inspector!=" "){
		$LT = explode(" ", "$test_inspector");
		$acronym = "";

		foreach ($LT as $w) {
			$acronym .= $w[0];
		}
		
		$LT = ucwords($acronym);
	}
	
			$row_colour = ($counter % 2) ? $colour1 : $colour2;
		$dash_str .= "<tr bgcolor =\"$row_colour\">"
                        . "<td> $sample_number </td>
                            <td> $company </td>
                               <td> $product_description_short </td>
                               <td>";
                
                $dash_str .="<div class=\"progress\" style=\"\">". "<div $col $col_title role=\"progressbar\" style=\"width:20%;height: 30px;\">";
                
             if($contract_review_by=="")$dash_str .= $PM_sub; else $dash_str .= $contract_rev_sub; 
             
             $dash_str .= "</div>"."<div $col_one $col_one_title role=\"progressbar\" style=\"width:20%;height: 30px;\">"
                     . "$PM_sub
                         </div>". "<div $col_two $col_two_title role=\"progressbar\" style=\"width:20%;height: 30px;\">";
             if($LT!="") $dash_str .= $LT; else $dash_str .="";
             
             $dash_str .= "</div>". "<div $col_three $col_three_title role=\"progressbar\" style=\"width:20%;height: 30px;\">";
             
             if($LT!="") $dash_str .= $LT; else $dash_str .="";
             
            $dash_str .= "</div>". "<div $col_four.$col_four_title role=\"progressbar\" style=\"width:20%;height: 30px;\">"
                    . "Inv"
                    . "</div>"
                    . "</div>";
            
            
            
            
            $dash_str .= "</td><td align=\"center\">$contract_number</td><td>";
    	    $query3  = "SELECT sample_number, recommendation FROM WRC.Front_sheets WHERE sample_number LIKE '%$sample_number%'";
		$result3 = $dbh->query($query3);
			while($row = $result3->fetch(PDO::FETCH_ASSOC)){
	
			$sample_number2 = $row['SAMPLE_NUMBER'];
			$recommendation = $row['RECOMMENDATION'];
			
			$dash_str .="$sample_number2 - $recommendation <br/>";
			
			};
            $dash_str .= "</td>
			
			<td>";
          if($unique_app_id!=""){
			$dash_str .= "<a href=\"http://nsfaaws6.nsf.org/lab_control_v2/create_f2_form_v3.php?unique_app_id=$unique_app_id\" target=\"_blank\" title=\"Any PDF images will not be shown\">View F2 Form</a>";
				}
                         
			$dash_str .= "</td>
			
			<td>";
                        if(trim($testing_report_complete)!="" && trim($testing_report_complete)!=null){
                        $dash_str .= '<div class="checkbox" id="checked'.$sample_number.'1">
                                        <label><input type="checkbox" value="1" onclick="update_status('.$sample_number.',\'a\')">Test reports are adequate</label>
                                      </div><br>';
                        }
                        else
                        {
                            $dash_str .= "<div class=\"checkbox\" id=\"checked1\">
                                        <label><i class=\"fa fa-check-square\"></i> Test reports are adequate</label>
                                      </div><br>";
                        }
                        if(trim($materials_checked)!=""){
                        $dash_str .= '<div class="checkbox" id="checked'.$sample_number.'2">
                                    <label><input type="checkbox" value="1" onclick="update_status('.$sample_number.',\'b\')">Fully complaint materials</label>
                                  </div><br>';
                        }
                        else
                        {
                            $dash_str.="<div class=\"checkbox\" id=\"checked2\">
                                    <label><i class=\"fa fa-check-square\"></i> Fully complaint materials</label>
                                  </div><br>";
                        }
                        if(trim($product_testing_complete)!="0"){
                        $dash_str .= '<div class="checkbox" id="checked'.$sample_number.'3">
                                <label><input type="checkbox" value="3" onclick="update_status('.$sample_number.',\'c\')">Quality System varified</label>
                              </div><br>';
                        }
                        else
                        {
                            $dash_str .="<div class=\"checkbox\" id=\"checked3\">
                                <label><i class=\"fa fa-check-square\"></i> Quality System varified</label>
                              </div><br>";
                        }
                         if($cert_issued==0){
                        $dash_str .="<div class=\"checkbox\" id=\"checked3\">
                                <label><i class=\"fa fa-window-close\"></i> Certificate Issue Status</label>
                              </div><br>";
                        }
                        else
                        {
                            $dash_str .="<div class=\"checkbox\" id=\"checked3\">
                                <label><i class=\"fa fa-check-square\"></i> Certificate Issue Status</label>
                              </div><br>";
                        }
                        $dash_str .= "</td>
			
			<td>";
	 if($fs_count>0 && $fs_count==$fs_res_count && $product_testing_complete!="" && $testing_report_complete!="" && $materials_checked!="" && $cert_issued==0){
						if($bs6920_compliant==1 || $wras_ok!=""){
					
			$dash_str .= "<form method=\"post\">
    	 		<input type=\"hidden\" name=\"sample_number\" id=\"sample_number\" value=\"$sample_number\"/>
    	 		<input type=\"hidden\" name=\"issue_cert\" id=\"issue_cert\" value=\"yes\"/>
                        <button type=\"button\" class=\"btn btn-primary\" id=\"cert_issue\" data-toggle=\"modal\" data-target=\"#cerissue\">ISSUE CERT</button>
    	 		</form>";	
    	 		 }}		
			$dash_str .= "</td>
			
			<td>
    	 		<form method=\"post\" action=\"http://nsfaaws6.nsf.org/lab_control_v2/file_update7.php?page=front_sheet&menu=no\" target=\"_blank\">
    	 		<input type=\"hidden\" name=\"sample_number\" value=\"$sample_number\"/>
    	 		<input type=\"submit\" value=\"View file\" class=\"btn btn-default\"/>
    	 		</form>";
    
    
    
    	 
    	 $dash_str .="</td></tr>";	    
		$counter++;		
	}
        $dash_str .='</tbody></table>';
        echo $dash_str ;

}
if(isset($_POST["issue_cert"][0]) && isset($_POST["issue_cert"][1]) && isset($_POST["issue_cert"][2])){

    	$sample_number = $_POST["issue_cert"][1];
	
	// check if any cert details exist already in Reg_four_listings table

		$sql2="SELECT count(*) FROM REG_FOUR_LISTINGS WHERE sample_number = '$sample_number'"; 	
		$result2=$dbh->query($sql2); 
		$listing_count = $result2->fetchColumn();  
		
		$sql3="SELECT count(*) FROM Front_sheets WHERE linked_with = '$sample_number'";
		$result3=$dbh->query($sql3); 
		$listing_count1 = $result3->fetchColumn();  
			
	
	// if they don't, create them in the Reg_four_listings table - take range description from online application if available, else provide AM with 
	// input box for the range description.

		if($listing_count==0 && $listing_count1==0){
		
		// can't use this until the DB fields are added $sql="SELECT sample_number, unique_app_id, contract_number, company, product_description, bs6920_compliant, bs6920_by, wras_ok, PM FROM Full_details WHERE sample_number='$sample_number'"; 	
		$sql="SELECT sample_number, unique_app_id, contract_number, company, product_description, wras_ok, PM FROM Full_details WHERE sample_number='$sample_number'"; 	
		
		$result=$dbh->query($sql); 
		
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				
				$sample_number = $row['SAMPLE_NUMBER'];
				$unique_app_id = $row['UNIQUE_APP_ID'];
				$company = $row['COMPANY']; // do we need to confirm who is to be listed on the cert?  Are we assuming it's the applicant?
				$product_description = $row['PRODUCT_DESCRIPTION'];
				$contract_number = $row['CONTRACT_NUMBER'];
				// needs adding to full_details table $bs6920_compliant = $row['BS6920_COMPLIANT']; 	
				// needs adding to full_details table $bs6920_by = $row['BS6920_BY'];
				$wras_ok = $row['WRAS_OK'];
				$PM = $row['PM'];
				$created = date("Y-m-d H:i:s", strtotime("now"));
				
				if($bs6920_compliant==0 && $wras_ok!=""){
					$bs6920_compliant=1;
					$bs6920_by = $PM;	
				}
				
			
			}
			
			/* table doesn't exist yet
			mysql_query("INSERT INTO Reg_four_listings (sample_number, unique_id, product_type, manufacturer, range_description, bs6920_compliant, bs6920_by, created_date) 
				VALUES ('$sample_number', '$unique_app_id', '$contract_number', '$company', '$product_description', '$bs6920_compliant', '$bs6920_by', '$created')");
			*/
			
		
	
	
	// next add the sub models to the listing, Reg_four_models
				
				//$dbh->exec("UPDATE Reg_four_models SET authorised_by='$staff_name', authorised='$time' WHERE sample_number LIKE '%$sample_number%'");			

			
	// generate automated certificate, with appropriate directorial signature
	
						
					
					
			$header = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Page <b>%p</b> of <b>%n</b>";
			$footer = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WRAS Form F2 - Application for approval of a water fitting&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Issued February 2014 V8";
			
			require 'pdfcrowd.php';
			
			try
			{
			    // create an API client instance
			    $client = new Pdfcrowd("agreen", "8a8fc5d149cf09d447da29141a3d30ef");
				
				$pagewidth = $client->setPageWidth("297mm");
				$pageheight = $client->setPageHeight("210mm");
				$pagemargins = $client->setPageMargins("0mm","0mm","0mm","0mm");
				
				
				   // convert a web page and store the generated PDF into a $pdf variable
			
				if($staff_name=="Simon Warburton"){
				    $pdf = $client->convertURI("http://www.wrcnsf.com/lab_control_v2/create_cert.php?sample_number=$sample_number");
				}
				if($staff_name=="Gareth Mapp"){
				    $pdf = $client->convertURI("http://www.wrcnsf.com/lab_control_v2/create_cert2.php?sample_number=$sample_number");
				}
				
			
			
			    // set HTTP response headers
			    header("Content-Type: application/pdf");
			    header("Cache-Control: no-cache");
			    header("Accept-Ranges: none");
			    header("Content-Disposition: attachment; filename=\"C$sample_number.pdf\"");
			
			    // send the generated PDF 
			    file_put_contents("uploaded_documents/$sample_number/C$sample_number.pdf", $pdf);	
				
			    
			}
			catch(PdfcrowdException $why)
			{
			    $dash_str = "Pdfcrowd Error: " . $why;
			}
				
				
	// generate covering letter to accompany certificate
	
			$header = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Page <b>%p</b> of <b>%n</b>";
			$footer = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WRAS Form F2 - Application for approval of a water fitting&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Issued February 2014 V8";
			
			try
			{
			    // create an API client instance
			    $client = new Pdfcrowd("agreen", "8a8fc5d149cf09d447da29141a3d30ef");
				
				$pagewidth = $client->setPageWidth("210mm");
				$pageheight = $client->setPageHeight("297mm");
				$pagemargins = $client->setPageMargins("0mm","0mm","0mm","0mm");
				
				
				   // convert a web page and store the generated PDF into a $pdf variable
			
				if($staff_name=="Simon Warburton"){
				    $pdf2 = $client->convertURI("http://www.wrcnsf.com/lab_control_v2/create_cert.php?sample_number=$sample_number");
				}
				if($staff_name=="Gareth Mapp"){
				    $pdf2 = $client->convertURI("http://www.wrcnsf.com/lab_control_v2/create_cert2.php?sample_number=$sample_number");
				}
				
			
			
			    // set HTTP response headers
			    header("Content-Type: application/pdf");
			    header("Cache-Control: no-cache");
			    header("Accept-Ranges: none");
			    header("Content-Disposition: attachment; filename=\"L$sample_number.pdf\"");
			
			    // send the generated PDF 
			    file_put_contents("uploaded_documents/$sample_number/L$sample_number.pdf", $pdf2);	
				
			    
			}
			catch(PdfcrowdException $why)
			{
			    $dash_str = "Pdfcrowd Error: " . $why;
			}
	
	// add covering letter & certificate to discussion board for relevant file (which in turn notifies customers)
	
        $comments = "
        This application has successfully met the requirements of Regulation 4, below you will find a copy of your compliance declaration and covering letter.  The covering letter details
        the exact models covered by the declaration.<br/>
        <a href=\"uploaded_documents/$sample_number/C$sample_number.pdf\">Compliance Declaration</a><br/>
        <a href=\"uploaded_documents/$sample_number/L$sample_number.pdf\">Covering Letter</a>";	

        if($pdf!=""){

		$date_minutes = date("i", strtotime("now"));
		$date_hours = date("H", strtotime("now"));
		$date_day = date("d", strtotime("now"));
		$date_month = date("m", strtotime("now"));
		$date_year = date("Y", strtotime("now"));
		$time_alt = $date_minutes + ($date_hours*60) + (($date_day*24)*60) + ((($date_month * 31)*24)*60) + ((($date_year * 372)*24)*60); 
		
            $query2  = "select * from(SELECT counter FROM File_discussions WHERE sample_number = '$sample_number' ORDER BY counter DESC) where rownum=1";
            $result2 = $dbh->query($query2);

            while($row = $result2->fetch(PDO::FETCH_ASSOC)){
                    $counter = $row['COUNTER'];
            }

            $counter = $counter +1;
            $unique_id = "$sample_number$space$counter";
            $comments = str_replace("\r\n","<br>", $comments);

            $stmt = $dbh->prepare("INSERT INTO File_discussions (unique_id, sample_number, counter, comments, person, time, time_alt, permission) 
            VALUES('$unique_id', '$sample_number', '$counter', :textstring, '$person', '$time', '$time_alt', '$permission')"); 

            $stmt->bindValue(':textstring', $comments, PDO::PARAM_STR);

            $stmt->execute();

            }


            }




if($listing_count1!=0){
				
// update reg_four_models to confirm status as approved 
			

			
	// generate automated certificate, with appropriate directorial signature
	
						
					
					
			$header = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Page <b>%p</b> of <b>%n</b>";
			$footer = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WRAS Form F2 - Application for approval of a water fitting&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Issued February 2014 V8";
			
			require 'pdfcrowd.php';
			
			try
			{
			    // create an API client instance
			    $client = new Pdfcrowd("agreen", "8a8fc5d149cf09d447da29141a3d30ef");
				
				$pagewidth = $client->setPageWidth("297mm");
				$pageheight = $client->setPageHeight("210mm");
				$pagemargins = $client->setPageMargins("0mm","0mm","0mm","0mm");
				
				
				   // convert a web page and store the generated PDF into a $pdf variable
			
				if($staff_name=="Simon Warburton"){
				    $pdf = $client->convertURI("http://www.wrcnsf.com/lab_control_v2/create_cert.php?sample_number=$sample_number");
				}
				if($staff_name=="Gareth Mapp"){
				    $pdf = $client->convertURI("http://www.wrcnsf.com/lab_control_v2/create_cert2.php?sample_number=$sample_number");
				}
				
			
			
			    // set HTTP response headers
			    header("Content-Type: application/pdf");
			    header("Cache-Control: no-cache");
			    header("Accept-Ranges: none");
			    header("Content-Disposition: attachment; filename=\"C$sample_number.pdf\"");
			
			    // send the generated PDF 
			    file_put_contents("uploaded_documents/$sample_number/C$sample_number.pdf", $pdf);	
				
			    
			}
			catch(PdfcrowdException $why)
			{
			    $dash_str = "Pdfcrowd Error: " . $why;
			}
				
				
	// generate covering letter to accompany certificate
	
			$header = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Page <b>%p</b> of <b>%n</b>";
			$footer = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WRAS Form F2 - Application for approval of a water fitting&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Issued February 2014 V8";
			
			try
			{
			    // create an API client instance
			    $client = new Pdfcrowd("agreen", "8a8fc5d149cf09d447da29141a3d30ef");
				
				$pagewidth = $client->setPageWidth("210mm");
				$pageheight = $client->setPageHeight("297mm");
				$pagemargins = $client->setPageMargins("0mm","0mm","0mm","0mm");
				
				
				   // convert a web page and store the generated PDF into a $pdf variable
			
				if($staff_name=="Simon Warburton"){
				    $pdf2 = $client->convertURI("http://www.wrcnsf.com/lab_control_v2/create_cert.php?sample_number=$sample_number");
				}
				if($staff_name=="Gareth Mapp"){
				    $pdf2 = $client->convertURI("http://www.wrcnsf.com/lab_control_v2/create_cert2.php?sample_number=$sample_number");
				}
				
			
			
			    // set HTTP response headers
			    header("Content-Type: application/pdf");
			    header("Cache-Control: no-cache");
			    header("Accept-Ranges: none");
			    header("Content-Disposition: attachment; filename=\"L$sample_number.pdf\"");
			
			    // send the generated PDF 
			    file_put_contents("uploaded_documents/$sample_number/L$sample_number.pdf", $pdf2);	
				
			    
			}
			catch(PdfcrowdException $why)
			{
			    $dash_str = "Pdfcrowd Error: " . $why;
			}
	
	// add covering letter & certificate to discussion board for relevant file (which in turn notifies customers)
	
                            $comments = "
                            This application has successfully met the requirements of Regulation 4, below you will find a copy of your compliance declaration and covering letter.  The covering letter details
                            the exact models covered by the declaration.<br/>
                            <a href=\"uploaded_documents/$sample_number/C$sample_number.pdf\">Compliance Declaration</a><br/>
                            <a href=\"uploaded_documents/$sample_number/L$sample_number.pdf\">Covering Letter</a>";	

                            if($pdf!=""){

                                            $date_minutes = date("i", strtotime("now"));
                                            $date_hours = date("H", strtotime("now"));
                                            $date_day = date("d", strtotime("now"));
                                            $date_month = date("m", strtotime("now"));
                                            $date_year = date("Y", strtotime("now"));
                                            $time_alt = $date_minutes + ($date_hours*60) + (($date_day*24)*60) + ((($date_month * 31)*24)*60) + ((($date_year * 372)*24)*60); 

                            $query2  = "select * from(SELECT counter FROM File_discussions WHERE sample_number = '$sample_number' ORDER BY counter DESC) where rownum=1";
                            $result2 = $dbh->query($query2);

                            while($row = $result2->fetch(PDO::FETCH_ASSOC)){
                                    $counter = $row['COUNTER'];
                            }


                            $counter = $counter +1;
                            $unique_id = "$sample_number$space$counter";
                            $comments = str_replace("\r\n","<br>", $comments);

                            $stmt = $dbh->prepare("INSERT INTO File_discussions (unique_id, sample_number, counter, comments, person, time, time_alt, permission) 
                            VALUES('$unique_id', '$sample_number', '$counter', :textstring, '$person', '$time', '$time_alt', '$permission')"); 

                            $stmt->bindValue(':textstring', $comments, PDO::PARAM_STR);

                            $stmt->execute();
                            if($stmt->rowCount() > 0)
                            $dash_str = '<div class="alert alert-success" role="alert">
                                        <strong><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Success!</strong> Your Data Saved Successfully!.
                                      </div>';
                            else
                                $dash_str ='<div class="alert alert-danger" role="alert">
                                            <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Oh snap!</strong> That did not go through try again!!
                                          </div>';
                        
                            echo $dash_str;

}
}
}
?><?php 
if(isset($_POST["upstatus"][0]) && isset($_POST["upstatus"][1]) && isset($_POST["upstatus"][2])){
    if($_POST["upstatus"][2] == 'a')
    {
        $snm = $_POST["upstatus"][1];
        $sql = "UPDATE FULL_DETAILS SET TESTING_REPORT_COMPLETE = 1 WHERE SAMPLE_NUMBER = :sample_number";
        $query = $dbh->prepare($sql);
        $query->bindParam(":sample_number",$snm);
        $query->execute();
        if($query->rowCount() > 0)
        {
            echo "done";
        }
        else
        {
            echo "no";
        }
        
        
    }
    if($_POST["upstatus"][2] == 'b')
    {
        $snm = $_POST["upstatus"][1];
        $sql = "UPDATE FULL_DETAILS SET MATERIALS_CHECKED = 1 WHERE SAMPLE_NUMBER = :sample_number";
        $query = $dbh->prepare($sql);
        $query->bindParam(":sample_number",$snm);
        $query->execute();
        if($query->rowCount() > 0)
        {
            echo "done";
        }
        else
        {
            echo "no";
        }
    }
    if($_POST["upstatus"][2] == 'c')
    {
         $snm = $_POST["upstatus"][1];
        $sql = "UPDATE FULL_DETAILS SET PRODUCT_TESTING_COMPLETE = 1 WHERE SAMPLE_NUMBER = :sample_number";
        $query = $dbh->prepare($sql);
        $query->bindParam(":sample_number",$snm);
        $query->execute();
        if($query->rowCount() > 0)
        {
            echo "done";
        }
        else
        {
            echo "no";
        }
    }
}
//MATERIALS_CHECKED,MATERIALS_OK,CONTRACT_REVIEW_COMPLETE,CONTRACT_REVIEW_BY,"\. "PRODUCT_TESTING_COMPLETE,TESTING_REPORT_COMPLETE,TESTING_COMPLETE,TESTING_CHECKED
?>
