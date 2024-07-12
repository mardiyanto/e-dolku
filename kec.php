<?php 
  include "config/koneksi.php";
	include "config/fungsi_indotgl.php";
	include "config/class_paging.php";
	include "config/fungsi_combobox.php";
	include "config/library.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_rupiah.php";
$nama_kota = $_GET['id'];
?>

	<option value="">-= Pilih Kecamatan =-</option>
	 
	<?php
		$sql_prov =mysql_query("SELECT * FROM kota WHERE nama_kota='$nama_kota' ORDER by kel ASC");
		while ( $r = mysql_fetch_array($sql_prov) ){ 
	?>
			<option value="<?php echo $r['id_kota']; ?>"> <?php echo $r['kel']; ?> </option>
	<?php } /* end while */	?>
