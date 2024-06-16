<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem có nhận được 'add' hay 'update' từ biểu mẫu không
    if (isset($_POST['add'])) {
        // Lấy dữ liệu từ biểu mẫu thêm danh mục
        $category_name = $_POST["category_name"];


        $query = "SELECT tendanhmuc FROM danhmuc WHERE tendanhmuc = '$category_name'";
        $result = pg_query($conn, $query);
        $categoryExists = pg_num_rows($result) > 0;

        if (!$categoryExists) {
            // Thêm mới danh mục nếu không tồn tại
            $insertQuery = "INSERT INTO danhmuc(tendanhmuc) VALUES ('$category_name')";
            $insertResult = pg_query($conn, $insertQuery);

            if ($insertResult) {
                echo "<script>alert('Thêm danh mục thành công!');</script>";
                header("Location:?page=category");
                exit;
            } else {
                echo 'Thêm danh mục không thành công!';
            }
        } else {
            echo '<script>alert("Têm danh mục đã tồn tại."); window.location.href="?page=category";</script>';

        }

    } elseif (isset($_POST['update'])) {

        $category_name_up = $_POST["detail_category_name"];
        $category_id = $_POST["detail_category_id"];

        $query = "SELECT tendanhmuc FROM danhmuc WHERE tendanhmuc = '$category_name_up'";
        $result = pg_query($conn, $query);
        $categoryExists = pg_num_rows($result) > 0;


        if (!$categoryExists) {
            $sql = "SELECT tendanhmuc from danhmuc";
            $updateQuery = "UPDATE danhmuc SET tendanhmuc='$category_name_up' WHERE iddanhmuc='$category_id'";
            $updateResult = pg_query($conn, $updateQuery);

            if ($updateResult) {
                echo "<script>alert('Cập nhật danh mục thành công!');</script>";
                header("Location:?page=category");
                exit;
            } else {
                echo 'Cập nhật danh mục không thành công!';
            }
        } else {
            echo '<script>alert("Têm danh mục đã tồn tại."); window.location.href="?page=category";</script>';

        }

    }

    ob_end_flush();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Quản lý danh mục</title>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 55px;
            border: 1px solid #888;
            width: 600px;
            border-radius: 20px;
        }

        .close {
            color: #888;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .container_dm {
            margin: 0 auto;
            width: 800px;
        }

        .container_dm h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container_dm a {
            color: #000;
        }

        .container_dm a:hover i {
            color: red;
        }

        .container_dm table {
            border-collapse: collapse;
            width: 100%;
        }

        .container_dm th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        #add_category_form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 500px;
        }

        .btn_add {
            display: inline-block;
            background-color: #f1f1f1;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn_add a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .btn_add:hover {
            background-color: #ccc;
        }

        .btn_add a:hover {
            color: #fff;
        }


        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 55px;
            border-radius: 20px;
            animation: modal-show 0.3s ease-in-out;
        }

        @keyframes modal-show {
            0% {
                transform: scale(0.7);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .close-category {
            color: #888;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-category:hover,
        .close-category:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .container_dm {
            margin: 0 auto;
            width: 800px;
        }

        .container_dm h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container_dm a {
            color: #000;
        }

        .container_dm a:hover i {
            color: red;
        }

        .container_dm table {
            border-collapse: collapse;
            width: 100%;
        }

        .container_dm th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        #add-category-modal .modal-content,
        #detail-category-modal .modal-content {
            background-color: #f1f1f1;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        #add-category-modal h2,
        #detail-category-modal h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        #add-category-modal form,
        #detail-category-modal form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 500px;
        }

        #add-category-modal label,
        #detail-category-modal label {
            color: #333;
        }

        #add-category-modal input,
        #add-category-modal textarea,
        #detail-category-modal input,
        #detail-category-modal textarea {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        #add-category-modal button,
        #detail-category-modal button {
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #add-category-modal button:hover,
        #detail-category-modal button:hover {
            background-color: #555;
        }

        #add-category-modal button:focus,
        #detail-category-modal button:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <div class="btn_add">
        <a href="#" id="add_category">Thêm danh mục</a>
    </div>
    <div class="container_dm">
        <h1 class="text-center my-4">SẢN PHẨM</h1>
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr style="background: #ccc">
                    <th>Mã Danh Mục</th>
                    <th>Danh Mục</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <?php
            $query = "SELECT * FROM danhmuc order by iddanhmuc asc";
            $result = pg_query($conn, $query);
            while ($row = pg_fetch_assoc($result)) {
                echo "<tr>";
                echo '<td>DM' . $row['iddanhmuc'] . '</td>'; // Mã Danh Mục
                echo "<td>" . $row['tendanhmuc'] . "</td>"; // Danh Mục
                echo "<td>
                <a href='?page=deldanhmuc&id=" . $row['iddanhmuc'] . "'><i class='fa-solid fa-trash'></i></a>
                <a href='#' class='detail_category' data-id='" . $row['iddanhmuc'] . "'><i class='fa-solid fa-gear'></i></a>
                </td>"; // Edit
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div id="add-category-modal" class="modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm danh mục</h5>
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" id="add_category_form">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Tên danh mục:</label>
                            <input type="text" class="form-control" id="category_name" name="category_name">
                        </div>

                        <button type="submit" class="btn btn-primary" name="add">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="detail-category-modal" class="modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thông tin danh mục</h5>
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="detail_category_name" class="form-label">Tên danh mục:</label>
                            <input type="text" class="form-control" id="detail_category_name"
                                name="detail_category_name">
                        </div>

                        <input type="hidden" id="detail_category_id" name="detail_category_id">
                        <button type="submit" class="btn btn-primary" name="update">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var addCategoryModal = document.getElementById("add-category-modal");
        var btnAdd = document.getElementById("add_category");
        var closeBtnAddCategory = document.querySelector("#add-category-modal .close");

        btnAdd.addEventListener("click", function () {
            addCategoryModal.style.display = "block";
        });

        closeBtnAddCategory.addEventListener("click", function () {
            addCategoryModal.style.display = "none";
        });

        window.addEventListener("click", function (event) {
            if (event.target == addCategoryModal) {
                addCategoryModal.style.display = "none";
            }
        });

        // -------------------------------------------------------------------------

        var detailCategoryModal = document.getElementById("detail-category-modal");
        var btnDetail = document.getElementsByClassName("detail_category");
        var closeBtnDetailCategory = document.querySelector("#detail-category-modal .close");

        Array.from(btnDetail).forEach(function (btn) {
            btn.addEventListener("click", function (event) {
                event.preventDefault();
                var categoryId = this.getAttribute("data-id");
                var categoryRow = this.parentNode.parentNode;
                var categoryName = categoryRow.cells[1].innerText;
                // var categoryNote = categoryRow.cells[2].innerText;

                document.getElementById("detail_category_id").value = categoryId;
                document.getElementById("detail_category_name").value = categoryName;
                // document.getElementById("detail_category_note").value = categoryNote;

                detailCategoryModal.style.display = "block";
            });
        });

        closeBtnDetailCategory.addEventListener("click", function () {
            detailCategoryModal.style.display = "none";
        });

        window.addEventListener("click", function (event) {
            if (event.target == detailCategoryModal) {
                detailCategoryModal.style.display = "none";
            }
        });
    </script>

</body>

</html>