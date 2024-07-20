<?php
$date = date('Y-m-d');
$posting = mysqli_query($koneksi, "SELECT SUM(stok) AS b FROM produk");
$post = mysqli_fetch_array($posting);

$kategori = mysqli_query($koneksi, "SELECT COUNT(id_kategori) AS ka FROM kategori");
$kate = mysqli_fetch_array($kategori);

$galeri = mysqli_query($koneksi, "SELECT COUNT(id_kustomer) AS ga FROM kustomer");
$gale = mysqli_fetch_array($galeri);

$order = mysqli_query($koneksi, "SELECT COUNT(id_orders) AS aws FROM orders, kustomer WHERE orders.id_kustomer=kustomer.id_kustomer AND tgl_order='$date' AND status_order='Lunas'");
$gh = mysqli_fetch_array($order);

$tot = mysqli_query($koneksi, "SELECT * FROM orders, kustomer WHERE orders.id_kustomer=kustomer.id_kustomer AND status_order='Lunas'");
$to = mysqli_fetch_array($tot);
$juml = mysqli_num_rows($tot);
?>