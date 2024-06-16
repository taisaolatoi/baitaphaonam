<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query = "DELETE from ctdon where madonhang='$id'";
        $query1 = "DELETE from donhang where madonhang='$id'";
        pg_query($conn,$query);
        pg_query($conn,$query1);
        echo '<script>
                window.location.href = "/DoAn_1+/admin/admin.php?page=order";
            </script>';
            exit(); // Kết thúc thực thi mã PHP
    }
?>