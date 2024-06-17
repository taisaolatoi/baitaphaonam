<?php
include ("../pages/db.php");
include './func_admin.php';
?>
<!DOCTYPE html>
<html lang="en">

<link>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://kit.fontawesome.com/a3c3a500ec.js" crossorigin="anonymous"></script>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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

    th {
        text-align: center;
    }
</style>

</html>