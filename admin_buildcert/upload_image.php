<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include("connections/wrc_new.php");
header('Content-Type: text/plain; charset=utf-8');
ini_set('display_errors','1');
try{
$name = $_FILES["file"]["name"];
$maxDimW = 290;
$maxDimH = 290;
list($width, $height, $type, $attr) = getimagesize( $_FILES["file"]["tmp_name"] );
if ( $width > $maxDimW || $height > $maxDimH ) {
    $target_filename = $_FILES["file"]["tmp_name"];
    $fn = $_FILES["file"]["tmp_name"];
    $size = getimagesize( $fn );
    $ratio = $size[0]/$size[1]; // width/height
    if( $ratio > 1) {
        $width = $maxDimW;
        $height = $maxDimH/$ratio;
    } else {
        $width = $maxDimW*$ratio;
        $height = $maxDimH;
    }
    $src = imagecreatefromstring(file_get_contents($fn));
    $dst = imagecreatetruecolor( $width, $height );
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );

    imagejpeg($dst, $target_filename); // adjust format as needed
}
$uploads_dir = 'C:\\inetpub\\wwwroot\\lab_control_v2\\uploaded_documents\\buildcert\\image_app\\';
$name = sha1(strtotime('now').$_SESSION["logid"].'213233212').'.jpg';
if(move_uploaded_file($_FILES["file"]["tmp_name"], $uploads_dir.$name))
{
    echo $name;
}
}
 catch (Exception $e){
     echo $e->getMessage();
 }