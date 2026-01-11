<?php 
include 'db_connect.php'; 

if (!isset($_GET['mode']) || $_GET['mode'] != 'admin') {
    header("Location: index.php");
    exit();
}

if (isset($_POST['btn_save'])) {
    $ten = $_POST['txt_ten'];
    $mota = $_POST['txt_mota'];
    $id_tinh = $_POST['sel_tinh'];

    // 1. Xử lý Upload ảnh đại diện chính
    $target_dir = "uploads/";
    $main_file_name = time() . "_" . basename($_FILES["file_anh"]["name"]);
    $target_file = $target_dir . $main_file_name;

    if (move_uploaded_file($_FILES["file_anh"]["tmp_name"], $target_file)) {
        // Lưu thông tin địa danh chính
        $sql = "INSERT INTO dia_danh (ten_dia_danh, mo_ta, hinh_anh, id_tinh) VALUES ('$ten', '$mota', '$main_file_name', '$id_tinh')";
        
        if (mysqli_query($conn, $sql)) {
            $id_dia_danh = mysqli_insert_id($conn); // Lấy ID vừa chèn để lưu ảnh phụ

            // Đoạn xử lý lưu ảnh phụ sau khi đã INSERT địa danh chính thành công
            if (!empty($_FILES['file_anh_phu']['name'][0])) {
                foreach ($_FILES['file_anh_phu']['tmp_name'] as $key => $tmp_name) {
                    $sub_file_name = time() . "_sub_" . $_FILES['file_anh_phu']['name'][$key];
                    if (move_uploaded_file($tmp_name, "uploads/" . $sub_file_name)) {
                        // Đảm bảo INSERT vào bảng dia_danh_anh, cột id_dia_danh
                        $sql_sub = "INSERT INTO dia_danh_anh (id_dia_danh, file_anh) VALUES ('$id_dia_danh', '$sub_file_name')";
                        mysqli_query($conn, $sql_sub);
                    }
                }
            }

            echo "<script>alert('Thêm địa danh và album ảnh thành công!'); window.location='index.php?mode=admin';</script>";
        }
    } else {
        echo "Lỗi khi upload ảnh chính.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản trị - Thêm Địa Danh & Album</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/add_location.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h2>📸 Thêm Điểm Đến & Album Ảnh</h2>
            <form method="POST" enctype="multipart/form-data" action="add_location.php?mode=admin">
                <label>Tên địa danh</label>
                <input type="text" name="txt_ten" required>

                <label>Hình ảnh tiêu biểu (Ảnh đại diện chính)</label>
                <input type="file" name="file_anh" accept="image/*" required>

                <label>Album ảnh phụ (Có thể chọn nhiều ảnh cùng lúc)</label>
                <input type="file" name="file_anh_phu[]" accept="image/*" multiple>

                <label>Mô tả chi tiết</label>
                <textarea name="txt_mota" rows="4"></textarea>

                <label>Tỉnh thành</label>
                <select name="sel_tinh">
                    <?php
                    $query_tinh = mysqli_query($conn, "SELECT * FROM tinh_thanh ORDER BY ten_tinh ASC");
                    while ($tinh = mysqli_fetch_assoc($query_tinh)) {
                        echo "<option value='".$tinh['id']."'>".$tinh['ten_tinh']."</option>";
                    }
                    ?>
                </select>

                <button type="submit" name="btn_save">Gửi Dữ Liệu</button>
            </form>
            <div class="back-home">
                <a href="index.php?mode=admin">← Quay lại trang chủ (Chế độ Admin)</a>
            </div>
        </div>
    </div>
</body>
</html>