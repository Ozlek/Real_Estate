<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Home</title>
</head>
<body>
    <h2>Welcome, Admin!</h2>
    <ul>
        <li><a href="admin_employee_database.php">Manage Employee Records</a></li>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="property_form.php">Properties</a></li>
    </ul>
</body>
</html>