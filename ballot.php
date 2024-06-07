<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

include_once "db_connection.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voting Page</title>
    <style>
        .container {
            display: flex;
            margin-bottom: 20px;
        }
        .candidate {
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            text-align: center;
            flex: 1 1 45%;
            background-color: #f5f5ff;
        }
        .candidate img {
            width: 100px;
            height: 100px;
            border-radius: 3px;
        }
        h1, h2 {
            text-align: center;
            align-items: center;
        }
        .position-container {
            margin-bottom: 20px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const gradeLevelPositions = ['Grade 7 Representative', 'Grade 8 Representative', 'Grade 9 Representative', 'Grade 10 Representative'];
            const maxVotes = 2;

            gradeLevelPositions.forEach(position => {
                const checkboxes = document.querySelectorAll(`input[name="${position}[]"]`);
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', () => {
                        const checkedBoxes = document.querySelectorAll(`input[name="${position}[]"]:checked`);
                        if (checkedBoxes.length > maxVotes) {
                            checkbox.checked = false;
                            alert(`You can only vote for ${maxVotes} candidates for ${position}.`);
                        }
                    });
                });
            });

            const singleVotePositions = ['President', 'Vice-President', 'Secretary', 'Auditor', 'Treasurer'];
            singleVotePositions.forEach(position => {
                const checkboxes = document.querySelectorAll(`input[name="${position}"]`);
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', () => {
                        const checkedBox = document.querySelector(`input[name="${position}"]:checked`);
                        if (checkedBox && checkedBox !== checkbox) {
                            checkedBox.checked = false;
                        }
                    });
                });
            });
        });
    </script>
</head>
<body>

<h1>Vote for Your Candidates</h1>

<?php
include 'fetch_candidates.php';

// Debugging: Check if $candidates is properly populated
if (empty($candidates)) {
    echo "Error: No candidates found.";
    exit;
}
?>

<form id="voteForm" action="vote.php" method="post">
    <?php foreach ($candidates as $position => $cands): ?>
        <div class="position-container">
            <h2><?php echo htmlspecialchars($position); ?></h2>
            <div class="container">
                <?php foreach ($cands as $cand): ?>
                    <div class="candidate">
                        <img src="<?php echo htmlspecialchars($cand['picture']); ?>" alt="<?php echo htmlspecialchars($cand['name']); ?>">
                        <h3><?php echo htmlspecialchars($cand['name']); ?></h3>
                        <p>Group: <?php echo htmlspecialchars($cand['group_name']); ?></p>
                        <p>Grade Level: <?php echo htmlspecialchars($cand['grade_level']); ?></p>
                        <input type="radio_button" name="votes[]" value="<?php echo htmlspecialchars($cand['id']); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Include the user_id in a hidden input field -->
    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">

    <div style="text-align: center;">
        <button type="submit">Submit Votes</button>
    </div>
</form>

</body>
</html>
