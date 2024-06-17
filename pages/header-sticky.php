<?php
ob_start();
$sql = "SELECT danhmuc.iddanhmuc, danhmuc.tendanhmuc,
       STRING_AGG(loaisanpham.idloai::text || '-' || loaisanpham.tenloai::text, ', ') AS loai_ids,
       STRING_AGG(SPLIT_PART(loaisanpham.idloai::text || '-' || loaisanpham.tenloai::text, '-', 1), ', ') AS idloai,
       STRING_AGG(SPLIT_PART(loaisanpham.idloai::text || '-' || loaisanpham.tenloai::text, '-', 2), ', ') AS tenloai
FROM danhmuc
JOIN loaisanpham ON danhmuc.iddanhmuc = loaisanpham.iddanhmuc
GROUP BY danhmuc.iddanhmuc, danhmuc.tendanhmuc;";
$result = pg_query($conn, $sql);

?>
<div class="header-bot">
    <ul id="nav" class="nav">
        <li><a href="index.php">TRANG CHỦ</a></li>
        <?php
        while ($row = pg_fetch_assoc($result)) {
            $tenloai_array = explode(', ', $row['tenloai']); // Tách chuỗi thành mảng các phần tử
            $idloai_array = explode(', ', $row['idloai']);
            echo '<li><a href="#">' . $row['tendanhmuc'] . '
            <i class="fa-solid fa-caret-down"></i>
        </a>

        <ul class="subnav">';
            foreach ($idloai_array as $index => $idloai) {
                $tenloai = $tenloai_array[$index];
                echo '<li><a href="index.php?page=product_type&type=' . $idloai . '">' . $tenloai . '</a></li>';
            }
            echo '</ul></li>';
        }
        ?>
    </ul>
</div>
<div id="mobile_menu" class="mobile_menu_btn">
    <i class="fa-solid fa-bars"></i>
</div>
</div>
<script>
    var header = document.getElementById('nav');
    var mobileMenu = document.getElementById('mobile_menu');
    var headerHeight = header.clientHeight;

    mobileMenu.onclick = function () {
        var isClosed = header.clientHeight === headerHeight;
        if (isClosed) {
            header.style.height = 'auto';
        } else {
            header.style.height = null;
        }
    }

</script>