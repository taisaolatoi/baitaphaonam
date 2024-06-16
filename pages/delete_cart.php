<?php
    // Kiểm tra xem id của sản phẩm cần xóa có được truyền vào hay không
    if(isset($_GET['id'])) {
        $productId = $_GET['id'];

        // Kiểm tra xem giỏ hàng có tồn tại không
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            // Duyệt qua từng sản phẩm trong giỏ hàng
            foreach($_SESSION['cart'] as $key => $item) {
                if($item[0] == $productId) {
                    // Xóa sản phẩm khỏi giỏ hàng
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
        }
    }
    // Chuyển hướng người dùng trở lại trang giỏ hàng
    header('location: ?page=cart');
?>