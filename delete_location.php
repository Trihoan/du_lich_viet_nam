<?php
include 'db_connect.php';
if (isset($_GET['id']) && isset($_GET['mode']) && $_GET['mode'] == 'admin') {
    $id = $_GET['id'];
    // Xóa ảnh vật lý trong thư mục uploads trước
    $res = mysqli_query($conn, "SELECT hinh_anh FROM dia_danh WHERE id = $id");
    $row = mysqli_fetch_assoc($res);
    if ($row && !empty($row['hinh_anh'])) {
        unlink("uploads/" . $row['hinh_anh']);
    }
    // Sau đó xóa dữ liệu trong Database
    mysqli_query($conn, "DELETE FROM dia_danh WHERE id = $id");
    header("Location: index.php?mode=admin");
} else {
    header("Location: index.php");
}
?>