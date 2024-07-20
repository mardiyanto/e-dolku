<?php
session_start();
include "../../config/koneksi.php";
$act=$_GET['act'];
$nama=mysqli_query($koneksi, "SELECT * FROM users WHERE nama_leng='$_POST[nm]'");
$email=mysqli_query($koneksi, "SELECT * FROM users WHERE email='$_POST[em]'");
$user=mysqli_query($koneksi, "SELECT * FROM users WHERE username='$_POST[um]'");

$nama2=mysqli_query($koneksi, "SELECT * FROM users WHERE id !='$_GET[id]' AND 
                    nama_leng='$_POST[nm]'");
$email2=mysqli_query($koneksi, "SELECT * FROM users WHERE id !='$_GET[id]' AND 
                    email='$_POST[em]'");
$user2=mysqli_query($koneksi, "SELECT * FROM users WHERE id !='$_GET[id]' AND
                    username='$_POST[um]'");

$kar1=strstr($_POST['em'], "@");
$kar2=strstr($_POST['em'], ".");
$pass=md5($_POST['pw']);

if($act=='inputadmin'){

if(mysqli_num_rows($nama) == 0){
if(mysqli_num_rows($email) == 0){
if(mysqli_num_rows($user) == 0){

////////////////////////////
 if (empty($_POST['nm']) || empty($_POST['em']) || empty($_POST['um']) || empty($_POST['pw'])){
 echo "<script>window.alert('Data yang Anda isikan belum lengkap');
        window.location=('javascript:history.go(-1)')</script>";
     }
 elseif (!preg_match("/[a-zA-Z]/", $_POST['nm'])){
  echo "<script>window.alert('Nama tidak boleh diisi dengan angka atau simbol...!!');
        window.location=('javascript:history.go(-1)')</script>";
   }
elseif (strlen($kar1)==0 OR strlen($kar2)==0){
  echo "<script>window.alert('Format email salah...!!');
        window.location=('javascript:history.go(-1)')</script>";
}else{
mysqli_query($koneksi, "INSERT INTO users (username,password,nama_leng,email) VALUES ('$_POST[um]','$pass','$_POST[nm]','$_POST[em]')");
echo "<script>window.location=('../index.php?aksi=admin')</script>";
}
///////////////////////////////

}else{//$user
echo "<script>window.alert('User name sudah terdaftar');
        window.location=('javascript:history.go(-1)')</script>";
}

}else{//$email
 echo "<script>window.alert('Email sudah terdaftar');
        window.location=('javascript:history.go(-1)')</script>";
}

}else{//$nama
 echo "<script>window.alert('Nama sudah terdaftar');
        window.location=('javascript:history.go(-1)')</script>";
  }
}
//////////////////////////////////////
elseif($act=='editadmin'){

if(mysqli_num_rows($nama2) == 0){
if(mysqli_num_rows($email2) == 0){
if(mysqli_num_rows($user2) == 0){

////////////////////////////
 if (empty($_POST['nm']) || empty($_POST['em']) || empty($_POST['um'])){
 echo "<script>window.alert('Data yang Anda isikan belum lengkap');
        window.location=('javascript:history.go(-1)')</script>";
     }
 elseif (!preg_match("/[a-zA-Z]/", $_POST['nm'])){
  echo "<script>window.alert('Nama tidak boleh diisi dengan angka atau simbol...!!');
        window.location=('javascript:history.go(-1)')</script>";
   }
elseif (strlen($kar1)==0 OR strlen($kar2)==0){
  echo "<script>window.alert('Format email salah...!!');
        window.location=('javascript:history.go(-1)')</script>";
}else{
  if(empty($_POST['pw'])){
mysqli_query($koneksi, "UPDATE users SET username='$_POST[um]', nama_leng='$_POST[nm]', email='$_POST[em]' WHERE id='$_GET[id]'");
echo "<script>window.location=('../index.php?aksi=admin')</script>";
   }else{
mysqli_query($koneksi, "UPDATE users SET username='$_POST[um]', password='$pass', nama_leng='$_POST[nm]', email='$_POST[em]' WHERE id='$_GET[id]'");
echo "<script>window.location=('../index.php?aksi=admin')</script>";
   }
}
///////////////////////////////

}else{//$user
echo "<script>window.alert('User name sudah terdaftar');
        window.location=('javascript:history.go(-1)')</script>";
}

}else{//$email
 echo "<script>window.alert('Email sudah terdaftar');
        window.location=('javascript:history.go(-1)')</script>";
}

}else{//$nama
 echo "<script>window.alert('Nama sudah terdaftar');
        window.location=('javascript:history.go(-1)')</script>";
  }
}

elseif($act=='hapus'){
mysqli_query($koneksi, "DELETE FROM users WHERE id='$_GET[id]'");

echo "<script>window.location=('../index.php?aksi=admin')</script>";
}

?>
