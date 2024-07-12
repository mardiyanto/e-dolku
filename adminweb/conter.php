<?
$tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
$waktu   = time(); // 


$pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip"));
$totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM statistik"), 0); 
$hits             = mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal")); 
$totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
$tothitsgbr       = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
$bataswaktu       = time() - 300;
$pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE online > '$bataswaktu'"));
$a7=number_format($pengunjung,0,",",".");
$b7=number_format($totalpengunjung,0,",",".");
$c7=number_format($hits[hitstoday],0,",",".");
$d7=number_format($totalhits,0,",",".");
$e7=number_format($pengunjungonline,0,",",".");


?>
      