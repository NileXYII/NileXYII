<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="orders-container">
        <div class="header">
            <h1>My Orders</h1>
        </div>
        <div class="orders-list">
            <div class="order-item">
                <div class="order-details">
                    <p><strong>Order ID:</strong> 1234567890</p>
                    <p><strong>Placed On:</strong> 01/09/2024</p>
                    <p><strong>Status:</strong> <span class="status pending">Pending</span></p>
                </div>
                <div class="order-actions">
                    <button onclick="trackOrder(1234567890)">Track Order</button>
                    <button onclick="contactSeller(1234567890)">Contact Seller</button>
                </div>
            </div>
            <!-- Additional orders -->
            <div class="order-item">
                <div class="order-details">
                    <p><strong>Order ID:</strong> 0987654321</p>
                    <p><strong>Placed On:</strong> 12/01/2023</p>
                    <p><strong>Status:</strong> <span class="status delivered">Delivered</span></p>
                </div>
                <div class="order-actions">
                    <button onclick="trackOrder(0987654321)">Track Order</button>
                    <button onclick="contactSeller(0987654321)">Contact Seller</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function trackOrder(orderId) {
            alert("Tracking Order ID: " + orderId);
            // Redirect to a tracking page if implemented
            // location.href = `track_order.php?order_id=${orderId}`;
        }

        function contactSeller(orderId) {
            alert("Contacting seller for Order ID: " + orderId);
            // Redirect to a message/chat system
            // location.href = `contact_seller.php?order_id=${orderId}`;
        }
    </script>
</body>
</html>
