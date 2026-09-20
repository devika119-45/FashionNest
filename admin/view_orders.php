<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->query("SELECT * FROM orders ORDER BY id DESC");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Orders</title>
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
        .back{
            display:block;
            text-align:center;
            margin-top:20px;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Customer Orders</h2>

<table>
    <tr>
        <th>Order ID</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Order Time</th>
    </tr>

    <?php foreach ($orders as $order) { ?>
    <tr>
        <td><?php echo $order['id']; ?></td>
        <td><?php echo $order['product_name']; ?></td>
        <td>₹<?php echo $order['price']; ?></td>
        <td><?php echo $order['order_time']; ?></td>
    </tr>
    <?php } ?>

</table>

<a class="back" href="dashboard.php">Back to Dashboard</a>

</body>
</html>