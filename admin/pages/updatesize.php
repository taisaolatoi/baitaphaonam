<?php
$id = $_GET['id'];
$sql = "SELECT * from chitietsanpham,size_sanpham where chitietsanpham.idsize = size_sanpham.idsize and chitietsanpham.idsanpham = $id order by size_sanpham.idsize";
$result = pg_query($conn, $sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idsize = $_POST['size'];
    $soluong = $_POST['quantity'];

    $updateSql = "UPDATE chitietsanpham SET soluong = '$soluong' where idsize = $idsize and idsanpham = $id";
    $updateresult = pg_query($conn, $updateSql);
    if ($updateresult) {
        // echo "<script>window.location.href='?page=product;</script>";
    }
}

?>

<form method="POST" action="" style="padding: 0 40px;">
    <div class="form-group">
        <label for="size">Size:</label>
        <select class="form-control" id="size" name="size">
            <option value="">-- Chọn size --</option>
            <?php
            while ($row = pg_fetch_assoc($result)) {
                echo '<option value="' . $row['idsize'] . '">' . $row['namesize'] . '</option>';
            }
            ?>
        </select>
    </div>
    <input type="hidden" id="idproduct" name="id" value="<?php echo $id ?>">
    <div class="form-group">
        <label for="quantity">Số lượng:</label>
        <input name="quantity" type="text" class="form-control" id="quantity">
    </div>
    <input style="width: 100%" type="submit" value="Cập nhật">

</form>

<script>
    document.getElementById("size").addEventListener("change", function () {
        var selectedSize = this.value;
        var quantityInput = document.getElementById("quantity");
        var masanpham = document.getElementById('idproduct').value;
        console.log(masanpham);
        var url = "http://localhost/DoAn_1+/admin/pages/getNamesize.php?idsize=" + selectedSize + "&masanpham=" + masanpham;


        // Gửi yêu cầu AJAX đến URL đã xây dựng
        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                quantityInput.value = response.soluong;
            }
        };
        xhr.send();
    });
</script>

<style>
    form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
</style>