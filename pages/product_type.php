<?php
if (isset($_GET['type'])) {
    $id = $_GET['type'];
    $sql = "SELECT * from loaisanpham where idloai = $id";
    $result = pg_query($conn, $sql);

    while ($row = pg_fetch_assoc($result)) {
        $idloai = $row['idloai'];
        echo '<div class="product-banner">
                <img src="./assest/img/center/breadcrumb.webp" alt="">
            </div>
            <div class="product-banner-title">
                <div class="sub-banner">
                    <p><a href="index.php">Trang Chủ</a></p>
                    <p>' . $row['tenloai'] . '</p>
                </div>
            </div>
            <div class="container-product">';
        echo getProductAll($idloai); // Lấy danh sách sản phẩm
    }
}
?>
<style>
    h3 {
        padding: 50px;
        margin: 0 auto;
        color: red;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    .container-product {
        flex-wrap: wrap;
    }

    .page_btn {
        padding: 20px 0;
        margin-right: 14%;
        text-align: center;
    }

    .product-sub-sex {
        width: 100%;
        background-color: #f8f8f8;
    }

    .product-banner-title a {
        text-decoration: none;
        color: #000;
    }

    .product-banner img {
        width: 100%;
    }

    .sub-banner {
        display: flex;
        width: 1200px;
        height: 40px;
        margin: 0 auto;
        align-items: center;
    }

    .sub-banner p {
        line-height: 40px;
    }

    .sub-banner a:hover {
        color: red;
    }

    .sub-banner p:last-child {
        color: red;

    }

    .sub-banner p::after {
        content: ">";
        padding: 0 10px;

    }

    .sub-banner p:last-child::after {
        display: none;
    }
</style>