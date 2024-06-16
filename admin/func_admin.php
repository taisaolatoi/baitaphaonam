<?php
include ("../pages/db.php");
function _query($query)
{
    global $conn;
    return pg_query($conn, $query);
}
function check_user($user, $pass)
{
    $query = "SELECT * from account where username='$user'";
    $result = _query($query);
    $row = pg_fetch_assoc($result);
    if (isset($result) && $row > 0 && password_verify($pass, $row["passwords"])) {
        $hoten = $row["hoten"];
        $id_user = $row["id"];
        if ($row['role'] == 1) {
            return array("result" => 1, "hoten" => $hoten, "id" => $id_user);
        } else if ($row['role'] == 0) {
            return array("result" => 0, "hoten" => $hoten, "id" => $id_user);
        }
    } else {
        return array("result" => -1);
    }
}

function check_pass($user, $pass)
{
    $query = "SELECT * from account where username='$user'";
    $result = _query($query);
    $row = pg_fetch_assoc($result);
    if (isset($result) && $row > 0 && password_verify($pass, $row["passwords"])) {
        $hoten = $row["hoten"];
        $id_user = $row["id"];
        if ($row['role'] == 1) {
            return array("result" => 1, "hoten" => $hoten, "id" => $id_user);
        } else if ($row['role'] == 0) {
            return array("result" => 0, "hoten" => $hoten, "id" => $id_user);
        }
    } else {
        return array("result" => -1);
    }
}
//Lấy loại sản phẩm để nhập sản phâm
function gettypeProduct($conn, $id)
{
    global $conn;
    $query = "SELECT * FROM loaisanpham where iddanhmuc = '$id'";
    return pg_query($query);
}

function getCategory($conn)
{
    global $conn;
    $query = "SELECT * FROM danhmuc";
    return pg_query($query);
}

function getCategoryDetail($conn,$id)
{
    global $conn;
    $query = "SELECT * FROM danhmuc where iddanhmuc = '$id'";
    return pg_query($query);
}

//
function searchProducts($keywords)
{

    // Thực hiện truy vấn tìm kiếm sản phẩm dựa trên tên
    $query = "SELECT * FROM sanpham WHERE LOWER(tensanpham) LIKE LOWER('%$keywords%');";
    $result = _query($query);
    $count = pg_num_rows($result);

    // Xử lý kết quả tìm kiếm
    if (pg_num_rows($result) > 0) {
        // Hiển thị kết quả tìm kiếm
        echo '<h1>Có ' . $count . ' kết quả phù hợp</h1>';
        echo '<table border="1px" style="border-collapse:collapse;width:90%;margin:0 auto">';
        echo '<tr>';
        echo '<th>Mã sản phẩm</th>';
        echo '<th class="tensp">Tên Sản Phẩm</th>';
        echo '<th class="loai">Loại Sản Phẩm</th>';
        echo '<th class="soluong">Số lượng</th>';
        echo '<th>Giá</th>';
        echo '<th class="anhsp" >Ảnh</th>';
        echo '<th>Giới Tính</th>';
        echo '<th>Edit</th>';
        echo '</tr>';

        while ($row = pg_fetch_assoc($result)) {
            // Hiển thị thông tin sản phẩm
            echo '<tr>';
            echo '<td align="center">' . $row['masanpham'] . '</td>';
            echo '<td class="tensp" align="center">' . $row['tensanpham'] . '</td>';
            echo '<td class="loai" align="center">' . $row['loai'] . '</td>';
            echo '<td class="soluong" align="center">' . $row['soluong'] . '</td>';
            echo '<td align="center">' . number_format($row['gia']) . 'đ' . '</td>';
            echo '<td class="anhsp"><img src="../assest/img/thethao/' . $row['hinhanh'] . '" alt="Hình ảnh sản phẩm"></td>';
            echo '<td align="center">' . $row['gioitinh'] . '</td>';
            echo '<td align="center">';
            echo '<a href="?page=updateproduct&id=' . $row['masanpham'] . '"><i style="color: black;" class="fa-solid fa-edit"></i></a>';
            echo '<a href="?page=delproduct&id=' . $row['masanpham'] . '"><i style="color: black;" class="fa-solid fa-trash"></i></a>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo "<h1>Không có kết quả phù hợp</h1>";
    }
}

function getOneProduct($id)
{
    $query = "SELECT sanpham.*, danhmuc.tendanhmuc, loaisanpham.tenloai 
FROM sanpham 
JOIN danhmuc ON danhmuc.iddanhmuc = sanpham.danhmuc 
JOIN loaisanpham ON loaisanpham.idloai = sanpham.loaisanpham 
where masanpham = '$id';";
    $result = _query($query);
    if ($result && pg_num_rows($result) > 0) {
        $product = pg_fetch_assoc($result);
        return $product;
    }

    return null;

}



function getListProduct()
{
    $query = "SELECT sanpham.*, danhmuc.tendanhmuc, loaisanpham.tenloai 
FROM sanpham 
JOIN danhmuc ON danhmuc.iddanhmuc = sanpham.danhmuc 
JOIN loaisanpham ON loaisanpham.idloai = sanpham.loaisanpham 
ORDER BY sanpham.masanpham ASC;";
    $result = _query($query);

    echo '<table border="1px" style="border-collapse:collapse;width:90%;margin:0 auto">';
    echo '<tr>';
    echo '<th>Mã sản phẩm</th>';
    echo '<th class="tensp">Tên Sản Phẩm</th>';
    echo '<th class="tensp">Danh Mục</th>';
    echo '<th class="loai">Loại Sản Phẩm</th>';
    echo '<th>Giá</th>';
    echo '<th class="anhsp">Ảnh</th>';
    echo '<th>Giới Tính</th>';
    echo '<th class="edit">Edit</th>';
    echo '</tr>';

    while ($row = pg_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td align="center">' . $row['masanpham'] . '</td>';
        echo '<td class="tensp">' . $row['tensanpham'] . '</td>';
        echo '<td class="loai" align="center">' . $row['tendanhmuc'] . '</td>';
        echo '<td class="loai" align="center">' . $row['tenloai'] . '</td>';
        echo '<td align="center">' . number_format($row['gia']) . 'đ' . '</td>';
        echo '<td class="anhsp" width="150px"><img src="../assest/img/thethao/' . $row['hinhanh'] . '" alt="Hình ảnh sản phẩm"></td>';
        echo '<td align="center">' . $row['gioitinh'] . '</td>';
        echo '<td align="center">';
        echo '<a href="?page=updateproduct&id=' . $row['masanpham'] . '"><i style="color: black;" class="fa-solid fa-edit"></i></a>';
        echo '<a href="?page=delproduct&id=' . $row['masanpham'] . '"><i style="color: black;" class="fa-solid fa-trash"></i></a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';
}
// function getAccount(){

//     $query = "SELECT * FROM account ORDER BY id ASC";
//     $result = _query($query);

//     echo '<table border="1px" style="border-collapse:collapse;width:95%;margin:0 auto">';
//     echo '<tr>';
//     echo '<th>Tên Tài Khoản</th>';
//     echo '<th>Mật Khẩu</th>';
//     echo '<th>Họ Tên</th>';
//     echo '<th>Địa chỉ</th>';
//     echo '<th>SĐT</th>';
//     echo '<th>Email</th>';
//     echo '<th>Giới Tính</th>';
//     echo '<th>Quyền</th>';
//     echo '<th>Ngày sinh</th>';
//     echo '</tr>';

//     while ($row = pg_fetch_assoc($result)) {
//         echo '<tr>';
//         echo '<td align="center">' . $row['username'] . '</td>';
//         echo '<td>' . $row['passwords'] . '</td>';
//         echo '<td align="center">' . $row['hoten'] . '</td>';
//         echo '<td align="center">' . $row['diachi'] . '</td>';
//         echo '<td align="center">' . $row['sdt'] . '</td>';
//         echo '<td align="justify" style="width: 150px; padding: 20px; overflow: hidden !important;">' . $row['email'] . '</td>';
//         echo '<td align="center">' . $row['gioitinh'] . '</td>';
//         echo '<td align="center">' . $row['role'] . '</td>';
//         echo '<td align="center">' . $row['ngaysinh'] . '</td>';
//         echo '<td align="center">';
//         echo '<a href="?page=updateproduct&id='.$row['masanpham'].'"><i class="fa-solid fa-edit"></i></a>';
//         echo '<a href="?page=delproduct&id="><i class="fa-solid fa-trash"></i></a>';
//         echo '</td>';
//         echo '</tr>';
//     }

//     echo '</table>';
// }


function deleteProduct($masanpham)
{
    $query0 = "DELETE from chitietsanpham where idsanpham = '$masanpham'";
    $result0 = _query($query0);

    $query = "DELETE FROM sanpham WHERE masanpham = '$masanpham'";
    $result = _query($query);

    if ($result) {
        // header("location: ?page=search_admin");
        // echo '<script>alert("Xoá sản phẩm thành công.");</script>';
    } else {
        echo "Xóa sản phẩm thất bại. Vui lòng thử lại.";
    }
}



?>