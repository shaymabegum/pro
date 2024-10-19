<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "root", "faculty_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch updates from the schedule_updates table
$sql = "SELECT * FROM schedule_updates ORDER BY update_time DESC";
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    // Display SQL error
    die("Error fetching updates: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Notifications</title>
</head>
<body>
    <h2>Schedule Updates</h2>
    <?php if ($result->num_rows > 0) { ?>
        <table border="1">
            <tr>
                <th>Faculty ID</th>
                <th>Changes</th>
                <th>Update Time</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['faculty_id']; ?></td>
                    <td><?php echo $row['changes']; ?></td>
                    <td><?php echo $row['update_time']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No updates available.</p>
    <?php } ?>
</body>
</html>

<?php
$conn->close();
?>
