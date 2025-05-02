<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <?php
            $sql_lietke_sp = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$_GET[id_sanpham]'";
            $query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
            while ($row_sp = mysqli_fetch_array($query_lietke_sp)) {
            ?>
            <div class="row">

                <div class="col-md-6">
                    <h5 class="mb-3" style="font-size: 1.2rem;">Thông tin cơ bản</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item py-2"><strong>Tên sản phẩm:</strong> <?php echo $row_sp["ten_sanpham"]; ?></li>
                        <li class="list-group-item py-2"><strong>Mã sản phẩm:</strong> <?php echo $row_sp["masp"]; ?></li>
                        <li class="list-group-item py-2"><strong>Giá sản phẩm:</strong> <?php echo number_format($row_sp["giasp"], 0, ',', '.'); ?> VNĐ</li>
                        <li class="list-group-item py-2"><strong>Số lượng:</strong> <?php echo $row_sp["soluong"]; ?></li>
                        <li class="list-group-item py-2"><strong>Trạng thái:</strong> <?php echo $row_sp["tinhtrang"] == 1 ? "Kích hoạt" : "Ẩn"; ?></li>

                        <?php
                        $sql_danhmuc = "SELECT ten_dmsp FROM tbl_danhmucsanpham WHERE id_dmsp = '" . $row_sp["id_dmsp"] . "'";
                        $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                        $row_danhmuc = mysqli_fetch_array($query_danhmuc);
                        ?>
                        <li class="list-group-item py-2"><strong>Danh mục:</strong> <?php echo $row_danhmuc["ten_dmsp"]; ?></li>
                    </ul>

                    <h5 class="mt-4 mb-3" style="font-size: 1.2rem;">Thông số kỹ thuật</h5>
                    <table class="table table-sm table-striped">
                        <tbody>
                            <?php
                            $sql_tskt = "SELECT * FROM tbl_thongsokythuat WHERE id_sanpham = '$_GET[id_sanpham]'";
                            $query_tskt = mysqli_query($mysqli, $sql_tskt);
                            while ($row_tskt = mysqli_fetch_array($query_tskt)) {
                                echo "<tr>
                                    <td style='font-size: 0.9rem;'>{$row_tskt['thuoctinh']}</td>
                                    <td style='font-size: 0.9rem;'>{$row_tskt['giatri']}</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <h5 class="mb-3" style="font-size: 1.2rem;">Hình ảnh sản phẩm</h5>
                    <img src="./quanlysanpham/uploads/<?php echo $row_sp["hinhanh"]; ?>" class="img-thumbnail mb-3" alt="Hình ảnh sản phẩm">
                    <h6>Hình ảnh chi tiết</h6>
                    <div class="d-flex flex-wrap">
                        <?php
                        $sql_images = "SELECT * FROM tbl_product_images WHERE id_sanpham = '$_GET[id_sanpham]'";
                        $query_images = mysqli_query($mysqli, $sql_images);
                        while ($row_image = mysqli_fetch_array($query_images)) {
                            echo '<img src="./quanlysanpham/uploads_chitiet/' . $row_image["name"] . '" class="img-thumbnail me-2 mb-2" width="100">';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <h5 class="mb-3" style="font-size: 1.2rem;">Nội dung mô tả</h5>
                    <div class="p-3 bg-light border rounded" style="font-size: 0.9rem; line-height: 1.4;">
                        <?php 
                            $noidung = $row_sp["noidung"];
                            $noidung = preg_replace('/(\r\n|\n|\r)/', ' ', $noidung);
                            $noidung = preg_replace('/\s+/', ' ', $noidung);
                            $noidung = trim($noidung);
                            echo $noidung;
                        ?>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
