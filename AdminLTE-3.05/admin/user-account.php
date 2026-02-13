
<?php
//session_start();
 include('includes/config.php');
 include('includes/functions.php');
?> 

<?php

 if(isset($_POST['type']) && $_POST['type'] == 'student' && isset($_POST['email']) && !empty($_POST['email'])){
      $name = isset($_POST['name'])?$_POST['name']:'';
    $dob = isset($_POST['dob'])?$_POST['dob']:'';
    $mobile = isset($_POST['mobile'])?$_POST['mobile']:'';
    $email = trim(isset($_POST['email'])?$_POST['email']:'');
if(empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
  echo json_encode([
    'success' => false,
    'message' => 'please enter a valid email address'
  ]);
  exit;
}
    $address = isset($_POST['address'])?$_POST['address']:'';
     $country = isset($_POST['country'])?$_POST['country']:'';
   $state = isset($_POST['state'])?$_POST['state']:'';
   $zip = isset($_POST['pincode'])?$_POST['pincode']:'';
 $password = date('dmY',strtotime($dob));
     $md_password = password_hash($password,PASSWORD_DEFAULT);
    

                  $father_name =isset($_POST['father_name'])?$_POST['father_name']:'';  
                   $father_mobile =isset($_POST['father_mobile'])?$_POST['father_mobile']:'';   
                      $mother_name =isset($_POST['mother_name'])?$_POST['mother_name']:'';  
                           $mother_mobile =isset($_POST['mother_mobile'])?$_POST['mother_mobile']:'';  
                           $parent_address =isset($_POST['parent_address'])?$_POST['parent_address']:''; 
                            $parent_country =isset($_POST['parent_country'])?$_POST['parent_country']:'';  
                    $parent_state =isset($_POST['parent_state'])?$_POST['parent_state']:'';
                       $parent_pincode =isset($_POST['parent_pincode'])?$_POST['parent_pincode']:''; 


                   $school_name =isset($_POST['school_name'])?$_POST['school_name']:'';   
                    $class =isset($_POST['class'])?$_POST['class']:'';
                   $board=isset($_POST['board'])?$_POST['board']:'';
                     $total_mark =isset($_POST['total_mark'])?$_POST['total_mark']:'';
                      $obtain_mark=isset($_POST['obtain_mark'])?$_POST['obtain_mark']:''; 
                     $percent=isset($_POST['percentage'])?$_POST['percentage']:'';


                     $st_class=isset($_POST['st_class'])?$_POST['st_class']:'';
                      $st_section=isset($_POST['st_section'])?$_POST['st_section']:'';
                         $subject_stream=isset($_POST['subject_stream'])?$_POST['subject_stream']:'';
                    $doa =isset($_POST['doa'])?$_POST['doa']:'';
                         $type =isset($_POST['type'])?$_POST['type']:'';
                      $date_added =date('Y-m-d');
                           $payment_method=isset($_POST['payment_method'])?$_POST['payment_method']:'';
                     
   $check_query=$con->prepare("SELECT id FROM accounts WHERE email=? AND college_id=?");
   $check_query->bind_param("si",$email,$_SESSION['college_id']);
   $check_query->execute();
$result=$check_query->get_result();
       if($result->num_rows>0){
    echo json_encode([
  'success' => false,
  'message' => 'Email already exists'
]);
exit;
       }
     else{
session_start();
    $college_id = $_SESSION['college_id'];

    if (empty($_SESSION['college_id'])) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'College ID missing. Please login again.'
    ]);
    exit;
}

$query = $con->prepare(
"INSERT INTO accounts (`name`,`email`,`password`,`type`,`college_id`)
 VALUES (?,?,?,?,?)"
);
$query->bind_param("ssssi",$name,$email,$md_password,$type,$college_id);
$query->execute();

$user_id = $con->insert_id;

    }
     
      $usermeta = array(
       'dob'=>$dob,
        'mobile'=>$mobile,
        'payment_method'=>$payment_method,
        'st_class'=>$st_class,
        'address'=>$address,
        'country'=>$country,
        'state'=>$state,
        'pincode'=>$zip,
        'father_name'=>$father_name,
        'father_mobile'=>$father_mobile,
        'mother_name'=>$mother_name,
        'mother_mobile'=>$mother_mobile,
        'parent_address'=>$parent_address,
        'parent_country'=>$parent_country,
        'parent_state'=>$parent_state,
        'parent_pincode'=>$parent_pincode,
        'school_name'=>$school_name,
        'board'=>$board,
        'total_mark'=>$total_mark,
        'obtain_mark'=>$obtain_mark,
         'percentage'=>$percent,
      
        'st_section'=>$st_section,
        'subject_stream'=> $subject_stream,
          'doa'=>$doa,
        'type'=>$type,


     );
    //  echo json_encode($usermeta);die;

                      
   $check_query=$con->prepare("SELECT * FROM accounts WHERE email=? AND college_id=?");
$check_query->bind_param("si",$father_mobile, $_SESSION['college_id']);
$check_query->execute();

$result=$check_query->get_result();
       if($result->num_rows>0){
     echo json_encode([
  'success' => false,
  'message' => 'parent email already exists'
]);
exit;
       }
     else{
$md_password=password_hash($father_mobile,PASSWORD_DEFAULT);
$college_id=$_SESSION['college_id'];
     $query=$con->prepare("INSERT INTO accounts (`name`,`email`,`password`,`type`,`college_id`) VALUES (?,?,?,?,?)"); 
     $type='parent';
     $query->bind_param("ssssi",$father_name,$father_mobile,$md_password,$type,$college_id);
     $query->execute();
     if(!$query){
      die("parent insert failed");
     }
         $parent_id=$con->insert_id;
     
     $child= [$user_id];
     $child=serialize($child);
     $stxtchild=$con->prepare("INSERT INTO usermeta (`user_id`,`meta_key`,`meta_value`) VALUES (?,'children',?)");
  
      $stxtchild->bind_param("is",$parent_id,$child);
     if(!$stxtchild->execute()){
        die($stxtchild->error);
     }
    
    }

  $stmt=$con->prepare("INSERT INTO usermeta (`user_id`, `meta_key`, `meta_value`) VALUES (?,?,?)");
    foreach($usermeta as $key => $value){
       if ($value === '' || $value === null) {
        continue;
    }

    if (is_array($value)) {
        $value = json_encode($value);
    }

      $stmt->bind_param("iss",$user_id,$key,$value);
      if(!$stmt->execute()){
        die($stmt->error);
      }
    }
      $response = array(
     'success' => TRUE,
     'payment_method' => $payment_method,
     'std_id' =>$user_id
    );
header('Content-Type: application/json');
echo json_encode($response);
exit;

     }
   

?>

<?php
$classes = get_posts([
    'type' =>'class',
    'status' =>'publish'

]);

$user = $_GET['user'] ?? '';


?>

<?php include('header.php')?>
<?php include('sidebar.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

</head>
<body>
  
</body>
</html>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<!-- <script src="dist/js/demo.js"></script> -->

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class= "d-flex">
            <h1 class="m-0 text-dark"> Manage Accounts</h1>
            <a href="user-account.php?user=<?php echo $user; ?>&action=add-new"
   class="btn btn-primary btn-sm mx-4">Add new</a>

</div>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accounts</a></li>
              <li class="breadcrumb-item active"><?php echo ucfirst($user); ?></li>

            </ol>
          </div><!-- /.col -->
          <?php
          if(isset($_SESSION['success_msg'])){?>
            <div class="col-12">
            <small class="text-success" style="font-size:19px mt-3"><?=$_SESSION['success_msg']?></small>
            </div>
          <?php
          unset($_SESSION['success_msg']);
          }
          ?>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <?php 
        if(isset($_GET['action'])){
          
            ?>
        <div class="card">
<div class="card-body" id="form-container">
<?php if($_GET['action'] == 'add-new'){ ?>
  <form action="" id="user-account" method="post">
        

   <div class="form-group">
        <!-- <button type="submit" name="submit" class="btn btn-success">Register</button> -->
   
<div class="border border-top border-dark ">
        <feildset class="form-group">
          <legend class="mt-2 p-1 ml-2 mb-1"> Student Information: </legend>
          <div class="row">
            <div class="col-lg-12">
            <div class="form-group m-2">
              <label for="name">Full Name -</label>
      <input type="text" class="form-control" id="name" placeholder="Full Name" name="name" autocomplete="given-name"/>
        </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group m-2">
            <label for="dob">DOB-</label>
               
      <input type="date" class="form-control" id="dob" placeholder="DOB" name="dob"/>
      
        </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group m-2">
              <label for="mobile">Mobile no-</label>
      <input type="text" class="form-control" id="mobile" placeholder="Mobile no" name="mobile"/>
        </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group m-2">
              <label for="email">Email -</label>
      <input type="text"  class="form-control" id="email" placeholder="Email id" name="email" autocomplete="off"/>
        </div>
        </div>

        <!-- Adress -->

              <div class="col-lg-12">
            <div class="form-group m-2">
              <label for="address">Address -</label>
      <input type="text" class="form-control" id="address" placeholder="Address" name="address" autocomplete="off"/>
        </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group m-2">
              <label for="country">Country-</label>
      <input type="text" class="form-control" id="country" placeholder="Country" name="country" autocomplete="off"/>
        </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group m-2">
              <label for="state">State-</label>
      <input type="text" class="form-control" id="state" placeholder="State" name="state" autocomplete="off"/>
        </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group m-2">
              <label for="pincode">Pin/Zip code -</label>
      <input type="text" class="form-control" id="pincode" placeholder="Pincode" name="pincode" autocomplete="off"/>
        </div>
        </div>
        </div>

        </feildset>
        </div>

        <!-- Parent information -->

        <div class="border border-top border-dark mt-3">
        <feildset>
          <legend class="mt-2  ml-2 mb-1"> Parent Information: </legend>
          <div class="row">
            <div class="col-lg-6">
           <div class="form-group m-2">
              <label for="father_name">Father's Name -</label>
      <input type="text" class="form-control" id="father_name" placeholder="Father name" name="father_name" autocomplete="off"/>
        </div>
            </div>

              <div class="col-lg-6">
           <div class="form-group m-2">
              <label for="father_mobile">Father's Mobile no -</label>
      <input type="text" class="form-control" id="father_mobile" placeholder="Father mobile no" name="father_mobile" autocomplete="off"/>
        </div>
            </div>
          

            <div class="col-lg-6">
           <div class="form-group m-2">
              <label for="mother_name">Mother's Name -</label>
      <input type="text" class="form-control" id="mother_name" placeholder="Mother name" name="mother_name" autocomplete="off"/>
        </div>
            </div>

              <div class="col-lg-6">
           <div class="form-group m-2">
              <label for="mother_mobile">Mother's Mobile no -</label>
      <input type="text" class="form-control" id="mother_mobile" placeholder="Mother mobile no" name="mother_mobile" autocomplete="off"/>
        </div>
            </div>

            <!-- ADRESS OF father and mother -->
              <div class="col-lg-12">
            <div class="form-group m-2">
              <label for="parent_address">Address -</label>
      <input type="text" class="form-control" id="parent_address" placeholder="Address" name="parent_address" autocomplete="off"/>
        </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group m-2">
              <label for="parent_country">Country-</label>
      <input type="text" class="form-control" id="parent_country" placeholder="Country" name="parent_country" autocomplete="off"/>
        </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group m-2">
              <label for="parent_state">State-</label>
      <input type="text" class="form-control" id="parent_state" placeholder="State" name="parent_state" autocomplete="off"/>
        </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group m-2">
              <label for="parent_pincode">Pin/Zip code -</label>
      <input type="text" class="form-control" id="parent_pincode" placeholder="Pincode" name="parent_pincode" autocomplete="off"/>
        </div>
        </div>
        
        </div>
        </feildset>
        </div>


        <!-- Last qualification -->

         <div class="border border-top border-dark mt-3">
        <feildset>
          <legend class="mt-2  ml-2 mb-1"> Last Qualification: </legend>
          <div class="row">
<div class="col-lg-12">
   <div class="form-group m-2">
              <label for="school_name">School Name-</label>
      <input type="text" class="form-control" id="school_name" placeholder="school name" name="school_name" autocomplete="off"/>
        </div>
</div>
<div class="col-lg-2">
   <div class="form-group m-2">
              <label for="class">Class -</label>
      <!-- <input type="text" class="form-control" id="class" placeholder="class Name" name="class" autocomplete="off"/> -->
        <select name="class" id="class" class="form-control">
            <option value="class"> select the class </option>

            <?php
            foreach ($classes as $key=>$class) {
                echo '<option value=""> '.$class->title.' </option>';

            }
            ?>
        </select>
        </div>
</div>

<div class="col-lg-2">
   <div class="form-group m-2">
              <label for="board">Board -</label>
      <input type="text" class="form-control" id="board" placeholder="Board" name="board" autocomplete="off"/>
        </div>
</div>

<div class="col-lg-2">
   <div class="form-group m-2">
              <label for="total_mark">Total marks -</label>
      <input type="text" class="form-control" id="total_mark" placeholder="Total marks" name="total_mark" autocomplete="off"/>
        </div>
</div>

<div class="col-lg-3">
   <div class="form-group m-2">
              <label for="obtain_mark">Obtained Marks -</label>
      <input type="text" class="form-control" id="obtain_mark" placeholder="Obtained mark" name="obtain_mark" autocomplete="off"/>
        </div>
</div>

<div class="col-lg-3">
   <div class="form-group m-2">
              <label for="percentage">Percentage -</label>
      <input type="text" class="form-control" id="percentage" placeholder="Percentage" name="percentage" autocomplete="off"/>
        </div>
</div>
          </div>
        </feildset>
        </div>


        <!-- Addmission details -->
  <div class="border border-top border-dark mt-3">
        <feildset>
          <legend class="mt-2  ml-2 mb-1"> Admission Details: </legend>
<div class="row">
  <div class="col-lg-3">
       <div class="form-group m-2">
              <label for="st_class">Class -</label>
      <!-- <input type="text" class="form-control" id="st_class" placeholder="class Name" name="st_class" autocomplete="off"/> -->
              <select name="st_class" id="st_class" class="form-control">
            <option value="class"> select the class </option>

            <?php
            foreach ($classes as $class) {
                echo '<option value="'.$class->id.'">'.$class->title.'</option>';

            }
            ?>
        </select>
        </div>
  </div>

   <div class="col-lg-3">
       <div class="form-group m-2">
              <label for="st_section">Section -</label>
   <select name="st_section" id="st_section" class="form-control">
    <option value="">Select Section</option>
</select>

    </div>
        </div>
  </div>

  
 <div class="col-lg-3">
       <div class="form-group m-2">
              <label for="subject_stream">Subject Stream -</label>
      <input type="text" class="form-control" id="subject_stream" placeholder="Subject stream" name="subject_stream" autocomplete="off"/>
        </div>
  </div>

   <div class="col-lg-3">
       <div class="form-group m-2">
              <label for="doa">Date of Admission -</label>
      <input type="date" class="form-control" id="doa" placeholder="DOA" name="doa">
        </div>
  </div>

        </feildset>
        </div>
 <div class="form-group mt-1">
  <label for="online-payment"><input type="radio" name="payment_method" value="online" id="online-payment"> Online payment</label>
    <label for="offline-payment"><input type="radio" name="payment_method" value="offline" id="offline-payment"> Offline payment</label>
        </div>  
         <input type="hidden" name="type" value="<?php echo $user; ?>">

      <!-- <button class="btn btn-success mt-1 mb-1 ml-1" name="submit">Register</button> -->
<input type="submit" name="submit" class="btn btn-primary mt-1 mb-1 ml-1" id="submit" value="Register">
        </form>
        </div>
       
        </div>
        <?php } elseif($_GET['action'] == 'fee-payment'){ ?>
        <form action="" id="registration-fee" method="post">
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <label for="">Reciept Number </label>
                <input type="text" name="reciept_number" placeholder="Enter your Recipt Number" class="form-control"/>
        </div>
          <div class="form-group">
                <label for="">Registration Fees </label>
                <input type="text" name="registration_fee" placeholder="Registration Fee" class="form-control"/>
        </div>
          
            </div>
              
          </div>
          <input type="hidden" name="std_id" value="<?php echo isset($_GET['std_id'])?$_GET['std_id']:''?>">
          <button type="submit" class="btn btn-primary">Submit</button>
          
        </form>
          <?php } ?>
        <?php }  else { ?>
        <!-- Info boxes -->
         <div class="card">
          <div class="card-body">
            <form action="" method="get">
              <?php
             $class_id = $_GET['class'] ?? '';
$section_id = $_GET['section'] ?? '';

              ?>
              <div class="row">
            <div class="col-lg-6">
<div class="form-group">
 <label for="class">Select Class:-</label>
    <select name="class" id="filter_class" class="form-control">


        <option value="">select class</option>
        <?php
        $args=array(
          'type'=>'class',
          'status'=>'publish'
        );
        $s_class_id=get_posts($args);
        foreach($s_class_id as $key => $s_class){
$selected=($class_id==$s_class->id)?'selected':'';
 echo '<option value="' . $s_class->id . '" '.$selected.'>' . $s_class->title . '</option>';

        }
        ?>
        </select>
        </div>
        </div>
          <div class="col-lg-6">
                 <div class="form-group" id="section-container">
    
        </div>
        </div>
      </div>

      <div class=" justify-content-end">
     <button type="submit" class="btn btn-danger" >Apply</button>

      </div>
            </form>
          </div>
         </div>
         <form method="post">
        <div class="table-responsive">
  <table class="table table-bordered table-striped w-100" id="example">
  <thead>
    <tr>
      <th>Enroll</th>
      <th>Class</th>
      <th>Section</th>
      <th>Photo</th>
      <th>Name</th>
      <th>Email ID</th>
      <th>Phone NO</th>
      <th>DOB</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

       
       
        </div>
        </form>

        </div>
        <!-- /.row -->   
      </div><!--/. container-fluid -->
       <div class="container my-4">
      <?php
      if(isset($_GET['edit_student'])){
include('edit_user.php');
      }
      ?>
      </div>
      <div class="container">
        <?php
        if(isset($_GET['delete_student'])){
          include('delete_user.php');
        }
        ?>
      </div>
      <?php } ?>
    </section>
<!-- <script src="lib/jquery/jquery-3.7.1.min.js"></script> -->
<!-- <script src="lib/datatables/dataTables.js"></script> -->
<!--     
<script src="lib/jquery/jquery-3.7.1.min.js"></script>
<script src="lib/datatables/dataTables.js"></script>
<script src="lib/jquery/dataTables.buttons.js"></script>
 <script src="lib/jquery/buttons.dataTables.js"></script> -->
<!-- <script>
    jQuery(document).ready(function (){
jQuery('#example').DataTable();
 

    })

    
</script> -->

<?php include('footer.php')?>
 <!-- <script>
  jQuery('#example').DataTable({
  
    
    columns: [
        { data: "s_no" },
        { data: "Name" },
        { data: "email" },
        { data: "action" }
    ]
});

  </script>   -->
<script>

var table = $('#example').DataTable({
    processing: true,
        dom: 'Bfrtip',
    buttons: [
      {
    extend: 'excelHtml5',
            text: 'Excel',
            className: 'btn btn-success btn-sm',
            exportOptions: {
                columns: ':not(:last-child)'
}
      },
      {
      extend: 'print',
            text: 'Print',
            className: 'btn btn-primary btn-sm',
            exportOptions: {
                columns: ':not(:last-child)'
        }
      },
      {
       extend: 'pdfHtml5',
            text: 'PDF',
            className: 'btn btn-danger btn-sm',
            orientation: 'landscape',   
            pageSize: 'A4',
            exportOptions: {
                columns: ':not(:last-child)'
      }
    }
    ],
    ajax: {
        url: "ajax.php",
        type: "POST",
    data: function (d) {
   d.action = "get_user_details";
   d.class_id = $('#filter_class').val();
   d.section_id = $('#filter_section').val();
}

    },
    columns: [
        { data: 'enroll' },
        { data: 'class' },
        { data: 'section' },
        { data: 'photo' },
        { data: 'name' },
        { data: 'email' },
        { data: 'phone' },
        { data: 'dob' },
        { data: 'action' }
    ]
});
$('#filter_class, #filter_section').change(function(){
   table.ajax.reload();
});


</script>
 

<script>

$('#filter_class').on('change', function () {
    let class_id = $(this).val();

    $('#filter_section').html('<option>Loading...</option>');

    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'get_sections',
            class_id: class_id
        },
      success: function (res) {
    if(res.status){
        $('#filter_section').html(res.options);
    } else {
        $('#filter_section').html('<option value="">No sections found</option>');
    }
},
error: function () {
    $('#filter_section').html('<option value="">Error loading sections</option>');
}

    });
});

</script>
<script>        


  
// jQuery('#users-table').DataTable();
   jQuery('#user-account').on('submit',function(e){
  e.preventDefault();

  var formdata=jQuery(this).serialize();

  jQuery.ajax({
type: 'post',
url:'user-account.php?user=student',
data:formdata,
  dataType :'json',
success: function (response) {
console.log(response);
if(response.success){
  location.href =
                  'user-account.php?user=student&action=fee-payment'
                  + '&std_id=' + response.std_id
                  + '&payment_method=' + response.payment_method;
}
else{
  alert(response.message);
}
},
 error: function(xhr){
            console.log(xhr.responseText);
            alert('AJAX failed – check console');
        }
  });
});


      </script>
   

  