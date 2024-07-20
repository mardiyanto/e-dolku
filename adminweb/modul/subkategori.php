<?php
include "../../config/koneksi.php";
$act = $_GET['act'];

if ($act == 'inputkategori') {
    if (preg_match("/[0]/", $_POST['kat']) || empty($_POST['genre'])) {
        echo "<script>window.alert('Data Belum Lengkap');
        window.location=('javascript:history.go(-1)')</script>";
     }else{
mysqli_query($konesi,"insert into tipe (id_kategori,genre) values ('$_POST[kat]','$_POST[genre]')");  
echo "<script>window.location=('../index.php?aksi=subkategori')</script>";

  } 
}

elseif($act=='edit'){
if (ereg ("[0]","$_POST[kat]") || empty($_POST[genre])){
 echo "<script>window.alert('Data Belum Lengkap');
        window.location=('javascript:history.go(-1)')</script>";
     }else{

mysqli_query($konesi,"UPDATE tipe SET id_kategori='$_POST[kat]',genre='$_POST[genre]' WHERE id_tipe='$_GET[id_t]'");

echo "<script>window.location=('../index.php?aksi=subkategori')</script>";

  } 
}

elseif($act=='hapus'){
mysqli_query($konesi,"DELETE FROM tipe WHERE id_tipe='$_GET[id_t]'"); 
echo "<script>window.location=('../index.php?aksi=subkategori')</script>";
}
?>
