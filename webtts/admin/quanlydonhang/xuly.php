<?php
    include("../connect.php");

    if (isset($_POST["capnhat_tonghop"])) {
        $status = $_POST["status"];
        $pay_status = $_POST["pay_status"];
        $id_order = $_GET["id_order"];

        // Cập nhật cả hai cột
        $sql_update = "UPDATE tbl_order 
                       SET status = '$status', pay_status = '$pay_status' 
                       WHERE id_order = '$id_order'";

        mysqli_query($mysqli, $sql_update);

        // Quay về trang quản lý đơn hàng
        header("location: ../admin.php?action=quanlydonhang&query=lietke");
    }
?>
