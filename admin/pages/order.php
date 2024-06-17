<h1>Đơn hàng</h1>
<div class="tbl_order">
    <table>
        <?php
        if (isset($_POST['update_tt'])) {
            $tt = $_POST['status'];
            $id = $_POST['madonhang'];
            $idSizes = $_POST['idsize']; // Lấy danh sách các idsize từ form
            if (!is_array($idSizes)) {
                $idSizes = array($idSizes);
            }

            $sqlUpdate = "UPDATE donhang SET trangthai = '$tt' WHERE madonhang = $id";

            if ($tt === 'Đã hủy') {
                foreach ($idSizes as $idsize) {
                    $sql = "SELECT masanpham, soluong FROM ctdon WHERE madonhang = $id AND idsize = $idsize";
                    $resultsql = pg_query($conn, $sql);

                    if ($resultsql) {
                        while ($rowSql = pg_fetch_assoc($resultsql)) {
                            $masanpham = $rowSql['masanpham'];
                            $soluong = $rowSql['soluong'];

                            // Thực hiện cập nhật soluong trong bảng chitietsanpham cho từng sản phẩm
                            $updateSql = "UPDATE chitietsanpham SET soluong = soluong + $soluong WHERE idsanpham = $masanpham AND idsize = $idsize";
                            $resultUpdate = pg_query($conn, $updateSql);

                            if (!$resultUpdate) {
                                echo 'Lỗi khi cập nhật số lượng cho sản phẩm với idsize: ' . $idsize;
                            }
                        }
                    }
                }
            }

            $resultUpdatett = pg_query($conn, $sqlUpdate);

            if ($resultUpdatett) {
                echo 'Cập nhật trạng thái thành công!';
            } else {
                echo 'Cập nhật trạng thái không thành công!';
            }
        }

        ?>
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Mã khách hàng</th>
                <th>Sản phẩm</th>
                <th>Tổng giá</th>
                <th>Ngày đặt hàng</th>
                <th>Số điện thoại</th>
                <th>PTTT</th>
                <th>Địa chỉ</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_SESSION['admin'])) {

                $query = "SELECT a.madonhang, a.tonggia,a.pttt, a.trangthai, d.diachi, d.sdt,d.makhachhang,a.ngaydat
                      FROM donhang a
                      INNER JOIN thongtinkh d ON a.id_thongtinkh = d.id 
                      group by a.madonhang, a.tonggia,a.pttt, a.trangthai, d.diachi, d.sdt,d.makhachhang,d.makhachhang;
                    
                      ";
                $result = _query($query);

                if (pg_num_rows($result) > 0) {
                    while ($row = pg_fetch_assoc($result)) {
                        $madonhang = $row['madonhang'];
                        $tonggia = number_format($row['tonggia']) . '₫';
                        $sdt = $row['sdt'];
                        $diachi = $row['diachi'];
                        $trangthai = $row['trangthai'];
                        $pttt = $row['pttt'];
                        $makhachhang = $row['makhachhang'];
                        $ngaydat = $row['ngaydat'];
                        ?>


                        <tr>
                            <td>
                                <?php echo $madonhang; ?>
                            </td>
                            <td>
                                <?php echo $makhachhang ?>
                            </td>
                            <td>
                                <div class="container_main">
                                    <?php
                                    $query1 = "SELECT b.tensanpham, b.hinhanh, c.soluong,d.makhachhang,c.idsize
                                FROM donhang a
                                INNER JOIN thongtinkh d on a.id_thongtinkh = d.id
                                INNER JOIN ctdon c ON a.madonhang = c.madonhang
                                INNER JOIN sanpham b ON b.masanpham = c.masanpham
                                where d.makhachhang= '$makhachhang' and a.madonhang= '$madonhang';
                                ";

                                    $result1 = _query($query1);
                                    $idSizes = array();
                                    while ($row1 = pg_fetch_assoc($result1)) {
                                        $tensanpham = $row1['tensanpham'];
                                        $hinhanh = $row1['hinhanh'];
                                        $soluong = $row1['soluong'];
                                        $size = $row1['idsize'];

                                        // Thêm giá trị idsize vào mảng idSizes
                                        $idSizes[] = $size;


                                        $query2 = "SELECT ctdon.*, size_sanpham.* 
                                                    FROM ctdon 
                                                    JOIN size_sanpham ON ctdon.idsize = size_sanpham.idsize 
                                                    WHERE ctdon.madonhang = $madonhang AND size_sanpham.idsize = $size";

                                        $result2 = _query($query2);
                                        ?>

                                        <div class="container_all">
                                            <div class="product-name">
                                                <?php echo $tensanpham; ?>
                                            </div>
                                            <div class="product-quantity">
                                                <?php echo $soluong; ?>
                                            </div>
                                            <div class="product-img">
                                                <img src="../assest/img/thethao/<?php echo $hinhanh; ?>" alt="">
                                            </div>
                                        </div>
                                        <?php
                                        while ($row2 = pg_fetch_assoc($result2)) {
                                            echo '<p style="width: max-content; margin-left: 20px;"> Size: ' . $row2['namesize'] . ' </p>';
                                        }
                                        ?>

                                    <?php } ?>
                                </div>
                            </td>
                            <td style="color: red;">
                                <?php echo $tonggia; ?>
                            </td>
                            <td style="width: 150px;">
                                <?php echo $ngaydat; ?>
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
                            <td style="width: 240px;">
                                <form method="post" action="">
                                    <select name="status" <?php if ($trangthai === 'Đã hủy' || $trangthai === 'Đã hoàn thành')
                                        echo 'disabled' ?>>
                                            <option value="<?php echo $trangthai ?>"><?php echo $trangthai ?></option>
                                        <option value="Chờ xác nhận">Chờ xác nhận</option>
                                        <option value="Đã xác nhận">Đã xác nhận</option>
                                        <option value="Đã hoàn thành">Đã hoàn thành</option>
                                        <option value="Đã hủy">Đã hủy</option>
                                    </select>
                                    <input type="submit" name="update_tt" value="Sửa" <?php if ($trangthai === 'Đã hủy' || $trangthai === 'Đã hoàn thành')
                                        echo 'disabled' ?>>

                                        <input type="hidden" name="madonhang" value="<?php echo $madonhang; ?>">
                                    <?php

                                    foreach ($idSizes as $idSize) {
                                        echo '<input type="hidden" name="idsize[]" value="' . $idSize . '">';

                                    }
                                    ?>

                                    <a style="color: black;" href="?page=delorder&id=<?php echo $madonhang; ?>"><i
                                            class="fa-solid fa-trash"></i></a>
                                </form>

                            </td>

                        </tr>
                    <?php }
                } else {
                    echo '<tr><td colspan="9">Không có đơn hàng</td></tr>';
                }
            } else {
                header('location: ./auth/login.php');
            }
            ?>
        </tbody>
    </table>
</div>
<style>
    .product-name {
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
        right: -5%;
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
</style>