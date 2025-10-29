<?php
include('../includes/connect.php');
//now we will insert our category inside our database
if(isset($_POST['insert_brand'])){
  $brand_title=$_POST['brand_title'];
  
  //now we will check the wheather the category is already inserted or not 
  $select_query="Select * from `brands` where brand_title='$brand_title'";
  $result_select=mysqli_query($con,$select_query);
  $number=mysqli_num_rows($result_select);
  if($number>0){
    echo "<script>alert('brand is already presentn inside our database')</script>";
  }
else{


  //insert the category
  $insert_query="insert into `brands` (brand_title) values('$brand_title')";
  $result=mysqli_query($con,$insert_query);
  if($result){
  echo "<script>alert('brand has been inserted succesfully')</script>";
  }
}
}
?>
<h2 class="text-center">Insert Brand</h2>
<form action ="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-primary" id="basic-addon1"><i class="fa-solid
fa-receipt"></i></span>
  <input type="text" class="form-control" name="brand_title"  placeholder="Insert Brands" aria-label="brands" aria-describedby="basic-addon1">
</div>

<div class="input-group w-10 mb-2 m-auto">
<input type="submit" class="bg-info border-0 p-2 my-3" name="insert_brand"  value="Insert Brands">  

</div>
</form>