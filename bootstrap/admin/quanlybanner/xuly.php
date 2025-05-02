<?php
    session_start();
    include("../connect.php");

    if(isset($_POST["thembanner"])) {

        $tenbanner = $_POST["tenbanner"];
        $hinhanh = $_FILES["hinhanh"]["name"];
        $hinhanh_tmp = $_FILES["hinhanh"]["tmp_name"];
        $hinhanh = time()."_".$hinhanh;
        $thutu = $_POST["thutu"];
        $tinhtrang = $_POST["tinhtrang"];
        $id_user = $_SESSION["admin_id_user"];

        $sql_thembn = "INSERT INTO tbl_banner(name, image, sort_order, status, id_user) VALUE('$tenbanner', '$hinhanh', '$thutu', '$tinhtrang', '$id_user')";
        mysqli_query($mysqli, $sql_thembn);
        move_uploaded_file($hinhanh_tmp, "uploads/".$hinhanh);
        header("location: ../admin.php?action=quanlybanner&query=them");
    }
    elseif(isset($_POST["suabanner"])) {
            $tenbanner = $_POST["tenbanner"];
            $thutu = $_POST["thutu"];
            $tinhtrang = $_POST["tinhtrang"];
            $id_user = $_SESSION["admin_id_user"];

        if(!empty($_FILES["hinhanh"]["name"])) {
            $hinhanh = $_FILES["hinhanh"]["name"];
            $hinhanh_tmp = $_FILES["hinhanh"]["tmp_name"];
            $hinhanh = time()."_".$hinhanh;
    
            $sql = "SELECT * FROM tbl_banner WHERE id_banner = '$_GET[id_banner]'";
            $query = mysqli_query($mysqli, $sql);
            while($row = mysqli_fetch_array($query)) {
                unlink("uploads/".$row["hinhanh"]);
            }
    
            move_uploaded_file($hinhanh_tmp, "uploads/".$hinhanh);
            
            $sql_update = "UPDATE tbl_banner SET name = '$tenbanner', image = '$hinhanh', sort_order = '$thutu', status = '$tinhtrang', id_user = '$id_user' WHERE id_banner = '$_GET[id_banner]'";
        }
        else {
            $sql_update = "UPDATE tbl_banner SET name = '$tenbanner', sort_order = '$thutu', status = '$tinhtrang', id_user = '$id_user' WHERE id_banner = '$_GET[id_banner]'";
        }
        
        mysqli_query($mysqli, $sql_update);
        header("location: ../admin.php?action=quanlybanner&query=them");
    }
    

    else if(isset($_GET["id_banner"])) {
        $id = $_GET["id_banner"];

        $sql_delete = "DELETE FROM tbl_banner WHERE id_banner = $id";
        mysqli_query($mysqli, $sql_delete);
        header("location: ../admin.php?action=quanlybanner&query=them");
    }
?>