
<?php
include "../../config/koneksi.php";
$act=$_GET[act];

if($act=='inputkota'){
if (empty($_POST[kot])  ||  empty($_POST[ok])){
 echo "<script>window.alert('Masih Ada Data Kosong');
        window.location=('javascript:history.go(-1)')</script>";
     }else{
mysql_query("insert into kota (kabupaten,nama_kota,ongkos_kirim) values ($_POST[prov]','$_POST[kot]','$_POST[ok]')");  
echo "<script>window.location=('../index.php?aksi=kota')</script>";

  } 
}

elseif($act=='editkota'){
if (empty($_POST[kot])  ||  empty($_POST[ok])){
 echo "<script>window.alert('Masih Ada Data Kosong');
        window.location=('javascript:history.go(-1)')</script>";
     }else{

mysql_query("UPDATE kota SET kabupaten='$_POST[prov]',nama_kota='$_POST[kot]',ongkos_kirim='$_POST[ok]' WHERE id_kota='$_GET[id_k]'");

echo "<script>window.location=('../index.php?aksi=kota')</script>";

  } 
}

elseif($act=='hapus'){
mysql_query("DELETE FROM kota WHERE id_kota='$_GET[id_k]'"); 
echo "<script>window.location=('../index.php?aksi=kota')</script>";
}

?>
