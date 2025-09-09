<?php
$host = "localhost";
$dbname = "admin";         // ชื่อฐานข้อมูลของคุณ
$username = "root";        // ชื่อผู้ใช้ (XAMPP คือ root)
$password = "";            // ไม่มีรหัสผ่าน (ค่าเริ่มต้น XAMPP)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage());
}
?>