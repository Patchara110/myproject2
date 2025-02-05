<?php
session_start();
include("include/config.php");
error_reporting(0);

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $loginpassword = $_POST['loginpassword'];
    $hashedpassword = hash('sha256', $loginpassword); // แฮชรหัสผ่าน

    try {
        // ตรวจสอบข้อมูลผู้ใช้ในฐานข้อมูล
        $query = "SELECT * FROM userdata WHERE username=:username AND loginpassword=:loginpassword";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':loginpassword', $hashedpassword, PDO::PARAM_STR);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            $_SESSION['username'] = $username;  // เก็บ session เมื่อเข้าสู่ระบบสำเร็จ
            echo "<script type='text/javascript'>";
            echo "alert('เข้าสู่ระบบเรียบร้อย');";
            echo "document.location='index.php';";  // ไปยังหน้าต้อนรับ
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('Username หรือ Password ไม่ถูกต้อง');";
            echo "document.location='login.php';";  // กลับไปที่หน้า login
            echo "</script>";
        }
    } catch(PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
}
?>
