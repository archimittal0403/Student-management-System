<?php
session_start();
 include('includes/config.php');
include('email.php');
 $admin_email=$_POST['email'];
 $admin_password=$_POST['password'];

 $select_query="Select * from `accounts` where email='$admin_email'";
       $result=mysqli_query($con,$select_query);
       if($row_count=mysqli_num_rows($result)>0){
              $row_data=mysqli_fetch_assoc($result);
      //if(password_verify($admin_password,$row_data['admin_password'])){
      
            $_SESSION['email']=$admin_email;
 $otp=rand(11111,99999);
 send_otp($admin_email,"PHP OTP LOGIN",$otp);
 //echo "Email founnd:" .$otp;
  $update_otp="update `accounts` set user_otp='$otp' where email='$admin_email'";
       $result_otp=mysqli_query($con,$update_otp);
        //header("location:verify.php?msg=OTP Send Success");
   
       header("location:verify.php?msg=OTP Send Success");
      }
      // echo "<script>alert('invalid credantaial')</script>";
       
       
       else{
      
       header("location:admin_login.php?msg=Email id invalid");
       }
 ?>
