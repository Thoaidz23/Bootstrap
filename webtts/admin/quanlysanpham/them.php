<div class="col-lg-12">
    <div class="card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Thêm sản phẩm </h3>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="quanlysanpham/xuly.php" enctype="multipart/form-data" class="p-4">
                <div class="form-group mb-3">
                    <label for="tensp">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="tensp" name="tensp" placeholder="Nhập tên sản phẩm">
                </div>
                
                <div class="form-group mb-3">
                    <label for="masp">Mã sản phẩm</label>
                    <input type="text" class="form-control" id="masp" name="masp" placeholder="Nhập mã sản phẩm">
                </div>
                
                <div class="form-group mb-3">
                    <label for="giasp">Giá sản phẩm</label>
                    <input type="text" class="form-control" id="giasp" name="giasp" placeholder="Nhập giá sản phẩm">
                </div>
                
                <div class="form-group mb-3">
                    <label for="soluong">Số lượng</label>
                    <input type="text" class="form-control" id="soluong" name="soluong" placeholder="Nhập số lượng">
                </div>
                
                <div class="form-group mb-3">
                    <label for="hinhanh">Hình ảnh</label>
                    <input type="file" class="form-control" id="hinhanh" name="hinhanh">
                </div>
                
                <div class="form-group mb-3">
                    <label for="noidung">Nội dung</label>
                    <textarea rows="5" class="form-control" id="noidung" name="noidung" style="resize: none" placeholder="Nhập nội dung sản phẩm"></textarea>
                </div>
                
                <div class="form-group mb-3">
                    <label for="dmsp">Danh mục sản phẩm</label>
                    <select class="form-control" id="dmsp" name="dmsp">
                    <?php
                        $sql_lietke_dmsp = "SELECT * FROM tbl_danhmucsanpham";
                        $query_lietke_dmsp = mysqli_query($mysqli, $sql_lietke_dmsp);
                        while($row_dmsp = mysqli_fetch_array($query_lietke_dmsp)) {
                    ?>
                        <option value="<?php echo $row_dmsp['id_dmsp']; ?>"><?php echo $row_dmsp['ten_dmsp']; ?></option>
                    <?php } ?>
                    </select>
                </div>
                
                <div class="form-group mb-3">
                    <label for="tinhtrang">Tình trạng</label>
                    <select class="form-control" id="tinhtrang" name="tinhtrang">
                    <option value="1">Kích hoạt</option>
                    <option value="0">Ẩn</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="file">Chọn ảnh chi tiết</label>
                    <input name="file[]" type="file" class="form-control" multiple />
                </div>

                <div id="thong_so_ky_thuat">
                    <label>Thông số kỹ thuật</label>
                    <div class="thong_so mb-3 d-flex align-items-end">
                        <div class="me-2 flex-grow-1">
                            <label for="thuoc_tinh_1" class="small text-muted mb-1" style="margin-top: 0px; margin-left: 150px">Thuộc tính</label>
                            <input type="text" id="thuoc_tinh_1" name="thuoc_tinh[]" class="form-control" required>
                        </div>
                        <div class="me-2 flex-grow-1">
                            <label for="gia_tri_1" class="small text-muted mb-1" style="margin-top: 0px; margin-left: 170px">Giá trị</label>
                            <input type="text" id="gia_tri_1" name="gia_tri[]" class="form-control" required>
                        </div>
                        <button type="button" class="btn btn-danger mt-2 xoa_hang">Xóa</button>
                    </div>
                </div>
                <button type="button" id="them_hang" class="btn btn-success mb-3 me-2">Thêm hàng</button>




                <div class="form-group mb-3" style="text-align: center">
                    <input type="submit" class="btn btn-primary" name="themsanpham" value="Thêm sản phẩm">
                </div>
                </form>
                                                                                    
        </div>
        
    </div>
</div>