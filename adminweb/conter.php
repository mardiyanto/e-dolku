<?php
$tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
$waktu   = time(); // 

// Menggunakan mysqli dan memperbaiki query
$koneksi = mysqli_connect("localhost", "username", "password", "database"); // Sesuaikan dengan konfigurasi server

$pengunjungQuery = mysqli_query($koneksi, "SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip");
$pengunjung = mysqli_num_rows($pengunjungQuery);

$totalpengunjungQuery = mysqli_query($koneksi, "SELECT COUNT(hits) FROM statistik");
$totalpengunjungRow = mysqli_fetch_array($totalpengunjungQuery);
$totalpengunjung = $totalpengunjungRow[0];

$hitsQuery = mysqli_query($koneksi, "SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal");
$hits = mysqli_fetch_assoc($hitsQuery);

$totalhitsQuery = mysqli_query($koneksi, "SELECT SUM(hits) FROM statistik");
$totalhitsRow = mysqli_fetch_array($totalhitsQuery);
$totalhits = $totalhitsRow[0];

$tothitsgbr = $totalhits; // Variabel ini tampaknya duplikat dari $totalhits

$bataswaktu = time() - 300;
$pengunjungonlineQuery = mysqli_query($koneksi, "SELECT * FROM statistik WHERE online > '$bataswaktu'");
$pengunjungonline = mysqli_num_rows($pengunjungonlineQuery);

$a7 = number_format($pengunjung, 0, ",", ".");
$b7 = number_format($totalpengunjung, 0, ",", ".");
$c7 = number_format($hits['hitstoday'], 0, ",", ".");
$d7 = number_format($totalhits, 0, ",", ".");
$e7 = number_format($pengunjungonline, 0, ",", ".");

?>