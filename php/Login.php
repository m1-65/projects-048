<?php
session_start(); // Start a new session to manage user login state
require 'users.php'; // Include the file with user data

$error_message = ''; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check if the username exists and the password matches
    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        $_SESSION['username'] = $username; // Store the username in the session
        header('Location: home.html'); // Redirect to the home page
        exit;
    } else {
        $error_message = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง'; // Incorrect username or password
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="css/m1.css">
</head>
<body class="g15">
    <div class="g16">
        <div class="g17">
            <h1 class="h9">เข้าสู่ระบบ</h1>
            <form id="loginForm" method="POST" action="Login.php">
                <label for="username">ชื่อผู้ใช้</label>
                <input type="text" name="username" id="username" placeholder="ชื่อผู้ใช้" required>
                <label for="password">รหัสผ่าน</label>
                <input type="password" name="password" id="password" placeholder="รหัสผ่าน" required>
                <button type="submit">ยืนยัน</button>
            </form>
            <p>ยังไม่มีบัญชีใช่ไหม? <a href="Sigm in.html">สมัครเลย</a></p>
            <p id="error-message" style="color: red;"><?= $error_message ?></p>
        </div>
    </div>
</body>
</html>