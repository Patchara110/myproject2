<?php
session_start();
session_destroy();
echo "<script>
    alert('คุณออกจากระบบเรียบร้อยแล้ว');
    window.location.href = 'index.php';
</script>";
exit();
?>
