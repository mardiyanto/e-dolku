<script src="jquery-1-10-1.min.js"></script>
<form method="post" action="aksi.php?module=keranjang&act=update">  
<div class="table-responsive table--no-card m-b-30">
<table class="table">
  <tr>
    <th width="16%">Gambar</th>
    <th width="50%">Menu Produk</th>
  </tr>
  <?php
$sid = session_id();
$sql = mysqli_query($koneksi, "SELECT * FROM orders_temp, produk 
                            WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
$ketemu = mysqli_num_rows($sql);
$no = 1;
$total = 0;
while ($r = mysqli_fetch_array($sql)) {
    $disc = ($r['diskon'] / 100) * $r['harga'];
    $hargadisc = number_format(($r['harga'] - $disc), 0, ",", ".");

    $subtotal = ($r['harga'] - $disc) * $r['jumlah'];
    $total += $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp = format_rupiah($total);
    $harga = format_rupiah($r['harga']);
    $wr = ($r['best'] == 'Y') ? '#FFCC99' : '#CCCCCC';
    echo "
  <tr>
    <input type='hidden' name='id[$no]' value='{$r['id_orders_temp']}'>
    <td><img src='foto/foto_produk/{$r['gambar']}' width='150'></td>
    <td>
    <div class='NM'>{$r['nama_produk']}</div>";
    if ($r['diskon'] != 0) {
        echo "
    <div class='HG'>Harga Satuan : <strong>Rp.{$harga}</strong></div>
    <div>Diskon <b><div type='button' class='btn btn-danger'>{$r['diskon']}%</b></div></div>";
    } else {
        echo "<div class='HG'>Harga Satuan : <strong>Rp.{$harga}</strong></div>";
    }
    echo "
    <div class='HG'>Total : <b>Rp.{$subtotal_rp}</b></div>
    Jumlah : <select name='jml[$no]' value='{$r['jumlah']}' onChange='this.form.submit()'>";
    for ($j = 1; $j <= $r['stok']; $j++) {
        if ($j == $r['jumlah']) {
            echo "<option selected>$j</option>";
        } else {
            echo "<option>$j</option>";
        }
    }
    echo "</select> <a type='button' class='btn btn-danger' href='aksi.php?module=keranjang&act=hapus&id={$r['id_orders_temp']}'>
    <i class='fa fa-fw fa-trash'></i></a>
    </td>
  </tr>";
}
?>
  
  <tr>
    <td colspan="1" style="background-color:#E2F8FC;"><div style="float:right;">TOTAL BELANJA :</div></td>
    <td colspan="1" style="background-color:#FCEAD1;"><strong>Rp.<?php echo $total_rp; ?></strong></td>
  </tr>
</table>
</div>
</form>

<?php 
if (empty($_SESSION['email']) || empty($_SESSION['pass'])) {
    echo "<script>window.alert('Silahkan Login Lebih Dahulu');
          window.location=('index.php?l=lihat&aksi=login&cek=cek')</script>";
} else {
    $editkt = mysqli_query($koneksi, "SELECT * FROM orders, kustomer, kota
                                   WHERE kota.id_kota = kustomer.id_kota AND orders.id_kustomer = kustomer.id_kustomer AND kustomer.id_kustomer = {$_SESSION['kustomer']}");
    $rk = mysqli_fetch_array($editkt);
    $cari = mysqli_num_rows($editkt);
    if ($cari == 0) {
        $kostume = mysqli_query($koneksi, "SELECT * FROM kustomer WHERE kustomer.id_kustomer = {$_SESSION['kustomer']}");
        $rkt = mysqli_fetch_array($kostume);
?>
<div class='bok4'>
<form name='NamaForm' method="post" action="log.php?aksi=pembayaran">
<div class="title"><h2>Data Anda</h2></div>
    <div class="element-input">
    <label class="title">Nama Lengkap<span class="required">*</span></label>
    <input class="form-control" type="text" name="NM" value="<?php echo $rkt['nama_lengkap']; ?>" required="required"/>
    </div>
    
    <div class="element-number">
    <label class="title">Telphone<span class="required">*</span></label>
    <input class="form-control" type="text" value="<?php echo $rkt['telpon']; ?>" onKeyUp="this.value=this.value.replace(/[^0-9]/g,'')"  maxlength="12" name="HP" required="required" />
    </div>
    <div class="title"><h2>Keterangan Barang</h2></div>
    <div class="element-input">
    <label class="title">Tuliskan ukuran,warna barang yang anda beli di form ini <span class="required">*</span></label>
    <textarea  class="form-control" id='editor1' name='ketbar' class='smallInput wide' rows='7' cols='30'></textarea>
    <input type="hidden" name="member" value="member" >
    </div>
    

    <div class="title"><h2>Alamat Pengiriman</h2></div>
        <div class="country">

<label class="subtitle">&nbsp;</label></span><label class="">Provinsi*</label>
    <select class="form-control" id="provinsi" name="provinsi">

            <option value="" selected  >-= Pilih Provinsi =-</option>
            <option value="<?php echo $rk['kabupaten']; ?>"><?php echo $rk['kabupaten']; ?></option>
            <?php

                $sql_prov = mysqli_query($koneksi, "SELECT * FROM kota group by kabupaten ORDER by kabupaten ASC");
                while ($r = mysqli_fetch_array($sql_prov)) { 

            ?>
                    <option value="<?php echo $r['kabupaten']; ?>"> <?php echo $r['kabupaten']; ?> </option>

            <?php } /* end while */ ?>

        </select>
        <input  type="hidden" class="form-control" name="KC" value="<?php echo $rk['id_kota']; ?>">
    
<label class="subtitle">&nbsp;</label></span><label class="">Pilih Kabupaten/Kota</label>
    <select class="form-control" id="kota" name="kota">
    <option value="<?php echo $rk['nama_kota']; ?>" ><?php echo $rk['nama_kota']; ?></option>
            <option value="" selected >-= Pilih Kabupaten/Kota =-</option>
            
        </select>

<label class="subtitle">&nbsp;</label></span><label class="">Kecamatan Pengiriman</label>
    <select class="form-control" id="kec" name="KC">
<option value="<?php echo $rk['id_kota']; ?>" ><?php echo $rk['kel']; ?></option>
            <option value="" selected >-= Pilih Kecamatan =-</option>
            
        </select>
    
        



<label class="subtitle">&nbsp;</label></span>
<label class="">Alamat Lengkap Desa/Kelurahan Rt/RW*</label>
<textarea  id='editor1' name='DESO' class="form-control" rows='7' cols='30'><?php echo $rk['ndeso']; ?></textarea>


<label class="subtitle">&nbsp;</label></span>
<label class="">Kode Pos*</label>
<input class="form-control" type="text" name="POS" maxlength="7" value="<?php echo $rk['kd_pos']; ?>" onKeyUp="this.value=this.value.replace(/[^0-9]/g,'')" required/>

<label class="subtitle">&nbsp;</label></span>
<label class="">Alamat Alternatif</label>
<input  class="form-control" type="text" name="ALMT" value="<?php echo $rk['alm_alt']; ?>" />
</div>
<i></i>
<label class="subtitle">&nbsp;</label>

    
    
    <div class="title"><h2>Metode Pengiriman & Pembayaran</h2></div>
    
    
        <div class="element">
    <label class="title">Metode Pengiriman Barang<span >*</span></label><span>        
        <select class="form-control" name="MP" required>
         <option value="null" selected>--- Pilih Metode Pengiriman Barang---</option>
        <option value="Kirim Kurir JNE">Kirim Kurir JNE</option>

        </select>
        <i></i></span></div>
    
    
            <div class="element">
    <label class="title">Metode Pembayaran<span >*</span></label><span>            
        <select class="form-control" name="pembayaran" onchange='DisplayShowHide()' required>
<option value="null" class="form-control" selected>--- Pilih Metode Pembayaran---</option>
            <option value="Bank Transfer">Bank Transfer</option>

        </select>
        <i></i></span></div>
    
<div class="element" id='DivTampil' style='display:none'>
    <label class="title">Tranfer Ke Bank<span >*</span></label><span>
    <select class="form-control" name="bank" >
   
      <?php
      $bank = mysqli_query($koneksi, "SELECT * FROM bank ORDER BY id_bank ASC");
      while ($BK = mysqli_fetch_array($bank)) {
         echo "<option value='{$BK['id_bank']}'>{$BK['nm_bank']}</option>";
      }?>
    </select>
    <i></i></span></div>

</br>
        <div class="element-email">
     <input type="submit" class="btn btn-primary" value="Lanjutkan Pembayaran" />
    </div><br />



</form>
</div>
<?php } else { ?>

<link rel="stylesheet" href="loginmember/registrasi_files/formoid1/formoid-metro-cyan.css" type="text/css" />
<script type="text/javascript" src="loginmember/registrasi_files/formoid1/jquery.min.js"></script>
<div class='bok4'>
<form name='NamaForm' class="formoid-metro-cyan" style="background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#000000;" method="post" action="log.php?aksi=pembayaran">

<table border=0 width=500 class='table'>
        <tr><th colspan=2>Data Anda</th></tr>
        <tr><td>Nama Kustomer</td><td> : <strong><?php echo $rk['nama_lengkap']; ?></strong></td></tr>
        <tr><td>No. Telpon/HP</td><td> : <strong><?php echo $rk['telpon']; ?></strong></td></tr>
        <tr><td>Email</td><td> : <strong><?php echo $rk['email']; ?></strong></td></tr>
                          
      
    


        <tr><td>Alamat Pengiriman</td><td> <strong> <?php echo $rk['kabupaten']; ?>,<?php echo $rk['nama_kota']; ?><br />
        Desa/Kelurahan : <?php echo $rk['ndeso']; ?><br />
                           Rt/Rw : <?php echo $rk['rtb']; ?>/<?php echo $rk['rwb']; ?><br />
                           Kedo pos : <?php echo $rk['kd_pos']; ?> <br />
                           Alamat Alternatif : <?php echo $rk['alm_alt']; ?><br />
        </strong></td></tr>    
        
        <tr><td colspan=2><div class='cetak'><a href='index.php?l=lihat&aksi=pembayaran1'>Edit Data</a></div></td></tr>
</table>
<input class="form-control" type="hidden" name="NM" value="<?php echo $rk['nama_lengkap']; ?>" required="required"/>
<input class="form-control" type="hidden" value="<?php echo $rk['telpon']; ?>" onKeyUp="this.value=this.value.replace(/[^0-9]/g,'')"  maxlength="12" name="HP" required="required" />
<input  type="hidden" name="provinsi" value="<?php echo $rk['kabupaten']; ?>" required="required"/>
<input  type="hidden"  name="KC" value="<?php echo $rk['id_kota']; ?>">
<input  type="hidden"  name="DESO" value="<?php echo $rk['ndeso']; ?>"  required/>
<input  type="hidden" name="POS" maxlength="7" value="<?php echo $rk['kd_pos']; ?>" onKeyUp="this.value=this.value.replace(/[^0-9]/g,'')" required/>
<input  type="hidden" name="OKRT" maxlength="3" value="<?php echo $rk['rtb']; ?>" onKeyUp="this.value=this.value.replace(/[^0-9]/g,'')"/>
<input  type="hidden" name="OKRW" maxlength="3" value="<?php echo $rk['rwb']; ?>" onKeyUp="this.value=this.value.replace(/[^0-9]/g,'')"/>
<input  class="form-control" type="hidden" name="ALMT" value="<?php echo $rk['alm_alt']; ?>" />
<input type="hidden" name="member" value="member" >
    
        <div class="title"><h2>Keterangan Barang</h2></div>
    <div class="element-input">
    <label class="title">Tuliskan ukuran,warna barang yang anda beli di form ini <span class="required">*</span></label>
    <textarea  id='editor1' name='ketbar' class='smallInput wide' rows='7' cols='30'></textarea>
    </div>
    <div class="title"><h2>Metode Pengiriman & Pembayaran</h2></div>
    
    
        <div class="element">
    <label class="title">Metode Pengiriman Barang<span >*</span></label><span>        
        <select class="form-control" name="MP" required>
         <option value="null" selected>--- Pilih Metode Pengiriman Barang---</option>
        <option value="Kirim Kurir JNE">Kirim Kurir JNE</option>
    
        </select>
        <i></i></span></div>
    
    
            <div class="element">
    <label class="title">Metode Pembayaran<span >*</span></label><span>            
        <select name="pembayaran" class="form-control" onchange='DisplayShowHide()' required>
<option value="null" selected>--- Pilih Metode Pembayaran---</option>
         
        <option value="Bayar Ditempat">Bayar Ditempat</option>
        <option value="Bank Transfer">Bank Transfer</option>

        </select>
        <i></i></span></div>
    




    <div class="form-control" id='DivTampil' style='display:none'>
    <label class="title">Tranfer Ke Bank<span >*</span></label><span>
    <select name="bank" >
   
      <?php
      $bank = mysqli_query($koneksi, "SELECT * FROM bank ORDER BY id_bank ASC");
      while ($BK = mysqli_fetch_array($bank)) {
         echo "<option value='{$BK['id_bank']}'>{$BK['nm_bank']}</option>";
      }?>
    </select>
    <i></i></span></div>


        <div class="element-email">
     <input type="submit" value="Lanjutkan Pembayaran" />
    </div><br />



</form>
</div>
<?php }?>
<script language="JavaScript" type="text/JavaScript">

    $(function(){ // sama dengan $(document).ready(function(){

        $('#provinsi').change(function(){

            $('#kota').html("<img src='ajax-loader.gif'>"); //Menampilkan loading selama proses pengambilan data kota

            var idkot = $(this).val(); //Mengambil id provinsi

            $.get("kota.php", {idkot:idkot}, function(data){
                $('#kota').html(data);
            });
        });
        
            $('#kota').change(function(){

            $('#kec').html("<img src='ajax-loader.gif'>"); //Menampilkan loading selama proses pengambilan data kota

            var id = $(this).val(); //Mengambil id provinsi

            $.get("kec.php", {id:id}, function(data){
                $('#kec').html(data);
            });
        });

    });

    </script>
<script language="JavaScript" type="text/JavaScript">
  function DisplayShowHide()
  {
  if (document.NamaForm.pembayaran.value == "Bank Transfer"){document.getElementById('DivTampil').style.display=""}
  if (document.NamaForm.pembayaran.value == "Bayar Ditempat"){document.getElementById('DivTampil').style.display="none"}  
 }
</script>
<script type="text/javascript" src="loginmember/registrasi_files/formoid1/formoid-metro-cyan.js"></script>
<?php }?>