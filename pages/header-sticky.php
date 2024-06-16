<?php
ob_start();
?>
<div class="header-bot">
    <ul id="nav" class="nav">
        <li><a href="index.php">TRANG CHỦ</a></li>
        <li><a href="index.php?page=product_type&type=Đồ Thể Thao Nam">ĐỒ THỂ THAO NAM
                <i class="fa-solid fa-caret-down"></i>
            </a>
            <ul class="subnav">
                <li><a href="index.php?page=product_type&type=Áo Thể Thao Nam">Áo thể thao nam</a></li>
                <li><a href="index.php?page=product_type&type=Quần Thể Thao Nam">Quần thể thao nam</a></li>
            </ul>
        </li>
        <li><a href="index.php?page=product_type&type=Đồ Thể Thao Nữ">ĐỒ THỂ THAO NỮ
                <i class="fa-solid fa-caret-down"></i>
            </a>
            <ul class="subnav">
                <li><a href="index.php?page=product_type&type=Áo Thể Thao Nữ">Áo thể thao nữ</a></li>
                <li><a href="index.php?page=product_type&type=Quần Thể Thao Nữ">Quần thể thao nữ</a></li>
            </ul>
        </li>
        <li><a href="index.php?page=product_type&type=Phụ Kiện">PHỤ KIỆN THỂ THAO</a>

        </li>

    </ul>
    <div id="mobile_menu" class="mobile_menu_btn">
        <i class="fa-solid fa-bars"></i>
    </div>

</div>
<script>
    var header =document.getElementById('nav');
    var mobileMenu =document.getElementById('mobile_menu');
    var headerHeight = header.clientHeight;

    mobileMenu.onclick =function(){
        var isClosed = header.clientHeight === headerHeight;
        if (isClosed){
            header.style.height= 'auto';
        }else{
            header.style.height= null;
        }
    }
    
</script>