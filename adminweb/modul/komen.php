<?
  include "../../config/koneksi.php";
$tgl=date ('d/m/Y');
$dt=date ('h:i A');
$pilih=$_GET[pilih];
/*if($_POST[cek]!='yes'){
 header("location:beranda.php?aksi=bukutamu&cek=spam&nama=$_POST[nama]"); 
}else{ */
if($pilih=='balas'){
$isi=trim(strip_tags($_POST['isi']));
  $bls = mysql_query("SELECT * FROM komentar WHERE id_komen=$_GET[id_km]");
   $bl=mysql_fetch_array($bls);
   if($bl[balas]==0){$bk="$_GET[id_km]";}else{$bk="$bl[balas]";}
	  
 mysql_query("INSERT INTO komentar(id_prod,jwb,balas,nama,nm_bls,email,komentar,tgl,jam,admin)
		   								VALUES('$_GET[id]',
											   '1',
											   '$bk',
											   '$_POST[nama]',
											   '$_POST[bls]',
											   '$_POST[email]',
											   '$isi',
											   '$tgl',
											   '$dt','Y')");
if($_GET[id]==0){
header("location:../index.php?aksi=pesan"); 
}else{
header("location:../index.php?aksi=komentar"); }
}
elseif($pilih=='hapus'){
mysql_query("DELETE FROM komentar WHERE id_komen='$_GET[id_k]'"); 
if($_GET[id]==0){
echo "<script>window.location=('../index.php?aksi=pesan')</script>";
}else{
echo "<script>window.location=('../index.php?aksi=komentar')</script>";
}
}

?>