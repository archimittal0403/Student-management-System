<?php
session_start();
include('includes/config.php');
include('includes/functions.php');
?>



<?php

if(isset($_POST['type']) && $_POST['type']=='teacher' && isset($_POST['email']) && !empty($_POST['email'])){
  
if (empty($_SESSION['college_id'])) {
  echo "college_id session missing";
  exit;
}
}

 $user= $_GET['user'] ?? '';


?>

<?php include('header.php')?>
<?php include('sidebar.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dahboard</title>
</head>
<body>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class= "d-flex">
            <h1 class="m-0 text-dark"> Manage Accounts</h1>
            <a href="teacher.php?user=<?php echo $user; ?>&action=add-new"
   class="btn btn-primary btn-sm mx-4">Add new</a>
   </div>
          </div><!-- /.col -->
           <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accounts</a></li>
              <li class="breadcrumb-item active"><?php echo ucfirst($user); ?></li>

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
          <section class="content">
            <div class="container-fluid">
                <?php
                if(isset($_GET['action'])){
                  $class_id=$_GET['class'] ?? '';
                  $section_id=$_GET['section'] ?? '';
?>
                <div class="card">
                    <div class="card-body" id="form-container">
<?php  if($_GET['action']=='add-new'){?>
<form action="" id="teacher" method="post" enctype="multipart/form-data">

  <input type="hidden" name="type" value="teacher">
<div class="border border-top border-dark ">
        <feildset class="form-group">
          <legend class="mt-2 p-1 ml-2 mb-1"> Personal Information: </legend>
          <div class="row">
            <div class="col-lg-12">
            <div class="form-group m-2">
              <label for="name">Full Name -</label>
      <input type="text" class="form-control" id="name" placeholder="Full Name" name="name" autocomplete="given-name"/>
        </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group m-2">
            <label for="email">Email-</label>
               
      <input type="text" class="form-control" id="email" placeholder="email" name="email"/>
      
        </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group m-2">
              <label for="mobile">Phone no-</label>
      <input type="text" class="form-control" id="mobile" placeholder="Mobile no" name="mobile"/>
        </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group m-2">
              <label for="address"> Address-</label>
      <input type="text"  class="form-control" id="address" placeholder="Enter Address" name="address" autocomplete="off"/>
        </div>
        </div>

        <!-- Adress -->

              <div class="col-lg-6">
            <div class="form-group m-2">
              <label for="dob">DOB -</label>
      <input type="date" class="form-control" id="dob" placeholder="dob" name="dob" autocomplete="off"/>
        </div>
        </div>

         <div class="col-lg-2">
          <div class="form-group m-2">
              <label for="gender">Gender-</label>
      <input type="text" class="form-control" id="gender" placeholder="gender" name="gender" autocomplete="off"/>
        </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group m-2">
              <label for="image">Photo-</label>
      <input type="file" class="form-control" id="image" name="image" autocomplete="off"/>
        </div>
        </div>
       
      
        </div>
  <legend class="mt-2 p-1 ml-2 mb-1"> Academic Information: </legend>

<div class="row">
  <div class="col-lg-6">
     <div class="form-group m-2">
              <label for="qualification">Qualification -</label>
      <input type="text" class="form-control" id="qualification" placeholder="Qualification" name="qualification" autocomplete="given-name"/>
        </div>
  </div>
  <div class="col-lg-6">
     <div class="form-group m-2">
              <label for="experience">Experience -</label>
      <input type="text" class="form-control" id="experience" placeholder="Experience in number" name="experience" autocomplete="given-name"/>
        </div>
  </div>
</div>
<div class="row">
    <div class="col-lg-3">
     <div class="form-group m-2">
              <label for="doj">Date of joining -</label>
      <input type="date" class="form-control" id="doj" placeholder="Experience in number" name="doj" autocomplete="given-name"/>
        </div>
  </div>

   <div class="col-lg-3">
     <div class="form-group m-2">
              <label for="class">Select class</label>
      <!-- <input type="text" class="form-control" id="class" placeholder="Select class" name="class" autocomplete="given-name"/> -->
       <select name="class" id="class" class="form-control">

       <?php
       $args=array(
        'type'=>'class',
        'status'=>'publish'
       );
$classes=get_posts($args);
foreach($classes as $key=> $class){
  $selected=($class_id==$class->id)?'selected':'';
echo '<option value="'.$class->id.'" '.$selected.'>'. $class->title.'</option>';
}
       ?>
       </select>
        </div>
  </div>

   <div class="col-lg-3">
     <div class="form-group m-2">
              <label for="section">Select section -</label>
              <select name="section" id="section" class="form-control">
<?php
$args=array(
  'type'=>'section',
  'status'=>'publish'
);
$sections=get_posts($args);
foreach($sections as $key=>$section){
  $selected=($section_id==$section->id)?'selected':'';
  echo '<option value="'.$section->id.'" '.$selected.'>'. $section->title.'</option>';
}
?>
</select>
        </div>
  </div>
   <div class="col-lg-3">
     <div class="form-group m-2">
              <label for="subject">Select Subject </label>
   <select name="subject" id="subject" class="form-control">
    <?php
    $college_id=$_SESSION['college_id'];
    $select=mysqli_query($con,"SELECT * FROM `courses` WHERE college_id='$college_id'");
    while($row_fetch=mysqli_fetch_assoc($select)){
     echo '<option value="'.$row_fetch['id'].'">'.$row_fetch['name'].'</option>';
    }
    ?>
   </select>
        </div>
  </div>
</div>

 <legend class="mt-2 p-1 ml-2 mb-1"> Bank Details: </legend>
<div class="row">
   <div class="col-lg-3">
     <div class="form-group m-2">
              <label for="salary">Salary -</label>
      <input type="text" class="form-control" id="salary"  name="salary" autocomplete="given-name"/>
        </div>
  </div>
  <div class="col-lg-3">
     <div class="form-group m-2">
              <label for="bank">Bank Name -</label>
      <input type="text" class="form-control" id="bank"  name="bank" autocomplete="given-name"/>
        </div>
  </div>

    <div class="col-lg-3">
     <div class="form-group m-2">
              <label for="aco">Account NO -</label>
      <input type="text" class="form-control" id="aco"  name="aco" autocomplete="given-name"/>
        </div>
  </div>

   <div class="col-lg-3">
     <div class="form-group m-2">
              <label for="ifsc">IFSC -</label>
      <input type="text" class="form-control" id="ifsc"  name="ifsc" autocomplete="given-name"/>
        </div>
  </div>
</div>


        </feildset>

       <input type="submit" name="submit" class="btn btn-primary mt-1 mb-1 ml-1" id="submit" value="Register"> 
</form>


                    </div>
                </div>
                <?php } ?>
                <?php } else { ?>
                <div class="card">
                  <div class="card-body">
                    <form action="teacher_detail.php" method="get">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="teacher_id">Teacher ID</label>
                            <input type="text" id="teacher_id" name="teacher_id" placeholder="Enter your ID" class="form-control">
                          </div>
                        </div>
                        <div class="col-lg-6">
                           <div class=" justify-content-end">
                            <button type="submit" class="btn btn-danger">Apply</button>
</div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
             <?php  }?>
            </div>
</div>
          </section>

</body>
</html>
<?php include('footer.php')?>
<script>

jQuery('#teacher').on('submit', function(e){
  e.preventDefault();

  var formData = new FormData(this);

  jQuery.ajax({
    type: 'POST',
    url: 'teacher_action.php?user=teacher',
    data: formData,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function(response){
      console.log(response);

      if(response.success){
        location.href =
          'teacher.php?user=teacher&action=fee-payment'
          + '&std_id=' + response.std_id;
      } else {
        alert(response.message || 'Something went wrong');
      }
    },
    error: function(xhr){
      console.log(xhr.responseText);
      alert('AJAX failed – check console');
    }
  });
});
</script>

