<?php include('includes/config.php')?>
<?php include('header.php')?>
<?php include('sidebar.php')?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Student</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-graduation-cap"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Students</span>
                <span class="info-box-number">
                  2000
              
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Teacher</span>
                <span class="info-box-number">200</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total courses</span>
                <span class="info-box-number">76</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">New Inquiries</span>
                <span class="info-box-number">2,000</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

  
        <!-- /.row -->
<hr>
     
<?php 
  date_default_timezone_set('Asia/Kolkata');

      $current_month=strtolower(date('F'));
   
      $current_year=date('Y');
$current_date=date('d');
      $sql= "SELECT * FROM `attendance` WHERE `attendance_month`='$current_month' AND year(current_session)=$current_year AND std_id=$std_id";
      $query=mysqli_query($con,$sql); 
      $row=mysqli_fetch_object($query);
      $attendance=unserialize($row->attendance_value);
      // echo '<pre>';
      // print_r($attendance);
      // echo '</pre>';
if(isset($_POST['sign-in'])){
  // this is a way to set the timezone in php by which it will work according to that time zone of which country we write
  
  $attendance[$current_date]= [
    'signin_at' =>time(),
      'signout_at' =>'',
      'date' => $current_date
  ];
 // Displaying Debugging Output: When using functions like print_r() or var_dump() to inspect arrays or objects, wrapping their output within <pre> tags
  //echo '<pre>';
  // as it will store our data in the string format
  
$att_data=serialize($attendance);
$current_month=strtolower(date('F'));


$sql="UPDATE `attendance` SET `attendance_value`='$att_data' WHERE `attendance_month`='$current_month' AND std_id=$std_id";
//print_r($sql);
mysqli_query($con,$sql) or die('db error');
}

if(isset($_POST['sign-out'])){
  $attendance[$current_date]= [
    'signin_at' =>$attendance[$current_date]['signin_at'],
      'signout_at' =>time(),
      'date' => $current_date
  ];
$att_data=serialize($attendance);
$current_month=strtolower(date('F'));


$sql="UPDATE `attendance` SET `attendance_value`='$att_data' WHERE `attendance_month`='$current_month' AND std_id=$std_id";
//print_r($sql);
mysqli_query($con,$sql) or die('db error');
}
?>
        <div class="row">
          <div class="col-lg-3">
            <div class="card">
              <div class="card-header">
                Sign in Info
              </div>
              <div class="card-body">
                <form action="" method="post">
                  <?php
                  if(empty($attendance[$current_date]['signin_at']) || $attendance[$current_date]['signout_at']){
                    echo "
                  <button  name='sign-in' class='btn btn-primary'>Sign In </button>";
                  }
                  else{
echo " <button  name='sign-out' class='btn btn-primary'>Sign Out </button>";
                  }
                  ?>
                </form>
              </div>
            </div>
          </div>
</div>

      </div><!--/. container-fluid -->
    </section>
<?php include('footer.php')?>
