
<?php
include('../includes/connect.php');
include('../functions/common_function.php');

@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login </title>
      <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
  
    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../style.css">
</head>
<body>
     
<div class="container-fluid m-3">
    <h2 class="text-center mb-4 mt-5">Login</h2>
    <div class=" row d-flex justify-content-center align-item-center">
        <div class="col-lg-6">
            <img src="../image/admin_regis.jpg" alt="adin registration" class="img-fluid"> 
</div> 

<div class="col-lg-6">
  <div class="alert alert-primary w-50 " role="alert">
    <?php
    if(isset($_REQUEST['msg'])){
      echo $_REQUEST['msg'];
     }
    ?>
</div> 
    <form action="send_otp.php" method="post">
      
        <div class="form-outline mb-4 mt-5">
<label for="admin_email" class="form-label">Email Id :-</label>
<input type="email" id="admin_email" name="admin_email" placeholder="Enter the your Name" required="required"   autocomplete="off" class="form-control w-50 ">
</div>

<div class="form-outline mb-4">
 <input type="submit" class="bg-success  py-2 px-3 border-0 text-light" name="user_otp" value="send otp"> 


   

        <div class="form-outline mb-4 mt-2">
<label for="admin_password" class="form-label">Password :-</label>
<input type="password" id="admin_password" name="admin_password"   placeholder="Enter the your password" required="required" class="form-control w-50 ">
</div>

 


<div class="form-outline mb-4">
<input type="submit" class="bg-info  py-2 px-3 border-0" name="admin_login" value="Login">
<p class="small fw-bold mt-4">Don't you have account?<a href="admin_registration.php" class="link-danger mx-2">Register</a></p>
</div>

<a href="forget.php"> Forget Password</a>
</form>

<!--    
 <div class="container-fluid m-3">
    <h2 class="text-center mb-4 mt-5">Login</h2>
    <div class=" row d-flex justify-content-center align-item-center">
        <div class="col-lg-6">
            <img src="../image/otp.avif" alt="adin registration" class="img-fluid">
</div>  -->


   
</div>
</div>
</div>
</body>
</html>



<?php
if(isset($_POST['admin_login'])){
       $admin_email=$_POST['admin_email'];
       $admin_password=$_POST['admin_password'];
$user_otp=$_POST['user_otp'];
       $select_query="Select * from `admin_table` where admin_email='$admin_email' and user_otp='$user_otp'";
       $result=mysqli_query($con,$select_query);
       $row_count=mysqli_num_rows($result);
       $row_data=mysqli_fetch_assoc($result);
       

       // now fetch the cart item
      //  $select_query_cart="Select * from `cart_details` where ip_address='$user_ip'";
      // $result_cart=mysqli_query($con,$select_query_cart);
      //   $row_count_cart=mysqli_num_rows($result_cart);

       if($row_count>0){
        $_SESSION['admin_email']=$admin_email;
       
        // $otp=rand(11111,99999);
        // echo "Email founnd:" .$otp;
        //  $update_otp="update admin_table set user_otp='$otp' where admin_email='$admin_email'";
        //  $result_otp=mysqli_query($con,$update_otp);
        //  header("location:verify.php?msg=OTP Send");
      
//  if(password_verify($admin_password,$row_data['admin_password'])){

     if($row_count==1){
        $_SESSION['admin_email']=$admin_email;
        
       
echo "<script>alert('The admin is login')</script>";
echo "<script>window.open('index.php','_self')</script>";
     }
       
    
else{
     echo "<script>alert('Invalid credentails')</script>";
}
 
// else {
//         echo "<script>alert('Invalid credentials')</script>";
//        }
      }
    
    }
?>