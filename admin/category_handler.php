<?php
include("../include/config.php");

if (isset($_POST['add_category'])) {
    $cat_name = $_POST['cat_name'];
    $cat_description = $_POST['cat_description'];

    try {
        $query = "INSERT INTO category (cat_name, cat_description) VALUES (:cat_name, :cat_description)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':cat_name', $cat_name, PDO::PARAM_STR);
        $stmt->bindParam(':cat_description', $cat_description, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'เพิ่มประเภทสินค้าสำเร็จ']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'เกิดข้อผิดพลาดในการเพิ่มประเภทสินค้า']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()]);
    }
}
?>
