<?php
session_start();
ob_start();
if (isset($_GET['logout'])) {
    unset($_SESSION['client']);
    header('Location: index.php');
} elseif (isset($_GET['login'])) {
    header('Location: /DoAn_1+/auth/login.php');
}
?>

<link rel="stylesheet" href="../assest/css/header.css">
<link rel="stylesheet" href="/assest/font/fontawesome-free-6.4.2-web/css/all.min.css">
<div class="header-top">
    <div class="phone-number">
        <p>HOTLINE: 0347291939</p>
    </div>
    <div class="check-product">
        <div class="check-order">
            <?php
            $query = "SELECT  from";
            echo '<a href="?page=checkorders">Kiểm tra đơn hàng</a>'
                ?>

        </div>
        <?php
        if (isset($_SESSION['client'])) {
            echo '<div class="login">
           
                    <a href=""><span> ' . $_SESSION['client'] . '</span>

             
                </a>
                <a href="?logout=true"><i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </div>';

        } else {
            echo '<div class="login">
                <a href="?login=true">Đăng nhập
                <i class="fa-solid fa-user"></i>
                </a>
            </div>';
        }
        ?>
    </div>
</div>
<div class="header-mid">
    <div class="logo">
        <img src="./assest/img/logo.jpg" alt="">
    </div>
    <div class="search-product">
        <form action="?page=search" method="post">
            <input type="text" name="key_word" placeholder="Tìm kiếm sản phẩm...">
            <span class="search-icon">
                <button type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
            </span>
        </form>
    </div>


    <div class="cart"><a href="?page=cart"><i class="fa-solid fa-cart-shopping"></i></a></div>

</div>
