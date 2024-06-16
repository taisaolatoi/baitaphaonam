<?php
require './pages/search_form.php';
if (isset($_POST['search'])) {
    $keywords = $_POST['key_word'];
    searchProducts($keywords);
}
$productId = $_GET['id']; // ID của sản phẩm A
$query = "SELECT * FROM ctdon WHERE masanpham = '$productId'";
$result = pg_query($conn, $query);
// getListProduct();

if (pg_num_rows($result) > 0) {
    echo "<script>
        alert('Sản phẩm đã có trong đơn hàng không thể xoá');
    </script>";
} else {
    $id = $_GET['id'];
    deleteProduct($id);
    getListProduct();

}

?>
<style>
    textarea {
        border: none;
        width: 100%;
        height: 170px;
        padding: 10px;
    }

    .header_add_search {
        display: flex;
        justify-content: space-between;
        padding: 10px;
    }

    .header_add_search>button>a {
        text-decoration: none;
        color: aqua;
        font-weight: 600;
    }

    .header_add_search>button {
        padding: 10px 20px;

        background-color: black;
    }

    img {
        width: 150px;
        padding: 20px;
    }

    i {
        padding: 5px;
    }
</style>