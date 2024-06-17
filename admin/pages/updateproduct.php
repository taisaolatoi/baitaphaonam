<?php
if (isset($_GET["id"])) {
    $id = $_GET['id'];

    $_SESSION['masanpham'] = $id;

    echo '<script>';
    echo 'var masanpham = "' . $_SESSION['masanpham'] . '";';
    echo '</script>';

    $product = getOneProduct($id);
    $iddanhmuc = $product['danhmuc'];


    if (isset($_POST['update_product'])) {
        $name = $_POST['product_name'];
        $type = $_POST['product_type'];
        $category = $_POST['product_category'];
        $price = $_POST['product_price'];
        $desc = $_POST['product_description'];
        $img = $product['hinhanh']; // Giữ nguyên giá trị hình ảnh nếu không có tệp tin mới
        $gender = $_POST['gender'];

        if (isset($_FILES['product_img']['tmp_name']) && $_FILES['product_img']['tmp_name'] !== '') {
            move_uploaded_file($_FILES['product_img']['tmp_name'], "../assest/img/thethao/" . $_FILES['product_img']['name']);
            $img = $_FILES['product_img']['name'];
        }



        $query = "UPDATE sanpham SET tensanpham='$name', loaisanpham='$type',danhmuc = $category,gioitinh = '$gender', gia='$price', mota='$desc', hinhanh='$img' WHERE masanpham='$id'";
        $result = _query($query);
        if ($result) {
            echo "Sửa thành công!!";
            header("location: ?page=product");
        }
    }
}

?>

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        var productTypeSelect = document.getElementById("product_type");
        var tenloaiDefault = "<?php echo $product['tenloai']; ?>";

        // Lặp qua các tùy chọn để thiết lập tùy chọn mặc định
        var options = productTypeSelect.options;
        for (var i = 0; i < options.length; i++) {
            if (options[i].text === tenloaiDefault) {
                options[i].selected = true;
                break;
            }
        }

        // Gọi hàm updateProductTypes để cập nhật loại sản phẩm
        var selectedCategoryValue = document.getElementById("product_category").value;
        updateProductTypes(selectedCategoryValue);
    });

    function updateTypeId() {
        var selectedCategoryValue = document.getElementById("product_category").value;
        updateProductTypes(selectedCategoryValue);
    }

    function updateProductTypes(selectedCategoryValue) {
        var productTypeSelect = document.getElementById("product_type");
        productTypeSelect.innerHTML = ""; // Xóa tất cả các tùy chọn hiện có

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

        var masanpham = "<?php echo $_SESSION['masanpham']; ?>";
        var url = "http://localhost/DoAn_1+/admin/pages/getproduct_type.php?id=" + id + "&masanpham=" + masanpham;

        xhr.open("GET", url, true);
        xhr.send();
    }
</script>

<form class="update-form" action="" method="POST" enctype="multipart/form-data">
    <h2>Sửa Sản Phẩm</h2>
    <div class="form-row">
        <label for="product_name">Tên sản phẩm:</label>
        <input type="text" name="product_name" value="<?php echo $product['tensanpham']; ?>" required>
    </div>

    <div class="form-row">
        <label for="product_category">Danh Mục:</label>
        <?php

        echo '<select name="product_category" id="product_category" onchange="updateTypeId()">';
        $listCategory = getCategory($conn);
        $defaultCategory = getCategoryDetail($conn, $iddanhmuc);
        // Hiển thị danh mục từ cơ sở dữ liệu
        $row1 = pg_fetch_assoc($defaultCategory);
        while ($row = pg_fetch_assoc($listCategory)) {
            $selected = ($row['iddanhmuc'] == $row1['iddanhmuc']) ? 'selected' : '';
            echo '<option value="' . $row['iddanhmuc'] . '" ' . $selected . '>' . $row['tendanhmuc'] . '</option>';
        }

        ?>
        </select>
    </div>

    <div class="form-row">
        <label for="product_type">Loại:</label>
        <select name="product_type" id="product_type">

        </select>
    </div>


    <div class="form-row">
        <label for="product_price">Giá sản phẩm:</label>
        <input type="number" name="product_price" min="0" value="<?php echo $product['gia']; ?>" required>
    </div>

    <div class="form-row">
        <label for="product_description">Mô tả sản phẩm:</label>
        <textarea name="product_description" required><?php echo $product['mota']; ?></textarea>
    </div>

    <div class="form-row">
        <label>Giới tính:</label>
        <div class="input_sex">
            <input type="radio" id="gender_male" name="gender" value="Nam" <?php if ($product['gioitinh'] === 'Nam')
                echo 'checked'; ?> required>
            <label for="gender_male">Nam</label>
            <input type="radio" id="gender_female" name="gender" value="Nữ" <?php if ($product['gioitinh'] === 'Nữ')
                echo 'checked'; ?> required>
            <label for="gender_female">Nữ</label>
        </div>
    </div>

    <div class="form-row">
        <label for="product_img">Hình ảnh sản phẩm:</label>
        <input type="file" name="product_img" accept="image/*">
        <img class="anhsp" src="../assest/img/thethao/<?php echo $product['hinhanh']; ?>" alt="Hình ảnh sản phẩm">
    </div>


    <div class="form-rowsub">
        <input type="submit" value="Sửa sản phẩm" name="update_product">
    </div>

</form>


<style>
    form {
        background-color: #E8E8E8;
        border: 1px solid #000;
        width: 700px;
        margin: 70px auto;
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
        padding-left: 10px;
        width: 150px;
    }

    .form-row input[type="text"],
    .form-row input[type="number"],
    .form-row textarea,
    .form-row select {
        margin-right: 10px;
        flex: 1;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-row textarea {
        height: 100px;
    }

    .form-row .input_sex {
        display: flex;
        align-items: center;
    }

    .form-row .input_sex label {
        margin-right: 10px;
    }

    .form-rowsub {
        display: flex;
        justify-content: center;
        padding: 20px 10px;
    }

    .form-rowsub input[type="submit"] {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    img {
        width: 200px;
    }

    .form-row input[type="submit"]:hover {
        background-color: #45a049;
    }

    @media only screen and (max-width : 740px) {
        form {
            width: 400px;
        }

        img {
            width: 130px;
            padding: 15px;
        }
    }

</style>