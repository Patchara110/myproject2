<?php
session_start();
include("../include/config.php");

// Handle category update or insert
if (isset($_POST['update_category'])) {
    $cat_name = $_POST['cat_name'];
    $cat_description = $_POST['cat_description']; // Add description for the category
    $cat_id = isset($_POST['cat_id']) ? $_POST['cat_id'] : null;

    try {
        if ($cat_id) {
            // Update category
            $update_query = "UPDATE category SET cat_name = :cat_name, cat_description = :cat_description WHERE cat_id = :cat_id";
            $update_stmt = $dbh->prepare($update_query);
            $update_stmt->bindParam(':cat_name', $cat_name, PDO::PARAM_STR);
            $update_stmt->bindParam(':cat_description', $cat_description, PDO::PARAM_STR);
            $update_stmt->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);

            if ($update_stmt->execute()) {
                echo '<script>alert("อัปเดตหมวดหมู่สำเร็จ"); window.location.href="manage_category.php";</script>';
            } else {
                echo '<script>alert("เกิดข้อผิดพลาดในการอัปเดตหมวดหมู่"); window.location.href="manage_category.php";</script>';
            }
        } else {
            // Insert new category
            $insert_query = "INSERT INTO category (cat_name, cat_description) VALUES (:cat_name, :cat_description)";
            $insert_stmt = $dbh->prepare($insert_query);
            $insert_stmt->bindParam(':cat_name', $cat_name, PDO::PARAM_STR);
            $insert_stmt->bindParam(':cat_description', $cat_description, PDO::PARAM_STR);

            if ($insert_stmt->execute()) {
                echo '<script>alert("เพิ่มหมวดหมู่สำเร็จแล้ว!"); window.location.href="manage_category.php";</script>';
            } else {
                echo '<script>alert("เกิดข้อผิดพลาดในการเพิ่มหมวดหมู่"); window.location.href="manage_category.php";</script>';
            }
        }
    } catch (PDOException $e) {
        echo 'เกิดข้อผิดพลาด';
    }
    exit();
}

// Handle category delete
if (isset($_POST['delete_category']) && isset($_POST['cat_id'])) {
    $cat_id = $_POST['cat_id'];

    try {
        $delete_query = "DELETE FROM category WHERE cat_id = :cat_id";
        $delete_stmt = $dbh->prepare($delete_query);
        $delete_stmt->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);

        if ($delete_stmt->execute()) {
            echo '<script>alert("ลบหมวดหมู่สำเร็จ"); window.location.href="manage_category.php";</script>';
        } else {
            echo '<script>alert("เกิดข้อผิดพลาดในการลบหมวดหมู่"); window.location.href="manage_category.php";</script>';
        }
    } catch (PDOException $e) {
        echo 'เกิดข้อผิดพลาด';
    }
    exit();
}

// Handle category edit
if (isset($_GET['edit_category']) && isset($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];
    $cat_query = "SELECT * FROM category WHERE cat_id = :cat_id";
    $cat_stmt = $dbh->prepare($cat_query);
    $cat_stmt->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
    $cat_stmt->execute();
    $category = $cat_stmt->fetch(PDO::FETCH_OBJ);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>จัดการหมวดหมู่</title>
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
        <!-- เพิ่มหรือแก้ไขหมวดหมู่ -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3><?php echo isset($category) ? 'แก้ไขหมวดหมู่' : 'เพิ่มหมวดหมู่'; ?></h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <input type="hidden" name="cat_id" value="<?php echo isset($category) ? $category->cat_id : ''; ?>">
                        <input type="text" class="form-control" name="cat_name" placeholder="ชื่อหมวดหมู่" value="<?php echo isset($category) ? htmlspecialchars($category->cat_name) : ''; ?>" required><br>
                        <textarea class="form-control" name="cat_description" placeholder="คำอธิบายหมวดหมู่" required><?php echo isset($category) ? htmlspecialchars($category->cat_description) : ''; ?></textarea><br>
                        <button type="submit" name="update_category" class="btn btn-add"><?php echo isset($category) ? 'อัปเดตหมวดหมู่' : 'เพิ่มหมวดหมู่'; ?></button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ตารางหมวดหมู่ -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>รายการหมวดหมู่</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ชื่อหมวดหมู่</th>
                                <th>คำอธิบาย</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cat_query = "SELECT * FROM category ORDER BY cat_id ASC";
                            $cat_stmt = $dbh->prepare($cat_query);
                            $cat_stmt->execute();
                            $categories = $cat_stmt->fetchAll(PDO::FETCH_OBJ);

                            foreach ($categories as $category) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($category->cat_name) . "</td>";
                                echo "<td>" . htmlspecialchars($category->cat_description) . "</td>";
                                echo "<td>
                                    <form method='GET' action='' style='display:inline;'>
                                        <input type='hidden' name='cat_id' value='" . $category->cat_id . "'>
                                        <button type='submit' name='edit_category' class='btn btn-edit'>แก้ไข</button>
                                    </form>
                                    <form method='POST' action='' style='display:inline;' onsubmit='return confirmDelete();'>
                                        <input type='hidden' name='cat_id' value='" . $category->cat_id . "'>
                                        <button type='submit' name='delete_category' class='btn btn-delete'>ลบ</button>
                                    </form>
                                    </td>";
                                echo "</tr>";
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
        return confirm("คุณต้องการลบหมวดหมู่นี้จริง ๆ หรือไม่?");
    }
</script>

</body>
</html>
