<?php
session_start();
    if (isset($_SESSION['error'])) {
        $error_message = $_SESSION['error'];
        unset($_SESSION['error']);
    } else {
        $error_message = "";
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Login Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            align-items: center;
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #1c2254;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #22253d;
            transition: color 0.3s;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px 0;
            border: 1px solid #1c2254;
            border-radius: 10px;
            transition: border-color 0.3s;
        }

        input[type="text"]::placeholder,
        input[type="password"]::placeholder {
            transition: border-color 0.3s;
            color: #1c2254;
        }

        input[type="text"]:focus::placeholder,
        input[type="text"]:hover::placeholder,
        input[type="password"]:focus::placeholder,
        input[type="password"]:hover::placeholder {
            transform: translateY(-30px);
            font-size: 12px;
            color: #1c2254;
            border-color: #007bff;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #1c2254;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        button:hover {
            background-color: #0d1238;
        }

        .register-link {
            display: block;
            text-align: left;
            margin-top: 20px;
            color: #007BFF;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>LOGIN NOW</h2>

    <?php if (!empty($error_message)): ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php endif; ?>
    
    <form action="login_process.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Enter your username" required>
        
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Enter your password" required>
        
        <button type="submit">Login</button>
        
        <a href="register.php" class="register-link">New user? Register here</a>
    </form>
</div>

</body>
</html>