<?php
// session_start();
ob_start();

if (isset($_POST["order"]) && $_POST["order"]) {
    $img = $_POST['img'];
    $tensp = $_POST['tensp'];
    $gia = $_POST['price'];
    $id = $_POST['id'];
    $sl = $_POST['quantity'];
    $size = $_POST['namesize'];

    $found = false;

    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as &$sp) {
            if ($sp[0] == $id && $sp[5] == $size) {
                // Cập nhật số lượng nếu sản phẩm đã tồn tại với cùng ID và cùng size
                $sp[4] += $sl;
                $found = true;
                break;
            }
        }
    }

    if (!$found) {
        $newSp = array($id, $img, $tensp, $gia, $sl, $size);
        $_SESSION['cart'][] = $newSp;
    }

    header('location: ?page=cart');
    ob_end_flush();
}
?>