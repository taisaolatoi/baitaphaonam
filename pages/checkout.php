<?php
require ('db.php');
require ('index_funtions.php');
session_start();

if (!isset($_SESSION['client'])) {
    // Chuyển hướng về trang đăng nhập
    header('Location: /DoAn_1+/auth/login.php');
    exit(); // Dừng thực thi mã nguồn hiện tại
}
if (isset($_SESSION['client'])) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    $cartItems = $_SESSION['cart'];

    if (isset($_POST['dathang'])) {
        $id = $_SESSION['user_id'];
        $ngayhientai = date('Y-m-d');
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $tonggia = $_POST['totalPrice'];
        $email = $_POST['email'];
        $typePayment = $_POST['type_payment'];



        $query1 = "INSERT INTO thongtinkh(makhachhang,email,sdt,diachi,hoten) values ('$id','$email','$phone','$address','$fullname')";
        $result1 = pg_query($conn, $query1);
        if (!$result1) {
            echo 'Thất bại1';
            var_dump($_SESSION['user_id']);
        }



        $totalPrice = $_POST['totalPrice'];
        $query = "INSERT INTO donhang(id_thongtinkh,ngaydat,tonggia,pttt,trangthai) VALUES ((SELECT id FROM thongtinkh ORDER BY id DESC LIMIT 1),'$ngayhientai','$tonggia', '$typePayment', 'Chờ xác nhận')";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo 'Thất bại2';
            var_dump($_SESSION['user_id']);
        }
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            foreach ($cart as $item) {
                $sql_insert_detail = "INSERT INTO ctdon (madonhang, masanpham, soluong, idsize) VALUES ((SELECT madonhang FROM donhang ORDER BY madonhang DESC LIMIT 1), 
                (SELECT masanpham FROM sanpham WHERE masanpham='$item[0]'), '$item[4]', '$item[5]')";
                $sqlfinal = pg_query($conn, $sql_insert_detail);

                // Cập nhật số lượng trong bảng chitietsanpham
                $sql_update_chitietsanpham = "UPDATE chitietsanpham SET soluong = soluong - $item[4] WHERE idsanpham = (SELECT masanpham FROM sanpham WHERE masanpham='$item[0]') AND idsize = $item[5]";
                $sqlUpdate = pg_query($conn, $sql_update_chitietsanpham);
            }
            unset($_SESSION['cart']);
        }
        echo '<script>
                alert("Đặt hàng thành công");
                window.location.href = "/DoAn_1+/index.php?page=cart";
            </script>';
        exit(); // Kết thúc thực thi mã PHP
    }
}


?>
<form style="display: flex; flex-direction: column;" method="POST">

    <style>
        .navbar_all {
            width: 400px;
            height: 200px;
            overflow: auto;

        }

        .navbar_all .quantity {
            left: 20%;
            top: 2%;
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

        .navbar_total p {
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }

        .navbar_footer {
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar_footer a {
            text-decoration: none;
            color: #2a9dcc;
        }

        .navbar_footer a:hover {
            color: #2a6395;
        }

        .navbar_footer a i {
            transition: 0.3s ease;
        }

        .navbar_footer a:hover i {
            transform: translateX(-3px);
        }

        .navbar_footer input {
            background-color: #357ebd;
            width: 150px;
            padding: 10px 0;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
        }

        .navbar_footer input:hover {
            background-color: #2f71a9;
        }

        .navbar_title {
            padding: 20px;
        }

        .navbar_cart {
            display: flex;
            padding: 10px;
            gap: 20px;
            position: relative;

        }

        .navbar_cart .name,
        .navbar_cart .price {
            font-size: small;
            opacity: 0.8;
        }

        .navbar_cart img {
            width: 80px;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        html {
            font-family: Arial, Helvetica, sans-serif;
        }

        strong {
            font-size: large;
            font-weight: bold;
        }

        input[type="radio"] {
            transform: scale(1.5);
        }

        input,
        select {
            padding: 10px;
            border: 1px solid #ccc;
            margin-top: 5px;
            margin-bottom: 10px;


        }


        #wrapper {
            display: flex;
            width: 100%;
            margin: 0 auto;
        }

        .main {
            flex: 2;
        }

        .buy_info {
            width: 50%;
            display: flex;
            flex-direction: column;

        }

        .transport_payment {
            width: 50%;
        }

        .navbar {
            flex: 1;
        }

        .main_content {
            display: flex;
            gap: 30px;
            padding: 20px;
        }

        .main_content {
            width: 100%;
        }

        .main_img {
            display: flex;
            justify-content: center;
        }

        .main_img {
            padding: 15px 0;
        }

        .main_img img {
            width: 200px;
            border-radius: 50px;

            box-shadow: rgba(0, 0, 0, 0.15) 2.4px 2.4px 3.2px;
        }

        .payment_all {
            border: 1px solid #cecdcd;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
            line-height: 1.8;
            height: 350px;
        }

        .payment_all p {
            width: max-content;
        }

        .payment_all .header {
            border-bottom: 1px solid #cecdcd;
        }

        .payment_all i {
            color: #1990c6;
        }

        .payment_all .header,
        .footer {
            padding: 10px;
            align-items: center;
            display: flex;
            height: 40px;
            gap: 30px;
            justify-content: space-between;

        }

        .desc {
            padding: 30px;
            opacity: 0.8;
        }

        .navbar {
            background-color: #fafafa;
        }

        @media only screen and (min-width : 741px) and (max-width :1024px) {
            .main {
                width: 800px;

            }

            #wrapper {
                flex-direction: column;
            }

            .navbar_cart img {
                width: 120px;
            }

            .navbar_all {
                width: 100%;
            }

            .navbar_all .quantity {
                left: 15%;
            }
        }

        @media only screen and (max-width : 740px) {
            .main {
                width: 400px;
            }

            #wrapper {
                flex-direction: column;
            }

            .main_content {
                flex-direction: column;
            }

            .buy_info {
                width: 100%;
            }
        }
    </style>



    <div id="wrapper">

        <div class="main">
            <div class="main_img">
                <img src="../assest/img/logo.jpg" alt="">
            </div>
            <div class="main_content">
                <div class="buy_info">
                    <strong>Thông tin mua hàng </strong>
                    <?php
                    $user = getIn4User($_SESSION['user_id']);
                    ?>

                    <label style="margin-top: 20px;" for="email">Email:</label>
                    <input type="email" value="<?php echo $user['email'] ?>" name="email" placeholder="Email" required>

                    <label for="fullname">Họ và tên:</label>
                    <input type="text" value="<?php echo $user['hoten'] ?>" name="fullname" placeholder="Họ và tên"
                        required>

                    <label for="phone">Số điện thoại:</label>
                    <input type="tel" value="<?php echo $user['sdt'] ?>" name="phone" placeholder="Số điện thoại"
                        required>

                    <label for="address">Địa chỉ:</label>
                    <input type="text" id="address" name="address" placeholder="Địa chỉ" required>
                    <!-- 
                        <label for="city">Tỉnh/Thành phố:</label>
                        <select id="city" name="city" required> </select>

                        <label for="district">Quận/Huyện:</label>
                        <select id="district" name="district" required></select>

                        <label for="ward">Phường/Xã:</label>
                        <select id="ward" name="ward" required></select> -->




                </div>

                <div class="payment">
                    <strong>Thanh Toán</strong>
                    <div class="payment_all">
                        <div class="header">
                            <input type="radio" name="type_payment" value="COD">
                            <p>Thanh toán khi giao hàng (COD) </p>
                            <i class="fa-regular fa-money-bill-1"></i>
                        </div>
                        <div class="footer">
                            <input type="radio" name="type_payment" value="Bank">
                            <p>Chuyển khoản qua ngân hàng </p>
                            <i class="fa-regular fa-money-bill-1"></i>

                        </div>
                        <div class="desc">
                            <p>Ngân hàng: VietTinBank</p>
                            <p>Tên tài khoản: DOAN THIEN THU</p>
                            <p>Số tài khoản: 1021354042</p>
                            <p>Chi nhánh: Ô Môn</p>
                        </div>
                    </div>


                </div>
            </div>

        </div>


        <div class="navbar">
            <div class="navbar_title">
                <p>Đơn hàng (
                    <?php echo $_SESSION['totalCount']; ?> )
                </p>
            </div>
            <div class="navbar_all">
                <?php
                if (isset($cartItems) && count($cartItems) > 0) {
                    $totalPricePlus = $_SESSION['$totalPrice'] + 25000;
                    foreach ($cartItems as $item) {

                        echo '
           <div class="navbar_cart">
           <div class="img"><img src=.' . $item[1] . ' alt=""></div>
           <div class="quantity">' . $item[4] . '</div>
           <div class="name">' . $item[2] . '</div>
           <div class="price">' . number_format($item[3]) . '₫</div>
       </div>';

                    }
                    echo '</div> <div class="navbar_total">
                <p>Tạm Tính: <span>' . number_format($_SESSION['$totalPrice']) . '₫</span></p>
                <p>Phí vận chuyển<span>25.000đ</span></p>
                <p>Tổng cộng<span style="color: #1990c6; font-size: x-large;">' . number_format($totalPricePlus) . '₫</span></p>
                <input type="hidden" name="totalPrice" value="' . $totalPricePlus . ' " >
                <div class="navbar_footer">
                    <a href="/DoAn_1+/index.php?page=cart"><i class="fa-solid fa-angle-left"></i> Quay về giỏ hàng</a>
                    <input type="submit" name="dathang" value="ĐẶT HÀNG">
                </div>
            </div>
        </div>';
                }
                ?>
            </div>
</form>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    const host = "https://provinces.open-api.vn/api/";
    var callAPI = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data, "city");
            });
    }
    callAPI('https://provinces.open-api.vn/api/?depth=1');
    var callApiDistrict = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data.districts, "district");
            });
    }
    var callApiWard = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data.wards, "ward");
            });
    }

    var renderData = (array, select) => {
        let row = ' <option disable value="">Chọn</option>';
        array.forEach(element => {
            row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
        });
        document.querySelector("#" + select).innerHTML = row
    }

    $("#city").change(() => {
        callApiDistrict(host + "p/" + $("#city").find(':selected').data('id') + "?depth=2");
        printResult();
    });
    $("#district").change(() => {
        callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2");
        printResult();
    });
    $("#ward").change(() => {
        printResult();
    })
</script>