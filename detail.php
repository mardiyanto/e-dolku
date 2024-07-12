<style>
body{
	background-image:url(images/bg-body.jpg);
	background-repeat:repeat-x;
	background-attachment:fixed;
	background-position:bottom;
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
}
h2{
	font-size:14px;
	padding:0px;
	margin:0px;
	font-weight:bold;
	color:#666666;
}
h3{
	font-size:11px;
	font-weight:normal;
	color:#666666;
	margin-top:0px;
}
.gambar{
padding:5px;
background-color:#CCCCCC;
border:1px dashed #000;
	-moz-border-radius:4px;
	-khtml-border-radius: 4px;
	-webkit-border-radius: 4px;
	margin:5px;
	float:left;
}
</style>
<?php
require_once('config/koneksi.php');
?>
<?
$query=mysql_query("select * from produk where id_produk='$_GET[id]'");
$no=1;
while($r=mysql_fetch_array($query)){
 $hg=number_format($r[harga],0,',','.');
echo"<img src='foto/foto_produk/$r[gambar]' class='gambar' height='190' width='140'>";
echo"<h2>$r[nama_produk]</h2>";
echo"<strong>Harga Rp.$hg</strong> <i>(belum termasuk ongkir)</i><br />";
echo"<strong>Stok $r[stok] Buah</strong> <br />";
echo"<strong>Berat $r[berat]Kg</strong> <br /><br />";
echo"<b>Keterangan</b><br>$r[deskripsi]";
}
?>
