<?php
if(isset($_GET['edit_categories'])){
    $edit_category_id=$_GET['edit_categories'];
   // echo $edit_category_id;
   $select_edit="Select * from `categories` where category_id=$edit_category_id";
   $result_categories=mysqli_query($con,$select_edit);
   $row=mysqli_fetch_assoc($result_categories);
   $category_title=$row['category_title'];
   //echo $category_title;
}

if(isset($_POST['edit_cat'])){
    $cat_title=$_POST['category_title'];
   // $edit_category_id=$_GET['edit_categories'];
    $update_category="update `categories` set category_title='$cat_title' where category_id=$edit_category_id";
    $result_update=mysqli_query($con,$update_category);
    if($result_update){
        echo "<script>alert('Your categories has been succesfully updated')</script>";
        echo "<script>window.open('./index.php?view_categories.php','_self')</script>";
    }
}
    ?>

<div class="container mt-5">
    <h2 class="text-center text-primary">Edit Category</h2>
    <form action="" method="post" class="text-center">
        <label for="category_title" class="text-secondary">Category Title</label>
        <input type="text" name="category_title" id="category_title" value= " <?php echo $category_title; ?>" class="form-control w-50 m-auto mb-6" >

        <input type="submit" value="update category" name="edit_cat" class="btn btn-success px-3 mt-3">
</form>
</div>


