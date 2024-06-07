<?php
include_once "db_connection.php";
include_once "admin_sidebar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Lists</title>
    <style>
        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 360px; 
        }

        .rankings {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        h1 {
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

        .remove-button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="rankings">
            <h1>CANDIDATE LISTS</h1>
            <?php
            // Fetch candidates and their votes
            $sql = "SELECT c.id, c.group_name, c.position, c.name, c.picture
                    FROM candidates c
                    ORDER BY c.group_name, c.position, c.name";

            $result = $conn->query($sql);

            $candidates = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $candidates[$row['group_name']][$row['position']][] = [
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'picture' => $row['picture']
                    ];
                }
            }

            foreach ($candidates as $group => $positions):
            ?>

<div class="group">
    <h2><?php echo $group; ?></h2>
    <?php foreach ($positions as $position => $cands): ?>
        <div class="position"><?php echo $position; ?>:</div>
        <?php foreach ($cands as $candidate): ?>
            <div class="candidate" id="candidate-<?php echo $candidate['id']; ?>">
                <img src="<?php echo $candidate['picture']; ?>" alt="Picture of <?php echo $candidate['name']; ?>" class="candidate-pic">
                <div class="candidate-info">
                    <div><?php echo $candidate['name']; ?></div>
                </div>
                <div class="action-buttons">
                    <button class="remove-button" onclick="removeCandidate(<?php echo $candidate['id']; ?>)">Remove</button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>

<script>
    function removeCandidate(id) {
    if (confirm('Are you sure you want to remove this candidate?')) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_candidate.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    const candidateElement = document.getElementById('candidate-' + id);
                    if (candidateElement) {
                        candidateElement.remove();
                    }
                } else {
                    alert('Error: ' + response.message);
                }
            } else {
                alert('An error occurred while processing your request.');
            }
        };

        xhr.send('id=' + id);
    }
}


</script>

<?php endforeach; ?>
</body>
</html>
