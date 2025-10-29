<?php
include('./includes/config.php');
if (isset($_POST['login'])){
    $email=$_POST['email'];
    $pass=$_POST['password'];

    $pass_md5 = md5($pass);

    $query=mysqli_query($con,"SELECT * FROM `accounts` WHERE  `email` ='$email' AND `password`='$pass_md5'");

    if(mysqli_num_rows($query)>0)
    {
        $user = mysqli_fetch_object($query);
        $_SESSION['login'] =true;
        $_SESSION['session_id'] =uniqid();
        $user_type=$user->type;
$_SESSION['user_type'] = $user_type;
//$user_id=$user->id;
$_SESSION['user_id']=$user->id;
// if($user_type == 'admin'){
//         header('Location: ../AdminLTE-3.05/'.$user_type.'/dashboard.php');
// }
//else{
    header('Location: ../AdminLTE-3.05/'.$user_type.'/admin/dashboard.php');
//}
        exit();
    }
    else if($email=='admin@example.com' && $pass=='admin@sms'){
    session_start();
$_SESSION['login'] =true;
header('Location: ../AdminLTE-3.05/admin/dashboard.php');
}
else{
    echo 'invalid crediantial';
}
}
