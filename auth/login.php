<?php
session_start();
ob_start();
include '../admin/func_admin.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Đăng Nhập</title>
</head>

<body>
    <div class="main">
        <div class="form-container">
            <form action="<?php  echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <?php
                if (isset($_POST['login']) && $_POST['login']) {
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                    $checkPas = check_user($user, $pass);
                    if ($checkPas['result'] == 1) {
                        $_SESSION['admin'] = $checkPas['hoten'];
                        
                        header('Location: ../admin/admin.php');
                    } else if ($checkPas['result'] == 0) {
                        $_SESSION['client'] = $checkPas['hoten'];
                        $_SESSION['user_id']= $checkPas['id'];
                        header('Location: ../index.php');
                    } else{
                        echo 'Sai thông tin đăng nhập!!!';
                    }

                }
                ?>
                <h2>Đăng Nhập</h2>
                <div class="">
                    <label for="user">Tài Khoản</label>
                    <input type="text" name="user" required>
                </div>
                <div class="">
                    <label for="pass">Mật Khẩu</label>
                    <input type="password" name="pass" required>
                </div>

                <div class="">
                <input name="login" type="submit" value="Đăng Nhập">
                <a class="regis" href="register.php">Đăng Ký</a>
                </div>
                
            </form>


        </div>
    </div>
</body>

</html>

<style>
    .form-container a{
        display: flex;
        flex-direction: row-reverse;
        padding-bottom: 15px;
    }
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    .main {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form-container {
        max-width: 300px;
        padding: 30px;
        padding-right: 40px;
        background-color: #ccc;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    .form-container h2 {
        text-align: center;
        color: #333333;
        margin-bottom: 20px;
    }

    .form-container label {
        display: block;
        margin-bottom: 5px;
        color: #333333;
    }

    .form-container input[type="text"],
    .form-container input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #cccccc;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    .form-container input[type="text"]:focus,
    .form-container input[type="password"]:focus {
        outline: none;
        border-color: #4CAF50;
    }

    .form-container input[type="submit"],
    .form-container .regis {
        display: inline-block;
        padding: 10px 20px;
        text-decoration: none;
        background-color: #4CAF50;
        color: #ffffff;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        margin-right: 10px;
    }

    .form-container input[type="submit"]:hover,
    .form-container .regis:hover {
        background-color: #45a049;
    }

    .form-container .register-link {
        margin-top: 10px;
        text-align: center;
        font-size: 14px;
        color: #333333;
    }
</style>

</html>