<?php
include("../include/config.php");
$query = "SELECT * FROM category ORDER BY cat_id ASC";
$stmt = $dbh->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_OBJ);

if ($stmt->rowCount() > 0) {
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row->cat_name) . "</td>";
        echo "<td>" . htmlspecialchars($row->cat_description) . "</td>";
        echo "<td>
                <button class='btn btn-edit edit-category-btn' 
                        data-id='" . $row->cat_id . "' 
                        data-name='" . htmlspecialchars($row->cat_name) . "' 
                        data-description='" . htmlspecialchars($row->cat_description) . "'>
                    แก้ไข
                </button>
                <button class='btn btn-delete delete-category-btn' 
                        data-id='" . $row->cat_id . "'>
                    ลบ
                </button>
            </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3' class='text-center'>ไม่มีข้อมูล</td></tr>";
}
?>
