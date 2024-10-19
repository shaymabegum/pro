<?php
session_start();
$conn = new mysqli("localhost", "root", "root", "faculty_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $faculty_id = $_POST['faculty_id'];

    // Insert unavailability update into schedule_updates table
    $message = "Not available for invigilation";
    $sql = "INSERT INTO schedule_updates (faculty_id, changes) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $faculty_id, $message);
    
    if ($stmt->execute()) {
        header("Location: faculty_dashboard.php?message=unavailable_success");
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
