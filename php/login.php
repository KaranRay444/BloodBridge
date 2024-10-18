<?php include '../header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }
        .container {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100vh;
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
        }
        .login-form {
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 400px;
        }
        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .login-btn {
            width: 100%;
            padding: 10px;
            background-color: #c0392b;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
        }
        .login-btn:hover {
            background-color: #e74c3c;
        }
        .form-group a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #3498db;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <form class="login-form" action="login_process.php" method="POST">
                <h2>Login</h2>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="admin">Admin</option>
                        <option value="donor">Donor</option>
                        <option value="patient">Patient</option>
                    </select>
                </div>
                <button type="submit" class="login-btn">Login</button>
                <div class="form-group">
                    <a href="donor.php">Register as Donor</a>
                    <a href="need.php">Register as Recipient</a>
                </div>
            </form>
        </div>
        <?php include '../footer.php'; ?>
    </div>
</body>
</html>
