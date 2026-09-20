<?php
require_once __DIR__ . '/db.php';

$sections = [
    'products' => [
        'title' => 'Products',
        'id' => 'product-section'
    ],
    'men' => [
        'title' => 'Men Wear',
        'id' => 'men-section'
    ],
    'women' => [
        'title' => 'Women Wear',
        'id' => 'women-section'
    ],
    'children' => [
        'title' => 'Children Wear',
        'id' => 'children-section'
    ],
    
    'new-arrivals' => [
        'title' => 'New Arrivals',
        'id' => 'new-arrivals'
    ]
];

foreach ($sections as $category => $section) {

    $stmt = $conn->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->execute([$category]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section id="<?php echo $section['id']; ?>" class="category-section">

    <h2><?php echo $section['title']; ?></h2>

    <div class="category-products">

        <?php if (count($products) > 0): ?>

            <?php foreach ($products as $product): ?>

                <div class="category-card">

                    <div class="image-box">
                        <img src="images/<?php echo htmlspecialchars($product['image']); ?>" 
                             alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </div>

                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>

                    <p><?php echo htmlspecialchars($product['description']); ?></p>

                    <?php if ($category != 'new-arrivals' && $category != 'new_arrivals'): ?>
                       <h4>₹<?php echo htmlspecialchars($product['price']); ?></h4>
                    <?php endif; ?>

                    <div class="product-buttons">
<!--
                        <form method="POST" action="pages/cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit" name="add_to_cart" class="add-to-cart-button">
                                Add to Cart
                            </button>
                        </form>-->
                    <?php if ($category == 'new-arrivals' || $category == 'new_arrivals'): ?>

    <a href="new_arrivals.php" class="explore-btn">
        Explore New Arrivals
    </a>

<?php else: ?>

    <a href="product_details.php?id=<?php echo $product['id']; ?>" class="order-btn">
        Order Now
    </a>

    <form method="post" action="pages/cart.php">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <button type="submit" name="add_to_cart" class="cart-btn">
            Add To Cart
        </button>
    </form>

<?php endif; ?>
                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <p class="no-products">
                No products available in <?php echo $section['title']; ?>.
            </p>

        <?php endif; ?>

    </div>

</section>

<?php } ?>