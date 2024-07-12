<link rel="stylesheet" type="text/css" media="all" href="dualSlider/css/jquery.dualSlider.0.3.css" />

	<script src="dualSlider/scripts/jquery-1.3.2.min.js" type="text/javascript"></script>
	<script src="dualSlider/scripts/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="dualSlider/scripts/jquery.timers-1.2.js" type="text/javascript"></script>
	<script src="dualSlider/scripts/jquery.dualSlider.0.3.js" type="text/javascript"></script>
	<script type="text/javascript">
		
		$(document).ready(function() {
			
			$(".carousel").dualSlider({
				auto:true,
				autoDelay: 6000,
				easingCarousel: "swing",
				easingDetails: "easeOutBack",
				durationCarousel: 1000,
				durationDetails: 500
			});
			
		});

	</script>
	<div class="wrapper clearfix">
				<div class="carousel clearfix">
			<div class="panel">
			<div class='Diskon'>Spesial <span>Produk</span></div>
				<div class="details_wrapper">
					<br>

					<div class="details">
					
					<? $kat5=mysql_query("SELECT * FROM produk WHERE diskon	!='0' ORDER BY id_produk DESC LIMIT 8");
 while ($r=mysql_fetch_array($kat5)){ 
				include "diskon_stok.php";
  ?>
					
						<div class="detail">
						<div class="cardus">
						
						<div class="potongan"><?=$r[diskon]?>%</div>
						<a href='index.php?l=lihat&aksi=detail&id_p=<?=$r[id_produk]?>'><img src='foto/foto_produk/<?=$r[gambar]?>' alt='' width="153"   height=150 /></a>
						
						
							</div>
						<div class="Nm_p"><?=$r[nama_produk]?></div>
						<div class="Pr">
						
						<?=$divharga?>%</div>
						</div><!-- /detail -->
						
						<? }?>
						
					
					</div><!-- /details -->
					
				</div><!-- /details_wrapper -->
				
				<div class="paging">
					<div id="numbers"></div>
					<a href="javascript:void(0);" class="previous" title="Previous" >Previous</a>
					<a href="javascript:void(0);" class="next" title="Next">Next</a>
				</div><!-- /paging -->
				
				<a href="javascript:void(0);" class="play" title="Turn on autoplay">Play</a>
				<a href="javascript:void(0);" class="pause" title="Turn off autoplay">Pause</a>
					<div class="now2">
					<marquee onmouseover="this.stop()"onmouseout="this.start()" scrollamount="4">
					Ayo Buruan Diorder Sebelum Kehabisan.........!!!
					</marquee>
					</div>
				<div class="now"><img src="images/ordernow.png"></div>
			</div><!-- /panel -->
	
			<div class="backgrounds">
				<? $kat4=mysql_query("SELECT * FROM produk WHERE diskon='0' ORDER BY id_produk DESC LIMIT 4");
 while ($r=mysql_fetch_array($kat4)){ 
  $harga = number_format($r[harga],0,",",".");
 ?>
				<div class='item item_1'>
			<div class="Nm"><?=$r[nama_produk]?></div>
			<div class="Hg">Rp. <?=$harga?></div>
	
					<a href='index.php?l=lihat&aksi=detail&id_p=<?=$r[id_produk]?>'><img src='foto/foto_produk/<?=$r[gambar]?>' alt='' width="365"   height=340/>		
					</a>
				</div>
				<!-- /item -->
				<? }?>
				
			</div><!-- /backgrounds -->
			
			
		</div><!-- /carousel --> 
			
	</div>
<script type="text/javascript"> 
	
</script> 
<script type="text/javascript"> 
	try {
		var pageTracker = _gat._getTracker("UA-538792-1");
		pageTracker._trackPageview();
	} catch (err) { }
</script> 
