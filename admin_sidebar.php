<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            background-color: #1c2254;
            color: white;
            padding: 20px;
            position: fixed;
            border-radius:10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
            border-radius: 10px;
        }

        .sidebar a:hover {
            background-color: #c31932;
        }
    </style>
    </style>
</head>
<body>
<div class="sidebar">
        <h2>Admin Dashboard</h2>
        <a href="admin_dashboard.php" class="active"><i class="fas fa-home"></i> Home</a>
        <a href="add_candidate.php"><i class="fas fa-user-plus"></i> Add Candidate</a>
        <a href="candidate_lists.php"><i class="fas fa-users"></i> View Candidates</a>
        <a href="export_candidate.php"><i class="fas fa-file-export"></i> Export Candidates</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>

    </div>
</body>