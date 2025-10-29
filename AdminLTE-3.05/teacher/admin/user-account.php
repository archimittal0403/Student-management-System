<?php include('../includes/config.php')?>
<?php

if(isset($_POST['submit'])){
  $name =$_POST['name'];
  $email =$_POST['email'];
  $password =md5(123567890);
$type=$_POST['type'];

$check_query=mysqli_query($con,"SELECT * FROM accounts WHERE email='$email'");
if(mysqli_num_rows($check_query)>0){
echo "<script>alert('the user is already exist ')</script>";
}
else{
$_SESSION['success_msg']='user has been successfully registerd';
mysqli_query($con,"INSERT INTO accounts(`name`,`email`,`password`,`type`) VALUES ('$name','$email','$password','$type')"); 

 header('location: user-account.php?user='.$type);
 exit;

}
  
}
?>
<?php include('header.php')?>
<?php include('sidebar.php')?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class= "d-flex">
            <h1 class="m-0 text-dark"> Manage Accounts</h1>
            <a href="user-account.php?user=<?php echo $_REQUEST['user']?>&action=add-new" class="btn btn-primary btn-sm mx-4">Add new</a>
</div>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accounts</a></li>
              <li class="breadcrumb-item active"><?php echo ucfirst($_REQUEST['user'])?></li>
            </ol>
          </div><!-- /.col -->
          <?php
          if(isset($_SESSION['success_msg'])){?>
            <div class="col-12">
            <small class="text-success" style="font-size:19px mt-3"><?=$_SESSION['success_msg']?></small>
            </div>
          <?php
          unset($_SESSION['success_msg']);
          }
          ?>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <?php 
        if(isset($_GET['action']) && $_GET['action']){?>
        <div class="card">
<div class="card-body">

  <form action="" method="post">
    <div class="form-group">
      <input type="text" class="form-control" placeholder="Full Name" name="name">

        </div>

        <div class="form-group">
      <input type="text" class="form-control" placeholder=" Enter Email" name="email">
        </div>

      <!-- <div class="form-group">
        <button type="submit" name="submit" class="btn btn-success">Register</button>
        </div> -->
        <input type="hidden" name="type" value="<?php echo $_REQUEST['user'] ?>">
        <input type="submit" name="submit" class="btn btn-success" value="Register">
      

        </form>
        </div>
        </div>
        <?php } else { ?>
        <!-- Info boxes -->
         
        <div class="table-responsive">
          <table class="table table-bordered">
            <thread>
              <tr>
                <th>S.No</th>
                <th>Name</th>
            
                <th>Email</th>
                <th>Action</th>
</tr>
</thread>
  <tbody>

        <?php 
$count =1;
        $user_query='SELECT * FROM accounts WHERE `type`="'.$_REQUEST['user'].'"';
        $user_result=mysqli_query($con,$user_query);
        while($users=mysqli_fetch_object($user_result))
        { ?>
        <tr>
          <td><?=$count++?></td>
          <td><?=$users->Name?></td>
          <td><?=$users->email?></td>
          <td></td>
        </tr>
        
        <?php } ?>
</tbody>
</table>

       
        </div>
      

  
        <!-- /.row -->

     
      </div><!--/. container-fluid -->
      <?php } ?>
    </section>
<?php include('footer.php')?>
