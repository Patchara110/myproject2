<?php
include("../include/config.php");

$query = "SELECT * FROM product ORDER BY pro_id ASC";
$stmt = $dbh->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_OBJ);

if ($stmt->rowCount() > 0) {
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row->pro_name) . "</td>";
        echo "<td>" . htmlspecialchars($row->pro_price) . "</td>";
        echo "<td>" . htmlspecialchars($row->pro_description) . "</td>";
        
        // หมวดหมู่
        $cat_query = "SELECT cat_name FROM category WHERE cat_id = :cat_id";
        $cat_stmt = $dbh->prepare($cat_query);
        $cat_stmt->bindParam(':cat_id', $row->cat_id);
        $cat_stmt->execute();
        $cat_row = $cat_stmt->fetch(PDO::FETCH_OBJ);
        echo "<td>" . htmlspecialchars($cat_row->cat_name) . "</td>";
        
        echo "<td>
                <button class='btn btn-edit edit-product-btn' data-id='" . $row->prod_id . "' data-name='" . htmlspecialchars($row->prod_name) . "' data-price='" . $row->prod_price . "' data-description='" . htmlspecialchars($row->prod_description) . "'>แก้ไข</button>
                <button class='btn btn-delete delete-product-btn' data-id='" . $row->prod_id . "'>ลบ</button>
            </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5' class='text-center'>ไม่มีข้อมูล</td></tr>";
}
?>
