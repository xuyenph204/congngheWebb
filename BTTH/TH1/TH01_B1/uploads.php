<?php
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    if (empty($image['name'])) {
        $error = "Vui lòng chọn một tệp ảnh.";
    } else {
        $allowedTypes = ['image/jpg', 'image/jpeg'];
        if (!in_array($image['type'], $allowedTypes)) {
            $error = "Chỉ chấp nhận ảnh định dạng JPG hoặc JPEG.";
        } else {
            $uploadDir = 'uploads/';
            $imagePath = $uploadDir . basename($image['name']);

            if (file_exists($imagePath)) {
                $error = "Tệp ảnh này đã tồn tại.";
            } else {
                if (move_uploaded_file($image['tmp_name'], $imagePath)) {
                    $stmt = $pdo->prepare("INSERT INTO flowers (name, description, image) VALUES (?, ?, ?)");
                    $stmt->execute([$name, $description, $imagePath]);
                    header('Location: index.php');  
                    exit();
                } else {
                    $error = "Có lỗi khi tải ảnh lên.";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm hoa mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Thêm hoa mới</h1>
        
        <!-- Hiển thị thông báo lỗi nếu có -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Tên hoa</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả hoa</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh hoa</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Thêm hoa</button>
        </form>
    </div>
</body>
</html>
