<?php
function getProduct($n, $sex)
{
    global $conn;
    require ('db.php');
    $query = "SELECT * FROM sanpham where loaisanpham = $sex ORDER BY masanpham desc limit $n";
    $result = pg_query($conn, $query);
    while ($row = pg_fetch_assoc($result)) {

        echo '<form action="?page=addtocart" method="POST">
        <div class="product-section">
                <div class="product-content">
                    <div class="product-img">
                        <img src="./assest/img/thethao/' . $row['hinhanh'] . '" alt="">
                        <input type="hidden" name="img" value="./assest/img/thethao/' . $row['hinhanh'] . '">
                    </div>
                    <div class="product-name">
                        <p><a href="index.php?page=product_detail&id=' . $row['masanpham'] . '">' . $row['tensanpham'] . '</a></p>
                        <input type="hidden" name="tensp" value="' . $row['tensanpham'] . '">
                    </div>
                    <div class="product-price">
                        <p>' . number_format($row['gia']) . '₫</p>
                        <input type="hidden" name="price" value="' . $row['gia'] . '">
                    </div>
                    <input type="hidden" name="id" value="' . $row['masanpham'] . '">

                    <div class="product-desc">
                        <input type="submit" value="Thêm Giỏ Hàng"  name="order" class="add-cart-btn"></input>
                    </div>
                </div>
            </div>
        </form>';

    }
}
function getRelatedProduct($type, $n)
{
    global $conn;
    require ('db.php');
    $query = "SELECT * FROM sanpham WHERE loaisanpham='$type' ORDER BY masanpham limit $n";
    $result = pg_query($conn, $query);
    if ($result) {
        while ($row = pg_fetch_assoc($result)) {

            echo '<form action="?page=addtocart" method="POST">
            <div class="product-section">
                    <div class="product-content">
                        <div class="product-img">
                            <img src="./assest/img/thethao/' . $row['hinhanh'] . '" alt="">
                            <input type="hidden" name="img" value="./assest/img/thethao/' . $row['hinhanh'] . '">
                        </div>
                        <div class="product-name overflow-ellipsis">
                            <p><a href="index.php?page=product_detail&id=' . $row['masanpham'] . '">' . $row['tensanpham'] . '</a></p>
                            <input type="hidden" name="tensp" value="' . $row['tensanpham'] . '">
                        </div>
                        <div class="product-price">
                            <p>' . number_format($row['gia']) . '₫</p>
                            <input type="hidden" name="price" value="' . $row['gia'] . '">
                        </div>
                        <input type="hidden" name="id" value="' . $row['masanpham'] . '">
    
                        <div class="product-desc">
                            <input type="submit" value="Thêm Giỏ Hàng"  name="order" class="add-cart-btn"></input>
                        </div>
                    </div>
                </div>
            </form>';

        }
    } else {
        echo 'Không có sản phẩm cũng loại!!';
    }

}

function getNewProduct($int)
{
    global $conn;
    $sql = "SELECT * from sanpham order by masanpham asc limit $int";
    $result = pg_query($conn, $sql);
    while ($row = pg_fetch_assoc($result)) {
        echo ' <div class="item">
        <div class="item_img"><img src="./assest/img/thethao/' . $row['hinhanh'] . '" alt=""></div>
        <div class="in4_product">
            <p class="product_name overflow-ellipsis"><a href="?page=product_detail&id=' . $row['masanpham'] . '">' . $row['tensanpham'] . '</a></p>
            <p style="color: red;" class="product_price">' . number_format($row['gia']) . '₫</p>
        </div>
    </div>';
    }
}


function getProductAll($type)
{
    global $conn; // Sử dụng biến kết nối từ phạm vi global
    require ('db.php'); // Đảm bảo rằng tệp db.php đã được đưa vào

    $query = "SELECT * from sanpham where loaisanpham = $type";
    $result = pg_query($conn, $query);

    if (pg_num_rows($result) > 0) { // Kiểm tra số hàng trả về
        while ($row = pg_fetch_assoc($result)) {
            echo '<form action="?page=addtocart" method="POST">

            <div class="product-section">
                    <div class="product-content">
                        <div class="product-img">
                            <img src="./assest/img/thethao/' . $row['hinhanh'] . '" alt="">
                            <input type="hidden" name="img" value="./assest/img/thethao/' . $row['hinhanh'] . '">
                        </div>
                        <div class="product-name">
                            <p><a href="index.php?page=product_detail&id=' . $row['masanpham'] . '">' . $row['tensanpham'] . '</a></p>
                            <input type="hidden" name="tensp" value="' . $row['tensanpham'] . '">
                        </div>
                        <div class="product-price">
                            <p>' . number_format($row['gia']) . '₫</p>
                            <input type="hidden" name="price" value="' . $row['gia'] . '">
                        </div>
                        <input type="hidden" name="id" value="' . $row['masanpham'] . '">

                        <div class="product-desc">
                        <input type="submit" value="Thêm Giỏ Hàng"  name="order" class="add-cart-btn"></input>
                        </div>
                    </div>
                </div>
            </form>';
        }

    } else {
        echo '<h3>Không có sản phẩm</h3>';
    }
}
function getProduct_type($type, $sex)
{
    global $conn;
    require ('db.php');

    $query = "SELECT * FROM sanpham WHERE loai='$type' and gioitinh like '%$sex%' ORDER BY masanpham";
    $result = pg_query($conn, $query);

    if (pg_num_rows($result) > 0) {
        while ($row = pg_fetch_assoc($result)) {
            echo '<form action="?page=addtocart" method="POST">
            <div class="product-section">
                    <div class="product-content">
                        <div class="product-img">
                            <img src="./assest/img/thethao/' . $row['hinhanh'] . '" alt="">
                            <input type="hidden" name="img" value="./assest/img/thethao/' . $row['hinhanh'] . '">
                        </div>
                        <div class="product-name">
                            <p><a href="index.php?page=product_detail&id=' . $row['masanpham'] . '">' . $row['tensanpham'] . '</a></p>
                            <input type="hidden" name="tensp" value="' . $row['tensanpham'] . '">
                        </div>
                        <div class="product-price">
                            <p>' . number_format($row['gia']) . '₫</p>
                            <input type="hidden" name="price" value="' . $row['gia'] . '">
                        </div>
                        <input type="hidden" name="id" value="' . $row['masanpham'] . '">
                        <div class="product-desc">
                        <input type="submit" value="Thêm Giỏ Hàng"  name="order" class="add-cart-btn"></input>
                        </div>
                    </div>
                </div>
            </form>';
        }
    } else {
        echo '<h3>Không có sản phẩm</h3>';
    }
}

function getProduct_type1($type)
{
    global $conn;
    require ('db.php');

    $query = "SELECT * FROM sanpham WHERE loaisanpham='$type' ORDER BY masanpham";
    $result = pg_query($conn, $query);

    if (pg_num_rows($result) > 0) {
        while ($row = pg_fetch_assoc($result)) {
            echo '<form action="?page=addtocart" method="POST">
            <div class="product-section">
                    <div class="product-content">
                        <div class="product-img">
                            <img src="./assest/img/thethao/' . $row['hinhanh'] . '" alt="">
                            <input type="hidden" name="img" value="./assest/img/thethao/' . $row['hinhanh'] . '">
                        </div>
                        <div class="product-name">
                            <p><a href="index.php?page=product_detail&id=' . $row['masanpham'] . '">' . $row['tensanpham'] . '</a></p>
                            <input type="hidden" name="tensp" value="' . $row['tensanpham'] . '">
                        </div>
                        <div class="product-price">
                            <p>' . number_format($row['gia']) . '₫</p>
                            <input type="hidden" name="price" value="' . $row['gia'] . '">
                        </div>
                        <input type="hidden" name="id" value="' . $row['masanpham'] . '">
                        <div class="product-desc">
                        <input type="submit" value="Thêm Giỏ Hàng"  name="order" class="add-cart-btn"></input>
                        </div>
                    </div>
                </div>
            </form>';
        }
    } else {
        echo '<h3>Không có sản phẩm</h3>';
    }
}


function searchProducts($keywords)
{
    global $conn;

    // Thực hiện truy vấn tìm kiếm sản phẩm dựa trên tên
    $query = "SELECT * FROM sanpham WHERE LOWER(tensanpham) LIKE LOWER('%$keywords%')";
    $result = pg_query($conn, $query);

    // Kiểm tra và hiển thị kết quả
    if ($result && pg_num_rows($result) > 0) {
        echo '<div class="product-banner">
            <img src="./assest/img/center/breadcrumb.webp" alt="">
        </div>
        <div class="product-banner-title">
            <div class="sub-banner">
                <p><a href="index.php">Trang Chủ</a></p>
                <p>Tìm kiếm sản phẩm</p>
            </div>
        </div>
        <div class="container-product">';

        while ($row = pg_fetch_assoc($result)) {
            echo '<form action="?page=addtocart" method="POST">
        <div class="product-section">
                <div class="product-content">
                    <div class="product-img">
                        <img src="./assest/img/thethao/' . $row['hinhanh'] . '" alt="">
                        <input type="hidden" name="img" value="./assest/img/thethao/' . $row['hinhanh'] . '">
                    </div>
                    <div class="product-name">
                        <p><a href="index.php?page=product_detail&id=' . $row['masanpham'] . '">' . $row['tensanpham'] . '</a></p>
                        <input type="hidden" name="tensp" value="' . $row['tensanpham'] . '">
                    </div>
                    <div class="product-price">
                        <p>' . number_format($row['gia']) . '₫</p>
                        <input type="hidden" name="price" value="' . $row['gia'] . '">
                    </div>
                    <input type="hidden" name="id" value="' . $row['masanpham'] . '">

                    <div class="product-desc">
                    <input type="submit" value="Thêm Giỏ Hàng"  name="order" class="add-cart-btn"></input>
                    </div>
                </div>
            </div>
        </form>';
        }

        echo '</div>';

    } else {
        echo '<h3>Không tìm thấy sản phẩm</h3>';
    }
}

function get_size_soluong($id)
{
    global $conn;
    $query = "SELECT chitietsanpham.*,size_sanpham.namesize from sanpham JOIN
chitietsanpham ON chitietsanpham.idsanpham = sanpham.masanpham JOIN
size_sanpham ON size_sanpham.idsize = chitietsanpham.idsize
where sanpham.masanpham = $id order by size_sanpham.idsize";
    $result = pg_query($conn, $query);
    return $result;
}
function getDetailProduct($id)
{
    global $conn;
    $query = "SELECT DISTINCT sanpham.*,danhmuc.tendanhmuc, loaisanpham.tenloai 
FROM sanpham 
JOIN chitietsanpham ON chitietsanpham.idsanpham = sanpham.masanpham 
JOIN danhmuc ON danhmuc.iddanhmuc = sanpham.danhmuc 
JOIN loaisanpham ON loaisanpham.idloai = sanpham.loaisanpham
WHERE sanpham.masanpham = $id";
    $result = pg_query($conn, $query);
    $row = pg_fetch_assoc($result);
    return $row;
}
function getIn4User($id)
{
    global $conn;
    $query = "SELECT * from account where id='$id'";
    $result = pg_query($query);
    $user = pg_fetch_assoc($result);
    return $user;


}

?>