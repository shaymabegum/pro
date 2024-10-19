<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome, Admin</h2>

    <form action="view_faculty.php" method="GET">
        <button type="submit">View Faculty Table</button>
    </form>

    <form action="view_schedule_updates.php" method="GET">
        <button type="submit">View Schedule Updates</button>
    </form>

</body>
</html>
