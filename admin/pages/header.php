<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<?php
session_start();
ob_start();
if (isset($_GET['logout'])) {
        unset($_SESSION['admin']);
        header('Location: /DoAn_1+/auth/login.php');
}
if (!isset($_SESSION['admin'])) {
        header('Location: /DoAn_1+/auth/login.php');
}
?>
<div class="running-header">
        <h3>Admin-Website</h3>
        <nav id="nav">
                <div id="mobile_menu">
                        <i class="fa-solid fa-bars"></i>
                </div>
                <li><a href="admin.php">
                                <i class=" fa-solid fa-house"></i>
                                Trang Chủ</a>
                </li>
                <!-- <li><a href="">
                <i class="fa-solid fa-bars"></i>
                Danh Mục</a></li> -->
                <li><a href="?page=product">
                                <i class="fa-solid fa-ticket"></i>
                                Sản Phẩm</a></li>
                <li><a href="?page=account">
                                <i class="fa-solid fa-user"></i>
                                Tài Khoản</a></li>
                <li><a href="?page=category">
                                <i class="fa-solid fa-bars"></i>
                                Danh Mục</a></li>

                <li><a href="?page=loaisp">
                                <i class="fa-solid fa-store"></i>
                                Loại Sản Phẩm</a></li>
                <li><a href="?page=order">
                                <i class="fa-solid fa-cart-shopping"></i>
                                Đơn hàng</a></li>
                <div class="out">
                        <span>
                                <?php echo 'Xin Chào   ' . $_SESSION['admin']; ?>
                        </span>
                        <li> <a href="?logout=true">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                        LogOut</a>
                        </li>
                </div>
        </nav>

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