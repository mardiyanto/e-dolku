		<div class="sidecont rightsector">
		
	<div class="sidebar">
<div class="sidebarvideo">
    			<ul> <li><h2 style="margin-bottom: 7px;">Keranjang Belanja</h2>
    			<?php require_once "item.php";?>
				<div id="google_translate_element"><script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script></div>
<?php if( $_SESSION['kustomer']==''){?>

 <?php }else{?>
 <?php 
$order=mysqli_query($koneksi, "SELECT COUNT(id_kustomer) as Od  FROM orders WHERE id_kustomer=$_SESSION['kustomer']");
$Od=mysqli_fetch_array($order);
		?>
 <li><a href='index.php?l=lihat&aksi=pesanansaya'>Pesanan Saya <b>(<?=$Od['Od']?>)</b></a></li> 

 <li><a href='index.php?l=lihat&aksi=editpengiriman'> Edit Pengiriman</a></li>
<li><a href='index.php?l=lihat&aksi=gantilogin'> Edit Paswd</a></li>
 <li><a class="off" href='logout.php'>Keluar</a></li>
	
 <?php }?>

    			</li>
    			</ul>
    		</div>
    	        
<ul>
<li id="text-2" class="widget widget_text"><h2 class="widgettitle">Kategori</h2><ul>			
				<?php
			  
            $kategori=mysqli_query($koneksi, "select nama_kategori, kategori.id_kategori,  
                                  count(produk.id_produk) as jml 
                                  from kategori left join produk 
                                  on produk.id_kategori=kategori.id_kategori 
                                  group by nama_kategori");
          
            while($k=mysqli_fetch_array($kategori)){
            echo"
			<li><a href='index.php?l=lihat&aksi=kategori&id_k=$k[id_kategori]'> $k[nama_kategori] ($k[jml])</a></li>
			";
			}
			?></ul>

</li>		


		<li id="recent-posts-2" class="widget widget_recent_entries">		
		<h2 class="widgettitle">Sering Di beli</h2><ul>
<?php
      $best=mysqli_query($koneksi, "SELECT * FROM produk ORDER BY dibeli DESC LIMIT 3");
      while($a=mysqli_fetch_array($best)){
        $harga = format_rupiah($a['harga']);
		    echo "<li>
<a href='#'><img width='60' height='60' src='foto/foto_produk/$a[gambar]' class='alignleft popular-sidebar wp-post-image' alt='isi' /></a>
<span style='padding-top:0px;float:left; width:185px;'>
<a style='float:left; font-weight:bold; width:185px; padding-top:5px;' title='isi' href='index.php?l=lihat&aksi=detail&id_p=$a[id_produk]'>$a[nama_produk]</a>
<br/>Rp.$harga</span>
<div class='clear'></div>
</li>";
      }

        ?>
				</ul>
		</li>
		<li id="archives-2" class="widget widget_archive"><h2 class="widgettitle">Statistik User</h2>		<ul>
        	              <?php
$ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
$tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
$waktu   = time(); // 

// Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini 
$s = mysqli_query($koneksi, "SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
// Kalau belum ada, simpan data user tersebut ke database
if(mysqli_num_rows($s) == 0){
  mysqli_query($koneksi, "INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
} 
else{
  mysqli_query($koneksi, "UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
}

$pengunjung       = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip"));
$totalpengunjung  = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(hits) FROM statistik"))[0]; 
$hits             = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal")); 
$totalhits        = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(hits) FROM statistik"))[0]; 
$tothitsgbr       = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(hits) FROM statistik"))[0]; 
$bataswaktu       = time() - 300;
$pengunjungonline = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM statistik WHERE online > '$bataswaktu'"));
$a=number_format($pengunjung,0,",",".");
$b=number_format($totalpengunjung,0,",",".");
$c=number_format($hits['hitstoday'],0,",",".");
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
</li>		

		<li id="recent-posts-2" class="widget widget_recent_entries">		
		<h2 class="widgettitle">Tentang Toko Kami</h2>
		<ul><br>
		<div class='well well-small'>
		<a id='myCart' href='index.php?l=lihat&aksi=kontak'><i class="fa fa-plus-square-o fa-fw fa-2x"></i>Kontak Kami </a>
		</div>
			
		<div class='well well-small'>
		<a id='myCart' href='index.php?l=lihat&aksi=profil&id_p=2'>
		<i class="fa fa-cog fa-fw fa-2x"></i>Cara belanja</a>
		</div>
  
		<div class='well well-small'>
		<a id='myCart' href='index.php?l=lihat&aksi=carabayar'>
		<i class="fa fa-usd fa-fw fa-2x"></i>Cara Bayar</a>
		</div>
  	<div class='well well-small'>
		<a id='myCart' href='index.php?l=lihat&aksi=ongkir'>
		<i class="fa fa-truck fa-fw fa-2x"></i>Cek Ongkos Kirim</a>
		</div>
				</ul>
		</li>


</ul>
        
        
				
			</div>
</div>