<script src="jquery-1-10-1.min.js"></script>
<form class="formoid-metro-cyan" action="index.php?l=lihat&aksi=ongkir&c=cek_kota" method="post"> 	
<div class='bok4'>	
<label class="subtitle">&nbsp;</label></span><label class="">Provinsi*</label>
	<select id="provinsi" class="form-control" name="provinsi">

			<option value="" selected  >-= Pilih Provinsi =-</option>
			<?php

				$sql_prov =mysql_query("SELECT * FROM kota group by kabupaten ORDER by kabupaten ASC");
				while ( $r = mysql_fetch_array($sql_prov) ){ 

			?>
					<option value="<?php echo $r['kabupaten']; ?>"> <?php echo $r['kabupaten']; ?> </option>

			<?php } /* end while */	?>

		</select>
		<input  type="hidden"  name="KC" value="<?=$rk[id_kota]?>">
	
<label class="subtitle">&nbsp;</label></span><label class="">Pilih Kabupaten/Kota</label>
	<select id="kota" class="form-control"  name="kota">
			<option value="" selected >-= Pilih Kabupaten/Kota =-</option>
			
		</select>

<label class="subtitle">&nbsp;</label></span><label class="">Kecamatan Pengiriman</label>
	<select id="kec" class="form-control" name="kota">
			<option value="" selected >-= Pilih Kecamatan =-</option>
			
		</select>
	<br />
	<div class="element-email">
	 <input type="submit" class="btn btn-primary" value="cek" />
	</div>
</form>
<?	
if($_GET[c]=='cek_kota'){

				$cek =mysql_query("SELECT * FROM kota where id_kota=$_POST[kota] ");
				$c = mysql_fetch_array($cek);
				$ha   = number_format($c[ongkos_kirim],0,",",".");
				?>
	<br />
	 <div class="row">
                    	
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        	
                   
                            <table class="orderinfo-table">

                                <tr>
                                	<th style='background-color: #FF9900; color:#000000;'>Kota Tujuan</th>
                                    <td ><b><?=$c[kabupaten]?>, <?=$c[nama_kota]?>,<?=$c[kel]?></b></td>
                                </tr> 
                                
                                <tr>
                                	<th>Ongkos Kirim</th>
                                    <td><b>Rp.<?=$ha?>/Kg</b></td>
                                </tr>
                                 
                               
                            </table>
                         
                        </div>
                        
                    </div>  
	<? }?>
<label class="subtitle">&nbsp;</label></span>
	
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
