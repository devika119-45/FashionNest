<?php
require_once __DIR__ . '/db.php';

$categories = [
    'men' => [
        'title' => 'Men Wear',
        'section_id' => 'men-section'
    ],
    'women' => [
        'title' => 'Women Wear',
        'section_id' => 'women-section'
    ],
    'children' => [
        'title' => 'Children Wear',
        'section_id' => 'children-section'
    ],
    'new-arrivals' => [
        'title' => 'New Arrivals',
        'section_id' => 'new-arrivals'
    ]
];

foreach ($categories as $categoryKey => $categoryData) {

    $stmt = $conn->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->execute([$categoryKey]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section id="<?php echo $categoryData['section_id']; ?>" class="category-section">

    <h2><?php echo $categoryData['title']; ?></h2>

    <div class="category-products">

        <?php if (count($products) > 0): ?>

            <?php foreach ($products as $product): ?>

                <div class="category-card">

                    <img 
                        src="images/<?php echo htmlspecialchars($product['image']); ?>" 
                        alt="<?php echo htmlspecialchars($product['name']); ?>"
                    >

                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>

                    <p>
                        <?php echo htmlspecialchars($product['description']); ?>
                    </p>

                    
                    <?php if ($category != 'new-arrivals'): ?>
                      <h4>₹<?php echo htmlspecialchars($product['price']); ?></h4>
                    <?php endif; ?>

                    <?php if ($categoryKey == 'new-arrivals'): ?>

                        
                        <a href="new-arrivals.php" class="explore-btn">
                            Explore New Arrivals
                        </a>

                    <?php else: ?>

                        <form method="POST" action="pages/cart.php" class="cart-form">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit" name="add_to_cart" class="cart-btn">
                                Add to Cart
                            </button>
                        </form>

                        <a href="product_details.php?id=<?php echo $product['id']; ?>" class="order-btn">
                            Order Now
                        </a>

                    <?php endif; ?>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <p class="no-products">
                No products available in <?php echo $categoryData['title']; ?>.
            </p>

        <?php endif; ?>

    </div>

</section>

<?php
}
?>