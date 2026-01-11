<?php
include 'db_connect.php';

if (isset($_GET['id_anh']) && isset($_GET['mode']) && $_GET['mode'] == 'admin') {
    $id_anh = $_GET['id_anh'];
    $id_dia_danh = $_GET['id_dia_danh'];

    // 1. Lấy tên file để xóa trong thư mục uploads
    $res = mysqli_query($conn, "SELECT file_anh FROM dia_danh_anh WHERE id = $id_anh");
    $row = mysqli_fetch_assoc($res);
    
    if ($row) {
        $path = "uploads/" . $row['file_anh'];
        if (file_exists($path)) {
            unlink($path); // Xóa file vật lý
        }
    }

    // 2. Xóa dữ liệu trong database
    mysqli_query($conn, "DELETE FROM dia_danh_anh WHERE id = $id_anh");

    // 3. Quay lại trang sửa của địa danh đó
    header("Location: edit_location.php?id=$id_dia_danh&mode=admin");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>