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
		$sql_prov =mysql_query("SELECT * FROM kota WHERE kabupaten='$provinsi' group by nama_kota ORDER by nama_kota ASC");
		while ( $r = mysql_fetch_array($sql_prov) ){ 
	?>
			<option value="<?php echo $r['nama_kota']; ?>"> <?php echo $r['nama_kota']; ?> </option>
	<?php } /* end while */	?>
