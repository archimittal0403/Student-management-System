<?php
session_start();
include('includes/config.php');
?>
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
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
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
                <?php 
               $college_id = $_SESSION['college_id'];
             
                $query=$con->prepare(
                  "SELECT * FROM `accounts` WHERE type='student' AND college_id=?"
                );
                $query->bind_param("i",$college_id);
              $query->execute();
              $result=$query->get_result();
                $row_count=$result->num_rows;
                ?>
                <span class="info-box-text">Total Students</span>
                <span class="info-box-number">
              <?php 
              echo $row_count ;
              ?>
              
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
                   <?php 
              
                $query = $con->prepare("SELECT * FROM accounts WHERE type='teacher' AND college_id=?");
                $query->bind_param("i",$college_id);
                $query->execute();
                $result=$query->get_result();
                $row_count=$result->num_rows;
                ?>
                <span class="info-box-text">Total Teacher</span>
                <span class="info-box-number"><?php 
              echo $row_count ;
              ?></span>
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
                <?php 
            
                $query = $con->prepare("SELECT * FROM courses WHERE college_id=?");
                $query->bind_param("i",$college_id);
                $query->execute();
                $result=$query->get_result();
                $row_count=$result->num_rows;
                ?>
                <span class="info-box-text">Total courses</span>
                <span class="info-box-number">  <?php 
              echo $row_count ;
              ?></span>
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
               
                <?php 
               
                $query=$con->prepare("SELECT * FROM `posts` WHERE type='class' AND college_id=?");
                $query->bind_param("i",$college_id);
                $query->execute();
                $result=$query->get_result();
$row_count=$result->num_rows;
                ?>
                 <span class="info-box-text">Total Classes</span>
                <span class="info-box-number"><?php
                echo $row_count
                ?></span>
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
   
<div class="card">
   <div class="card-header"> 
    <h3 class="card-title">My Calendar</h3> 
  </div> 
  <div class="card-body">
     <div id="calendar" style="min-height: 600px;">

     </div>
     </div>
      </div><!--/. container-fluid -->
        
    </section>
     <?php include('footer.php')?> 

