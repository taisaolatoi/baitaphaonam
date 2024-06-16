<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
require './pages/search_form.php';
?>

<body>
    <?php
    echo getListProduct();
    ?>
</body>
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
        color: #EEEEEE;
        font-weight: 600;
    }

    .header_add_search>button {
        padding: 10px 20px;
        background-color: #888888;
    }

    th,
    td {
        border: 1px solid black;
    }

    th {
        height: 40px;
        text-align: center;
    }

    img {
        width: 150px;
        padding: 20px;
    }

    i {
        padding: 5px;
    }
</style>

</html>