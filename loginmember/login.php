<?php 
  session_start();	
  include "../config/koneksi.php";
	include "../config/fungsi_indotgl.php";
	include "../config/class_paging.php";
	include "../config/fungsi_combobox.php";
	include "../config/library.php";
  include "../config/fungsi_autolink.php";
  include "../config/fungsi_rupiah.php";
   $aksi=$_GET[aksi];
   $s=$_GET[s];

if($aksi=='login'){
$email = $_POST['email'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM	kustomer WHERE BINARY email='$email' AND password='$password'";
$hasil = mysql_query($sql);
$r = mysql_fetch_array($hasil);

if(mysql_num_rows($hasil) == 0){

echo "<div class='salah'>Email atau Password yang anda masukan salah</div>";
}
else{
    $_SESSION[kustomer]  = $r[id_kustomer];
    
    $_SESSION[namamember]  = $r[nama_lengkap];
    $_SESSION[email]  = $r[email];
    $_SESSION[pass]     = $r[password];
    $_SESSION[alamat]  = $r[alamat];
    $_SESSION[hp]  =$r[telpon];
	 $_SESSION[kota]  =$r[id_kota];

if($_GET[id_p]!=''){
 echo "<script>window.location=('../index.php?l=lihat&aksi=simpan&id_p=$_GET[id_p]')</script>";
}else{
echo "<script>window.location=('../index.php')</script>";
}   
   
  }
   
 }  
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Login Member Indra Toys</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="login_files/formoid1/formoid-metro-cyan.css" type="text/css" />
<script type="text/javascript" src="login_files/formoid1/jquery.min.js"></script>
</head>

<body >

<!-- Start Formoid form-->

<? 
if($aksi=='berhasil'){
echo "<div class='benar'>Pendaftaran Berhasil Silahkan Login</div>";
}
if($s=='whis'){
echo "<div class='benar'>Login Untuk Memasukan Produk Kedaftar Keinginan</div>";
}

?>

<form class="formoid-metro-cyan" style="background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:400px;min-width:150px" method="post" action="?aksi=login&id_p=<?=$_GET[id_p]?>">

<div class="title"><h2>Login Member</h2></div>
<div class="element-email"><label class="title">Email<span class="required">*</span></label>
<input class="large" type="email" name="email" value="" required="required"/></div>
<div class="element-password"><label class="title">Password<span class="required">*</span></label><input class="large" type="password" name="password" value="" required="required"/>
</div>
<div class="submit"><input type="submit" value="Masuk"/></div>

<div class="akun">Belum Menjadi Member <a href="registrasi.php?id_p=<?=$_GET[id_p]?>">Klik Disini</a></div>
</form>

<script type="text/javascript" src="login_files/formoid1/formoid-metro-cyan.js"></script>
<!-- Stop Formoid form-->



</body>
</html>
