<?php
include 'db_connection.php';

$sql = "SELECT * FROM candidates ORDER BY position, group_name";
$result = $conn->query($sql);

$candidates = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $candidates[$row['position']][] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();
?>
