<? $detail=mysql_query("SELECT * FROM produk,kategori WHERE produk.id_kategori=kategori.id_kategori AND	id_produk=$_GET[id_p]");
$dt=mysql_fetch_array($detail);
     $harga2     = format_rupiah($dt[harga]);
    $disc2      = ($dt[diskon]/100)*$dt[harga];
    $hargadisc2 = number_format(($dt[harga]-$disc2),0,",",".");
	
     include "diskon_stok.php";?>
<div class="card-group">
<div class="card border-ligh mb-3" style="max-width: 18rem;" >
<img class="card-img-top" src="foto/foto_produk/<?=$dt[gambar]?>" alt="<?=$dt[nama_produk]?>">	 
</div>
<div class="card border-ligh">
  <div class="card-body">
    <h5 class="card-title">&nbsp;<?=$dt[nama_produk]?></h5>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Kode Produk : <strong><?=$dt[id_produk]?> Berat : <strong><?=$dt[berat]?> Kg</li>
    <li class="list-group-item">Tipe : <?=$dt[nama_kategori]?> Stok : <strong style="color:#9933CC;"><?=$dt[stok]?> Item</li>
    <li class="list-group-item"><? if ($dt[diskon]==0){?>
<div class="hg">Rp.<?=$harga2?></div> 
<? }else{?>
<div class="hg_n">Rp.<?=$harga2?>   <div class='newrotate'><?=$dt[diskon]?>%</div></div> 
<div class="hg_d">Rp.<?=$hargadisc2?> </div> 
<? }?></strong></li>
  </ul>
    <div class="card-body">
    <p class="card-text"><?=$dt[deskripsi]?></p>
  </div>
  <div class="card-body">
  <?
 
	if ($dt[stok]==0){echo"<a href='#' class='btn btn-danger card-link'>Card link</a>";
    }else{echo"<a href='aksi.php?module=keranjang&act=tambah&id=$dt[id_produk]' class='btn btn-success card-link'>Beli Produk</a>";}

?>
<a href="index.php" class="btn btn-primary card-link">Produk Lain</a>
  </div>
</div>
</div>
<?include"tab.php";?>