<? 

if($_GET[bls]=='balas'){
echo"<a href='index.php?l=lihat&aksi=testi' class='ada'>Kembali </a><br />
<br />
";
echo"<div class='row'><div class='card border-ligh col-sm-6'>
  <div class='card-body'> ";	
 $komentar = mysql_query("SELECT * FROM komentar WHERE id_prod='0' AND id_komen=$_GET[id_km] ORDER BY id_komen DESC");
    if(mysql_num_rows($komentar) > 0){
        while($c=mysql_fetch_array($komentar)){
	

		$komen=wordwrap($c[komentar],90, "<br />\n", 1);
            echo "
		<div class='komentar_utama'>
		<span class='nama_k'>@$c[nama] </span><span class='isi_komen'>$komen</span>
		
		
		<div class='garis_k'>
		
		Pada : $c[tgl] | $c[jam] </div>
		
		";
		
 $balasan = mysql_query("SELECT * FROM komentar WHERE id_prod='0' AND jwb='1' and balas=$c[id_komen] ORDER BY id_komen DESC");
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


$komentar2 = mysql_query("SELECT * FROM komentar WHERE id_prod='0' AND balas=$c[id_komen] ORDER BY id_komen DESC");
    if(mysql_num_rows($komentar2) > 0){
        while($c2=mysql_fetch_array($komentar2)){
		

		$komen2=wordwrap($c2[komentar],80, "<br />\n", 1);
            echo "
		<div class='komentar_utama2'>
		<span class='nama_k'>@$c2[nama] </span><span class='isi_komen'>$komen2</span>
		
		
		<div class='garis_k'>
		<a href='index.php?l=lihat&aksi=testi&id_km=$c2[id_komen]&bls=balas'>Balas</a>&nbsp; &nbsp;
		Pada : $c2[tgl] | $c2[jam] </div>
		
		";
		
 $balasan = mysql_query("SELECT * FROM komentar WHERE id_prod='0' AND jwb='1' and balas=$c2[id_komen] ORDER BY id_komen DESC");
 $jml=mysql_num_rows($balasan);
    if($jml > 0){
	echo"
		
		<div class='garis_k2'>";
		  while($bl=mysql_fetch_array($balasan)){
		echo"<a >$bl[nama]</a>, 
		";
		}
		echo" Membalas
		 <a class='kanan_b' href='index.php?l=lihat&aksi=testi&id_km=$c2[id_komen]&bls=balas'>Lihat Balasan ($jml)</a></div>
		
		
";
}

echo"</div>";
}


}



        }
	
}
 echo"</div></div>";
 ?>
<div class='card border-ligh col-sm-6'>
  <div class='card-body'> 
<form  method="post" action="proseskomen.php?pilih=balastesti&id_km=<?=$_GET[id_km]?>">
	<div class="element-input"><label class="title">Nama<span class="required">*</span></label>
	<input class="form-control"  type="text" name="nama" required="required" value="<?= $_SESSION[namamember] ?>"/></div>
	<div class="element-email"><label class="title">Email<span class="required">*</span></label>
	<input class="form-control"  type="email" name="email" required="required" value="<?=$_SESSION[email]?>"/></div>
	<div class="element-textarea"><label class="title">Komentar<span class="required">*</span></label><textarea class="form-control"  name="isi" cols="20" rows="5" required="required"></textarea></div>
<br />
	<input class="btn btn-primary" type="submit" value="Kirim"/>
<br />
</form>
</div>
</div>
</div>
<? }else{?>

<? 
echo"<div class='row'><div class='card border-ligh col-sm-6'>
  <div class='card-body'> ";	
  $p      = new Paging2;
  $batas  = 6;
  $posisi = $p->cariPosisi($batas);
 $komentar = mysql_query("SELECT * FROM komentar WHERE id_prod='0' AND jwb='0' ORDER BY id_komen DESC  LIMIT $posisi,$batas");
 	$jmldata     = mysql_num_rows(mysql_query("SELECT * FROM komentar WHERE id_prod='0' AND jwb='0' "));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    if(mysql_num_rows($komentar) > 0){
        while($c=mysql_fetch_array($komentar)){
		

		$komen=wordwrap($c[komentar],90, "<br />\n", 1);
            echo "
		<div class='komentar_utama'>
		<span class='nama_k'>@$c[nama] </span><span class='isi_komen'>$komen</span>
		
		
		<div class='garis_k'><a href='index.php?l=lihat&aksi=testi&id_km=$c[id_komen]&bls=balas'>Balas</a>&nbsp; &nbsp;
		
		Pada : $c[tgl] | $c[jam] </div>
		
		";
		
 $balasan = mysql_query("SELECT * FROM komentar WHERE id_prod='0' AND jwb='1' and balas=$c[id_komen] ORDER BY id_komen DESC");
 $jml=mysql_num_rows($balasan);
    if($jml > 0){
	echo"
		
		<div class='garis_k2'>";
		  while($bl=mysql_fetch_array($balasan)){
		echo"<a >$bl[nama]</a>, 
		";
		}
		echo"Membalas
		 <a class='kanan_b' href='index.php?l=lihat&aksi=testi&id_km=$c[id_komen]&bls=balas'>Lihat Balasan ($jml)</a></div>
		
		
";
}

echo"</div>";
   
	
}
 if($jmldata >= $batas){ echo"
		 <div class='navi' align='center' >$linkHalaman </div><br />";}
		 
 }
 echo"</div></div>";
 ?>
<div class='card border-ligh col-sm-6'>
  <div class='card-body'>
<form  method="post" action="proseskomen.php?pilih=komentesti">
	<div class="element-input"><label class="title">Nama<span class="required">*</span></label>
	<input class="form-control"  type="text" name="nama" required="required" value="<?= $_SESSION[namamember] ?>"/></div>
	<div class="element-email"><label class="title">Email<span class="required">*</span></label>
	<input class="form-control"  type="email" name="email" required="required" value="<?=$_SESSION[email]?>"/></div>
	<div class="element-textarea"><label class="title">Komentar<span class="required">*</span></label><textarea class="form-control"  name="isi" cols="20" rows="5" required="required"></textarea></div>
<br />
	<input class="btn btn-primary" type="submit" value="Kirim"/>
<br />
</form>
 </div>
</div>
</div>
<? }?>











				  </div>