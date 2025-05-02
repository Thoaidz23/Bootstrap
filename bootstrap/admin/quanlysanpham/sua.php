<div class="col-lg-12">
    <div class="card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Sửa sản phẩm </h3>
            </div>
        </div>
        <div class="card-body">

            <?php
                $sql_lietke_sp = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$_GET[id_sanpham]'";
                $query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
                while($row_sp = mysqli_fetch_array($query_lietke_sp)) {
            ?>

            <form method="post" action="quanlysanpham/xuly.php?id_sanpham=<?php echo $_GET['id_sanpham'] ?>" enctype="multipart/form-data" class="p-4">
                <div class="form-group mb-3">
                    <label for="tensp">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="tensp" name="tensp" value="<?php echo $row_sp["ten_sanpham"] ?>">
                </div>
                
                <div class="form-group mb-3">
                    <label for="masp">Mã sản phẩm</label>
                    <input type="text" class="form-control" id="masp" name="masp" value="<?php echo $row_sp["masp"] ?>">
                </div>
                
                <div class="form-group mb-3">
                    <label for="giasp">Giá sản phẩm</label>
                    <input type="text" class="form-control" id="giasp" name="giasp" value="<?php echo $row_sp["giasp"] ?>">
                </div>
                
                <div class="form-group mb-3">
                    <label for="soluong">Số lượng</label>
                    <input type="text" class="form-control" id="soluong" name="soluong" value="<?php echo $row_sp["soluong"] ?>">
                </div>
                
                <div class="form-group mb-3">
                    <label for="hinhanh">Hình ảnh</label>
                    <input type="file" class="form-control" id="hinhanh" name="hinhanh">
                    <img src="./quanlysanpham/uploads/<?php echo $row_sp["hinhanh"] ?>" width="150px" style="margin-top: 15px;">
                </div>
                
                <div class="form-group mb-3">
                    <label for="noidung">Nội dung</label>
                    <textarea rows="5" class="form-control" id="noidung" name="noidung" style="resize: none"><?php echo $row_sp["noidung"] ?></textarea>
                </div>
                
                <div class="form-group mb-3">
                    <label for="dmsp">Danh mục sản phẩm</label>
                    <select class="form-control" id="dmsp" name="id_dmsp">
                    <?php
                        $sql_lietke_dmsp = "SELECT * FROM tbl_danhmucsanpham";
                        $query_lietke_dmsp = mysqli_query($mysqli, $sql_lietke_dmsp);
                        while($row_dmsp = mysqli_fetch_array($query_lietke_dmsp)) {
                        if($row_dmsp['id_dmsp'] == $row_sp['id_dmsp']) {
                    ?>
                        <option selected value="<?php echo $row_dmsp['id_dmsp']; ?>"><?php echo $row_dmsp['ten_dmsp']; ?></option>
                        <?php
                        }
                        else {
                        ?>
                        <option value="<?php echo $row_dmsp['id_dmsp']; ?>"><?php echo $row_dmsp['ten_dmsp']; ?></option>
                    <?php
                        }
                        }
                    ?>
                    </select>
                </div>
                
                <div class="form-group mb-3">
                    <label for="tinhtrang">Tình trạng</label>
                    <select class="form-control" id="tinhtrang" name="tinhtrang">
                    <?php
                        if($row_sp["tinhtrang"] == 1) {
                    ?>
                    <option value="1" selected>Kích hoạt</option>
                    <option value="0">Ẩn</option>
                    <?php
                        }
                        else {
                    ?>
                    <option value="1">Kích hoạt</option>
                    <option value="0" selected>Ẩn</option>
                    <?php
                        }
                    ?>
                    </select>
                </div>
                 

                <div class="form-group mb-3">
                    <label for="hinhanh">Hình ảnh chi tiết</label>
                    <br>
                    <?php
                        $sql_images = "SELECT * FROM tbl_product_images WHERE id_sanpham = '$_GET[id_sanpham]'";
                        $query_images = mysqli_query($mysqli, $sql_images);
                        while ($row_image = mysqli_fetch_array($query_images)) {
                            ?>
                            <div style="display: inline-block; margin-right: 20px; text-align: center;">
                                <img src="./quanlysanpham/uploads_chitiet/<?php echo $row_image["name"]; ?>" width="100px" height="100px" style="margin-top: 15px">
                            </div>
                            <?php
                        }                                      
                    ?>

                    <div class="fallback" style="margin-top: 20px">
                        <label for="hinhanh">Sửa tất cả hình ảnh</label><br>
                        <input name="file[]" type="file" multiple />
                    </div>

                </div>

                <div class="form-group mb-3">
                    <div id="thong_so_ky_thuat">
                        <label style="margin-top: 50px">Thông số kỹ thuật</label>
                        <div class="thong_so mb-3 d-flex align-items-end" style="padding-right: 10px">
                            <div class="me-2 flex-grow-1">
                                <label class="small text-muted mb-1" style="margin-top: 20px;">Thuộc tính</label>
                            </div>
                            <div class="me-2 flex-grow-1" style="padding-right: 60px">
                                <label class="small text-muted mb-1">Giá trị</label>
                            </div>
                        </div>
                        <?php
                            $sql_tskt = "SELECT * FROM tbl_thongsokythuat WHERE id_sanpham = '$_GET[id_sanpham]'";
                            $query_tskt = mysqli_query($mysqli, $sql_tskt);
                            while ($row = mysqli_fetch_array($query_tskt)) {
                        ?>
                        <div class="thong_so mb-3 d-flex align-items-end">
                            <div class="me-2 flex-grow-1">
                                <input type="text" id="thuoc_tinh_1" name="thuoc_tinh[]" value="<?php echo $row['thuoctinh']; ?>" class="form-control" required>
                            </div>
                            <div class="me-2 flex-grow-1">
                                <input type="text" id="gia_tri_1" name="gia_tri[]" value="<?php echo $row['giatri']; ?>" class="form-control" required>
                            </div>
                            <button type="button" class="btn btn-danger mt-2 xoa_hang" onclick="removeRow(this)">Xóa</button>
                        </div>
                        <?php
                            }
                            ?>
                            <button type="button" id="them_hang" class="btn btn-success mb-3 me-2" onclick="addRow()">Thêm hàng</button>
                    </div>
                </div>

                <div class="form-group mb-3" style="margin-top: 50px; text-align: center">
                    <input type="submit" class="btn btn-primary" name="suasanpham" value="Sửa sản phẩm">
                </div>
            </form>

                <?php
                    }
                ?>
        </div>
        
    </div>
</div>