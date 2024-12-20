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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('9.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .fade-in {
            animation: fadeIn 1s ease-in;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 99;
            }
        }
        .hover-grow:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
        }
        .card {
            background: linear-gradient(to bottom,rgb(255, 255, 255),rgb(99, 163, 125));
            border: 1px solid #e5e7eb;
        }
        .badge {
            background-color: #facc15;
            color: #000;
            font-size: 0.75rem;
            font-weight: bold;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            position: absolute;
            top: 1rem;
            right: 1rem;
        }
        .card:hover .badge {
            animation: shake 0.5s;
        }
        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }
            25% {
                transform: translateX(-2px);
            }
            50% {
                transform: translateX(2px);
            }
            75% {
                transform: translateX(-2px);
            }
        }
    </style>
</head>
<body class="text-gray-900">
    <?php include 'nav-2.php'; ?>

    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-bold text-center mb-10 fade-in"> </h1>

        <!-- Error Message Display -->
        <?php 
        if (isset($_SESSION['error'])) {
            echo "<div class='text-red-500 text-center mb-4'>" . htmlspecialchars($_SESSION['error']) . "</div>";
            unset($_SESSION['error']);
        }
        ?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="relative p-6 card rounded-lg shadow-lg hover-grow">
                    <?php
                    // Clean and validate image path
                    $cleanedImagePath = cleanImagePath($row['image']);
                    $imagePath = "admin/" . $cleanedImagePath;
                    $fullImagePath = $_SERVER['DOCUMENT_ROOT'] . '/vape/' . $imagePath;
                    ?>

                    <!-- Badge for New or Popular -->
                    <div class="badge">New</div>

                    <!-- Image Display with Error Handling -->
                    <?php if (file_exists($fullImagePath)): ?>
                        <img class="w-full h-40 object-cover rounded-t-lg" src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                    <?php else: ?>
                        <div class="w-full h-40 flex items-center justify-center bg-gray-200 text-gray-500 rounded-t-lg">
                            <p>Image Unavailable</p>
                        </div>
                    <?php endif; ?>

                    <h2 class="mt-4 text-lg font-semibold text-gray-800"><?= htmlspecialchars($row['name']) ?></h2>
                    <p class="mt-2 text-gray-600">Price: <?= number_format($row['price'], 2) ?> PHP</p>

                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" class="mt-4">
                        <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="product_name" value="<?= $row['name'] ?>">
                        <input type="hidden" name="product_price" value="<?= $row['price'] ?>">
                        <input type="hidden" name="product_image" value="<?= $row['image'] ?>">
                        <button type="submit" name="add_to_cart" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">Add to Cart</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-10">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?= $i ?>" class="mx-2 px-4 py-2 rounded border <?= ($page == $i ? 'bg-blue-500 text-white' : 'bg-white text-blue-500 border-blue-500') ?> hover:bg-blue-600 hover:text-white transition">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>

    </div>
</body>
</html>
