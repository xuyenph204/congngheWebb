<?php
// Kiểm tra xem chỉ số sản phẩm có được gửi qua URL không
if (isset($_GET['index'])) {
    $index = (int)$_GET['index']; // Chuyển đổi sang kiểu số nguyên

    // Đọc danh sách sản phẩm từ file
    include 'products.php';

    // Kiểm tra chỉ số hợp lệ
    if (isset($products[$index])) {
        // Xóa sản phẩm khỏi danh sách
        unset($products[$index]);

        // Cập nhật danh sách và ghi lại vào file
        $data = '<?php $products = ' . var_export(array_values($products), true) . ';';
        file_put_contents('products.php', $data);
    }
}

// Chuyển hướng về trang chính
header('Location: index.php');
exit();
