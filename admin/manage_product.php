<?php
session_start();
include("../include/config.php");

// Handle product update or insert
if (isset($_POST['update_product'])) {
    $pro_name = $_POST['pro_name'];
    $pro_price = $_POST['pro_price'];
    $pro_cost = $_POST['pro_cost'];
    $pro_img = $_POST['pro_img'];
    $cat_id = $_POST['cat_id'];

    try {
        // Insert new product
        $insert_query = "INSERT INTO product (pro_name, pro_price, pro_cost, pro_img, cat_id) 
                         VALUES (:pro_name, :pro_price, :pro_cost, :pro_img, :cat_id)";
        $insert_stmt = $dbh->prepare($insert_query);
        $insert_stmt->bindParam(':pro_name', $pro_name, PDO::PARAM_STR);
        $insert_stmt->bindParam(':pro_price', $pro_price, PDO::PARAM_STR);
        $insert_stmt->bindParam(':pro_cost', $pro_cost, PDO::PARAM_STR);
        $insert_stmt->bindParam(':pro_img', $pro_img, PDO::PARAM_STR);
        $insert_stmt->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);

        if ($insert_stmt->execute()) {
            // เมื่อเพิ่มสินค้าเสร็จแล้วให้แจ้งเตือนและรีเฟรชหน้า
            echo '<script>alert("เพิ่มสินค้าสำเร็จแล้ว!"); window.location.href="manage_product.php";</script>';
        } else {
            echo '<script>alert("เกิดข้อผิดพลาดในการเพิ่มสินค้า"); window.location.href="manage_product.php";</script>';
        }
    } catch (PDOException $e) {
        echo 'เกิดข้อผิดพลาด';
    }
    exit();
}
// Handle product delete
if (isset($_POST['delete_product']) && isset($_POST['pro_id'])) {
    $pro_id = $_POST['pro_id'];

    try {
        // Delete product from database
        $delete_query = "DELETE FROM product WHERE pro_id = :pro_id";
        $delete_stmt = $dbh->prepare($delete_query);
        $delete_stmt->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);

        if ($delete_stmt->execute()) {
            echo '<script>alert("ลบสินค้าสำเร็จ"); window.location.href="manage_product.php";</script>';
        } else {
            echo '<script>alert("เกิดข้อผิดพลาดในการลบสินค้า"); window.location.href="manage_product.php";</script>';
        }
    } catch (PDOException $e) {
        echo 'เกิดข้อผิดพลาด';
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>จัดการสินค้า</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #FFF0F5;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 20px;
        }
        .card-header {
            background-color: #FFB6C1;
            color: white;
        }
        .btn-edit {
            background-color: #FFC1E0;
            color: #333;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: bold;
        }
        .btn-delete {
            background-color: #FF69B4;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: bold;
        }
        .btn-add {
            background-color: #FF69B4;
            color: white;
            font-size: 16px;
            padding: 10px 18px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <!-- เพิ่มสินค้า -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>เพิ่มสินค้า</h3>
                </div>
                <div class="card-body">
                    <form id="productForm" method="POST" action="">
                        <input type="text" class="form-control" name="pro_name" placeholder="ชื่อสินค้า" required><br>
                        <input type="text" class="form-control" name="pro_price" placeholder="ราคาขาย" required><br>
                        <input type="text" class="form-control" name="pro_cost" placeholder="ราคาทุน" required><br>
                        <input type="text" class="form-control" name="pro_img" placeholder="ลิ้งรูปภาพ" required><br>
                        <!-- Dropdown for Category -->
                        <select class="form-control" name="cat_id" required>
                            <?php
                            // Fetch categories from database
                            $cat_query = "SELECT * FROM category ORDER BY cat_id ASC";
                            $cat_stmt = $dbh->prepare($cat_query);
                            $cat_stmt->execute();
                            $categories = $cat_stmt->fetchAll(PDO::FETCH_OBJ);
                            foreach ($categories as $category) {
                                echo "<option value='" . $category->cat_id . "'>" . htmlspecialchars($category->cat_name) . "</option>";
                            }
                            ?>
                        </select><br>
                        <button type="submit" name="update_product" class="btn btn-add">เพิ่มสินค้า</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- ตารางสินค้า -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>รายการสินค้า</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ชื่อสินค้า</th>
                                <th>ราคา</th>
                                <th>หมวดหมู่</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody id="productTableBody">
                            <?php
                            $query = "SELECT p.*, c.cat_name FROM product p JOIN category c ON p.cat_id = c.cat_id ORDER BY p.pro_id ASC";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            $results = $stmt->fetchAll(PDO::FETCH_OBJ);

                            if ($stmt->rowCount() > 0) {
                                foreach ($results as $row) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row->pro_name) . "</td>";
                                    echo "<td>฿" . htmlspecialchars($row->pro_price) . "</td>";
                                    echo "<td>" . htmlspecialchars($row->cat_name) . "</td>";
                                    echo "<td>
                                        <!-- ลบสินค้าผ่านฟอร์ม -->
                                        <form method='POST' action='' style='display:inline;' onsubmit='return confirmDelete();'>
                                            <input type='hidden' name='pro_id' value='" . $row->pro_id . "'>
                                            <button type='submit' name='delete_product' class='btn btn-delete'>ลบ</button>
                                        </form>
                                        <button class='btn btn-edit edit-product-btn' data-id='" . $row->pro_id . "' data-name='" . htmlspecialchars($row->pro_name) . "' data-price='" . htmlspecialchars($row->pro_price) . "' data-cat-id='" . $row->cat_id . "'>แก้ไข</button>
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center'>ไม่มีข้อมูล</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript confirmation for delete
    function confirmDelete() {
        return confirm("คุณต้องการลบสินค้านี้จริง ๆ หรือไม่?");
    }
</script>

</body>
</html>
