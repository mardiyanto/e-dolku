<?php 
session_start();	
include "config/koneksi.php";
include "config/fungsi_indotgl.php";
include "config/class_paging.php";
include "config/fungsi_combobox.php";
include "config/library.php";
include "config/fungsi_autolink.php";
include "config/fungsi_rupiah.php";

$aksi = $_GET['aksi'];

if ($aksi == 'login') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM kustomer WHERE BINARY email='$email' AND password='$password'";
    $hasil = mysqli_query($koneksi, $sql);
    $r = mysqli_fetch_array($hasil);

    if (mysqli_num_rows($hasil) == 0) {
        echo "<script>window.alert('Password Atau Email Yang Anda Masukan Salah Coba Lagi');
        window.location=('javascript:history.go(-1)')</script>";
    } else {
        $_SESSION['kustomer'] = $r['id_kustomer'];
        $_SESSION['namamember'] = $r['nama_lengkap'];
        $_SESSION['email'] = $r['email'];
        $_SESSION['pass'] = $r['password'];
        $_SESSION['alamat'] = $r['alamat'];
        $_SESSION['hp'] = $r['telpon'];
        $_SESSION['kota'] = $r['id_kota'];

        if ($_GET['cek'] == 'cek') {
            echo "<script>window.location=('index.php?l=lihat&aksi=pembayaran')</script>";
        } else {
            echo "<script>window.location=('index.php')</script>";
        }
    }
} elseif ($aksi == 'daftarmember') {
    $kar1 = strstr($_POST['email'], "@");
    $kar2 = strstr($_POST['email'], ".");
    $pan = strlen($_POST['password']); 

    // Cek email kustomer di database
    $cek_email = mysqli_num_rows(mysqli_query($koneksi, "SELECT email FROM kustomer WHERE email='$_POST[email]'"));

    // Kalau email sudah ada yang pakai
    if ($cek_email > 0) {
        echo "<script>window.alert('Email $_POST[email] Sudah Terdaftar');
        window.location=('javascript:history.go(-1)')</script>";
    } elseif (empty($_POST['nama']) || empty($_POST['password']) || empty($_POST['email'])) {
        echo "<script>window.alert('Data yang Anda isikan belum lengkap');
        window.location=('javascript:history.go(-1)')</script>";
    } elseif (strlen($kar1) == 0 OR strlen($kar2) == 0) {
        echo "<script>window.alert('Format Email Salah');
        window.location=('javascript:history.go(-1)')</script>";
    } elseif ($pan <= 5) {
        echo "<script>window.alert('Password Lemah Minimal 6 Karakter');
        window.location=('javascript:history.go(-1)')</script>";
    } elseif ($_POST['password'] != $_POST['password1']) {
        echo "<script>window.alert('Password Yang Anda Masukan Tidak Sama');
        window.location=('javascript:history.go(-1)')</script>";
    } else {
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telpon = $_POST['telpon'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $date = date('d/m/Y');

        mysqli_query($koneksi, "INSERT INTO kustomer(password,nama_lengkap,email,tgl) 
             VALUES('$password','$nama','$_POST[email]','$date')"); 

        $sql = "SELECT * FROM kustomer WHERE BINARY email='$email' AND password='$password'";
        $hasil = mysqli_query($koneksi, $sql);
        $r = mysqli_fetch_array($hasil);

        $_SESSION['kustomer'] = $r['id_kustomer'];
        $_SESSION['namamember'] = $r['nama_lengkap'];
        $_SESSION['email'] = $r['email'];
        $_SESSION['pass'] = $r['password'];
        $_SESSION['alamat'] = $r['alamat'];
        $_SESSION['hp'] = $r['telpon'];
        $_SESSION['kota'] = $r['id_kota'];

        if ($_GET['cek'] == 'cek') {
            echo "<script>window.alert('Pendaftaran Berhasil Silahkan Lanjutkan Pembayaran');
            window.location=('index.php?l=lihat&aksi=pembayaran&cek=cek')</script>";
        } else {
            echo "<script>window.alert('Pendaftaran Berhasil');
            window.location=('index.php')</script>";
        }
    }
} elseif ($aksi == 'edit_akun') {
    if (empty($_POST['nama']) || empty($_POST['ALM']) || empty($_POST['HP']) || empty($_POST['kota']) || empty($_POST['KD'])) {
        echo "<script>window.alert('Data yang Anda isikan belum lengkap');
        window.location=('javascript:history.go(-1)')</script>";
    } else {
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telpon = $_POST['telpon'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $date = date('d/m/Y');

        mysqli_query($koneksi, "UPDATE kustomer SET nama_lengkap='$nama',alamat='$_POST[ALM]',kd_pos='$_POST[KD]', telpon='$_POST[HP]',id_kota='$_POST[kota]' WHERE id_kustomer='$_SESSION[kustomer]'");

        echo "<script>window.alert('Berhasil Mengedit');
        window.location=('akun.php?aksi=data_ku')</script>";
    }
} elseif ($aksi == 'pembayaran') {
    $sid = session_id();
    $sql = mysqli_query($koneksi, "SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
    $ketemu = mysqli_num_rows($sql);
    if ($ketemu < 1) {
        echo "<script> alert('Keranjang belanja masih kosong');window.location='index.php'</script>\n";
        exit(0);
    } else {
        if ($_SESSION['kustomer'] == '') {
            echo "<script>window.alert('Anda Belum Melakukan Login, Silahkan Login Terlebih Dahulu');
            window.location=('index.php?l=lihat&aksi=login')</script>";
        } elseif ($_POST['KC'] == 'null') {
            echo "<script>window.alert('Kecamatan Masih Kosong');
            window.location=('javascript:history.go(-1)')</script>";
        } else {
            $kota = mysqli_query($koneksi, "SELECT * FROM kota WHERE id_kota='$_POST[KC]'");
            $ko = mysqli_fetch_array($kota);

            mysqli_query($koneksi, "UPDATE kustomer SET       
                           nama_lengkap='$_POST[NM]',
						   alamat='
						   Alamat : $_POST[ALM]<br />
						   Desa/Kelurahan : $_POST[DESA]<br />
		 				   Rt/Rw : $_POST[RT]/$_POST[RW]<br />
		 				   Kecamatan : $ko[nama_kota]<br />
		 				   Alamat Alternatif : $_POST[ALM_A]<br />',
						   telpon='$_POST[HP]'
						   WHERE id_kustomer='$_SESSION[kustomer]'");

            function isi_keranjang() {
                $isikeranjang = array();
                $sid = session_id();
                $sql = mysqli_query($koneksi, "SELECT * FROM orders_temp WHERE id_session='$sid'");
                
                while ($r = mysqli_fetch_array($sql)) {
                    $isikeranjang[] = $r;
                }
                return $isikeranjang;
            }

            $tgl_skrg = date("Ymd");
            $jam_skrg = gmdate('H:i:s', time() + 60 * 60 * 7);

            $id = mysqli_fetch_array(mysqli_query($koneksi, "SELECT id_kustomer FROM kustomer WHERE email='$_SESSION[email]' AND password='$_SESSION[pass]'"));

            $id_kustomer = $_SESSION['kustomer'];

            mysqli_query($koneksi, "INSERT INTO orders(tgl_order,jam_order,id_kustomer,id_kota_o,m_pengiriman,m_pembayaran,id_bank_o) 
	  VALUES('$tgl_skrg','$jam_skrg','$id_kustomer','$_POST[KC]','$_POST[MP]','$_POST[pembayaran]','$_POST[bank]')");

            $id_orders = mysqli_insert_id($koneksi);

            $isikeranjang = isi_keranjang();
            $jml = count($isikeranjang);

            for ($i = 0; $i < $jml; $i++) {
                mysqli_query($koneksi, "INSERT INTO orders_detail(id_orders, id_produk, jumlah) 
               VALUES('$id_orders',{$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['jumlah']})");
            }

            for ($i = 0; $i < $jml; $i++) {
                mysqli_query($koneksi, "DELETE FROM orders_temp
	  	         WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
            }

            echo "<script>window.location=('index.php?l=lihat&aksi=detailorder&id=$id_orders')</script>";
        }
    }
}
?>