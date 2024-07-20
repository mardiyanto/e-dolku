<?php
include "../../config/koneksi.php";
$act = $_GET['act'];

if($act == 'inputkota'){
    if (empty($_POST['kot']) || empty($_POST['ok'])){
        echo "<script>window.alert('Masih Ada Data Kosong');
        window.location=('javascript:history.go(-1)')</script>";
    }else{
        $query = "INSERT INTO kota (kabupaten,nama_kota,ongkos_kirim) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "sss", $_POST['prov'], $_POST['kot'], $_POST['ok']);
        mysqli_stmt_execute($stmt);
        echo "<script>window.location=('../index.php?aksi=kota')</script>";
    }
}

elseif($act == 'editkota'){
    if (empty($_POST['kot']) || empty($_POST['ok'])){
        echo "<script>window.alert('Masih Ada Data Kosong');
        window.location=('javascript:history.go(-1)')</script>";
    }else{
        $query = "UPDATE kota SET kabupaten=?, nama_kota=?, ongkos_kirim=? WHERE id_kota=?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $_POST['prov'], $_POST['kot'], $_POST['ok'], $_GET['id_k']);
        mysqli_stmt_execute($stmt);
        echo "<script>window.location=('../index.php?aksi=kota')</script>";
    }
}

elseif($act == 'hapus'){
    $query = "DELETE FROM kota WHERE id_kota=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $_GET['id_k']);
    mysqli_stmt_execute($stmt);
    echo "<script>window.location=('../index.php?aksi=kota')</script>";
}
?>
