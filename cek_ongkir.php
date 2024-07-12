<?php 
  session_start();	
  include "config/koneksi.php";
	include "config/fungsi_indotgl.php";
	include "config/class_paging.php";
	include "config/fungsi_combobox.php";
	include "config/library.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_rupiah.php";
   $aksi=$_GET[aksi];

 
	
?>

<script src="jquery-1-10-1.min.js"></script>


	
<form action="?aksi=cek_ongkos&c=cek_kota" method="post"> 			
    <div class="row">
                    	
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        	
                            <div class="carousel-heading">
                                <h4>Cek Ongkos Kirim</h4>
                                <div class="carousel-arrows">
									
								</div>
                            </div>
                            
                            <div class="page-content">
                            	<div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                    	<p>Provinsi</p>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
									<div class="iconic-input">
		 <select id="provinsi" name="provinsi"  class='diisi' required>

			<option value="">-= Pilih Provinsi =-</option>

			<?php

				$sql_prov =mysql_query("SELECT * FROM kota group by kabupaten ORDER by kabupaten ASC");
				while ( $r = mysql_fetch_array($sql_prov) ){ 

			?>
					<option value="<?php echo $r['kabupaten']; ?>"> <?php echo $r['kabupaten']; ?> </option>

			<?php } /* end while */	?>

		</select>
                                    </div>	
                                    </div>
                                </div>
                                
                       
		 <div id="kota"></div>			   
					   

                                
                                    
  <div class="row">
                                    
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                    	<p></p>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                    	<input class="big" type="submit" value="Cek Data">
                                       
                                    </div>	
                                    
                                </div>


                            </div>
                            
                    	</div>
                          
                    </div>
					
					</form>
<?	
if($_GET[c]=='cek_kota'){

				$cek =mysql_query("SELECT * FROM kota where id_kota=$_POST[kota] ");
				$c = mysql_fetch_array($cek);
				$ha   = number_format($c[ongkos_kirim],0,",",".");
				?>
	
	 <div class="row">
                    	
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        	
                   
                            <table class="orderinfo-table">

                                <tr>
                                	<th style='background-color: #FF9900; color:#000000;'>Kota Tujuan</th>
                                    <td ><b><?=$c[kabupaten]?>, <?=$c[nama_kota]?></b></td>
                                </tr> 
                                
                                <tr>
                                	<th>Ongkos Kirim</th>
                                    <td><b>Rp.<?=$ha?>/Kg</b></td>
                                </tr>
                                 
                               
                            </table>
                         
                        </div>
                        
                    </div>  
	<? }?>
			
	<script>

	$(function(){ // sama dengan $(document).ready(function(){

		$('#provinsi').change(function(){

			$('#kota').html("<img src='ajax-loader.gif'>"); //Menampilkan loading selama proses pengambilan data kota

			var id = $(this).val(); //Mengambil id provinsi

			$.get("kota1.php", {id:id}, function(data){
				$('#kota').html(data);
			});
		});

	});
	
	

	</script>