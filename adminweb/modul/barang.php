<?php
include "../../config/koneksi.php";
$act=$_GET[act];
$date=date ('d/m/Y');
$time=date ('h:i A');
$diskon=$_POST[diskon];
if($act=='input'){
if (empty($_POST[nama]) || empty($_POST[harga]) || empty($_POST[ket]) || empty($_POST[stok])){
 echo "<script>window.alert('Data yang Anda isikan belum lengkap');
        window.location=('javascript:history.go(-1)')</script>";
     }

elseif ($_POST[kat]=='null'){
  echo "<script>window.alert('Kategori Belum dipilih');
        window.location=('javascript:history.go(-1)')</script>";
	}

elseif (!ereg("[0-9]","$_POST[harga]")){
echo "<script>window.alert('Harga hanya dapat disi dengan angka');
        window.location=('javascript:history.go(-1)')</script>";

}
elseif ($diskon >= 100){
echo "<script>window.alert('diskon tidak bisa lebih dari 100');
        window.location=('javascript:history.go(-1)')</script>";

}

elseif (!ereg("[0-9]","$_POST[stok]")){
echo "<script>window.alert('stok hanya dapat disi dengan angka');
        window.location=('javascript:history.go(-1)')</script>";

}
else{
	
$lokasi_file=$_FILES[gambar][tmp_name];
if(empty($lokasi_file)){
echo "<script>window.alert('Masukan Gambar Produk');
        window.location=('javascript:history.go(-1)')</script>";
}else{
$tanggal=date("dmYhis");
$file=$_FILES['gambar']['tmp_name'];
$file_name=$_FILES['gambar']['name'];
copy($file,"../../foto/foto_produk/".$tanggal.".jpg");
mysql_query("insert into produk (id_kategori,
											
											nama_produk,
											harga,
											diskon,
											berat,
											stok,
											deskripsi,
											tgl_masuk,
											gambar,
											best
											) 
									values ('$_POST[kat]',
											
											'$_POST[nama]',
											'$_POST[harga]',
											'$_POST[diskon]',
											'$_POST[berat]',
											'$_POST[stok]',
											'$_POST[ket]',
											'$date',
											'$tanggal.jpg',
											'$_POST[rd]'
											)");
   
echo "<script>window.location=('../index.php?aksi=barang')</script>";
   }
  } 
}

elseif($act=='edit'){
if (empty($_POST[nama]) || empty($_POST[harga]) || empty($_POST[ket]) || empty($_POST[stok])){
 echo "<script>window.alert('Data yang Anda isikan belum lengkap');
        window.location=('javascript:history.go(-1)')</script>";
     }

elseif ($_POST[kat]=='null'){
  echo "<script>window.alert('Kategori Belum dipilih');
        window.location=('javascript:history.go(-1)')</script>";
	}

elseif (!ereg("[0-9]","$_POST[harga]")){
echo "<script>window.alert('Harga hanya dapat disi dengan angka');
        window.location=('javascript:history.go(-1)')</script>";

}
elseif ($diskon >= 100){
echo "<script>window.alert('diskon tidak bisa lebih dari 100');
        window.location=('javascript:history.go(-1)')</script>";

}

elseif (!ereg("[0-9]","$_POST[stok]")){
echo "<script>window.alert('stok hanya dapat disi dengan angka');
        window.location=('javascript:history.go(-1)')</script>";

}else{
	
$lokasi_file=$_FILES[gambar][tmp_name];
if(empty($lokasi_file)){
mysql_query("UPDATE produk SET id_kategori='$_POST[kat]',
											
											nama_produk='$_POST[nama]',
											harga='$_POST[harga]',
											diskon='$_POST[diskon]',
											berat='$_POST[berat]',
											stok='$_POST[stok]',
											deskripsi='$_POST[ket]',
											tgl_masuk='$date',
											best='$_POST[rd]'
									WHERE id_produk='$_GET[id_b]'
									");
   
echo "<script>window.location=('../index.php?aksi=barang')</script>";
}else{
if($_GET[gb]==''){
$tanggal=date("dmYhis");
$file=$_FILES['gambar']['tmp_name'];
$file_name=$_FILES['gambar']['name'];
copy($file,"../../foto/foto_produk/".$tanggal.".jpg");
mysql_query("UPDATE produk SET id_kategori='$_POST[kat]',
											
											nama_produk='$_POST[nama]',
											harga='$_POST[harga]',
											diskon='$_POST[diskon]',
											berat='$_POST[berat]',
											stok='$_POST[stok]',
											deskripsi='$_POST[ket]',
											tgl_masuk='$date',
											gambar='$tanggal.jpg',
											best='$_POST[rd]'
									WHERE id_produk='$_GET[id_b]'
									");
   
echo "<script>window.location=('../index.php?aksi=barang')</script>";
}else{


$a=$_GET['gb'];
$file=$_FILES['gambar']['tmp_name'];
$file_name=$_FILES['gambar']['name'];
copy($file,"../../foto/foto_produk/".$a);
mysql_query("UPDATE produk SET id_kategori='$_POST[kat]',
										
											nama_produk='$_POST[nama]',
											harga='$_POST[harga]',
											diskon='$_POST[diskon]',
											berat='0',
											stok='$_POST[stok]',
											deskripsi='$_POST[ket]',
											tgl_masuk='$date',
											best='$_POST[rd]'
									WHERE id_produk='$_GET[id_b]'
									");
   
echo "<script>window.location=('../index.php?aksi=barang')</script>";
    }
   }
  } 
}

elseif($act=='hapus'){
mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id_b]'");
$b=$_GET['gbr'];
$pathFile="../../foto/foto_produk/$b";	   
unlink($pathFile);

echo "<script>window.location=('../index.php?aksi=barang')</script>";
}
?>
