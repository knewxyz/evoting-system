<?php
include_once "db_connection.php";

// Function to fetch candidates by group
function fetch_candidates($conn, $group_name) {
    $sql = "SELECT position, name, grade_level, picture FROM candidates WHERE group_name = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Preparation failed: " . $conn->error);
    }
    $stmt->bind_param("s", $group_name);
    if (!$stmt->execute()) {
        die("Execution failed: " . $stmt->error);
    }
    $result = $stmt->get_result();

    $candidates = [];
    while ($row = $result->fetch_assoc()) {
        $position = $row['position'];
        $grade_level = $row['grade_level'];
        $picture = $row['picture'];
        if ($grade_level) {
            $position .= " (Grade $grade_level)";
        }
        $candidates[$position][] = ['name' => $row['name'], 'picture' => $picture];
    }

    $stmt->close();
    return $candidates;
}

$group_names_sql = "SELECT DISTINCT group_name FROM candidates";
$group_names_result = $conn->query($group_names_sql);
$group_names = [];
if ($group_names_result->num_rows > 0) {
    while ($row = $group_names_result->fetch_assoc()) {
        $group_names[] = $row['group_name'];
    }
}

$conn->close();

function display_group($candidates, $group_name) {
    echo "<div class='group'>";
    echo "<h2>$group_name</h2>";
    foreach ($candidates as $position => $names) {
        echo "<p><strong>$position:</strong></p>";
        echo "<div class='candidates'>";
        foreach ($names as $candidate) {
            echo "<div class='candidate'>";
            echo "<p>{$candidate['name']}</p>";
            echo "<img src='{$candidate['picture']}' alt='{$candidate['name']}' width='100'>";
            echo "</div>";
        }
        echo "</div>";
    }
    echo "</div>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .group {
            width: 30%;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center; 
            color: #1c2254;
        }

        .group:hover {
            transform: translateY(-5px);
        }

        .group h2 {
            text-align: center;
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
            color: #1c2254;
        }

        p {
            margin: 0;
            padding: 5px 0;
            font-size: 16px;
            color: #1c2254;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .candidates {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            color: #1c2254;
        }

        .candidate {
             margin: 10px;
             text-align: center;
             color: #1c2254;
            }

    </style>
</head>
<body>
    <div class="container">
        <?php
        foreach ($group_names as $group_name) {
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $candidates = fetch_candidates($conn, $group_name);
            $conn->close();
            display_group($candidates, $group_name);
        }
        ?>
    </div>
</body>
</html>

</body>
</html>

</body>
</html>
