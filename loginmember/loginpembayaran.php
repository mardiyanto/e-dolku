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

echo "<script>window.location=('?R=R')</script>";
   
  }
 }  
if($aksi=='pesan'){
if( $_SESSION[kustomer] ==''){
echo "<script>window.location=('?R=L')</script>";
}else{

if ($_POST[kota]=='null'){
echo "<script>window.alert('Kota Belum Dipilh');
        window.location=('javascript:history.go(-1)')</script>";

}
elseif ($_POST[MT]=='null'){
echo "<script>window.alert('Metode Tranfer Belum Dipilh');
        window.location=('javascript:history.go(-1)')</script>";

}
elseif ($_POST[bank]=='null'){
echo "<script>window.alert('Tranfer Bank Belum Dipilh');
        window.location=('javascript:history.go(-1)')</script>";
	}
else{
mysql_query("UPDATE kustomer SET       
                          nama_lengkap='$_POST[NM]',
						   alamat='$_POST[ALM]',
						   kd_pos='$_POST[KD]',
						   telpon='$_POST[HP]',
						   id_kota='$_POST[kota]',
						   no_bank='$_POST[bank]',
						   m_transfer='$_POST[MT]'
						   WHERE id_kustomer='$_SESSION[kustomer]'");
						   

function isi_keranjang(){
	$isikeranjang = array();
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp WHERE id_session='$sid'");
	
	while ($r=mysql_fetch_array($sql)) {
		$isikeranjang[] = $r;
	}
	return $isikeranjang;
}

$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");

$id = mysql_fetch_array(mysql_query("SELECT id_kustomer FROM kustomer WHERE email=' $_SESSION[email]' AND password='$_SESSION[pass]'"));

// mendapatkan nomor kustomer
$id_kustomer=$_SESSION[kustomer] ;

// simpan data pemesanan 
mysql_query("INSERT INTO orders(tgl_order,jam_order,id_kustomer) VALUES('$tgl_skrg','$jam_skrg','$id_kustomer')");

  
// mendapatkan nomor orders
$id_orders=mysql_insert_id();

// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
$isikeranjang = isi_keranjang();
$jml          = count($isikeranjang);

// simpan data detail pemesanan  
for ($i = 0; $i < $jml; $i++){
  mysql_query("INSERT INTO orders_detail(id_orders, id_produk, jumlah) 
               VALUES('$id_orders',{$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['jumlah']})");
}
  
// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
for ($i = 0; $i < $jml; $i++) {
  mysql_query("DELETE FROM orders_temp
	  	         WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
}
           
echo "<script>window.location=('../index.php?l=lihat&aksi=detailorder&id=$id_orders')</script>";
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
	<link rel="stylesheet" href="login_files/formoid1/formoid-metro-cyan2.css" type="text/css" />
<script type="text/javascript" src="login_files/formoid1/jquery.min.js"></script>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>

<body class="blurBg-false" style="	background-color: #5cc6f0;
	background-image: url(../assets/images/bg.jpg);
	background-repeat: repeat-x;">

<!-- Start Formoid form-->
<? if($_GET[R]=='L'){?>
<div class='pembayaran'>
<div class="Grup">
<li class="W">1. Login Anggota</li>
<li class="K">2. Pengiriman dan Pembayaran </li>
</div></div>

<form class="formoid-metro-cyan" style="background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:400px;min-width:150px" method="post" action="?aksi=login&R=L">

<div class="title"><h2>Masuk</h2></div>
<div class="element-email"><label class="title">Email<span class="required">*</span></label>
<input class="large" type="email" name="email" value="<?=$_SESSION[email] ?>" required="required"/></div>
<div class="element-password"><label class="title">Password<span class="required">*</span></label><input class="large" type="password" name="password" value="" required="required"/>
</div>
<div class="submit"><input type="submit" value="Lanjutkan"/></div>

<div class="akun">Belum Menjadi Member <a href="registrasi.php">Klik Disini</a></div>
</form>

<? 

}

if($_GET[R]=='R'){
if( $_SESSION[kustomer] ==''){
echo "<script>window.location=('?R=L')</script>";
}else{
?>

<div class='pembayaran'>
<div class="Grup">
<li class="K">1. Login Anggota</li>
<li class="W">2. Pengiriman dan Pembayaran </li>
</div></div>

<div class="tengah">
<div class="kiri">
<?
$member = mysql_query("SELECT * FROM kustomer WHERE id_kustomer='$_SESSION[kustomer]' ");
$dm=mysql_fetch_array($member);
?>
<form class="formoid-metro-cyan" style="background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#000000;max-width:400px;min-width:150px" method="post" action="?aksi=pesan"><div class="title"><h2>Informasi Pengiriman</h2></div>
	<div class="element-input">
	<label class="title">Nama Lengkap<span class="required">*</span></label>
	<input class="large" type="text" name="NM" value="<?=$dm[nama_lengkap]?>" required="required"/>
	</div>
	
	<div class="element-number">
	<label class="title">Kode Post<span class="required">*</span></label>
	<input class="large" type="text" onKeyUp="this.value=this.value.replace(/[^0-9]/g,'')"  name="KD" required="required" value="<?=$dm[kd_pos]?>"/>			      </div>
	
	<div class="element-select">
	<label class="title">Kota<span class="required">*</span></label><div class="large"><span>

	<select name="kota" required="required">
      <option value="" selected>--- Pilih Kota ---</option>
	  <?
      $tampil=mysql_query("SELECT * FROM kota ORDER BY id_kota ASC");
      while($r=mysql_fetch_array($tampil)){
         echo "<option value=$r[id_kota]>$r[nama_kota]</option>";
      }?>
	</select>
	<i></i></span></div></div>
	
	<div class="element-input">
	<label class="title">Alamat<span class="required">*</span></label>
	<input class="large" type="text" value="<?=$dm[alamat]?>" name="ALM" required="required"/>
	</div>
	
	<div class="element-number">
	<label class="title">Telphone<span class="required">*</span></label>
	<input class="large" type="text" value="<?=$dm[telpon]?>" onKeyUp="this.value=this.value.replace(/[^0-9]/g,'')" name="HP" required="required" />
	</div>
	
	<div class="element-email">
	<label class="title">Email<span class="required">*</span></label>
	<input class="large" type="email" name="email" value="<?=$dm[email]?>" required="required"/>
	</div>
	
	<div class="element-select">
	<label class="title">Metode Tranfer<span class="required">*</span></label><div class="large"><span>		
	    <select name="MT" required="required">
		 <option value="" selected>--- Metode Tranfer ---</option>
		<option value="ATM">ATM</option>
		<option value="E-Banking">E-Banking</option>
		<option value="Counter Bank">Counter Bank</option>
		<option value="M-Banking">M-Banking</option>
		</select>
		<i></i></span></div></div>
		
	<div class="element-select">
	<label class="title">Tranfer Ke Bank<span class="required">*</span></label><div class="large"><span>
	<select name="bank" required="required">
      <option value="" selected>--- Pilih Bank---</option>
	  <?
      $bank=mysql_query("SELECT * FROM bank ORDER BY id_bank ASC");
      while($BK=mysql_fetch_array($bank)){
         echo "<option value='$BK[id_bank]'>$BK[nm_bank]</option>";
      }?>
	</select>
	<i></i></span></div></div>
<div class="submit">
<div class="kembali"><a href="javascript:history.go(-1)">Kembali</a></div> 
<input type="submit" value="Lanjutkan" /></div>
&nbsp;*Data Ini Akan Tersimpan Di Akun Anda

</form>
</div>
<div class="kanan"><h2>Detail Pesanan Anda</h2>

<table width="441" border="1" class='tbl' cellspacing="0" cellpadding="5">
  <tr>
    <td width="20" bgcolor="#FF6633"><span class="style1">No</span></td>
    <td width="208" bgcolor="#FF6633"><span class="style1">Produk</span></td>
    <td width="48" bgcolor="#FF6633"><span class="style1">Jumlah</span></td>
    <td width="115" bgcolor="#FF6633"><span class="style1">Total</span></td>
    </tr>
	<?
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp, produk 
			            WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysql_num_rows($sql);
  $no=1;
  while($r=mysql_fetch_array($sql)){
    $disc        = ($r[diskon]/100)*$r[harga];
    $hargadisc   = number_format(($r[harga]-$disc),0,",",".");

    $subtotal    = ($r[harga]-$disc) * $r[jumlah];
    $total       = $total + $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($r[harga]);
?>
  <tr>
    <td valign="top" align="center" ><strong><?=$no?></strong></td>
    <td valign="top"><strong><?=$r[nama_produk]?></strong></td>
    <td align="center" valign="top"><strong><?=$r[jumlah]?></strong></td>
    <td valign="top"><strong>Rp.<?=$subtotal_rp?></strong></td>
    </tr>
<? $no++; } ?>	
</table>
<div class="total"><strong>Harga Total : &nbsp;&nbsp;&nbsp;&nbsp;Rp.<?=$total_rp ?></strong></div>
<div class="to">*Total harga diatas belum termasuk ongkos kirim.</div>
</div>

</div>
<? }}?>

<script type="text/javascript" src="login_files/formoid1/formoid-metro-cyan.js"></script>
<!-- Stop Formoid form-->
</body>
</html>
