<?php
session_start();
include "config/koneksi.php";
include "config/library.php";
$tgl=date ('d/m/Y');
$dt=date ('h:i A');
$nama=trim($_POST['nama']);
$komentar=trim(strip_tags($_POST['isi']));
$kar1=strstr($_POST[email], "@");
$kar2=strstr($_POST[email], ".");

if (empty($_POST[nama]) || empty($_POST[email]) || empty($_POST[isi])){
  echo "<script>window.alert('Data yang Anda isikan belum lengkap');
        window.location=('javascript:history.go(-1)')</script>";
     }
elseif (!ereg("[a-z|A-Z]","$_POST[nama]")){
echo "<script>window.alert('Nama tidak boleh diisi dengan angka atau simbol');
        window.location=('javascript:history.go(-1)')</script>";
     }

elseif (strlen($_POST['isi']) > 300) {
 echo "<script>window.alert('Isi terlalu panjang');
        window.location=('javascript:history.go(-1)')</script>";

}

elseif (strlen($kar1)==0 OR strlen($kar2)==0){
  echo "<script>window.alert('Alamat email Anda tidak valid');
        window.location=('javascript:history.go(-1)')</script>";
 
 }
else{
function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}

$nama_komentar = antiinjection($_POST['nama']);
$isi_komentar = antiinjection($_POST['isi']);

	if(!empty($_POST['kode'])){
		if($_POST['kode']==$_SESSION['captcha_session']){

// Mengatasi input komentar tanpa spasi
$split_text = explode(" ",$isi_komentar);
$split_count = count($split_text);
$max = 57;

for($i = 0; $i <= $split_count; $i++){
if(strlen($split_text[$i]) >= $max){
for($j = 0; $j <= strlen($split_text[$i]); $j++){
$char[$j] = substr($split_text[$i],$j,1);
if(($j % $max == 0) && ($j != 0)){
  $v_text .= $char[$j] . ' ';
}else{
  $v_text .= $char[$j];
}
}
}else{
  $v_text .= " " . $split_text[$i] . " ";
}
}

    $sql = mysql_query("INSERT INTO komentar(nama_komentar,email,isi_komentar,tgl,jam_komentar) 
                        VALUES('$nama_komentar','$_POST[email]','$komentar','$tgl','$dt')");

    header('Location:index.php?l=lihat&aksi=testi');
		}else{
		 echo "<script>window.alert('Kode yang Anda masukkan tidak cocok');
        window.location=('javascript:history.go(-1)')</script>";
			
		}
	}else{
	 echo "<script>window.alert('Anda belum memasukkan kode');
        window.location=('javascript:history.go(-1)')</script>";
		
	}
}
?>
