<?php
	$sid = session_id();
	$sql = mysql_query("SELECT SUM(jumlah*(harga-(diskon/100)*harga)) as total,SUM(jumlah) as totaljumlah FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
	
    //$disc        = ($r[diskon]/100)*$r[harga];
    //$subtotal    = ($r[harga]-$disc) * $r[jumlah];
		                
	while($r=mysql_fetch_array($sql)){

  if ($r['totaljumlah'] != ""){
    $total_rp    = format_rupiah($r['total']);
     
    echo " <div class='well well-small'><a id='myCart' href='index.php?l=lihat&aksi=kranjang'><img src='images/ico-cart.png' alt='cart'>$r[totaljumlah] Items <span class='badge badge-warning pull-right'>Rp.$total_rp </span></a></div>
";
	
	

  }
  else{
        echo "  <div class='well well-small'><a id='myCart' href='index.php?l=lihat&aksi=kranjang'><img src='images/ico-cart.png' alt='cart'>$r[totaljumlah] Items <span class='badge badge-warning pull-right'>Rp.$total_rp </span></a></div>
";
		
		  
  }
  }
?>

