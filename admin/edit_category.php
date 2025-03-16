<?php
session_start();
include("../include/config.php");

// การอัปเดตประเภทสินค้า
if (isset($_POST['update_category'])) {
    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];
    $cat_description = $_POST['cat_description'];

    try {
        // ตรวจสอบว่า มีประเภทสินค้านี้อยู่แล้วหรือไม่
        $check_query = "SELECT * FROM category WHERE cat_name = :cat_name AND cat_id != :cat_id";
        $check_stmt = $dbh->prepare($check_query);
        $check_stmt->bindParam(':cat_name', $cat_name, PDO::PARAM_STR);
        $check_stmt->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
        $check_stmt->execute();

        if ($check_stmt->rowCount() > 0) {
            echo "duplicate";
        } else {
            // อัปเดตประเภทสินค้า
            $update_query = "UPDATE category SET cat_name = :cat_name, cat_description = :cat_description WHERE cat_id = :cat_id";
            $update_stmt = $dbh->prepare($update_query);
            $update_stmt->bindParam(':cat_name', $cat_name, PDO::PARAM_STR);
            $update_stmt->bindParam(':cat_description', $cat_description, PDO::PARAM_STR);
            $update_stmt->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
            
            if ($update_stmt->execute()) {
                echo "success";
            } else {
                echo "error";
            }
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
    exit();
}

// การลบประเภทสินค้า
if (isset($_POST['delete_category'])) {
    $cat_id = $_POST['delete_category'];

    try {
        // ตรวจสอบว่ามีสินค้าที่ใช้ประเภทนี้อยู่หรือไม่
        $check_query = "SELECT COUNT(*) FROM products WHERE cat_id = :cat_id";
        $check_stmt = $dbh->prepare($check_query);
        $check_stmt->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
        $check_stmt->execute();

        if ($check_stmt->fetchColumn() > 0) {
            echo "in_use"; // ถ้ามีสินค้าที่ใช้ประเภทนี้อยู่
        } else {
            // ลบประเภทสินค้า
            $delete_query = "DELETE FROM category WHERE cat_id = :cat_id";
            $delete_stmt = $dbh->prepare($delete_query);
            $delete_stmt->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);

            if ($delete_stmt->execute()) {
                echo "deleted";
            } else {
                echo "error";
            }
        }
    } catch (PDOException $e) {
        echo "error";
    }
    exit();
}
?>
