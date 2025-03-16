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
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['loginpassword']; // รับค่ารหัสผ่านจากฟอร์ม

    try {
        // ค้นหาผู้ใช้จากฐานข้อมูล
        $query = "SELECT * FROM userdata WHERE username=:username";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // ตรวจสอบรหัสผ่านโดยใช้ password_verify()
            if (password_verify($password, $user['loginpassword'])) {
                $_SESSION['username'] = $username; // เก็บ session เมื่อเข้าสู่ระบบสำเร็จ
                echo "<script>alert('เข้าสู่ระบบเรียบร้อย'); window.location='index.php';</script>";
                exit();
            } else {
                echo "<script>alert('รหัสผ่านไม่ถูกต้อง!'); window.location='login.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('ไม่พบชื่อผู้ใช้นี้!'); window.location='login.php';</script>";
            exit();
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());

    }

}
}
?>
