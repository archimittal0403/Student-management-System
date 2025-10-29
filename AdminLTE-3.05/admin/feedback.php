<?php include('../includes/config.php')?>

<?php 
if(isset($_POST['submit']))
{
$roll_number=isset($_POST['roll'])?$_POST['roll']:'';
$student_name=isset($_POST['name'])?$_POST['name']:'';
$student_name=isset($_POST['name'])?$_POST['name']:'';
 $class_id=$_POST['class'];
  $section_id=$_POST['section'];
  $subject_id=$_POST['subject_id'];
  $teacher_id=$_POST['teacher_id'];
$rating=$_POST['rate'];


$query=mysqli_query($con, "INSERT INTO `feedback` (`roll_number`,`student_name`,`class`,`section`,`subject_name`,`teacher_name`,`rating`) VALUES('$roll_number','$student_name','$class_id','$section_id','$subject_id','$teacher_id','$rating')");


if($query){
    echo "sucessfully submit";
}
else{
    echo "their is the problem in saving the data";
}
}
?>
<?php include('header.php')?>
<?php include('sidebar.php')?>
<?php include('../includes/functions.php')?>


<?php 

// if(isset($_POST['submit'])){
//     $title=$_POST['title'];
//     mysqli_query($con,"INSERT INTO section (title) VALUE ('$title')");
// }
?>

    <div class="content-header">
         <div class="container-fluid">
        <div class="row ">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Fill Feedback :-</h1>
</div>
             <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Student</a></li>
              <li class="breadcrumb-item active">feedback</li>
            </ol>
          </div><!-- /.col -->

</div>
</div>
    </div>
<section>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
            <div class="row">
                <div class="col-lg-3">
                    <form action="" method="POST">
                    <div class="form-group">   
                         <h5>Roll num</h5>
        <input type="text" name="roll" id=""   placeholder="fill roll_no" required-class="form-control">
</div>
</div>
  <div class="col-lg-3">
<form action="" method="POST">
                 <div class="form-group">
                          <h5>Student name</h5>
        <input type="text" name="name" id=""   placeholder="fill student_name" required-class="form-control">
</div>
</div>


        <div class="col-lg-3">
<div class="form-group">
 <label for="class">Select class:-</label>
    <select require name="class" id="class" class="form-control">
        <option value="">select class</option>

             <?php
      $args = array(
        'type' => 'class',
        'status' =>'publish',
      );
 
        $classes=get_posts($args); 
        foreach($classes as $key => $class) { ?>
<option value="<?php echo $class->id ?>"><?php echo $class->title ?></option>
<?php } ?>
    </select>
     

        </div>
            </div>
            <div class="col-sm-3">
                 <div class="form-group" id="section-container" >
    <label for="section">Select Section:-</label>
    <select require name="section" id="section" class="form-control">
        <option value="">Select section</option>
    </select>
    </div>
            </div> 
        </div>
        </div>          

 

    <div class="row">
        <div class="col-lg-3">
           <div class="form-group " id="section-container">
    <label for="subject_id">Select Subject:-</label>
    <select require name="subject_id" id="subject_id" class="form-control">
        <option value="">Select subject</option>
        <option value="9">English</option>
        <option value="10">Science</option>
          <option value="11">none</option>
    </select>
    </div>
        </div>


              <div class="col-lg-3">
                 <div class="form-group" id="section-container">
    <label for="teacher_id">Select Teacher:-</label>
    <select require name="teacher_id" id="teacher_id" class="form-control">
        <option value="">Select teacher</option>
        <option value="1">Teacher 1</option>
        <option value="2">Teacher 2</option>
          <option value="3">none</option>
    </select>
    </div>
            </div> 

  

    </select>

           <div class="col-lg-4">
                 <div class="form-group" id="section-container">
    <label for="rate">Rating:-</label>
    <select require name="rate" id="rate" class="form-control">
        <option value="">Select Rate</option>
        <option value="1"> 1</option>
        <option value="2"> 2</option>
         <option value="3"> 3</option>
          <option value="4"> 4</option>
           <option value="5"> 5</option>
           <option value="6"> none</option>
    </select>
    </div>
            </div> 
    </div>

    <!-- second row -->

     <div class="row">
        <div class="col-lg-3">
           <div class="form-group " id="section-container">
    <label for="subject_id">Select Subject:-</label>
    <select require name="subject_id" id="subject_id" class="form-control">
        <option value="">Select subject</option>
        <option value="9">English</option>
        <option value="10">Science</option>
          <option value="11">none</option>
    </select>
    </div>
        </div>


              <div class="col-lg-3">
                 <div class="form-group" id="section-container">
    <label for="teacher_id">Select Teacher:-</label>
    <select require name="teacher_id" id="teacher_id" class="form-control">
        <option value="">Select teacher</option>
        <option value="1">Teacher 1</option>
        <option value="2">Teacher 2</option>
          <option value="3">none</option>
    </select>
    </div>
            </div> 

  

    </select>

           <div class="col-lg-4">
                 <div class="form-group" id="section-container">
    <label for="rate">Rating:-</label>
    <select require name="rate" id="rate" class="form-control">
        <option value="">Select Rate</option>
        <option value="1"> 1</option>
        <option value="2"> 2</option>
         <option value="3"> 3</option>
          <option value="4"> 4</option>
           <option value="5"> 5</option>
           <option value="6"> none</option>
    </select>
    </div>
            </div> 
    </div>

    <!-- third row -->

     <div class="row">
        <div class="col-lg-3">
           <div class="form-group " id="section-container">
    <label for="subject_id">Select Subject:-</label>
    <select require name="subject_id" id="subject_id" class="form-control">
        <option value="">Select subject</option>
        <option value="9">English</option>
        <option value="10">Science</option>
          <option value="11">none</option>
    </select>
    </div>
        </div>


              <div class="col-lg-3">
                 <div class="form-group" id="section-container">
    <label for="teacher_id">Select Teacher:-</label>
    <select require name="teacher_id" id="teacher_id" class="form-control">
        <option value="">Select teacher</option>
        <option value="1">Teacher 1</option>
        <option value="2">Teacher 2</option>
          <option value="3">none</option>
    </select>
    </div>
            </div> 

  

    </select>

           <div class="col-lg-4">
                 <div class="form-group" id="section-container">
    <label for="rate">Rating:-</label>
    <select require name="rate" id="rate" class="form-control">
        <option value="">Select Rate</option>
        <option value="1"> 1</option>
        <option value="2"> 2</option>
         <option value="3"> 3</option>
          <option value="4"> 4</option>
           <option value="5"> 5</option>
           <option value="6"> none</option>
    </select>
    </div>
            </div> 
    </div>


    <!-- forth row -->

     <div class="row">
        <div class="col-lg-3">
           <div class="form-group " id="section-container">
    <label for="subject_id">Select Subject:-</label>
    <select require name="subject_id" id="subject_id" class="form-control">
        <option value="">Select subject</option>
        <option value="9">English</option>
        <option value="10">Science</option>
          <option value="11">none</option>
    </select>
    </div>
        </div>


              <div class="col-lg-3">
                 <div class="form-group" id="section-container">
    <label for="teacher_id">Select Teacher:-</label>
    <select require name="teacher_id" id="teacher_id" class="form-control">
        <option value="">Select teacher</option>
        <option value="1">Teacher 1</option>
        <option value="2">Teacher 2</option>
          <option value="3">none</option>
    </select>
    </div>
            </div> 

  

    </select>

           <div class="col-lg-4">
                 <div class="form-group" id="section-container">
    <label for="rate">Rating:-</label>
    <select require name="rate" id="rate" class="form-control">
        <option value="">Select Rate</option>
        <option value="1"> 1</option>
        <option value="2"> 2</option>
         <option value="3"> 3</option>
          <option value="4"> 4</option>
           <option value="5"> 5</option>
           <option value="6"> none</option>
    </select>
    </div>
            </div> 
    </div>


    <!-- fifth row -->

     <div class="row">
        <div class="col-lg-3">
           <div class="form-group " id="section-container">
    <label for="subject_id">Select Subject:-</label>
    <select require name="subject_id" id="subject_id" class="form-control">
        <option value="">Select subject</option>
        <option value="9">English</option>
        <option value="10">Science</option>
          <option value="11">none</option>
    </select>
    </div>
        </div>


              <div class="col-lg-3">
                 <div class="form-group" id="section-container">
    <label for="teacher_id">Select Teacher:-</label>
    <select require name="teacher_id" id="teacher_id" class="form-control">
        <option value="">Select teacher</option>
        <option value="1">Teacher 1</option>
        <option value="2">Teacher 2</option>
          <option value="3">none</option>
    </select>
    </div>
            </div> 

  

    </select>

           <div class="col-lg-4">
                 <div class="form-group" id="section-container">
    <label for="rate">Rating:-</label>
    <select require name="rate" id="rate" class="form-control">
        <option value="">Select Rate</option>
        <option value="1"> 1</option>
        <option value="2"> 2</option>
         <option value="3"> 3</option>
          <option value="4"> 4</option>
           <option value="5"> 5</option>
           <option value="6"> none</option>
    </select>
    </div>
            </div> 
    </div>


    <!-- sixth row -->

     <div class="row">
        <div class="col-lg-3">
           <div class="form-group " id="section-container">
    <label for="subject_id">Select Subject:-</label>
    <select require name="subject_id" id="subject_id" class="form-control">
        <option value="">Select subject</option>
        <option value="9">English</option>
        <option value="10">Science</option>
          <option value="11">none</option>
    </select>
    </div>
        </div>


              <div class="col-lg-3">
                 <div class="form-group" id="section-container">
    <label for="teacher_id">Select Teacher:-</label>
    <select require name="teacher_id" id="teacher_id" class="form-control">
        <option value="">Select teacher</option>
        <option value="1">Teacher 1</option>
        <option value="2">Teacher 2</option>
          <option value="3">none</option>
    </select>
    </div>
            </div> 

  

    </select>

           <div class="col-lg-4">
                 <div class="form-group" id="section-container">
    <label for="rate">Rating:-</label>
    <select require name="rate" id="rate" class="form-control">
        <option value="">Select Rate</option>
        <option value="1"> 1</option>
        <option value="2"> 2</option>
         <option value="3"> 3</option>
          <option value="4"> 4</option>
           <option value="5"> 5</option>
           <option value="6"> none</option>
    </select>
    </div>
            </div> 
    </div>

            </div> 
        </div>
   
      <button name="submit" class="btn btn-success ">
        Submit
   </button>

        </div>
        </div>
      
</section>
<?php include('footer.php')?>
