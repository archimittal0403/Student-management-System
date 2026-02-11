
<?php
 include('includes/config.php');
//include('includes/function.php');
session_start();
?> 
<?php


// check session
if(isset($_SESSION['email'])){
    echo "Session email: " . $_SESSION['email'];
} else {
    echo "Session email is not set!";
}

// for debugging more details
var_dump($_SESSION);
?>
<?php


if(isset($_POST['verify_otp'])){
    $user_otp = trim($_POST['user_otp']);
    $user_email = $_SESSION['email']; // assume email session me store hai jab OTP bheja


    // DB query to check OTP
    $stmt = $con->prepare("SELECT * FROM accounts WHERE email=? AND user_otp=?");
    $stmt->bind_param("ss", $user_email, $user_otp);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        // OTP correct
        $_SESSION['login'] = true;
        // OTP use hone ke baad database me delete ya expire kar do
        $stmt2 = $con->prepare("UPDATE `accounts` SET user_otp=NULL WHERE email=?");
        $stmt2->bind_param("s", $user_email);
        $stmt2->execute();
          if(isset($_SESSION['error_msg'])){
            unset($_SESSION['error_msg']);
        }

        header('Location: dashboard.php');
       
        exit();
    } else {
        $_SESSION['error_msg'] = 'Invalid OTP';
        header('Location: login.php');
        exit();
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login </title>
    <!-- bootstrap css link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
  
    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../style.css">
</head>
<body>
    
<div class="container-fluid m-3">
    <h2 class="text-center mb-4 mt-5">Enter your OTP</h2>
    <div class=" row d-flex justify-content-center align-item-center">
        <div class="col-lg-6">
            <img src="../assest/images/admin_regis.jpg" alt="adin registration" class="img-fluid">
</div>

<div class="col-lg-6">
  <div class="alert alert-primary w-50 " role="alert">
    <?php
    if(isset($_REQUEST['msg'])){
      echo $_REQUEST['msg'];
    }
    ?>
</div>

    <form action="verify.php" method="post">
      
        <div class="form-outline mb-4 mt-5">
<label for="email" class="form-label">OTP :-</label>
<input type="number" id="user_otp" name="user_otp" placeholder="Enter the otp" required="required"   autocomplete="off" class="form-control w-50 ">
</div>

<div class="form-outline mb-4">
<input type="submit" class="bg-success  py-2 px-3 border-0 text-light" name="verify_otp" value="verify otp">


   


 


</form>

</div>
</div>
</div>
</body>
</html>

 
