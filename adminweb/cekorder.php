<?php
include "../config/koneksi.php";
$pesan = mysqli_query($koneksi, "SELECT id_orders FROM orders WHERE status_order='Baru'");
$j = mysqli_num_rows($pesan);
if($j>0){
    echo $j;
}
?>
