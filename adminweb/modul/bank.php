<?php
include "../../config/koneksi.php";
$act=$_GET[act];
$date=date ('d/m/Y');
$time=date ('h:i A');
$diskon=$_POST[diskon];
if($act=='input'){
if (empty($_POST[nama]) || empty($_POST[AT]) || empty($_POST[NR]) || empty($_POST[AB])){
 echo "<script>window.alert('Data yang Anda isikan belum lengkap');
        window.location=('javascript:history.go(-1)')</script>";
     }

else{
	
$lokasi_file=$_FILES[gambar][tmp_name];
if(empty($lokasi_file)){
			 echo "<script>window.alert('Gambar Belum Dimasukan');
        window.location=('javascript:history.go(-1)')</script>";
}else{
$tanggal=date("dmYhis");
$file=$_FILES['gambar']['tmp_name'];
$file_name=$_FILES['gambar']['name'];
copy($file,"../../foto/foto_bank/".$tanggal.".jpg");
mysql_query("insert into bank(	nm_bank,
								at_nama,
								no_rek,
								alm_bank,
								gb
											) 
									values ('$_POST[nama]',
											'$_POST[AT]',
											'$_POST[NR]',
											'$_POST[AB]',
											'$tanggal.jpg'
											
											)");
   
echo "<script>window.location=('../index.php?aksi=bank')</script>";
   }
  } 
}

elseif($act=='edit'){
if (empty($_POST[nama]) || empty($_POST[AT]) || empty($_POST[NR]) || empty($_POST[AB])){
 echo "<script>window.alert('Data yang Anda isikan belum lengkap');
        window.location=('javascript:history.go(-1)')</script>";
     }

else{
	
	
$lokasi_file=$_FILES[gambar][tmp_name];
if(empty($lokasi_file)){

mysql_query("UPDATE bank SET	nm_bank='$_POST[nama]',
								at_nama='$_POST[AT]',
								no_rek='$_POST[NR]',
								alm_bank='$_POST[AB]'
								WHERE id_bank='$_GET[id_b]'
									");
   
echo "<script>window.location=('../index.php?aksi=bank')</script>";
}else{
if($_GET[gb]==''){
$tanggal=date("dmYhis");
$file=$_FILES['gambar']['tmp_name'];
$file_name=$_FILES['gambar']['name'];
copy($file,"../../foto/foto_bank/".$tanggal.".jpg");

mysql_query("UPDATE bank SET	nm_bank='$_POST[nama]',
								at_nama='$_POST[AT]',
								no_rek='$_POST[NR]',
								alm_bank='$_POST[AB]',
								gb='$tanggal.jpg'
								WHERE id_bank='$_GET[id_b]'
									");
   
echo "<script>window.location=('../index.php?aksi=bank')</script>";

}else{


$a=$_GET['gb'];
$file=$_FILES['gambar']['tmp_name'];
$file_name=$_FILES['gambar']['name'];
copy($file,"../../foto/foto_bank/".$a);
mysql_query("UPDATE bank SET	nm_bank='$_POST[nama]',
								at_nama='$_POST[AT]',
								no_rek='$_POST[NR]',
								alm_bank='$_POST[AB]'
								WHERE id_bank='$_GET[id_b]'
									");
   
echo "<script>window.location=('../index.php?aksi=bank')</script>";
    }
   }
  } 
}

elseif($act=='hapus'){
mysql_query("DELETE FROM bank WHERE id_bank='$_GET[id_b]'");
$b=$_GET['gbr'];
$pathFile="../../foto/foto_bank/$b";	   
unlink($pathFile);

echo "<script>window.location=('../index.php?aksi=bank')</script>";
}
?>
