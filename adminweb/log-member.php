<?php
include "../config/koneksi.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = anti_injection($_POST['user']);
$pass     = anti_injection(md5($_POST['pass']));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
echo "<script>window.location=('javascript:history.go(-1)')</script>";
}
else{
$login=mysql_query("SELECT * FROM  users WHERE BINARY username='$username' AND password='$pass' ");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
   include "../config/timeout.php";

  $_SESSION['KCFINDER']=array();
  $_SESSION['KCFINDER']['disabled'] = false;
  $_SESSION['KCFINDER']['uploadURL'] = "../tinymcpuk/gambar";
  $_SESSION['KCFINDER']['uploadDir'] = "";

  $_SESSION[user]     = $r[username];
  $_SESSION[nama]  = $r[nama_leng];
  $_SESSION[pass]     = $r[password];
  $_SESSION[kode]     = $r[id];
$_SESSION[email]  		=$r[email];
  
  // session timeout
  $_SESSION[login] = 1;
  timer();

	$sid_lama = session_id();
	
	session_regenerate_id();

	$sid_baru = session_id();
 $tgl=date ('d/m/Y');
 $dt=date ('h:i A');
  mysql_query("UPDATE users SET id_session='$sid_baru',tgl_log='$tgl',jam_log='$dt' WHERE username='$username'");
  echo "<script>window.location=('index.php?aksi=home')</script>";
}
else{
echo "<script>window.location=('login.php?salah=salah')</script>";
}
}
?>

