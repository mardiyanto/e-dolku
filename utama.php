<?php
if($aksi=='kranjang'){
echo"<div class='card'>
  <div class='card-header'>
 Keranjang Belanja
  </div>  
 <div class='card-body'>";

$sid = session_id();
	$sql = mysqli_query($koneksi, "SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysqli_num_rows($sql);
  if($ketemu < 1){
    echo "
<center>
	<strong>Belum Ada Menu Produk Dikeranjang Anda Lihat <a href='?l=lihat&aksi=allproduk'>Daftar Menu Produk</a></strong>
</center>";
	  $sql=mysqli_query($koneksi, "SELECT * FROM produk ORDER BY rand() LIMIT 9");
      
  echo "  </div>
</div><h2>Produk Lainnya</h2>
 ";
      
  while ($r=mysqli_fetch_array($sql)){

  include "diskon_stok.php";

echo"
<div class='product-info'>
 <a href='index.php?l=lihat&aksi=detail&id_p=$r[id_produk]'>
<center><img src='foto/foto_produk/$r[gambar]'  title='Lihat $r[nama_produk]' /></center>
</a>
";
     if ($d!=0){echo"
            <div class='diskon'> $r[diskon]% </div>";
    }else{echo"";
    }
            echo"
          
		   <div class='nama_p_besar'>$r[nama_produk]</div>
         $divharga	   
 
</div>
";
  }  
  echo"<div class='cl'></div>";
  if($jmldata >= $batas){ echo"
		 <div class='navi' align='center' >$linkHalaman </div><br />";}
    }
  else{  
    include"keranjang.php";
	echo"
   </div>
</div>";
  }

echo"</div>";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
elseif($aksi=='cekout'){
    if ($_SESSION['kustomer'] != '') {
        echo "<script>
                window.location=('index.php?l=lihat&aksi=bayar')</script>";
    } else {
        $sid = session_id();
        $sql = mysqli_query($koneksi, "SELECT * FROM orders_temp, produk 
                                        WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
        $ketemu = mysqli_num_rows($sql);
        if ($ketemu < 1) {
            echo "<script> alert('Keranjang belanja masih kosong');window.location='index.php'</script>\n";
            exit(0);
        } else {
            if ($_GET['login'] == 'login') {
                echo "<h2 class='nama'>Login</h2>
                      <div class='bok3' align='center'>
                      <form name='form2' action='login.php' method='POST' onSubmit=\"return validasi2(this)\">
                      <fieldset>
                      <table align='center' width='50%'>
                      <tr><td width='20%'>Email</td><td> : <input type='text' name='email' size='30'></td></tr>
                      <tr><td>Password</td><td> : <input type='password' name='password' size='30'></td></tr>
                      <tr><td><input type='submit' class='button' value='Login'></td><td align='center'><a href='index.php?l=lihat&aksi=lupapass'>Lupa Password?</a>&nbsp; &nbsp; &nbsp; <a href='index.php?l=lihat&aksi=cekout'>Daftar Baru</a></td></tr>
                      </table>
                      </fieldset>
                      </form>
                      </div>
                      <div class='cl'> </div>";
            } else {
                echo "<h2 class='nama'>Register</h2>
                      <div class='bok3' align='center'>
                      <form name='form' action='index.php?l=lihat&aksi=daftarmember' method='POST' onSubmit=\"return validasi(this)\">
                      <table width='80%'>
                      <tr><td width='20%'>Nama Lengkap</td><td>  <input type='text' name='nama' size='60'></td></tr>
                      <tr><td>Password</td><td>  <input type='password' name='password' size='60'></td></tr>
                      <tr><td valign='top'>Alamat Pengiriman</td><td>  <textarea name='alamat' style='width: 400px; height: 60px;'></textarea>
                      <br /> Alamat pengiriman harus di isi lengkap, termasuk kota/kabupaten dan kode posnya.</td></tr>
                      <tr><td>Telpon/HP</td><td>  <input type='text' name='telpon' size='60'></td></tr>
                      <tr><td>Email</td><td>  <input type='text' name='email' size='60'></td></tr>
                      <tr><td valign='top'>Kota Tujuan</td><td>  
                      <select name='kota'>
                      <option value='0' selected>--- Pilih Kota ---</option>";
                $tampil = mysqli_query($koneksi, "SELECT * FROM kota ORDER BY id_kota ASC");
                while ($r = mysqli_fetch_array($tampil)) {
                    echo "<option value='{$r['id_kota']}'>{$r['nama_kota']}</option>";
                }
                echo "</select> <br /><br />*)  Apabila tidak terdapat nama kota tujuan Anda, pilih <b>Lainnya</b>
                      <br />**) Ongkos kirim dihitung berdasarkan kota tujuan</td></tr>
                      <tr><td>&nbsp;</td><td><br>
                      <img src='captcha.php'></td></tr>
                      <tr><td>&nbsp;</td><td>(Masukkan 4 kode diatas)<br /><br>
                      <input type='text' name='kode' size='6' maxlength='6'><br /></td></tr>
                      <tr><td colspan='2'><input type='submit' class='button' value='Daftar'></td></tr>
                      </table>
                      </form>
                      </div>";
            }
        }
    }
}
elseif($aksi=='daftarmember'){
    $kar1 = strstr($_POST['email'], "@");
    $kar2 = strstr($_POST['email'], ".");

    // Cek email kustomer di database
    $cek_email = mysqli_num_rows(mysqli_query($koneksi, "SELECT email FROM kustomer WHERE email='{$_POST['email']}'"));
    // Kalau email sudah ada yang pakai
    if ($cek_email > 0) {
        echo "<script>window.alert('Email <b>{$_POST['email']}</b> sudah ada yang pakai.');
              window.location=('javascript:history.go(-1)')</script>";
    } elseif (empty($_POST['nama']) || empty($_POST['password']) || empty($_POST['alamat']) || empty($_POST['telpon']) || empty($_POST['email']) || empty($_POST['kota']) || empty($_POST['kode'])) {
        echo "<script>window.alert('Data yang Anda isikan belum lengkap');
              window.location=('javascript:history.go(-1)')</script>";
    } elseif (!preg_match("/[a-zA-Z]/", $_POST['nama'])) {
        echo "<script>window.alert('Nama tidak boleh diisi dengan angka atau simbol.');
              window.location=('javascript:history.go(-1)')</script>";
    } elseif (strlen($kar1) == 0 || strlen($kar2) == 0) {
        echo "<script>window.alert('Alamat email Anda tidak valid.');
              window.location=('javascript:history.go(-1)')</script>";
    } else {
        if (!empty($_POST['kode'])) {
            if ($_POST['kode'] == $_SESSION['captcha_session']) {
                function antiinjection($data) {
                    global $koneksi;
                    $filter_sql = mysqli_real_escape_string($koneksi, stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
                    return $filter_sql;
                }

                $nama = antiinjection($_POST['nama']);
                $alamat = antiinjection($_POST['alamat']);
                $telpon = antiinjection($_POST['telpon']);
                $email = antiinjection($_POST['email']);
                $password = md5($_POST['password']);
                $date = date('d/m/Y');

                mysqli_query($koneksi, "INSERT INTO kustomer(nama_lengkap, password, alamat, telpon, email, id_kota, tgl) 
                                        VALUES('$nama', '$password', '$alamat', '$telpon', '$email', '{$_POST['kota']}', '$date')");

                echo "<script>window.alert('Data Tersimpan Silahkan Login');
                      window.location=('index.php?l=lihat&aksi=cekout&login=login')</script>";
            } else {
                echo "<script>window.alert('Kode yang Anda masukkan tidak cocok');
                      window.location=('javascript:history.go(-1)')</script>";
            }
        } else {
            echo "<script>window.alert('Anda belum memasukkan kode');
                  window.location=('javascript:history.go(-1)')</script>";
        }
    }
}

/////////////////////////////////////////////////////////////////////////////////////////
elseif($aksi=='bayar'){
    if ($_SESSION['kustomer'] == '') {
        echo "<script>window.alert('Silahkan Login Terlebih Dulu');
              window.location=('javascript:history.go(-1)')</script>";
    }

    $sid2 = session_id();
    $sql2 = mysqli_query($koneksi, "SELECT * FROM orders_temp, produk 
                                    WHERE id_session='$sid2' AND orders_temp.id_produk=produk.id_produk");
    $ketemu = mysqli_num_rows($sql2);
    if ($ketemu < 1) {
        echo "<script>window.alert('Keranjang Belanjanya Masih Kosong');
              window.location=('index.php')</script>";
    } else {
        function isi_keranjang() {
            global $koneksi;
            $isikeranjang = array();
            $sid = session_id();
            $sql = mysqli_query($koneksi, "SELECT * FROM orders_temp WHERE id_session='$sid'");
            
            while ($r = mysqli_fetch_array($sql)) {
                $isikeranjang[] = $r;
            }
            return $isikeranjang;
        }

        $tgl_skrg = date("Ymd");
        $jam_skrg = date("H:i:s");

        $id = mysqli_fetch_array(mysqli_query($koneksi, "SELECT id_kustomer FROM kustomer WHERE email='{$_SESSION['email']}' AND password='{$_SESSION['pass']}'"));

        // mendapatkan nomor kustomer
        $id_kustomer = $_SESSION['kustomer'];

        // simpan data pemesanan 
        mysqli_query($koneksi, "INSERT INTO orders(tgl_order, jam_order, id_kustomer) VALUES('$tgl_skrg', '$jam_skrg', '$id_kustomer')");

        // mendapatkan nomor orders
        $id_orders = mysqli_insert_id($koneksi);

        // panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
        $isikeranjang = isi_keranjang();
        $jml = count($isikeranjang);

        // simpan data detail pemesanan  
        for ($i = 0; $i < $jml; $i++) {
            mysqli_query($koneksi, "INSERT INTO orders_detail(id_orders, id_produk, jumlah) 
                                    VALUES('$id_orders', '{$isikeranjang[$i]['id_produk']}', '{$isikeranjang[$i]['jumlah']}')");
        }

        // setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
        for ($i = 0; $i < $jml; $i++) {
            mysqli_query($koneksi, "DELETE FROM orders_temp WHERE id_orders_temp = '{$isikeranjang[$i]['id_orders_temp']}'");
        }

        echo "<h2 class='nama'>Proses Transaksi Selesai</h2>";
        echo "
        Data pemesan beserta ordernya adalah sebagai berikut: <br />
        <table>
        <tr><td>Nama Lengkap   </td><td> : <b>{$_SESSION['namamember']}</b> </td></tr>
        <tr><td>Alamat Lengkap </td><td> : {$_SESSION['alamat']} </td></tr>
        <tr><td>Telpon         </td><td> : {$_SESSION['hp']} </td></tr>
        <tr><td>E-mail         </td><td> : {$_SESSION['email']} </td></tr></table><hr /><br />
        
        Nomor Order: <b>$id_orders</b><br /><br />";

        $daftarproduk = mysqli_query($koneksi, "SELECT * FROM orders_detail, produk 
                                                WHERE orders_detail.id_produk=produk.id_produk 
                                                AND id_orders='$id_orders'");

        echo "
        <div class='datagrid'>
        <table>
        <thead>
        <tr bgcolor=#6da6b1><th>No</th><th>Nama Produk</th><th>Berat(Kg)</th><th>Qty</th><th>Harga Satuan</th><th>Sub Total</th></tr>
        </thead>
        <tbody>";

        $pesan = "Terimakasih telah melakukan pemesanan online di toko online kami <br /><br />  
                  Nama: {$_SESSION['namamember']} <br />
                  Alamat: {$_SESSION['alamat']} <br/>
                  Telpon: {$_SESSION['hp']} <br /><hr />
                  
                  Nomor Order: $id_orders <br />
                  Data order Anda adalah sebagai berikut: <br /><br />";

        $no = 1;
        $totalberat = 0;
        $total = 0;
        while ($d = mysqli_fetch_array($daftarproduk)) {
            $disc = ($d['diskon'] / 100) * $d['harga'];
            $hargadisc = number_format(($d['harga'] - $disc), 0, ",", ".");
            $subtotal = ($d['harga'] - $disc) * $d['jumlah'];

            $subtotalberat = $d['berat'] * $d['jumlah']; // total berat per item produk 
            $totalberat += $subtotalberat; // grand total berat all produk yang dibeli

            $total += $subtotal;
            $subtotal_rp = format_rupiah($subtotal);
            $total_rp = format_rupiah($total);
            $harga = format_rupiah($d['harga']);

            echo "<tr bgcolor=#dad0d0><td>$no</td><td>{$d['nama_produk']}</td><td align=center>{$d['berat']}</td><td align=center>{$d['jumlah']}</td>
                  <td align=right>$harga</td><td align=right>$subtotal_rp</td></tr>";

            $pesan .= "{$d['jumlah']} {$d['nama_produk']} -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
            $no++;
        }

        $kota = $_SESSION['kota'];

        $ongkos = mysqli_fetch_array(mysqli_query($koneksi, "SELECT ongkos_kirim FROM kota WHERE id_kota='$kota'"));
        $ongkoskirim1 = $ongkos['ongkos_kirim'];
        $ongkoskirim = $ongkoskirim1 * $totalberat;

        $grandtotal = $total + $ongkoskirim;

        $ongkoskirim_rp = format_rupiah($ongkoskirim);
        $ongkoskirim1_rp = format_rupiah($ongkoskirim1);
        $grandtotal_rp = format_rupiah($grandtotal);

        /*
        $sql2 = mysqli_query($koneksi, "SELECT email_pengelola, nomor_rekening, nomor_hp FROM modul WHERE id_modul='43'");
        $j2 = mysqli_fetch_array($sql2);
        */
        $pesan .= "<br /><br />Total : Rp. $total_rp 
                   <br />Ongkos Kirim untuk Tujuan Kota Anda : Rp. $ongkoskirim1_rp/Kg 
                   <br />Total Berat : $totalberat Kg
                   <br />Total Ongkos Kirim  : Rp. $ongkoskirim_rp		 
                   <br />Grand Total : Rp. $grandtotal_rp 
                   <br /><br />Silahkan lakukan pembayaran sebanyak Grand Total yang tercantum, rekeningnya: {$j2['nomor_rekening']}
                   <br />Apabila sudah transfer, konfirmasi ke nomor: {$j2['nomor_hp']}";
        /*
        $subjek = "Pemesanan Online";

        // Kirim email dalam format HTML
        $dari = "From: {$j2['email_pengelola']}\r\n";
        $dari .= "Content-type: text/html\r\n";

        // Kirim email ke kustomer
        mail($email, $subjek, $pesan, $dari);

        // Kirim email ke pengelola toko online
        mail("{$j2['email_pengelola']}", $subjek, $pesan, $dari);
        */
        echo "<tr><td colspan=5 align=right>Total : Rp. </td><td align=right><b>$total_rp</b></td></tr>
              <tr><td colspan=5 align=right>Ongkos Kirim untuk Tujuan Kota Anda: Rp. </td><td align=right><b>$ongkoskirim1_rp</b>/Kg</td></tr>      
              <tr><td colspan=5 align=right>Total Berat : </td><td align=right><b>$totalberat Kg</b></td></tr>
              <tr><td colspan=5 align=right>Total Ongkos Kirim : Rp. </td><td align=right><b>$ongkoskirim_rp</b></td></tr>      
              <tr><td colspan=5 align=right>Grand Total : Rp. </td><td align=right><b>$grandtotal_rp</b></td></tr>
              </tbody>
              </table>
              </div>";
        echo "<hr /><p>Data order dan nomor rekening transfer sudah terkirim ke email Anda. <br />
                   Apabila Anda tidak melakukan pembayaran dalam 3 hari, maka transaksi dianggap batal.</p><br /> 
                   <a href='index.php?l=lihat&aksi=allproduk' class='button'>Belanja Lagi</a><br />";  
    }              
}


///////////////////////////////////////////////////////////////////////////////////////////
elseif($aksi=='lupapass'){
echo "<h2 class='nama'>Register</h2>
        <div class='bok3' style='text-align: center;'>
      <form name='form3' action='kirim.php' method='POST'>
      <table width='65%'>
      <tr><td>Masukkan Email Anda</td><td> : <input type='text' name='email' size='30'></td></tr>
      <tr><td colspan='2'><input type='submit' class='button' value='Kirim'></td></tr>
      </table>
      </form>
          </div>";
}
////////////////////////////////////////////////////////////////////////////////////////////
elseif($aksi=='kategori'){
  $sq = mysqli_query($koneksi, "SELECT nama_kategori from kategori where id_kategori='" . mysqli_real_escape_string($koneksi, $_GET['id_k']) . "'");
  $n = mysqli_fetch_array($sq);

  echo "<h2>Kategori: " . htmlspecialchars($n['nama_kategori']) . "</h2>";
  $p = new Paging3;
  $batas = 16;
  $posisi = $p->cariPosisi($batas);

  $sql = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_kategori='" . mysqli_real_escape_string($koneksi, $_GET['id_k']) . "' ORDER BY id_produk DESC LIMIT $posisi, $batas");
  $jmldata = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk WHERE id_kategori='" . mysqli_real_escape_string($koneksi, $_GET['id_k']) . "'"));
  $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);

  $jumlah = mysqli_num_rows($sql);

  if ($jumlah > 0) {
    while ($r = mysqli_fetch_array($sql)) {
      include "diskon_stok.php";
      echo "<div class='product-info'>
              <a href='index.php?l=lihat&aksi=detail&id_p=" . htmlspecialchars($r['id_produk']) . "'>
                <center><img src='foto/foto_produk/" . htmlspecialchars($r['gambar']) . "' title='Lihat " . htmlspecialchars($r['nama_produk']) . "' /></center>
              </a>";
      if ($d != 0) {
        echo "<div class='diskon'>" . htmlspecialchars($r['diskon']) . "% </div>";
      }
      echo "<div class='nama_p_besar'>" . htmlspecialchars($r['nama_produk']) . "</div>
            </div>";
    }
    echo "<div class='cl'></div>";
    if ($jmldata >= $batas) {
      echo "<div class='navi' style='text-align: center;'>" . $linkHalaman . "</div><br />";
    }
  } else {
    echo "<p style='text-align: center;'>Belum ada produk pada kategori ini.</p>";
  }

  $sql = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_kategori!='" . mysqli_real_escape_string($koneksi, $_GET['id_k']) . "' AND best='Y' ORDER BY rand() LIMIT 4");

  echo "<h2 class='nama'>Rekomendasi Produk Kami</h2>";

  while ($r = mysqli_fetch_array($sql)) {
    include "diskon_stok.php";
    echo "<div class='product-info'>
            <a href='index.php?l=lihat&aksi=detail&id_p=" . htmlspecialchars($r['id_produk']) . "'>
              <center><img src='foto/foto_produk/" . htmlspecialchars($r['gambar']) . "' title='Lihat " . htmlspecialchars($r['nama_produk']) . "' /></center>
            </a>";
    if ($d != 0) {
      echo "<div class='diskon'>" . htmlspecialchars($r['diskon']) . "% </div>";
    }
    echo "<div class='nama_p_besar'>" . htmlspecialchars($r['nama_produk']) . "</div>
          </div>";
  }
}
///////////////////////////////////////////////////////////////////////////////////////////////////
elseif($aksi=='allproduk'){
  echo "<h2 class='nama'><span>Semua Produk</span></h2>";
  $p = new Paging;
  $batas = 24;
  $posisi = $p->cariPosisi($batas);

  $sql = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id_produk DESC LIMIT $posisi, $batas");
  $jmldata = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk"));
  $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);

  while ($r = mysqli_fetch_array($sql)) {
    include "diskon_stok.php";
    echo "<div class='product-info'>
            <a href='index.php?l=lihat&aksi=detail&id_p=" . htmlspecialchars($r['id_produk']) . "'>
              <center><img src='foto/foto_produk/" . htmlspecialchars($r['gambar']) . "' title='Lihat " . htmlspecialchars($r['nama_produk']) . "' /></center>
            </a>";
    if ($d != 0) {
      echo "<div class='diskon'>" . htmlspecialchars($r['diskon']) . "% </div>";
    }
    echo "<div class='nama_p_besar'>" . htmlspecialchars($r['nama_produk']) . "</div>
          </div>";
  }
  echo "<div class='cl'></div>";
  if ($jmldata >= $batas) {
    echo "<div class='navi' style='text-align: center;'>" . $linkHalaman . "</div><br />";
  }
}


elseif($aksi=='cariproduk'){
    if ((isset($_POST['submit'])) && ($_POST['cari'] != "")){
        $cari = mysqli_real_escape_string($koneksi, $_POST['cari']);
        $p = new Paging;
        $batas = 24;
        $posisi = $p->cariPosisi($batas);
        $query = "SELECT * FROM produk WHERE nama_produk LIKE '%$cari%' OR deskripsi LIKE '%$cari%' ORDER BY id_produk DESC LIMIT $posisi, $batas";
        $s = mysqli_query($koneksi, $query);
        $jmldata = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk WHERE nama_produk LIKE '%$cari%' OR deskripsi LIKE '%$cari%'"));
        $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
        $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
        $ada = mysqli_num_rows($s);
        echo "<div class='card border-ligh'> 
            <h5 class='card-title'>Ditemukan $ada data</h5>
        </div>";
        if($ada > 0){
            while($r = mysqli_fetch_array($s)){
                include "diskon_stok.php";
                echo "
                <div class='product-info'>
                    <a href='index.php?l=lihat&aksi=detail&id_p={$r['id_produk']}'>
                        <center><img src='foto/foto_produk/{$r['gambar']}' title='Lihat {$r['nama_produk']}' /></center>
                    </a>";
                if ($d != 0){
                    echo "<div class='diskon'> {$r['diskon']}% </div>";
                }
                echo "
                    <div class='nama_p_besar'>{$r['nama_produk']}</div>
                </div>";
            }
            echo "<div class='cl'></div>";
            if($jmldata >= $batas){
                echo "<div class='navi' align='center'>$linkHalaman </div><br />";
            }
        } else {
            echo "<div class='card border-ligh'> 
                <div class='card-body '>
                    <h5 class='card-title'>Ditemukan $ada data</h5>
                    <div align='center'><p class='card-text'>Maaf, Data yang anda cari belum terdaftar</p></div>
                </div>
            </div>";
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////
elseif($aksi=='diskon'){
    echo "<h2 class='nama'>Semua Produk Diskon</h2>";
    $p = new Paging;
    $batas = 52;
    $posisi = $p->cariPosisi($batas);
    $sql = mysqli_query($koneksi, "SELECT * FROM produk WHERE diskon !='0' ORDER BY id_produk DESC LIMIT $posisi, $batas");
    $jmldata = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk WHERE diskon !='0'"));
    $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
    while ($r = mysqli_fetch_array($sql)){
        include "diskon_stok.php";
        echo "
        <div class='product-info'>
            <a href='index.php?l=lihat&aksi=detail&id_p={$r['id_produk']}'>
                <img src='foto/foto_produk/{$r['gambar']}' width='155' height='150' title='Lihat {$r['nama_produk']}' />
            </a>";
        if ($d != 0){
            echo "<div class='newrotate'> &nbsp; {$r['diskon']}% </div>";
        }
        echo "
            <h2>{$r['nama_produk']}</h2>
            <h2 class='harga'>$divharga</h2>
        </div>";
    }
}
////////////////////
elseif($aksi=='profil'){
    $profil = mysqli_query($koneksi, "SELECT * FROM profil WHERE id_profil='{$_GET['id_p']}'");
    $r = mysqli_fetch_array($profil);
    echo "<div class='card border-ligh'>";
    if($r['aktif']=='Y'){
        echo "<img class='card-img-top' src='foto/foto_profil/{$r['foto']}' alt='{$r['nama']}'>";
    }
    echo "
        <div class='card-body '>
            <h5 class='card-title'>{$r['nama']}</h5>
            <p class='card-text'>{$r['isi']}</p>
        </div>
    </div>
    <div class='cl'></div>";
    $sql = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY rand() LIMIT 3");
    echo "<div class='card border-ligh'>
        <div class='card-header'><span>Lihat</span> Produk Ini</div>
    </div>";
    while ($r = mysqli_fetch_array($sql)){
        include "diskon_stok.php";
        echo "
        <div class='product-info'>
            <a href='index.php?l=lihat&aksi=detail&id_p={$r['id_produk']}'>
                <center><img src='foto/foto_produk/{$r['gambar']}' title='Lihat {$r['nama_produk']}' /></center>
            </a>";
        if ($d != 0){
            echo "<div class='diskon'> {$r['diskon']}% </div>";
        }
        echo "
            <div class='nama_p_besar'>{$r['nama_produk']}</div>
        </div>";
    }
    echo "<div class='cl'></div>";
    if($jmldata >= $batas){
        echo "<div class='navi' align='center'>$linkHalaman </div><br />";
    }
}

////////////////////
elseif($aksi=='carabayar'){
    $k = mysqli_query($koneksi, "SELECT * FROM kontak WHERE id_kontak='1'");
    $r = mysqli_fetch_array($k);

    echo "<h2>Cara Pembayaran</h2>
    <div class='entry'>
    <div id='post-49'>
    <div>
        <div id='_mcePaste'>
        <ol>
            <li>Pembeli setelah melakukan pemesanan barang dapat melakukan pembayaran melalui transfer bank, melalui ATM, ataupun menggunakan kartu kredit (dalam waktu dekat).</li>
            <li>Untuk pembayaran melalui:
                <li>transfer bank atau ATM, minimum jumlah pemesanan barang 1 Produk,- sebelum ditambah ongkos pengiriman barang. Untuk saat ini {$r['nama_perusahaan']} menggunakan Bank dibawah ini sebagai bank tujuan transfer.<br />";
                $bank = mysqli_query($koneksi, "SELECT * FROM bank ORDER BY id_bank DESC LIMIT 4");
                while ($b = mysqli_fetch_array($bank)) {
                    echo "<div><!--[jika ingin membuka bank]><img title='{$b['nama_bank']}' src='foto/foto_bank/{$b['gambar']}' height='48' /><![slesai]-->
                    <p>Nama Bank : {$b['nm_bank']}<br />
                    No. Rek. : {$b['no_rek']}<br />
                    Atas Nama : {$b['at_nama']}<br/>
                    alamat Bank : {$b['alm_bank']} </p>
                    </div>";
                }
            echo "</li>
            <li>Pembayaran harus dilakukan secara penuh berikut ongkos pengiriman dalam 1 X 24 jam setelah pemesanan barang.</li>
            <li>Jika dalam 1 X 24 jam tersebut, pembeli gagal dalam melakukan pembayaran atau tidak melunasi pembayaran, maka pesanan tersebut secara otomatis dianggap batal.</li>
            <li>Semua biaya yang tercantum menggunakan mata uang Rupiah Indonesia.</li>
            <li>Pesanan akan diproses setelah {$r['nama_perusahaan']} menerima pembayaran.</li>
            <li>Setelah melakukan proses transfer, mohon konfirmasikan transfer/pemesan barang anda di link menu <a href='index.php?l=lihat&aksi=konfirmasi'>konfirmasi</a> pemesan yang ada di website ini</li>
            <li>Konfirmasi melalui handphone bisa dilakukan melalui {$r['telepon']}, {$r['telepon_2']} dengan menyertakan nomor konfirmasi pemesanan (order) dengan format No order spasi nama barang</li>
            <li>Keterlambatan atau kesalahan yang terjadi dalam proses transfer tersebut adalah di luar kewenangan {$r['nama_perusahaan']}, dan bukan menjadi tanggung jawab dari {$r['nama_toko']}.</li>
        </ol>
        </div>
    </div>
    </div>
    </div>";

    $sql = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY rand() LIMIT 6");

    echo "<h2 class='nama'><span>Lihat</span> Produk Ini</h2>";

    while ($r = mysqli_fetch_array($sql)) {
        include "diskon_stok.php";

        echo "<div class='product-info'>
        <a href='index.php?l=lihat&aksi=detail&id_p={$r['id_produk']}'>
        <center><img src='foto/foto_produk/{$r['gambar']}' title='Lihat {$r['nama_produk']}' /></center>
        </a>";
        if ($d != 0) {
            echo "<div class='diskon'> {$r['diskon']}% </div>";
        }
        echo "<div class='nama_p_besar'>{$r['nama_produk']}</div>
        </div>";
    }
    echo "<div class='cl'></div>";
    if ($jmldata >= $batas) {
        echo "<div class='navi' align='center'>{$linkHalaman}</div><br />";
    }
}

////////////////////
elseif($aksi=='ongkir'){
   echo "<div class='card border-ligh'>
  <div class='card-header'>Cek Ongkos Kirim</div>
  <div class='card-body'>
    <h5 class='card-title'>Untuk pengiriman di Kota anda kami Bekerja Sama dengan JNE</h5>
    <p class='card-text'>Barang yang sudah di beli tidak dapat di kembalikan dalam bentuk apapun, Adapun Daftar Harga Pengiriman dalam /1 Kg di Koto-kota anda sebagai berikut:</p>";
	 include"ongkir.php";
  echo"</div>
  <div class='card-footer'>Footer</div>
</div>
";    
}

////////////////////////////////////////////////////////////////////////////////////////////
elseif($aksi=='obral'){
  echo "<h2 class='nama'>Obral</h2><div class='bok4'>";

  $p = new Paging4;
  $batas = 8;
  $posisi = $p->cariPosisi($batas);

  $sql = mysqli_query($koneksi, "SELECT * FROM produk WHERE diskon!=0 ORDER BY id_produk DESC LIMIT $posisi, $batas");
  $jmldata = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk WHERE diskon!=0"));
  $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);

  $jumlah = mysqli_num_rows($sql);

  if ($jumlah > 0) {
    while ($r = mysqli_fetch_array($sql)) {
      include "diskon_stok.php";

      echo "<div class='product-info'>
              <a href='index.php?l=lihat&aksi=detail&id_p={$r['id_produk']}'>
                <img src='foto/foto_produk/{$r['gambar']}' width='155' height='150' title='Lihat {$r['nama_produk']}' />
              </a>";

      if ($d != 0) {
        echo "<div class='newrotate'> &nbsp; {$r['diskon']}% </div>";
      }
      echo "<h2>{$r['nama_produk']}</h2>
            <h2 class='harga'>{$divharga}</h2>
            </div>";
    }
    echo "<div class='clr'></div></div>";
  } else {
    echo "<p align='center'>Tidak ada produk Diskon</p><br />";
  }

  $sql = mysqli_query($koneksi, "SELECT * FROM produk WHERE diskon='0' ORDER BY rand() LIMIT 6");

  echo "<h2 class='nama'><span>Lihat</span> Produk Ini</h2><div class='bok4'>";

  while ($r = mysqli_fetch_array($sql)) {
    include "diskon_stok.php";

    echo "<div class='product-info'>
            <a href='index.php?l=lihat&aksi=detail&id_p={$r['id_produk']}'>
              <img src='foto/foto_produk/{$r['gambar']}' width='155' height='150' title='Lihat {$r['nama_produk']}' />
            </a>";

    if ($d != 0) {
      echo "<div class='newrotate'> &nbsp; {$r['diskon']}% </div>";
    }
    echo "<h2>{$r['nama_produk']}</h2>
          <h2 class='harga'>{$divharga}</h2>
          </div>";
  }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
elseif($aksi=='testi'){
echo"<h2 class='nama'>Testimonial Pembeli</h2>
<div class='bok3'>
	";
include"testi.php";
 echo"</div>";
}

elseif($aksi=='detail'){
include"detailproduk.php";
}


elseif($aksi=='simpan'){
if( $_SESSION['kustomer'] ==''){
echo "<script>window.location=('loginmember/login.php?s=whis&id_p=" . $_GET['id_p'] . "')</script>";
}else{
$sql = mysqli_query($koneksi, "SELECT * FROM produk_sementara WHERE id_mem=" . $_SESSION['kustomer'] . " AND id_pro='" . $_GET['id_p'] . "'");
$ketemu = mysqli_num_rows($sql);
if($ketemu < 1 && $_GET['id_p'] != ''){
mysqli_query($koneksi, "INSERT INTO produk_sementara (id_mem, id_pro) VALUES ('" . $_SESSION['kustomer'] . "','" . $_GET['id_p'] . "')");
}

echo "
<h2 class='nama'>Daftar Keinginan Saya</h2>
<div class='bok2'>";
$sql = mysqli_query($koneksi, "SELECT * FROM produk_sementara, produk WHERE id_mem=" . $_SESSION['kustomer'] . " AND id_pro=id_produk");
$ketemu = mysqli_num_rows($sql);
if($ketemu < 1){
echo "Daftar Produk Keinginan Anda Belum Ada";
}
else{
include "daftarkeinginan.php";
}

echo "</div>";

}
}
elseif($aksi=='pesanansaya'){
echo "
<h2>Pesanan Saya</h2>
<div class='bok2'>";
$sql = mysqli_query($koneksi, "SELECT * FROM orders WHERE id_kustomer=" . $_SESSION['kustomer']);
$ketemu = mysqli_num_rows($sql);
if($ketemu < 1){
echo "Daftar Produk Keinginan Anda Belum Ada";
}
else{
include "pesanansaya.php";
}

echo "</div>";
}
elseif($aksi=='detailorder'){
include "detailpesanan.php";
}

elseif($aksi=='detail_tamu'){
include "detailpesanan_tamu.php";
}

elseif($aksi=='konfirmasi'){
include "konfirmasi.php";
}

elseif($aksi=='konfirmasi_tamu'){
include "konfirmasi_tamu.php";
}

////////////////////
elseif($aksi=='detail_b'){
$profil = mysqli_query($koneksi, "SELECT * FROM berita WHERE id_berita='" . $_GET['id_b'] . "'");
$r = mysqli_fetch_array($profil);

echo "<h2 class='nama'>" . $r['judul'] . "</h2>
<div class='bok3'><div class='tgl'>" . $r['tanggal'] . " - " . $r['jam'] . " | Dibaca : " . $r['dilihat'] . "x</div>";
if($r['gambar'] != '0'){echo "
<img src='foto/data/" . $r['gambar'] . "' border='0' width='230' class='gb7'/>";}
echo $r['isi'] . "
</div>
<div class='cl'></div>

<h2 class='nama'><span>Informasi </span> Lain</h2>
<div class='bok4'>";
$sqlz = mysqli_query($koneksi, "SELECT * FROM berita WHERE id_berita !='" . $_GET['id_b'] . "' ORDER BY id_berita DESC LIMIT 4");
while ($z = mysqli_fetch_array($sqlz)){

$isi_berita6 = strip_tags($z['isi']);
$isi6 = substr($isi_berita6,0,150);
$isi6 = substr($isi_berita6,0,strrpos($isi6," "));
echo "<div class='top' align=justify >

<div>
";
if($z['gambar'] != '0'){echo "<img src=foto/data/" . $z['gambar'] . " class=box-shadow2 width=70 height=60 align=left />";}else{echo "";}
echo " <div class='zt'><a href='index.php?l=lihat&aksi=detail_b&id_b=" . $z['id_berita'] . "&nama=" . $z['judul'] . "' >" . $z['judul'] . "</a></div><div class='tgl'>" . $z['tanggal'] . " - " . $z['jam'] . " | Dibaca : " . $z['dilihat'] . "x</div> " . $isi6 . ".... 
<div class='clear'></div></div><br />
</div>

";
}
echo "</div><div class='clr'></div>";


$sql = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY rand() LIMIT 8");

echo "<h2 class='nama'><span>Lihat</span> Produk Ini</h2>
<div class='bok4'>
";

while ($r = mysqli_fetch_array($sql)){

include "diskon_stok.php";

echo "

<div class='product-info'>
<a href='index.php?l=lihat&aksi=detail&id_p=" . $r['id_produk'] . "'>
<img src='foto/foto_produk/" . $r['gambar'] . "' width='155' height='150' title='Lihat " . $r['nama_produk'] . "' />
</a>
";
if ($d != 0){echo "
<div class='newrotate'>" . $r['diskon'] . "%</div>";
}else{echo "";
}
echo "
<h2>" . $r['nama_produk'] . "</h2>
<h2 class='harga'>" . $divharga . "</h2>
<div class='beli'><a href='aksi.php?module=keranjang&act=tambah&id=" . $r['id_produk'] . "'>Beli</a></div>

</div>";
}
echo "</div><div class='cl'></div>";

}

////////////////////////////////////////////////////////////////////////////////////////////
////////////////////
elseif($aksi=='info'){
echo"
<h2 class='nama'><span>Informasi </span> </h2>
<div class='bok4'>";
$sql=mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id_berita DESC LIMIT 4");
  while ($r=mysqli_fetch_array($sql)){

 $isi_berita6 = strip_tags($r['isi']); 
                $isi6 = substr($isi_berita6,0,200); 
                $isi6 = substr($isi_berita6,0,strrpos($isi6," ")); 
echo"<div class='top' align=justify >
           
              <div>
			 
";
if($r['gambar'] !=0){echo"<img src=foto/data/{$r['gambar']}  class=box-shadow2 width=150 height=120 align=left />";}else{echo"";}	
			  
			  echo" <div class='zt'><a href='index.php?l=lihat&aksi=detail_b&id_b={$r['id_berita']}&nama={$r['judul']}' >{$r['judul']}</a></div><div class='tgl'>{$r['tanggal']} - {$r['jam']} | Dibaca : {$r['dilihat']}x</div> $isi6.... 
			  <div class='clear'></div></div><br />
          </div>

";
}
echo"</div><div class='clr'></div>";


 $sql=mysqli_query($koneksi, "SELECT * FROM produk ORDER BY rand() LIMIT 8");
      
  echo "<h2 class='nama'><span>Lihat</span> Produk Ini</h2>
  <div class='bok4'>
  ";
      
  while ($r=mysqli_fetch_array($sql)){

  include "diskon_stok.php";

echo"

<div class='product-info'>
 <a href='index.php?l=lihat&aksi=detail&id_p={$r['id_produk']}'>
<img src='foto/foto_produk/{$r['gambar']}' width='155' height='150' title='Lihat {$r['nama_produk']}' />
</a>
";
     if ($d!=0){echo"
            <div class='newrotate'>{$r['diskon']}% </div>";
    }else{echo"";
    }
            echo"
            <h2>{$r['nama_produk']}</h2>
           <h2 class='harga'>{$divharga}</h2>
 <div class='beli'><a href='aksi.php?module=keranjang&act=tambah&id={$r['id_produk']}'>Beli</a></div>

</div>";
}
  echo"</div><div class='cl'></div>";
  if($jmldata >= $batas){ echo"
		 <div class='navi' align='center' >$linkHalaman </div><br />";}
     
}
elseif($aksi=='pembayaran'){
echo"
<h2 class='nama'>Pesanan Anda</h2>
<div class='bok2'>";

$sid = session_id();
	$sql = mysqli_query($koneksi, "SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysqli_num_rows($sql);
  if($ketemu < 1){
    echo "
<center><div class='bok4'>
	<strong>Belum Ada Produk Dikeranjang Anda Lihat <a href='?l=lihat&aksi=allproduk'>Katalog Produk</a></strong>
	</div></center>";
	 }
  else{  
  
    include"pembayaran.php";
  }

echo"</div>";
}

elseif($aksi=='pembayaran_tamu'){
echo"
<h2 class='nama'>Pesanan Anda</h2>
<div class='bok2'>";

$sid = session_id();
	$sql = mysqli_query($koneksi, "SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysqli_num_rows($sql);
  if($ketemu < 1){
    echo "
<center><div class='bok4'>
	<strong>Belum Ada Produk Dikeranjang Anda Lihat <a href='?l=lihat&aksi=allproduk'>Katalog Produk</a></strong>
	</div></center>";
	 }
  else{  
  
    include"pembayaran_tamu.php";
  }

echo"</div>";
}


elseif($aksi=='pembayaran1'){
echo"
<h2 class='nama'>Pesanan Anda</h2>
<div class='bok2'>";

$sid = session_id();
	$sql = mysqli_query($koneksi, "SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysqli_num_rows($sql);
  if($ketemu < 1){
    echo "
<center><div class='bok4'>
	<strong>Belum Ada Produk Dikeranjang Anda Lihat <a href='?l=lihat&aksi=allproduk'>Katalog Produk</a></strong>
	</div></center>";
	 }
  else{  
  
    include"akun_ku.php";
  }

echo"</div>";
}


elseif($aksi=='editpengiriman'){
echo"
<h2 class='nama'>Edit Pengiriman</h2>
<div class='bok2'>";
 
  
    include"editpengiriman.php";
 

echo"</div>";
}
////////////////////////////////////////////////////////////////////////////////////////////
elseif($aksi=='login'){
include"loginmember.php";
}
elseif($aksi=='gantilogin'){
  include"ganti_paswd.php";
  }
elseif($aksi=='buattoko'){
  echo "<div class='card'>
  <div class='card-header'></div>  
  <div class='card-body'>
    <form class='form-container' method='post' action='?l=lihat&aksi=prosesbuattoko'>
      <div class='form-title'><h2>Buat Toko dan jual Produk Bersama kami</h2></div>
      <div class='form-title'>Nama Toko</div>
      <input name='nama_toko' placeholder='Nama Lengkap " . $_SESSION['kustomer'] . "' type='text' required class='form-field' onKeyUp='this.value=this.value.replace(/[^A-Z | a-z]/g,\"\")'><br />
      <div class='form-title'>Deskripsi Toko</div>
      <input type='text' name='deskripsi' placeholder='Deskripsi Toko Anda' class='form-field' required>
      <br />
      <div class='form-title'>Alamat Toko</div>
      <input type='text' name='alamat_toko' placeholder='Alamat Toko Anda' class='form-field' required>
      <br />
      <div class='form-title'>Nama Bank</div>
      <input name='nama_bank' placeholder='Nama Bank Anda' type='text' class='form-field' required>
      <br />
      <div class='form-title'>Nomor Rekening</div>
      <input name='nomo_rekening' placeholder='Nomor Rekening Anda' class='form-field' type='text' required>
      <br />
      <div class='submit-container'>
        <input class='submit-button' type='submit' value='DAFTAR AKUN' />
      </div>
    </form> 
  </div>	
  </div>";
}
elseif($aksi=='prosesbuattoko'){
  $id_konsumen = $_POST['id_konsumen'];
  $nama_toko = $_POST['nama_toko'];
  $deskripsi = $_POST['deskripsi'];
  $alamat_toko = $_POST['alamat_toko'];
  $nomo_rekening = $_POST['nomo_rekening'];
  $nama_bank = $_POST['nama_bank'];
  if (empty($_POST['nama_toko'])){
    echo "<script>window.alert('Nama masih kosong');
           window.location=('javascript:history.go(-1)')</script>";
  } else {
    mysqli_query($koneksi, "INSERT INTO toko_konsumen (id_konsumen, nama_toko, deskripsi, alamat_toko, nomo_rekening, nama_bank, status_toko) 
     VALUES ('" . $_SESSION['kustomer'] . "', '$nama_toko', '$deskripsi', '$alamat_toko', '$nomo_rekening', '$nama_bank', 'pengajuan')");  
    echo "<script>window.alert('Pendaftaran di proses');
        window.location=('?l=lihat&aksi=buattoko')</script>";
  }
}
elseif($aksi=='kontak'){
  echo "<h2 class='nama'>Kontak <span>{$k_k['nama_perusahaan']}</span></h2>
  <div class='bok3'>";
  if($k_k['aktif']=='Y'){echo $k_k['peta'];}
  echo "<br /><br />
  <strong><center>
    {$k_k['alamat']}<br /><br />
    {$k_k['telepon']}, {$k_k['telepon_2']}<br /><br />
    {$k_k['email']}, {$k_k['email_2']}<br /><br />
    Jam Buka Toko:<br />
    {$k_k['jam_buka']}
  </center></strong>
  </div>
  <div class='cl'></div>";  
}
////////////////////////////////////////////////////////////////////////////////////////////
?>