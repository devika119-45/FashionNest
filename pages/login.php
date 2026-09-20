<?php
session_start();
include('../includes/db.php');

$error_message = "";

if(isset($_POST['login']))
{
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user)
    {
        if(password_verify($password, $user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['fullname'];

            header("Location: ../index.php");
            exit();
        }
        else
        {
            $error_message = "Invalid Password!";
        }
    }
    else
    {
        $error_message = "User Not Found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;

    background:url('https://img.magnific.com/free-photo/3d-illustration-laptop-with-shopping-basket-paper-bags-online-shopping-e-commerce-concept_58466-14623.jpg?semt=ais_hybrid&w=740&q=80');
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
}

.login-container{
    width:400px;
    padding:35px;

    background:rgba(0,0,0,0.5);
    backdrop-filter:blur(10px);

    border-radius:15px;
    box-shadow:0 8px 32px rgba(0,0,0,0.3);

    color:white;
}

.login-container h2{
    text-align:center;
    margin-bottom:25px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:bold;
}

input[type="email"],
input[type="password"]{
    width:100%;
    padding:12px;
    margin-bottom:18px;

    border:none;
    border-radius:8px;
    outline:none;

    font-size:15px;
}

button{
    width:100%;
    padding:12px;

    background:#ff6b35;
    color:white;

    border:none;
    border-radius:8px;

    font-size:16px;
    cursor:pointer;

    transition:0.3s;
}

button:hover{
    background:#e85a2a;
    transform:scale(1.03);
}

.error-message{
    color:#ff4d4d;
    text-align:center;
    margin-top:15px;
    font-weight:bold;
}

.register-link{
    text-align:center;
    margin-top:15px;
}

.register-link a{
    color:#ffd700;
    text-decoration:none;
    font-weight:bold;
}

.register-link a:hover{
    text-decoration:underline;
}

</style>

</head>
<body>

<div class="login-container">

    <h2>Login</h2>

    <form method="POST">

        <label>Email</label>
        <input type="email"
               name="email"
               placeholder="Enter your email"
               required>

        <label>Password</label>
        <input type="password"
               name="password"
               placeholder="Enter your password"
               required>

        <button type="submit" name="login">
            Login
        </button>

    </form>

    <?php
    if(!empty($error_message))
    {
        echo "<p class='error-message'>$error_message</p>";
    }
    ?>

    <div class="register-link">
        Don't have an account?
        <a href="register.php">Register</a>
    </div>

</div>

</body>
</html>