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
		$sql_prov =mysql_query("SELECT * FROM kota WHERE kabupaten='$id_prov' ORDER by nama_kota ASC");
		while ( $r = mysql_fetch_array($sql_prov) ){ 
	?>
			<option value="<?php echo $r['id_kota']; ?>"> <?php echo $r['nama_kota']; ?> </option>
	<?php } /* end while */	?>

</select>
