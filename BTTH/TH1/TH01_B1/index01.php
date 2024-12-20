<?php
include 'db.php';  // Kết nối với cơ sở dữ liệu

// Lấy danh sách hoa từ CSDL
$stmt = $pdo->query("SELECT * FROM flowers");
$flowers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;  
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-4">
        <h1 class="mb-4">Danh sách các loài hoa</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên hoa</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flowers as $index => $flower): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($flower['name']); ?></td>
                        <td><?php echo htmlspecialchars($flower['description']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($flower['image']); ?>" alt="<?php echo htmlspecialchars($flower['name']); ?>"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
