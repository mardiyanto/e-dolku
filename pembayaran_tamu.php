

<script src="jquery-1-10-1.min.js"></script>
<form method=post action=aksi.php?module=keranjang&act=update>  
<div class="table-responsive table--no-card m-b-30">
<table class="table">
  <tr>
   
   <th width="16%">Gambar</th>
   <th width="50%">Menu Produk</th>
  </tr>
  <?
  $sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysql_num_rows($sql);
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
	<div >Diskon <b><div type='button' class='btn btn-danger'>$r[diskon]%</b></div></div>";
	}else{echo"<div class='HG'>Harga Satuan : <strong>Rp.$harga</strong></div>";}
    echo"
	<div class='HG'>Total : <b>Rp.$subtotal_rp</b></div>
		Jumlah : <select name='jml[$no]' value=$r[jumlah] onChange='this.form.submit()'>";
              for ($j=1;$j <= $r[stok];$j++){
                  if($j == $r[jumlah]){
                   echo "<option selected>$j</option>";
                  }else{
                   echo "<option>$j</option>";
                  }
              }
        echo "</select> <a type='button' class='btn btn-danger' href='aksi.php?module=keranjang&act=hapus&id=$r[id_orders_temp]'>
    <i class='fa fa-fw fa-trash'></i></a>
	</td>
  </tr>";
  }
  ?>
  
  <tr>
    <td colspan="1" style="background-color:#E2F8FC; "><div style="float:right;">TOTAL BELANJA :</div></td>
    <td colspan="1" style=" background-color:#FCEAD1"><strong>Rp.<?=$total_rp?></strong></td>
    </tr>
</table>
</div>
</form>

<link rel="stylesheet" href="loginmember/registrasi_files/formoid1/formoid-metro-cyan.css" type="text/css" />
<script type="text/javascript" src="loginmember/registrasi_files/formoid1/jquery.min.js"></script>
<div class='bok4'>
<form name='NamaForm' class="formoid-metro-cyan" style="background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#000000;" method="post" action="log.php?aksi=pembayaran_tamu">
<div class="title"><h2>Data Anda</h2></div>
	<div class="element-input">
	<label class="title">Nama Lengkap<span class="required">*</span></label>
	<input class="large" type="text" name="NM"  required="required"/>
	</div>
	
	<div class="element-input">
	<label class="title">Email<span class="required">*</span></label>
	<input class="large" type="text" name="email"  required="required"/>
	</div>
	
	<div class="element-number">
	<label class="title">Telphone<span class="required">*</span></label>
	<input class="large" type="text"  onKeyUp="this.value=this.value.replace(/[^0-9]/g,'')"  maxlength="12" name="HP" required="required" />
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

			<option value="" selected  >-= Pilih Provinsi =-</option>
			<?php

				$sql_prov =mysql_query("SELECT * FROM kota group by kabupaten ORDER by kabupaten ASC");
				while ( $r = mysql_fetch_array($sql_prov) ){ 

			?>
					<option value="<?php echo $r['kabupaten']; ?>"> <?php echo $r['kabupaten']; ?> </option>

			<?php } /* end while */	?>

		</select>
		<input  type="hidden"  name="KC" >
	
<label class="subtitle">&nbsp;</label></span><label class="">Pilih Kabupaten/Kota</label>
	<select id="kota" name="kota">
			<option value="" selected >-= Pilih Kabupaten/Kota =-</option>
			
		</select>

<label class="subtitle">&nbsp;</label></span><label class="">Kecamatan Pengiriman</label>
	<select id="kec" name="KC">
			<option value="" selected >-= Pilih Kecamatan =-</option>
			
		</select>
	
		



<label class="subtitle">&nbsp;</label></span>
<label class="">Alamat Lengkap Desa/Kelurahan Rt/RW*</label>
<textarea  id='editor1' name='DESO' class='smallInput wide' rows='7' cols='30'></textarea>


<label class="subtitle">&nbsp;</label></span>
<label class="">Kode Pos*</label>
<input class="large" type="text" name="POS" maxlength="7" onKeyUp="this.value=this.value.replace(/[^0-9]/g,'')" required/>

<label class="subtitle">&nbsp;</label></span>
<label class="">Alamat Alternatif</label>
<input  class="large" type="text" name="ALMT"  />
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
