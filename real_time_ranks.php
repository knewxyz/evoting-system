<?php
include_once "db_connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-time Rankings</title>
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
        }
        .wrapper {
            margin-left: 270px; /* Adjust based on the width of the sidebar */
            padding: 20px;
            width: calc(100% - 270px);
        }
        .rankings {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }
        h1{
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
        }
        .group {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 20px, auto;
            width: 50rem;
            align-items: center;
            justify-content: center;
        }
        .position {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .candidate {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .candidate-pic {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }
        .candidate-info {
            flex-grow: 1;
        }
        .vote-bar {
            width: 50%;
            background-color: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 5px;
        }
        .vote-bar-inner {
            height: 20px;
            background-color: #4caf50;
            max-width: 100%; /* Maximum width */
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="rankings">
            <h1>Real-time Rankings</h1>
            <?php
            // Fetch candidates and their votes
            $sql = "SELECT c.id, c.group_name, c.position, c.name, c.picture, COUNT(v.id) as votes 
                    FROM candidates c
                    LEFT JOIN votes v ON c.id = v.candidate_id
                    GROUP BY c.id
                    ORDER BY c.group_name, c.position, votes DESC";

            $result = $conn->query($sql);

            $candidates = [];
            $total_votes = 0;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $candidates[$row['group_name']][$row['position']][] = [
                        'name' => $row['name'],
                        'votes' => $row['votes'],
                        'picture' => $row['picture']
                    ];
                    $total_votes += $row['votes'];
                }
            }

            // Example end time (replace with actual end time)
            $endTime = strtotime('2024-06-30 23:59:59');

            foreach ($candidates as $group => $positions):
            ?>
                <div class="group">
                    <h2><?php echo $group; ?></h2>
                    <?php foreach ($positions as $position => $cands): ?>
                        <div class="position"><?php echo $position; ?>:</div>
                        <?php foreach ($cands as $candidate): ?>
                            <?php 
                            $percentage = ($total_votes > 0) ? ($candidate['votes'] / $total_votes) * 100 : 0;
                            ?>
                            <div class="candidate">
                                <img src="<?php echo $candidate['picture']; ?>" alt="Picture of <?php echo $candidate['name']; ?>" class="candidate-pic">
                                <div class="candidate-info">
                                    <div><?php echo $candidate['name']; ?> - <?php echo $candidate['votes']; ?> votes</div>
                                    <div class="vote-bar">
                                        <div class="vote-bar-inner" style="width: <?php echo $percentage; ?>%;"></div>
                                    </div>
                                    <div><?php echo number_format($percentage, 2); ?>%</div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
