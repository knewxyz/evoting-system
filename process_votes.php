<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

include_once "db_connection.php";

// Collect the votes from the POST request
$votes = [];
foreach ($_POST as $key => $value) {
    list($group, $position) = explode('_', $key);
    $votes[] = [
        $_SESSION['username'] = $user['username'],
        $_SESSION['firstname'] = $user['firstname'],
        $_SESSION['lastname'] = $user['lastname'],
        'group' => $group,
        'position' => $position,
        'candidate_id' => $value
    ];
}

// Insert votes into the database
foreach ($votes as $vote) {
    $sql = "INSERT INTO votes (username, firstname, lastname, group_name, position, candidate_id) VALUES ('" . $vote['username'] . "', '" . $vote['firstname'] . "', '" . $vote['lastname'] . "', '" . $vote['group'] . "', '" . $vote['position'] . "', '" . $vote['candidate_id'] . "')"; // Corrected SQL query
    if (!$conn->query($sql)) {
        // Handle error
        echo "Error: " . $conn->error;
        exit();
    }
}


echo "<script>
        Swal.fire({
            title: 'Success!',
            text: 'Your votes have been submitted successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'user_dashboard.php';
        });
      </script>";
?>
