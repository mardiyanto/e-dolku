<?php 
  session_start();	
  include "config/koneksi.php";
	include "config/fungsi_indotgl.php";
	include "config/class_paging.php";
	include "config/fungsi_combobox.php";
	include "config/library.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_rupiah.php";
   $aksi=$_GET[aksi];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? if(empty($_GET[nama])){echo"Selamat Datang Ditoko $k_k[nama_perusahaan]";}else{echo"$_GET[nama]";}?></title>
<link rel="stylesheet" href="tema/lib/css/reset.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="tema/lib/css/defaults.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="tema/style.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="tema/css/slimbox2.css" type="text/css" media="screen" /> 
<link href="tema/tms.css" rel="stylesheet"></style>
<script  src="tema/js/slimbox2.js" type="text/JavaScript"></script>
<script src="tema/js/jquery-1.4.4.js" type="text/javascript"></script>
<script src="tema/js/jquery.cycle.all.js" type="text/javascript"></script>
<script type='text/javascript'>
/* <![CDATA[ */
jQuery(document).ready(function() {
	jQuery('.fp-slides').cycle({
		fx: 'curtainX',
		timeout: 4000,
		delay: 0,
		speed: 400,
		next: '.fp-next',
		prev: '.fp-prev',
		pager: '.fp-pager',
		continuous: 0,
		sync: 1,
		pause: 1,
		pauseOnPagerHover: 1,
		cleartype: true,
		cleartypeNoBg: true
	});
 });

/* ]]> */
</script>
<link rel="Shortcut Icon" href="images/faticon.ico"  type="image/x-icon" />
</head>
<body class="home blog page-builder">

<div id="container">
    <div class="clearfix">
               <!--.primary menu--> 	
    </div>
	<div id="header">
    
        <div class="logo">
         
            
         
        </div><!-- .logo -->

        <div class="header-right">
 
        </div><!-- .header-right -->
        
    </div><!-- #header -->
     			<div class="menu-primary-container">
					<ul id="menu-atas" class="menus menu-primary">

						  <li><a href="index.php">Beranda </a></li>
<li ><a href="?l=lihat&aksi=profil&id_p=4" >Profil Kami</a>
	<ul>
<li><a href="?l=lihat&aksi=profil&id_p=4">Profil</a></li>
 <li> <a href="index.php?l=lihat&aksi=kontak">Kontak Kami</a></li>
 <li  ><a href="cara-bayar.html">Cara Bayar</a></li>
	</ul>

</li>

<li  ><a href="login.html">Member</a><ul><li  ><a href="konfirmasi.html">konfirmasi</a></li></ul></li>
 <!--.primary <li><a href="ongkir.html">Ongkos Kirim</a></li> menu-->
<!--.primary <li><a href="testimonial.php">Buku Tamu</a></li>menu-->
<li><a href="Contacts.html">Buku Tamu</a></li>
	
</ul></div>   
	
			
      
   <div id="main">
        <div id="content"> 				
						<? if($_GET[l]=='lihat'){include"utama.php";}
			   else{include"tengah.php";}
			?>
						</div><!-- #content -->
<!--bagian kiri-->
            <?php include "kanan.php";?>
    	
<!--bagian bawah-->
   <!-- #sidebar-secondary -->        
                
    </div><!-- #main -->
<div id="footer-widgets" class="clearfix">
                <div class="footer-widget-box">
                    <ul class="widget-container"><li class="posts-widget">
             <h3 class="widgettitle">Kalender</h3>             <ul>
        	              <?php include "kalender/index.php" 
  ?>
								
								</ul>
        </li></ul>
                </div>
        
        <div class="footer-widget-box">
            <ul class="widget-container"><li id="calendar-3" class="widget widget_calendar"><div id="calendar_wrap">
			<h3 class="widgettitle">Statistik</h3>             <ul>
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

$path = "foto/conter/";
$ext = ".png";

$tothitsgbr = sprintf("%06d", $tothitsgbr);
for ( $i = 0; $i <= 9; $i++ ){
	$tothitsgbr = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $tothitsgbr);
}

echo "
<table border='0' cellpadding='0' cellspacing='0' width=100%>
  <tr>
    <td><img src='foto/conter/hariini.png' width=13 height=13 /> Pengunjung Hari ini<br></td>
    <td>:</td>
    <td align='right' class='tgl'>$a</td>
  </tr>
  <tr>
    <td><img src='foto/conter/hariini.png' width=13 height=13/> Hits hari ini </td>
    <td>:</td>
    <td align='right' class='tgl'>$c</td>
  </tr>
  <tr>
    <td><img src='foto/conter/total.png' width=13 height=13 /> Total Pengunjung </td>
    <td>:</td>
    <td align='right' class='tgl' >$b</td>
  </tr>
  <tr>
    <td><img src='foto/conter/total.png' width=13 height=13/> Total Hits </td>
    <td>:</td>
    <td align='right' class='tgl'>$d</td>
  </tr>
  <tr>
    <td><img src='foto/conter/online.png' width=13 height=13/> Yang sedang Online</td>
    <td>:</td>
    <td align='right'class='tgl'>$e</td>
  </tr>
</table><br />
<div align='center'>$tothitsgbr </div>";

?>
      
								</ul>
			
			</div></li></ul>        </div>
    
        <div class="footer-widget-box">
            <ul class="widget-container"><li id="calendar-3" class="widget widget_calendar"><div id="calendar_wrap">
			<h3 class="widgettitle">Tentang Toko Kami</h3>             <ul>
        	              <?php $identitas=mysql_query("SELECT * FROM modul WHERE id_modul='43' ");
  while($a=mysql_fetch_array($identitas)){
  
  echo" <br>$a[meta_deskripsi]<br /><br />
<strong>Alamat dan detail toko kami :</strong><br />
$a[meta_keyword]<br />
Telphone: $a[nomor_hp] <br />
Email:  $a[email_pengelola]<br />";
 }
  ?>
								
								</ul>
			
			</div></li></ul>        </div>
    
        <!--[jika ingin membuak baner]><div class="footer-widget-box footer-widget-box-last">
            
		<ul class="widget-container"><li id="bunyad_about_widget-2" class="widget bunyad-about">			
		<h3 class="widgettitle">link</h3>		
			<div class="about-widget">
			<?php
				// Banner
$qbanner=mysql_num_rows(mysql_query("select * from modul where nama_modul='Banner' and publish='Y'"));
// Apabila modul banner diaktifkan Publish=Y, maka tampilkan modul Banner max 4 buah
if ($qbanner > 0){
  
  $banner=mysql_query("SELECT * FROM banner ORDER BY id_banner DESC LIMIT 4");
  while($b=mysql_fetch_array($banner)){
    echo "<a href=$b[url] target='_blank' title='$b[judul]'><img src='foto_banner/$b[gambar]' border=0></a>";
  }
}
?>		
						
			</div>
		
		</li></ul>		
		        </div><![slesai]-->
        
    </div>

    <div id="footer">
    
        <div id="copyrights">
            Copyright, <a href="index.php"><?=$k_k[nama_perusahaan]?></a>, Networks All Rights Reserved.</div>
    </div><!-- #footer -->
    
</div><!-- #container -->



</body>
</html>
