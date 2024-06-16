<?php
require './pages/search_form.php';
if (isset($_POST['search']) && $_POST['key_word'] != '') {
    $keywords = $_POST['key_word'];
    searchProducts($keywords);
} else {
    getListProduct();
}
?>

<style>
    .header_add_search {
        display: flex;
        justify-content: space-between;
        padding: 10px;
    }

    .header_add_search>button>a {
        text-decoration: none;
        color: #EEEEEE;
        font-weight: 600;
    }

    .header_add_search>button {
        padding: 10px 20px;
        background-color: #888888;
    }

    th {
        height: 40px;
    }

    h1 {
        width: 500px;
        margin: 0 auto;
        text-align: center;
        padding: 20px;
        color: red
    }

    img {
        width: 150px;
        padding: 20px;
    }

    i {
        padding: 5px;
    }


</style>