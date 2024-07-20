
<?php
include "../../config/koneksi.php";
$act=$_GET['act'];

if($act=='inputkategori'){
if (empty($_POST['kat'])){
 echo "<script>window.alert('Kategori masih kosong');
        window.location=('javascript:history.go(-1)')</script>";
     }else{
mysqli_query($koneksi, "insert into kategori (nama_kategori) values ('$_POST[kat]')");  
echo "<script>window.location=('../index.php?aksi=kategori')</script>";

  } 
}

elseif($act=='editkategori'){
if (empty($_POST['kat'])){
 echo "<script>window.alert('Kategori masih kosong');
        window.location=('javascript:history.go(-1)')</script>";
     }else{

mysqli_query($koneksi, "UPDATE kategori SET nama_kategori='$_POST[kat]' WHERE id_kategori='$_GET[id_k]'");

echo "<script>window.location=('../index.php?aksi=kategori')</script>";

  } 
}

elseif($act=='hapus'){
mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori='$_GET[id_k]'"); 
echo "<script>window.location=('../index.php?aksi=kategori')</script>";
}

?>
