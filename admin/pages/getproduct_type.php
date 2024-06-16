<?php

require '../../pages/db.php';
// Lấy giá trị id từ request GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Thực hiện truy vấn SQL để lấy dữ liệu loại sản phẩm
    $query = "SELECT idloai, tenloai FROM loaisanpham WHERE iddanhmuc = $id";
    $result = pg_query($conn, $query);
} else if (isset($_GET['masanpham']) || isset($_GET['id'])) {
    
    $id = $_GET['id'];
    $masanpham = $_GET['masanpham'];

    $query = "  SELECT loaisanpham.*,sanpham.masanpham FROM loaisanpham
  JOIN sanpham ON sanpham.loaisanpham = loaisanpham.idloai
  WHERE loaisanpham.iddanhmuc = $id and sanpham.masanpham = $masanpham;";
    $result = pg_query($conn, $query);

}


if (!$result) {
    echo "Error in query";
    exit;
}

// Chuyển dữ liệu thành mảng JSON
$productTypes = array();
while ($row = pg_fetch_assoc($result)) {
    $productTypes[] = $row;
}

// Trả về dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($productTypes);

?>