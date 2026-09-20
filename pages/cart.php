<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

/* Cart session create */
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* Add Product to Cart */
if (isset($_POST['add_to_cart'])) {

    $product_id = $_POST['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {

        $found = false;

        foreach ($_SESSION['cart'] as $key => $cart_item) {
            if ($cart_item['id'] == $product['id']) {
                $_SESSION['cart'][$key]['quantity']++;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'description' => $product['description'] ?? '',
                'quantity' => 1
            ];
        }
    }

    header("Location: cart.php");
    exit();
}

/* Remove Product */
if (isset($_GET['remove'])) {
    $key = $_GET['remove'];

    if (isset($_SESSION['cart'][$key])) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    header("Location: cart.php");
    exit();
}

/* Increase Quantity */
if (isset($_GET['increase'])) {
    $key = $_GET['increase'];

    if (isset($_SESSION['cart'][$key])) {
        $_SESSION['cart'][$key]['quantity']++;
    }

    header("Location: cart.php");
    exit();
}

/* Decrease Quantity */
if (isset($_GET['decrease'])) {
    $key = $_GET['decrease'];

    if (isset($_SESSION['cart'][$key])) {
        if ($_SESSION['cart'][$key]['quantity'] > 1) {
            $_SESSION['cart'][$key]['quantity']--;
        }
    }

    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>My Cart</title>

<style>
body{
    font-family: Arial;
    background-color: #ffffffe6;
    padding: 30px;
}

h1{
    text-align: center;
    margin-bottom: 20px;
}

.cart-box{
    max-width: 950px;
    margin: auto;
}

.item{
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,.1);
}

.item img{
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 10px;
}

.product-info{
    flex: 1;
}

.qty-box{
    display: flex;
    align-items: center;
    gap: 10px;
}

.qty-btn{
    width: 38px;
    height: 36px;
    border-radius: 5px;
    color: white;
    text-decoration: none;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
}

.minus{
    background: orange;
}

.plus{
    background: darkblue;
}

.qty-number{
    font-weight: bold;
    font-size: 18px;
}

.cart-actions{
    display: flex;
    align-items: center;
    gap: 10px;
}

.remove,
.cart-order-now-btn{
    width: 120px;
    height: 38px;
    border-radius: 5px;
    color: white;
    text-decoration: none;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
}

.remove{
    background: red;
}

.cart-order-now-btn{
    background: green;
}

.home-btn{
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background: #111;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.total{
    font-size: 22px;
    font-weight: bold;
    text-align: right;
    margin-top: 20px;
}

.empty{
    text-align: center;
    background: white;
    padding: 25px;
    border-radius: 10px;
}
</style>

</head>
<body>

<main>

<h1>🛒 My Cart</h1>

<div class="cart-box">

<?php
$total = 0;

if (empty($_SESSION['cart'])) {
    echo "<h3 class='empty'>Your Cart is Empty</h3>";
} else {

    foreach ($_SESSION['cart'] as $key => $item) {

        $item_total = $item['price'] * $item['quantity'];
        $total += $item_total;
?>

<div class="item">

    <img src="../images/<?php echo htmlspecialchars($item['image']); ?>" alt="Product Image">

    <div class="product-info">
        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
        <p>Price: ₹<?php echo htmlspecialchars($item['price']); ?></p>
        <p>Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
        <p><b>Item Total:</b> ₹<?php echo $item_total; ?></p>
    </div>

    <div class="qty-box">
        <a href="cart.php?decrease=<?php echo $key; ?>" class="qty-btn minus">-</a>

        <span class="qty-number">
            <?php echo $item['quantity']; ?>
        </span>

        <a href="cart.php?increase=<?php echo $key; ?>" class="qty-btn plus">+</a>
    </div>

    <div class="cart-actions">

        <a href="cart.php?remove=<?php echo $key; ?>" class="remove">
            Remove
        </a>
        
        <a class="cart-order-now-btn"
           href="../product_details.php?id=<?php echo $item['id']; ?>">
           Order Now
       </a>
       

    </div>

</div>

<?php
    }
}
?>

<div class="total">
    Total : ₹<?php echo $total; ?>
</div>

<a href="../index.php" class="home-btn">
    ⬅ Continue Shopping
</a>

</div>

</main>

</body>
</html>