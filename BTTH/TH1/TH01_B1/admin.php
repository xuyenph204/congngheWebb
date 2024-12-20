<?php
include 'db.php'; // Đảm bảo tệp kết nối được sử dụng đúng

// Xóa loài hoa
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM flowers WHERE id = :id");
    if ($stmt->execute(['id' => $delete_id])) {
        echo "<script>alert('Xóa loài hoa thành công.'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa dữ liệu.');</script>";
    }
}

// Lấy thông tin hoa để chỉnh sửa
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $stmt = $pdo->prepare("SELECT * FROM flowers WHERE id = :id");
    $stmt->execute(['id' => $edit_id]);
    $flower = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$flower) {
        echo "<script>alert('Loài hoa không tồn tại.'); window.location='admin.php';</script>";
    }
}

// Cập nhật thông tin hoa
if (isset($_POST['edit_name'])) {
    $edit_name = $_POST['edit_name'];
    $edit_description = $_POST['edit_description'];
    $edit_image_path = $flower['image']; // Mặc định giữ lại ảnh cũ

    if (!empty($_FILES['edit_image']['name'])) {
        $upload_dir = "images/";
        $file_name = basename($_FILES['edit_image']['name']);
        $target_file = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['edit_image']['tmp_name'], $target_file)) {
            $edit_image_path = $target_file;
        }
    }

    $stmt = $pdo->prepare("UPDATE flowers SET name = :name, description = :description, image = :image WHERE id = :id");
    if ($stmt->execute([
        'name' => $edit_name,
        'description' => $edit_description,
        'image' => $edit_image_path,
        'id' => $edit_id
    ])) {
        echo "<script>alert('Cập nhật thành công.'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi cập nhật dữ liệu.');</script>";
    }
}

// Lấy danh sách hoa
$stmt = $pdo->query("SELECT * FROM flowers");
$flowers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh sách hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Quản lý danh sách loài hoa</h2>
        <a href="add.php" class="btn btn-success mb-3">+ Thêm Hoa</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Hoa</th>
                    <th>Mô Tả</th>
                    <th>Hình Ảnh</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flowers as $index => $flower): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($flower['name']); ?></td>
                        <td><?php echo htmlspecialchars($flower['description']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($flower['image']); ?>" alt="Hình hoa" style="width: 100px; height: 100px; object-fit: cover;"></td>
                        <td>
                            <a href="admin.php?edit_id=<?php echo $flower['id']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="admin.php?delete_id=<?php echo $flower['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa hoa này không?');">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (isset($_GET['edit_id'])): ?>
            <h3>Chỉnh Sửa Loài Hoa</h3>
            <form action="admin.php?edit_id=<?php echo $flower['id']; ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="edit_name" class="form-label">Tên Hoa</label>
                    <input type="text" name="edit_name" id="edit_name" class="form-control" value="<?php echo htmlspecialchars($flower['name']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="edit_description" class="form-label">Mô Tả</label>
                    <textarea name="edit_description" id="edit_description" class="form-control" required><?php echo htmlspecialchars($flower['description']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="edit_image" class="form-label">Hình Ảnh (Không bắt buộc)</label>
                    <input type="file" name="edit_image" id="edit_image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Cập Nhật</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$pdo = null;
?>
