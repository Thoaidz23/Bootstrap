<?php
    session_start();
    include("./admin/connect.php");
    
?>

<!DOCTYPE html>
<html lang="enul">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/avatar.png" type="image/x-icon" class="circle-favicon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>TTS - Cửa Hàng Điện Tử </title>
    <style>
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
    </style>
</head>
<body>
    <?php
        include("includes/header.php");
        include("includes/menubar.php");
    ?>
<!-- Carousel -->
 <div class="container">
<div id="demo" class="carousel slide banner-carousel" data-bs-ride="carousel">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <?php
        $sql_slider = "SELECT * FROM tbl_banner ORDER BY sort_order";
        $query_slider = mysqli_query($mysqli, $sql_slider);
        $index = 0;
        while($row = mysqli_fetch_array($query_slider)) {
    ?>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>"></button>
    <?php
        $index++;
        }
    ?>
  </div>

  <!-- Slideshow -->
  <div class="carousel-inner ">
    <?php
        mysqli_data_seek($query_slider, 0);
        $active = true;
        while($row = mysqli_fetch_array($query_slider)) {
    ?>
    <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
      <img src="admin/quanlybanner/uploads/<?php echo $row['image']; ?>" alt="Banner" class="d-block w-100 banner-img">
    </div>
    <?php
        $active = false;
        }
    ?>
  </div>

  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="visually-hidden">Trước</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="visually-hidden">Tiếp</span>
  </button>
</div>
</div>
    <!--------------------------------section-product--------------------------->
    <section class="section-product-one">
        <div class="container">
            <div class="section-product-one-content">
                <div class="section-product-one-content-title">
                    <h2>Sản phẩm mới nhất</h2>
                    <div class="section-product-one-content-item-btn">
                        <i class="fas fa-chevron-left" id="prev-btn"></i>
                        <i class="fas fa-chevron-right" id="next-btn"></i>
                    </div>  
                </div>
                <div class="section-product-one-content-container">
                    <div class="section-product-one-content-items-content">
                        <div class="section-product-one-content-items" id="product-list" >
                            <?php
                                $sql_pro_hot = "SELECT * FROM tbl_sanpham ORDER BY id_sanpham DESC LIMIT 20";
                                $query_pro_hot = mysqli_query($mysqli, $sql_pro_hot);
                                while($row = mysqli_fetch_array($query_pro_hot)) {
                            ?>
                            <div class="section-product-one-content-item">
                                <a style="text-decoration: none" href="chitietsanpham.php?id_sanpham=<?php echo $row['id_sanpham']; ?>">
                                    <img src="admin/quanlysanpham/uploads/<?php echo $row["hinhanh"] ?>">
                                    <div class="section-product-one-content-item-text">
                                        <ul>
                                            <li style="color: black"><?php echo $row["ten_sanpham"] ?></li>
                                            <li style="color: black">Online giá rẻ</li>
                                            <li><?php echo number_format($row["giasp"],0,",",".") ?><sup>đ</sup></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>

                            <?php
                                }
                            ?>
                        </div>
                    </div> 
            </div>
        </div>
    </section>

    <?php
    $sql_dmsp = "SELECT * FROM tbl_danhmucsanpham ORDER BY thutu";
    $query_dmsp = mysqli_query($mysqli, $sql_dmsp);

    while($row_dmsp = mysqli_fetch_array($query_dmsp)) {
?>
<?php 
    include("./includes/dmsanphamcpn.php");?>
<?php
    }
?>

     <!-----------------------Product news----------------------->
     <section class="product-news">
        <div class="container">
            <div class="product-news-content">
                <div class="product-gallery-one-content-title">
                    <h2>Bài tin</h2>
                </div>
                <div class="product-news-content-product" id="newsItems">
                <i class="fas fa-chevron-left" id="prevbtn"></i>
                <i class="fas fa-chevron-right" id="nextbtn"></i>
                    <?php
                        $sql_baiviet_hot = "SELECT * FROM tbl_baiviet ORDER BY id_baiviet LIMIT 10";
                        $query_baiviet_hot = mysqli_query($mysqli, $sql_baiviet_hot);
                        while($row = mysqli_fetch_array($query_baiviet_hot)) {
                    ?>
                    <div class="product-news-content-product-item">
                        <a style="text-decoration: none" href="chitietbaiviet.php?id_baiviet=<?php echo $row["id_baiviet"] ?>"><img src="admin/quanlybaiviet/uploads/<?php echo $row["hinhanh"] ?>">
                        <div class="product-news-content-product-item-text">
                            <p><?php echo $row["tieude"] ?></p>
                        </div>

                    </a>
                    </div>
                    <?php
                        }
                    ?>
                    
                    
                    
        </div>
        <div class="seemore-news">
            <?php
                $sql_min_id = "SELECT MIN(id_dmbv) AS min_id FROM tbl_danhmucbaiviet";
                $query_min_id = mysqli_query($mysqli, $sql_min_id);
                $row_min_id = mysqli_fetch_assoc($query_min_id);
                $min_id = $row_min_id['min_id'];
            ?>
            <a style="text-decoration: none" href="danhmucbaiviet.php?id_dmbv=<?php echo $min_id ?>">Xem thêm bài tin<i class="fas fa-chevron-right"></i></a>
        </div>
    </section>

    <?php
        include("includes/footer.php");
    ?>
   
    <script src="assets/js/stript.js"></script>
</body>
</html>
