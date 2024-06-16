<?php
// session_start();
ob_start();

if (isset($_POST["order"]) && $_POST["order"]) {
    $img = $_POST['img'];
    $tensp = $_POST['tensp'];
    $gia = $_POST['price'];
    $id = $_POST['id'];
    $sl = 1;
    $i = 0;
    $fg=0;

    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $sp) {
            if ($sp[0] == $id) {
                // Cập nhật số lượng
                $sl += $sp[4];
                $fg=1;
                // Cập nhật vào giỏ hàng
                $_SESSION['cart'][$i][4]=$sl;
                break;
            }
            $i++;
        }
        
    }

    if($fg==0){
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }
        $sp = array($id, $img, $tensp, $gia, $sl);
        array_push($_SESSION['cart'], $sp);
    }
    header('location: ?page=cart');
    ob_end_flush();
}
?>