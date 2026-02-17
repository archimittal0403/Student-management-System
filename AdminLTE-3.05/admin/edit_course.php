<?php 
if(isset($_GET['edit_course'])){
    $edit_id=$_GET['edit_course'];
    $edit_query=$con->prepare("SELECT * from `courses` WHERE id='$edit_id'");
        $edit_query=$con->prepare("SELECT * from `courses` WHERE id=?");
        $edit_query->bind_param("i",$edit_id);
    $edit_query->execute();
    $result=$edit_query->get_result();
    $row_fetch=$result->fetch_assoc();
    $course_name=$row_fetch['name'];
    $category=$row_fetch['category'];
    $duration=$row_fetch['duration'];
    $course_image=$row_fetch['image'];
}
?>


<?php
if(isset($_POST['update_course'])){
    $course_name=$_POST['name'];
    $category=$_POST['category'];
    $duration=$_POST['duration'];
    $course_image=$_FILES['image']['name'];
    $temp_image=$_FILES['image']['tmp_name'];

    if($course_name=='' or $category=='' or $duration=='' or $course_image==''){
      echo "<script> alert('fill up all the input feilds and then proceed futher')</script>";
    
    }
else{
    move_uploaded_file($temp_image,"./uploads/$course_image");
    
   $update_query="UPDATE `courses` set  name='$course_name', category='$category', duration='$duration', image='$course_image' where id=$edit_id";
$update_query=$con->prepare("UPDATE `courses` set  name=?, category=?, duration=?, image=? where id=?");
$update_query->bind_param("ssssi",$course_name,$category,$duration,$course_image,$edit_id);

   if($update_query->execute()){
     echo "<script>alert('course are succesfully updated')</script>";
                echo "<script>window.open('course.php','_self')</script>";
   }
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
     <h2 class="text-center">Edit your course</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mt-6">
            <label for="name" class="form-label">Course Title:-</label>
            <input type="text" id="name" name="name" class="form-control" required="required" value="<?php echo $course_name ?>">
        </div>

          <div class="form-outline w-50 m-auto mt-4">
            <label for="category" class="form-label">category:-</label>
            <input type="text" id="category" name="category" class="form-control" required="required" value="<?php echo $category ?>">
        </div>
 <div class="form-outline w-50 m-auto mt-4">
            <label for="duration" class="form-label">Duration:-</label>
            <input type="text" id="duration" name="duration" class="form-control" required="required" value="<?php echo $duration ?>">
        </div>
    <div class="form-outline w-50 m-auto mt-2">
            <label for="image" class="form-label">course Images :-</label>
            <div class="d-flex">
            <input type="file" id="image" name="image" class="form-control w-90 m-auto" required="required">
            <img src="./uploads/<?php echo $course_image?>" class="course_image">
</div>
        </div>

         <div class="text-center mt-4 ">
            <input type="submit" id="update_course" name="update_course" value="Update courses" class="form-submit bg-success">
        </div>
</form>
</body>
</html>