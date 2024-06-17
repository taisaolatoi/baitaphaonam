<?php
// include './func_admin.php';
if (isset($_POST['add_product']) && $_POST['add_product']) {
    $name = $_POST['product_name'];
    $type = $_POST['product_type'];
    $category = $_POST['product_category'];
    $price = $_POST['product_price'];
    $desc = $_POST['product_description'];
    $img = $_FILES['product_img']['name'];
    $quantity = 0;
    move_uploaded_file($_FILES['product_img']['tmp_name'], "../assest/img/thethao/" . $_FILES['product_img']['name']);
    $gender = $_POST['gender'];

    // Thêm sản phẩm vào bảng 'sanpham'
    $query = "INSERT INTO sanpham(tensanpham, loaisanpham, gia, mota, hinhanh, gioitinh,danhmuc) VALUES ('$name', '$type', '$price', '$desc', '$img', '$gender','$category')";
    $result = pg_query($conn, $query);

    // Lấy ID của sản phẩm vừa thêm
    $lastInsertedId = "SELECT masanpham FROM sanpham ORDER BY masanpham DESC LIMIT 1";
    $result0 = pg_query($conn, $lastInsertedId);
    $row = pg_fetch_assoc($result0);
    $masanpham = $row['masanpham'];


    $sqlcategory = "SELECT * from danhmuc where iddanhmuc = $category";
    $resultcategory = pg_query($conn, $sqlcategory);
    $rowcategory = pg_fetch_assoc($resultcategory);
    $category_name = $rowcategory['tendanhmuc'];

    if ($category_name == "Áo" || $category_name == "Quần") {
        $sql = "SELECT * FROM size_sanpham where idsize between 1 and 5";
    } elseif ($category_name == "Giày" || $category_name == "Dép") {
        $sql = "SELECT * FROM size_sanpham where idsize between 6 and 11";
    } else {
        $sql = "SELECT * FROM size_sanpham where idsize = 0";
    }

    if ($category_name != "") {
        $result1 = pg_query($conn, $sql);
        while ($row = pg_fetch_assoc($result1)) {
            $sizeId = $row['idsize'];
            $queryChiTiet = "INSERT INTO chitietsanpham(idsanpham, idsize, soluong) VALUES ('$masanpham', '$sizeId', '0')";
            pg_query($conn, $queryChiTiet);

        }
        echo '<h3 style="color: red; padding: 30px; text-align: center;">Thêm SP thành công!!</h3>';
    }
}
?>

<html lang="en">

<head>
    <title>Your Title Here</title>
    <!-- Add your CSS styles or meta tags here -->

</head>

<body>

    <script>
        function updateTypeId() {
            selectedCategoryValue = document.getElementById("product_category").value;
            updateProductTypes();
        }

        function updateProductTypes() {
            var productTypeSelect = document.getElementById("product_type");
            productTypeSelect.innerHTML = ""; // Xóa tất cả option hiện có

            var id = selectedCategoryValue;

            // Gửi yêu cầu AJAX để lấy dữ liệu loại sản phẩm từ máy chủ
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    if (response.length > 0) {
                        response.forEach(function (item) {
                            var option = document.createElement("option");
                            option.value = item.idloai;
                            option.text = item.tenloai;
                            productTypeSelect.appendChild(option);
                        });
                    } else {
                        var option = document.createElement("option");
                        option.text = "Không có loại sản phẩm tương ứng";
                        productTypeSelect.appendChild(option);
                    }
                }
            };

            var url = "http://localhost/DoAn_1+/admin/pages/getproduct_type.php?id=" + id;

            xhr.open("GET", url, true);
            xhr.send();
        }
    </script>

    <form action="" method="POST" enctype="multipart/form-data">
        <h2>Thêm Sản Phẩm</h2>
        <div class="form-row">
            <label for="product_name">Tên sản phẩm:</label>
            <input type="text" name="product_name" required>
        </div>

        <div class="form-row">
            <label for="product_category">Danh Mục:</label>
            <select name="product_category" id="product_category" onchange="updateTypeId()">
                <?php
                $listCategory = getCategory($conn);
                while ($row = pg_fetch_assoc($listCategory)) {
                    echo '<option value="' . $row['iddanhmuc'] . '">' . $row['tendanhmuc'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-row">
            <label for="product_type">Loại:</label>
            <select name="product_type" id="product_type">
                <!-- Option loại sản phẩm sẽ được thêm sau khi chọn danh mục -->
            </select>
        </div>

        <div class="form-row">
            <label for="product_price">Giá sản phẩm:</label>
            <input type="number" name="product_price" min="0" required>
        </div>

        <div class="form-row">
            <label for="product_description">Mô tả sản phẩm:</label>
            <textarea name="product_description" required></textarea>
        </div>

        <div class="form-row">
            <label for="product_img">Hình ảnh sản phẩm:</label>
            <input type="file" name="product_img" accept="image/*" required>
        </div>

        <div class="form-row">
            <label>Giới tính:</label>
            <div class="input_sex">
                <input type="radio" id="gender_male" name="gender" value="Nam" required>
                <label for="gender_male">Nam</label>
                <input type="radio" id="gender_female" name="gender" value="Nữ" required>
                <label for="gender_female">Nữ</label>
                <input type="radio" id="gender_female" name="gender" value="Nam và Nữ" required>
                <label for="gender_female">Nam và Nữ</label>
            </div>
        </div>

        <div class="form-rowsub">
            <input type="submit" value="Thêm sản phẩm" name="add_product">
        </div>
    </form>

</body>

</html>




<style>
    form {
        width: 700px;
        height: max-content;
        margin: 20px auto;
        background-color: #E8E8E8;
        border: 1px solid #000;
        border-radius: 20px;
    }

    form h2 {
        display: flex;
        justify-content: center;
        padding: 10px;
    }

    .form-row {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .form-row label {
        padding-left: 20px;
        width: 150px;
    }

    .form-row input[type="text"],
    .form-row input[type="number"],
    .form-row textarea,
    .form-row select {
        flex: 1;
        padding: 5px 5px;
        margin-right: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-row textarea {
        height: 100px;
    }


    .form-row .input_sex label {
        margin-right: 10px;
    }

    .form-rowsub {
        padding-bottom: 15px;
        display: flex;
        justify-content: center;
    }

    .form-rowsub input[type="submit"] {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .form-rowsub input[type="submit"]:hover {
        background-color: #008B45;
    }

    @media only screen and (max-width : 740px) {
        form {
            width: 400px;
        }
    }
</style>