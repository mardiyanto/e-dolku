<?
$ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
$tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
$waktu   = time(); // 

// Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini 
$s = mysql_query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
// Kalau belum ada, simpan data user tersebut ke database
if(mysql_num_rows($s) == 0){
  mysql_query("INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
} 
else{
  mysql_query("UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
}

$pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip"));
$totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM statistik"), 0); 
$hits             = mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal")); 
$totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
$tothitsgbr       = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
$bataswaktu       = time() - 300;
$pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE online > '$bataswaktu'"));
$a=number_format($pengunjung,0,",",".");
$b=number_format($totalpengunjung,0,",",".");
$c=number_format($hits[hitstoday],0,",",".");
$d=number_format($totalhits,0,",",".");
$e=number_format($pengunjungonline,0,",",".");

$path = "gambar/conter/";
$ext = ".png";

$tothitsgbr = sprintf("%06d", $tothitsgbr);
for ( $i = 0; $i <= 9; $i++ ){
	$tothitsgbr = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $tothitsgbr);
}

echo "
<table border='0' cellpadding='0' cellspacing='0' width=100%>
  <tr>
    <td><img src='gambar/conter/hariini.png' /> Pengunjung Hari ini<br></td>
    <td>:</td>
    <td align='right'>$a</td>
  </tr>
  <tr>
    <td><img src='gambar/conter/hariini.png' /> Hits hari ini </td>
    <td>:</td>
    <td align='right'>$c</td>
  </tr>
  <tr>
    <td><img src='gambar/conter/total.png' /> Total Pengunjung </td>
    <td>:</td>
    <td align='right'>$b</td>
  </tr>
  <tr>
    <td><img src='gambar/conter/total.png' /> Total Hits </td>
    <td>:</td>
    <td align='right'>$d</td>
  </tr>
  <tr>
    <td><img src='gambar/conter/online.png' /> Yang sedang Online</td>
    <td>:</td>
    <td align='right'>$e</td>
  </tr>
</table><br />

<p align=center>$tothitsgbr </p>";

?>
      