<?php
$host = "localhost";  // ชื่อโฮสต์ของฐานข้อมูล
$username = "root";   // ชื่อผู้ใช้ฐานข้อมูล
$password = "";       // รหัสผ่านฐานข้อมูล
$dbname = "myproject";  // ชื่อฐานข้อมูล

try {
    // สร้างการเชื่อมต่อกับฐานข้อมูล
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // ตั้งค่าให้ PDO ส่งข้อผิดพลาดในกรณีที่เกิดข้อผิดพลาด
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "เชื่อมต่อฐานข้อมูลสำเร็จ!";  // แสดงข้อความเมื่อเชื่อมต่อสำเร็จ
} catch (PDOException $e) {
    echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้: " . $e->getMessage();
}
?>
