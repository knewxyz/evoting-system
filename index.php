<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            align-items: center;
            background-color: #333;
            padding: 10px;
        }

        .navbar .brand {
            margin-right: auto;
            padding-left: 20px;
            font-size: 1.5em;
            color: white;
            text-decoration: none;
        }

        .navbar a {
            padding: 14px 16px;
            color: white;
            text-align: center;
            text-decoration: none;
        }

        .navbar a:hover, .dropdown:hover .dropbtn {
            background-color: #ddd;
            color: black;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown .dropbtn {
            font-size: 16px;
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            /* Add padding here */
            padding-left: 10px;
            padding-right: 10px;
}


        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
            color: black;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .navbar .nav-items {
            display: flex;
            margin-left: 10rem;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="index.php" class="brand">MyWebsite</a>
    <div class="nav-items">
        <a href="index.php">Home</a>
        <a href="candidate.php">Candidates</a>
        <a href="results.php">Results</a>
        <div class="dropdown">
            <button class="dropbtn">More 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="login.php">Log In</a>
                <a href="register.php">Register</a>
                <a href="about.php">About</a>
            </div>
        </div>
    </div>
</div>

<!-- Add your page content here -->

</body>
</html>
