<?php
session_start();
include('RLES_include/config.php');

if (isset($_POST['login'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM adm_tbl WHERE id = :id AND password = :password";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $_SESSION['admin_id'] = $id;
        header("Location: admin_home.php");
        exit;
    } else {
        $error = "Invalid ID or Password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>ID:</label><br>
        <input type="number" name="id" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>