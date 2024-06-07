<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include_once "db_connection.php";
include_once "admin_sidebar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data (you can add more validation as needed)
    $group_name = $_POST['group_name'];
    $position = $_POST['position'];
    $name = $_POST['name'];
    $grade_level = $_POST['grade_level'];

    // File upload handling
    $picture = $_FILES['picture']['name'];
    $temp_file = $_FILES['picture']['tmp_name'];
    $uploads_dir = 'uploads/';
    $target_file = $uploads_dir . basename($picture);

    // Move uploaded file to designated location
    move_uploaded_file($temp_file, $target_file);

    // Insert candidate data into the database
    $sql = "INSERT INTO candidates (group_name, position, name, picture, grade_level) VALUES ('$group_name', '$position', '$name', '$target_file', '$grade_level')";
    if ($conn->query($sql) === TRUE) {
        // Success message
        echo "<script>
                Swal.fire({
                  title: 'Success!',
                  text: 'Candidate added successfully',
                  icon: 'success',
                  confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'admin_dashboard.php'; // Redirect to admin dashboard after confirmation
                });
              </script>";
    } else {
        // Error message
        echo "<script>
                Swal.fire({
                  title: 'Error!',
                  text: 'Error adding candidate: " . $conn->error . "',
                  icon: 'error',
                  confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'admin_dashboard.php'; // Redirect to admin dashboard after confirmation
                });
              </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Candidate</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 500px;
            margin-top: 9px;
            margin-left: 90px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            color: #1c2254;
        }

        input[type="text"],
        select,
        input[type="file"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #1c2254;
            color: white;
            cursor: pointer;
            border-radius: 10px;
        }

        input[type="submit"]:hover {
            background-color: #c31932;
        }

        input[type="text"]:focus,
        select:focus,
        input[type="file"]:focus {
            outline: none;
            border-color: #007bff;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Add Candidate</h1>
    
    <!-- Form to add candidate -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <label for="group_name">Group Name:</label><br>
        <input type="text" id="group_name" name="group_name" required><br>
        <label for="position">Position:</label><br>
        <input type="text" id="position" name="position" required><br>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="grade_level">Grade Level:</label><br>
        <select id="grade_level" name="grade_level">
            <option value="7">Grade 7</option>
            <option value="8">Grade 8</option>
            <option value="9">Grade 9</option>
            <option value="10">Grade 10</option>
        </select><br>
        <label for="picture">Picture:</label><br>
        <input type="file" id="picture" name="picture" required><br>
        <input type="submit" value="Add Candidate">
    </form>

</body>
</html>