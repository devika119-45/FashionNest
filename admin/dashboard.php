<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body{
            margin:0;
            font-family:Arial;
            background:#f4f4f4;
        }
        header{
            background:#111;
            color:white;
            padding:20px;
            text-align:center;
        }
        .container{
            padding:40px;
            text-align:center;
        }
        .card{
            display:inline-block;
            width:220px;
            margin:15px;
            padding:25px;
            background:white;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.15);
        }
        .card a{
            text-decoration:none;
            color:#111;
            font-weight:bold;
        }
        .logout{
            background:red;
            color:white;
            padding:10px 18px;
            text-decoration:none;
            border-radius:5px;
        }
    </style>
</head>
<body>

<header>
    <h1>Admin Dashboard</h1>
    <p>Welcome, <?php echo $_SESSION['admin_email']; ?></p>
</header>

<div class="container">

    <div class="card">
        <a href="add_product.php">Add Product</a>
    </div>

    <div class="card">
        <a href="view_products.php">View Products</a>
    </div>

    <div class="card">
        <a href="view_orders.php">View Orders</a>
    </div>

    <br><br>

    <a class="logout" href="logout.php">Logout</a>

</div>

</body>
</html>