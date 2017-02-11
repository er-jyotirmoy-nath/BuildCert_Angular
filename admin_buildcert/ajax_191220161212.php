<?php

session_start();
include("connections/wrc_new.php");
mb_internal_encoding("iso-8859-1");
mb_http_output("UTF-8");
ob_start("mb_output_handler");
?>
<?php

if (isset($_POST["filter"][0]) && isset($_POST["filter"][1]) && isset($_POST["filter"][2])) {

    if ($_POST["filter"][0] == 'tmv2') {
        $sql_tmv2 = "SELECT BUILD_APP_ID,APPROVED_MIXING_VALVE,UNIQUE_ID,LICENSEE,CERTIFICATE_LETTERS,CERTIFICATE_NUMBER,CERTIFICATE_DATE,COMMENTS,CERT_ID
                    FROM BUILDCERT_APPROVALS where type_app = 'tmv2'
		";
        $query_tmv2 = $dbh->prepare($sql_tmv2);
        $query_tmv2->execute();
        //$result_tmv2 = $query_tmv2->fetchAll();

        $str = '
			<button class="open-addtmv2 btn btn-primary" data-toggle="modal"    data-target="#addtmv2"  ><i class="fa fa-floppy-o" aria-hidden="true"></i> Add TMV2 Record</button><hr>
			<table id="example" class="table table-bordered">
		<thead>
		<tr>
		<th>Approval Holder</th>
		<th>Mixing Valve</th>
		<th>Unique ID</th>
		<th>Certificate</th>
		
		<th>Edit</th>
		<th>Delete</th>
		</tr>
		</thead><tbody>';
        while ($rows = $query_tmv2->fetch(PDO::FETCH_ASSOC)) {
            $approvalh = ($rows["APPROVED_MIXING_VALVE"] != NULL) ? stream_get_contents($rows["APPROVED_MIXING_VALVE"]) : " ";
            $unique = ($rows["UNIQUE_ID"] != NULL) ? stream_get_contents($rows["UNIQUE_ID"]) : "";
            $str .= '<tr><td>' . $rows["LICENSEE"] . '</td>' .
                    '<td>' . $approvalh . '</td>
			<td>' . $unique . '</td>
			<td>' . $rows["CERTIFICATE_LETTERS"] . " " . $rows["CERTIFICATE_NUMBER"] . "/" . $rows["CERTIFICATE_DATE"] . '</td>
			
	                        <td><a data-toggle="modal" data-id="' . $rows["BUILD_APP_ID"] . '" href="#edittmv2" class="open-edittmv2" >edit</a></td>
	                        <td><a href="#" id="del_cias">Delete</a><span id="del_res"></span></td>
	                        </tr>';
        }

        $str .= '</tbody></table>';
        echo $str;
    }
    if ($_POST["filter"][0] == 'tmv3') {
        $sql_tmv2 = "SELECT APPROVED_MIXING_VALVE,UNIQUE_ID,FACTOR,CERTIFICATE_LETTERS,CERTIFICATE_NUMBER,CERTIFICATE_DATE,COMMENTS,BUILD_APP_ID FROM BUILDCERT_APPROVALS where type_app = 'tmv3' ORDER BY CERTIFICATE_NUMBER DESC";
        $query_tmv2 = $dbh->prepare($sql_tmv2);
        $query_tmv2->execute();
       
       // ECHO $sql_tmv2;
        $str = '
			<button class="open-addtmv3 btn btn-primary" data-toggle="modal"    data-target="#addtmv3"  ><i class="fa fa-floppy-o" aria-hidden="true"></i> Add TMV3 Record</button><hr>
			<table id="example"  class="table table-bordered">
		<thead>
		<tr>
		<th>Factor</th>
		<th>Mixing Valve</th>
		<th>Unique ID</th>
		<th>Certificate</th>
		
		<th>Edit</th>
		<th>Delete</th>
		</tr>
		</thead><tbody>';
        while($rows1 = $query_tmv2->fetch(PDO::FETCH_ASSOC)) {
            $approvalh1 = isset($rows1["APPROVED_MIXING_VALVE"])?stream_get_contents($rows1["APPROVED_MIXING_VALVE"]):"";
            $unique1 = isset($rows1["UNIQUE_ID"])?stream_get_contents($rows1["UNIQUE_ID"]):"";
           
            $str .= '<tr><td>' . $rows1["FACTOR"] . '</td>' .
                    '<td>' .substr($approvalh1,0,20).'.... <a href="#" data-toggle="tooltip" title="'.$approvalh1.'">Read More..</a>'.'</td>
			<td>' .substr($unique1,0,20).'.... <a href="#" data-toggle="tooltip" title="'.$unique1.'">Read More..</a>'. '</td>
			<td>' . $rows1["CERTIFICATE_LETTERS"] . " " . $rows1["CERTIFICATE_NUMBER"] . "/" . $rows1["CERTIFICATE_DATE"] . '</td>
			
	                        <td><a data-toggle="modal" data-id="' . $rows1["BUILD_APP_ID"] . '" href="#edittmv3" class="open-edittmv3" >edit</a></td>
	                        <td><a href="#" id="del_cias">Delete</a><span id="del_res"></span></td>
	                        </tr>';
            $approvalh = "";
            $unique = "";
        }

        $str .= '</tbody></table>';
        echo $str;
    }
    if ($_POST["filter"][0] == 'cias') {
        $sql_tmv2 = "SELECT * FROM BUILDCERT_APPROVALS where type_app = 'cias' ORDER BY CERTIFICATE_NUMBER DESC
		";
        $query_tmv2 = $dbh->prepare($sql_tmv2);
        $query_tmv2->execute();
        

        $str = '
			<button class="open-addcias btn btn-primary" data-toggle="modal"    data-target="#addcias"  ><i class="fa fa-floppy-o" aria-hidden="true"></i> Add CIAS Record</button><hr>
			<table id="example" class="table table-bordered">
		<thead>
		<tr>
		<th>Company</th>
		<th>Description</th>
		<th>Sizes</th>
		<th>Certification Number</th>
		<th>Edit</th>
		<th>Delete</th>
		</tr>
		</thead><tbody>';
        while($rows = $query_tmv2->fetch(PDO::FETCH_ASSOC)) {
            $str .= '<tr><td>' . $rows["MANUFACTURER"] . '</td>' .
                    '<td>' . $rows["DESCRIPTION_PRODCERT"] . '</td>
			
			<td>' . $rows["SIZES_CIAS"] . '</td>
			<td>' . $rows["CERTIFICATE_NUMBER"] . '</td>
	                        <td><a data-toggle="modal" data-cias="' . $rows["BUILD_APP_ID"] . '"  href="#editcias" class="open-editcias" >edit</a></td>
	                        <td><a href="#" id="del_cias">Delete</a><span id="del_res"></span></td>

	                        </tr>';
        }

        $str .= '</tbody></table>';
        echo $str;
    }
    if ($_POST["filter"][0] == 'buildcert') {
        $sql_tmv2 = "SELECT * FROM BUILDCERT_APPROVALS where type_app = 'pdcert'
		";
        $query_tmv2 = $dbh->prepare($sql_tmv2);
        $query_tmv2->execute();
        $result_tmv2 = $query_tmv2->fetchAll();

        $str = '
			<button class="open-addbuildcert btn btn-primary" data-toggle="modal"    data-target="#addbuildcert"  ><i class="fa fa-floppy-o" aria-hidden="true"></i> Add BUILDCERT Record</button><hr>
			<table id="example" class="table table-bordered">
		<thead>
		<tr>
		<th>Company</th>
		<th>Performance standard/specification</th>
		<th>Description</th>
		<th>Certificate No</th>
		<th>Expiry
	  			</th>
		<th>Edit</th>
		<th>Delete</th>
		</tr>
		</thead><tbody>';
        foreach ($result_tmv2 as $rows) {

            $str .= '<tr><td>' . $rows["MANUFACTURER"] . '</td>' .
                    '<td>' . $rows["PERFORMANCE_STANDARD"] . '</td>
			<td>' . $rows["DESCRIPTION_PRODCERT"] . '</td>
			<td>' . $rows["CERTIFICATE_NUMBER"] . '</td>
	  				<td>' . $rows["EXPIRY_DATE"] . '</td>
	                        <td><a data-toggle="modal"  data-certnum="' . $rows["BUILD_APP_ID"] . '"  href="#editbuildcert" class="open-editbuildcert" >edit</a></td>
	                        <td><a href="#" id="del_pdcert">Delete</a><span id="del_res"></span></td>
	                        </tr>';
        }

        $str .= '</tbody></table>';
        echo $str;
    }
    if ($_POST["filter"][0] == 'dtc') {
        $sql_tmv2 = "SELECT MANUFACTURER,APPROVED_MIXING_VALVE,DESCRIPTION_PRODCERT,UNIQUE_ID,CERT_ID,EXPIRY_DATE,BUILD_APP_ID FROM BUILDCERT_APPROVALS where type_app = 'dtc'
		";
        $query_tmv2 = $dbh->prepare($sql_tmv2);
        $query_tmv2->execute();
        $result_tmv2 = $query_tmv2->fetchAll();

        $str = '
			<button class="open-adddtc btn btn-primary" data-toggle="modal"    data-target="#adddtc"  ><i class="fa fa-floppy-o" aria-hidden="true"></i> Add DTC Record</button><hr>
			<table id="example" class="table table-bordered">
		<thead>
		<tr>
		<th>Company</th>
		<th>Approved Valve</th>
		<th>Description</th>
		<th>Type</th>
		<th>Certificate Id</th>
                <th>Expiry</th>
		<th>Edit</th>
		<th>Delete</th>
		</tr>
		</thead><tbody>';
        foreach ($result_tmv2 as $rows) {

            $str .= '<tr><td>' . $rows["MANUFACTURER"] . '</td>' .
                    '<td>' . stream_get_contents($rows["APPROVED_MIXING_VALVE"]) . '</td>
			<td>' . $rows["DESCRIPTION_PRODCERT"] . '</td>
			<td>' . stream_get_contents($rows["UNIQUE_ID"]) . '</td>
                            <td>' . $rows["CERT_ID"] . '</td>
	  				<td>' . $rows["EXPIRY_DATE"] . '</td>
	                        <td><a data-toggle="modal"  data-dtc="' . $rows["BUILD_APP_ID"] . '"  href="#editdtc" class="open-editdtc" >edit</a></td>
	                        <td><a href="#" id="del_dtc">Delete</a><span id="del_res"></span></td>
	                        </tr>';
        }

        $str .= '</tbody></table>';
        echo $str;
    }
    if ($_POST["filter"][0] == 'reg4') {
        $reg4_str = '<div class="row">
                <div class="col-lg-12">
                   <div class="dropdown" ><button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" ><i class="fa fa-tasks" aria-hidden="true"></i> Select Option<span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li> <button id="dash" onclick="dash_click()" class="list-group-item"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</button></li>
                              <li> <button id="update" class="list-group-item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Record</button></li>
                              <li> <button id="insert" class="list-group-item"><i class="fa fa-floppy-o" aria-hidden="true"></i> Insert Record</button></li>
                               <li><button id="tools "class="list-group-item"><i class="fa fa-cog" aria-hidden="true"></i> Tools</button></li>
                            </ul>
                          </div>
                   
                </div>
            </div><br><span id="reg4_res"></span>';
        echo $reg4_str;
    }
    if ($_POST["filter"][0] == 'downloads') {
        $reg4_str = '<div class="row">
                <div class="col-lg-12">
               <div class="panel panel-default" style="border-color: #f4511e;">
                <div class="panel-heading">
                  Downloads and Info
                </div>
                <div class="panel-body" style="min-height: 700px;">
                <button class="open-downloads btn btn-primary" data-toggle="modal" data-target="#downloadmod"><i class="fa fa-floppy-o" aria-hidden="true"></i> Add Downloads Record</button><hr>';
        $reg4_str .= get_data();
        $reg4_str .= '
                </div>

              </div>
                   
                </div>
            </div><br><span id="reg4_res"></span>';
        echo $reg4_str;
    }
}

function get_data() {
    try {
    include("connections/wrc_new.php");
     $sql_link = "SELECT * FROM  wrc.FILES";
    $quer_links = $dbh->prepare($sql_link);
    $quer_links->execute();
    $down_data = '<table id="example" class="table table-bordered">
    <thead>
      <tr>
        <th>Section</th>
        <th>Title</th>
        <th>Name</th>
        <th>Link</th>
      </tr>
    </thead>
    <tbody>';
    while ($row = $quer_links->fetch(PDO::FETCH_ASSOC)){
        $link = "http://nsfaaws6.nsf.org/lab_control_v2/standard_documents/".$row["FILE_"];
        $string = explode('@',$row["UPLOADED"]);
        $title = $string[0];
        $name = $string[1];
        $section = $row["SECTION"];
         $down_data .= '<tr>'
                . '<td>' . $section. '</td>'
                . '<td>' . $title. '</td>'
                . '<td>' . $name. '</td>'
                . '<td><a href="' . $link. '" style="font-size:24px;"><span class="	glyphicon glyphicon-download-alt"></span></a></td>'
                . '</tr>';
    }
    $down_data .= '</tbody></table>';
    return $down_data;
     } catch (Exception $exc) {
        echo $exc->getMessage();
    }

}

?><?php

if (isset($_POST["login"][0]) && isset($_POST["login"][1]) && isset($_POST["login"][2])) {
    if ($_POST["login"][2] == 'login') {
        $uname = $_POST["login"][0];
        $psw = $_POST["login"][1];
        if ($uname == "ptaylor@nsf.org" && $psw == "Helpdesk1") {
            $_SESSION["logid"] = sha1($uname . $psw . rand('00000', '99999'));
        }
        echo "Ok";
    } else if ($_POST["login"][2] == "logout") {
        $_SESSION["logid"] = "";
        session_unset();
        //session_destroy();
        echo "Ok";
    }
}
?><?php

//Update data in BUILDCERT_APPROVALS
if (isset($_POST["updbuild"][0]) && isset($_POST["updbuild"][1]) && isset($_POST["updbuild"][2]) && isset($_POST["updbuild"][3])) {


    try {

        if ($_POST["updbuild"][5] == "tmv2") {
            $manufacturer = (trim($_POST["updbuild"][0]) != "") ? $_POST["updbuild"][0] : "no value";
            $certnum = $_POST["updbuild"][1];
            $certdate = $_POST["updbuild"][3];
            $cert_id = $_POST["updbuild"][4];
            $type_app = "tmv2";
            $hp1111 = $_POST["updbuild"][6];
            $hpb = $_POST["updbuild"][7];
            $hpb_c = $_POST["updbuild"][8];
            $hps = $_POST["updbuild"][9];
            $hps_c = $_POST["updbuild"][10];
            $hpw = $_POST["updbuild"][11];
            $hpw_c = $_POST["updbuild"][12];
            $hpt = $_POST["updbuild"][13];
            $hpt_c = $_POST["updbuild"][14];
            $colhp = $_POST["updbuild"][15];
            $lp1287 = $_POST["updbuild"][16];
            $lpb = $_POST["updbuild"][17];
            $lpb_c = $_POST["updbuild"][18];
            $lps = $_POST["updbuild"][19];
            $lps_c = $_POST["updbuild"][20];
            $lpw = $_POST["updbuild"][21];
            $lpw_c = $_POST["updbuild"][22];
            $lpt = $_POST["updbuild"][23];
            $lpt_c = $_POST["updbuild"][24];
            $lptx = $_POST["updbuild"][25];
            $lptx_c = $_POST["updbuild"][26];
            $collp = $_POST["updbuild"][27];
            $comments = $_POST["updbuild"][28];
            $ex_comments = $_POST["updbuild"][29];
            $primeryorsec = $_POST["updbuild"][30];
            $firstaud = $_POST["updbuild"][31];
            $firstcomm = $_POST["updbuild"][32];
            $secaud = $_POST["updbuild"][33];
            $seccom = $_POST["updbuild"][34];
            $discon = $_POST["updbuild"][35];
            $rfw = $_POST["updbuild"][36];
            $new = $_POST["updbuild"][37];
            $expdate = $_POST["updbuild"][38];
            $updated = date("H:i:s d-m-Y", strtotime("now"));
            $aproovedvalve = (trim($_POST["updbuild"][40]) != "") ? $_POST["updbuild"][40] : "no value";
            $uniqueid = (trim($_POST["updbuild"][41]) != "") ? $_POST["updbuild"][41] : "no value";
            $licensee = (trim($_POST["updbuild"][42]) != "") ? $_POST["updbuild"][42] : "no value";
            if ($manufacturer == "" || $licensee == "" || $aproovedvalve == "" || $uniqueid == "" || $certnum == "") {
                echo '<i class="fa fa-times-circle" aria-hidden="true"></i> Values not properly entered';
                echo $manufacturer . "|" . $licensee . "|" . $aproovedvalve . "|" . $uniqueid . "|" . $certnum;
                exit();
            }
            $sql_up_tmv2 = "update BUILDCERT_APPROVALS set
					 MANUFACTURER = :manufacturer,LICENSEE = :licensee,APPROVED_MIXING_VALVE = :aproovedvalve,UNIQUE_ID = :uniqueid,
                                        HP_1111 = :hp1111,HPB = :hpb,HPB_COMMENT = :hpb_c,HPS = :hps,		
					HPS_COMMENT = :hps_c,HPW = :hpw,HPW_COMMENT = :hpw_c,HPT = :hpt,
                                        HPT_COMMENT = :hpt_c,LP_1287 = :lp1287,LPB = :lpb,LPB_COMMENT = :lpb_c,
                                        LPS = :lps,LPS_COMMENT = :lps_c,LPW = :lpw,LPW_COMMENT = :lpw_c,
                                        LPT = :lpt,LPT_COMMENT = :lpt_c,LPTX = :lptx,LPTX_COMMENT = :lptx_c,
					COMMENTS = :comments,EXTENDED_COMMENTS = :ex_comments,PRIMARY_OR_SECONDARY = :primeryorsec,FIRST_AUDIT = :firstaud,
                                        FIRST_COMPLETED = :firstcomm,SECOND_AUDIT = :secaud,SECOND_COMPLETED = :seccom,	DISCONTINUED_WITHDRAWN = :discon,
					REMOVE_FROM_WEBSITE = :rfw,NEW = :new,COLD_ISOL_46_LP = :collp,COLD_ISOL_46_HP = :colhp,EXPIRY_DATE = :expdate,	UPDATED = :updated
					where 	BUILD_APP_ID = :certnum and TYPE_APP = :type_app
			";
            $query_update_tmv2 = $dbh->prepare($sql_up_tmv2);
            $query_update_tmv2->bindParam(":manufacturer", $manufacturer);
            $query_update_tmv2->bindParam(":licensee", $licensee);
            $query_update_tmv2->bindParam(":aproovedvalve", $aproovedvalve);
            $query_update_tmv2->bindParam(":uniqueid", $uniqueid);
            $query_update_tmv2->bindParam(":hp1111", $hp1111);
            $query_update_tmv2->bindParam(":hpb", $hpb);
            $query_update_tmv2->bindParam(":hpb_c", $hpb_c);
            $query_update_tmv2->bindParam(":hps", $hps);
            $query_update_tmv2->bindParam(":hps_c", $hps_c);
            $query_update_tmv2->bindParam(":hpw", $hpw);
            $query_update_tmv2->bindParam(":hpw_c", $hpw_c);
            $query_update_tmv2->bindParam(":hpt", $hpt);
            $query_update_tmv2->bindParam(":hpt_c", $hpt_c);
            $query_update_tmv2->bindParam(":lp1287", $lp1287);
            $query_update_tmv2->bindParam(":lpb", $lpb);
            $query_update_tmv2->bindParam(":lpb_c", $lpb_c);
            $query_update_tmv2->bindParam(":lps", $lps);
            $query_update_tmv2->bindParam(":lps_c", $lps_c);
            $query_update_tmv2->bindParam(":lpw", $lpw);
            $query_update_tmv2->bindParam(":lpw_c", $lpw_c);
            $query_update_tmv2->bindParam(":lpt", $lpt);
            $query_update_tmv2->bindParam(":lpt_c", $lpt_c);
            $query_update_tmv2->bindParam(":lptx", $lptx);
            $query_update_tmv2->bindParam(":lptx_c", $lptx_c);
            $query_update_tmv2->bindParam(":comments", $comments);
            $query_update_tmv2->bindParam(":ex_comments", $ex_comments);
            $query_update_tmv2->bindParam(":primeryorsec", $primeryorsec);
            $query_update_tmv2->bindParam(":firstaud", $firstaud);
            $query_update_tmv2->bindParam(":secaud", $secaud);
            $query_update_tmv2->bindParam(":seccom", $seccom);
            $query_update_tmv2->bindParam(":firstcomm", $firstcomm);
            $query_update_tmv2->bindParam(":discon", $discon);
            $query_update_tmv2->bindParam(":rfw", $rfw);
            $query_update_tmv2->bindParam(":new", $new);
            $query_update_tmv2->bindParam(":collp", $collp);
            $query_update_tmv2->bindParam(":colhp", $colhp);
            $query_update_tmv2->bindParam(":expdate", $expdate);
            $query_update_tmv2->bindParam(":updated", $updated);

            $query_update_tmv2->bindParam(":certnum", $certnum);

            $query_update_tmv2->bindParam(":type_app", $type_app);

            if (!$query_update_tmv2) {
                echo "\nPDO::errorInfo():\n";
                print_r($dbh->errorInfo());
            }
            if (!$query_update_tmv2->execute()) {
                //print_r("<script>alert(\"".$dbh->errorInfo()."\");</script>");
                echo '<i class="fa fa-times-circle" aria-hidden="true"></i> ';
                print_r($dbh->errorInfo());
                //echo print_r()."";
            }
            if ($query_update_tmv2->rowCount() > 0) {
                echo '<i class="fa fa-check-circle" aria-hidden="true"></i> Ok';
            } else {
                echo "<i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> No";
            }
        }

        if ($_POST["updbuild"][5] == "tmv3") {
            
            $factor                     = (trim($_POST["updbuild"][0]) != "") ? $_POST["updbuild"][0] : "no value";
            $manufacturer               = (trim($_POST["updbuild"][1]) != "") ? $_POST["updbuild"][1] : "no value";
            $approved_mixing_valve      = (trim($_POST["updbuild"][6]) != "") ? $_POST["updbuild"][6] : "no value";
            $unique_id                  = $_POST["updbuild"][7];
            $hpb                        = $_POST["updbuild"][8];
            $hpb_comment                = $_POST["updbuild"][9];
            $hps                        = $_POST["updbuild"][10];
            $hps_comment                = $_POST["updbuild"][11];
            $hpw                        = $_POST["updbuild"][12];
            $hpw_comment                = $_POST["updbuild"][13];
            $hpt44                      = $_POST["updbuild"][14];
            $hpt44_comment              = $_POST["updbuild"][15];
            $hpt46                      = $_POST["updbuild"][16];
            $hpt46_comment              = $_POST["updbuild"][17];
            $hpd44                      = $_POST["updbuild"][18];
            $hpd44_comment              = $_POST["updbuild"][19];
            $hpd46                      = $_POST["updbuild"][20];
            $hpd46_comment              = $_POST["updbuild"][21];
            $lpb                        = $_POST["updbuild"][22];
            $lpb_comment                = $_POST["updbuild"][23];
            $lps                        = $_POST["updbuild"][24];
            $lps_comment                = $_POST["updbuild"][25];
            $lpw                        = $_POST["updbuild"][26];
            $lpw_comment                = $_POST["updbuild"][27];
            $lpt44                      = $_POST["updbuild"][28];
            $lpt44_comment              = $_POST["updbuild"][29];
            $lpt46                      = $_POST["updbuild"][30];
            $lpt46_comment              = $_POST["updbuild"][31];
            $lpd44                      = $_POST["updbuild"][32];
            $lpd44_comment              = $_POST["updbuild"][33];
            $lpd46                      = $_POST["updbuild"][34];
            $lpd46_comment              = $_POST["updbuild"][35];
            $comments                   = $_POST["updbuild"][36];
            $extended_comments          = $_POST["updbuild"][37];
            $pts_comments               = $_POST["updbuild"][38];
            $primary_or_secondary       = $_POST["updbuild"][39];
            $first_audit                = $_POST["updbuild"][40];
            $first_completed            = $_POST["updbuild"][41];
            $second_audit               = $_POST["updbuild"][42];
            $second_completed           = $_POST["updbuild"][43];
            $discontinued_withdrawn     = $_POST["updbuild"][44];
            $remove_from_website        = $_POST["updbuild"][45];
            $new                        = $_POST["updbuild"][46];
            $expiry_date                = $_POST["updbuild"][47];
            $build_app_id               = $_POST["updbuild"][48];
            $updated = date("H:i:s d-m-Y", strtotime("now"));
            $sql_up_tmv3 = "update BUILDCERT_APPROVALS set
                            FACTOR =:factor,MANUFACTURER =:manufacturer,APPROVED_MIXING_VALVE =:approved_mixing_valve,UNIQUE_ID =:unique_id,
	 			HPB =:hpb,	HPB_COMMENT =:hpb_comment,	HPS =:hps,	HPS_COMMENT =:hps_comment,
	 			HPW =:hpw,	HPW_COMMENT =:hpw_comment,	HPT44 =:hpt44,	HPT44_COMMENT =:hpt44_comment,
		 		HPT46 =:hpt46,	HPT46_COMMENT =:hpt46_comment,	HPD44 =:hpd44,	HPD44_COMMENT =:hpd44_comment,
				HPD46 =:hpd46,	HPD46_COMMENT =:hpd46_comment,	LPB =:lpb,	LPS =:lps,
	 			LPS_COMMENT =:lps_comment,	LPW =:lpw,	LPW_COMMENT =:lpw_comment,	LPT44 =:lpt44,
				LPT44_COMMENT =:lpt44_comment,	LPT46 =:lpt46,	LPT46_COMMENT =:lpt46_comment,	LPD44 =:lpd44,
				LPD44_COMMENT =:lpd44_comment,	LPD46 =:lpd46,	LPD46_COMMENT =:lpd46_comment,	COMMENTS =:comments,
				EXTENDED_COMMENTS =:extended_comments,	PTS_COMMENTS =:pts_comments,PRIMARY_OR_SECONDARY =:primary_or_secondary,
                                FIRST_AUDIT =:first_audit,FIRST_COMPLETED =:first_completed,SECOND_AUDIT =:second_audit,
                                SECOND_COMPLETED =:second_completed,DISCONTINUED_WITHDRAWN =:discontinued_withdrawn,REMOVE_FROM_WEBSITE =:remove_from_website,
                                NEW =:new,EXPIRY_DATE =:expiry_date,UPDATED = :updated where 
					BUILD_APP_ID = :build_app_id and TYPE_APP = 'tmv3'
			";
            $query_update_tmv3 = $dbh->prepare($sql_up_tmv3);
            $query_update_tmv3->bindParam(":factor",$factor);
            $query_update_tmv3->bindParam(":manufacturer",$manufacturer);
	    $query_update_tmv3->bindParam(":approved_mixing_valve",$approved_mixing_valve);
	    $query_update_tmv3->bindParam(":unique_id",$unique_id );
	    $query_update_tmv3->bindParam(":hpb",$hpb);
	    $query_update_tmv3->bindParam(":hpb_comment",$hpb_comment);
	    $query_update_tmv3->bindParam(":hps",$hps);
	    $query_update_tmv3->bindParam(":hps_comment",$hps_comment );
	    $query_update_tmv3->bindParam(":hpw",$hpw);
	    $query_update_tmv3->bindParam(":hpw_comment",$hpw_comment);
	    $query_update_tmv3->bindParam(":hpt44",$hpt44 );
	    $query_update_tmv3->bindParam(":hpt44_comment",$hpt44_comment );
	    $query_update_tmv3->bindParam(":hpt46",$hpt46);
	    $query_update_tmv3->bindParam(":hpt46_comment",$hpt46_comment );
	    $query_update_tmv3->bindParam(":hpd44",$hpd44);
	    $query_update_tmv3->bindParam(":hpd44_comment",$hpd44_comment );
	    $query_update_tmv3->bindParam(":hpd46",$hpd46 );
	    $query_update_tmv3->bindParam(":hpd46_comment",$hpd46_comment );
	    $query_update_tmv3->bindParam(":lpb",$lpb);
	    $query_update_tmv3->bindParam(":lps",$lps);
	    $query_update_tmv3->bindParam(":lps_comment",$lps_comment);
	    $query_update_tmv3->bindParam(":lpw",$lpw);
	    $query_update_tmv3->bindParam(":lpw_comment",$lpw_comment);
	    $query_update_tmv3->bindParam(":lpt44",$lpt44);
	    $query_update_tmv3->bindParam(":lpt44_comment",$lpt44_comment);
	    $query_update_tmv3->bindParam(":lpt46",$lpt46);
	    $query_update_tmv3->bindParam(":lpt46_comment",$lpt46_comment);
	    $query_update_tmv3->bindParam(":lpd44",$lpd44);
	    $query_update_tmv3->bindParam(":lpd44_comment",$lpd44_comment);
	    $query_update_tmv3->bindParam(":lpd46",$lpd46);
	    $query_update_tmv3->bindParam(":lpd46_comment",$lpd46_comment);
	    $query_update_tmv3->bindParam(":comments",$comments);
	    $query_update_tmv3->bindParam(":extended_comments",$extended_comments);
	    $query_update_tmv3->bindParam(":pts_comments",$pts_comments);
	    $query_update_tmv3->bindParam(":primary_or_secondary",$primary_or_secondary);
	    $query_update_tmv3->bindParam(":first_audit",$first_audit);
	    $query_update_tmv3->bindParam(":first_completed",$first_completed);
            $query_update_tmv3->bindParam(":second_audit",$second_audit);
	    $query_update_tmv3->bindParam(":second_completed",$second_completed);
	    $query_update_tmv3->bindParam(":discontinued_withdrawn",$discontinued_withdrawn);
            $query_update_tmv3->bindParam(":remove_from_website",$remove_from_website);
	    $query_update_tmv3->bindParam(":new",$new);
	    $query_update_tmv3->bindParam(":expiry_date",$expiry_date);
            $query_update_tmv3->bindParam(":build_app_id",$build_app_id);
            $query_update_tmv3->bindParam(":updated",$updated);
            //$query_update_tmv3->execute();
            if (!$query_update_tmv3->execute()) {
            //print_r("<script>alert(\"".$dbh->errorInfo()."\");</script>");
            echo '<i class="fa fa-times-circle" aria-hidden="true"></i> ';
            print_r($dbh->errorInfo());
            //echo print_r().""; 
            }
            if ($query_update_tmv3->rowCount() > 0) {
                echo "Ok";
            } else {
                echo "No";
            }
        }
        if ($_POST["updbuild"][5] == "cias") {
            $manufacturer = $_POST["updbuild"][0];
            $updated = date("H:i:s d-m-Y", strtotime("now"));
            $sizcias = $_POST["updbuild"][2];
            $desc_pc = $_POST["updbuild"][1];
            $certid = $_POST["updbuild"][4];
            $certnum = $_POST["updbuild"][3];
            $build_app_id = $_POST["updbuild"][6];
            $typeapp = "cias";
            
            if ($manufacturer == "" || $certid == "" || $certnum == "") {
                echo '<i class="fa fa-times-circle" aria-hidden="true"></i> Values not properly entered';
                exit();
            }
            $sql = "update BUILDCERT_APPROVALS set
							MANUFACTURER = :manufacturer,
							UPDATED = :updated,
							SIZES_CIAS = :sizecias,
							DESCRIPTION_PRODCERT = :description,
							CERT_ID = :certid,
							CERTIFICATE_NUMBER = :certnum
							WHERE BUILD_APP_ID = :build_app_id and TYPE_APP = :type_app";
            $cias_up_sql = $dbh->prepare($sql);
            $cias_up_sql->bindParam(":manufacturer", $manufacturer);
            $cias_up_sql->bindParam(":updated", $updated);
            $cias_up_sql->bindParam(":sizecias", $sizcias);
            $cias_up_sql->bindParam(":description", $desc_pc);
            $cias_up_sql->bindParam(":certid", $certid);
            $cias_up_sql->bindParam(":certnum", $certnum);
            $cias_up_sql->bindParam(":type_app", $typeapp);
            $cias_up_sql->bindParam(":build_app_id", $build_app_id);
            $cias_up_sql->execute();
            if ($cias_up_sql->rowCount() > 0) {
                echo "Saved";
            } else {
                echo "Error!!";
            }
        }
        if ($_POST["updbuild"][5] == "dtc") {
            $manufacturer = $_POST["updbuild"][0];
            $approved_mixing_valve = $_POST["updbuild"][1];
            $updated = date("H:i:s d-m-Y", strtotime("now"));
            $desc_pc = $_POST["updbuild"][2];
            $unique_id = $_POST["updbuild"][3];
            $certnum = $_POST["updbuild"][4];
            $certid = $_POST["updbuild"][6];
            $expiry_date = $_POST["updbuild"][7];
            $build_app_id = $_POST["updbuild"][8];
            $typeapp = "dtc";
            if ($manufacturer == "" || $certid == "" || $certnum == "") {
                echo '<i class="fa fa-times-circle" aria-hidden="true"></i> Values not properly entered';
                exit();
            }
            $sql = "update BUILDCERT_APPROVALS set
							MANUFACTURER = :manufacturer,
                                                        APPROVED_MIXING_VALVE = :approved_mixing_valve,
                                                        DESCRIPTION_PRODCERT = :description_prodcert,
                                                        UNIQUE_ID = :unique_id,
                                                        CERTIFICATE_NUMBER  = :certificate_number ,
                                                        CERT_ID = :cert_id,
                                                        EXPIRY_DATE = :expiry_date,
                                                        UPDATED = :updated
							WHERE BUILD_APP_ID = :build_app_id and TYPE_APP = :type_app";
            $cias_up_sql = $dbh->prepare($sql);
            $cias_up_sql->bindParam(":manufacturer", $manufacturer);
            $cias_up_sql->bindParam(":approved_mixing_valve", $approved_mixing_valve);
            $cias_up_sql->bindParam(":description_prodcert",$desc_pc);
            $cias_up_sql->bindParam(":unique_id",$unique_id);
            $cias_up_sql->bindParam(":certificate_number",$certnum);
            $cias_up_sql->bindParam(":cert_id",$certid);
            $cias_up_sql->bindParam(":expiry_date",$expiry_date);
            $cias_up_sql->bindParam(":updated",$updated);
            $cias_up_sql->bindParam(":type_app", $typeapp);
            $cias_up_sql->bindParam(":build_app_id", $build_app_id);
            $cias_up_sql->execute();
            if ($cias_up_sql->rowCount() > 0) {
                echo "Saved";
            } else {
                echo "Error!!";
            }
        }
        if ($_POST["updbuild"][5] == "pdcert") {

            $manufacturer = $_POST["updbuild"][0];
            $updated = date("H:i:s d-m-Y", strtotime("now"));
            $prodspecification = $_POST["updbuild"][1];
            $desc_pc = $_POST["updbuild"][2];
            $certid = $_POST["updbuild"][4];
            $certnum = $_POST["updbuild"][3];
            $expiry_d = $_POST["updbuild"][6];
            $build_app_id = $_POST["updbuild"][7];
            $type_app = "pdcert";
            if ($manufacturer == "" || $certid == "" || $certnum == "") {
                echo '<i class="fa fa-times-circle" aria-hidden="true"></i> Values not properly entered';
                exit();
            }
            $sql = "update BUILDCERT_APPROVALS set
							MANUFACTURER = :manufacturer,
							UPDATED = :updated,
							PERFORMANCE_STANDARD = :prodspecification,
							DESCRIPTION_PRODCERT = :desc_pc,
							CERT_ID = :certid,
							CERTIFICATE_NUMBER = :certnum,
							EXPIRY_DATE = :expiry_d
							WHERE BUILD_APP_ID = :build_app_id and TYPE_APP = :type_app";
            $pdcert_up_sql = $dbh->prepare($sql);
            $pdcert_up_sql->bindParam(":manufacturer", $manufacturer);
            $pdcert_up_sql->bindParam(":updated", $updated);
            $pdcert_up_sql->bindParam(":prodspecification", $prodspecification);
            $pdcert_up_sql->bindParam(":desc_pc", $desc_pc);
            $pdcert_up_sql->bindParam(":certid", $certid);
            $pdcert_up_sql->bindParam(":certnum", $certnum);
            $pdcert_up_sql->bindParam(":expiry_d", $expiry_d);
            $pdcert_up_sql->bindParam(":type_app", $type_app);
             $pdcert_up_sql->bindParam(":build_app_id", $build_app_id);
            $pdcert_up_sql->execute();
            if ($pdcert_up_sql->rowCount() > 0) {
                echo "Saved";
            } else {
                echo "Error!!";
            }
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
?><?php

//Insert Data into BUILDCERT_APPROVALS
if (isset($_POST["insbuildcert"][0]) && isset($_POST["insbuildcert"][1]) && isset($_POST["insbuildcert"][2]) && isset($_POST["insbuildcert"][3])) {

    try {
        $stmt_fetch = $dbh->query("select max(row_count) from BUILDCERT_APPROVALS");
        $rowcount = $stmt_fetch->fetchColumn();
        if ($_POST["insbuildcert"][3] == "cias") {
            $licensee = 'no value';
            $manufacturer = $_POST["insbuildcert"][0];
            $typeapp = $_POST["insbuildcert"][3];
            $uniqueid = 'no value';
            $certnum = $_POST["insbuildcert"][4];
            $certdate = '0';
            $hp1111 = '';
            $hpb = '';
            $hpb_c = '';
            $hps = '';
            $hps_c = '';
            $hpw = '';
            $hpw_c = '';
            $hpt = '';
            $hpt_c = '';
            $colhp = '';
            $lp1287 = '';
            $lpb = '';
            $lpb_c = '';
            $lps = '';
            $lps_c = '';
            $lpw = '';
            $lpw_c = '';
            $lpt = '';
            $lpt_c = '';
            $lptx = '';
            $lptx_c = '';
            $collp = '';
            $comments = '';
            $ex_comments = '';
            $pts_comments = '';
            $primeryorsec = '';
            $firstaud = '';
            $firstcomm = '';
            $secaud = '';
            $seccom = '';
            $discon = '';
            $rfw = '';
            $new = '';
            $expdate = '';
            $aproovedvalve = 'no value';
            $certlet = 'BC';
            $certid = $_POST["insbuildcert"][6];
            $hpbsw = " ";
            $hpbsw_c = " ";
            $updated = " ";
            $time_stamp = date("H:i:s d-m-Y", strtotime("now"));
            $rowcount = $rowcount;
            $fac = " ";
            $hpt44 = " ";
            $hpt44_c = " ";
            $hpt46 = " ";
            $hpt46_c = " ";
            $hpd44 = " ";
            $hpd44_c = " ";
            $hpd46 = " ";
            $hpd46_c = " ";
            $lpt44 = " ";
            $lpt44_c = " ";
            $lpt46 = " ";
            $lpt46_c = " ";
            $lpd44 = " ";
            $lpd44_c = " ";
            $lpd46 = " ";
            $lpd46_c = " ";
            $sizcias = $_POST["insbuildcert"][2];
            $perfor_std = " ";
            $desc_pc = $_POST["insbuildcert"][1];
            if ($manufacturer == "" || $licensee == "" || $aproovedvalve == "" || $uniqueid == "" || $certid == "" || $certnum == "" || $certdate == "") {
                echo '<i class="fa fa-times-circle" aria-hidden="true"></i> Values not properly entered';
                exit();
            }
        }
         if ($_POST["insbuildcert"][3] == "dtc") {
            $licensee = 'no value';
            $manufacturer = $_POST["insbuildcert"][0];
            $typeapp = $_POST["insbuildcert"][3];
            $uniqueid = $_POST["insbuildcert"][4];
            $certnum = $_POST["insbuildcert"][5];
            $certdate = '0';
            $hp1111 = '';
            $hpb = '';
            $hpb_c = '';
            $hps = '';
            $hps_c = '';
            $hpw = '';
            $hpw_c = '';
            $hpt = '';
            $hpt_c = '';
            $colhp = '';
            $lp1287 = '';
            $lpb = '';
            $lpb_c = '';
            $lps = '';
            $lps_c = '';
            $lpw = '';
            $lpw_c = '';
            $lpt = '';
            $lpt_c = '';
            $lptx = '';
            $lptx_c = '';
            $collp = '';
            $comments = '';
            $ex_comments = '';
            $pts_comments = '';
            $primeryorsec = '';
            $firstaud = '';
            $firstcomm = '';
            $secaud = '';
            $seccom = '';
            $discon = '';
            $rfw = '';
            $new = '';
            $expdate = $_POST["insbuildcert"][7];
            $aproovedvalve = $_POST["insbuildcert"][1];
            $certlet = 'BC';
            $certid = $_POST["insbuildcert"][6];
            $hpbsw = " ";
            $hpbsw_c = " ";
            $updated = " ";
            $time_stamp = date("H:i:s d-m-Y", strtotime("now"));
            $rowcount = $rowcount;
            $fac = " ";
            $hpt44 = " ";
            $hpt44_c = " ";
            $hpt46 = " ";
            $hpt46_c = " ";
            $hpd44 = " ";
            $hpd44_c = " ";
            $hpd46 = " ";
            $hpd46_c = " ";
            $lpt44 = " ";
            $lpt44_c = " ";
            $lpt46 = " ";
            $lpt46_c = " ";
            $lpd44 = " ";
            $lpd44_c = " ";
            $lpd46 = " ";
            $lpd46_c = " ";
            $sizcias = "";
            $perfor_std = " ";
            $desc_pc = $_POST["insbuildcert"][2];
            if ($manufacturer == "" || $licensee == "" || $aproovedvalve == "" || $uniqueid == "" || $certid == "" || $certnum == "" || $certdate == "") {
                echo '<i class="fa fa-times-circle" aria-hidden="true"></i> Values not properly entered';
                exit();
            }
        }
        if ($_POST["insbuildcert"][3] == "pdcert") {
           
            $licensee = 'no value';
            $manufacturer = $_POST["insbuildcert"][0];
            $typeapp = "pdcert";
            $uniqueid = 'no value';
            $certnum = $_POST["insbuildcert"][4];
            $certdate = '0';
            $hp1111 = '';
            $hpb = '';
            $hpb_c = '';
            $hps = '';
            $hps_c = '';
            $hpw = '';
            $hpw_c = '';
            $hpt = '';
            $hpt_c = '';
            $colhp = '';
            $lp1287 = '';
            $lpb = '';
            $lpb_c = '';
            $lps = '';
            $lps_c = '';
            $lpw = '';
            $lpw_c = '';
            $lpt = '';
            $lpt_c = '';
            $lptx = '';
            $lptx_c = '';
            $collp = '';
            $comments = '';
            $ex_comments = '';
            $pts_comments = '';
            $primeryorsec = '';
            $firstaud = '';
            $firstcomm = '';
            $secaud = '';
            $seccom = '';
            $discon = '';
            $rfw = '';
            $new = '';
            $expdate = $_POST["insbuildcert"][5];
            $aproovedvalve = 'no value';
            $certlet = 'BC';
            $certid = $_POST["insbuildcert"][7];
            $hpbsw = " ";
            $hpbsw_c = " ";
            $updated = " ";
            $time_stamp = date("H:i:s d-m-Y", strtotime("now"));
            $rowcount = $rowcount;
            $fac = " ";
            $hpt44 = " ";
            $hpt44_c = " ";
            $hpt46 = " ";
            $hpt46_c = " ";
            $hpd44 = " ";
            $hpd44_c = " ";
            $hpd46 = " ";
            $hpd46_c = " ";
            $lpt44 = " ";
            $lpt44_c = " ";
            $lpt46 = " ";
            $lpt46_c = " ";
            $lpd44 = " ";
            $lpd44_c = " ";
            $lpd46 = " ";
            $lpd46_c = " ";
            $sizcias = " ";
            $perfor_std = $_POST["insbuildcert"][1];
            $desc_pc = $_POST["insbuildcert"][2];
            if ($manufacturer == "" || $licensee == "" || $aproovedvalve == "" || $uniqueid == "" || $certid == "" || $certnum == "" || $certdate == "") {
                echo '<i class="fa fa-times-circle" aria-hidden="true"></i> Values not properly entered';
                exit();
            }
        }
        if ($_POST["insbuildcert"][3] == "tmv2") {


            $licensee = $_POST["insbuildcert"][1];
            $manufacturer = $_POST["insbuildcert"][2];
            $typeapp = $_POST["insbuildcert"][3];
            $uniqueid = $_POST["insbuildcert"][4];
            $certnum = $_POST["insbuildcert"][5];
            $certdate = $_POST["insbuildcert"][6];
            $hp1111 = $_POST["insbuildcert"][7];
            $hpb = $_POST["insbuildcert"][8];
            $hpb_c = $_POST["insbuildcert"][9];
            $hps = $_POST["insbuildcert"][10];
            $hps_c = $_POST["insbuildcert"][11];
            $hpw = $_POST["insbuildcert"][12];
            $hpw_c = $_POST["insbuildcert"][13];
            $hpt = $_POST["insbuildcert"][14];
            $hpt_c = $_POST["insbuildcert"][15];
            $colhp = $_POST["insbuildcert"][16];
            $lp1287 = $_POST["insbuildcert"][17];
            $lpb = $_POST["insbuildcert"][18];
            $lpb_c = $_POST["insbuildcert"][19];
            $lps = $_POST["insbuildcert"][20];
            $lps_c = $_POST["insbuildcert"][21];
            $lpw = $_POST["insbuildcert"][22];
            $lpw_c = $_POST["insbuildcert"][23];
            $lpt = $_POST["insbuildcert"][24];
            $lpt_c = $_POST["insbuildcert"][25];
            $lptx = $_POST["insbuildcert"][26];
            $lptx_c = $_POST["insbuildcert"][27];
            $collp = $_POST["insbuildcert"][28];
            $comments = $_POST["insbuildcert"][29];
            $ex_comments = $_POST["insbuildcert"][30];
            $pts_comments = $_POST["insbuildcert"][31];
            $primeryorsec = $_POST["insbuildcert"][32];
            $firstaud = $_POST["insbuildcert"][33];
            $firstcomm = $_POST["insbuildcert"][34];
            $secaud = $_POST["insbuildcert"][35];
            $seccom = $_POST["insbuildcert"][36];
            $discon = $_POST["insbuildcert"][37];
            $rfw = $_POST["insbuildcert"][38];
            $new = $_POST["insbuildcert"][39];
            $expdate = $_POST["insbuildcert"][40];
            $aproovedvalve = $_POST["insbuildcert"][41];
            $certlet = $_POST["insbuildcert"][42];
            $certid = "BC ".$_POST["insbuildcert"][5].' '.$_POST["insbuildcert"][6];
            $hpbsw = " ";
            $hpbsw_c = " ";
            $updated = " ";
            $time_stamp = date("H:i:s d-m-Y", strtotime("now"));
            $rowcount = $rowcount;
            $fac = " ";
            $hpt44 = " ";
            $hpt44_c = " ";
            $hpt46 = " ";
            $hpt46_c = " ";
            $hpd44 = " ";
            $hpd44_c = " ";
            $hpd46 = " ";
            $hpd46_c = " ";
            $lpt44 = " ";
            $lpt44_c = " ";
            $lpt46 = " ";
            $lpt46_c = " ";
            $lpd44 = " ";
            $lpd44_c = " ";
            $lpd46 = " ";
            $lpd46_c = " ";
            $sizcias = " ";
            $perfor_std = " ";
            $desc_pc = " ";
        }
        if ($_POST['insbuildcert'][3] == 'tmv3') {

            $licensee = "no value";
            $manufacturer = $_POST['insbuildcert'][2];
            $typeapp = "tmv3";
            $uniqueid = $_POST['insbuildcert'][5];
            $certnum = $_POST['insbuildcert'][6];
            $certdate = $_POST['insbuildcert'][7];
            $hp1111 = "";
            $hpb = $_POST['insbuildcert'][8];
            $hpb_c = $_POST['insbuildcert'][9];
            $hps = $_POST['insbuildcert'][10];
            $hps_c = $_POST['insbuildcert'][11];
            $hpw = $_POST['insbuildcert'][12];
            $hpw_c = $_POST['insbuildcert'][13];
            $hpt = "";
            $hpt_c = "";
            $colhp = "";
            $lp1287 = "";
            $lpb = $_POST['insbuildcert'][22];
            $lpb_c = $_POST['insbuildcert'][23];
            $lps = $_POST['insbuildcert'][24];
            $lps_c = $_POST['insbuildcert'][25];
            $lpw = $_POST['insbuildcert'][26];
            $lpw_c = $_POST['insbuildcert'][27];
            $lpt = "";
            $lpt_c = "";
            $lptx = "";
            $lptx_c = "";
            $collp = "";
            $comments = $_POST['insbuildcert'][36];
            $ex_comments = $_POST['insbuildcert'][37];
            $pts_comments = $_POST['insbuildcert'][38];
            $primeryorsec = $_POST['insbuildcert'][39];
            $firstaud = $_POST['insbuildcert'][40];
            $firstcomm = $_POST['insbuildcert'][41];
            $secaud = $_POST['insbuildcert'][42];
            $seccom = $_POST['insbuildcert'][43];
            $discon = $_POST['insbuildcert'][44];
            $rfw = $_POST['insbuildcert'][45];
            $new = $_POST['insbuildcert'][46];
            $expdate = $_POST['insbuildcert'][47];
            $aproovedvalve = $_POST['insbuildcert'][4];
            $certlet = "BC";
            $certid = "BC ".$_POST['insbuildcert'][6].' '.$_POST['insbuildcert'][7];
            $hpbsw = " ";
            $hpbsw_c = " ";
            $updated = " ";
            $time_stamp = date("H:i:s d-m-Y", strtotime("now"));
            $rowcount = $rowcount;
            $fac = $_POST['insbuildcert'][1];
            $hpt44 = $_POST['insbuildcert'][14];
            $hpt44_c = $_POST['insbuildcert'][15];
            $hpt46 = $_POST['insbuildcert'][16];
            $hpt46_c = $_POST['insbuildcert'][17];
            $hpd44 = $_POST['insbuildcert'][18];
            $hpd44_c = $_POST['insbuildcert'][19];
            $hpd46 = $_POST['insbuildcert'][20];
            $hpd46_c = $_POST['insbuildcert'][21];
            $lpt44 = $_POST['insbuildcert'][28];
            $lpt44_c = $_POST['insbuildcert'][29];
            $lpt46 = $_POST['insbuildcert'][30];
            $lpt46_c = $_POST['insbuildcert'][31];
            $lpd44 = $_POST['insbuildcert'][32];
            $lpd44_c = $_POST['insbuildcert'][33];
            $lpd46 = $_POST['insbuildcert'][34];
            $lpd46_c = $_POST['insbuildcert'][35];
            $sizcias = " ";
            $perfor_std = " ";
            $desc_pc = " ";
        }
        if ($manufacturer == "" || $licensee == "" || $aproovedvalve == "" || $uniqueid == "" || $certid == "" || $certlet == "" || $certnum == "" || $certdate == "") {
            echo '<i class="fa fa-times-circle" aria-hidden="true"></i> Values not properly entered';
            exit();
        }
        $sql_in_tmv2 = "insert into BUILDCERT_APPROVALS
					(BUILD_APP_ID,MANUFACTURER,LICENSEE,APPROVED_MIXING_VALVE,UNIQUE_ID,CERTIFICATE_LETTERS,CERT_ID,CERTIFICATE_NUMBER,CERTIFICATE_DATE,HP_1111,HPBSW,HPBSW_COMMENT,HPB,HPB_COMMENT,  
                    HPS,HPS_COMMENT,HPW,HPW_COMMENT,HPT,HPT_COMMENT,LP_1287,LPB,LPB_COMMENT,LPS,LPS_COMMENT,LPW,LPW_COMMENT,LPT,LPT_COMMENT,LPTX,LPTX_COMMENT,COMMENTS,EXTENDED_COMMENTS,PTS_COMMENTS,
                    PRIMARY_OR_SECONDARY,FIRST_AUDIT,FIRST_COMPLETED,SECOND_AUDIT,SECOND_COMPLETED,DISCONTINUED_WITHDRAWN,REMOVE_FROM_WEBSITE,NEW,COLD_ISOL_46_LP,COLD_ISOL_46_HP,EXPIRY_DATE,UPDATED,
                    TIMESTAMP,ROW_COUNT,FACTOR,HPT44,HPT44_COMMENT,HPT46,HPT46_COMMENT,HPD44,HPD44_COMMENT,HPD46,HPD46_COMMENT,LPT44,LPT44_COMMENT,LPT46,LPT46_COMMENT,LPD44,LPD44_COMMENT,LPD46,LPD46_COMMENT,
                    SIZES_CIAS,PERFORMANCE_STANDARD,DESCRIPTION_PRODCERT,TYPE_APP)
		            values(WRC.RIG_VAL_SEQ.NEXTVAL, :manufacturer, :licensee,	 :aproovedvalve, :uniqueid,	 :certlet,:certid,:certnum,:certdate,:hp1111, :hpbsw, :hpbsw_c,	 :hpb,
					 :hpb_c, :hps, :hps_c,	 :hpw,	 :hpw_c, :hpt,	 :hpt_c, :lp1287, :lpb,	 :lpb_c, :lps, :lps_c,
					 :lpw, :lpw_c, :lpt, :lpt_c, :lptx, :lptx_c, :comments, :ex_comments, :pts_comments, :primeryorsec,
					 :firstaud, :firstcomm, :secaud, :seccom, :discon, :rfw, :new, :collp, :colhp, :expdate, :updated,
					 :time_stamp,:rowcount,	 :fac,	 :hpt44, :hpt44_c, :hpt46, :hpt46_c, :hpd44, :hpd44_c, :hpd46, :hpd46_c,
					 :lpt44, :lpt44_c, :lpt46, :lpt46_c, :lpd44, :lpd44_c, :lpd46, :lpd46_c, :sizcias, :perfor_std,
					 :desc_pc,:type_app	)";

        $query_in_tmv2 = $dbh->prepare($sql_in_tmv2);

        $query_in_tmv2->bindParam(":manufacturer", $manufacturer);
        $query_in_tmv2->bindParam(":licensee", $licensee);
        $query_in_tmv2->bindParam(":aproovedvalve", $aproovedvalve);
        $query_in_tmv2->bindParam(":uniqueid", $uniqueid);
        $query_in_tmv2->bindParam(":certlet", $certlet);
        $query_in_tmv2->bindParam(":certid", $certid);
        $query_in_tmv2->bindParam(":certnum", $certnum);
        $query_in_tmv2->bindParam(":certdate", $certdate);
        $query_in_tmv2->bindParam(":hp1111", $hp1111);
        $query_in_tmv2->bindParam(":hpbsw", $hpbsw);
        $query_in_tmv2->bindParam(":hpbsw_c", $hpbsw_c);
        $query_in_tmv2->bindParam(":hpb", $hpb);
        $query_in_tmv2->bindParam(":hpb_c", $hpb_c);
        $query_in_tmv2->bindParam(":hps", $hps);
        $query_in_tmv2->bindParam(":hps_c", $hps_c);
        $query_in_tmv2->bindParam(":hpw", $hpw);
        $query_in_tmv2->bindParam(":hpw_c", $hpw_c);
        $query_in_tmv2->bindParam(":hpt", $hpt);
        $query_in_tmv2->bindParam(":hpt_c", $hpt_c);
        $query_in_tmv2->bindParam(":lp1287", $lp1287);
        $query_in_tmv2->bindParam(":lpb", $lpb);
        $query_in_tmv2->bindParam(":lpb_c", $lpb_c);
        $query_in_tmv2->bindParam(":lps", $lps);
        $query_in_tmv2->bindParam(":lps_c", $lps_c);
        $query_in_tmv2->bindParam(":lpw", $lpw);
        $query_in_tmv2->bindParam(":lpw_c", $lpw);
        $query_in_tmv2->bindParam(":lpt", $lpt);
        $query_in_tmv2->bindParam(":lpt_c", $lpt_c);
        $query_in_tmv2->bindParam(":lptx", $lptx);
        $query_in_tmv2->bindParam(":lptx_c", $lptx_c);
        $query_in_tmv2->bindParam(":comments", $comments);
        $query_in_tmv2->bindParam(":ex_comments", $ex_comments);
        $query_in_tmv2->bindParam(":pts_comments", $pts_comments);
        $query_in_tmv2->bindParam(":primeryorsec", $primeryorsec);
        $query_in_tmv2->bindParam(":firstaud", $firstaud);
        $query_in_tmv2->bindParam(":secaud", $secaud);
        $query_in_tmv2->bindParam(":seccom", $seccom);
        $query_in_tmv2->bindParam(":firstcomm", $firstcomm);
        $query_in_tmv2->bindParam(":discon", $discon);
        $query_in_tmv2->bindParam(":rfw", $rfw);
        $query_in_tmv2->bindParam(":new", $new);
        $query_in_tmv2->bindParam(":collp", $collp);
        $query_in_tmv2->bindParam(":colhp", $colhp);
        $query_in_tmv2->bindParam(":expdate", $expdate);
        $query_in_tmv2->bindParam(":updated", $updated);
        $query_in_tmv2->bindParam(":time_stamp", $time_stamp);
        $query_in_tmv2->bindParam(":rowcount", $rowcount);
        $query_in_tmv2->bindParam(":fac", $fac);
        $query_in_tmv2->bindParam(":hpt44", $hpt44);
        $query_in_tmv2->bindParam(":hpt44_c", $hpt44_c);
        $query_in_tmv2->bindParam(":hpt46", $hpt46);
        $query_in_tmv2->bindParam(":hpt46_c", $hpt46_c);
        $query_in_tmv2->bindParam(":hpd44", $hpd44);
        $query_in_tmv2->bindParam(":hpd44_c", $hpd44_c);
        $query_in_tmv2->bindParam(":hpd46", $hpd46);
        $query_in_tmv2->bindParam(":hpd46_c", $hpd46_c);
        $query_in_tmv2->bindParam(":lpt44", $lpt44);
        $query_in_tmv2->bindParam(":lpt44_c", $lpt44_c);
        $query_in_tmv2->bindParam(":lpt46", $lpt46);
        $query_in_tmv2->bindParam(":lpt46_c", $lpt46_c);
        $query_in_tmv2->bindParam(":lpd44", $lpd44);
        $query_in_tmv2->bindParam(":lpd44_c", $lpd44_c);
        $query_in_tmv2->bindParam(":lpd46", $lpd46);
        $query_in_tmv2->bindParam(":lpd46_c", $lpd46_c);
        $query_in_tmv2->bindParam(":sizcias", $sizcias);
        $query_in_tmv2->bindParam(":perfor_std", $perfor_std);
        $query_in_tmv2->bindParam(":desc_pc", $desc_pc);
        $query_in_tmv2->bindParam(":type_app", $typeapp);
        if (!$query_in_tmv2) {
            echo "\nPDO::errorInfo():\n";
            print_r($dbh->errorInfo());
        }
        if (!$query_in_tmv2->execute()) {
            //print_r("<script>alert(\"".$dbh->errorInfo()."\");</script>");
            echo '<i class="fa fa-times-circle" aria-hidden="true"></i> ';
            print_r($dbh->errorInfo());
            //echo print_r().""; 
        }
        if ($query_in_tmv2->rowCount() > 0) {
            echo '<i class="fa fa-check-circle" aria-hidden="true"></i> Ok';
        } else {
            echo '<i class="fa fa-times-circle" aria-hidden="true"></i> No';
        }
    } catch (Exception $ex) {
        echo '<i class="fa fa-times-circle" aria-hidden="true"></i> ';
        echo $ex->getMessage();
    }
}
?><?php

//Get data from BUILDCERT_APPROVALS
if (isset($_POST["tmv2data"][0]) && isset($_POST["tmv2data"][1]) && isset($_POST["tmv2data"][2]) && isset($_POST["tmv2data"][3])) {

    $certnum = $_POST["tmv2data"][0];

    $sql_get_tmv2 = "SELECT * FROM BUILDCERT_APPROVALS WHERE BUILD_APP_ID = :certnum AND TYPE_APP = 'tmv2'";
    //$sql_get_tmv2 = "select * from tmv2 where CERTIFICATE_NUMBER = :certnum and CERT_ID = :certid and CERTIFICATE_DATE = :certdate and TYPE_APP = :scheme";
    //echo $sql_get_tmv22;
    //$sql_get_tmv22 = "select * from tmv2 where CERTIFICATE_NUMBER = :certnum and CERT_ID = :certid and CERTIFICATE_DATE = :certdate ";
    $quer_get_tmv2 = $dbh->prepare($sql_get_tmv2);
    $quer_get_tmv2->bindParam(":certnum", $certnum);
    $quer_get_tmv2->execute();
    $res_get_tmv2 = $quer_get_tmv2->fetch(PDO::FETCH_ASSOC);
    if ($_POST["tmv2data"][3] == "get") {
        if(strpos($res_get_tmv2["EXTENDED_COMMENTS"],'@') > 0){
            $exp = explode('@', $res_get_tmv2["EXTENDED_COMMENTS"]);
            $extended_comments = $exp[0];
        }
        else {
             $extended_comments = $res_get_tmv2["EXTENDED_COMMENTS"];
        }
        $str_get_tmv2 = '<table class="table table-bordered"><tbody>
	<tr>
	<td><b>Licensee</b></td><td><input name="Licensee" id="licensee" type="text" class="textbox" value="' . $res_get_tmv2["LICENSEE"] . '"	size="30"></td>	
	<td><b>Manufacturer</b></td><td><input name="Manufacturer" id="Manufacturer" type="text" class="textbox" value="' . $res_get_tmv2["MANUFACTURER"] . '" size="30"></td></tr><tr>
	<td><b>Mixing Valve</b></td><td><input name="Approved_Mixing_Valve" id="Approved_Mixing_Valve" type="text" class="textbox"	value="'.(($res_get_tmv2["APPROVED_MIXING_VALVE"] != NULL) ? stream_get_contents($res_get_tmv2["APPROVED_MIXING_VALVE"]) : '').'" size="30"></td>
	<td><b>Unique Valve ID</b></td><td><input name="Unique_ID" id="Unique_ID" type="text" class="textbox"	value="'.(($res_get_tmv2["UNIQUE_ID"] != NULL) ? stream_get_contents($res_get_tmv2["UNIQUE_ID"]) : '').'" size="30"></td>
	</tr><tr>
	<td><b>Certificate Numbers</b></td>	<td>' . $res_get_tmv2["CERTIFICATE_NUMBER"] . '</td><td></td><td></td></tr><tr>
	<td><b>Comments</b></td><td><input name="Comments" id="Comments" type="text" class="textbox" value="' . $res_get_tmv2["COMMENTS"] . '"	size="30"></td>
	<td><b>HP_1111</b></td><td><input name="HP_1111" id="HP_1111" type="checkbox" value="1" '.(($res_get_tmv2["HP_1111"] == '1' ) ? 'checked="yes"' : ' ').'></td>
	</tr><tr>
	<td><b>Extended Comments</b></td><td><input name="Extended_Comments" id="Extended_Comments" type="text" class="textbox" value="' .$extended_comments. '" size="30"></td>
	<td><b>B</b> <input name="HPB" id="HPB" type="checkbox" value="1" '.(($res_get_tmv2["HPB"] == '1' ) ? 'checked="yes"' : ' ').'></td>
	<td><b>Economy</b> <input name="HPB_comment" id="HPB_comment" type="text" class="textbox" value="' . $res_get_tmv2["HPB_COMMENT"] . '" size="1"></td>
	</tr><tr>
	<td><b>Pts Comments</b></td><td><input name="Pts_Comments" id="Pts_Comments" type="text" class="textbox" value="' . $res_get_tmv2["PTS_COMMENTS"] . '" size="30"></td>
	<td><b>S</b> <input name="HPS" id="HPS" type="checkbox" value="1" '.(($res_get_tmv2["HPS"] == '1' ) ? 'checked="yes"' : ' ').'></td>
	<td><b>Economy</b> <input name="HPS_comment" id="HPS_comment" type="text" class="textbox" value="' . $res_get_tmv2["HPS_COMMENT"] . '" size="1"></td>
	</tr><tr>
	<td><b>Primary_or_Secondary</b></td><td><input name="Primary_or_Secondary" id="Primary_or_Secondary" type="text" class="textbox" value="' . $res_get_tmv2["PRIMARY_OR_SECONDARY"] . '"	size="30"></td>
	<td><b>W</b> <input name="HPW" id="HPW" type="checkbox" value="1" '.(($res_get_tmv2["HPW"] == '1' ) ? 'checked="yes"' : ' ').'></td>
	<td><b>Economy</b> <input name="HPW_comment" id="HPW_comment" type="text" class="textbox" value="' . $res_get_tmv2["HPW_COMMENT"] . '" size="1"></td>
	</tr><tr>
	<td><b>First_Audit</b></td><td><input name="First_Audit" id="First_Audit" type="text" class="textbox" value="' . $res_get_tmv2["FIRST_AUDIT"] . '" size="30"></td>
	<td><b>T</b> <input name="HPT" id="HPT" type="checkbox" value="1" '.(($res_get_tmv2["HPT"] == '1' ) ? 'checked="yes"' : ' ').' ></td>
	<td><b>Economy</b> <input name="HPT_comment" id="HPT_comment" type="text" class="textbox" value="' . $res_get_tmv2["HPT_COMMENT"] . '" size="1"></td>
	</tr><tr>
	<td><b>Cold Isol 46</b></td><td><input name="Cold_isol_46_hp" id="Cold_isol_46_hp" type="checkbox" value="1" '.(($res_get_tmv2["COLD_ISOL_46_HP"] == '1' ) ? 'checked="yes"' : '').'></td>
	<td><b>LP_1287</b></td><td><input name="LP_1287" id="LP_1287" type="checkbox" value="1" '.(($res_get_tmv2["LP_1287"] == '1' ) ? 'checked="yes"' : ' ').' ></td></tr><tr>
	<td><b>First_Completed</b></td><td><input name="First_Completed" id="First_Completed" type="text" class="textbox" value="' . $res_get_tmv2["FIRST_COMPLETED"] . '" size="30"></td>
	<td><b>B</b> <input name="LPB" id="LPB" type="checkbox" value="1" '.(($res_get_tmv2["LPB"] == '1' ) ? 'checked="yes"' : ' ').' ></td>
	<td><b>Economy</b> <input name="LPB_comment" id="LPB_comment" type="text" class="textbox" value="' . $res_get_tmv2["LPB_COMMENT"] . '" size="1"></td>
	</tr><tr>
	<td><b>Second_Audit</b></td><td><input name="Second_Audit" id="Second_Audit" type="text" class="textbox" value="' . $res_get_tmv2["SECOND_AUDIT"] . '" size="30"></td>
	<td><b>S</b> <input name="LPS" id="LPS" type="checkbox" value="1" '.(($res_get_tmv2["LPS"] == '1' ) ? 'checked="yes"' : ' ').'></td>
	<td><b>Economy</b> <input name="LPS_comment" id="LPS_comment" type="text" class="textbox" value="' . $res_get_tmv2["LPS_COMMENT"] . '" size="1"></td>
	</tr><tr>
	<td><b>Second_Completed</b></td><td><input name="Second_Completed" id="Second_Completed" type="text" class="textbox" value="' . $res_get_tmv2["SECOND_COMPLETED"] . '" size="30"></td>
	<td><b>W</b> <input name="LPW" id="LPW" type="checkbox" value="1" '.(($res_get_tmv2["LPW"] == '1' ) ? 'checked="yes"' : ' ').'></td>
	<td><b>Economy</b> <input name="LPW_comment" id="LPW_comment" type="text" class="textbox" value="' . $res_get_tmv2["LPW_COMMENT"] . '" size="1"></td>
	</tr><tr>
	<td><b>Discontinued_Withdrawn</b></td><td><input name="Discontinued_Withdrawn" id="Discontinued_Withdrawn" type="checkbox" value="1" '.(($res_get_tmv2["DISCONTINUED_WITHDRAWN"] == '1' ) ? 'checked="yes"' : ' ').'></td>
	<td><b>T</b> <input name="LPT" id="LPT" type="checkbox" value="1" '.(($res_get_tmv2["LPT"] == '1' ) ? 'checked="yes"' : ' ').'></td>
	<td><b>Economy</b> <input name="LPT_comment" id="LPT_comment" type="text" class="textbox" value="' . $res_get_tmv2["LPT_COMMENT"] . '" size="1"></td>
	</tr><tr>
	<td><b>Remove_from_Website</b></td><td><input name="Remove_from_Website" id="Remove_from_Website" type="checkbox" value="1" '.(($res_get_tmv2["REMOVE_FROM_WEBSITE"] == '1' ) ? 'checked="yes"' : ' ').'></td>
	<td><b>T 0.2</b> <input name="LPTx" id="LPTx" type="checkbox" value="1" '.(($res_get_tmv2["LPTX"] == '1' ) ? 'checked="yes"' : ' ').'></td>
	<td><b>Economy</b> <input name="LPTx_comment" id="LPTx_comment" type="text" class="textbox" value="' . $res_get_tmv2["LPTX_COMMENT"] . '" size="1"></td>
	</tr><tr>
	<td><b>New</b></td><td><input name="New" id="New" type="checkbox" value="1" '.(($res_get_tmv2["NEW"] == '1' ) ? 'checked="yes"' : ' ').'></td>
	<td><b>Cold Isol 46</b></td><td><input name="Cold_isol_46_lp" id="Cold_isol_46_lp" type="checkbox" value="1" '.(($res_get_tmv2["COLD_ISOL_46_LP"] == '1' ) ? 'checked="yes"' : ' ').'></td></tr><tr>
	<td ><b>Expiry_Date</b></td><td><input name="Expiry_Date" id="Expiry_Date" type="text" class="textbox" value="' . $res_get_tmv2["EXPIRY_DATE"] . '" size="30"></td>
	<td style="text-align:right;"><input type="hidden" name="scheme" id="scheme" value="tmv2"><input type="hidden" name="update" id="update" value="' . date("H:i:s d-m-Y", strtotime("now")) . '"><input type="hidden" name="certnum" id="build_app_id" value="' . $certnum . '"></td><td></td>
	</tr>
        </tbody></table>';
        echo $str_get_tmv2;
    }
    if ($_POST["tmv2data"][3] == "show") {
        if(strpos($res_get_tmv2["EXTENDED_COMMENTS"],'@') > 0){
            $exp = explode('@', $res_get_tmv2["EXTENDED_COMMENTS"]);
            $extended_comments = $exp[0];
        }
        else {
             $extended_comments = $res_get_tmv2["EXTENDED_COMMENTS"];
        }
        $str_get_tmv2 = '<table class="table table-bordered"><tbody>
	
												<tr><td valign="top"><b>Licensee</b></td><td>' . $res_get_tmv2["LICENSEE"] . '</td>	</tr>
	
	
												<tr><td valign="top"><b>Manufacturer</b></td><td>' . $res_get_tmv2["MANUFACTURER"] . '</td></tr>
	
	
												<tr><td valign="top"><b>Mixing Valve</b></td><td>';

        $str_get_tmv2 .= ($res_get_tmv2["APPROVED_MIXING_VALVE"] != NULL) ? stream_get_contents($res_get_tmv2["APPROVED_MIXING_VALVE"]) : '';
        $str_get_tmv2 .= '</td></tr>
	
	
												<tr><td valign="top"><b>Unique Valve ID</b></td><td>';
        $str_get_tmv2 .= ($res_get_tmv2["UNIQUE_ID"] != NULL) ? stream_get_contents($res_get_tmv2["UNIQUE_ID"]) : '';
        $str_get_tmv2 .= '</td></tr>
				<tr><td><b>Certificate Numbers</b></td>	<td>' . $res_get_tmv2["CERTIFICATE_NUMBER"] . '</td></tr>
	
	
												<tr><td valign="top"><b>HP_1111</b></td><td>';
        $str_get_tmv2 .= ($res_get_tmv2["HP_1111"] == '1' ) ? '<i class="fa fa-check" aria-hidden="true"></i>' : ' ';
        $str_get_tmv2 .= '</td></tr>
	
												<tr><td valign="top"><b>B</b></td><td>';

        $str_get_tmv2 .= ($res_get_tmv2["HPB"] == '1' ) ? '<i class="fa fa-check" aria-hidden="true"></i>' . $res_get_tmv2["HPB_COMMENT"] . '' : ' ';
        $str_get_tmv2 .= '</td></tr>
	
												<tr><td valign="top"><b>S</b></td><td>';
        $str_get_tmv2 .= ($res_get_tmv2["HPS"] == '1' ) ? '<i class="fa fa-check" aria-hidden="true"></i>' . $res_get_tmv2["HPS_COMMENT"] . '' : ' ';
        $str_get_tmv2 .= '</td></tr>
	
												<tr><td valign="top"><b>W</b></td><td>';
        $str_get_tmv2 .= ($res_get_tmv2["HPW"] == '1' ) ? '<i class="fa fa-check" aria-hidden="true"></i>' . $res_get_tmv2["HPW_COMMENT"] . '' : ' ';
        $str_get_tmv2 .= '</td></tr>
	
												<tr><td valign="top"><b>T</b></td><td>';
        $str_get_tmv2 .= ($res_get_tmv2["HPT"] == '1' ) ? '<i class="fa fa-check" aria-hidden="true"></i>' . $res_get_tmv2["HPT_COMMENT"] . '' : ' ';
        $str_get_tmv2 .= '</td></tr>
	
												<tr><td valign="top"><b>Cold Isol 46</b></td><td> ';
        $str_get_tmv2 .= ($res_get_tmv2["COLD_ISOL_46_HP"] == '1' ) ? '<i class="fa fa-check" aria-hidden="true"></i>' : '';
        $str_get_tmv2 .= '</td></tr>
	
	
												<tr><td width="50"></td><td width="50"></td></tr>
	
	
												<tr><td valign="top"><b>LP_1287</b></td><td>';
        $str_get_tmv2 .= ($res_get_tmv2["LP_1287"] == '1' ) ? '<i class="fa fa-check" aria-hidden="true"></i>' : ' ';
        $str_get_tmv2 .= ' </td></tr>
	
												<tr><td valign="top"><b>B</b></td><td> ';
        $str_get_tmv2 .= ($res_get_tmv2["LPB"] == '1' ) ? '<i class="fa fa-check" aria-hidden="true"></i>' . $res_get_tmv2["LPB_COMMENT"] . '' : ' ';
        $str_get_tmv2 .= '</td></tr>
	
												<tr><td valign="top"><b>S</b></td><td> ';
        $str_get_tmv2 .= ($res_get_tmv2["LPS"] == '1' ) ? '<i class="fa fa-check" aria-hidden="true"></i>' . $res_get_tmv2["LPS_COMMENT"] . '' : ' ';
        $str_get_tmv2 .= '</td></tr>
	
												<tr><td valign="top"><b>W</b></td><td>';
        $str_get_tmv2 .= ($res_get_tmv2["LPW"] == '1' ) ? '<i class="fa fa-check" aria-hidden="true"></i>' . $res_get_tmv2["LPW_COMMENT"] . '' : ' ';
        $str_get_tmv2 .= '</td></tr>
	
												<tr><td valign="top"><b>T</b></td><td>';
        $str_get_tmv2 .= ($res_get_tmv2["LPT"] == '1' ) ? '<i class="fa fa-check" aria-hidden="true"></i>' . $res_get_tmv2["LPT_COMMENT"] . '' : ' ';
        $str_get_tmv2 .= '</td></tr>
	
												<tr><td valign="top"><b>T 0.2</b></td><td> ';
        $str_get_tmv2 .= ($res_get_tmv2["LPTX"] == '1' ) ? '<i class="fa fa-check" aria-hidden="true"></i>' . $res_get_tmv2["LPTX_COMMENT"] . '' : ' ';
        $str_get_tmv2 .= '</td></tr>
	
												<tr><td valign="top"><b>Cold Isol 46</b></td><td>';
        $str_get_tmv2 .= ($res_get_tmv2["COLD_ISOL_46_LP"] == '1' ) ? '<i class="fa fa-check" aria-hidden="true"></i>' : ' ';
        $str_get_tmv2 .= '</td></tr>
	
												<tr><td valign="top"><b>Comments</b></td><td>' . $res_get_tmv2["COMMENTS"] . '</td></tr>
	
	
												
	
	
						</tbody></table>';
        echo $str_get_tmv2;
    }
}
?><?php

//Show table to insert data
if (isset($_POST["tmv2show"][0]) && isset($_POST["tmv2show"][1]) && isset($_POST["tmv2show"][2])) {



    $str_get_tmv2 = '<table class="table table-bordered"><form ></form><tbody>
			<tr><td><b>Licensee</b></td><td> <input name="Licensee" id="licensee" type="text" class="textbox" value=""	size="30"></td><td><b>Manufacturer</b> </td><td><input name="Manufacturer" id="Manufacturer" type="text" class="textbox" value="" size="30"></td></tr>
			<tr><td><b>Mixing Valve</b></td><td><input name="Approved_Mixing_Valve" id="Approved_Mixing_Valve" type="text" class="textbox"	value="" size="30"></td> <td><b>Unique Valve ID</b></td><td> <input name="Unique_ID" id="Unique_ID" type="text" class="textbox"	value="" size="30"></td></tr>
			<tr><td><b>Certificate Numbers</b></td>	<td><input name="certnumber" id="certnumber" type="number" class="textbox" placeholder="certificate number" size="10"> </td><td>/</td><td> <input name="certdate" id="certdate" type="number" class="textbox" placeholder="certificate date" size="10"> </td></tr>
			<tr><td><b></b></td>	<td></td><td><b>HP_1111</b></td><td><input name="HP_1111" id="HP_1111" type="checkbox" value="1" ></td></tr>
			<tr><td><b>Comments</b></td><td><input name="Comments" id="Comments" type="text" class="textbox" value=""	size="30"></td><td><b>B</b> <input name="HPB" id="HPB" type="checkbox" value="1" ></td><td><b>Economy</b> <input name="HPB_comment" id="HPB_comment" type="text" class="textbox" value="" size="1"></td></tr>
			<tr><td><b>Extended Comments</b></td><td><input name="Extended_Comments" id="Extended_Comments" type="text" class="textbox" value="" size="30"></td><td><b>S</b> <input name="HPS" id="HPS" type="checkbox" value="1" ></td><td><b>Economy</b> <input name="HPS_comment" id="HPS_comment" type="text" class="textbox" value="" size="1"></td></tr>
			<tr><td><b>Pts Comments</b></td><td><input name="Pts_Comments" id="Pts_Comments" type="text" class="textbox" value="" size="30"></td><td><b>W</b> <input name="HPW" id="HPW" type="checkbox" value="1" ></td><td><b>Economy</b> <input name="HPW_comment" id="HPW_comment" type="text" class="textbox" value="" size="1"></td></tr><tr>
			<td><b>Primary_or_Secondary</b></td><td><input name="Primary_or_Secondary" id="Primary_or_Secondary" type="text" class="textbox" value=""	size="30"></td><td><b>T</b> <input name="HPT" id="HPT" type="checkbox" value="1"  ></td><td><b>Economy</b> <input name="HPT_comment" id="HPT_comment" type="text" class="textbox" value="" size="1"></td></tr>
			<tr><td><b>First_Audit</b></td><td><input name="First_Audit" id="First_Audit" type="text" class="textbox" value="" size="30"></td><td><b>Cold Isol 46</b> <input name="Cold_isol_46_hp" id="Cold_isol_46_hp" type="checkbox" value="1" ></td><td></td></tr>
												
			<tr><td><b>First_Completed</b></td><td><input name="First_Completed" id="First_Completed" type="text" class="textbox" value="" size="30"></td><td><b>LP_1287</b> <input name="LP_1287" id="LP_1287" type="checkbox" value="1" ></td><td></td></tr>
			<tr><td><b>Second_Audit</b></td><td><input name="Second_Audit" id="Second_Audit" type="text" class="textbox" value="" size="30"></td><td><b>B</b> <input name="LPB" id="LPB" type="checkbox" value="1" ></td><td><b>Economy</b> <input name="LPB_comment" id="LPB_comment" type="text" class="textbox" value="" size="1"></td></tr>
			<tr><td><b>Second_Completed</b></td><td><input name="Second_Completed" id="Second_Completed" type="text" class="textbox" value="" size="30"></td><td><b>S</b> <input name="LPS" id="LPS" type="checkbox" value="1"></td><td><b>Economy</b> <input name="LPS_comment" id="LPS_comment" type="text" class="textbox" value="" size="1"></td></tr>
			<tr><td><b>Discontinued_Withdrawn</b></td><td><input name="Discontinued_Withdrawn" id="Discontinued_Withdrawn" type="checkbox" value="1"></td><td><b>W</b> <input name="LPW" id="LPW" type="checkbox" value="1" ></td><td><b>Economy</b> <input name="LPW_comment" id="LPW_comment" type="text" class="textbox" value="" size="1"></td></tr>
			<tr><td><b>Remove_from_Website</b></td><td><input name="Remove_from_Website" id="Remove_from_Website" type="checkbox" value="1"></td><td><b>T</b> <input name="LPT" id="LPT" type="checkbox" value="1" ></td><td><b>Economy</b> <input name="LPT_comment" id="LPT_comment" type="text" class="textbox" value="" size="1"></td></tr>
			<tr><td><b>New</b></td><td><input name="New" id="New" type="checkbox" value="1" ></td><td><b>T 0.2</b> <input name="LPTx" id="LPTx" type="checkbox" value="1" ></td><td> <b>Economy</b> <input name="LPTx_comment" id="LPTx_comment" type="text" class="textbox" value="" size="1"></td></tr>
			<tr><td ><b>Expiry_Date</b></td><td><input name="Expiry_Date" id="Expiry_Date" type="text" class="textbox" value="" size="30">
                        <input type="hidden" name="type_app" id="type_app" value="tmv2"/>
                        <input type="hidden" name="Certificate_Letters" id="Certificate_Letters" value="BC"/>					
			</td><td><b>Cold Isol 46</b> <input name="Cold_isol_46_lp" id="Cold_isol_46_lp" type="checkbox" value="1"></td><td></td></tr>
                        <tr><td>Image</td><td id=""><input type="file" id="img_file"><br><span id="img_link"><input type="hidden" id="imgurl" value=""/></span></td><td>Url</td><td><input type="text" class="textbox" id="url_app" value="" size="30"></td></tr>
		</tbody></table>';
    echo $str_get_tmv2;
}
?><?php

//Show table to insert data
if (isset($_POST["tmv3show"][0]) && isset($_POST["tmv3show"][1]) && isset($_POST["tmv3show"][2])) {



    $str_get_tmv3 = '<table class="table table-bordered"><tbody>
		
		<tr><td><b>Factor</b></td><td><input name="Factor" id="TMV3_Factor" type="text" class="textbox" value="" size="30"></td><td><b>Manufacturer</b></td><td><input name="Manufacturer" id="TMV3_Manufacturer" type="text" class="textbox" value="" size="30"></td></tr>
		
		<tr><td><b>Mixing Valve</b></td><td><input name="Approved_Mixing_Valve" id="TMV3_Approved_Mixing_Valve" type="text" class="textbox" value="" size="30"></td><td><b>Unique ID</b></td><td><input name="Unique_ID" id="TMV3_Unique_ID" type="text" class="textbox" value="" size="30"></td></tr>
		
		<tr><td><b>Certificate Numbers</b></td><td><input name="Certificate_Number" id="TMV3_Certificate_Number" type="text" class="textbox" value="" size="5">/<input name="Certificate_Date" id="TMV3_Certificate_Date" type="text" class="textbox" value="" size="5"></td><td><b>HPB</b> <input name="HPB" id="TMV3_HPB" type="checkbox" value="1"></td><td> <b>Economy</b> <input name="HPB_comment" id="TMV3_HPB_comment" type="text" class="textbox" value="" size="1"></td></tr>
		
		<tr><td><b>Pts Comments</b></td><td><input name="Pts_Comments" id="TMV3_Pts_Comments" type="text" class="textbox" value="" size="30"></td><td><b>HPS</b> <input name="HPS" id="TMV3_HPS" type="checkbox" value="1"></td><td> <b>Economy</b> <input name="HPS_comment" id="TMV3_HPS_comment" type="text" class="textbox" value="" size="1"></td></tr>
		
		<tr><td><b>Primary_or_Secondary</b></td><td><select id="TMV3_Primary_or_Secondary"><option value="Primary">Primary</option><option value="Secondary">Secondary</option></select></td> <td><b>HPW</b> <input name="HPW" id="TMV3_HPW" type="checkbox" value="1"></td><td> <b>Economy</b><input name="HPW_comment" id="TMV3_HPW_comment" type="text" class="textbox" value="" size="1"></td></tr>
		
		<tr><td><b>First_Audit</b></td><td><input name="First_Audit" id="TMV3_First_Audit" type="text" class="textbox" value="" size="30"></td> <td><b>HPT44</b> <input name="HPT44" id="TMV3_HPT44" type="checkbox" value="1"> </td><td><b>Economy</b> <input name="HPT44_comment" id="TMV3_HPT44_comment" type="text" class="textbox" value="" size="1"></td></tr>
		
		<tr><td><b>Comments</b></td><td><input name="Comments" id="TMV3_Comments" type="text" class="textbox" value="" size="30"></td> <td><b>HPT46</b> <input name="HPT46" id="TMV3_HPT46" type="checkbox" value="1"></td><td> <b>Economy</b> <input name="HPT46_comment" id="TMV3_HPT46_comment" type="text" class="textbox" value="" size="1"></td></tr>
		
		<tr><td><b>Extended Comments</b></td><td><input name="Extended_Comments" id="TMV3_Extended_Comments" type="text" class="textbox" value="" size="30"></td><td><b>HPD44</b> <input name="HPD44" id="TMV3_HPD44" type="checkbox" value="1"></td><td><b>Economy</b> <input name="HPD44_comment" id="TMV3_HPD44_comment" type="text" class="textbox" value="" size="1"></td></tr>
		
		<tr><td><b>First_Completed</b></td><td><input name="First_Completed" id="TMV3_First_Completed" type="text" class="textbox" value="" size="30"></td><td><b>HPD46</b> <input name="HPD46" id="TMV3_HPD46" type="checkbox" value="1"></td><td><b>Economy</b> <input name="HPD46_comment" id="TMV3_HPD46_comment" type="text" class="textbox" value="" size="1"></td></tr>
		
		
		
		<tr><td><b>Second_Audit</b></td><td><input name="Second_Audit" id="TMV3_Second_Audit" type="text" class="textbox" value="" size="30"></td> <td><b>LPB</b> <input name="LPB" id="TMV3_LPB" type="checkbox" value="1"></td><td><b>Economy</b> <input name="LPB_comment" id="TMV3_LPB_comment" type="text" class="textbox" value="" size="1"></td></tr>
		
		<tr><td><b>Second_Completed</b></td><td><input name="Second_Completed" id="TMV3_Second_Completed" type="text" class="textbox" value="" size="30"></td><td><b>LPS</b> <input name="LPS" id="TMV3_LPS" type="checkbox" value="1"></td><td><b>Economy</b> <input name="LPS_comment" id="TMV3_LPS_comment" type="text" class="textbox" value="" size="1"></td></tr>
		
		<tr><td><b>LPW</b> <input name="LPW" id="TMV3_LPW" type="checkbox" value="1"></td><td><b>Economy</b> <input name="LPW_comment" id="TMV3_LPW_comment" type="text" class="textbox" value="" size="1"></td> <td><b>LPT44</b> <input name="LPT44" id="TMV3_LPT44" type="checkbox" value="1"></td><td> <b>Economy</b> <input name="LPT44_comment" id="TMV3_LPT44_comment" type="text" class="textbox" value="" size="1"></td></tr>
		
		<tr><td><b>LPT46</b> <input name="LPT46" id="TMV3_LPT46" type="checkbox" value="1"></td><td><b>Economy</b> <input name="LPT46_comment" id="TMV3_LPT46_comment" type="text" class="textbox" value="" size="1"></td><td><b>LPD44</b> <input name="LPD44" id="TMV3_LPD44" type="checkbox" value="1"></td><td> <b>Economy</b> <input name="LPD44_comment" id="TMV3_LPD44_comment" type="text" class="textbox" value="" size="1"></td></tr>
		
		<tr><td><b>LPD46</b> <input name="LPD46" id="TMV3_LPD46" type="checkbox" value="1"></td><td><b>Economy</b> <input name="LPD46_comment" id="TMV3_LPD46_comment" type="text" class="textbox" value="" size="1"></td><td></td></tr>
		
		
		
		<tr><td><b>Discontinued_Withdrawn</b></td><td><input name="Discontinued_Withdrawn" id="TMV3_Discontinued_Withdrawn" type="checkbox" value="1"></td><td><b>Remove_from_Website</b></td><td><input name="Remove_from_Website" id="TMV3_Remove_from_Website" type="checkbox" value="1"></td></tr>
		
		<tr><td><b>New</b></td><td><input name="New" id="TMV3_New" type="checkbox" value="1"><input type="hidden" name="Certificate_Letters" id="TMV3_Certificate_Letters" value="BC">
		<input type="hidden" name="timestamp" id="TMV3_timestamp" value=""></td><td><b>Expiry_Date</b></td><td><input name="Expiry_Date" id="TMV3_Expiry_Date" type="text" class="textbox" value="" size="30"></td></tr>
                <tr><td>Image</td><td id=""><input type="file" id="img_file"><br><span id="img_link"><input type="hidden" id="imgurl" value=""/></span></td><td>Url</td><td><input type="text" class="textbox" id="tmv3_url_app" value="" size="30"></td></tr>
		
</tbody></table>';
    echo $str_get_tmv3;
}
?><?php

if (isset($_POST["cias_show"][0]) && isset($_POST["cias_show"][1]) && isset($_POST["cias_show"][2])) {



    $str_get_tmv3 = '<form id="cform" name="cias"><table class="table table-bordered"><tbody>
		<tr><td><b>Company</b></td><td><input name="manufacturer" id="cias_mfc1" type="text" class="textbox" maxlength="100"  size="30"></td></tr>
		<tr><td><b>Description</b></td><td><input name="description" id="cias_desc1" type="text" class="textbox" maxlength="100"  size="30"></td></tr>
		<tr><td><b>Sizes</b></td><td><input name="sizes" id="cias_sizes1" type="text" class="textbox" maxlength="100"  size="30"></td></tr>
		<tr><td><b>Certification ID </b></td><td><input name="cias_certid1" id="cias_certid1" type="text" class="textbox" value="BC" size="2" readonly="readonly"> <input name="cias_certid2" id="cias_certid2" placeholder="certificate number" type="number" class="textbox" size="10" > <input name="cias_certid3" placeholder="certificate date" id="cias_certid3" type="number" class="textbox"  size="10"></td></tr>
		<tr><td colspan="2"><input type="hidden" name="scheme" id="cias_scheme" value="cias">
                
		<input type="hidden" name="update" value="no">
		<input type="hidden" name="timestamp" id="timestamp1" value="' . date("H:i:s d-m-Y", strtotime("now")) . '">
		</td></tr>
                </tbody></table></form>';
    echo $str_get_tmv3;
}
?><?php

if (isset($_POST["dtc_show"][0]) && isset($_POST["dtc_show"][1]) && isset($_POST["dtc_show"][2])) {



    $str_get_tmv3 = '<form id="dform" name="dtc"><table class="table table-bordered"><tbody>
		
		<tr><td><b>Company</b></td><td><input name="manufacturer" id="dtc_mfc" type="text" class="textbox" maxlength="100"  size="30"></td></tr>
		<tr><td><b>Approved Valve</b></td><td><input name="aprroved_valve" id="dtc_app_valve" type="text" class="textbox"  size="30"></td></tr>
		<tr><td><b>Description</b></td><td><input name="description" id="dtc_desc" type="text" class="textbox" maxlength="100"  size="30"></td></tr>
		
		<tr><td><b>Unique Id</b></td><td><input name="uniqueid" id="dtc_unique" type="text" class="textbox"  size="30"></td></tr>

		<tr><td><b>Certification ID</b></td><td><input name="certid" id="dtc_certid1" type="text" class="textbox" value="BC" readonly="readonly"  size="2"> <input name="certid" id="dtc_certid2" placeholder="certificate number" type="number" class="textbox"  size="10"> <input name="certid" id="dtc_certid3" placeholder="certificate date" type="number" class="textbox"  size="10"></td></tr>
		<tr><td><b>Expiry</b></td><td><input name="expiry" id="dtc_expiry" type="text" class="textbox" maxlength="10"  size="30">
                <input type="hidden" name="scheme" id="dtc_scheme" value="dtc">
		<input type="hidden" name="update" value="no">
		<input type="hidden" name="timestamp" value="' . date("H:i:s d-m-Y", strtotime("now")) . '">
		</td></tr>

</tbody></table></form>';
    echo $str_get_tmv3;
}
?><?php

if (isset($_POST["dtc_data"][0]) && isset($_POST["dtc_data"][1]) && isset($_POST["dtc_data"][2]) && isset($_POST["dtc_data"][3])) {

    $cias_num = $_POST["dtc_data"][2];
    $str_get_tmv3 = '';
    $stmt_cis = $dbh->query("SELECT BUILD_APP_ID,MANUFACTURER,APPROVED_MIXING_VALVE,DESCRIPTION_PRODCERT,UNIQUE_ID,CERT_ID,CERTIFICATE_NUMBER,EXPIRY_DATE FROM BUILDCERT_APPROVALS WHERE BUILD_APP_ID = '$cias_num' and TYPE_APP = 'dtc'");
    if ($_POST["dtc_data"][1] == 'set') {
        while ($rows = $stmt_cis->fetch(PDO::FETCH_ASSOC)) {
            $cert_id = explode('/',$rows["CERT_ID"]);
            $approvalh = stream_get_contents($rows["APPROVED_MIXING_VALVE"]);
            $unique = stream_get_contents($rows["UNIQUE_ID"]);
            $str_get_tmv3 .= '<table class="table table-bordered"><tbody>
		
		<tr><td><b>Company</b></td><td><input name="manufacturer" id="dtc_mfc" type="text" class="textbox" value="'.$rows["MANUFACTURER"].'"  size="30"> <a href="#" data-toggle="tooltip" title="' . $rows["MANUFACTURER"] . '"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a></td></tr>
		<tr><td><b>Approved Valve</b></td><td><input name="aprroved_valve" id="dtc_app_valve" type="text" class="textbox" value="'.$approvalh.'"  size="30"> <a href="#" data-toggle="tooltip" title="'.$approvalh.'"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a></td></tr>
		<tr><td><b>Description</b></td><td><input name="description" id="dtc_desc" type="text" class="textbox" value="' . $rows["DESCRIPTION_PRODCERT"] . '"  size="30"> <a href="#" data-toggle="tooltip" title="' . $rows["DESCRIPTION_PRODCERT"] . '"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a></td></tr>
		<tr><td><b>Unique Id</b></td><td><input name="uniqueid" id="dtc_unique" type="text" class="textbox" value="' .$unique. '"  size="30"> <a href="#" data-toggle="tooltip" title="' .$unique. '"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a></td></tr>
		<tr><td><b>Certification Number</b></td><td><input name="certnum" id="dtc_certid1" type="text" class="textbox" value="BC"  size="2"> <input name="certnum" id="dtc_certid2" type="number" class="textbox" value="' . $rows["CERTIFICATE_NUMBER"] . '"  size="10"> / <input name="certnum" id="dtc_certid3" type="number" class="textbox" value="' . $cert_id[1] . '"  size="10"></td></tr>
                <tr><td><b>Expiry</b></td><td><input name="expiry" id="dtc_expiry" type="text" class="textbox" value="' . $rows["EXPIRY_DATE"] . '"  size="30">
                <input type="hidden" name="scheme" id="dtc_scheme" value="dtc">
		<input type="hidden" name="update" id="dtc_build_app_id" value="'.$cias_num.'">
		<input type="hidden" name="timestamp" value="' . date("H:i:s d-m-Y", strtotime("now")) . '">
		</td></tr>

</tbody></table>';
               
        }
        echo $str_get_tmv3;
    }
    if ($_POST["dtc_data"][1] == 'get') {
        while ($row_cias = $stmt_cis->fetch(PDO::FETCH_ASSOC)) {
            $str_get_tmv3 .= '<table class="table table-bordered"><tbody>		
		<tr><td><b>Company</b></td><td>' . $row_cias["MANUFACTURER"] . '</td></tr>
		<tr><td><b>Description</b></td><td>' . $row_cias["DESCRIPTION_PRODCERT"] . '</td></tr>
		<tr><td><b>Approved Mixing Valve</b></td><td>' . stream_get_contents($row_cias["APPROVED_MIXING_VALVE"]) . '</td></tr>
                <tr><td><b>Unique Id</b></td><td>' . stream_get_contents($row_cias["UNIQUE_ID"]) . '</td></tr>    
		<tr><td><b>Certification Number</b></td><td>' . $row_cias["CERTIFICATE_NUMBER"] . '</td></tr>
		<tr><td><b>Certification ID	</b></td><td>' . $row_cias["CERT_ID"] . '</td></tr>
		<tr><td><b>Expiry	</b></td><td>' . $row_cias["EXPIRY_DATE"] . '</td></tr>
</tbody></table>';
        }
        echo $str_get_tmv3;
    }
}
?><?php

if (isset($_POST["cias_data"][0]) && isset($_POST["cias_data"][1]) && isset($_POST["cias_data"][2]) && isset($_POST["cias_data"][3])) {

    $cias_num = $_POST["cias_data"][2];
    //echo $cias_num;
    $str_get_cias = '';
    $cias_sql = $dbh->query("select BUILD_APP_ID,MANUFACTURER,DESCRIPTION_PRODCERT,SIZES_CIAS,CERTIFICATE_NUMBER,CERT_ID,CERTIFICATE_DATE from BUILDCERT_APPROVALS where BUILD_APP_ID = '$cias_num' and type_app = 'cias'");
    if ($_POST["cias_data"][1] == 'set') {
        while ($row_cias = $cias_sql->fetch(PDO::FETCH_ASSOC)) {
            $CERT_ID = explode('/', $row_cias["CERT_ID"]);
            $str_get_cias .= '<table class="table table-bordered"><tbody >		
		<tr><td><b>Company</b></td><td><input name="manufacturer" id="cias_mfc" type="text" class="textbox" value="' . $row_cias["MANUFACTURER"] . '"  size="30" maxlength="100"> <a href="#" data-toggle="tooltip" title="'. $row_cias["MANUFACTURER"] .'"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a></td></tr>
		<tr><td><b>Description</b></td><td><input name="description" id="cias_desc" type="text" class="textbox" value="' . $row_cias["DESCRIPTION_PRODCERT"] . '"  size="30" maxlength="100"> <a href="#" data-toggle="tooltip" title="'. $row_cias["DESCRIPTION_PRODCERT"] .'"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a></td></tr>
		<tr><td><b>Sizes</b></td><td><input name="sizes" id="cias_sizes" type="text" class="textbox" value="' . $row_cias["SIZES_CIAS"] . '"  size="30" maxlength="100"> <a href="#" data-toggle="tooltip" title="'. $row_cias["SIZES_CIAS"] .'"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a></td></tr>
		<tr><td><b>Certification Details	</b></td><td><input name="certid1" id="cias_certid1" type="text" class="textbox" value="BC"  size="2"> <input name="certid1" id="cias_certid2" type="number" class="textbox" value="' . $row_cias["CERTIFICATE_NUMBER"] . '"  size="10"> <input name="certid1" id="cias_certid3" type="number" class="textbox" value="' . $CERT_ID[1] . '"  size="10">
                    <input type="hidden" name="scheme" id="cias_scheme" value="cias">
		<input type="hidden" name="update" id="cias_update" value="' . date("H:i:s d-m-Y", strtotime("now")) . '">
                    <input type="hidden" name="update" id="build_app_id" value="' . $row_cias["BUILD_APP_ID"] . '">
		</td></tr>
</tbody></table>';
        }
        echo $str_get_cias;
    }
    if ($_POST["cias_data"][1] == 'get') {
        while ($row_cias = $cias_sql->fetch(PDO::FETCH_ASSOC)) {
            $str_get_cias .= '<table class="table table-bordered"><tbody>
		<tr><td><b>Company</b></td><td>' . $row_cias["MANUFACTURER"] . '</td></tr>
		<tr><td><b>Description</b></td><td>' . $row_cias["DESCRIPTION_PRODCERT"] . '</td></tr>
		<tr><td><b>Sizes</b></td><td>' . $row_cias["SIZES_CIAS"] . '</td></tr>
		<tr><td><b>Certification Number	</b></td><td>' . $row_cias["CERTIFICATE_NUMBER"] . '</td></tr>
		<tr><td><b>Certification ID	</b></td><td>' . $row_cias["CERT_ID"] . '</td></tr>
		
</tbody></table>';
        }
        echo $str_get_cias;
    }
}
?><?php

if (isset($_POST["build_show"][0]) && isset($_POST["build_show"][1]) && isset($_POST["build_show"][2])) {



    $str_get_tmv3 = '<form id="bform" name = "bform"><table class="table table-bordered"><tbody>

		<tr><td><b>Company</b></td><td><input name="company" id="pdcert_mfc" type="text" class="textbox" value="" size="30" maxlength="100"></td></tr>
                <tr><td><b>Performance standard/specification</b></td><td><input name="specification" id="pdcert_spc" type="text" class="textbox" value="" size="30"  maxlength="100"></td></tr>
                <tr><td><b>Description</b></td><td><input name="description" id="pdcert_dsc" type="text" class="textbox" value="" size="30"  maxlength="100"></td></tr>
		<tr><td><b>Certificate ID</b></td><td><input name="certid" id="pdcert_certid1" type="text" class="textbox" value="BC" readonly="readonly" size="2"> <input name="certid" id="pdcert_certid2" placeholder="certificate number" type="number" class="textbox"  size="10"  maxlength="10"> <input name="certid" id="pdcert_certid3" type="number" class="textbox" placeholder="certificate date" size="10"  maxlength="10"></td></tr>
		<tr><td><b>Expiry</b></td><td><input name="expiry_d" id="pdcert_exp_d" type="text" class="textbox" value="" size="30" maxlength="10"></td></tr>
                <tr><td><input type="hidden" name="pdcert_scheme" value="pdcert">
		<input type="hidden" name="pdcert_update" value="no">
		<input type="hidden" name="pdcert_timestamp" value="">
		</td></tr>

</tbody></table></form>';
    echo $str_get_tmv3;
}
?><?php

if (isset($_POST["pdcert_data"][0]) && isset($_POST["pdcert_data"][1]) && isset($_POST["pdcert_data"][2])) {

    $pdcert_num = $_POST["pdcert_data"][2];
    $pdcert_sql = $dbh->query("select MANUFACTURER,PERFORMANCE_STANDARD,DESCRIPTION_PRODCERT,CERTIFICATE_NUMBER,CERT_ID,EXPIRY_DATE,BUILD_APP_ID"
            . " from BUILDCERT_APPROVALS where BUILD_APP_ID = '$pdcert_num' and TYPE_APP = 'pdcert'");
    //ECHO $pdcert_num;
    $str_get_pdcert = '';
    if($_POST["pdcert_data"][1] == 'set'){
    while ($row = $pdcert_sql->fetch(PDO::FETCH_ASSOC)) {
        # code...
        $cert_id = explode('/', $row["CERT_ID"]);
        $str_get_pdcert = '<table class="table table-bordered"><tbody>
                
		<tr><td><b>Company</b></td><td><input name="company" id="pdcert_company" type="text" class="textbox" value="' . $row['MANUFACTURER'] . '" size="30"> <a href="#" data-toggle="tooltip" title="' . $row["MANUFACTURER"] . '"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a></td></tr>

		<tr><td><b>Performance standard/specification</b></td><td><input name="specification" id="pdcert_specification" type="text" class="textbox" value="' . $row["PERFORMANCE_STANDARD"] . '" size="30"> <a href="#" data-toggle="tooltip" title="' . $row["PERFORMANCE_STANDARD"] . '"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a></td></tr>

		<tr><td><b>Description</b></td><td><input name="description" id="pdcert_description" type="text" class="textbox" value="' . $row["DESCRIPTION_PRODCERT"] . '" size="30"> <a href="#" data-toggle="tooltip" title="' . $row["DESCRIPTION_PRODCERT"] . '"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a></td></tr>

		<tr><td><b>Certificate Details</b></td><td><input name="certid" id="pdcert_certid1" type="text" class="textbox" value="BC" size="2"> <input name="certid" id="pdcert_certid2" type="text" class="textbox" value="' . $row["CERTIFICATE_NUMBER"] . '" size="10"><input name="certid" id="pdcert_certid3" type="text" class="textbox" value="' . $cert_id[1] . '" size="10"></td></tr>
		<tr><td><b>Expiry</b></td><td><input name="expiry_d" id="pdcert_expiry_d" type="text" class="textbox" value="' . $row["EXPIRY_DATE"] . '" size="30">
                <input type="hidden" name="pdcert_scheme" value="pdcert">
		<input type="hidden" name="pdcert_update" value="no">
		<input type="hidden" name="build_app_id_pdcert" id="build_app_id_pdcert" value="' . $row["BUILD_APP_ID"] . '">
		</td></tr>

</tbody></table>';
    }

    echo $str_get_pdcert;
    }
     if($_POST["pdcert_data"][1] == 'get'){
    while ($row = $pdcert_sql->fetch(PDO::FETCH_ASSOC)) {
        # code...
        $str_get_pdcert = '<table class="table table-bordered"><tbody>

		<tr><td><b>Company</b></td><td>' . $row['MANUFACTURER'] . '</td></tr>

		<tr><td><b>Performance standard/specification</b></td><td>' . $row["PERFORMANCE_STANDARD"] . '</td></tr>

		<tr><td><b>Description</b></td><td>' . $row["DESCRIPTION_PRODCERT"] . '</td></tr>

		<tr><td><b>Certificate No</b></td><td>' . $row["CERTIFICATE_NUMBER"] . '</td></tr>
		
		<tr><td><b>Certificate ID</b></td><td>' . $row["CERT_ID"] . '</td></tr>
		
		<tr><td><b>Expiry</b></td><td>' . $row["EXPIRY_DATE"] . '</td></tr>
                <tr></tr>

</tbody></table>';
    }

    echo $str_get_pdcert;
    }
}
?><?php

//Show tmv3 data
if (isset($_POST["tmv3data"][0]) && isset($_POST["tmv3data"][1]) && isset($_POST["tmv3data"][2]) && isset($_POST["tmv3data"][3])) {

    $certnum = $_POST["tmv3data"][0];
    //$scheme = $_POST["tmv2data"][3];

    $sql_get_tmv2 = "select * from BUILDCERT_APPROVALS where BUILD_APP_ID = :certnum AND TYPE_APP = 'tmv3' ";
    $quer_get_tmv2 = $dbh->prepare($sql_get_tmv2);
    $quer_get_tmv2->bindParam(":certnum", $certnum);
    $quer_get_tmv2->execute();
    if ($_POST["tmv3data"][3] == "get") {
        while ($row = $quer_get_tmv2->fetch(PDO::FETCH_ASSOC)) {

            $Manufacturer = $row['MANUFACTURER'];
            $Factor = $row['FACTOR'];
            $Approved_Mixing_Valve = stream_get_contents($row["APPROVED_MIXING_VALVE"]);
            $Certificate_Letters = $row["CERTIFICATE_LETTERS"];
            $Certificate_Number = $row["CERTIFICATE_NUMBER"];
            $Certificate_Date = $row["CERTIFICATE_DATE"];
            $Comments = $row['COMMENTS'];
            
             if(strpos($row['EXTENDED_COMMENTS'],'@') > 0){
            $exp = explode('@', $row['EXTENDED_COMMENTS']);
            $Extended_Comments = $exp[0];
             }
            else {
                $Extended_Comments = $row['EXTENDED_COMMENTS'];
            }
            $Unique_ID = stream_get_contents($row['UNIQUE_ID']);
            $cert_id_2 = $row['CERT_ID'];
            $HPB = $row['HPB'];
            $HPB_comment = $row['HPB_COMMENT'];
            $HPS = $row['HPS'];
            $HPS_comment = $row['HPS_COMMENT'];
            $HPW = $row['HPW'];
            $HPW_comment = $row['HPW_COMMENT'];
            $HPT44 = $row['HPT44'];
            $HPT44_comment = $row['HPT44_COMMENT'];
            $HPT46 = $row['HPT46'];
            $HPT46_comment = $row['HPT46_COMMENT'];
            $HPD44 = $row['HPD44'];
            $HPD44_comment = $row['HPD44_COMMENT'];
            $HPD46 = $row['HPD46'];
            $HPD46_comment = $row['HPD46_COMMENT'];
            $LPB = $row['LPB'];
            $LPB_comment = $row['LPB_COMMENT'];
            $LPS = $row['LPS'];
            $LPS_comment = $row['LPS_COMMENT'];
            $LPW = $row['LPW'];
            $LPW_comment = $row['LPW_COMMENT'];
            $LPT44 = $row['LPT44'];
            $LPT44_comment = $row['LPT44_COMMENT'];
            $LPT46 = $row['LPT46'];
            $LPT46_comment = $row['LPT46_COMMENT'];
            $LPD44 = $row['LPD44'];
            $LPD44_comment = $row['LPD44_COMMENT'];
            $LPD46 = $row['LPD46'];
            $LPD46_comment = $row['LPD46_COMMENT'];
            $Pts_Comments = $row['PTS_COMMENTS'];
            $Primary_or_Secondary = $row['PRIMARY_OR_SECONDARY'];
            $First_Audit = $row['FIRST_AUDIT'];
            $First_Completed = $row['FIRST_COMPLETED'];
            $Second_Audit = $row['SECOND_AUDIT'];
            $Second_Completed = $row['SECOND_COMPLETED'];
            $Discontinued_Withdrawn = $row['DISCONTINUED_WITHDRAWN'];
            $Remove_from_Website = $row['REMOVE_FROM_WEBSITE'];
            $New = $row['NEW'];
            $Expiry_Date = $row['EXPIRY_DATE'];
        }

        $str_get_tmv3 = '<table class="table table-bordered"><tbody>
									<tr><td><b>Factor</b><br><br></td><td>' . $Factor . '<br><br></td></tr>
									<tr><td><b>Mixing Valve</b><br><br></td><td>' . $Approved_Mixing_Valve . '<br><br></td></tr>
									<tr><td><b>Certificate </b><br><br></td><td>' . $cert_id_2 . '<br><br></td></tr>
									<tr></tr>
									<tr><td><b>HPB</b></td><td>';
        $str_get_tmv3 .= ($HPB == "1") ? "<i class=\"fa fa-check\" aria-hidden=\"true\"></i>" . $HPB_comment : "";

        $str_get_tmv3 .= '</td></tr><tr><td><b>HPS</b></td><td>';

        $str_get_tmv3 .= ($HPS == "1") ? "<i class=\"fa fa-check\" aria-hidden=\"true\"></i>" . $HPS_comment : "";

        $str_get_tmv3 .= '</td></tr><tr><td><b>HPW</b></td><td>';

        $str_get_tmv3 .= ($HPW == "1") ? "<i class=\"fa fa-check\" aria-hidden=\"true\"></i>" . $HPW_comment : "";

        $str_get_tmv3 .= '</td></tr><tr><td><b>HPT44</b></td><td>';
        $str_get_tmv3 .= ($HPT44 == "1") ? "<i class=\"fa fa-check\" aria-hidden=\"true\"></i>" . $HPT44_comment : "";

        $str_get_tmv3 .= '</td></tr><tr><td><b>HPT46</b></td><td>';
        $str_get_tmv3 .= ($HPT46 == "1") ? "<i class=\"fa fa-check\" aria-hidden=\"true\"></i>" . $HPT46_comment : "";
        $str_get_tmv3 .= '</td></tr><tr><td><b>HPD44</b></td><td>';
        $str_get_tmv3 .= ($HPD44 == "1") ? "<i class=\"fa fa-check\" aria-hidden=\"true\"></i>" . $HPD44_comment : "";
        $str_get_tmv3 .= '</td></tr><tr><td><b>HPD46</b></td><td>';
        $str_get_tmv3 .= ($HPD46 == "1") ? "<i class=\"fa fa-check\" aria-hidden=\"true\"></i>" . $HPD46_comment : "";
        $str_get_tmv3 .= ($LPB == "1") ? "<i class=\"fa fa-check\" aria-hidden=\"true\"></i>" . $LPB_comment : "";
        $str_get_tmv3 .= '</td></tr><tr><td><b>LPS</b></td><td>';
        $str_get_tmv3 .= ($LPS == "1") ? "<i class=\"fa fa-check\" aria-hidden=\"true\"></i>" . $LPS_comment : "";
        $str_get_tmv3 .= '</td></tr><tr><td><b>LPW</b></td><td>';
        $str_get_tmv3 .= ($LPW == "1") ? "<i class=\"fa fa-check\" aria-hidden=\"true\"></i>" . $LPW_comment : "";
        $str_get_tmv3 .= '</td></tr><tr><td><b>LPT44</b></td><td>';
        $str_get_tmv3 .= ($LPT44 == "1") ? "<i class=\"fa fa-check\" aria-hidden=\"true\"></i>" . $LPT44_comment : "";
        $str_get_tmv3 .= '</td></tr><tr><td><b>LPT46</b></td><td>';
        $str_get_tmv3 .= ($LPT46 == "1") ? "<i class=\"fa fa-check\" aria-hidden=\"true\"></i>" . $LPT46_comment : "";
        $str_get_tmv3 .= '</td></tr><tr><td><b>LPD44</b></td><td>';
        $str_get_tmv3 .= ($LPD44 == "1") ? "<i class=\"fa fa-check\" aria-hidden=\"true\"></i>" . $LPD44_comment : "";
        $str_get_tmv3 .= '</td></tr><tr><td><b>LPD46</b></td><td>';
        $str_get_tmv3 .= ($LPD46 == "1") ? "<i class=\"fa fa-check\" aria-hidden=\"true\"></i>" . $LPD46_comment : "";
        $str_get_tmv3 .= '</td></tr><tr><td><b>Comments</b><br><br></td><td>' . $Comments . '<br><br></td></tr>
											
											
											</tbody></table>';
        echo $str_get_tmv3;
    }
} if (@$_POST["tmv3data"][3] == "show") {
    while ($row = $quer_get_tmv2->fetch(PDO::FETCH_ASSOC)) {

        $Manufacturer = $row['MANUFACTURER'];
        $Factor = $row['FACTOR'];
        $Approved_Mixing_Valve = stream_get_contents($row["APPROVED_MIXING_VALVE"]);
        $Certificate_Letters = $row["CERTIFICATE_LETTERS"];
        $Certificate_Number = $row["CERTIFICATE_NUMBER"];
        $Certificate_Date = $row["CERTIFICATE_DATE"];
        $Comments = $row['COMMENTS'];
        if(strpos($row['EXTENDED_COMMENTS'],'@') > 0){
            $exp = explode('@', $row['EXTENDED_COMMENTS']);
            $Extended_Comments = $exp[0];
             }
            else {
                $Extended_Comments = $row['EXTENDED_COMMENTS'];
            }
        $Unique_ID = stream_get_contents($row['UNIQUE_ID']);
        $cert_id_2 = $row['CERT_ID'];
        $HPB = $row['HPB'];
        $HPB_comment = $row['HPB_COMMENT'];
        $HPS = $row['HPS'];
        $HPS_comment = $row['HPS_COMMENT'];
        $HPW = $row['HPW'];
        $HPW_comment = $row['HPW_COMMENT'];
        $HPT44 = $row['HPT44'];
        $HPT44_comment = $row['HPT44_COMMENT'];
        $HPT46 = $row['HPT46'];
        $HPT46_comment = $row['HPT46_COMMENT'];
        $HPD44 = $row['HPD44'];
        $HPD44_comment = $row['HPD44_COMMENT'];
        $HPD46 = $row['HPD46'];
        $HPD46_comment = $row['HPD46_COMMENT'];
        $LPB = $row['LPB'];
        $LPB_comment = $row['LPB_COMMENT'];
        $LPS = $row['LPS'];
        $LPS_comment = $row['LPS_COMMENT'];
        $LPW = $row['LPW'];
        $LPW_comment = $row['LPW_COMMENT'];
        $LPT44 = $row['LPT44'];
        $LPT44_comment = $row['LPT44_COMMENT'];
        $LPT46 = $row['LPT46'];
        $LPT46_comment = $row['LPT46_COMMENT'];
        $LPD44 = $row['LPD44'];
        $LPD44_comment = $row['LPD44_COMMENT'];
        $LPD46 = $row['LPD46'];
        $LPD46_comment = $row['LPD46_COMMENT'];
        $Pts_Comments = $row['PTS_COMMENTS'];
        $Primary_or_Secondary = $row['PRIMARY_OR_SECONDARY'];
        $First_Audit = $row['FIRST_AUDIT'];
        $First_Completed = $row['FIRST_COMPLETED'];
        $Second_Audit = $row['SECOND_AUDIT'];
        $Second_Completed = $row['SECOND_COMPLETED'];
        $Discontinued_Withdrawn = $row['DISCONTINUED_WITHDRAWN'];
        $Remove_from_Website = $row['REMOVE_FROM_WEBSITE'];
        $New = $row['NEW'];
        $Expiry_Date = $row['EXPIRY_DATE'];
    }


    $str_get_tmv3 = '<table class="table table-bordered"><tbody>
<tr>
<td><b>Factor</b></td><td><input name="Factor" id="TMV3_Factor" type="text"  class="textbox" value="' . $Factor . '" size="30" maxlength="100"></td>
<td><b>Manufacturer</b></td><td><input name="Manufacturer" id="TMV3_Manufacturer" type="text" class="textbox" value="' . $Manufacturer . '" size="30" maxlength="100"></td>
</tr><tr>
<td><b>Mixing Valve</b></td><td><input name="Approved_Mixing_Valve" id="TMV3_Approved_Mixing_Valve" type="text" class="textbox" value="' . $Approved_Mixing_Valve . '" size="30"></td>
<td><b>ID</b></td><td><input name="Unique_ID" id="TMV3_Unique_ID" type="text" class="textbox" value="' . $Unique_ID . '" size="30"></td>
</tr><tr><td><b>Certificate Details </b></td><td>BC <input name="Certificate_Number"  type="number" readonly="readonly" class="textbox" value="'.$Certificate_Number.'" size="5" style="width:100px;">/<input name="Certificate_Date"  readonly="readonly"  type="number" class="textbox" value="'.$Certificate_Date.'" size="5" style="width:100px;"></td>
    <td><b>LPD44</b> <input name="LPD44" id="TMV3_LPD44" type="checkbox" value="1" ' . (($LPD44 == '1') ? 'checked' : "") . '></td><td><b>Economy</b> <input name="LPD44_comment" id="TMV3_LPD44_comment" type="text" class="textbox" value="' . $LPD44_comment . '" size="1" maxlength="2"></td>

</tr><tr>
<td><b>Comments</b></td><td><input name="Comments" id="TMV3_Comments"  type="text" class="textbox" value="' . $Comments . '" size="30" maxlength="400"></td>
<td><b>HPB</b> <input name="HPB" id="TMV3_HPB" type="checkbox" value="1"' . (($HPB == '1') ? 'checked' : "") . '></td><td><b>Economy</b> <input name="HPB_comment" id="TMV3_HPB_comment" type="text" class="textbox" value="' . $HPB_comment . '" size="1" maxlength="2"></td>
</tr><tr>
<td><b>Extended Comments</b></td><td><input name="Extended_Comments" id="TMV3_Extended_Comments" type="text" class="textbox" value="' . $Extended_Comments . '" size="30" maxlength="400"></td>
<td><b>HPS</b> <input name="HPS" id="TMV3_HPS" type="checkbox" value="1" ' . (($HPS == '1') ? 'checked' : "") . '></td><td><b>Economy</b> <input name="HPS_comment" id="TMV3_HPS_comment" type="text" class="textbox" value="' . $HPS_comment . '" size="1" maxlength="2"></td>
</tr><tr>
<td><b>Pts Comments</b></td><td><input name="Pts_Comments" id="TMV3_Pts_Comments" type="text" class="textbox" value="' . $Pts_Comments . '" size="30" maxlength="176"></td>
<td><b>HPW</b> <input name="HPW" id="TMV3_HPW" type="checkbox" value="1" ' . (($HPW == '1') ? 'checked' : "") . '></td><td><b>Economy</b> <input name="HPW_comment" id="TMV3_HPW_comment" type="text" class="textbox" value="' . $HPW_comment . '" size="1" maxlength="2"></td>
</tr><tr>
<td><b>Primary_or_Secondary</b></td><td><select id="TMV3_Primary_or_Secondary"><option value="'.$Primary_or_Secondary.'">'.$Primary_or_Secondary.'</option><option value="Primary">Primary</option><option value="Secondary">Seconday</option></select></td>
<td><b>HPT44</b> <input name="HPT44" id="TMV3_HPT44" type="checkbox" value="1" ' . (($HPT44 == '1') ? 'checked' : "") . '></td><td><b>Economy</b> <input name="HPT44_comment" id="TMV3_HPT44_comment" type="text" class="textbox" value="' . $HPT44_comment . '" size="1" maxlength="2"></td>
</tr><tr>
<td><b>First_Audit</b></td><td><input name="First_Audit" id="TMV3_First_Audit" type="text" class="textbox" value="' . $First_Audit . '" size="30" maxlength="14"></td>
<td><b>HPT46</b> <input name="HPT46" id="TMV3_HPT46" type="checkbox" value="1" ' . (($HPT46 == '1') ? 'checked' : "") . '></td><td><b>Economy</b> <input name="HPT46_comment" id="TMV3_HPT46_comment" type="text" class="textbox" value="' . $HPT46_comment . '" size="1" maxlength="2"></td>
</tr><tr>
<td><b>First_Completed</b></td><td><input name="First_Completed" id="TMV3_First_Completed" type="text" class="textbox" value="' . $First_Completed . '" size="30" maxlength="400"></td>
<td><b>HPD44</b> <input name="HPD44" id="TMV3_HPD44" type="checkbox" value="1" ' . (($HPD44 == '1') ? 'checked' : "") . '></td><td><b>Economy</b> <input name="HPD44_comment" id="TMV3_HPD44_comment" type="text" class="textbox" value="' . $HPD44_comment . '" size="1" maxlength="2"></td>
</tr><tr>
<td><b>Second_Audit</b></td><td><input name="Second_Audit" id="TMV3_Second_Audit" type="text" class="textbox" value="' . $Second_Audit . '" size="30" maxlength="14"></td>
<td><b>HPD46</b> <input name="HPD46" id="TMV3_HPD46" type="checkbox" value="1" ' . (($HPD46 == '1') ? 'checked' : "") . '></td><td><b>Economy</b> <input name="HPD46_comment" id="TMV3_HPD46_comment" type="text" class="textbox" value="' . $HPD46_comment . '" size="1" maxlength="2"></td>
</tr><tr>
<td><b>Second_Completed</b></td><td><input name="Second_Completed" id="TMV3_Second_Completed" type="text" class="textbox" value="' . $Second_Completed . '" size="30" maxlength="400"></td>
<td><b>LPB</b> <input name="LPB" id="TMV3_LPB" type="checkbox" value="1" ' . (($LPB == '1') ? 'checked' : "") . '></td><td><b>Economy</b> <input name="LPB_comment" id="TMV3_LPB_comment" type="text" class="textbox" value="' . $LPB_comment . '" size="1" maxlength="2"></td>
</tr><tr>
<td><b>Discontinued_Withdrawn</b></td><td><input name="Discontinued_Withdrawn" id="TMV3_Discontinued_Withdrawn" type="checkbox" value="1" ' . (($Discontinued_Withdrawn == '1') ? 'checked' : "") . '></td>
<td><b>LPS</b> <input name="LPS" id="TMV3_LPS" type="checkbox" value="1" ' . (($LPS == '1') ? 'checked' : "") . '></td><td><b>Economy</b> <input name="LPS_comment" id="TMV3_LPS_comment" type="text" class="textbox" value="' . $LPS_comment . '" size="1" maxlength="2"></td>
</tr><tr>
<td><b>Remove_from_Website</b></td><td><input name="Remove_from_Website" id="TMV3_Remove_from_Website" type="checkbox" value="1" ' . (($Remove_from_Website == '1') ? 'checked' : "") . '></td>
<td><b>LPW</b> <input name="LPW" id="TMV3_LPW" type="checkbox" value="1" ' . (($LPW == '1') ? 'checked' : "") . '></td><td><b>Economy</b> <input name="LPW_comment" id="TMV3_LPW_comment" type="text" class="textbox" value="' . $LPW_comment . '" size="1" maxlength="2"></td>
</tr><tr>
<td><b>New</b></td><td><input name="New" id="TMV3_New" type="checkbox" value="1" ' . (($New == '1') ? 'checked' : "") . '></td>
<td><b>LPT44</b> <input name="LPT44" id="TMV3_LPT44" type="checkbox" value="1" ' . (($LPT44 == '1') ? 'checked' : "") . '></td><td><b>Economy</b> <input name="LPT44_comment" id="TMV3_LPT44_comment" type="text" class="textbox" value="' . $LPT44_comment . '" size="1" maxlength="2"></td>
</tr><tr>
<td><b>Expiry_Date</b></td><td><input name="Expiry_Date" id="TMV3_Expiry_Date" type="text" class="textbox" value="' . $Expiry_Date . '" size="30" maxlength="10"></td>
 <td><b>LPT46</b> <input name="LPT46" id="TMV3_LPT46" type="checkbox" value="1" ' . (($LPT46 == '1') ? 'checked' : "") . '></td><td><b>Economy</b> <input name="LPT46_comment" id="TMV3_LPT46_comment" type="text" class="textbox" value="' . $LPT46_comment . '" size="1" maxlength="2"></td>
 </tr><tr>
<td><input type="hidden" id="TMV3_build_app_id" value="' . $certnum . '"></td> <td></td>
<td><b>LPD46</b> <input name="LPD46" id="TMV3_LPD46" type="checkbox" value="1" ' . (($LPD46 == '1') ? 'checked' : "") . '></td><td><b>Economy</b> <input name="LPD46_comment" id="TMV3_LPD46_comment" type="text" class="textbox" value="' . $LPD46_comment . '" size="1" maxlength="2"></td>
</tr>
</tbody></table>';
    echo $str_get_tmv3;
}
?><?php

//Show tmv3 data
if (isset($_POST["build_data"][0]) && isset($_POST["build_data"][1]) && isset($_POST["build_data"][2]) && isset($_POST["build_data"][3])) {

    $certnum = $_POST["build_data"][0];
    //$scheme = $_POST["tmv2data"][3];
    $str_get_tmv3 = '';
    $sql_get_tmv2 = "select BUILD_APP_ID,PERFORMANCE_STANDARD,DESCRIPTION_PRODCERT,CERTIFICATE_NUMBER,CERT_ID,EXPIRY_DATE from BUILDCERT_APPROVALS where BUILD_APP_ID = :certnum AND TYPE_APP = 'pdcert' ";
    $quer_get_tmv2 = $dbh->prepare($sql_get_tmv2);
    $quer_get_tmv2->bindParam(":certnum", $certnum);
    $quer_get_tmv2->execute();
    if ($_POST["build_data"][3] == "get") {
        while ($row = $quer_get_tmv2->fetch(PDO::FETCH_ASSOC)) {
            $prod_standard = $row["PERFORMANCE_STANDARD"];
            $description = $row["DESCRIPTION_PRODCERT"];
            $certnum = $row["CERTIFICATE_NUMBER"];
            $certid = $row["CERT_ID"];
            $expiry = $row["EXPIRY_DATE"];
        }

        $str_get_tmv3 = '<table><tbody>
									<tr><td><b>Product Standard</b><br><br></td><td>' . $prod_standard . '<br><br></td></tr>
									<tr><td><b>Description</b><br><br></td><td>' . $description . '<br><br></td></tr>
									<tr><td><b>Certificate Number</b><br><br></td><td>' . $certnum . '<br><br></td></tr>
                                                                        <tr><td><b>Certificate ID</b><br><br></td><td>' . $certid . '<br><br></td></tr>
                                                                        <tr><td><b>Expiry</b><br><br></td><td>' . $expiry . '<br><br></td></tr>
									
											</tbody></table>';
        echo $str_get_tmv3;
    }
}
?><?php

if (isset($_POST["emaildata"][0]) && isset($_POST["emaildata"][1]) && isset($_POST["emaildata"][2]) && isset($_POST["emaildata"][3])) {

    $to = "PTaylor@nsf.org";
    // send e-mail to ...
    $name = $_POST["emaildata"][0];
    $phone = $_POST["emaildata"][3];
    $email_id = $_POST["emaildata"][1];
    $comments_mes = $_POST["emaildata"][2];
    // Your subject
    $subject = "You Recieved Mail from $email_id";

    // From
    $header = 'from: noreply@wrcnsf.com' . "\r\n";
    $header .= 'MIME-Version: 1.0' . "\r\n";
    $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Your message
    $message = "You recieved a mail: <br> <br> Name: $name<br>Email: $email_id<br>Telephone: $phone <br>Message: $comments_mes";
    //end of message
    // send email
    if (mail($to, $subject, $message, $header))
        echo "Ok";
}
?>