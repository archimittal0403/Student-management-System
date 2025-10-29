<?php
session_start();
include('../includes/connect.php');
include('email.php');
if(isset($_GET['admin_email'])){
 $admin_email=$_GET['admin_email'];
 $admin_password=md5($_GET['admin_password']);
 $select_query="Select * from `admin_table` where admin_email='$admin_email'";
       $result=mysqli_query($con,$select_query);
       if($row_count=mysqli_num_rows($result)>0){
              $row_data=mysqli_fetch_assoc($result);
              $admin_password=$row_data['admin_password'];
 send_otp($admin_email,"PHP OTP LOGIN",$admin_password);
 //echo "Email founnd:" .$otp;
 
        header("location:admin_login.php?msg=OTP Send Success");
       }
   
      
      
       else{
        header("location:forget.php?msg=Email id invalid");
       }
    }
 ?>
