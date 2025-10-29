<?php
if(isset($_GET['delete_category'])){
    $delete_id=$_GET['delete_category'];
    $delete_cat="Delete  from `categories` where category_id=$delete_id";
    $result_delete=mysqli_query($con,$delete_cat);

     if($result_delete){
            echo "<script>alert('categories has been sucessfully deleted')</script>";
     echo "<script>window.open('./index.php?view_categories','_self')</script>";
     }
}
?>