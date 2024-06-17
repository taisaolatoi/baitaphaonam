<?php
if (isset($_GET["id"])) {
    $productId = $_GET['id'];
}

?>


<!-- <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .container {
            display: flex;
            width: 1200px;
            margin: 0 auto;
            padding: 40px 0;
        }

        .detail-content {
            padding: 30px;
        }

        .detail-img img {
            width: 468px;
        }

        .product_id {
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .detail-content h1 {
            color: #212121;
            padding-top: 20px;
            padding-bottom: 10px;
            font-size: 20px;
            font-weight: bold;
        }

        .detail-content .special-price {
            padding-top: 10px;
            font-size: 28px;
            display: inline-block;
            color: red;
            font-weight: bold;
        }

        .detail-content .condition-product {
            display: flex;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .detail-content .condition-product .condition {
            color: red;
            padding-left: 5px;
        }

        .detail-content .describe {
            padding-bottom: 20px;
            font-size: 16px;
            line-height: 1.7;
            font-family: Arial, Helvetica, sans-serif;
        }

        .detail-content .btn-pay .btn-decrease,
        .detail-content .btn-pay .btn-increase {
            border-width: 0.5px;
            border: solid 1px #ebebeb;
            width: 30px;
            height: 35px;
        }

        .detail-content .btn-pay .num-product {
            border: solid 1px #ebebeb;
            width: 20px;
            height: 35px;
        }

        .detail-content .btn-pay .buy-product {
            padding: 23px 30px;
            line-height: 0px;
            font-size: 15px;
            border-width: 0.5px;
            border: solid 1px #ebebeb;
            width: 135px;
            height: 36px;
            opacity: 0.8;
            background-color: #e6091e;
            color: white;
            border-radius: 10px;
        }

        .detail-content .btn-pay .buy-product:hover {
            cursor: pointer;
            opacity: 1;
        }

        .detail-content .btn-pay .btn-decrease:hover,
        .detail-content .btn-pay .btn-increase:hover {
            background-color: red;
            color: white;
        }

        .container_mid {
            display: flex;
            width: 1200px;
            margin: 0 auto;
            justify-content: space-between;
        }

        .list_new_product {
            border: 1px solid #ddd;
            padding: 15px 10px;
            padding-bottom: 0;
            position: relative;
            width: 300px;

        }

        .list_new_product img {
            width: 100px;
        }

        .list_new_product .item {
            display: flex;
        }

        .list_new_product .item .in4_product p.product_name {
            padding-bottom: 20px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 100%;
            font-weight: bold;
        }

        .list_new_product .item .in4_product p a {
            font-size: large;
            color: black;
            text-decoration: none;

        }

        .item {
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }

        .list_new_product .product_new_title {
            position: absolute;
            color: red;
            top: -41px;
            padding: 10px 0;
            font-size: large;
            font-weight: bold;
            border-bottom: 2px solid red;
            left: 0;
            cursor: pointer;
        }

        .container-product1 {
            display: flex;
            margin: 0 auto;
            width: 800px;
            gap: 10px;
            position: relative;
            padding-top: 10px;
            border-top: 1px solid #ddd;

        }

        .product-section {
            width: 150px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }

        .product-section .product-content {
            margin: 5px 0;
        }

        .product-section .product-img {
            height: 150px;
            display: flex;
            justify-content: center;
        }

        .product-section .product-img img {
            width: 150px;
            transition: all .3s ease;
            padding: 7px;
            border-radius: 5px;
        }

        .product-section:hover img {
            transform: scale(1.05);
        }

        .product-section .product-name,
        .product-section .product-price,
        .product-section .product-desc {
            margin-left: 10px;
            padding: 10px 0;
        }

        .overflow-ellipsis {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .overflow-ellipsis {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .overflow-ellipsis a {
            display: inline-block;
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .product-section .product-name p {
            font-size: large;
            font-weight: bold;
            height: 50px;
        }

        .product-section .product-name a {
            color: #000;
            text-decoration: none;
            overflow: hidden;
            height: 60px;
            display: block;
            text-overflow: ellipsis;
        }

        .product-section .product-name a:hover {
            color: #de453a;
        }

        .product-section .product-price {
            border-top: 1px solid #ccc;
            margin: 0 10px;
        }

        .product-section .product-price p {
            color: #de453a;
            font-size: large;
        }

        .product-section .product-desc {
            display: flex;
            gap: 15px;
        }

        .product-section .product-desc input {
            width: 90%;
            height: 40px;
            font-weight: 500;
            padding: 5px;
            border: none;
            background: #ccc;
            color: #000;
            border-radius: 5px;
            box-shadow: 3px 3px 0px #000;

        }

        .product-section .product-desc input:hover {
            background-color: #000;
            color: #fff;
            cursor: pointer;
            box-shadow: 3px 3px 0px #ccc;

        }

        .container-product1 .product_related_title {
            position: absolute;
            color: red;
            top: -42px;
            padding: 10px 0;
            font-size: large;
            font-weight: bold;
            border-bottom: 2px solid red;
            left: 0;
            cursor: pointer;
        }

        .sub-banner {
            display: flex;
            width: 1200px;
            height: 40px;
            margin: 0 auto;
            align-items: center;
        }

        .product-banner img {
            width: 100%;
        }

        .product-banner-title a {
            text-decoration: none;
            color: #000;
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
    </style> -->

<?php
$row = getDetailProduct($productId);
$row1 = get_size_soluong($productId);
echo '<form action="?page=addtocart" method="POST" id="form_submit">
       <div class="product-banner">
                <img src="./assest/img/center/breadcrumb.webp" alt="">
            </div>
            <div class="product-banner-title">
                <div class="sub-banner">
                    <p><a href="index.php">Trang Chủ</a></p>
                    <p>' . $row['tensanpham'] . '</p>
                </div>
            </div>';
echo '<div class="container">
        <div class="detail-img">
            <img src="./assest/img/thethao/' . $row['hinhanh'] . '" alt="">
            <input type="hidden" name="img" value="./assest/img/thethao/' . $row['hinhanh'] . '">
        </div>';

echo '<div class="detail-content">
        <h1>' . $row['tensanpham'] . '</h1>
        <input type="hidden" name="tensp" value="' . $row['tensanpham'] . '">
    
        <p class="product_id">Mã sản phẩm: ' . $productId . '</p>
        <input type="hidden" name="id" value="' . $row['masanpham'] . '">
    
        <p class="special-price">' . number_format($row['gia']) . '₫</p>
        <input type="hidden" name="price" value="' . $row['gia'] . '">
    
        <div class="condition-product">
            <p>Tình trạng:</p>
            <p class="condition">Còn hàng</p>
        </div>
        <p class="describe">' . $row['mota'] . '</p>
    
        <div class="sizes">';

while ($size = pg_fetch_assoc($row1)) {
    $disabled = $size['soluong'] == 0 ? 'disabled' : '';
    $color = $size['soluong'] == 0 ? '#ddd' : 'black';
    echo '<label class="size-label" data-soluong="' . $size['soluong'] . '" for="' . $size['namesize'] . '" style="color: ' . $color . '">
                      <input type="radio" id="' . $size['namesize'] . '" name="namesize" value="' . $size['idsize'] . '" ' . $disabled . '>
                      ' . $size['namesize'] . '
                  </label>';
}

echo '</div>
    
        <div class="btn-pay">
            <button  type="button" class="btn-decrease">-</button>
            <input style="text-align: center;" type="text" name="quantity" value="1" min="1" max="99" class="num-product" readonly>
            <button type="button"  class="btn-increase">+</button>
            <input type="submit" value="Mua Ngay" name="order" class="buy-product"></input>
        </div>
    </div>';

echo '</div>
        
    </div>
    </form>';


echo '<div class="container_mid">
        <div class="container-product1">
        <p class="product_related_title">Sản phẩm cùng loại</p>';
getRelatedProduct('' . $row['loaisanpham'] . '', 5);

echo ' </div>

        <div class="list_new_product">
            <p class="product_new_title">Mới ra mắt</p>';

getNewProduct(5);

echo '</div>
        
    </div>';
?>
<script>
    // Lấy các phần tử DOM cần thiết
    const decreaseBtn = document.querySelector('.btn-decrease');
    const increaseBtn = document.querySelector('.btn-increase');
    const quantityInput = document.querySelector('.num-product');

    // Xử lý sự kiện khi nhấp vào nút "-"
    decreaseBtn.addEventListener('click', function () {
        let quantity = parseInt(quantityInput.value);
        if (quantity > 1) {
            quantity--;
        }
        quantityInput.value = quantity;
    });

    // Xử lý sự kiện khi nhấp vào nút "+"
    increaseBtn.addEventListener('click', function () {
        let quantity = parseInt(quantityInput.value);
        quantity++;
        quantityInput.value = quantity;
    });


    // ------------------------------------------------------
    const form = document.getElementById('form_submit');

    form.addEventListener('submit', function (event) {
        const selectedSize = document.querySelector('input[name="namesize"]:checked');
        if (!selectedSize) {
            event.preventDefault(); // Ngăn chặn gửi form nếu người dùng chưa chọn size
            alert('Vui lòng chọn size trước khi mua hàng!');
        }
    });

    // --------------------------------------------------------

    const sizeLabels = document.querySelectorAll('.size-label');

    function checkQuantity() {
        const selectedSize = document.querySelector('input[name="namesize"]:checked');
        const soluong = parseInt(selectedSize.parentNode.dataset.soluong);
        const quantity = parseInt(quantityInput.value);

        if (quantity > soluong) {
            alert('Số lượng sản phẩm chỉ còn ' + soluong);
            quantityInput.value = soluong;
        }
    }
    const btnIncrease = document.querySelector('.btn-increase');
    const btnDecrease = document.querySelector('.btn-decrease');

    btnIncrease.addEventListener('click', checkQuantity);
    btnDecrease.addEventListener('click', checkQuantity);
</script>