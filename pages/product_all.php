<?php
$sql = "SELECT danhmuc.iddanhmuc, danhmuc.tendanhmuc,
       STRING_AGG(loaisanpham.idloai::text || '-' || loaisanpham.tenloai::text, ', ') AS loai_ids,
       STRING_AGG(SPLIT_PART(loaisanpham.idloai::text || '-' || loaisanpham.tenloai::text, '-', 1), ', ') AS idloai,
       STRING_AGG(SPLIT_PART(loaisanpham.idloai::text || '-' || loaisanpham.tenloai::text, '-', 2), ', ') AS tenloai
FROM danhmuc
JOIN loaisanpham ON danhmuc.iddanhmuc = loaisanpham.iddanhmuc
GROUP BY danhmuc.iddanhmuc, danhmuc.tendanhmuc";
$result = pg_query($conn, $sql);

while ($row = pg_fetch_assoc($result)) {
    $tenloai_array = explode(', ', $row['tenloai']); // Tách chuỗi thành mảng các phần tử
    $idloai_array = explode(', ', $row['idloai']);
    echo '<div class="header-product">
        <div class="product-title">
            <p>' . $row['tendanhmuc'] . '<span></span></p>
        </div>
    </div>
    <div class="container-product">';
    
    // Lặp qua từng cặp idloai và tenloai tương ứng
    for ($i = 0; $i < count($idloai_array); $i++) {
        getProduct(5, $idloai_array[$i], $tenloai_array[$i]);
    }

    echo '</div>
    <div class="more-btn-product">
        <p class="more_view" style="width: max-content; margin: 0 auto;"><a href="index.php?page=product_type&type=' . $idloai_array[0] . '">XEM THÊM</a></p>';
}
?>