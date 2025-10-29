<?php
$con=mysqli_connect('localhost', 'root', '', 'sms_projects');

if(!$con){
    echo 'connection failed';
}
session_start();
//  if($con){
//      echo 'ok';
//  }
//  else{
//      echo 'not';
//  }
//  exit;


?>