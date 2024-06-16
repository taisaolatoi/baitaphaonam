<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['passwords'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $rol = $_POST['rol'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
    $query = "INSERT INTO account(username,passwords,hoten,diachi,sdt,email,gioitinh,role,ngaysinh) values('$user','$hashedPass','$fullname','$address','$phone','$email','$gender','$rol','$dob')";
    $result = _query($query);

    echo "<script>alert('Đăng ký thành công!!!');</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Đăng ký</title>
</head>
<?php
// getAccount();
?>

<body>

    <div class="cover-form">
        <h2 class="h2-add">Cấp Tài Khoản</h2>
        <form class="form-add" action="" method="POST">
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


            <div class="input_role">
                <label>Quyền:</label>

                <select name="rol">
                    <option value="1">Admin</option>
                    <option value="0">Người dùng</option>
                </select>
            </div>

            <label for="dob">Ngày tháng năm sinh:</label>
            <input type="date" id="dob" name="dob" required><br><br>

            <label>Giới tính:</label>
            <div class="input_sex">
                <input type="radio" id="gender_male" name="gender" value="Nam" required>
                <label for="gender_male">Nam</label>
                <input type="radio" id="gender_female" name="gender" value="Nữ" required>
                <label for="gender_female">Nữ</label><br><br>
            </div>


            <input type="submit" name="dangky" value="Đăng Ký">
        </form>
    </div>

    <style>
        section {
            justify-content: center;
            display: flex;
            padding-top: 20px;
        }

        .cover-form {
            border-radius: 15px;
            background-color: #E8E8E8;
            width: 420px;
            height: auto;
            border: 1px solid #000;

        }

        .h2-add {
            padding: 30px 0;
            color: #333;
            text-align: center;
        }

        .form-add {
            width: 300px;
            margin: 0 auto;
        }

        .form-add label {
            display: block;
            color: #000;
            padding-bottom: 5px;
        }

        .input_sex {
            display: flex;
        }

        .input_sex label {
            display: flex;
            align-items: center;
        }

        .input_role {
            padding-bottom: 30px;
        }


        .form-add input[type="text"],
        .form-add input[type="password"],
        .form-add input[type="email"],
        .form-add input[type="date"],
        .form-add input[type="submit"],
        .form-add input[type="role"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-add input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        .form-add input[type="submit"]:hover {
            background-color: #45a049;
        }

        @media only screen and (max-width : 740px) {}

        @media only screen and (min-width : 741px) and (max-width :1024px) {
            .cover-form {
                height: 865px;
            }
        }
    </style>
</body>

</html>