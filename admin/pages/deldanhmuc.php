<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Kiểm tra xem trong bảng sản phẩm (sp) có sử dụng iddanhmuc cần xóa không
    $checkQuery = "SELECT sanpham.loaisanpham,loaisanpham.iddanhmuc from sanpham JOIN
loaisanpham ON sanpham.loaisanpham = loaisanpham.idloai where loaisanpham.iddanhmuc = $id;";
    $checkResult = pg_query($conn, $checkQuery);
    $rowCount = pg_num_rows($checkResult);


    $checkLoai = "SELECT * from loaisanpham where iddanhmuc = $id";
    $checkLoaiResult = pg_query($conn, $checkLoai);
    $rowCount1 = pg_num_rows($checkLoaiResult);


    if ($rowCount > 0) {
        echo '<script>alert("Không thể xóa vì danh mục đang được sử dụng trong bảng sản phẩm."); window.location.href="?page=category";</script>';

    } else if ($rowCount1 > 0) {
        echo '<script>alert("Không thể xóa vì danh mục đang được sử dụng trong bảng loại sản phẩm."); window.location.href="?page=category";</script>';

    } else {
        // Nếu không có sử dụng, tiến hành xóa
        $query = "DELETE FROM danhmuc WHERE iddanhmuc = '$id'";
        $result = pg_query($conn, $query);

        if ($result) {
            header('Location: ?page=category');
        } else {
            echo 'Xóa không thành công.';
        }
    }
} else if (isset($_GET['idloai'])) {
    $id = $_GET['idloai'];

    // Kiểm tra xem trong bảng sản phẩm (sp) có sử dụng iddanhmuc cần xóa không
    $checkQuery = "SELECT * FROM sanpham WHERE loaisanpham = '$id'";
    $checkResult = pg_query($conn, $checkQuery);
    $rowCount = pg_num_rows($checkResult);

    if ($rowCount > 0) {
        echo '<script>alert("Không thể xóa vì danh mục đang được sử dụng trong bảng sản phẩm."); window.location.href="?page=category";</script>';

    } else {
        // Nếu không có sử dụng, tiến hành xóa
        $query = "DELETE FROM loaisanpham WHERE idloai = '$id'";
        $result = pg_query($conn, $query);

        if ($result) {
            header('Location: ?page=loaisp');
        } else {
            echo 'Xóa không thành công.';
        }
    }
}


?>