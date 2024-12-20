<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mabini Vape Shop</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(90deg,rgb(166, 222, 173),rgb(255, 255, 255),rgb(162, 199, 172));
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .fade-in { 
            animation: fadeIn 1s ease-in-out; 
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .hover-grow:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease-in-out;
        }

        .card {
            background: linear-gradient(to bottom right,rgb(103, 144, 108),rgb(139, 171, 230));
            border: 1px solid #e5e7eb;
            animation: moveLines 4s linear infinite;
        }

        @keyframes moveLines {
            0% { background-position: 0 0; }
            100% { background-position: 100% 100%; }
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
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-2px); }
            50% { transform: translateX(2px); }
            75% { transform: translateX(-2px); }
        }
    </style>
</head>
<body class="font-roboto bg-gray-100">
    <?php include 'nav-2.php'; ?>

    <div id="ageModal" class="fixed z-50 inset-0 bg-black bg-opacity-80 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg text-center w-11/12 max-w-sm">
            <img src="ch.jpg" alt="Age Restriction" class="rounded-lg mb-4">
            <h2 class="text-xl font-bold mb-2">Are you 18 or older?</h2>
            <p class="text-gray-600 mb-4">You must be at least 18 years old to access this site.</p>
            <button class="bg-green-500 text-white py-2 px-4 rounded-lg mr-2" onclick="acceptAge()">Yes, I am</button>
            <button class="bg-red-500 text-white py-2 px-4 rounded-lg" onclick="denyAge()">No, I’m not</button>
        </div>
    </div>

    <main class="text-center py-8">
        <section class="hero mb-8">
            <h1 class="text-3xl font-bold">Welcome to Mabini Vape Shop</h1>
            <p class="text-gray-600">Your one-stop shop for premium vape products.</p>
        </section>
        <section class="product-display grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-4">
            <div class="product-card">
                <img src="5.png" alt="Product 1" class="w-full rounded-lg shadow hover-grow">
            </div>
            <div class="product-card">
                <img src="logo.png" alt="Product 2" class="w-full rounded-lg shadow hover-grow">
            </div>
            <div class="product-card">
                <img src="3.png" alt="Product 3" class="w-full rounded-lg shadow hover-grow">
            </div>
        </section>
    </main>
    <footer class="footer text-center py-4 bg-gray-800 text-white">
        <p>&copy; 2024 Mabini Vape Shop. All rights reserved.</p>
    </footer>

    <script>
        function acceptAge() {
            document.getElementById('ageModal').style.display = 'none';
            localStorage.setItem('ageVerified', 'true');
        }

        function denyAge() {
            alert("You are not allowed to access this site.");
            window.location.href = "https://google.com";
        }

        if (localStorage.getItem('ageVerified') === 'true') {
            document.getElementById('ageModal').style.display = 'none';
        }
    </script>
</body>
</html>
