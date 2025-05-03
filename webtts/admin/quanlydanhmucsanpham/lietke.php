<div class="col-lg-12">
    <div class="card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Liệt kê danh mục sản phẩm  </h3>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover" style="width: 100%">
                <thead>
                    <tr>
                    <th>Stt</th>
                    <th>Tên danh mục</th>
                    <th>Thứ tự</th>
                    <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $sql_lietke = "SELECT * FROM tbl_danhmucsanpham ORDER BY thutu";
                    $query_lietke = mysqli_query($mysqli, $sql_lietke);
                    while($row = mysqli_fetch_array($query_lietke)) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row["ten_dmsp"] ?></td>
                        <td><?php echo $row["thutu"] ?></td>
                        <td>
                            <a href="?action=quanlydanhmucsanpham&query=sua&id_dmsp=<?php echo $row["id_dmsp"] ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="quanlydanhmucsanpham/xuly.php?id_dmsp=<?php echo $row["id_dmsp"] ?>" class="btn btn-danger btn-sm">Xóa</a> 
                        </td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
                </table>
                                                                    
        </div>
    </div>
</div>