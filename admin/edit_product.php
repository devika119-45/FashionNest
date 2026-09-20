<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['update_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp_name, "../images/" . $image);
    } else {
        $image = $product['image'];
    }

    $stmt = $conn->prepare("UPDATE products SET name=?, price=?, description=?, image=? WHERE id=?");
    $stmt->execute([$name, $price, $description, $image, $id]);

    header("Location: view_products.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
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
        input, textarea{
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
        img{
            width:100px;
            height:100px;
            object-fit:cover;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Edit Product</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
        <input type="number" name="price" value="<?php echo $product['price']; ?>" required>
        <textarea name="description" required><?php echo $product['description']; ?></textarea>

        <p>Current Image:</p>
        <img src="../images/<?php echo $product['image']; ?>">

        <input type="file" name="image">

        <button type="submit" name="update_product">Update Product</button>
    </form>
</div>

</body>
</html>