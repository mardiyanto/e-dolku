<? 
  session_start();	
  include "config/koneksi.php";
	include "config/fungsi_indotgl.php";
	include "config/class_paging.php";
	include "config/fungsi_combobox.php";
	include "config/library.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_rupiah.php";
  
$email = $_POST['email'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM	kustomer WHERE BINARY email='$email' AND password='$password'";
$hasil = mysql_query($sql);
$r = mysql_fetch_array($hasil);

if(mysql_num_rows($hasil) == 0){

echo "<script>window.alert('Email atau Password Anda tidak benar');
        window.location=('javascript:history.go(-1)')</script>";
}
else{
    $_SESSION[kustomer]  = $r[id_kustomer];
    
    $_SESSION[namamember]  = $r[nama_lengkap];
    $_SESSION[email]  = $r[email];
    $_SESSION[pass]     = $r[password];
    $_SESSION[alamat]  = $r[alamat];
    $_SESSION[hp]  =$r[telpon];
	 $_SESSION[kota]  =$r[id_kota];

  echo "<script>window.location=('index.php?l=lihat&aksi=bayar')</script>";
  
  
  }
  
  ?>