

<?php
if(isset($_GET['edit_product'])){
    $edit_id=$_GET['edit_product'];
    //echo $edit_id;
    $get_edit="Select * from `products` where product_id=$edit_id";
    $result=mysqli_query($con,$get_edit);
    $row_fetch=mysqli_fetch_assoc($result);
$product_title=$row_fetch['product_title'];
//echo $product_title;
$product_desc=$row_fetch['product_description'];
$product_keyword=$row_fetch['product_keyword'];
$category_id=$row_fetch['category_id'];
$brand_id=$row_fetch['brand_id'];
$product_image1=$row_fetch['product_image1'];
$product_image2=$row_fetch['product_image2'];
$product_image3=$row_fetch['product_image3'];
$product_price=$row_fetch['product_price'];

$select_category="Select * from `categories` where category_id=$category_id";
$result_category=mysqli_query($con,$select_category);
$row_category=mysqli_fetch_assoc($result_category);
$category_title=$row_category['category_title'];

$select_brand="Select * from `brands` where brand_id=$brand_id";
$result_brand=mysqli_query($con,$select_brand);
$row_brand=mysqli_fetch_assoc($result_brand);
$brand_title=$row_brand['brand_title'];


}
?>


<?php 

if(isset($_POST['update_product'])){
  $product_title=$_POST['product_title'];
  $product_desc=$_POST['product_description'];
  $product_keyword=$_POST['product_keyword'];
    $product_category=$_POST['product_category'];
      $product_brand=$_POST['product_brand'];
       $product_price=$_POST['product_price'];


        $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];
       $product_image3=$_FILES['product_image3']['name'];
         


        $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
       $temp_image3=$_FILES['product_image3']['tmp_name'];


       if($product_title=='' or $product_desc=='' or $product_keyword=='' or $product_category==''  or $product_brand=='' or 
       $product_image1=='' or $product_image2=='' or $product_image3=='' or $product_price==''){
         echo "<script> alert('fill up all the input feilds and then proceed futher')</script>";
       }
       else{
        move_uploaded_file($temp_image1,"./product_images/image/$product_image1");
      move_uploaded_file($temp_image2,"./product_images/image/$product_image2");
            move_uploaded_file($temp_image3,"./product_images/image/$product_image3");

            $update_product="update `products` set product_title='$product_title', product_description='$product_desc',product_keyword='$product_keyword',category_id='$product_category', brand_id='$product_brand',product_image1='$product_image1',product_image2='$product_image2',
            product_image3='$product_image3',product_price='$product_price',date=NOW() where product_id=$edit_id";
            $result_update=mysqli_query($con,$update_product);
            if($result_update){
              echo "<script>alert('product are succesfully updated')</script>";
                echo "<script>window.open('./insert_product.php','_self')</script>";
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
    .edit_image1{
       width:100px;
       height:100px;
       object-fit:contain;
    }
    </style>
<body>
    <h2 class="text-center">Edit your products</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mt-6">
            <label for="product_title" class="form-label">Product Title:-</label>
            <input type="text" id="product_title" name="product_title" class="form-control" required="required" value="<?php echo $product_title ?>">
        </div>

          <div class="form-outline w-50 m-auto mt-4">
            <label for="product_description" class="form-label">Product Description:-</label>
            <input type="text" id="product_description" name="product_description" class="form-control" required="required" value="<?php echo $product_desc ?>">
        </div>

      
          <div class="form-outline w-50 m-auto mt-4">
            <label for="product_keyword" class="form-label">Product Keywords:-</label>
            <input type="text" id="product_keyword" name="product_keyword" class="form-control" required="required" value="<?php echo $product_keyword ?>">
        </div>  

        <div class="form-outline w-50 m-auto mt-4">
             <label for="product_category" class="form-label">Product categories:-</label>
        <select name="product_category" class="form-select">
             <option value="">Select ctegory</option>
          <option value="<?php echo $category_title ?>"><?php echo $category_title?></option>
          <?php
$select_category_all="Select * from `categories`";
$result_category_all=mysqli_query($con,$select_category_all);
while($row_category_all=mysqli_fetch_assoc($result_category_all)){
  $category_title=$row_category_all['category_title'];
    $category_id=$row_category_all['category_id'];
    echo " <option value='$category_id'>$category_title</option>";
};

?>

       
</select>
        </div> 

  <div class="form-outline w-50 m-auto mt-4">
             <label for="product_brand" class="form-label">Product Brands:-</label>
        <select name="product_brand" class="form-select">
             <option value="">Select Brands</option>
          <option value="<?php echo $brand_title ?>"><?php echo $brand_title ?></option>
          <?php 

$select_brand_all="Select * from `brands`";
$result_brand_all=mysqli_query($con,$select_brand_all);
while($row_brand_all=mysqli_fetch_assoc($result_brand_all)) {
  $brand_title=$row_brand_all['brand_title'];
  $brand_id=$row_brand_all['brand_id'];
  echo "<option value='$brand_id'>$brand_title</option>";
};
?>
</select>
        </div> 

         <div class="form-outline w-50 m-auto mt-2">
            <label for="product_image1" class="form-label">Product Images 1:-</label>
            <div class="d-flex">
            <input type="file" id="product_image1" name="product_image1" class="form-control w-90 m-auto" required="required">
            <img src="./product_images/<?php echo $product_image1?>" class="edit_image1">
</div>
        </div>
        
   <div class="form-outline w-50 m-auto mt-2">
            <label for="product_image2" class="form-label">Product Images 2:-</label>
            <div class="d-flex">
            <input type="file" id="product_image2" name="product_image2" class="form-control w-90 m-auto" required="required">
            <img src="./product_images/image/<?php echo $product_image2?>" class="edit_image1">
</div>
        </div>


          <div class="form-outline w-50 m-auto mt-2">
            <label for="product_image3" class="form-label">Product Images 3:-</label>
            <div class="d-flex">
            <input type="file" id="product_image3" name="product_image3" class="form-control w-90 m-auto" required="required">
            <img src="./product_images/image/<?php echo $product_image3?>" class="edit_image1">
</div>
        </div>

        
          <div class="form-outline w-50 m-auto mt-2">
            <label for="product_price" class="form-label">Product Price:-</label>
            <input type="text" id="product_price" name="product_price" class="form-control" required="required" value="<?php echo $product_price ?>">
        </div>  

        <div class="text-center mt-4 ">
            <input type="submit" id="update_product" name="update_product" value="Update Products" class="form-submit bg-info">
        </div>
</form>
</body>
</html>