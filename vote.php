<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id']) && isset($_POST['votes'])) {
    $user_id = $_POST['user_id'];
    $selected_candidates = $_POST['votes'];

    if (!isset($user_id)) {
        echo "Error: User ID is not provided.";
        exit;
    }

    $user_check_query = "SELECT id FROM users WHERE id = ?";
    $stmt = $conn->prepare($user_check_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "Error: User with ID $user_id does not exist.";
        exit;
    }

    $conn->begin_transaction();

    try {
        foreach ($selected_candidates as $candidate_id) {
            $sql = "INSERT INTO votes (candidate_id, user_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . $conn->error);
            }
            $stmt->bind_param("ii", $candidate_id, $user_id);

            if (!$stmt->execute()) {
                throw new Exception("Error recording vote: " . $stmt->error);
            }
            $stmt->close();
        }

        $conn->commit();
        echo "Votes recorded successfully.";
    } catch (Exception $e) {
        $conn->rollback();
        echo $e->getMessage();
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
