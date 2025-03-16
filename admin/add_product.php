<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม
    $pro_name = $_POST['pro_name'];
    $cat_id = $_POST['cat_id'];
    $pro_price = $_POST['pro_price'];
    $pro_cost = $_POST['pro_cost'];
    $pro_img = $_FILES['pro_img']['name'];

    // ตรวจสอบข้อมูลที่ได้รับ
    if (empty($pro_name) || empty($cat_id) || empty($pro_price) || empty($pro_cost) || empty($pro_img)) {
        echo "กรุณากรอกข้อมูลให้ครบถ้วน!";
        exit();
    }

    // ย้ายไฟล์รูปภาพไปยังโฟลเดอร์ที่ต้องการ
    $upload_dir = 'uploads/';
    $upload_file = $upload_dir . basename($pro_img);

    if (!move_uploaded_file($_FILES['pro_img']['tmp_name'], $upload_file)) {
        echo "เกิดข้อผิดพลาดในการอัพโหลดรูปภาพ!";
        exit();
    }

    // คำสั่ง SQL สำหรับเพิ่มสินค้า
    try {
        $sql = "INSERT INTO product (pro_name, cat_id, pro_price, pro_cost, pro_img) 
                VALUES (:pro_name, :cat_id, :pro_price, :pro_cost, :pro_img)";
        
        $query = $dbh->prepare($sql);
        $query->bindParam(':pro_name', $pro_name);
        $query->bindParam(':cat_id', $cat_id);
        $query->bindParam(':pro_price', $pro_price);
        $query->bindParam(':pro_cost', $pro_cost);
        $query->bindParam(':pro_img', $pro_img);

        if ($query->execute()) {
            echo "เพิ่มสินค้าสำเร็จ!";
            header("Location: manage_product.php");  // เปลี่ยนเส้นทางไปหน้าแสดงสินค้าหลังจากเพิ่มสำเร็จ
            exit();
        } else {
            echo "เกิดข้อผิดพลาดในการเพิ่มสินค้า!";
        }
    } catch (PDOException $e) {
        echo "ข้อผิดพลาด: " . $e->getMessage();
    }
}
?>
