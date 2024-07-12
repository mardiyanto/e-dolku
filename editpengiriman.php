

<link href="tema/keranjang.css" rel="stylesheet" type="text/css">
<script src="jquery-1-10-1.min.js"></script>
<? 
if(empty($_SESSION[email]) || empty($_SESSION[pass])){
echo "<script>window.alert('Silahkan Login Lebih Dahulu');
        window.location=('index.php?l=lihat&aksi=login&cek=cek')</script>";

}else{
?>
  <? 
  
    $editktp = mysql_query("SELECT * FROM kustomer,kota
									   WHERE kota.id_kota=kustomer.id_kota AND kustomer.id_kustomer=$_SESSION[kustomer]");
    $rk    = mysql_fetch_array($editktp);
	?>
<link rel="stylesheet" href="loginmember/registrasi_files/formoid1/formoid-metro-cyan.css" type="text/css" />
<script type="text/javascript" src="loginmember/registrasi_files/formoid1/jquery.min.js"></script>
<div class='bok4'>
<form name='NamaForm' class="formoid-metro-cyan" style="background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#000000;" method="post" action="log.php?aksi=editpengiriman">

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



		<div class="element-email">
	 <input type="submit" value="Simpan" />
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

<script type="text/javascript" src="loginmember/registrasi_files/formoid1/formoid-metro-cyan.js"></script>
<? }?>