document.getElementById('loginForm').addEventListener('submit', function(event) {
  // ป้องกันการรีเฟรชหน้าเมื่อกดปุ่มล็อกอิน
  event.preventDefault();

  // กำหนดชื่อผู้ใช้และรหัสผ่านที่ถูกต้อง
  const correctUsername = "met";
  const correctPassword = "123";

  // ดึงค่าที่ผู้ใช้กรอกจากฟอร์ม
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;
  const errorMessage = document.getElementById('error-message');

  // ตรวจสอบข้อมูล
  if (username === correctUsername && password === correctPassword) {
    // หากข้อมูลถูกต้อง ให้เปลี่ยนหน้าไปที่ success.html
    window.location.href = "home.html";
  } else {
    // หากข้อมูลไม่ถูกต้อง ให้แสดงข้อความแจ้งเตือนสีแดง
    errorMessage.textContent = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
  }
});