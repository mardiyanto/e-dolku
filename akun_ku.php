

<link href="tema/keranjang.css" rel="stylesheet" type="text/css">
<script src="jquery-1-10-1.min.js"></script>
<div class='keranjang'>
<table class='table' width='100%' >
  <tr>
   
   <th width="16%">Gambar</th>
   <th width="50%">Menu Produk</th>
   <th width="11%">Jumlah</th>
   <th width="20%">Total</th>
   
  </tr>
  <?
$no=1;
  while($r=mysql_fetch_array($sql)){
    $disc        = ($r[diskon]/100)*$r[harga];
    $hargadisc   = number_format(($r[harga]-$disc),0,",",".");

    $subtotal    = ($r[harga]-$disc) * $r[jumlah];
    $total       = $total + $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($r[harga]);
    if($r[best]=='Y'){$wr='#FFCC99';}else{$wr='#CCCCCC';}
    echo "
  <tr>
    <input type=hidden name='id[$no]' value='$r[id_orders_temp]'>
    <td><img src=foto/foto_produk/$r[gambar] width='150' ></td>
    <td>
	<div class='NM'>$r[nama_produk]</div>";
	if($r[diskon]!=0){echo"
	<div class='HG'>Harga Satuan : <strong>Rp.$harga</strong></div>
	<div class='HG'>Diskon <b>$r[diskon]%</b></div>";
	}else{echo"<div class='HG'>Harga Satuan : <strong>Rp.$harga</strong></div>";}
    echo"
	</td>
    <td align='center'>$r[jumlah]</td>
    <td>Rp.$subtotal_rp</td>

  </tr>";
  }
  ?>
  
  <tr >
    <td colspan="3" style="background-color:#E2F8FC; "><div style="float:right;">TOTAL BELANJA :</div></td>
    <td colspan="2" style=" background-color:#FCEAD1"><strong>Rp.<?=$total_rp?></strong></td>
    </tr>
</table>
</div>
<? 
if(empty($_SESSION[email]) || empty($_SESSION[pass])){
echo "<script>window.alert('Silahkan Login Lebih Dahulu');
        window.location=('index.php?l=lihat&aksi=login&cek=cek')</script>";

}else{
?>
  <? 
 $editkt  = mysql_query("SELECT * FROM orders,
									   kustomer,
									   kota
									   WHERE kota.id_kota= kustomer.id_kota AND orders.id_kustomer=kustomer.id_kustomer AND kustomer.id_kustomer=$_SESSION[kustomer] ");
    
    $rk    = mysql_fetch_array($editkt);
	?>
  <? 
  
    $editktp = mysql_query("SELECT * FROM kustomer
									   WHERE kustomer.id_kustomer=$_SESSION[kustomer]");
    $rkp    = mysql_fetch_array($editktp);
	?>
<link rel="stylesheet" href="loginmember/registrasi_files/formoid1/formoid-metro-cyan.css" type="text/css" />
<script type="text/javascript" src="loginmember/registrasi_files/formoid1/jquery.min.js"></script>
<div class='bok4'>
<form name='NamaForm' class="formoid-metro-cyan" style="background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#000000;" method="post" action="log.php?aksi=pembayaran">
<div class="title"><h2>Data Anda</h2></div>
	<div class="element-input">
	<label class="title">Nama Lengkap<span class="required">*</span></label>
	<input class="large" type="text" name="NM" value="<?=$rk[nama_lengkap]?>" required="required"/>
	</div>
	
	<div class="element-number">
	<label class="title">Telphone<span class="required">*</span></label>
	<input class="large" type="text" value="<?=$rk[telpon]?>" onKeyUp="this.value=this.value.replace(/[^0-9]/g,'')"  maxlength="12" name="HP" required="required" />
	</div>
	<div class="title"><h2>Keterangan Barang</h2></div>
	<div class="element-input">
	<label class="title">Tuliskan ukuran,warna barang yang anda beli di form ini <span class="required">*</span></label>
	<textarea  id='editor1' name='ketbar' class='smallInput wide' rows='7' cols='30'></textarea>
	</div>
	

	<div class="title"><h2>Alamat Pengiriman</h2></div>
		<div class="country">

<label class="subtitle">&nbsp;</label></span><label class="">Provinsi*</label>
	<select id="provinsi" name="provinsi">

			<option value="" >-= Pilih Provinsi =-</option>
			<option value="<?=$rk[kabupaten]?>" selected ><?=$rk[kabupaten]?></option>
			<?php

				$sql_prov =mysql_query("SELECT * FROM kota group by kabupaten ORDER by kabupaten ASC");
				while ( $r = mysql_fetch_array($sql_prov) ){ 

			?>
					<option value="<?php echo $r['kabupaten']; ?>"> <?php echo $r['kabupaten']; ?> </option>

			<?php } /* end while */	?>

		</select>
		<input  type="hidden"  name="KC" value="<?=$rk[id_kota]?>">
	
<label class="subtitle">&nbsp;</label></span><label class="">Pilih Kabupaten/Kota</label>
	<select id="kota" name="kota">
	<option value="<?=$rk[nama_kota]?>" selected ><?=$rk[nama_kota]?></option>
			<option value="" >-= Pilih Kabupaten/Kota =-</option>
			
		</select>

<label class="subtitle">&nbsp;</label></span><label class="">Kecamatan Pengiriman</label>
	<select id="kec" name="KC">
<option value="<?=$rk[id_kota]?>" selected ><?=$rk[kel]?></option>
			<option value="" >-= Pilih Kecamatan =-</option>
			
		</select>
	
		



<label class="subtitle">&nbsp;</label></span>
<label class="">Alamat Lengkap Desa/Kelurahan Rt/RW*</label>
<textarea  id='editor1' name='DESO' class='smallInput wide' rows='7' cols='30'><?=$rk[ndeso]?></textarea>


<label class="subtitle">&nbsp;</label></span>
<label class="">Kode Pos*</label>
<input class="large" type="text" name="POS" maxlength="7" value="<?=$rk[kd_pos]?>" onKeyUp="this.value=this.value.replace(/[^0-9]/g,'')" required/>

<label class="subtitle">&nbsp;</label></span>
<label class="">Alamat Alternatif</label>
<input  class="large" type="text" name="ALMT" value="<?=$rk[alm_alt]?>" />
</div>
<i></i>
<label class="subtitle">&nbsp;</label>



	
	
	<div class="title"><h2>Metode Pengiriman & Pembayaran</h2></div>
	
	
		<div class="element">
	<label class="title">Metode Pengiriman Barang<span >*</span></label><div class="large"><span>		
	    <select name="MP" required>
		 <option value="null" selected>--- Pilih Metode Pengiriman Barang---</option>
		<option value="Kirim Kurir JNE">Kirim Kurir JNE</option>

		</select>
		<i></i></span></div></div>
	
	
			<div class="element">
	<label class="title">Metode Pembayaran<span >*</span></label><div class="large"><span>			
	    <select name="pembayaran" onchange='DisplayShowHide()' required>
<option value="null" selected>--- Pilih Metode Pembayaran---</option>
		 
		<option value="Bank Transfer">Bank Transfer</option>

		</select>
		<i></i></span></div></div>
	





	<div class="element" id='DivTampil' style='display:none'>
	<label class="title">Tranfer Ke Bank<span >*</span></label><div class="large"><span>
	<select name="bank" >
   
	  <?
      $bank=mysql_query("SELECT * FROM bank ORDER BY id_bank ASC");
      while($BK=mysql_fetch_array($bank)){
         echo "<option value='$BK[id_bank]'>$BK[nm_bank]</option>";
      }?>
	</select>
	<i></i></span></div></div>


		<div class="element-email">
	 <input type="submit" value="Lanjutkan Pembayaran" />
	</div><br />



</form>
</div>
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
<? }?>