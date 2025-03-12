<?php
session_start();
if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

$query = "SELECT * FROM notices ORDER BY uploaded_time DESC LIMIT 5";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Welcome, Student!</h2>
    <div class="card p-3 shadow-lg">
        <marquee direction="up" scrollamount="2" style="height: 150px;">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="alert alert-info"><?php echo $row['notice']; ?></div>
            <?php } ?>
        </marquee>
    </div>
    <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
</body>
</html>
