<?php
session_start();
include("include/config.php"); // เชื่อมต่อฐานข้อมูล
error_reporting(0);

// เช็คถ้ามีการกดปุ่มสมัครสมาชิก
if (isset($_POST['signup'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $usermobile = $_POST['usermobile'];
    $loginpassword = $_POST['loginpassword'];
    $hashedpassword = hash('sha256', $loginpassword); // เข้ารหัสรหัสผ่าน

    try {
        // ตรวจสอบว่ามีข้อมูลนี้ในฐานข้อมูลหรือไม่
        $query = "SELECT * FROM userdata WHERE username=:username";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        // ถ้ามีข้อมูลนี้แล้วจะไม่ให้สมัครใหม่
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Username นี้มีอยู่ในระบบแล้ว กรุณาลองใหม่');</script>";
        } else {
            // เพิ่มข้อมูลลงในฐานข้อมูล
            $sql = "INSERT INTO userdata (fullname, username, useremail, usermobile, loginpassword) VALUES (:fullname, :username, :useremail, :usermobile, :loginpassword)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':useremail', $useremail, PDO::PARAM_STR);
            $stmt->bindParam(':usermobile', $usermobile, PDO::PARAM_STR);
            $stmt->bindParam(':loginpassword', $hashedpassword, PDO::PARAM_STR);
            $stmt->execute();

            // แสดงข้อความเมื่อสมัครสมาชิกสำเร็จ
            echo "<script>alert('สมัครสมาชิกสำเร็จ');</script>";
            echo "<script>document.location='login.php';</script>"; // รีไดเรกต์ไปที่หน้า login
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Signup Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Signup Page</h2>
  <form method="POST" action="signup.php">
    <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" class="form-control" id="fullname" name="fullname" required>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="useremail">Email</label>
        <input type="email" class="form-control" id="useremail" name="useremail" required>
    </div>
    <div class="form-group">
        <label for="usermobile">Mobile</label>
        <input type="text" class="form-control" id="usermobile" name="usermobile" required>
    </div>
    <div class="form-group">
        <label for="loginpassword">Password</label>
        <input type="password" class="form-control" id="loginpassword" name="loginpassword" required>
    </div>
    <button type="submit" name="signup" class="btn btn-primary">Submit</button>
</form>

</div>

</body>
</html>