<?php
// Kết nối cơ sở dữ liệu
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten = $_POST['name'] ?? '';
    $mota = $_POST['description'] ?? '';
    $upload_dir = "images/"; // Thư mục lưu ảnh

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['image'];
        $file_name = basename($file['name']);
        $target_file = $upload_dir . $file_name;

        // Kiểm tra và tải lên tệp
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            try {
                // Chèn dữ liệu vào CSDL
                $stmt = $pdo->prepare("INSERT INTO flowers (name, description, image) VALUES (:name, :description, :image)");
                $stmt->execute([
                    'name' => $ten,
                    'description' => $mota,
                    'image' => $target_file
                ]);
                header("Location: admin.php"); // Quay về trang quản lý sau khi thêm thành công
                exit;
            } catch (PDOException $e) {
                echo "Lỗi thêm dữ liệu: " . $e->getMessage();
            }
        } else {
            echo "Lỗi khi tải tệp lên.";
        }
    } else {
        echo "Vui lòng tải lên tệp ảnh hợp lệ.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Thêm Loài Hoa Mới</h2>
        <form action="add.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Tên Hoa</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô Tả</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình Ảnh</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm Hoa</button>
            <a href="admin.php" class="btn btn-secondary">Quay Lại</a>
        </form>
    </div>
</body>
</html>
