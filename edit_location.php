<?php 
include 'db_connect.php'; 

// 1. Kiểm tra quyền Admin
if (!isset($_GET['mode']) || $_GET['mode'] != 'admin') {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// 2. Xử lý khi nhấn nút Cập nhật
if (isset($_POST['btn_update'])) {
    $ten = $_POST['txt_ten'];
    $mota = $_POST['txt_mota'];
    $id_tinh = $_POST['sel_tinh'];

    // Cập nhật ảnh chính (nếu có chọn mới)
    if ($_FILES["file_anh"]["name"] != "") {
        $main_file_name = time() . "_" . $_FILES["file_anh"]["name"];
        move_uploaded_file($_FILES["file_anh"]["tmp_name"], "uploads/" . $main_file_name);
        $sql = "UPDATE dia_danh SET ten_dia_danh='$ten', mo_ta='$mota', hinh_anh='$main_file_name', id_tinh='$id_tinh' WHERE id=$id";
    } else {
        $sql = "UPDATE dia_danh SET ten_dia_danh='$ten', mo_ta='$mota', id_tinh='$id_tinh' WHERE id=$id";
    }
    mysqli_query($conn, $sql);

    // 3. Xử lý THÊM ảnh phụ mới vào Album
    if (!empty($_FILES['file_anh_phu']['name'][0])) {
        foreach ($_FILES['file_anh_phu']['tmp_name'] as $key => $tmp_name) {
            $sub_file_name = time() . "_sub_" . $_FILES['file_anh_phu']['name'][$key];
            if (move_uploaded_file($tmp_name, "uploads/" . $sub_file_name)) {
                mysqli_query($conn, "INSERT INTO dia_danh_anh (id_dia_danh, file_anh) VALUES ('$id', '$sub_file_name')");
            }
        }
    }

    echo "<script>alert('Cập nhật thành công!'); window.location='index.php?mode=admin';</script>";
}

// 4. Lấy dữ liệu cũ để hiện lên Form
$result = mysqli_query($conn, "SELECT * FROM dia_danh WHERE id = $id");
$data = mysqli_fetch_assoc($result);

// 5. Lấy danh sách ảnh phụ hiện có
$result_anh_phu = mysqli_query($conn, "SELECT * FROM dia_danh_anh WHERE id_dia_danh = $id");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Địa Danh & Album</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/add_location.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h2>✏️ Chỉnh sửa địa danh</h2>
            <form method="POST" enctype="multipart/form-data" action="edit_location.php?id=<?php echo $id; ?>&mode=admin">
                <label>Tên địa danh</label>
                <input type="text" name="txt_ten" value="<?php echo $data['ten_dia_danh']; ?>" required>

                <label>Ảnh đại diện hiện tại</label><br>
                <img src="uploads/<?php echo $data['hinh_anh']; ?>" width="150" style="border-radius:8px;"><br>
                <label>Thay đổi ảnh đại diện (để trống nếu giữ nguyên)</label>
                <input type="file" name="file_anh" accept="image/*">

                <hr>
                <label>Album ảnh phụ hiện tại</label>
                <div style="display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap;">
                    <?php while($anh = mysqli_fetch_assoc($result_anh_phu)): ?>
                        <div style="position: relative; width: 100px; height: 80px;">
                            <img src="uploads/<?php echo $anh['file_anh']; ?>" 
                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">
                            
                            <a href="delete_sub_image.php?id_anh=<?php echo $anh['id']; ?>&id_dia_danh=<?php echo $id; ?>&mode=admin" 
                            onclick="return confirm('Xóa tấm ảnh này?')"
                            style="position: absolute; top: -8px; right: -8px; background: #e74c3c; color: white; 
                                    width: 20px; height: 20px; border-radius: 50%; text-align: center; 
                                    line-height: 20px; text-decoration: none; font-size: 12px; font-weight: bold;
                                    box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                            ×
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>

                <label>Thêm ảnh phụ mới (Có thể chọn nhiều)</label>
                <input type="file" name="file_anh_phu[]" accept="image/*" multiple>
                <hr>

                <label>Mô tả</label>
                <textarea name="txt_mota" rows="5"><?php echo $data['mo_ta']; ?></textarea>

                <label>Tỉnh thành</label>
                <select name="sel_tinh">
                    <?php
                    $tinh_query = mysqli_query($conn, "SELECT * FROM tinh_thanh ORDER BY ten_tinh ASC");
                    while($t = mysqli_fetch_assoc($tinh_query)) {
                        $selected = ($t['id'] == $data['id_tinh']) ? "selected" : "";
                        echo "<option value='".$t['id']."' $selected>".$t['ten_tinh']."</option>";
                    }
                    ?>
                </select>

                <button type="submit" name="btn_update">Lưu thay đổi</button>
            </form>
            <div class="back-home">
                <a href="index.php?mode=admin">← Quay lại</a>
            </div>
        </div>
    </div>
</body>
</html>