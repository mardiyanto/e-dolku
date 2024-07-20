<?php
include "../../config/koneksi.php";
$act = $_GET['act'];
$date = date('d/m/Y');
$time = date('h:i A');

if($act == 'hapus'){
    $query = "DELETE FROM kustomer WHERE id_kustomer=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $_GET['id_ks']);
    mysqli_stmt_execute($stmt);
    echo "<script>window.location=('../index.php?aksi=member')</script>";
}
