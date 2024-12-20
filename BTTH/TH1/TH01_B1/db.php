<?php
$host = 'localhost'; // Địa chỉ máy chủ cơ sở dữ liệu
$username = 'root'; // Tên người dùng CSDL
$password = ''; // Mật khẩu (nếu có)
$dbname = 'qlyhoa'; // Tên cơ sở dữ liệu

// Tạo kết nối
$conn = new mysqli($host, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=qlyhoa', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối CSDL thất bại: " . $e->getMessage());
}
?>
