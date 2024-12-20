<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>Danh sách sinh viên</h1>

    <?php
    // Đường dẫn tới file CSV
    $csvFile = 'students.csv';

    if (file_exists($csvFile)) {
        $file = fopen($csvFile, 'r');
        if ($file !== false) {
            echo '<table>';
            $headers = fgetcsv($file);
            if ($headers !== false) {
                echo '<thead><tr>';
                foreach ($headers as $header) {
                    echo '<th>' . htmlspecialchars($header) . '</th>';
                }
                echo '</tr></thead>';
            }

            echo '<tbody>';
            while (($row = fgetcsv($file)) !== false) {
                if (array_filter($row)) {
                    echo '<tr>';
                    foreach ($row as $cell) {
                        echo '<td>' . htmlspecialchars($cell) . '</td>';
                    }
                    echo '</tr>';
                }
            }
            echo '</tbody>';

            echo '</table>';
            fclose($file);
        } else {
            echo '<p>Không thể mở file.</p>';
        }
    } else {
        echo '<p>File CSV không tồn tại.</p>';
    }
    ?>
</body>
</html>
