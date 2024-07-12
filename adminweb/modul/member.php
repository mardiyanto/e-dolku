
<?php
include "../../config/koneksi.php";
$act=$_GET[act];
$date=date ('d/m/Y');
$time=date ('h:i A');

if($act=='hapus'){
mysql_query("DELETE FROM kustomer WHERE id_kustomer='$_GET[id_ks]'");
  echo "<script>window.location=('../index.php?aksi=member')</script>";
}



?>
