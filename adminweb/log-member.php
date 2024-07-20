<?php
include "../config/koneksi.php";
function injection($data){
  global $koneksi; // Menambahkan global untuk mengakses $koneksi
  $filter = mysqli_real_escape_string($koneksi, stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = injection($_POST['user']);
$pass     = injection(md5($_POST['pass']));

// pastikan username dan password tidak mengandung karakter khusus
if (!preg_match("/^[a-zA-Z0-9]*$/", $username) || !preg_match("/^[a-zA-Z0-9]*$/", $pass)){
    echo "<script>window.alert('Username atau password tidak valid.'); window.location=('javascript:history.go(-1)')</script>";
} else {
    $login = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$pass'");
    $ketemu = mysqli_num_rows($login);
    $r = mysqli_fetch_array($login);

    // Apabila username dan password ditemukan
    if ($ketemu > 0) {
        session_start();
        include "../config/timeout.php";

        $_SESSION['KCFINDER'] = array();
        $_SESSION['KCFINDER']['disabled'] = false;
        $_SESSION['KCFINDER']['uploadURL'] = "../tinymcpuk/gambar";
        $_SESSION['KCFINDER']['uploadDir'] = "";

        $_SESSION['user']     = $r['username'];
        $_SESSION['nama']     = $r['nama_leng'];
        $_SESSION['pass']     = $r['password'];
        $_SESSION['kode']     = $r['id'];
        $_SESSION['email']    = $r['email'];
        
        // session timeout
        $_SESSION['login'] = 1;
        timer();

        $sid_lama = session_id();
        session_regenerate_id();
        $sid_baru = session_id();
        $tgl = date('d/m/Y');
        $dt = date('h:i A');
        mysqli_query($koneksi, "UPDATE users SET id_session='$sid_baru',tgl_log='$tgl',jam_log='$dt' WHERE username='$username'");
        echo "<script>window.location=('index.php?aksi=home')</script>";
    } else {
        echo "<script>window.alert('Login gagal. Username atau password salah.'); window.location=('login.php?salah=salah')</script>";
    }
}
?>
