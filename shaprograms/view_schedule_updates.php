<?php
session_start();
$conn = new mysqli("localhost", "root", "root", "faculty_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['faculty_id'])) {
    header("Location: login.php");
    exit();
}

$faculty_id = $_SESSION['faculty_id'];

// Prepare the SQL statement
$sql = "SELECT * FROM schedule_updates WHERE faculty_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error); // Show the error if prepare fails
}

$stmt->bind_param("i", $faculty_id);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error); // Show the error if execute fails
}

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Schedule Updates</title>
</head>
<body>
<h2>Schedule Updates for Faculty ID: <?php echo $faculty_id; ?></h2>

<table>
    <tr>
        <th>Update ID</th>
        <th>Changes</th>
        <th>Date</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['changes']; ?></td>
        <td><?php echo $row['date']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
