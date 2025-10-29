<?php
if(isset($_GET['delete_brand'])){
    $delete_brand_id=$_GET['delete_brand'];
    $delete_brand="Delete  from `brands` where brand_id=$delete_brand_id";
    $result_delete=mysqli_query($con,$delete_brand);

     if($result_delete){
            echo "<script>alert('Brands has been sucessfully deleted')</script>";
     echo "<script>window.open('./index.php?view_brands','_self')</script>";
     }
}
?>