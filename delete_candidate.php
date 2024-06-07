<?php
include_once "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $candidate_id = intval($_POST['id']);

    if ($candidate_id > 0) {
        $sql = "DELETE FROM candidates WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $candidate_id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete candidate.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid candidate ID.']);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
