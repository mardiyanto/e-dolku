<?php 
include "config/koneksi.php";
include "config/fungsi_indotgl.php";
include "config/class_paging.php";
include "config/fungsi_combobox.php";
include "config/library.php";
include "config/fungsi_autolink.php";
include "config/fungsi_rupiah.php";

$provinsi = $_GET['idkot'];

?>
	  
<option value="">-= Pilih Kabupaten/Kota =-</option>
	 
<?php
$sql_prov = mysqli_query($koneksi, "SELECT * FROM kota WHERE kabupaten='$provinsi' GROUP BY nama_kota ORDER BY nama_kota ASC");
while ($r = mysqli_fetch_array($sql_prov)) { 
?>
	<option value="<?= $r['nama_kota']; ?>"> <?= $r['nama_kota']; ?> </option>
<?php } /* end while */ ?>
