<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $notice = $_POST['notice'];
    $query = "INSERT INTO notices (notice) VALUES ('$notice')";
    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Admin Panel</h2>
    <form method="POST">
        <textarea name="notice" class="form-control mb-2" required></textarea>
        <button type="submit" class="btn btn-success">Post Notice</button>
    </form>
</body>
</html>
