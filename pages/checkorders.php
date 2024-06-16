<div class="tbl_checkorder">
<table>
    <thead>
        <tr>
            <th>Mã đơn hàng</th>
            <th>Sản phẩm</th>
            <th>Tổng giá</th>
            <th>Số điện thoại</th>
            <th>PTTT</th>
            <th>Địa chỉ</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_SESSION['client'])) {

            $id = $_SESSION['user_id'];
            $query = "SELECT a.madonhang, a.tonggia,a.pttt, a.trangthai, d.diachi, d.sdt
                      FROM donhang a
                      INNER JOIN thongtinkh d ON a.id_thongtinkh = d.id
                      WHERE d.makhachhang = $id";
            $result = pg_query($conn, $query);

            if (pg_num_rows($result) > 0) {
                while ($row = pg_fetch_assoc($result)) {
                    $madonhang = $row['madonhang'];
                    $tonggia = number_format($row['tonggia']) . '₫';
                    $sdt = $row['sdt'];
                    $diachi = $row['diachi'];
                    $trangthai = $row['trangthai'];
                    $pttt= $row['pttt'];
                    ?>

                    <tr>
                        <td>
                            <?php echo $madonhang; ?>
                        </td>
                        <td>
                            <div class="container_main">
                                <?php
                                $query1 = "SELECT b.tensanpham, b.hinhanh, c.soluong
                                           FROM donhang a
                                           INNER JOIN thongtinkh d on a.id_thongtinkh = d.id
                                           INNER JOIN ctdon c ON a.madonhang = c.madonhang
                                           INNER JOIN sanpham b ON b.masanpham = c.masanpham
                                           WHERE d.makhachhang = $id AND a.madonhang = $madonhang";
                                $result1 = pg_query($conn,$query1);

                                while ($row1 = pg_fetch_assoc($result1)) {
                                    $tensanpham = $row1['tensanpham'];
                                    $hinhanh = $row1['hinhanh'];
                                    $soluong = $row1['soluong'];
                                    ?>

                                    <div class="container_all">
                                        <div class="product-name">
                                            <?php echo $tensanpham; ?>
                                        </div>
                                        <div class="product-quantity">
                                            <?php echo $soluong; ?>
                                        </div>
                                        <div class="product-img">
                                            <img src="./assest/img/thethao/<?php echo $hinhanh; ?>" alt="">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </td>
                        <td style="color: red;">
                            <?php echo $tonggia; ?>
                        </td>
                        <td>
                            <?php echo $sdt; ?>
                        </td>
                        <td>
                            <?php echo $pttt; ?>
                        </td>
                        <td>
                            <?php echo $diachi; ?>
                        </td>
                        <td>
                            <?php echo $trangthai; ?>
                        </td>
                    </tr>
                <?php }
            } else {
                echo '<tr><td colspan="6">Không có đơn hàng</td></tr>';
            }
        } else {
            header('location: ./auth/login.php');
        }
        ?>
    </tbody>
</table>
</div>

<!-- <style>
    .product-name{
        width: 120px;
    }
    .container_main {
        height: 130px;
        overflow: auto;
    }

    .container_all {
        display: flex;
        justify-content: space-around;
        position: relative;
        margin: 15px;

    }

    .product-img img {
        width: 100px;

    }

    .product-quantity {
        right: 2%;
        top: -6%;
        position: absolute;
        border: 1px solid #ccc;
        background-color: cornflowerblue;
        color: #fff;
        padding: 2px;
        height: 24px;
        width: 23px;
        text-align: center;
        border-radius: 10px;
    }

    table {
        width: 1400px;
        margin: 0 auto;
        border-collapse: collapse;
        border: 1px solid #ddd;
        /* margin: 50px 0; */
    }

    th,
    td {
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style> -->