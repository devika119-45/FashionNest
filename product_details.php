<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

$name = $product['name'];
$price = $product['price'];
$image = "images/" . $product['image'];
$description = $product['description'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Product Details</title>

<style>
body{
    margin:0;
    padding:0;
    font-family:Arial, sans-serif;
    background:#f4f4f4;
}

.details-container{
    width:80%;
    max-width:800px;
    margin:50px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 0 15px rgba(0,0,0,0.2);
}

.details-container h1{
    color:#222;
    margin-bottom:20px;
}

.product-img{
    width:300px;
    height:300px;
    object-fit:cover;
    border-radius:12px;
    margin-bottom:20px;
}

.price{
    color:#0a8f08;
    font-size:28px;
    font-weight:bold;
}

.desc{
    font-size:18px;
    color:#555;
    margin:20px 0;
}

.continue-btn{
    display:inline-block;
    padding:12px 45px;
    background:#ff6600;
    color:white;
    text-decoration:none;
    border-radius:8px;
    font-size:18px;
    font-weight:bold;
}

.continue-btn:hover{
    background:#e65c00;
}

.back-btn{
    display: inline-block;
    margin-top: 20px;
    padding: 12px 28px;
    background: #000;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
    font_size:18px;
    border: none;
    cursor: pointer;

.btn:hover{
    background: #333;
}
}
</style>
</head>

<body>

<div class="details-container">

    <h1><?php echo htmlspecialchars($name); ?></h1>

    <?php if(!empty($image)): ?>
        <img src="<?php echo htmlspecialchars($image); ?>" class="product-img" alt="Product Image">
    <?php else: ?>
        <p>No image found</p>
    <?php endif; ?>

    <h2 class="price">₹<?php echo htmlspecialchars($price); ?></h2>

    <p class="desc">
        <?php echo htmlspecialchars($description); ?>
    </p>

    <a href="continue_order.php" class="continue-btn">
        Continue
    </a>

    <br>

    <a href="index.php" class="back-btn">
        Back to Home
    </a>



</div>

</body>
</html>