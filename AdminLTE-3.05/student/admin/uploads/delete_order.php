<?php
//echo "hello";

if(isset($_GET['delete_order'])){
    $delete_id=$_GET['delete_order'];
    $select_delete="Delete  from `user_orders` where order_id=$delete_id";
    $result=mysqli_query($con,$select_delete);

    if($result){
        echo "<script>alert('orders has been successfully deleted')</script>";
        echo "<script>window.open('./index.php?list_orders.php,'_self')</script>";
    }
}
?>