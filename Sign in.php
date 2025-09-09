<?php
require 'db.php'; // เชื่อมฐานข้อมูล

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';

    if (empty($username) || empty($password) || empty($email)) {
        $error_message = 'กรุณากรอกข้อมูลให้ครบทุกช่อง';
    } else {
        // ตรวจสอบชื่อผู้ใช้ซ้ำ
        $stmt = $pdo->prepare("SELECT * FROM player WHERE username = :username");
        $stmt->execute(['username' => $username]);

        if ($stmt->rowCount() > 0) {
            $error_message = 'ชื่อผู้ใช้นี้มีคนใช้แล้ว กรุณาเลือกชื่ออื่น';
        } else {
            // เพิ่มผู้ใช้ใหม่
            $stmt = $pdo->prepare("INSERT INTO player (username, password, email) VALUES (:username, :password, :email)");
            $stmt->execute([
                'username' => $username,
                'password' => $password, // ปลอดภัยขึ้นควรใช้ password_hash()
                'email'    => $email
            ]);

            $success_message = 'สมัครสมาชิกเรียบร้อยแล้ว!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
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
            <h1>สมัครสมาชิก</h1>
            <form id="registerForm" method="POST" action="Sign in.php">
                <label for="username">ชื่อผู้ใช้</label>
                <input type="text" name="username" id="username" placeholder="ชื่อผู้ใช้" required>
                <label for="password">รหัสผ่าน</label>
                <input type="password" name="password" id="password" placeholder="รหัสผ่าน" required>
                <label for="email">อีเมล</label>
                <input type="email" name="email" id="email" placeholder="อีเมลของคุณ" required>
                <button type="submit">ยืนยัน</button>
            </form>
            <p>มีบัญชีแล้วใช่ไหม? <a href="Login.php">คลิกที่นี่</a></p>
            
            <?php if (!empty($success_message)): ?>
                <p style="color: green;"><?= htmlspecialchars($success_message) ?></p>
            <?php endif; ?>
            
            <?php if (!empty($error_message)): ?>
                <p style="color: red;"><?= htmlspecialchars($error_message) ?></p>
            <?php endif; ?>
            
        </div>
    </div>
</body>
</html>