<? 

if($_GET[bls]=='balas'){
?>
<form method="post" action="proseskomen.php?id_k=<?=$_GET[id_k]?>&id_p=<?=$_GET[id_p]?>&pilih=komen"><br />
  <div class="form-group">
    <label for="formGroupExampleInput">Nama</label>
    <input type="text"  name="nama" required="required" value="<?= $_SESSION[namamember] ?>" class="form-control" id="formGroupExampleInput" placeholder="input Nama">
  </div>
    <div class="form-group">
    <label for="formGroupExampleInput">Email</label>
    <input type="text" name="email" required="required" value="<?=$_SESSION[email]?>" class="form-control" id="formGroupExampleInput" placeholder="input Email">
  </div>
<div class="form-group">
    <label for="exampleFormControlTextarea1">Komentar</label>
    <textarea class="form-control" name="isi" id="exampleFormControlTextarea1" rows="3" required="required"></textarea>
  </div>
<input type="submit" class="btn btn-primary" value="Kirim"/>
</form>
<br />

<?
echo"
<div class='k_men'>	
<a href='index.php?l=lihat&aksi=detail&id_p=$_GET[id_p]' class='ada'>Kembali </a><br />
<br />
";

 $komentar = mysql_query("SELECT * FROM komentar WHERE id_prod=$_GET[id_p] AND id_komen=$_GET[id_km] ORDER BY id_komen DESC");
    if(mysql_num_rows($komentar) > 0){
        while($c=mysql_fetch_array($komentar)){
		$tgl_k=tgl_indo($c[tgl]); 
		

		$komen=wordwrap($c[komentar],90, "<br />\n", 1);
            echo "
		<div class='komentar_utama'>
		<span class='nama_k'>@$c[nama] </span><span class='isi_komen'>$komen</span>
		
		
		<div class='garis_k'>
		
		Pada : $tgl_k | $c[jam] </div>
		
		";
		
 $balasan = mysql_query("SELECT * FROM komentar WHERE id_prod=$_GET[id_p] AND jwb='1' and balas=$c[id_komen] ORDER BY id_komen DESC");
 $jml=mysql_num_rows($balasan);
    if($jml > 0){
	echo"
		
		<div class='garis_k2'>";
		  while($bl=mysql_fetch_array($balasan)){
		echo"<a >$bl[nama]</a>, 
		";
		}
		echo"Membalas
		 <a class='kanan_b'>Balasan ($jml)</a></div>	
";
}
echo"</div>";
$komentar2 = mysql_query("SELECT * FROM komentar WHERE id_prod=$_GET[id_p] AND balas=$c[id_komen] ORDER BY id_komen DESC");
    if(mysql_num_rows($komentar2) > 0){
        while($c2=mysql_fetch_array($komentar2)){
		$tgl_k2=tgl_indo($c2[tgl]); 
		

		$komen2=wordwrap($c2[komentar],80, "<br />\n", 1);
            echo "
		<div class='komentar_utama2'>
		<span class='nama_k'>@$c2[nama] </span><span class='isi_komen'>$komen2</span>
		
		
		<div class='garis_k'>
		<a href='index.php?l=lihat&aksi=detail&id_p=$_GET[id_p]&id_k=$_GET[id_k]&id_km=$c2[id_komen]&bls=balas'>Balas</a>&nbsp; &nbsp;
		Pada : $tgl_k2 | $c2[jam] </div>
		
		";
		
 $balasan = mysql_query("SELECT * FROM komentar WHERE id_prod=$_GET[id_p] AND jwb='1' and balas=$c2[id_komen] ORDER BY id_komen DESC");
 $jml=mysql_num_rows($balasan);
    if($jml > 0){
	echo"
		
		<div class='garis_k2'>";
		  while($bl=mysql_fetch_array($balasan)){
		echo"<a >$bl[nama]</a>, 
		";
		}
		echo" Membalas
		 <a class='kanan_b' href='index.php?l=lihat&aksi=detail&id_p=$_GET[id_p]&id_k=$_GET[id_k]&id_km=$c2[id_komen]&bls=balas'>Lihat Balasan ($jml)</a></div>
		
		
";
}
echo"</div>";
}
}
        }	
}
 
 ?>
</div>

<br />
<? }else{?>
<form method="post" action="proseskomen.php?id_p=<?=$_GET[id_p]?>&pilih=balas&id_km=<?=$_GET[id_km]?>"><br />
  <div class="form-group">
    <label for="formGroupExampleInput">Nama</label>
    <input type="text"  name="nama" required="required" value="<?= $_SESSION[namamember] ?>" class="form-control" id="formGroupExampleInput" placeholder="input Nama">
  </div>
    <div class="form-group">
    <label for="formGroupExampleInput">Email</label>
    <input type="text" name="email" required="required" value="<?=$_SESSION[email]?>" class="form-control" id="formGroupExampleInput" placeholder="input Email">
  </div>
<div class="form-group">
    <label for="exampleFormControlTextarea1">Komentar</label>
    <textarea class="form-control" name="isi" id="exampleFormControlTextarea1" rows="3" required="required"></textarea>
  </div>
<input type="submit" class="btn btn-primary" value="Kirim"/>
<br />
</form>
<br />
<div class='k_men'>
<? 


 $komentar = mysql_query("SELECT * FROM komentar WHERE id_prod=$_GET[id_p] AND jwb='0' ORDER BY id_komen DESC");
    if(mysql_num_rows($komentar) > 0){
        while($c=mysql_fetch_array($komentar)){
		$tgl_k=tgl_indo($c[tgl]); 

		$komen=wordwrap($c[komentar],90, "<br />\n", 1);
            echo "
		<div class='komentar_utama'>
		<span class='nama_k'>@$c[nama] </span><span class='isi_komen'>$komen</span>
		
		
		<div class='garis_k'><a href='index.php?l=lihat&aksi=detail&id_p=$_GET[id_p]&id_km=$c[id_komen]&bls=balas'>Balas</a>&nbsp; &nbsp;
		
		Pada : $tgl_k | $c[jam] </div>
		
		";
		
 $balasan = mysql_query("SELECT * FROM komentar WHERE id_prod=$_GET[id_p] AND jwb='1' and balas=$c[id_komen] ORDER BY id_komen DESC");
 $jml=mysql_num_rows($balasan);
    if($jml > 0){
	echo"
		
		<div class='garis_k2'>";
		  while($bl=mysql_fetch_array($balasan)){
		echo"<a >$bl[nama]</a>, 
		";
		}
		echo"Membalas
		 <a class='kanan_b' href='index.php?l=lihat&aksi=detail&id_p=$_GET[id_p]&id_km=$c[id_komen]&bls=balas'>Lihat Balasan ($jml)</a></div>
		
		
";
}

echo"</div>";
        }
	
}
 
 ?>
</div>

<? }?>