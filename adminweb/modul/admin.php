<?php
session_start();
include "../../config/koneksi.php";
$act=$_GET[act];
$nama=mysql_query("SELECT * FROM users WHERE nama_leng='$_POST[nm]'");
$email=mysql_query("SELECT * FROM users WHERE email='$_POST[em]'");
$user=mysql_query("SELECT * FROM users WHERE username='$_POST[um]'");

$nama2=mysql_query("SELECT * FROM users WHERE id !='$_GET[id]' AND 
                    nama_leng='$_POST[nm]'");
$email2=mysql_query("SELECT * FROM users WHERE id !='$_GET[id]' AND 
                    email='$_POST[em]'");
$user2=mysql_query("SELECT * FROM users WHERE id !='$_GET[id]' AND
                    username='$_POST[um]'");

$kar1=strstr($_POST[em], "@");
$kar2=strstr($_POST[em], ".");
$pass=md5($_POST['pw']);

if($act=='inputadmin'){

if(mysql_num_rows($nama) == 0){
if(mysql_num_rows($email) == 0){
if(mysql_num_rows($user) == 0){

////////////////////////////
 if (empty($_POST[nm]) || empty($_POST[em]) || empty($_POST[um]) || empty($_POST[pw])){
 echo "<script>window.alert('Data yang Anda isikan belum lengkap');
        window.location=('javascript:history.go(-1)')</script>";
     }
 elseif (!ereg("[a-z|A-Z]","$_POST[nm]")){
  echo "<script>window.alert('Nama tidak boleh diisi dengan angka atau simbol...!!');
        window.location=('javascript:history.go(-1)')</script>";
   }
elseif (strlen($kar1)==0 OR strlen($kar2)==0){
  echo "<script>window.alert('Format email salah...!!');
        window.location=('javascript:history.go(-1)')</script>";
}else{
mysql_query("insert into users (username,password,nama_leng,email) values ('$_POST[um]','$pass','$_POST[nm]','$_POST[em]')");
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

if(mysql_num_rows($nama2) == 0){
if(mysql_num_rows($email2) == 0){
if(mysql_num_rows($user2) == 0){

////////////////////////////
 if (empty($_POST[nm]) || empty($_POST[em]) || empty($_POST[um])){
 echo "<script>window.alert('Data yang Anda isikan belum lengkap');
        window.location=('javascript:history.go(-1)')</script>";
     }
 elseif (!ereg("[a-z|A-Z]","$_POST[nm]")){
  echo "<script>window.alert('Nama tidak boleh diisi dengan angka atau simbol...!!');
        window.location=('javascript:history.go(-1)')</script>";
   }
elseif (strlen($kar1)==0 OR strlen($kar2)==0){
  echo "<script>window.alert('Format email salah...!!');
        window.location=('javascript:history.go(-1)')</script>";
}else{
  if(empty($_POST[pw])){
mysql_query("UPDATE users SET username='$_POST[um]', nama_leng='$_POST[nm]', email='$_POST[em]' WHERE id='$_GET[id]'");
echo "<script>window.location=('../index.php?aksi=admin')</script>";
   }else{
mysql_query("UPDATE users SET username='$_POST[um]', password='$pass', nama_leng='$_POST[nm]', email='$_POST[em]' WHERE id='$_GET[id]'");
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
mysql_query("DELETE FROM users WHERE id='$_GET[id]'");

echo "<script>window.location=('../index.php?aksi=admin')</script>";
}

?>
