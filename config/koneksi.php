<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "db_edolku";

// Koneksi dan memilih database di server
$connect=mysql_pconnect($server,$username,$password) or die("Koneksi gagal");
$pilih_db =mysql_select_db($database) or die("Database tidak bisa dibuka");
$kontak_kami=mysql_query("SELECT * FROM kontak ");
$k_k=mysql_fetch_array($kontak_kami);
?>
