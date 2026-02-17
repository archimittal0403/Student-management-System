<?php
if(isset($_GET['delete_course'])){
    $delete_id=$_GET['delete_course'];
    $sql="DELETE  FROM `courses` where id=?";
    $query=$con->prepare($sql);
    $query->bind_param("i",$delete_id);
    $query->execute();
    if($query->affected_rows>0){
        echo "<script>alert('the course is successfully deleted')</script>";
        echo "<script>window.open('courses.php','_self')</script>";
    }
    else{
   echo "<script>alert('the course is successfully deleted')</script>";
    }
}
?>