<?php
    include("../connect.php");

    if(isset($_POST["themdanhmucsanpham"])) {

        $ten_dmsp = $_POST["ten_dmsp"];
        $thutu = $_POST["thutu"];

        $sql_themdmsp = "INSERT INTO tbl_danhmucsanpham(ten_dmsp, thutu) VALUE('$ten_dmsp', '$thutu')";
        mysqli_query($mysqli, $sql_themdmsp);
        header("location: ../admin.php?action=quanlydanhmucsanpham&query=them");
    }
    elseif(isset($_POST["suadmsp"])) {
        $ten_dmsp = $_POST["ten_dmsp"];
        $thutu = $_POST["thutu"];

        $sql_update = "UPDATE tbl_danhmucsanpham SET ten_dmsp = '$ten_dmsp', thutu = '$thutu' WHERE id_dmsp = '$_GET[id_dmsp]'";
        
        mysqli_query($mysqli, $sql_update);
        header("location: ../admin.php?action=quanlydanhmucsanpham&query=them");
    }
    

    elseif(isset($_GET["id_dmsp"])) {
        $id = $_GET["id_dmsp"];

        $sql_delete = "DELETE FROM tbl_danhmucsanpham WHERE id_dmsp = $id";
        mysqli_query($mysqli, $sql_delete);
        header("location: ../admin.php?action=quanlydanhmucsanpham&query=them");
    }
?>