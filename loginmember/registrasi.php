<?
  session_start();	
  include "../config/koneksi.php";
	include "../config/fungsi_indotgl.php";
	include "../config/class_paging.php";
	include "../config/fungsi_combobox.php";
	include "../config/library.php";
  include "../config/fungsi_autolink.php";
  include "../config/fungsi_rupiah.php";
   $aksi=$_GET[aksi];
?><?
if($aksi=='registrasi'){
// Cek email kustomer di database
$cek_email=mysql_num_rows(mysql_query("SELECT email FROM kustomer WHERE email='$_POST[email]'"));
// Kalau email sudah ada yang pakai
if ($cek_email > 0){
echo "<div class='salah'>Maaf Email $_POST[email] Sudah Terdaftar</div>";
}
elseif($_POST[password] <=5){
echo "<div class='salah'>Password Yang Anda Masukan Lemah Minimal 6 Karakter</div>";
}
elseif($_POST[password]!=$_POST[password1]){
echo "<div class='salah'>Password Yang Anda Masukan Tidak Sama</div>";
}else{

$nama_lengkap = $_POST['nama1'] | $_POST['nama2'];
$email = $_POST['email'];
$password=md5($_POST['password']);
$date=date ('d/m/Y');

mysql_query("INSERT INTO kustomer(nama_lengkap, password, email,tgl) 
             VALUES('$_POST[nama1] $_POST[nama2]','$password','$email','$date')"); 
	
if($_GET[id_p]!=''){
 echo "<script>window.location=('login.php?aksi=berhasil&id_p=$_GET[id_p]')</script>";
}else{
echo "<script>window.alert('Pendaftaran Berhasil Silahkan Login');
        window.location=('javascript:history.go(-2)')</script>";
} 

}

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Daftar Member Baru Indra Toys</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body >

<link rel="stylesheet" href="registrasi_files/formoid1/formoid-metro-cyan.css" type="text/css" />
<script type="text/javascript" src="registrasi_files/formoid1/jquery.min.js"></script>

<!-- Start Formoid form-->

<form class="formoid-metro-cyan" style="background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:480px;min-width:150px" method="post" action="?aksi=registrasi&id_p=<?=$_GET[id_p]?>">

<div class="title"><h2>Daftar Member Baru</h2></div>
	<div class="element-name"><label class="title">Nama<span class="required">*</span></label><span class="nameFirst">
<input  type="text" size="8" name="nama1" value='<?=$_POST[nama1]?>' onKeyUp="this.value=this.value.replace(/[^A-Z | a-z]/g,'')" required="required"/><label class="subtitle">Nama Depan</label></span><span class="nameLast">
<input  type="text" size="14" name="nama2" value='<?=$_POST[nama2]?>' required="required" onKeyUp="this.value=this.value.replace(/[^A-Z | a-z]/g,'')" /><label class="subtitle">Nama Belakang</label></span></div>
	<div class="element-email"><label class="title">Email<span class="required">*</span></label>
	<input class="large" type="email" name="email" value="<?=$_POST[email]?>" required="required"/></div>
	<div class="element-password"><label class="title">Password<span class="required">*</span></label><input class="large" type="password" name="password" value="" required="required"/></div>
	<div class="element-password"><label class="title">Ulangi Password<span class="required">*</span></label><input class="large" type="password" name="password1" value="" required="required"/></div>
<div class="submit"><input type="submit" value="Registrasi"/></div></form>

<script type="text/javascript" src="registrasi_files/formoid1/formoid-metro-cyan.js"></script>
<!-- Stop Formoid form-->



</body>
</html>
