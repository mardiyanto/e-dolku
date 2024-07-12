<?php
error_reporting(0);
include "../../config/koneksi.php";
$act=$_GET[act];
$date=date ('d/m/Y');
$time=date ('h:i A');
$diskon=$_POST[diskon];

if($act=='edit'){

$a=$_GET['gb'];
$file=$_FILES['gambar']['tmp_name'];
$file_name=$_FILES['gambar']['name'];
copy($file,"../../foto/foto_profil/".$a);


mysql_query("UPDATE kontak SET nama_perusahaan='$_POST[nama_p]',
peta='$_POST[peta]',
								alamat='$_POST[alamat]',
								telepon='$_POST[telepon]',
								telepon_2='$_POST[telepon2]',
								email='$_POST[email]',
								email_2='$_POST[email2]',
								jam_buka='$_POST[ket]',
								sambutan='$_POST[sambutan]',
								aktif='$_POST[pi]'
								WHERE id_kontak='$_GET[id]'
									");
   echo "<script>window.location=('../index.php?aksi=kontak_edit&id=1')</script>";

    }



?>
