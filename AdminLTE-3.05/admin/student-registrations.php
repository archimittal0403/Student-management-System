
<!-- <?php
//  include('../includes/config.php');
//    if(isset($_POST['submit'])){
//      $name =$_POST['name'];
//       $email =$_POST['email'];
//     $password =md5(123567890);
//    $type=$_POST['type'];

//    $check_query=mysqli_query($con,"SELECT * FROM accounts WHERE email='$email'");
//     if(mysqli_num_rows($check_query)>0){
//     $error = 'Email already exist';
//     }
//    else{
//      $_SESSION['success_msg']='user has been successfully registerd';
//    mysqli_query($con,"INSERT INTO accounts(`name`,`email`,`password`,`type`) VALUES ('$name','$email','$password','$type')"); 

//     header('location: user-account.php?user='.$type);
//     exit;

//    }

  

// if(isset($_POST['type']) && $_POST['type'] == 'student'){


//      $name =$_POST['name'];
//     $dob = $_POST['dob'];
//     $mobile = isset($_POST['mobile'])?$_POST['mobile']:'';
//     $email = isset($_POST['email'])?$_POST['email']:'';
//     $address = isset($_POST['address'])?$_POST['address']:'';
//     $country = isset($_POST['country'])?$_POST['country']:'';
//     $state = isset($_POST['state'])?$_POST['state']:'';
//     $zip = isset($_POST['zip'])?$_POST['zip']:'';
// $password = date('dmY',strtotime($dob));
//     $md_password = md5($password);
    

//                   $father_name =isset($_POST['father_name'])?$_POST['father_name']:'';  
//                    $father_mobile =isset($_POST['father_mobile'])?$_POST['father_mobile']:'';   
//                      $mother_name =isset($_POST['mother_name'])?$_POST['mother_name']:'';  
//                           $mother_mobile =isset($_POST['mother_mobile'])?$_POST['mother_mobile']:'';  
//                           $parent_address =isset($_POST['parent_address'])?$_POST['parent_address']:''; 
//                            $parent_country =isset($_POST['parent_country'])?$_POST['parent_country']:'';  
//                    $parent_state =isset($_POST['parent_state'])?$_POST['parent_state']:'';
//                       $parent_pincode =isset($_POST['parent_pincode'])?$_POST['parent_pincode']:''; 


//                   $school_name =isset($_POST['school_name'])?$_POST['school_name']:'';   
//                    $class =isset($_POST['class'])?$_POST['class']:'';
//                    $board=isset($_POST['board'])?$_POST['board']:'';
//                     $total_mark =isset($_POST['total_mark'])?$_POST['total_mark']:'';
//                      $obtain_mark=isset($_POST['obtain_mark'])?$_POST['obtain_mark']:''; 
//                      $percent=isset($_POST['percentage'])?$_POST['percentage']:'';


//                       $st_class=isset($_POST['st_class'])?$_POST['st_class']:'';
//                         $st_section=isset($_POST['st_section'])?$_POST['st_section']:'';
//                         $subject_stream=isset($_POST['subject_stream'])?$_POST['subject_stream']:'';
//                       $doa =isset($_POST['doa'])?$_POST['doa']:'';
//                         $type =isset($_POST['type'])?$_POST['type']:'';
//                       $date_added =date('Y-m-d');
//                           $payment_method=isset($_POST['payment_method'])?$_POST['payment_method']:'';
                     
//   $check_query=mysqli_query($con,"SELECT * FROM accounts WHERE email='$email'");
//       if(mysqli_num_rows($check_query)>0){
//      echo 'Email already exist';die;
//       }
//     else{

//     $query=mysqli_query($con,"INSERT INTO accounts (`name`,`email`,`password`,`type`) VALUES ('$name','$email','$md_password','$type')"); 
//     if($query){
//         $user_id=mysqli_insert_id($con);
//     }

     
//      $usermeta = array(
//        'name'=>$name,
//        'mobile'=>$mobile,
//        'payment_method'=>$payment_method,
//        'st_class'=>$st_class

//     );
//       echo json_encode($usermeta);die;

//    foreach($usermeta as $key => $value){
//      mysqli_query($con,"INSERT INTO usermeta(`user_id`, `meta_key`, `meta_value`) VALUES ('$user_id','$key','$value')") or die(mysqli_error($con));
//    }
//      $response = array(
//     'success' => TRUE,
//     'payment_method' => $payment_method,
//     'std_id' =>$user_id
//    );
 
//  echo json_encode($response);die;
//     }
//   }
  


 
// ?>
