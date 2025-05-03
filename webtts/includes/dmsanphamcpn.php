<?php
// Bao gồm kết nối cơ sở dữ liệu
include("./admin/connect.php");

$sql_dmsp = "SELECT * FROM tbl_danhmucsanpham ORDER BY thutu";
$query_dmsp = mysqli_query($mysqli, $sql_dmsp);

// Kiểm tra lỗi trong truy vấn
if (!$query_dmsp) {
    die("Error in query: " . mysqli_error($mysqli));
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TTS - Cửa Hàng Điện Tử</title>
    <link rel="icon" href="assets/img/avatar.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card:hover img {
            transform: translateY(-10px);
            transition: transform 0.3s ease;
        }
        .product-title {
            font-size: 20px;
            font-style: italic;
            padding: 20px 0 10px 10px;
        }
        /* Tránh Bootstrap ghi đè */
header, nav {
    box-sizing: border-box;
    width: 100%;
}

header .logo img {
    max-height: 50px;
}

nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 20px;
}

        @media (min-width: 1200px) {
    .col-xl-5ths {
        width: 20%;
        flex: 0 0 20%;
    }
}
    </style>
</head>
<body>

<?php while($row_dmsp = mysqli_fetch_array($query_dmsp)) { ?>
    <section class="py-3">
        <div class="container">
            <div class="product-title">
                <h2><?php echo $row_dmsp["ten_dmsp"]; ?> Nổi Bật Nhất</h2>
            </div>
            
            <div class="row gx-2 gy-4">
                <?php
                    $id_dmsp = $row_dmsp["id_dmsp"];
                    $sql_sanpham = "SELECT * FROM tbl_sanpham WHERE id_dmsp = $id_dmsp ORDER BY id_sanpham LIMIT 10";
                    $query_sanpham = mysqli_query($mysqli, $sql_sanpham);

                    if (!$query_sanpham) {
                        die("Error in product query: " . mysqli_error($mysqli));
                    }

                    while($row_sanpham = mysqli_fetch_array($query_sanpham)) {
                ?>
                <div class="col-6 col-md-4 col-lg-3 col-xl-5ths ">

                    <div class="card h-100 border-1 pt-4 shadow-sm">
                        <a href="chitietsanpham.php?id_sanpham=<?php echo $row_sanpham['id_sanpham']; ?>" class="text-decoration-none">
                            <img src="admin/quanlysanpham/uploads/<?php echo $row_sanpham["hinhanh"]; ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo $row_sanpham["ten_sanpham"]; ?>">
                            <div class="card-body p-2">
                                <ul class="list-unstyled mb-0">
                                    <li class="fw-semibold text-dark small"><?php echo $row_sanpham["ten_sanpham"]; ?></li>
                                    <li class="text-muted small">Online giá rẻ</li>
                                    <li class="text-danger fw-bold">
                                    <?php echo number_format($row_sanpham["giasp"], 0, ",", "."); ?><sup>đ</sup>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>