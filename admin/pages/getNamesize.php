<?php

require '../../pages/db.php';
// Lấy giá trị id từ request GET
if (isset($_GET['idsize']) && isset($_GET['masanpham'])) {
    $idsize = $_GET['idsize'];
    $masanpham = $_GET['masanpham'];

    // Thực hiện truy vấn SQL để lấy dữ liệu loại sản phẩm
    $query = "SELECT soluong FROM chitietsanpham WHERE idsize = $idsize and idsanpham = $masanpham";
    $result = pg_query($conn, $query);
}

if (!$result) {
    echo "Error in query";
    exit;
}

// Chuyển dữ liệu thành mảng JSON
$productTypes = array();
while ($row = pg_fetch_assoc($result)) {
    $productTypes = $row;
}

// Trả về dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($productTypes);

?>