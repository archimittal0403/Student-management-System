<?php 
include('AdminLTE-3.05/includes/config.php')?>
<?php
include('header.php')
?>

<nav class="navbar navbar-expand-lg navar-dark bg-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="#">Pricing</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
</div>
</ul>
<ul class="navbar-nav d-flex nav-flex-icons  nav-flex-icons">
   <!-- Icon dropdown -->
    <li class="nav-item dropdown">
    <?php if(isset($_SESSION['login'])) {  ?>
      <a class="nav-link dropdown-toggle text-light mx-4" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
<i class="fas fa-user mx-3"></i>Account
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="\student management\AdminLTE-3.05\admin\dashboard.php">Dashboard</a></li>
            <li><a class="dropdown-item" href="#">Another</a></li>
            <li><a class="dropdown-item" href="logout.php">logout</a></li>
          </ul>

 <?php } else { ?>

        <a href="login.php" class="nav-link text-light"><i class="fa fa-user mx-3"></i>Login</a>
      <?php } ?>
 </li>
 </ul>
</div>
</nav>

<div class="d-flex shadow" style="height:500px;background:linear-gradient(-45deg, navy 50%, transparent 50%)">
  <div class="container-fluid my-auto ">
    <div class="row">
      <div class="col-lg-6 my-auto">
<h1 class="display-1 font-weight-bold">Addmission Open for 2025-2026</h1>
<p>This is a student manangement system portal with various blocks.</p>
<a href="" class="btn btn-md btn-primary px-3 py-2"><p class="my-1">Call to Action</p></a>
</div>
<div class="col-lg-6">
  <div class="w-50 m-auto card">
    <div class="card-body">
      <h3>Admisssion form</h3>
      <form action="" method="post">

    <div class="md-form mt-1.2">
  <input type="text" id="form1" class="form-control" />
  <label for="form1">Your Name</label>
</div>

<div class="md-form mt-1.2">
  <input type="email" id="email" class="form-control" />
  <label for="email">Your email</label>
</div>

<div class="md-form mt-1.2">
  <input type="text" id="mobile" class="form-control" />
  <label for="mobile">Your mobile</label>
</div>

<div class="md-form mt-1.2">
  <input type="text" id="class" class="form-control" />
  <label for="class">Your class</label>
</div>
<button class="btn btn-dark btn-block mt-3">Submit form </button>
</form>
</div>
</div>
</div>
</div>
  </div>
</div>

<!-- about us -->

<section class="py-5 bg-light">
  
  <div class="container">
   <div class="row">
    <div class="col-lg-6 py-4">
      <h2 class="font-weight-bold">About Us</h2>
      <div class="pr-3">
      <p>An "About Us" page for a school should convey its mission, history, values, and unique features, creating a positive impression and building trust with prospective families and students. Key elements include a mission statement, a brief history, the school's values, and possibly a timeline of milestones. Visual elements like photos and videos can also enhance the page's appeal. </p>

<p>My school is special because when my daughter was about to start 9th grade, I was so worried because I didn’t want her to go to her local high school, I’ve had bad experiences at that school and nothing got better in several years, so I started looking for other alternatives. </p>
    </div>
    <a href="about-us.php" class="btn btn-success">Know More</a>
</div>
<div class="col-lg-6">
  <img src="./assest/images/school1.avif" class="img-fluid" alt="">
</div>
   </div>
  </div>
</section>
<style>
    .course-image{
      height:190px !important;
      object-fit:cover;
     object-position:center;
     width:100%;
   
    }
    </style>

<section class="py-5">
<div class="text-center mb-5">
  <h2>Our Courses</h2>
  <p class="text-secondary">Explore Our courses and make a step towards the technology.</p>
</div>
<!-- 
child2 -->
 <div class="container">
<div class="row">
  
  <?php 
  $query= mysqli_query($con,"SELECT * FROM courses");
 while( $courses=mysqli_fetch_object($query)){?>

 

  <div class="col-lg-3">
    <div class="card mt-4">
      <div>
        <img src="./AdminLTE-3.05/admin/uploads/<?php echo $courses->image?>" class="img-fluid rounded-top course-image" alt="">
</div>
      <div class="card-body">
<b><?php echo $courses->name?></b>
<p class="card-text">
  <b>Duration: </b><?php echo $courses->duration?></br>
  <b>Price:</b> 4000/- RS
</p>
<button class="btn btn-block btn-primary ">Enroll Now</button>
      </div>
</div>
</div>
<?php } ?>
</section>

<section class=" py-5 bg-light">
<div class="text-center mb-5">
  <h2>Our Teachers</h2>
  <p class="text-secondary">Learn with our Experienced Teacher.</p>
</div>
<div class="container">
  <div class="row">
    <?php 
    for($i =0; $i<6; $i++){?>
  <div class="col-lg-4 my-5">
    <div class="card">
    <div class="col-7 position-absolute" style="top:-50px">
            <img src="./assest/images/teacher2.png" alt="" class="mw-100 border rounded-circle">
</div>
      <div class="card-body pt-5 mt-4">
      <h5>Teacher's Name</h5>
          <p class="card-text">
            <b>Courses:</b> 5</br>
           <i class="fa fa-star text-warning"></i>
<i class="fa fa-star text-warning"></i> 
<i class="fa fa-star text-warning"></i>
   <i class="fa fa-star text-warning"></i>
</p>
</div>
</div>
      </div>
      <?php } ?>
</div>
</div>



  </div>
</div>

</section>

<!-- achivement -->

<section class="py-4 text-white"  style="background:#3923a7">
<div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h2>Achivement</h2>
        <p>An achievement is a notable accomplishment, something achieved with considerable effort or skill, often signifying the completion of a challenging goal or task.</p>
      
        <img src="./assest/images/achive.png" alt="" class="img-fluid">
      </div>
      <div class="col-lg-6">
        <div class="row">
          <div class="col-lg-4 mx-5 my-4">
            <div class="border rounded text-warning my-3 text-center ">
              <div class="card-body mx-4">
<span><i class="fas fa-graduation-cap fa-2x"></i></span>
<h2 class="my-2">334</h2> 

<h3>Gradutes</h3>
    </div>
    </div>
    </div>
<!-- 
    //second card -->
    <div class="col-lg-4 mx-5 my-4">
            <div class="border rounded text-warning my-3 text-center ">
              <div class="card-body mx-4">
<span><i class="fa-solid fa-user fa-2x"></i></span>
<h2 class="my-2">234</h2> 

<h3>Placed</h3>
    </div>
    </div>
    </div>

<!-- third card -->
<div class="col-lg-4 mx-5 my-4">
            <div class="border rounded text-warning my-3 text-center ">
              <div class="card-body mx-4 my-1">
<span><i class="fa-solid fa-chalkboard-user fa-2x"></i></span>
<h2 class="my-2">124</h2> 

<h3>Teacher's</h3>
    </div>
    </div>
    </div>
<!-- fourth card -->
<div class="col-lg-4 mx-5 my-4">
            <div class="border rounded text-warning my-3 text-center ">
              <div class="card-body mx-4 my-1">
<span><i class="fa-solid fa-flask fa-2x"></i></span>
<h2 class="my-2">15</h2> 

<h3>Labs</h3>
    </div>
    </div>
    </div>

    </div>
    </div>

    </div>
  </div>
    </div>
    </section>

    <!-- testmonial -->

    <section class="py-5">
    <div class="text-center mb-5">
  <h2>What people say's</h2>
  <p class="text-secondary">Learn with our Experienced Teacher.</p>
</div>
<div class="container">
  <div class="row">
    <div class="col-6">
    <div class="border rounded  position-relative">
      <div class="p-3 text-center">
      But there's so much more to positive feedback than words of praise. When it's done right, feedback in the workplace is a form of positive reinforcement. By letting team members know when they've done well, you encourage more of that desired behavior and those good results in the future.
    </div>
    <i class="fa fa-quote-left fa-1x position-absolute" style="top:.5rem; left: .5rem;"></i>
    <div class="d-flex">
    <img src="./assest/images/teacher2.png" alt="" class="rounded-circle border" width="100" height="100">
    <h6 class="my-4 mx-3 text-primary">Name of canditate</h6>
    </div>
    </div>
    </div>

  <div class="col-6">
    <div class="border rounded  position-relative">
      <div class="p-3 text-center">
      But there's so much more to positive feedback than words of praise. When it's done right, feedback in the workplace is a form of positive reinforcement. By letting team members know when they've done well, you encourage more of that desired behavior and those good results in the future.
    </div>
    <i class="fa fa-quote-left fa-1x position-absolute" style="top:.5rem; left: .5rem;"></i>
    <div class="d-flex">
    <img src="./assest/images/teacher2.png" alt="" class="rounded-circle border" width="100" height="100">
    <h6 class="my-4 mx-3 text-primary">Name of canditate</h6>
    </div>
    </div>
    </div>
    
    </div>

</div>
    </section>

    <!-- footer -->

    <footer>
      <div class="py-5" style="background:#00000088">
        <div class="container-fluid">  
       <div class="row">
         <div class="d-flex">
    <div class="col-lg-5">
      <h5 class="text-center">Useful Link</h5>

      <ul class="fa-ul text-center">
        <li><a href="" class="text-light text-decoration-none">List icons<a></li>
        <li><a href="" class="text-light text-decoration-none">can be used<a></li>
        <li><a href="" class="text-light text-decoration-none">as bullet<a></li>
        <li><a href="" class="text-light text-decoration-none"></i>in lists<a></li>
    </ul>
    </div>
    <!-- <div class="col-lg-12"> -->
      <div class="d-flex mx-5">
      <div class="col-lg-6">
      <!-- <h5 class="text-center">Social Presence</h5> -->
       <h5>Social presence</h5>
<!-- <div class="d-flex mx-5"> -->
  <div class="d-flex">
  <span class="fa-stack">
    <i class="fa fa-circle fa-stack-2x"></i>
    <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
    </span>
   
    <span class="fa-stack">
    <i class="fa fa-circle fa-stack-2x"></i>
    <i class="fab fa-facebook fa-stack-1x fa-inverse"></i>
    </span>

    <span class="fa-stack">
    <i class="fa fa-circle fa-stack-2x"></i>
    <i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
    </span>

    <span class="fa-stack">
    <i class="fa fa-circle fa-stack-2x"></i>
    <i class="fab fa-telegram fa-stack-1x fa-inverse"></i>
    </span>
    </div> 
    </div>


    <div class="col-lg-10">
      <div class="mx-5 px-5">
<h5>Subcribe</h5> 
<form action="">
      <div class="form-group">
        <input type="email" id="email-s" class="form-control" placeholder="Enter your email">
 </div>
<button class="btn btn-primary btn-sm btn-block my-2 py-2 px-2">Submit</button>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div> 
    </footer>
    <section class="py-2 bg-primary text-light text-sm">
      <div class="container-fluid">
        Copyright 2022-2023 All Right Reserved .<a href="#" class="text-light text-decoration-none">School Management System</a>
    </div>
    </section>
<?php 
include('footer.php');
?>

