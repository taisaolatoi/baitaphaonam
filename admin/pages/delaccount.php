<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $qr = "SELECT * FROM thongtinkh WHERE makhachhang='$id'";
    $result = pg_query($conn, $qr);
    $row = pg_fetch_assoc($result);
    $id_tt = $row['id'];


    $query0 = "SELECT * from donhang where id_thongtinkh='$id_tt'";
    $result0 = pg_query($conn, $query0);
    if (pg_num_rows($result0) > 0) {
        echo "<script>alert('Khách hàng có đơn hàng hãy xoá đơn hàng của khách hàng trước!!');</script>";
        echo "<script>window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
        exit();
    } else {
        $query1 = "DELETE from thongtinkh where makhachhang='$id'";
        $query2 = "DELETE from account where id='$id'";
        pg_query($conn, $query1);
        pg_query($conn, $query2);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

}
?>