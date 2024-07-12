
<?php
include "../../config/koneksi.php";

mysql_query("DELETE FROM konfirmasi WHERE id_konfrim='$_GET[id_k]'"); 
echo "<script>window.location=('../index.php?aksi=konfirmasi')</script>";


?>
