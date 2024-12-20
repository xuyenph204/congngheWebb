<?php include 'header.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<?php

// Kiểm tra nếu form được gửi đi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form và xử lý an toàn
    $name = htmlspecialchars(trim($_POST['name']));
    $price = htmlspecialchars(trim($_POST['price']));

    // Kiểm tra dữ liệu đầu vào
    if (!empty($name) && !empty($price)) {
        // Đọc danh sách sản phẩm hiện tại từ file
        include 'products.php';

        // Thêm sản phẩm mới vào danh sách
        $products[] = ['name' => $name, 'price' => $price];

        // Ghi lại danh sách sản phẩm vào file products.php
        $data = '<?php $products = ' . var_export($products, true) . ';';
        file_put_contents('products.php', $data);

        // Chuyển hướng về trang index.php
        header('Location: index.php'); // Sửa đúng tên tệp
        exit();
    } else {
        $error_message = "Vui lòng nhập tên sản phẩm và giá thành.";
    }
}
?>

<main class="py-4">
    <div class="container">
        <h2>Thêm sản phẩm mới</h2>
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?= $error_message ?></div>
        <?php endif; ?>
        <form method="POST" action="add.php">
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá thành</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <button type="submit" class="btn btn-success">Thêm sản phẩm</button>
            <a href="index.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>
