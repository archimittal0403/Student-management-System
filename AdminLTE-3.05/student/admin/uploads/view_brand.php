


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> welcome</title>
<!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css link file -->
<link rel="stylesheet" href="style.css">
  </head>
  <body>
<h3 class="text-center text-primary">All Brands</h3>
<table class="table table-bordered mt-5">

<thead class="bg-info text-center">
<tr>
    <th>Sno</th>
   <th>Brands</th>
      <th>Edit</th>
         <th>Delete</th>

</tr>

</thead>
<tbody class="text-dark text-center">
    <?php
    $select_brand="Select * from `brands`";
    $result=mysqli_query($con,$select_brand);
    $number=0;
    while($row_fetch=mysqli_fetch_assoc($result)){
        $brand_id=$row_fetch['brand_id'];
        $brand_title=$row_fetch['brand_title'];
        $number++;
   ?>
    <tr class="text-center">
<td><?php echo $number ?></td>
<td><?php  echo $brand_title?></td>
<td><a href='index.php?edit_brands=<?php echo $brand_id ?>' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
<td><a href='index.php?delete_brand=<?php echo $brand_id ?>' type="button" class="btn " data-toggle="modal" data-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>
</tr>
    <?php
    }?>
</tbody>
</table>
 
 <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
       <h4>Are you sure you wants to delete it</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><a href="./index.php?view_brands" class='text-light text-decoration'>NO</button>
        <button type="button" class="btn btn-primary"><a href='./index.php?delete_brands=<?php echo $brand_id?>' type="button" class='text-light text-decoration' data-toggle="modal" data-target="#exampleModal">Yes</a></button>
      </div>
    </div>
  </div>
</div>

  </body>
  </html>