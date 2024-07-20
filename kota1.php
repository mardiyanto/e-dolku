<?php 
include "config/koneksi.php";
include "config/fungsi_indotgl.php";
include "config/class_paging.php";
include "config/fungsi_combobox.php";
include "config/library.php";
include "config/fungsi_autolink.php";
include "config/fungsi_rupiah.php";
$id_prov = $_GET['id'];

?>
<div class="control-group">
<label class="control-label">Kota/Kabupaten <sup>*</sup></label>
<select name="kota" class="input" required>
	<option value="">-= Pilih Kota/Kabupaten =-</option>
	 
	<?php
		$sql_prov = mysqli_query($koneksi, "SELECT * FROM kota WHERE kabupaten='$id_prov' ORDER BY nama_kota ASC");
		while ($r = mysqli_fetch_array($sql_prov)) { 
	?>
			<option value="<?= $r['id_kota']; ?>"> <?= $r['nama_kota']; ?> </option>
	<?php } /* end while */	?>

</select>
