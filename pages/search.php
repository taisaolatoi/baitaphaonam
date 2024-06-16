<?php 
if(isset($_POST["search"]) && $_POST["key_word"] != ""){
    $keywords = $_POST['key_word'];
    searchProducts($keywords);
} else {
    header('Location: index.php');
    exit();
}
?>
<style>
    .container-product {
    flex-wrap: wrap;
}
h3{
    text-align: center;
    padding: 30px;
    color: red;
    font-family: system-ui;
}
.page_btn {
    padding: 20px 0;
    margin-right: 14%;
    text-align: center;
}

.product-sub-sex {
    width: 100%;
    background-color: #f8f8f8;
}

.product-banner-title a {
    text-decoration: none;
    color: #000;
}

.product-banner img {
    width: 100%;
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
</style>