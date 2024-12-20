<?php
// Kiểm tra nếu chỉ số sản phẩm được gửi qua URL
if (isset($_GET['index'])) {
    $index = (int)$_GET['index'];

    // Đọc danh sách sản phẩm từ file
    include 'products.php';

    // Kiểm tra chỉ số hợp lệ
    if (!isset($products[$index])) {
        header('Location: index.php');
        exit();
    }

    // Lấy sản phẩm cần sửa
    $product = $products[$index];

    // Kiểm tra nếu form được gửi đi
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = htmlspecialchars(trim($_POST['name']));
        $price = htmlspecialchars(trim($_POST['price']));

        // Cập nhật sản phẩm
        if (!empty($name) && !empty($price)) {
            $products[$index] = ['name' => $name, 'price' => $price];

            // Cập nhật danh sách và ghi lại vào file
            $data = '<?php $products = ' . var_export($products, true) . ';';
            file_put_contents('products.php', $data);

            // Chuyển hướng về trang chính
            header('Location: index.php');
            exit();
        } else {
            $error_message = "Vui lòng nhập tên và giá thành hợp lệ.";
        }
    }
} else {
    header('Location: index.php');
    exit();
}
?>

<?php include 'header.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<main class="container my-5">
    <h2>Sửa sản phẩm</h2>
    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger"><?= $error_message ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá thành</label>
            <input type="text" class="form-control" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="index.php" class="btn btn-secondary">Hủy</a>
    </form>
</main>

<?php include 'footer.php'; ?>
