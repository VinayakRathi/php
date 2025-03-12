<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_notice_board";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['username'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing Password
    $phone = $_POST['phone'];

    $sql = "INSERT INTO users (username, password, phone) VALUES ('$uname', '$pass', '$phone')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success text-center'>Registration successful!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg border border-primary" style="width: 25rem;">
        <h2 class="text-center">Register</h2>
        <form method="POST" action="" class="border p-3 rounded">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>
</body>
</html>
