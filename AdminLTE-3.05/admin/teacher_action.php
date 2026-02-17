<?php
session_start();
include('includes/config.php');
include('includes/functions.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success'=>false,'message'=>'Invalid request']);
    exit;
}

if (empty($_SESSION['college_id'])) {
    echo json_encode(['success'=>false,'message'=>'college_id missing']);
    exit;
}

$type  = $_POST['type'] ?? '';
$email = $_POST['email'] ?? '';
$name  = $_POST['name'] ?? '';
$mobile=$_POST['mobile'] ?? '';
$address=$_POST['address'] ?? '';
 $dob=$_POST['dob'] ?? '';
 $qualification=$_POST['qualification'] ?? '';
 $experience=$_POST['experience'] ?? '';
 $gender=$_POST['gender'] ?? '';
 $class=$_POST['class'] ?? '';
 $section=$_POST['section'] ?? '';
 $subject=$_POST['subject'] ?? '';
 $salary=$_POST['salary'] ?? '';
 $bank=$_POST['bank'] ?? '';
 $account=$_POST['aco'] ?? '';
 $ifsc=$_POST['ifsc'] ?? '';


if ($type !== 'teacher' || $email == '') {
    echo json_encode(['success'=>false,'message'=>'Invalid data']);
    exit;
}

$college_id = $_SESSION['college_id'];
$password   = date('dmY', strtotime($_POST['dob'] ?? ''));
$md_pass    = password_hash($password, PASSWORD_DEFAULT);

/* 🔎 Duplicate email check */
$check = mysqli_query(
    $con,
    "SELECT id FROM accounts WHERE email='$email' AND college_id='$college_id'"
);

if (mysqli_num_rows($check) > 0) {
    echo json_encode(['success'=>false,'message'=>'Email already exists']);
    exit;
}

/* ✅ INSERT account */
$insert = mysqli_query(
    $con,
    "INSERT INTO accounts (type,email,password,Name,college_id)
     VALUES ('teacher','$email','$md_pass','$name','$college_id')"
);

if (!$insert) {
    echo json_encode(['success'=>false,'message'=>mysqli_error($con)]);
    exit;
}

/* 🆔 VERY IMPORTANT */
$user_id = mysqli_insert_id($con);


$usermeta=array(
  'college_id'=>$college_id,
  'phone'=>$mobile,
  'address'=>$address,
  'dob'=>$dob,
  'qualification'=>$qualification,
  'experience'=>$experience,
  'gender'=>$gender,
  'class'=>$class,
  'section'=>$section,
  'subject'=>$subject,
  'salary'=>$salary,
  'bank'=>$bank,
  'ano'=>$account,
  'ifsc'=>$ifsc,
);
foreach($usermeta as $key=>$value){
      if($value==''||$value=='null'){
    continue;
  }
    if(is_array($value)){
    $value=json_encode($value);
  }
  $query=mysqli_query($con,"INSERT INTO `usermeta` (`user_id`,`meta_key`,`meta_value`) VALUES('$user_id','$key','$value')");
}
$response=array(
  'success'=>'true',
  'std_id'=>$user_id
);
/* ✅ SUCCESS RESPONSE */
echo json_encode([
    'success' => true,
    'std_id'  => $user_id
]);
exit;
?>
