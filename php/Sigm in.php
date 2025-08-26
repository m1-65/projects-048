<?php
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';

    // Validate the input fields
    if (empty($username) || empty($password) || empty($email)) {
        $error_message = 'กรุณากรอกข้อมูลให้ครบทุกช่อง';
    } else {
        $user_file = 'users_data.txt';
        $user_data = "{$username}|{$password}|{$email}\n";

        // Check if the username already exists
        $file_handle = @fopen($user_file, 'r');
        if ($file_handle) {
            while (!feof($file_handle)) {
                $line = fgets($file_handle);
                if (strpos($line, "{$username}|") === 0) {
                    $error_message = 'ชื่อผู้ใช้นี้มีคนใช้แล้ว กรุณาเลือกชื่ออื่น';
                    fclose($file_handle);
                    break;
                }
            }
            if (empty($error_message)) {
                fclose($file_handle);
                file_put_contents($user_file, $user_data, FILE_APPEND | LOCK_EX);
                $success_message = 'สมัครสมาชิกเรียบร้อยแล้ว!';
            }
        } else {
            // File doesn't exist, create it and add the first user
            file_put_contents($user_file, $user_data, LOCK_EX);
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
    <link rel="stylesheet" href="css/m1.css">
</head>
<body class="g15">
    <div class="g16">
        <div class="g17">
            <h1>สมัครสมาชิก</h1>
            <form id="registerForm" method="POST" action="register.php">
                <label for="username">ชื่อผู้ใช้</label>
                <input type="text" name="username" id="username" placeholder="ชื่อผู้ใช้" required>
                <label for="password">รหัสผ่าน</label>
                <input type="password" name="password" id="password" placeholder="รหัสผ่าน" required>
                <label for="email">อีเมล</label>
                <input type="email" name="email" id="email" placeholder="อีเมลของคุณ" required>
                <button type="submit">ยืนยัน</button>
            </form>
            <p>มีบัญชีแล้วใช่ไหม? <a href="Login.html">คลิกที่นี่</a></p>
            
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