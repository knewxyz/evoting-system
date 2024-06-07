<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
    body {
        font-family: Arial;
        display: flex;
        background-color: white;
    }

    .sidebar {
        width: 250px;
        background-color: #1c2254;
        color: white;
        padding: 20px;
        border-radius: 10px;
        position: fixed;
    }

    .sidebar a {
        color: white;
        display: block;
        padding: 10px;
        text-decoration: none;
        border-radius: 10px;
    }

    .sidebar a:hover {
        background-color: #0d1238;
    }
    </style>

    </head>
<body>

<div class="sidebar">
    <h2>User Dashboard</h2>
    <a href="#" class="active"><i class="fas fa-home"></i> Home</a>
    <a href="ballot.php"><i class="fas fa-vote-yea"></i> Generate Ballot</a>
    <a href="candidate.php"><i class="fas fa-users"></i> View Candidates</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>
</body>
</html>
