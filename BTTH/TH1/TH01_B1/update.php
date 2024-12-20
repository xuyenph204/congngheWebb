<?php

include 'db.php';
$id = $_POST['id'];
$ten = $_POST['name'];
$mota = $_POST['description'];

$upload_dir = "IMAGES/";
$file = $_FILES['image'];
$file_name = basename($file['name']); 
$target_file = $upload_dir . $file_name;

if (!empty($file['tmp_name'])) {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo "Lỗi tải file: " . $file['error'];
        exit;
    }
    if (!move_uploaded_file($file['tmp_name'], $target_file)) {
        echo "Lỗi khi tải lên file.";
        exit;
    }
} else {
    $image_sql = "SELECT image FROM flowers WHERE id = $id";
    $result = mysqli_query($conn, $image_sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $target_file = $row['image']; 
    } else {
        echo "Không tìm thấy bản ghi với ID: $id";
        exit;
    }
}

$update_sql = "UPDATE flowers SET name='$ten', description='$mota', image='$target_file' WHERE id=$id";
if (mysqli_query($conn, $update_sql)) {
    header("Location: lietke.php");
    exit;
} else {
    echo "Lỗi cập nhật dữ liệu: " . mysqli_error($conn);
}

mysqli_close($conn);
?>