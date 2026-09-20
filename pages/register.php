<?php

session_start();
include('../includes/db.php');

$error_message = "";
$success_message = "";

if (isset($_POST['register'])) {

    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = "user";

    // Empty Fields Check
    if (empty($fullname) || empty($email) || empty($password) || empty($confirm_password)) {

        $error_message = "Please fill all fields!";

    } elseif ($password !== $confirm_password) {

        $error_message = "Passwords do not match!";

    } else {

        // Check Existing User
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            $error_message = "Email already registered!";

        } else {

            // Hash Password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert User
            $stmt = $conn->prepare(
                "INSERT INTO users(fullname, email, password, role)
                 VALUES(?, ?, ?, ?)"
            );

            $stmt->execute([
                $fullname,
                $email,
                $hashed_password,
                $role
            ]);

            // Auto Login
            $_SESSION['user_id'] = $conn->lastInsertId();
            $_SESSION['user_email'] = $email;

            header("Location: ../index.php");
            exit();
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Registration</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial, sans-serif;

    background-image:url('https://img.magnific.com/free-photo/3d-illustration-laptop-with-shopping-basket-paper-bags-online-shopping-e-commerce-concept_58466-14623.jpg?semt=ais_hybrid&w=740&q=80');

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;

    display:flex;
    justify-content:center;
    align-items:center;

    height:100vh;
}

.register-box{

    width:420px;

    padding:35px;

    border-radius:20px;

    backdrop-filter:blur(12px);

    background:rgba(255,255,255,0.75);

    border:1px solid rgba(255,255,255,0.4);

    box-shadow:0 8px 32px rgba(0,0,0,0.2);
}

.register-box h2{

    text-align:center;

    margin-bottom:25px;

    color:#0f172a;

    font-size:30px;

    font-weight:bold;
}

.input-group{
    margin-bottom:18px;
}

.input-group label{

    display:block;

    margin-bottom:6px;

    font-weight:bold;

    color:#1f2937;

    font-size:15px;
}

.input-group input{

    width:100%;

    padding:12px;

    border:none;

    border-radius:10px;

    outline:none;

    background:rgba(255,255,255,0.95);

    color:#111827;

    font-size:15px;

    box-shadow:0 2px 6px rgba(0,0,0,0.1);
}

.input-group input:focus{

    border:2px solid #2563eb;

    box-shadow:0 0 10px rgba(37,99,235,0.3);
}

.btn{

    width:100%;

    padding:13px;

    border:none;

    border-radius:10px;

    background:linear-gradient(135deg,#2563eb,#1d4ed8);

    color:white;

    font-size:17px;

    font-weight:bold;

    cursor:pointer;

    transition:0.3s;
}

.btn:hover{

    transform:translateY(-2px);

    box-shadow:0 5px 15px rgba(37,99,235,0.4);
}

.success{

    color:#16a34a;

    text-align:center;

    margin-top:12px;

    font-weight:bold;
}

.error{

    color:#dc2626;

    text-align:center;

    margin-top:12px;

    font-weight:bold;
}

.login-link{

    text-align:center;

    margin-top:18px;

    color:#1f2937;
}

.login-link a{

    color:#2563eb;

    text-decoration:none;

    font-weight:bold;
}

.login-link a:hover{

    text-decoration:underline;
}

</style>
</head>

<body>

<div class="register-box">

<h2>Create Account</h2>

<form method="POST">

<div class="input-group">
<label>Full Name</label>
<input
type="text"
name="fullname"
placeholder="Enter your full name"
required>
</div>

<div class="input-group">
<label>Email Address</label>
<input
type="email"
name="email"
placeholder="Enter your email"
required>
</div>

<div class="input-group">
<label>Password</label>
<input
type="password"
name="password"
placeholder="Enter your password"
required>
</div>

<div class="input-group">
<label>Confirm Password</label>
<input
type="password"
name="confirm_password"
placeholder="Confirm your password"
required>
</div>

<button
type="submit"
name="register"
class="btn">

Register Now

</button>

</form>

<?php if(isset($error_message)): ?>
<p class="error">
<?php echo htmlspecialchars($error_message); ?>
</p>
<?php endif; ?>

<?php if(isset($success_message)): ?>
<p class="success">
<?php echo htmlspecialchars($success_message); ?>
</p>
<?php endif; ?>

<div class="login-link">
Already have an account?
<a href="login.php">Login Here</a>
</div>

</div>

</body>
</html>  