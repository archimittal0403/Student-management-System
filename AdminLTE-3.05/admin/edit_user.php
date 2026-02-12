<?php

if(isset($_GET['edit_student'])){
    $edit_id=$_GET['edit_student'];
  $stu_class=get_usermeta($edit_id,'st_class');
  $stu_section=get_usermeta($edit_id,'st_section');
  $stu_phone=get_usermeta($edit_id,'mobile');
  $stu_dob=get_usermeta($edit_id,'dob');
$select_query=$con->prepare("SELECT * FROM `accounts` WHERE id=?");
$select_query->bind_param("i",$edit_id);
$select_query->execute();
$result=$select_query->get_result();
  $row_fetch=$result->fetch_assoc();
  $stu_name=$row_fetch['Name'];
  $stu_email=$row_fetch['email'];
    }
    if(isset($_POST['update_details'])){
        $up_class=$_POST['st_class'];
        $up_section=$_POST['st_section'];
        $up_name=$_POST['Name'];
        $up_email=$_POST['email'];
        $up_phone=$_POST['mobile'];
        $up_dob=$_POST['dob'];
       if($up_class=='' or $up_section=='' or $up_name=='' or $up_email=='' or $up_phone=='' or $up_dob==''){
      echo "<script> alert('fill up all the input feilds and then proceed futher')</script>";
    
    }
    else{
        update_usermeta($edit_id,'st_class',$up_class);
        update_usermeta($edit_id,'st_section',$up_section);
        update_usermeta($edit_id,'mobile',$up_phone);
        update_usermeta($edit_id,'dob',$up_dob);
        $update_student=$con->prepare("UPDATE `accounts` SET Name=?,email=? WHERE id=?");
$update_student->bind_param("ssi",$up_name,$up_email,$edit_id);
$update_student->execute();

    }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<style>
    .course_image{
       width:100px;
       height:100px;
       object-fit:contain;
    }
    </style>
<body>
     <h2 class="text-center">Edit the Details</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mt-6">
            <label for="st_class" class="form-label">class:-</label>
            <input type="text" id="st_class" name="st_class" class="form-control" required="required" value="<?php echo $stu_class ?>">
        </div>

          <div class="form-outline w-50 m-auto mt-4">
            <label for="st_section" class="form-label">section:-</label>
            <input type="text" id="st_section" name="st_section" class="form-control" required="required" value="<?php echo $stu_section ?>">
        </div>
 <div class="form-outline w-50 m-auto mt-4">
            <label for="Name" class="form-label">Name:-</label>
            <input type="text" id="Name" name="Name" class="form-control" required="required" value="<?php echo $stu_name ?>">
        </div>
        <div class="form-outline w-50 m-auto mt-4">
            <label for="email" class="form-label">EmailID:-</label>
            <input type="text" id="email" name="email" class="form-control" required="required" value="<?php echo $stu_email ?>">
        </div>
        <div class="form-outline w-50 m-auto mt-4">
            <label for="mobile" class="form-label">Phone no:-</label>
            <input type="text" id="mobile" name="mobile" class="form-control" required="required" value="<?php echo $stu_phone ?>">
        </div>
        <div class="form-outline w-50 m-auto mt-4">
            <label for="dob" class="form-label">DOB:-</label>
            <input type="text" id="dob" name="dob" class="form-control" required="required" value="<?php echo $stu_dob ?>">
        </div>
    <!-- <div class="form-outline w-50 m-auto mt-2">
            <label for="image" class="form-label">student Images :-</label>
            <div class="d-flex">
            <input type="file" id="image" name="image" class="form-control w-90 m-auto" required="required">
            <img src="./uploads/<?php echo $course_image?>" class="course_image">
</div>
        </div> -->

         <div class="text-center mt-4 ">
            <input type="submit" id="update_details" name="update_details" value="Update details" class="form-submit bg-success">
        </div>
</form>
</body>
</html>