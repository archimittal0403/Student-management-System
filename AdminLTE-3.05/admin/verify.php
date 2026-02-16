
<?php
 include('includes/config.php');
//include('includes/function.php');
session_start();
?> 

<?php
// Form submit check
if(isset($_POST['verify_otp'])){

    // Ensure email session exists
    if(!isset($_SESSION['email'])){
        header("Location: login.php?msg=Session expired");
        exit();
    }

    $user_otp = trim($_POST['user_otp']);
    $user_email = $_SESSION['email'];

    // DB query to check OTP
    $stmt = $con->prepare("SELECT * FROM accounts WHERE email=? AND user_otp=?");
    $stmt->bind_param("ss", $user_email, $user_otp);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        // OTP correct
       $user = $result->fetch_assoc();  
        $_SESSION['login'] = true;         // MUST
        $_SESSION['user_type'] = 'admin';  // ya jo type hai DB me
      
        $_SESSION['user_id'] = $user['id']; // optional
          $_SESSION['college_id'] = $user['college_id'];   // 🔥 ADD THIS
        // delete OTP
        $stmt2 = $con->prepare("UPDATE accounts SET user_otp=NULL WHERE email=?");
        $stmt2->bind_param("s", $user_email);
        $stmt2->execute();

        // set cokkies 
        if(isset($_POST['remember'])){
            setcookie("email","$user_email",time()+86400,"/");
        }

        header("Location: dashboard.php");  // redirect
        exit();
    } else {
        $_SESSION['error_msg'] = "Invalid OTP";
        header("Location: login.php");
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
<input type="checkbox" name="remember">Remember Me

<div class="form-outline mb-4">
<input type="submit" class="bg-success  py-2 px-3 border-0 text-light" name="verify_otp" value="verify otp">


   


 


</form>

</div>
</div>
</div>
</body>
</html>

 
