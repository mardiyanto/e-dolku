<?php
include "../../config/koneksi.php";
$act=$_GET[act];
$jd=$_GET[jd];
if($act=='editpro'){
if (empty($_POST[isi])){
 echo "<script>window.alert('Data yang Anda isikan belum lengkap');
        window.location=('javascript:history.go(-1)')</script>";
     }else{
	 
mysql_query("UPDATE profil SET nama='$jd',isi='$_POST[isi]' WHERE id_profil='$_GET[id_p]'"); 
echo "<script>window.location=('../index.php?aksi=home')</script>";
}
}
?>