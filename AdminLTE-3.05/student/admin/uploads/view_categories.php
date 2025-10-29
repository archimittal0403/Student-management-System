

<h3 class="text-center text-primary">All Categories</h3>
<table class="table table-bordered mt-5">

<thead class="bg-info text-center">
<tr>
    <th>Sno</th>
   <th>Categories</th>
      <th>Edit</th>
         <th>Delete</th>

</tr>

</thead>
<tbody class="text-dark">
    <?php
    $select_cat="Select * from `categories`";
    $result=mysqli_query($con,$select_cat);
    $number=0;
    while($row_fetch=mysqli_fetch_assoc($result)){
        $category_id=$row_fetch['category_id'];
        $category_title=$row_fetch['category_title'];
        $number++;
   ?>
    <tr class="text-center">
<td><?php echo $number ?></td>
<td><?php  echo $category_title?></td>
<td><a href='index.php?edit_categories=<?php echo $category_id ?>' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
<td><a href='index.php?delete_category=<?php echo $category_id ?>' class='text-dark'><i class='fa-solid fa-trash'></i></a></td>
</tr>
    <?php
    }?>
</tbody>
</table>
 
 