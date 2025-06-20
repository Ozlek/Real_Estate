<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

include('RLES_include/config.php');

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contactno'];
    $email = $_POST['email'];

    $sql = "INSERT INTO emp_tbl (name, address, contactno, email) VALUES (:name, :address, :contact, :email)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([':name' => $name, ':address' => $address, ':contact' => $contact, ':email' => $email]);
}


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contactno'];
    $email = $_POST['email'];

    $sql = "UPDATE emp_tbl SET name = :name, address = :address, contactno = :contact, email = :email WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([':name' => $name, ':address' => $address, ':contact' => $contact, ':email' => $email, ':id' => $id]);
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM emp_tbl WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([':id' => $id]);
}


$edit_data = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM emp_tbl WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([':id' => $id]);
    $edit_data = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Admin Panel</title>
</head>
<body>
    <h2>Employee Admin Panel</h2>
    <p><a href="admin_home.php">Back to Home</a></p>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $edit_data['id'] ?? '' ?>">
        <label>Name:</label><br>
        <input type="text" name="name" required value="<?= $edit_data['name'] ?? '' ?>"><br>
        <label>Address:</label><br>
        <input type="text" name="address" required value="<?= $edit_data['address'] ?? '' ?>"><br>
        <label>Contact Number:</label><br>
        <input type="text" name="contactno" required value="<?= $edit_data['contactno'] ?? '' ?>"><br>
        <label>Email:</label><br>
        <input type="email" name="email" required value="<?= $edit_data['email'] ?? '' ?>"><br><br>

        <?php if ($edit_data): ?>
            <button type="submit" name="update">Update</button>
        <?php else: ?>
            <button type="submit" name="add">Add</button>
        <?php endif; ?>
    </form>

    <h3>Employee List</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th><th>Name</th><th>Address</th><th>Contact No</th><th>Email</th><th>Actions</th>
        </tr>
        <?php
        $stmt = $dbh->query("SELECT * FROM emp_tbl");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['address'] ?></td>
            <td><?= $row['contactno'] ?></td>
            <td><?= $row['email'] ?></td>
            <td>
                <a href="?edit=<?= $row['id'] ?>">Edit</a> |
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this employee?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>