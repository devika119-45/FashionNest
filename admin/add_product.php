<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$message = "";

if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];


    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp_name, "../images/" . $image);

    $stmt = $conn->prepare("INSERT INTO products (name, price, description, image, category) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $price, $description, $image, $category]);

    $message = "Product added successfully";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <style>
        body{
            font-family:Arial;
            background:#f4f4f4;
        }
        .box{
            width:450px;
            background:white;
            margin:50px auto;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 12px rgba(0,0,0,0.2);
        }
        input, textarea, select{
           width:100%;
           padding:12px;
           margin:10px 0;
           border:1px solid #ccc;
           border-radius:5px;
        }
        
        button{
            width:100%;
            padding:12px;
            background:#111;
            color:white;
            border:none;
            border-radius:5px;
        }
        a{
            display:block;
            text-align:center;
            margin-top:15px;
        }
        .msg{
            color:green;
            text-align:center;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Add Product</h2>

    <p class="msg"><?php echo $message; ?></p>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" name="price" placeholder="Product Price" required>
        <textarea name="description" placeholder="Product Description" required></textarea>
   
<select name="category" required>
    <option value="">Select Category</option>
    <option value="men">Men</option>
    <option value="women">Women</option>
    <option value="children">Children</option>
    <option value="new-arrivals">New Arrivals</option>
</select>  



        <input type="file" name="image" required>
        <button type="submit" name="add_product">Add Product</button>
    </form>

    <a href="dashboard.php">Back to Dashboard</a>
</div>

</body>
</html>