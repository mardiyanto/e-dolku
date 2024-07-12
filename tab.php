<script type="text/javascript" src="tab/jquery22.js"></script>
<script type="text/javascript">
var $ko = jQuery.noConflict();
$ko(document).ready(function() {

	$ko(".tab_content").hide();
	$ko(".tab_content:first").show(); 

	$ko("ul.tabs li").click(function() {
		$ko("ul.tabs li").removeClass("active");
		$ko(this).addClass("active");
		$ko(".tab_content").hide();
		var activeTab = $ko(this).attr("rel"); 
		$ko("#"+activeTab).fadeIn(); 
	});
});

</script> 
<div class="card">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills tabs">
      <li class="nav-item" rel="tab2">
        <a class="nav-link" >Komentar</a>
      </li>
      <li class="nav-item" rel="tab3">
        <a class="nav-link"  >Produk Kami</a>
      </li>
    </ul>
  </div>
  <div class="card-body tab_content" id="tab2">
    <? include"komentar.php"; ?>
  </div>
    <div class="tab_content" id="tab3">
   <?
 $sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT 6"); 
  while ($r=mysql_fetch_array($sql)){

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
</div>";
 }
?>
  </div>
</div>