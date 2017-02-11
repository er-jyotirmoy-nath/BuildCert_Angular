<?php
ini_set('display_errors','1');
session_start();
include("connections/wrc_new.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_POST["inslink"][0]) && isset($_POST["inslink"][1]) && isset($_POST["inslink"][2])){
    $section = $_POST["inslink"][0];
    $title   = $_POST["inslink"][1];
    $name    = $_POST["inslink"][2];
    if($_POST["inslink"][4] == 'f')
    $link    = basename($_POST["inslink"][3]).PHP_EOL;
    else
    $link    = $_POST["inslink"][3];   
    echo $_POST["inslink"][4];
    $uploaded = $title.'@'.$name;
    $sql_link = "insert into wrc.files(FILE_,UPLOADED,SECTION) values('$link','$uploaded','$section')";
    $dbh->query($sql_link);
    $data_link = file_get_contents('..//..//lab_control_v2/standard_documents/downloads.json');
    //var_dump($data_link);
    $json_link1 = array();
    $json_link = json_decode($data_link,true);
    $json_link1 = array("section" => $_POST["inslink"][0],"title" => $_POST["inslink"][1],"name" => $_POST["inslink"][2], "Link" => $_POST["inslink"][3]);
    array_push($json_link, $json_link1);
    //print_r($json_link);
    $json_link = json_encode($json_link);
    //var_dump($json_link);
    file_put_contents('..//..//lab_control_v2/standard_documents/downloads.json', $json_link);
    echo "Done";
}