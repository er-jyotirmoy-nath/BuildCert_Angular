<?php
session_start();
include("connections/wrc_new.php");
header('Content-Type: text/plain; charset=utf-8');
ini_set('display_errors','1');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
try{
$name = $_FILES["file"]["name"];

$uploads_dir = 'C:\\inetpub\\wwwroot\\lab_control_v2\\standard_documents\\';

//$name = basename($_FILES["file"]["name"][$key]);
if(move_uploaded_file($_FILES["file"]["tmp_name"], $uploads_dir.$name)){
     // insert to data base
     
    echo 'http://nsfaaws6.nsf.org/lab_control_v2/standard_documents/'.$name.'';
     
     
}
//$uploads_dir = "download/";
//foreach ($_FILES["file"]["error"] as $key => $error) {
//    if ($error == UPLOAD_ERR_OK) {
//        $tmp_name = $_FILES["file"]["tmp_name"];
//         $name = basename($_FILES["file"]["name"][$key]);
//       if( move_uploaded_file($tmp_name, "$uploads_dir$name"))
//        echo '<a href="http://nsfaaws6.nsf.org/buildcert/downloads/'.$name.'">Link</a>';
//    else {
//        echo "No";
//    }
//    }
// else {
//            echo $error;
//    }
//}

}
 catch (Exception $e){
     echo $e->getMessage();
 }