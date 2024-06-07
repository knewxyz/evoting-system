<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        /* Reset default margin and padding */
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

        /* Form container styles */
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 20px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #1c2254;
        }
        p{
            text-align: center;
            margin-bottom: 20px;
            color: #777;
            color: #1c2254;
        }

        /* Label styles */
        label {
            display: block;
            margin-bottom: 5px;
            color: #1c2254;
            transition: color 0.3s;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
            border: 1px solid #1c2254;
            transition: border-color 0.3s;
        }

        /* Input placeholder styles */
        input[type="text"]::placeholder,
        input[type="password"]::placeholder,
        select::placeholder {
            transition: all 0.3s;
            color: #1c2254;
        }

        input[type="text"]:hover::placeholder,
        input[type="password"]:hover::placeholder,
        select:hover::placeholder {
            transform: translateY(-30px);
            font-size: 12px;
            color: #1c2254;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        select:focus {
            outline: none;
            border-color: #007bff;
        }

        button {
            width: 100%;
            margin-top:10px;
            padding: 10px;
            background-color: #1c2254;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0d1238;
        }

        a.login-link {
            display: block;
            text-align: center;
            margin-top: 10px; /* Adjust margin as needed */
            color: #007BFF;
            text-decoration: none;
        }
        a.login-link:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <form action="register_process.php" method="post">
        <h2>REGISTER NOW</h2>
        <p>Register your information to vote!</p>
        <label for="firstname">First Name</label>
        <input type="text" name="firstname" placeholder="Enter your firstname" required>
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" placeholder="Enter your lastname" required>
        <label for="gradelevel" >Grade Level</label>
        <select name="gradelevel" required>
            <option value="" disabled selected hidden>Grade Level</option>
            <option value="7">Grade 7</option>
            <option value="8">Grade 8</option>
            <option value="9">Grade 9</option>
            <option value="10">Grade 10</option>
        </select>
        <label for="gender">Gender</label>
        <select name="gender" required>
            <option value="" disabled selected hidden>Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Enter a username" required>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Enter a password" required>
        <button type="submit">Register</button>
        <a href="login.php" class="login-link">Already a user? Login here</a>

    </form>
</body>
</html>
