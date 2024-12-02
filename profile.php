<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>


    <?php include 'userdashboard/user-nav.php'; ?>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            width: 80%;
            max-width: 900px;
            margin: 50px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1;
            margin-right: 15px;
        }

        .form-group:last-child {
            margin-right: 0;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="text"]:focus, input[type="number"]:focus, select:focus {
            outline: none;
            border-color: #888;
        }

        .form-row .profile-pic {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-pic img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 1px solid #ccc;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .save-btn {
            background-color: green;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            display: block;
            margin: 0 auto;
        }

        .save-btn:hover {
            background-color: #005a00;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>
        <form action="save_profile.php" method="post" enctype="multipart/form-data">
            <!-- Profile Picture -->
            <div class="form-row">
                <div class="profile-pic">
                    <img src="1.png" alt="Profile Picture" id="profile-preview">
                    <input type="file" name="profile_picture" accept="image/*" onchange="loadProfilePicture(event)">
                </div>
            </div>

            <!-- Profile Information -->
            <div class="form-row">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" id="full_name" value="Jeno Kyle Recio">
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number*</label>
                    <input type="text" name="contact_number" id="contact_number" value="+63 9958142706">
                </div>
            </div>

            <!-- Address Information -->
            <div class="form-row">
                <div class="form-group">
                    <label for="address_line_1">Address Line 1*</label>
                    <input type="text" name="address_line_1" id="address_line_1" value="B1 L1 NU St. FAIRVIEW FAIRVIEW">
                </div>
                <div class="form-group">
                    <label for="address_line_2">Address Line 2 (Optional)</label>
                    <input type="text" name="address_line_2" id="address_line_2">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="barangay">Barangay*</label>
                    <select name="barangay" id="barangay">
                        <option value="123">BARANGAY 123</option>
                        <option value="124">BARANGAY 124</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="city">City / Municipality*</label>
                    <select name="city" id="city">
                        <option value="quezon">QUEZON CITY</option>
                        <option value="manila">MANILA</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="region">Region*</label>
                    <select name="region" id="region">
                        <option value="metro_manila">METRO MANILA</option>
                        <option value="central_luzon">CENTRAL LUZON</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="postal_code">Postal Code*</label>
                    <input type="number" name="postal_code" id="postal_code" value="1234">
                </div>
            </div>

            <button type="submit" class="save-btn">Save</button>
        </form>
    </div>

    <script>
        function loadProfilePicture(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('profile-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
