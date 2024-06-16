<?php
    if (isset($_POST['update_tt'])) {
        $tt = $_POST['status'];
        $id= $_POST['madonhang'];
        $qr = "UPDATE donhang set trangthai = '$tt' where madonhang= '$id'";
        $result2 = pg_query($conn,$qr);
        echo '<script>
                window.location.href = "/DoAn_1+/admin/admin.php?page=order";
            </script>';
            exit(); 
    } 
    
    ?>