<?php
include "config/koneksi.php";
$tgl = date('d/m/Y');
$dt = date('h:i A');
$pilih = $_GET['pilih'];

if ($pilih == 'komen') {
    $isi = trim(strip_tags($_POST['isi']));
    mysqli_query($koneksi, "INSERT INTO komentar(id_prod, jwb, balas, nama, email, komentar, tgl, jam, admin)
                            VALUES('$_GET[id_p]', '0', '0', '$_POST[nama]', '$_POST[email]', '$isi', '$tgl', '$dt', 'N')");
    header("location:index.php?l=lihat&aksi=detail&id_p=$_GET[id_p]");
} elseif ($pilih == 'balas') {
    $isi = trim(strip_tags($_POST['isi']));
    $bls = mysqli_query($koneksi, "SELECT * FROM komentar WHERE id_komen=$_GET[id_km]");
    $bl = mysqli_fetch_array($bls);
    $bk = ($bl['balas'] == 0) ? $_GET['id_km'] : $bl['balas'];

    mysqli_query($koneksi, "INSERT INTO komentar(id_prod, jwb, balas, nama, nm_bls, email, komentar, tgl, jam, admin)
                            VALUES('$_GET[id_p]', '1', '$bk', '$_POST[nama]', '$_GET[nm]', '$_POST[email]', '$isi', '$tgl', '$dt', 'N')");
    header("location:index.php?l=lihat&aksi=detail&id_p=$_GET[id_p]");
} elseif ($pilih == 'komentesti') {
    $isi = trim(strip_tags($_POST['isi']));
    mysqli_query($koneksi, "INSERT INTO komentar(id_prod, jwb, balas, nama, email, komentar, tgl, jam, admin)
                            VALUES('0', '0', '0', '$_POST[nama]', '$_POST[email]', '$isi', '$tgl', '$dt', 'N')");
    header("location:index.php?l=lihat&aksi=testi");
} elseif ($pilih == 'balastesti') {
    $isi = trim(strip_tags($_POST['isi']));
    $bls = mysqli_query($koneksi, "SELECT * FROM komentar WHERE id_komen=$_GET[id_km]");
    $bl = mysqli_fetch_array($bls);
    $bk = ($bl['balas'] == 0) ? $_GET['id_km'] : $bl['balas'];

    mysqli_query($koneksi, "INSERT INTO komentar(id_prod, jwb, balas, nama, nm_bls, email, komentar, tgl, jam, admin)
                            VALUES('0', '1', '$bk', '$_POST[nama]', '$_GET[nm]', '$_POST[email]', '$isi', '$tgl', '$dt', 'N')");
    header("location:index.php?l=lihat&aksi=testi");
}
?>