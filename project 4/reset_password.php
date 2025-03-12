<?php
session_start();
require 'config.php';

function generateRandomPassword($length = 10) {
    return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, $length);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $phone = $_POST['phone'];

    // Check if participant exists
    $stmt = $conn->prepare("SELECT id FROM participants WHERE username = ? AND phone = ?");
    $stmt->execute([$username, $phone]);
    $participant = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($participant) {
        $new_password = generateRandomPassword();
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update new password in the database
        $update_stmt = $conn->prepare("UPDATE participants SET password = ? WHERE id = ?");
        $update_stmt->execute([$hashed_password, $participant['id']]);

        $_SESSION['message'] = "Your new password is: <strong>$new_password</strong>. Please log in and change it.";
    } else {
        $_SESSION['message'] = "Invalid username or phone number.";
    }

    header("Location: reset_password.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        .container {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <?php if (isset($_SESSION['message'])): ?>
            <p class="message"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>
            
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
