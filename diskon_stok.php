<?php
    // diskon  
    $harga     = format_rupiah($r[harga]);
    $disc      = ($r[diskon]/100)*$r[harga];
    $hargadisc = number_format(($r[harga]-$disc),0,",",".");
	$hemat= number_format($disc,0,",",".");

    $d=$r['diskon'];
    $hargatetap  = "<span style=\"color:#000;font-size:14px;\"> Rp.<b>$hargadisc</b></span>";
    $hargadiskon = "<span style='color:#000;font-size:12px; text-decoration:line-through;' class='harga'>Rp.$harga </span>
                    <span style=\"color:#ff0000;font-size:12px;\">Rp.<b>$hargadisc</b></span>";
    if ($d!=0){
      $divharga=$hargadiskon;
    }else{
      $divharga=$hargatetap;
    } 

    // tombol stok habis kalau stoknya 0
    $stok        = $r['stok'];
    $tombolbeli  = " <a href='aksi.php?module=keranjang&act=tambah&id=$r[id_produk]' class='kiri'>Beli</a>
	
	";
    $tombolhabis = "<img src='assets/images/cart_hbs.png' class='gb' />";
    if ($stok!=0){
      $tombol=$tombolbeli;
    }else{
      $tombol=$tombolhabis;
    } 
?>
