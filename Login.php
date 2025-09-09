<?php
session_start(); // Start a new session to manage user login state
require 'db.php'; // Include the file with user data

$error_message = ''; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM player WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['password'] === $password) {
        $_SESSION['username'] = $username;
        header('Location: /projects-048/index.html');
        exit;
    } else {
        $error_message = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="m1.css">
</head>
<body class="g15">
    <script>
  document.addEventListener('click', function(e) {
    const img = document.createElement('img');
    img.src = 'https://preview.redd.it/why-roblox-man-face-look-like-eli-vance-v0-z3m1p17h7rxc1.png?width=420&format=png&auto=webp&s=571080804dec87186545e0176a305619b453e632'; // เปลี่ยนลิงก์ภาพได้
    img.className = 'click-image';
    img.style.left = e.pageX + 'px'; // ลบครึ่งหนึ่งของความกว้างเพื่อให้ภาพอยู่กลางคลิก
    img.style.top = e.pageY + 'px';  // ลบครึ่งหนึ่งของความสูง

    document.body.appendChild(img);

    // ลบภาพออกหลัง 1 วินาที
    setTimeout(() => {
      img.remove();
    }, 1000);
  });
</script>
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
            <p>ยังไม่มีบัญชีใช่ไหม? <a href="Sign in.php">สมัครเลย</a></p>
            <p id="error-message" style="color: red;"><?= $error_message ?></p>
        </div>
    </div>
</body>
</html>