<?php
include ("../pages/db.php");
include './func_admin.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a3c3a500ec.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style_admin.css">
    <link rel="stylesheet" href="reponsive.css">
    <title>Document</title>
</head>


<body>

    <header>
        <?php require './pages/header.php'; ?>
    </header>
    <section>
        <?php
        if (isset($_GET['page'])) {
            $p = $_GET['page'];
            require './pages/' . $p . '.php';

        } else {
            require './pages/home.php';
        }
        ?>
    </section>
    <footer>
        <?php require './pages/footer.php'; ?>

    </footer>
</body>
<style>
    th,
    td {
        border: 1px solid #000;
    }
    th{
        text-align: center;
    }
</style>

</html>