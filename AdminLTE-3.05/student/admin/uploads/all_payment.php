<h4 class="text-center text-primary">All Payments </h4>


<div class="container">
<table class="table table-bordered">
    <thead class="text-center">
        <?php
        $select_payment="Select * from `user_payments`";
        $result=mysqli_query($con,$select_payment);
        $row=mysqli_num_rows($result);

//         echo "
//         <tr>
//             <th>Sno</th>
//               <th>Invoice Number</th>
//                 <th>Amount</th>
//                   <th>Payment_Mode</th>
//                     <th>Date</th>
//                     <th>Delete</th>

// </tr>
// </thead>

// <tbody class='text-center'> ";
if($row==0){
    echo "<h2 class=' text-center bg-danger mt-5 px-4'>No orders</h2>";
}
else{
     echo "
        <tr>
            <th>Sno</th>
              <th>Invoice Number</th>
                <th>Amount</th>
                  <th>Payment_Mode</th>
                    <th>Date</th>
                    <th>Delete</th>

</tr>
</thead>

<tbody class='text-center'> ";
    while($row_fetch=mysqli_fetch_assoc($result)){
$number=0;
      $payment_id=$row_fetch['payment_id'];
      $order_id=$row_fetch['order_id'];
      $invoice_number=$row_fetch['invoice_number'];
      $amount=$row_fetch['amount'];
      $payment_mode=$row_fetch['payment_mode'];
      $date=$row_fetch['date'];
$number++;
      echo"
          <tr>
            <td>$number</td>
              <td>$invoice_number</td>
                <td>$amount</td>
                  <td>$payment_mode</td>
                    <td>$date</td>
                    <td><a href='index.php?delete_payment= $payment_id' class='text-center'> <i class='fa-solid fa-trash'></i></a></td>
                  
</tr> ";
    }
}
?>

</tbody>
</table>
</div>