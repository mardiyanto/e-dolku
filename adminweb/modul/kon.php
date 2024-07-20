<?php
include "../../config/koneksi.php";
$act = $_GET['act'];
$date = date('d/m/Y');
$time = date('h:i A');

if($act == 'status'){
    if($_GET['beku'] == 'beku'){
        $query1 = mysqli_query($koneksi, "UPDATE konfirmasi SET status='Gagal' WHERE id_konfrim='$_GET[id_bk]'");
        echo "<script>window.location=('../index.php?aksi=konfirmasi')</script>";
    }else{
        $query2 = mysqli_query($koneksi, "UPDATE konfirmasi SET status='Berhasil' WHERE id_konfrim='$_GET[id_bk]'");
        echo "<script>window.location=('../index.php?aksi=konfirmasi')</script>";
    }
}
if($act == 'statusorder'){
    if($_GET['beku'] == 'beku'){
        $query1 = mysqli_query($koneksi, "UPDATE konfirmasi SET status='Gagal' WHERE id_konfrim='$_GET[id_bk]'");
        echo "<script>window.location=('../index.php?aksi=konfirmasi')</script>";
    }else{
        $query2 = mysqli_query($koneksi, "UPDATE konfirmasi SET status='Berhasil' WHERE id_order_p='$_GET[id_bk]'");
        echo "<script>window.location=('../index.php?aksi=detailorder&id=$_GET[id_bk]')</script>";
    }
}elseif($act == 'hapus'){
    mysqli_query($koneksi, "DELETE FROM konfirmasi WHERE id_konfrim='$_GET[id_bk]'");
    echo "<script>window.location=('../index.php?aksi=konfirmasi')</script>";
}

?>
