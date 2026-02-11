<?php
include('header.php')
?>
<?php
session_start();  // MUST have this to use $_SESSION['CODE']
include('includes/config.php'); // or wherever your DB config is
?>

<section class=" py-2 bg-light vh-100 d-flex">

    <div class="col-4 m-auto">
        <h2 class="text-center my-3">LOGIN</h2>
        
            <div class="card-body">
                <div class="card px-2"> 
                    <div class="text-center my-1"><span class="fa-stack fa-lg">
                        <!-- <i class="fa fa-circle fa-stack-2x"></i> -->
                        <!-- <i class="fa fa-user fa-stack-1x text-light"></i>  -->
                         <img src="./assest/images/akg-logo.png" alt=""  width="50" height="50">  
</span></div>     
                <form action="actions/login.php" method="POST">
                    <div class="form-group">
                        <h5 class="mx-2">Email</h5>
                    <input type="email" id="email" name="email" class="form-control my-3 mx-1" placeholder="Enter your email">
                 
</div>

<div class="form-group">
<h5 class="mx-2">Password</h5>
                    <input type="password" id="password" name="password" class="form-control mx-1 mb-4" placeholder="Enter your email">
                 
</div>

 <div class="form-outline mb-4">
        <label for="user_username" class="form-label">Enter the Captcha Code</label>
        <input type="text"  class="form-control" placeholder="Enter your captcha" autocomplete="off" required="required" name="captcha" id="captcha"/>
</div>

<div><img src="captcha.php"><a href="" class="mx-3">Refresh</a></div> 
<div class="text-center">
<button class="btn btn-primary mb-3 px-4" name="login">Login</button>
</div>
</form>

</div>
</div>
</div>
<?php 
include('footer.php')
?>