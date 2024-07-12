
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
<a type="button" class="btn btn-secondary" href="index.php?l=lihat&aksi=allproduk"><i class="fa fa-home"></i> Home</a>
<a type="button" class="btn btn-success" href="?l=lihat&aksi=pembayaran&cek=cek"><i class="fa fa-fw fa-money"></i> Bayar</a>








