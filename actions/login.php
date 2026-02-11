<?php
session_start();
include('./includes/config.php');

$site_url = 'http://localhost/student management/AdminLTE-3.05/';

// If already logged in, redirect to dashboard
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    $folder = $_SESSION['user_type'] ?? 'admin';
    $folder = ($folder == 'admin') ? 'admin' : $folder;
    header("Location: {$site_url}{$folder}/dashboard.php");
    exit();
}

if (isset($_POST['send_otp'])) {
    // अगर user ने send OTP क्लिक किया
    $_SESSION['email'] = $_POST['email'];  // email save कर लो session में

    // redirect to your send-otp.php
    header("Location: ../AdminLTE-3.05/admin/send_otp.php");
    exit();
}

if (isset($_POST['login'])) {
     // 1. CAPTCHA check
    if (!isset($_POST['captcha']) || $_POST['captcha'] != $_SESSION['CODE']) {
        echo "Invalid CAPTCHA code!";
        exit;
    }
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];
    $user_otp=$_POST['user_otp'];

    if (empty($email) || empty($pass)) {
        echo "Email and Password are required!";
        exit;
    }

    $pass_md5 = md5($pass); // keep as MD5 for now

    // Prepared statement (safe)
    $stmt = $con->prepare("SELECT * FROM `accounts` WHERE `email` = ? AND `password` = ? AND user_otp= ?");
    $stmt->bind_param("sss", $email, $pass_md5,$user_otp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_object();

        // Set session
        $_SESSION['login']      = true;
        $_SESSION['session_id'] = uniqid();
        $_SESSION['user_type']  = $user->type;
        $_SESSION['user_id']    = $user->id;
        $_SESSION['college_id'] = (int)$user->college_id;

        // Redirect to dashboard
        $folder = ($user->type == 'admin') ? 'admin' : $user->type;
        header("Location: {$site_url}{$folder}/dashboard.php");
        exit();
    }
    else if ($email == 'admin@example.com' && $pass == 'admin@sms') {
        // Optional super admin
        $_SESSION['login'] = true;
        $_SESSION['user_type'] = 'admin';
        header("Location: {$site_url}admin/dashboard.php");
        exit();
    }
    else {
        echo "Invalid credentials!";
    }
}
?>

<!-- Simple HTML login form -->
<form method="post" action="">
    <input type="email" name="email" placeholder="Email" required /><br><br>
    <input type="password" name="password" placeholder="Password" required /><br><br>
    <button type="submit" name="login">Login</button>
</form>
