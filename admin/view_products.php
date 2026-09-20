<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Products</title>
    <style>
        body{
            font-family:Arial;
            background:#f4f4f4;
        }
        table{
            width:90%;
            margin:40px auto;
            border-collapse:collapse;
            background:white;
        }
        th, td{
            border:1px solid #ccc;
            padding:12px;
            text-align:center;
        }
        th{
            background:#111;
            color:white;
        }
        img{
            width:80px;
            height:80px;
            object-fit:cover;
        }
        .edit{
            background:green;
            color:white;
            padding:6px 12px;
            text-decoration:none;
            border-radius:4px;
        }
        .delete{
            background:red;
            color:white;
            padding:6px 12px;
            text-decoration:none;
            border-radius:4px;
        }
        .back{
            display:block;
            text-align:center;
            margin-top:20px;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">All Products</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Description</th>
        <th>Action</th>
    </tr>

    <?php foreach ($products as $product) { ?>
    <tr>
        <td><?php echo $product['id']; ?></td>
        <td>
            <img src="../images/<?php echo $product['image']; ?>">
        </td>
        <td><?php echo $product['name']; ?></td>
        <td>₹<?php echo $product['price']; ?></td>
        <td><?php echo $product['description']; ?></td>
        <td>
            <a class="edit" href="edit_product.php?id=<?php echo $product['id']; ?>">Edit</a>
            <a class="delete" href="delete_product.php?id=<?php echo $product['id']; ?>" onclick="return confirm('Delete this product?')">Delete</a>
        </td>
    </tr>
    <?php } ?>

</table>

<a class="back" href="dashboard.php">Back to Dashboard</a>

</body>
</html>