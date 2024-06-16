<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<?php
require('../pages/db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['passwords'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
    $query0="SELECT username from account where username='$user'";
    $result0 = pg_query($conn,$query0);
    if(pg_num_rows($result0) > 0){
        echo '<script>
                alert("Username đã tồn tại!!");
            </script>';
    }else{
        $query = "INSERT INTO account(username,passwords,hoten,diachi,sdt,email,gioitinh,ngaysinh) values('$user','$hashedPass','$fullname','$address','$phone','$email','$gender','$dob')";
        $result = pg_query($conn, $query);
    
        echo '<script>
                alert("Đăng ký thành công");
            </script>';
    }

}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Đăng ký</title>
</head>

<body>
    <h3><a href="../index.php">
            <i class="fa-solid fa-circle-left"></i>
            Về Trang Chủ</a></h3>
    <div class="cover-form">
        <h2>Đăng ký</h2>
        <form action="" method="POST">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="passwords" required><br><br>

            <label for="fullname">Họ tên:</label>
            <input type="text" id="fullname" name="fullname" required><br><br>

            <label for="address">Địa chỉ:</label>
            <input type="text" id="address" name="address" required><br><br>

            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" required><br><br>

            <label for="email">Địa chỉ email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="dob">Ngày tháng năm sinh:</label>
            <input type="date" id="dob" name="dob" required><br><br>

            <label>Giới tính:</label>
            <div class="input_sex">
                <input type="radio" id="gender_male" name="gender" value="Nam" required>
                <label for="gender_male">Nam</label>
                <input type="radio" id="gender_female" name="gender" value="Nữ" required>
                <label for="gender_female">Nữ</label><br><br>
            </div>


            <input type="submit" name="dangky" value="Đăng ký">
        </form>
    </div>
    <style>
        <title>Đăng ký</title><style>body {
            font-family: Arial, sans-serif;
        }

        .cover-form {
            width: 400px;
            height: max-content;
            margin: 20px auto;
            background-color: #E8E8E8;
            border: 1px solid #000;
            border-radius: 20px;

        }

        a {
            text-decoration: none;
        }

        h3 {
            padding-top: 10px;

        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {

            width: 300px;
            margin: 0 auto;
        }

        label {
            padding-bottom: 7px;
            display: block;
            color: #666;
        }

        .input_sex {
            display: flex;
        }

        .input_sex label {
            display: flex;
            align-items: center;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="date"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }


    </style>

</body>

</html>