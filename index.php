<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Khám Phá Du Lịch Việt Nam</title>
    <link rel="stylesheet" href="css/common.css?v=1.3">
    <link rel="stylesheet" href="css/index.css?v=1.3">
</head>
<body>
    <div class="main-wrapper"> 
        <section class="hero-search">
            <div class="search-overlay">
                <div class="search-content">
                    <h1 class="search-title">Bạn muốn đi đâu?</h1>
                    <p class="search-subtitle">Cùng mình khám phá những địa danh tuyệt vời nhất Việt Nam</p>
                    <form action="index.php" method="GET" class="search-form-modern">
                        <div class="input-group">
                            <span class="icon">🔍</span>
                            <input type="text" name="search" placeholder="Nhập tên địa danh..." 
                                   value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        </div>
                        <button type="submit">Tìm kiếm ngay</button>
                    </form>
                </div>
            </div>
        </section>

        <div class="container">
            <div style="text-align: right; margin-bottom: 20px;">
                <?php if (isset($_GET['mode']) && $_GET['mode'] == 'admin'): ?>
                    <a href="add_location.php?mode=admin" class="btn-add">+ Thêm địa danh mới</a>
                <?php endif; ?>
            </div>

            <?php
            $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
            $mien_array = ['Bắc', 'Trung', 'Nam'];

            foreach ($mien_array as $mien) {
                $sql = "SELECT d.*, t.ten_tinh FROM dia_danh d 
                        JOIN tinh_thanh t ON d.id_tinh = t.id 
                        WHERE t.vung_mien = '$mien'";

                if ($search != '') {
                    $sql .= " AND (d.ten_dia_danh LIKE '%$search%' OR t.ten_tinh LIKE '%$search%')";
                }

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<div class='region-section'>";
                    echo "<h2 class='region-title'>Miền $mien</h2>";
                    echo "<div class='location-grid'>";
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class='dia-danh'>
                            <?php if (!empty($row['hinh_anh'])): ?>
                                <a href="details.php?id=<?php echo $row['id']; ?>">
                                    <img src="uploads/<?php echo $row['hinh_anh']; ?>" class="img-preview">
                                </a>
                            <?php endif; ?>
                            
                            <h3><a href="details.php?id=<?php echo $row['id']; ?>" class="location-name"><?php echo $row["ten_dia_danh"]; ?></a></h3>
                            <span class="province-tag">📍 <?php echo $row['ten_tinh']; ?></span>
                            
                            <?php $mo_ta_ngan = mb_substr($row["mo_ta"], 0, 80, "UTF-8"); ?>
                            <p><?php echo $mo_ta_ngan; ?>... <a href="details.php?id=<?php echo $row['id']; ?>">Chi tiết</a></p>

                            <?php if (isset($_GET['mode']) && $_GET['mode'] == 'admin'): ?>
                            <div class="admin-controls" style="margin-top:15px; display:flex; gap:10px; border-top:1px solid #eee; padding-top:10px;">
                                <a href="edit_location.php?id=<?php echo $row['id']; ?>&mode=admin" 
                                class="btn-edit" 
                                style="background:#f1c40f; padding:6px 12px; color:white; text-decoration:none; border-radius:4px; font-size:12px; font-weight:bold;"> Sửa </a>
                                <a href="delete_location.php?id=<?php echo $row['id']; ?>&mode=admin" 
                                class="btn-delete" 
                                style="background:#e74c3c; padding:6px 12px; color:white; text-decoration:none; border-radius:4px; font-size:12px; font-weight:bold;" 
                                onclick="return confirm('Bạn có chắc chắn muốn xóa địa danh này?')"> Xóa </a>
                            </div>
                        <?php endif; ?>
                        </div>
                        <?php
                    }
                    echo "</div></div>"; // Đóng location-grid và region-section
                }
            }
            ?>
        </div> 
    </div> 

    <footer class="main-footer">
        <div class="footer-content">
            <p>HỌC VIỆN CÔNG NGHỆ BƯU CHÍNH VIỄN THÔNG</p>
            <p><strong>Sinh viên thực hiện:</strong> Ngô Trí Hoàn</p>
            <p><strong>MSV:</strong> B23DCCN323 | <strong>Lớp:</strong> D23CQCN01-B</p>
        </div>
    </footer>
</body>
</html>