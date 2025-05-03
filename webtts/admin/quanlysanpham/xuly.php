<?php
    include("../connect.php");

    if(isset($_POST["themsanpham"])) {

        $tensp = $_POST["tensp"];
        $masp = $_POST["masp"];
        $giasp = $_POST["giasp"];
        $soluong = $_POST["soluong"];
        $hinhanh = $_FILES["hinhanh"]["name"];
        $hinhanh_tmp = $_FILES["hinhanh"]["tmp_name"];
        $hinhanh = time()."_".$hinhanh;
        $noidung = $_POST["noidung"];
        $tinhtrang = $_POST["tinhtrang"];
        $dmsp = $_POST["dmsp"];

        $sql_themsp = "INSERT INTO tbl_sanpham(ten_sanpham, masp, giasp, soluong, hinhanh, noidung, tinhtrang, id_dmsp) VALUE('$tensp', '$masp', '$giasp', '$soluong', '$hinhanh','$noidung', '$tinhtrang', '$dmsp')";
        mysqli_query($mysqli, $sql_themsp);
        move_uploaded_file($hinhanh_tmp, "uploads/".$hinhanh);

        $product_id = mysqli_insert_id($mysqli);
        if (isset($_FILES['file']['name']) && is_array($_FILES['file']['name'])) {
            foreach ($_FILES['file']['name'] as $key => $image_name) {
                $image_tmp_name = $_FILES['file']['tmp_name'][$key];
                $image_name = time() . "_" . $image_name;
                
                move_uploaded_file($image_tmp_name, "uploads_chitiet/" . $image_name);
                
                $sql_image = "INSERT INTO tbl_product_images (id_sanpham, name) VALUES ('$product_id', '$image_name')";
                mysqli_query($mysqli, $sql_image);
            }
        }

        if (isset($_POST['thuoc_tinh']) && isset($_POST['gia_tri'])) {
            $thuoc_tinh = $_POST['thuoc_tinh'];
            $gia_tri = $_POST['gia_tri'];

            foreach ($thuoc_tinh as $key => $value) {
                $sql_tskt = "INSERT INTO tbl_thongsokythuat (id_sanpham, thuoctinh, giatri) VALUES ('$product_id', '$thuoc_tinh[$key]', '$gia_tri[$key]')";
                mysqli_query($mysqli, $sql_tskt);
            }
        }

        header("location: ../admin.php?action=quanlysanpham&query=lietke");
    }

    elseif(isset($_POST["suasanpham"])) {

            $tensp = $_POST["tensp"];
            $masp = $_POST["masp"];
            $giasp = $_POST["giasp"];
            $soluong = $_POST["soluong"];
            $noidung = $_POST["noidung"];
            $tinhtrang = $_POST["tinhtrang"];
            $id_dmsp = $_POST["id_dmsp"];

        if(!empty($_FILES["hinhanh"]["name"])) {
            $hinhanh = $_FILES["hinhanh"]["name"];
            $hinhanh_tmp = $_FILES["hinhanh"]["tmp_name"];
            $hinhanh = time()."_".$hinhanh;
    
            $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$_GET[id_sanpham]'";
            $query = mysqli_query($mysqli, $sql);
            while($row = mysqli_fetch_array($query)) {
                unlink("uploads/".$row["hinhanh"]);
            }
    
            move_uploaded_file($hinhanh_tmp, "uploads/".$hinhanh);
            
            $sql_update = "UPDATE tbl_sanpham SET ten_sanpham = '$tensp', masp = '$masp', giasp = '$giasp', soluong = '$soluong', hinhanh = '$hinhanh', noidung = '$noidung', tinhtrang = '$tinhtrang', id_dmsp = '$id_dmsp' WHERE id_sanpham = '$_GET[id_sanpham]'";
        }
        else {
            $sql_update = "UPDATE tbl_sanpham SET ten_sanpham = '$tensp', masp = '$masp', giasp = '$giasp', soluong = '$soluong', noidung = '$noidung', tinhtrang = '$tinhtrang', id_dmsp = '$id_dmsp' WHERE id_sanpham = '$_GET[id_sanpham]'";
        }
        mysqli_query($mysqli, $sql_update);



        if(isset($_FILES['file']['name']) && array_filter($_FILES['file']['name'])) {
            $id_sanpham = $_GET['id_sanpham'];

            $sql_images = "SELECT * FROM tbl_product_images WHERE id_sanpham = '$id_sanpham'";
            $query_images = mysqli_query($mysqli, $sql_images);
            while ($row_image = mysqli_fetch_array($query_images)) {
                $file_path = "uploads_chitiet/" . $row_image['name'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            $sql_delete_images = "DELETE FROM tbl_product_images WHERE id_sanpham = '$id_sanpham'";
            mysqli_query($mysqli, $sql_delete_images);

            foreach ($_FILES['file']['name'] as $key => $image_name) {
                $image_tmp_name = $_FILES['file']['tmp_name'][$key];
                $new_image_name = time() . "_" . $image_name;

                move_uploaded_file($image_tmp_name, "uploads_chitiet/" . $new_image_name);

                $sql_insert_image = "INSERT INTO tbl_product_images (id_sanpham, name) VALUES ('$id_sanpham', '$new_image_name')";
                mysqli_query($mysqli, $sql_insert_image);
            }
        }

        if (isset($_POST['thuoc_tinh']) && isset($_POST['gia_tri'])) {
            $thuoc_tinh = $_POST['thuoc_tinh'];
            $gia_tri = $_POST['gia_tri'];

            $sql_delete_tskt = "DELETE FROM tbl_thongsokythuat WHERE id_sanpham = '$_GET[id_sanpham]'";
            mysqli_query($mysqli, $sql_delete_tskt);

            foreach ($thuoc_tinh as $key => $value) {
                $value = mysqli_real_escape_string($mysqli, $value);
                $id_sanpham = $_GET['id_sanpham'];
                $sql_insert_tskt = "INSERT INTO tbl_thongsokythuat (id_sanpham, thuoctinh, giatri) VALUES ('$id_sanpham', '$value', '" . mysqli_real_escape_string($mysqli, $gia_tri[$key]) . "')";
                mysqli_query($mysqli, $sql_insert_tskt);
            }
        }

        header("location: ../admin.php?action=quanlysanpham&query=lietke");
    }
    


    elseif(isset($_GET["id_sanpham"]) && $_GET['query'] == 'xoa') {
        $id = $_GET["id_sanpham"];

        $sql_unlink = "SELECT * FROM tbl_sanpham WHERE id_sanpham = $id";
        $query_unlink = mysqli_query($mysqli, $sql_unlink);
        while($row = mysqli_fetch_array($query_unlink)) {
            unlink("uploads/".$row['hinhanh']);
        };

        $sql_unlink_chitiet = "SELECT * FROM tbl_product_images WHERE id_sanpham = $id";
        $query_unlink_chitiet = mysqli_query($mysqli, $sql_unlink_chitiet);
        while($row = mysqli_fetch_array($query_unlink_chitiet)) {
            unlink("uploads_chitiet/".$row['name']);
        }

        $sql_delete = "DELETE FROM tbl_sanpham WHERE id_sanpham = $id";
        mysqli_query($mysqli, $sql_delete);
        $sql_delete_chitiet = "DELETE FROM tbl_product_images WHERE id_sanpham = $id";
        mysqli_query($mysqli, $sql_delete_chitiet);
        $sql_delete_tskt = "DELETE FROM tbl_thongsokythuat WHERE id_sanpham = $id";
        mysqli_query($mysqli, $sql_delete_tskt);

        header("location: ../admin.php?action=quanlysanpham&query=lietke");
    }

    

?>