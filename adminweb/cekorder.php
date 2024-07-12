<?php
include "../config/koneksi.php";
$pesan = mysql_query("SELECT id_orders FROM orders
    WHERE status_order='Baru'");
$j = mysql_num_rows($pesan);
if($j>0){
    echo $j;
}
?>
