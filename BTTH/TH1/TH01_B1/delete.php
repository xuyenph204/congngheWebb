<?php
include 'db.php';

$flower_id = $_GET['id'];  
$check_sql = "SELECT * FROM flowers WHERE id = $flower_id";
$result = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($result) > 0) {
    $delete_sql = "DELETE FROM flowers WHERE id = $flower_id";
    if (mysqli_query($conn, $delete_sql)) {
        echo "<script>alert('Xóa thành công!'); window.location.href = 'index01.php';</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra khi xóa dữ liệu!'); window.location.href = 'index01.php';</script>";
    }
} else {
    echo "<script>alert('Không tìm thấy ID tương ứng!'); window.location.href = 'index01.php';</script>";
}
mysqli_close($conn);
?>
