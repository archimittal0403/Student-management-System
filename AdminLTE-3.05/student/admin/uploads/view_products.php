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
<body>
    <h2 class="text-center">All  Products</h2>
  <table class="table table-bordered mt-4">
        <thead class="bg-primary">
            <tr>
                <th>Products ID</th>
                <th> Products Title</th>
                <th>Products Image</th>
                <th>Products Price</th>
                <th>Total Sold</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
</tr>
</thead>
<tbody class="bg-secondary text-dark">
</tbody>
<?php

$get_products="Select * from `products`";
$result=mysqli_query($con,$get_products);
$number=0;
while($row=mysqli_fetch_assoc($result)){
    $product_id=$row['product_id'];
    $product_title=$row['product_title'];
    $product_image1=$row['product_image1'];
    $product_price=$row['product_price'];
    $status=$row['status'];
    $number++;
    ?>
    <tr class='text-center'>
<td><?php echo $number;?></td>
<td><?php echo $product_title;?></td>
<td><img src='./product_images/<?php echo $product_image1;?>' class='product-image'/></td>
<td><?php echo $product_price;?></td>
<td><?php 
$get_count="Select * from `orders_pending` where product_id=$product_id";
$result_count=mysqli_query($con,$get_count);
$rows_count=mysqli_num_rows($result_count);
echo $rows_count;
?></td>
<td><?php echo $status;?></td>
<td><a href='index.php?edit_product=<?php echo $product_id?>' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
<td><a href='index.php?delete_product=<?php echo $product_id?>' class='text-dark'><i class='fa-solid fa-trash'></i></a></td>
</tr>
<?php
}
?>

</table>

</body>
</html>