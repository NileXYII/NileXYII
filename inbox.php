<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
    <link rel="stylesheet" href="inbox.css">
</head>
<?php include 'userdashboard/user-nav.php'; ?>

<body>
    <div class="inbox-container">
        <div class="header">
            <h1>Inbox</h1>
            <button class="compose-btn" onclick="composeMessage()">Compose</button>
        </div>
        <div class="inbox-content">
            <div class="messages-list">
                <div class="message-item active" onclick="openMessage(1)">
                    <span class="icon">✉️</span>
                    <div class="message-preview">
                        <p class="subject">ORDER STATUS: ORDER ID 1234567890 | PENDING</p>
                        <p class="time">01/09/2024 12:30AM</p>
                    </div>
                </div>
                <!-- Add more message items here -->
            </div>
            <div class="message-details">
                <p><strong>Hi Jeno,</strong></p>
                <p>Your order has been placed with order ID <strong>1234567890</strong>. You can go to the <a href="#">'Track Order'</a> page to check the status of your order. Should you have any question/concern, please send us a message. Thank you!</p>
            </div>
        </div>
    </div>

    <script>
        function composeMessage() {
            alert("Compose Message Clicked!");
        }

        function openMessage(id) {
            // Load specific message content dynamically based on ID
            alert("Opening message " + id);
        }
    </script>
</body>
</html>
