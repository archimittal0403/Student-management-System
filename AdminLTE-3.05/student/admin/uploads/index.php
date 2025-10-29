<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
  
    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../style.css">
</head>
<style>
     .profile_img{
  
  width: 100px;
   
    }
    </style>
<body>
   <!-- first child -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
  <img class="photo" src="../image/photo.webp" alt="photo">
  <nav class="navbar navbar-expand-lg">
    <ul class="navbar-nav">
        <?php
//         if(!isset($_SESSION['admin_email'])){
//            // $admin_name=$_GET['admin_name'];
           
//             echo "  
//              <li class='nav-item'>
//             <a class='nav-link' href='#'>Welcome Guest</a>
// </li>";
//         }
     
//         else{
           
//   // as in this we do the concatination of two different sessions.
//  echo "<li class='nav-item'>
//   <a class='nav-link' href='#'>Welcome ".$_SESSION['admin_email']."</a>
// </li>";


//        }
//        ?>
<?php 

$admin_email=$_SESSION['admin_email'];
$admin_name=mysqli_query($con,"select * from `admin_table` where admin_email='$admin_email'");
$row_name=mysqli_fetch_array($admin_name);
$admin_name=$row_name['admin_name'];
echo "<li class='nav-item'>
   <a class='nav-link' href='#'>Welcome ".$admin_name."</a>
 </li>";

?>
    </ul>
</nav>
</div>
</nav>

<!-- second child -->
 <div class="bg-light">
    <h3 class="text-center p-2">Manage Details</h3>
</div>
<!-- third child -->
 <div class="row">
    <div class="col-md-12 bg-secondary p-1 d-flex
    align-items-center">
<div class="p-3">
    <?php
//     $admin_name= $_SESSION['admin_name'];
//     $admin_image="Select * from `admin_table` where admin_name='$admin_name'";
//     $admin_image=mysqli_query($con,$admin_image);
//     $row_image=mysqli_fetch_array($admin_image);
//     $admin_image=$row_image['admin_image'];
// echo "
//     <a href='#'><img src='./admin_images/$admin_image' alt='pineapple' class='admin_img'></a> ";

    ?>
     <?php

$admin_email=$_SESSION['admin_email'];
$admin_image="Select * from `admin_table` where admin_email='$admin_email'";
$admin_image=mysqli_query($con,$admin_image);
$row_image=mysqli_fetch_array($admin_image);
$admin_image=$row_image['admin_image'];
 echo  "<li class='nav-item'>
         <img src='./admin_images/$admin_image' class='profile_img' alt='home decor'>
        </li>";
        ?>
<!-- if(!isset($_SESSION['admin_name'])){

            echo "  
             <li class='nav-item'>
          <p class='text-light text-align-center'>Admin Name</p>
</li>";
        }
     
        else{
  // as in this we do the concatination of two different sessions.
 echo "<li class='nav-item'>
 
  <p class='text-light text-align-center'>Admin ".$_SESSION['admin_name']." </p>
</li>";


       }
       ?> -->
    
</div>


<div class="button text-center">
    <button class="my-3"><a href="insert_product.php" class="nav-link text-dark
     bg-info my-1">Insert Products</a></button>
    <button><a href="index.php?view_products" class="nav-link text-dark
     bg-info my-1">View Products</a></button>
    <button><a href="index.php?insert_categories" class="nav-link text-dark
    bg-info my-1">Insert Categories</a></button>
    <button><a href="index.php?view_categories" class="nav-link text-dark
     bg-info my-1">View Categories</a></button>
    <button><a href="index.php?insert_brand" class="nav-link text-dark
     bg-info my-1">Insert Brands</a></button>
    <button><a href="index.php?view_brand" class="nav-link text-dark
     bg-info my-1">View Brands</a></button>
    <button><a href="index.php?list_orders" class="nav-link text-dark
     bg-info my-1">All Order</a></button>
    <button><a href="index.php?all_payment" class="nav-link text-dark
     bg-info my-1">All Payments</a></button>
    <button><a href="index.php?list_user" class="nav-link text-dark
     bg-info my-1">List User</a></button>
    <button><a href="" class="nav-link text-dark
     bg-info my-1">LogOut</a></button>
</div>
</div> 
</div>

<!-- fourth child -->

<div class="container my-4">
    <?php
    if(isset($_GET['insert_category'])){
        include('insert_categories.php');
    }
?>
</div>

<!-- fifth child -->

<div class="container my-4">
    <?php
    if(isset($_GET['insert_brand'])){
        include('insert_brands.php');
    }
?>
</div>

<div class="container my-4">
    <?php
    if(isset($_GET['view_products'])){
        include('view_products.php');
    }
?>
</div>

<div class="container my-4">
    <?php
    if(isset($_GET['edit_product'])){
        include('edit_products.php');
    }
?>
</div>


<div class="container my-4">
    <?php
    if(isset($_GET['delete_product'])){
        include('delete_products.php');
    }
?>
</div>


<div class="container my-4">
    <?php
    if(isset($_GET['view_categories'])){
        include('view_categories.php');
    }
?>
</div>

<div class="container my-4">
    <?php
    if(isset($_GET['view_brand'])){
        include('view_brand.php');
    }
?>
</div>

<div class="container my-4">
    <?php
    if(isset($_GET['edit_categories'])){
        include('edit_categories.php');
    }
?>
</div>

<div class="container my-4">
    <?php
    if(isset($_GET['edit_brands'])){
        include('edit_brands.php');
    }
?>
</div>

<div class="container my-4">
    <?php
    if(isset($_GET['delete_category'])){
        include('delete_category.php');
    }
?>
</div>


<div class="container my-4">
    <?php
    if(isset($_GET['delete_brand'])){
        include('delete_brand.php');
    }
?>
</div>

<div class="container my-4">
    <?php
    if(isset($_GET['list_orders'])){
        include('list_orders.php');
    }
?>
</div>


<div class="container my-4">
    <?php
    if(isset($_GET['delete_order'])){
        include('delete_order.php');
    }
?>
</div>

<div class="container my-4">
    <?php
    if(isset($_GET['all_payment'])){
        include('all_payment.php');
    }
?>
</div>


<div class="container my-4">
    <?php
    if(isset($_GET['delete_payment'])){
        include('delete_payment.php');
    }
?>
</div>

<div class="container my-4">
    <?php
    if(isset($_GET['list_user'])){
        include('list_user.php');
    }
?>
</div>

<div class="container my-4">
    <?php
    if(isset($_GET['delete_user'])){
        include('delete_user.php');
    }
?>
</div>

<div class="container my-4">
    <?php
    if(isset($_GET['contact'])){
        include('contact.php');
    }
?>
</div>

<!-- last child -->
 <?php
 include("../includes/footer.php");
 ?> 
</div>
   <!-- bootstrap js link -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>