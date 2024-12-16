<?php
// Enhanced error reporting and session management
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection with error handling
try {
    include 'connection.php';
    
    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    die("Sorry, there was a problem connecting to the database. Please try again later.");
}

// Clean image path function
function cleanImagePath($imagePath) {
    // Remove duplicate 'uploads/' and ensure correct path
    $cleanPath = preg_replace('/uploads\/uploads\//', 'uploads/', $imagePath);
    return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $cleanPath);
}

// Cart Management Class
class CartManager {
    public static function addToCart($product, $quantity) {
        // Validate quantity between 1-10
        $quantity = max(1, min(intval($quantity), 10));

        $cart_item = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'image' => $product['image'],
            'quantity' => $quantity
        ];

        // Initialize or update cart
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $cart = &$_SESSION['cart'];
        $found = false;

        // Update quantity if item exists
        foreach ($cart as &$item) {
            if ($item['id'] == $product['id']) {
                $item['quantity'] = min($item['quantity'] + $quantity, 10);
                $found = true;
                break;
            }
        }

        // Add new item if not found
        if (!$found) {
            $cart[] = $cart_item;
        }
    }
}

// Handle Add to Cart with improved error handling
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    try {
        // Validate and sanitize inputs
        $product = [
            'id' => filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT),
            'name' => filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING),
            'price' => filter_input(INPUT_POST, 'product_price', FILTER_VALIDATE_FLOAT),
            'image' => filter_input(INPUT_POST, 'product_image', FILTER_SANITIZE_STRING)
        ];

        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1, 'max_range' => 10]
        ]);

        // Validate product data
        if ($product['id'] === false || $product['name'] === false || 
            $product['price'] === false || $quantity === false) {
            throw new Exception("Invalid product or quantity");
        }

        // Add to cart
        CartManager::addToCart($product, $quantity);

        // Redirect to prevent form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();

    } catch (Exception $e) {
        // Log error and set error message
        error_log($e->getMessage());
        $_SESSION['error'] = "Sorry, we couldn't add the item to your cart.";
    }
}

// Fetch products with error handling
try {
    // Pagination setup
    $products_per_page = 12;
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $offset = ($page - 1) * $products_per_page;

    // Get total products count
    $count_result = $conn->query("SELECT COUNT(*) as total FROM products");
    $total_products = $count_result->fetch_assoc()['total'];
    $total_pages = ceil($total_products / $products_per_page);

    // Fetch products with pagination
    $query = "SELECT * FROM products LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $products_per_page, $offset);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        throw new Exception("Error fetching products: " . $conn->error);
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    die("Sorry, we couldn't load the products right now.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="shop.css">
</head>
<body>
    <?php include 'nav-2.php'; ?>

    <div class="content">
        <h1></h1>

        <!-- Error Message Display -->
        <?php 
        if (isset($_SESSION['error'])) {
            echo "<div class='error-message'>" . htmlspecialchars($_SESSION['error']) . "</div>";
            unset($_SESSION['error']);
        }
        ?>

        <div class="product-list">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product">
                    <?php
                    // Clean and validate image path
                    $cleanedImagePath = cleanImagePath($row['image']);
                    $imagePath = "admin/" . $cleanedImagePath;
                    $fullImagePath = $_SERVER['DOCUMENT_ROOT'] . '/vape/' . $imagePath;
                    ?>

                    <!-- Image Display with Error Handling -->
                    <?php if (file_exists($fullImagePath)): ?>
                        <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                    <?php else: ?>
                        <div class="no-image">
                            <p>Image Unavailable</p>
                            <!-- Debug info (remove in production) -->
                            <small><?= htmlspecialchars($fullImagePath) ?></small>
                        </div>
                    <?php endif; ?>

                    <h2><?= htmlspecialchars($row['name']) ?></h2>
                    <p>Price: <?= number_format($row['price'], 2) ?> PHP</p>

                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                        <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="product_name" value="<?= $row['name'] ?>">
                        <input type="hidden" name="product_price" value="<?= $row['price'] ?>">
                        <input type="hidden" name="product_image" value="<?= $row['image'] ?>">
                    </form>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?= $i ?>" <?= ($page == $i ? 'class="active"' : '') ?>>
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>

    </div>
</body>
</html>