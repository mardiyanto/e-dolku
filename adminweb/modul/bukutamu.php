
<?php
include "../../config/koneksi.php";
$act=$_GET['act'];
$date=date('d/m/Y');
$time=date('h:i A');

if($act=='status'){
if($_GET['beku']=='beku'){
  $query1=mysqli_query($koneksi, "UPDATE komentar SET status='N' WHERE id_komentar='$_GET[id_bk]'");
   echo "<script>window.location=('../index.php?aksi=bukutamu')</script>";
   }else{
   $query2=mysqli_query($koneksi, "UPDATE komentar SET status='Y' WHERE id_komentar='$_GET[id_bk]'");
   echo "<script>window.location=('../index.php?aksi=bukutamu')</script>";
        }
  }

elseif($act=='hapus'){
mysqli_query($koneksi, "DELETE FROM komentar WHERE id_komentar='$_GET[id_bk]'");
  echo "<script>window.location=('../index.php?aksi=bukutamu')</script>";
}

?>
