<div class="header_add_search">
        <button><a href="?page=addaccount">
            Cấp Tài Khoản</a></button>
    </div>
<div class="account_main">
<table class="tbl_account">
    <thead>
        <th>Mã khách hàng</th>
        <th>Username</th>
        <th>Họ tên</th>
        <th>Ngày sinh</th>
        <th>Địa chỉ</th>
        <th>SĐT</th>
        <th>Email</th>
        <th>Giới tính</th>
        <th>Quyền</th>
        <th>Edit</th>

    </thead>
    <tbody>
        <?php
        $query = "SELECT * from account";
        $result = pg_query($conn, $query);

        if (pg_num_rows($result) > 0) {
            while ($row = pg_fetch_assoc($result)) {
                $user = $row['username'];
                $hoten = $row['hoten'];
                $ngaysinh = $row['ngaysinh'];
                $diachi = $row['diachi'];
                $sdt = $row['sdt'];
                $email = $row['email'];
                $gioitinh = $row['gioitinh'];
                $role = $row['role'];
                $id=$row['id'];

                ?>
                <tr>
                    <td>
                        <?php echo $id;?>
                    </td>
                    <td>
                        <?php echo $user ?>
                    </td>
                    <td>
                        <?php echo $hoten ?>
                    </td>
                    <td>
                        <?php echo $ngaysinh ?>
                    </td>
                    <td>
                        <?php echo $diachi ?>
                    </td>
                    <td>
                        <?php echo $sdt ?>
                    </td>
                    <td>
                        <?php echo $email ?>
                    </td>
                    <td>
                        <?php echo $gioitinh ?>
                    </td>
                    <td>
                        <?php 
                            if ($role == 1){
                                echo 'Admin';
                            }else{
                                echo 'Người dùng';
                            }
                        ?>
                    </td>
                    <td >
                    <a style="color: black;" href="?page=delaccount&id=<?php echo $id;?>"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>

    </tbody>
</table>
</div>
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
    .product-name {
        width: 120px;
    }

    .container_main {
        height: 130px;
        overflow: auto;
    }

    .container_all {
        display: flex;
        justify-content: space-around;
        position: relative;
        margin: 15px;

    }

    .product-img img {
        width: 100px;

    }

    .product-quantity {
        right: 2%;
        top: -6%;
        position: absolute;
        border: 1px solid #ccc;
        background-color: cornflowerblue;
        color: #fff;
        padding: 2px;
        height: 24px;
        width: 23px;
        text-align: center;
        border-radius: 10px;
    }

    table {
        width: 1000px;
        margin: 0 auto;
        border-collapse: collapse;
        border: 1px solid #ddd;
        /* margin: 50px 0; */
    }

    th,
    td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>