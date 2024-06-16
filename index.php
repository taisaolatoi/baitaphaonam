<?php require('./pages/index_funtions.php');
require('./pages/db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assest/css/style.css">
    <link rel="stylesheet" href="./assest/css/header.css">
    <link rel="stylesheet" href="./assest/css/product_detail.css">
    <link rel="stylesheet" href="./assest/css/checkorder.css">
    <link rel="stylesheet" href="./assest/css/product.css">
    <link rel="stylesheet" href="./assest/css/footer.css">
    <link rel="stylesheet" href="./assest/css/reponsive.css">
    <script src="https://kit.fontawesome.com/a3c3a500ec.js" crossorigin="anonymous"></script>

    <title>Sport Shop</title>
</head>


<body>

    <div id="main">
        <div id="header">
            <?php
            require('./pages/header.php');
            ?>
        </div>
        <?php
        require('./pages/header-sticky.php');
        ?>
        <div class="main-container">
            <?php
            if (isset($_GET['page'])) {
                $p = $_GET['page'];
                require 'pages/' . $p . '.php';
            } else {
                require 'pages/home.php';
            }
            ?>
        </div>
        <div id="footer">
            <?php
            require('./pages/footer.php');
            ?>
        </div>
    </div>
</body>

</html>