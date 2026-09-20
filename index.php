<?php
session_start();

// Logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: pages/register.php");
    exit();
}

// Login/Register check
if (!isset($_SESSION['user_id'])) {
    header("Location: pages/register.php");
    exit();
}

include 'includes/db.php';

// Fetch products
$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$men = $conn->query("SELECT * FROM products WHERE category='men'")->fetchAll(PDO::FETCH_ASSOC);

$women = $conn->query("SELECT * FROM products WHERE category='women'")->fetchAll(PDO::FETCH_ASSOC);

$children = $conn->query("SELECT * FROM products WHERE category='children'")->fetchAll(PDO::FETCH_ASSOC);

$new_arrivals = $conn->query("SELECT * FROM products WHERE category='new-arrivals'")->fetchAll(PDO::FETCH_ASSOC);

?> 



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Online Store</title>
<!--<link rel="stylesheet" href="css/product_slider.css"> -->
<!--<link rel="stylesheet" href="css/coverflow.css">-->
<link rel="stylesheet" href="css/category.css?v=3">
<link rel="stylesheet" href="css/arch.css">
<style>

/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    background:#f4f6f8;
}

/* HEADER */
header{
    background:#111;
    color:white;
    padding:15px 25px;
    position:sticky;
    top:0;
    z-index:1000;
}

.header-container{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* LOGO */
.logo{
    font-size:22px;
    font-weight:bold;
}

/* NAV */
nav{
    display:flex;
    align-items:center;
    gap:12px;
}

nav a{
    color:white;
    text-decoration:none;
    padding:8px 12px;
    border-radius:6px;
    transition:0.3s;
}

nav a:hover{
    background:#333;
}

/* CART BUTTON  */
.cart1-btn{
    background:white;
    color:black;
    font-weight:bold;
    padding:8px 14px;
    border-radius:8px;
    text-decoration:none;
    transition:0.3s;
}

.cart-btn:hover{
    background:#ffaa00;
}
/* LOGOUT */
.logout-button{
    background:red;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:6px;
    cursor:pointer;
}

.logout-button:hover{
    background:darkred;
}

/* HERO */
.hero{
    height:320px;
    display:flex;
    justify-content:center;
    align-items:center;
    text-align:center;
    color:white;
    background:linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),
    url('images/banner.jpg');
    background-size:cover;
    background-position:center;
}

.hero h2{
    font-size:42px;
}

.hero p{
    font-size:18px;
    margin-top:10px;
}

/* MAIN */
main{
    padding:40px;
}

main h2{
    text-align:center;
    margin-bottom:25px;
}

/* PRODUCTS GRID */
.product-list{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
    gap:25px;
}

/* PRODUCT CARD */
.product{
    background:white;
    padding:15px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
    text-align:center;
    transition:0.3s;
}

.product:hover{
    transform:translateY(-8px);
}

.product-image{
    width:100%;
    height:220px;
    object-fit:cover;
    border-radius:10px;
}

.product h3{
    margin:10px 0;
}

/* BUTTON  */
.add-to-cart-button{
    margin-top:10px;
    padding:10px 22px;
    border:none;
    background:#111;
    color:white;
    cursor:pointer;
    border-radius:8px;
    transition:0.3s;
}

.add-to-cart-button:hover{
    background:#333;
}

/* FOOTER */
footer{
    margin-top:40px;
    background:#111;
    color:white;
    text-align:center;
    padding:15px;
}

/* MOBILE */
@media(max-width:600px){
    .header-container{
        flex-direction:column;
        gap:10px;
    }

    .hero h2{
        font-size:28px;
    }
}
.hero{
    height:300px;
    display:flex;
    justify-content:center;
    align-items:center;
    text-align:center;
    color:white;
    background:
    linear-gradient(rgba(0,0,0,0.45),rgba(0,0,0,0.45)),
    url('images/home4.png');

    background-size:cover;
    background-position:center;
    background_reno-repeat;
}

.products-banner{
    width:100%;
    margin-bottom:30px;
}

.products-banner img{
    width:100%;
    height:350px;
    object-fit:cover;
    border-radius:15px;
    box-shadow:0 4px 15px rgba(0,0,0,0.2);
}



.order-btn{
    margin-top: 12px;
    padding: 10px 22px;
    background:green;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s ease;
}

.order-btn:hover{
    background: #e65c00;
    transform: scale(1.05);
}

.order-btn:active{
    transform: scale(0.95);
} 
    


.cart-btn,
.order-btn{
    width:100px;
    height:45px;
    border:none;
    border-radius:8px;
    font-size:15px;
    font-weight:600;
    display:inline-flex;
    justify-content:center;
    align-items:center;
    text-decoration:none;
    cursor:pointer;
    box-sizing:border-box;
}

/* Add To Cart */
.cart-btn{
    background:#0b1f3a;
    color:white;
}

/* Order Now */
.order-btn{
    background:#c49a2c;
    color:white;
}

.product a{
    display: inline-block;
    margin-top: 8px;
    text-decoration: none;
}




.product-buttons form{
    margin:0;
    padding:0;
    display:flex;
}

.cart-btn,
.order-btn{
    width:140px;
    height:45px;
    padding:0;
    margin:0;
    border:none;
    border-radius:8px;
    font-size:15px;
    font-weight:600;
    display:inline-flex;
    justify-content:center;
    align-items:center;
    text-decoration:none;
    cursor:pointer;
    box-sizing:border-box;
    line-height:45px;
}

.cart-btn{
    background:black;
    color:white;
}

.order-btn{
    background:#c49a2c;
    color:white;
}





.explore-btn{
    display:inline-block;
    width:130px;
    padding:10px;
    margin:6px;
    border:none;
    border-radius:6px;
    font-weight:bold;
    cursor:pointer;
    text-align:center;
    text-decoration:none;
    transition:0.3s ease;
}
.explore-btn{
    background:blue;
    color:white;
    width:180px;
}

.explore-btn:hover{
    background:#0056b3;
    transform:translateY(-2px);
    }
    
    
    /* MOBILE HOME PAGE FIX - Flipkart/Amazon style */
@media(max-width:600px){
    main{
        padding:10px;
    }

    .hero{
        height:220px;
        padding:0 12px;
    }

    .hero h2{
        font-size:26px;
    }

    .hero p{
        font-size:14px;
    }

    .category-buttons{
        gap:8px;
        margin:18px 0;
    }

    .category-buttons a{
        padding:9px 13px;
        font-size:13px;
    }

    .product-buttons{
        flex-direction:column;
    }

    .cart-btn,
    .order-btn,
    .explore-btn{
        width:100%;
        height:34px;
        font-size:12px;
        margin:0;
        padding:0;
    }
}
    
    

</style>

</head>
<body>

<header>
    <div class="header-container">

        <h1 class="logo">🛍️ FashonNest</h1>

     <nav>
            <a href="index.php">Home</a>
            
            

            <!-- CART ICON -->
            <a href="pages/cart.php" class="cart1-btn">
                🛒 Cart
            </a>

            <a href="pages/logout.php" class="logout-button">Logout</a>

            <?php if(isset($_SESSION['user'])): ?>
                <form method="POST" style="display:inline;">
                    <button type="submit" name="logout" class="logout-button">
                        Logout
                    </button>
                </form>
            <?php endif; ?>

        </nav>

    </div>
</header>

<section class="hero">
    <div>
        <h2>Welcome to Our Store</h2>
        <p>Find the Best Products at Amazing Prices</p>
    </div>
</section>

<section class="arch-coverflow-section">

    <h2>Product Highlight</h2>
    <p class="arch-subtitle">Explore our latest fashion collection</p>

    <div class="arch-slider">

        <div class="arch-item active">
            <div class="arch-bg bg1">
                <img src="images/men1.jpg" alt="Product 1">
            </div>
        </div>

        <div class="arch-item next">
            <div class="arch-bg bg2">
                <img src="images/men2.jpg" alt="Product 2">
            </div>
        </div>

        <div class="arch-item far-next">
            <div class="arch-bg bg3">
                <img src="images/wo1.jpg" alt="Product 3">
            </div>
        </div>

        <div class="arch-item">
            <div class="arch-bg bg4">
                <img src="images/wo3.jpg" alt="Product 4">
            </div>
        </div>

        <div class="arch-item">
            <div class="arch-bg bg5">
                <img src="images/ki1.jpg" alt="Product 5">
            </div>
        </div>

        <div class="arch-item">
            <div class="arch-bg bg1">
                <img src="images/ki.jpg" alt="Product 6">
            </div>
        </div>

        <div class="arch-item">
            <div class="arch-bg bg2">
                <img src="images/wo4.jpg" alt="Product 7">
            </div>
        </div>

        <div class="arch-item">
            <div class="arch-bg bg3">
                <img src="images/men5.jpg" alt="Product 8">
            </div>
        </div>

        <div class="arch-item far-prev">
            <div class="arch-bg bg4">
                <img src="images/image6.jpeg" alt="Product 9">
            </div>
        </div>

        <div class="arch-item prev">
            <div class="arch-bg bg5">
                <img src="images/wo5.jpg" alt="Product 10">
            </div>
        </div>

    </div>



    <div class="arch-buttons">
      <button type="button" onclick="prevArch()">←</button>
      <button type="button" onclick="nextArch()">→</button>
    </div>
</section>
        

<main>

    <?php include 'includes/category_buttons.php'; ?>

    <?php include 'includes/all_product_sections.php'; ?>

</main>

<footer>
<p>&copy; <?= date('Y'); ?> Online Store. All rights reserved.</p>
</footer>

      <script src="js/category_scroll.js"></script>


<script>
let archIndex = 2;
let archMoving = false;

function updateArch(){
    let items = document.querySelectorAll(".arch-item");
    let total = items.length;

    items.forEach(item => {
        item.className = "arch-item";
    });

    items[(archIndex - 2 + total) % total].classList.add("far-prev");
    items[(archIndex - 1 + total) % total].classList.add("prev");
    items[archIndex].classList.add("active");
    items[(archIndex + 1) % total].classList.add("next");
    items[(archIndex + 2) % total].classList.add("far-next");
}

function nextArch(){
    if(archMoving) return;

    archMoving = true;

    let items = document.querySelectorAll(".arch-item");
    archIndex = (archIndex + 1) % items.length;
    updateArch();

    setTimeout(() => {
        archMoving = false;
    }, 650);
}

function prevArch(){
    if(archMoving) return;

    archMoving = true;

    let items = document.querySelectorAll(".arch-item");
    archIndex = (archIndex - 1 + items.length) % items.length;
    updateArch();

    setTimeout(() => {
        archMoving = false;
    }, 650);
}

document.addEventListener("DOMContentLoaded", updateArch);
</script>
      

</body>
</html>