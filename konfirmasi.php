
<!-- Start Formoid form-->
<link rel='stylesheet' href='loginmember/registrasi_files/formoid1/formoid-metro-cyan.css' type='text/css' />
<script type='text/javascript' src='loginmember/registrasi_files/formoid1/jquery.min.js'></script>
<?php
    $edit = mysqli_query($koneksi, "SELECT * FROM orders
									   JOIN kustomer ON kustomer.id_kustomer = orders.id_kustomer
									   JOIN kota ON kota.id_kota = orders.id_kota_o
									   JOIN bank ON bank.id_bank = orders.id_bank_o
									   WHERE kota.id_kota = orders.id_kota_o AND bank.id_bank = orders.id_bank_o AND id_orders = '{$_GET['id']}' AND kustomer.id_kustomer = {$_SESSION['kustomer']}");
    $r = mysqli_fetch_array($edit);

// tampilkan rincian produk yang di order
  $sql2 = mysqli_query($koneksi, "SELECT * FROM orders_detail
                     JOIN produk ON orders_detail.id_produk = produk.id_produk 
                     WHERE orders_detail.id_orders = '{$_GET['id']}'");
                     
  while($s = mysqli_fetch_array($sql2)){
     // rumus untuk menghitung subtotal dan total		
   $disc = ($s['diskon'] / 100) * $s['harga'];
   $discmember = (2 / 100) * $s['harga'];
   $hargadisc = number_format(($s['harga'] - $disc), 0, ",", ".");
   $subtotal = ($s['harga'] - $disc - $discmember) * $s['jumlah'];

    $total += $subtotal;
    $subtotal_rp = format_rupiah($subtotal);    
    $total_rp = format_rupiah($total);    
    $harga = format_rupiah($s['harga']);

   $subtotalberat = $s['berat'] * $s['jumlah']; // total berat per item produk 
   $totalberat += $subtotalberat; // grand total berat all produk yang dibeli
   
   }
   
 $ongkos = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kota
          JOIN kustomer ON orders.id_kustomer = kustomer.id_kustomer
          WHERE orders.id_kota_o = kota.id_kota AND orders.id_kustomer = kustomer.id_kustomer AND id_orders = '{$_GET['id']}'"));
  $ongkoskirim1 = $ongkos['ongkos_kirim'];
  $ongkoskirim = $ongkoskirim1 * $totalberat;

  $grandtotal = $total + $ongkoskirim; 

  $ongkoskirim_rp = format_rupiah($ongkoskirim);
  $ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
  $grandtotal_rp = format_rupiah($grandtotal);    
?>
<?php
$edit = mysqli_query($koneksi, "SELECT * FROM kustomer WHERE kustomer.id_kustomer = {$_SESSION['kustomer']}");
    $z = mysqli_fetch_array($edit);
?>
<h4 class='nama'>Konfirmasi Pesanan #<?=$_GET['id']?></h4>
<form class='formoid-metro-cyan' style='background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#000000;max-width:80%;min-width:150px' enctype='multipart/form-data' method='post' action='aksi_konfirmasi.php?A=I'>
<br>
	<div class='element-input'>
	<label class='title'>Nomer Order<span class='required'>*</span></label>
	<input class='large' type='text' name='NO' value='<?=$_GET['id']?>' onKeyUp='this.value=this.value.replace(/[^0-9]/g,'')' required disabled />
	 <input type="hidden"  name="NO" value='<?=$_GET['id']?>'>
	</div>
	
	<div class='element-input'>
	<label class='title'>Nama Pengirim/Pemilik Rekening<span class='required'>*</span></label>
	<input class='large' type='text' name='NAMA' value='<?=$r['nama_lengkap']?>' onKeyUp='this.value=this.value.replace(/[^A-Z | a-z]/g,'')' required='required'/>
	</div>
	
	<div class='element'>
	<label class='title'>Nama Bank<span class='required'>*</span></label>
	<div class='large'><span>
	<select name='BANK' required='required'>
      <option value='' selected>--- Pilih Bank Pengirim ---</option>
	  <option value="<?=$r['nm_bank']?>" selected><?=$r['nm_bank']?></option>
	  <?php
      $bank = mysqli_query($koneksi, "SELECT * FROM bank ORDER BY id_bank ASC");
      while($BK = mysqli_fetch_array($bank)){
         echo "<option value='$BK[nm_bank]'>$BK[nm_bank]</option>";
      }?>
	  <option value='Bank Lain'>Bank Lain</option>
	</select>
	<i></i></span></div>
	</div>
	
	<div class='element-number'>
	<label class='title'>Nomer Rekening Pemilik</label>
	<input class='large' type='text' name='NR'  value='<?=$_POST['NR']?>' onKeyUp='this.value=this.value.replace(/[^0-9]/g,'')' value=''/>
	</div>
	
	<div class='element'>
	<label class='title'>Metode Tranfer<span class='required'>*</span></label>
	<div class='large'><span>
		<select name='MT' required='required'>
		 <option value="<?=$r['m_transfer']?>" selected><?=$r['m_transfer']?></option>
		<option value="ATM">ATM</option>
		<option value="E-Banking">E-Banking</option>
		<option value="Counter Bank">Counter Bank</option>
		<option value="M-Banking">M-Banking</option>
		</select>
		<i></i></span></div>
	</div>
	
	<div class='element-input'>
	<label class='title'>Tanggal Transfer<span class='required'>*</span></label>
	<input class='large' type='date' name='TGL' required='required'/>
	</div>
	<div class='element-input'>
	<label class='title'>Upload Bukti Tranfer<span class='required'>*</span></label>
	<input class='large' type='file' name='fupload' required='required'/>
	</div>
	<div class='element-input'>
	<label class='title'>Jumlah Transfer<span class='required'>*</span></label>
	<?
	if($r['m_pengiriman'] == 'Kirim Kurir JNE'){
echo"
	  <input class='large' type='text' name='asa' value='$grandtotal' onKeyUp='this.value=this.value.replace(/[^0-9]/g,'')' required disabled>
	 <input type='hidden'  name='JT' value='$grandtotal' >
	  ";
}else{
echo"
  <input class='large' type='text' name='asa' value='$total' onKeyUp='this.value=this.value.replace(/[^0-9]/g,'')' required disabled>
	 <input type='hidden'  name='JT' value='$total' >
";
}
	
	?>

	</div>
	<div ><strong>Keterangan : </strong> Kosongkan 'Nomer Rekening Pemilik' Jika Menggunakan Metode Tranfer 'Counter Bank'</div>
<div class='submit3'><br>

<input type='submit' value='Kirim Konfirmasi'/>

</div><br>


</form>
<script type='text/javascript' src='loginmember/registrasi_files/formoid1/formoid-metro-cyan.js'></script>
