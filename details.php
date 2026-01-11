<?php 
include 'db_connect.php'; 

$id = $_GET['id'];
$sql = "SELECT d.*, t.ten_tinh FROM dia_danh d 
        JOIN tinh_thanh t ON d.id_tinh = t.id 
        WHERE d.id = $id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

if (!$data) { header("Location: index.php"); exit(); }

// Truy vấn lấy Album ảnh phụ
$sql_anh_phu = "SELECT * FROM dia_danh_anh WHERE id_dia_danh = $id";
$result_anh_phu = mysqli_query($conn, $sql_anh_phu);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo $data['ten_dia_danh']; ?></title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/details.css"> 
</head>
<body>
    <section class="hero-detail" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.6)), url('uploads/<?php echo $data['hinh_anh']; ?>');">
        <div class="container">
            <a href="index.php" class="btn-back-white">← Quay lại</a>
            <div class="hero-info">
                <span class="tag-tinh-white">📍 <?php echo $data['ten_tinh']; ?></span>
                <h1><?php echo $data['ten_dia_danh']; ?></h1>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="detail-content">
            <h3>Giới thiệu</h3>
            <p><?php echo nl2br($data['mo_ta']); ?></p>
        </div>

        <hr class="divider">

        <?php if (mysqli_num_rows($result_anh_phu) > 0): ?>
            <div class="photo-album">
                <h3>Thư viện hình ảnh</h3>
                <div class="gallery-grid">
                    <?php while($anh = mysqli_fetch_assoc($result_anh_phu)): ?>
                        <div class="gallery-item">
                            <img src="uploads/<?php echo $anh['file_anh']; ?>" alt="Ảnh phụ">
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>