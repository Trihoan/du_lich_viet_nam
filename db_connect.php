<?php
$servername = "localhost";
$username = "root"; // Mặc định của XAMPP là root
$password = "";     // Mặc định của XAMPP là để trống
$dbname = "du_lich_viet_nam"; // Tên database bạn vừa tạo ở Workbench

// Tạo kết nối
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Thiết kế hỗ trợ tiếng Việt (rất quan trọng cho web du lịch)
mysqli_set_charset($conn, "utf8");

echo "Kết nối đến cơ sở dữ liệu thành công!";
?>