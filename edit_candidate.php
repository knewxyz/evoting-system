<?php
include_once "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'id' and 'name' fields are set
    if (isset($_POST['id']) && isset($_POST['name'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];

        // Check if a file was uploaded
        if(isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
            // Process the uploaded file
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($_FILES['picture']['name']);
            // Move the uploaded file to the destination directory
            if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
                $picture = $uploadFile;
            } else {
                // Error handling for file upload failure
                echo json_encode(['status' => 'error', 'message' => 'Failed to upload picture.']);
                exit();
            }
        } else {
            // Use the existing picture if no new picture was uploaded
            $picture = isset($_POST['existing_picture']) ? $_POST['existing_picture'] : null;
        }

        $sql = "UPDATE candidates SET name = ?, picture = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $picture, $id);

        if ($stmt->execute()) {
            // Close the statement
            $stmt->close();
            // Redirect the admin to the candidate lists page
            echo json_encode(['status' => 'success', 'redirect' => 'candidate_lists.php']);
            exit();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update candidate.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID or name is missing.']);
    }
    $conn->close();
}
?>
