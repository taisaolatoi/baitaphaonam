<?php

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$cartItems = $_SESSION['cart'];
$totalCount = 0;
if (!empty($cartItems)) {
    foreach ($cartItems as $item) {
        $totalCount += $item[4]; 
        $_SESSION['totalCount'] = $totalCount;
    }
}


?>

    <div class="product_banner_title">
        <div class="sub-banner">
            <p><a href="index.php">Trang Chủ</a></p>
            <p>Giỏ Hàng</p>
        </div>
        <div class="cart_title">
            <p>GIỎ HÀNG(
                <span>
                    <?php echo $totalCount; ?>
                    Sản phẩm
                </span>)
            </p>
        </div>
    </div>
    <?php

    if (isset($_SESSION['cart']) && count($cartItems) > 0) {
        echo '<form action="pages/checkout.php" method="POST">
    <div id="container1">
    <div class="container_all">';
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            echo '<div class="container_product">
            <div class="cart_product">
                <img src="' . $item[1] . '" alt="">
                <p class="product_name">' . $item[2] . '<a href="?page=delete_cart&id=' . $item[0] . '">Xoá</a></p>
                <p class="product_price">' . number_format($item[3]) . '₫</p>
            </div>
            <div class="input_group_btn">
                
                <input data-product-id="' . $item[0] . '" class="quantity-input" type="text" min="1" maxlength="3" name="quantity[]" value="' . $item[4] . '">
                
            </div>
        </div>';

            $totalPrice += $item[3] * $item[4];  // Cập nhật tổng giá
        }
        // $_SESSION['$totalCount'] = $totalCount;
        $_SESSION['$totalPrice'] = $totalPrice;



        echo '</div>
    <div class="cart_submit">
        <div class="total">
            <div class="pay">
                <div class="total-price"><p>Thành tiền:</p> <span>' . number_format($totalPrice) . '₫</span></div>
            </div>
            <div class="buy_btn">
                <input type="submit" name="buybtn" value="THANH TOÁN NGAY">
                <a href="index.php"><input type="button" value="TIẾP TỤC MUA HÀNG"></a>
            </div>
        </div>
    </div>
</div>
</form>';
    } else {
        echo '<div class="cart_empty">
    <img src="./assest/img/empty-cart.jpg" alt="">
    <a href="index.php"><input type="button" value="TIẾP TỤC LỰA CHỌN"></a>
    </div>';
    }
    ?>



<script>
    // Lấy danh sách tất cả các nút cộng/trừ số lượng trong giỏ hàng
    const decrementButtons = document.querySelectorAll(".decrement-btn");
    const incrementButtons = document.querySelectorAll(".increment-btn");
    const quantityInputs = document.querySelectorAll(".quantity-input");

    // Gắn sự kiện cho từng nút cộng/trừ số lượng
    decrementButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            let quantityInput = this.nextElementSibling;
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantity--;
                quantityInput.value = quantity;
                updateQuantity(quantityInput.dataset.productId, quantity);
            }
        });
    });

    incrementButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            let quantityInput = this.previousElementSibling;
            let quantity = parseInt(quantityInput.value);
            quantity++;
            quantityInput.value = quantity;
            updateQuantity(quantityInput.dataset.productId, quantity);
        });
    });

    function updateQuantity(productId, quantity) {
        // Lặp qua mảng cartItems để tìm sản phẩm cần cập nhật
        for (let i = 0; i < cartItems.length; i++) {
            if (cartItems[i][0] === productId) {
                cartItems[i][4] = quantity; // Cập nhật số lượng
                break;
            }
        }
        // Lưu mảng cartItems vào session storage
        sessionStorage.setItem("cart", JSON.stringify(cartItems));
    }
</script>

<!-- <style>
    html {
        font-family: 'Roboto', Helvetica, Arial, sans-serif;
    }

    .cart_empty {
        display: flex;
        flex-direction: column;
        width: 200px;
        gap: 20px;
        margin: 0 auto;
    }


    .product_banner_title {
        width: 1200px;
        margin: 0 auto
    }

    .container_all {
        display: flex;
        flex-direction: column;
        flex: 2;
        gap: 20px;
    }

    .cart_product {
        display: flex;
        justify-content: space-between;
        gap: 15px;
    }

    .product_name {
        flex: 2;
        display: flex;
        flex-direction: column;
        font-weight: bold;
        font-size: large;

    }

    .product_name a {
        text-decoration: none;
        color: #e6091e;
    }

    .product_name a:hover {
        text-decoration: underline;
    }

    .cart_submit {
        display: flex;
        justify-content: center;
        width: 400px;
    }

    .buy_btn {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .pay {
        display: flex;
        align-items: center;
        justify-content: space-around;
        margin-bottom: 20px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 15px;
    }

    .pay p {
        font-weight: bold;
        font-size: large;
    }

    .product_price {
        width: 200px;
        color: #e6091e;
        font-size: large;
    }


    .input_group_btn {
        height: max-content;
    }

    .input_group_btn input,
    .input_group_btn button {
        padding: 5px;
    }

    .quantity-input {
        text-align: center;
        width: 30px;
    }

    .cart_submit input,
    .cart_empty input {
        padding: 10px 40px;
        border: none;
        border-radius: 5px;
        background-color: #e6091e;
        color: #fff;
        opacity: 0.8;
        width: 100%;
    }

    .cart_submit input:hover,
    .cart_empty input:hover {
        opacity: 1;
        cursor: pointer;
    }

    .cart_submit a input {
        background-color: #e6091e;
        color: #fff;
        border: 1px solid #e6091e;
    }

    img {
        width: 200px;
    }

    #container {
        width: 1200px;
        margin: 0 auto;
        display: flex;
    }

    .sub-banner {
        display: flex;
        width: 1200px;
        height: 40px;
        margin: 0 auto;
        align-items: center;
    }

    .sub-banner p {
        line-height: 40px;
    }

    .sub-banner a:hover {
        color: red;
    }

    .sub-banner a {
        text-decoration: none;
        color: black;
        opacity: 0.8;
    }


    .sub-banner p:last-child {
        color: red;

    }

    .sub-banner p::after {
        content: ">";
        padding: 0 10px;

    }

    .cart_title {
        padding: 30px 0;
    }

    .sub-banner p:last-child::after {
        display: none;
    }

    .container_product {
        display: flex;
        border-bottom: 1px solid #ddd;
        padding-bottom: 15px;
    }

    .cart_product {
        flex: 2;
    }

    .total-price {
        display: flex;
        gap: 30px;
        align-items: center;
    }

    .total-price span {
        color: red;
        font-size: x-large;
        font-weight: bold;
    }

    .total {
        width: 300px;
    }
</style> -->