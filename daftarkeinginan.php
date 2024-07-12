<link href="assets/css/keranjang.css" rel="stylesheet" type="text/css">
<form method=post action=aksi.php?module=keranjang&act=update>  
<div class='keranjang'>
<div class="Grup">
<li class="Wk">Produk</li>
<li class="Kk">Sisa Stok </li>

</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
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
  
    <td width='22%'><img src=foto/foto_produk/$r[gambar] width='150' ></td>
    <td width='41%' valign='top'>
	
	<div class='NM'>$r[nama_produk]</div>";
	if($r[diskon]!=0){echo"
	<div class='HG2'>Harga Satuan : <span>Rp.$harga</span> 
	<h2>Rp.$hargadisc</h2>
	</div>
	<div class='HG2'>Diskon <b>$r[diskon]%</b> </div>";
	}else{echo"
	<div class='HG'>Harga Satuan : <strong>Rp.$harga</strong></div>
	";}
    echo"
	</td>
    
    <td width='17%' align='center'>";
	if(	$r[stok]!=0){echo"$r[stok]";}else{echo"<img src='assets/images/kali.png' />";}
	echo"
	</td>
    <td width='20%' class='rela'>
	
	<div class='Bl'><a href='aksi.php?module=keranjang&act=tambah&whis=hapus&id_ps=$r[id_ps]&id=$r[id_produk]'>Beli</a></div>
	
	  <div class='Hl'><a href='aksi.php?module=keranjang&act=hapuswhis&id=$r[id_ps]'>
    Hapus</a></div>
	</td>
  </tr>
    <tr>
    <td colspan='4'><div  class='Ln'></div></td>
  </tr>
  
  ";
  $no++;
  }
  ?>
</table>

</div>

</form>


<!--

echo "
<form method=post action=aksi.php?module=keranjang&act=update>      
<table width='100%' border='0' cellspacing='2' cellpadding='2' >
  <tr>
    <td width='3%' height='32' align='center' valign='middle' bgcolor='#CCFFFF'><span class='at'>No</span></td>
    <td width='14%' align='center' valign='middle' bgcolor='#CCFFFF'><span class='at'>Produk</span></td>
    <td width='21%' align='center' valign='middle' bgcolor='#CCFFFF'><span class='at'>Nama Produk </span></td>
    <td width='15%' align='center' valign='middle' bgcolor='#CCFFFF'><span class='at'>Berat(Kg)</span></td>
    <td width='11%' align='center' valign='middle' bgcolor='#CCFFFF'><span class='at'>Jumlah</span></td>
    <td width='10%' align='center' valign='middle' bgcolor='#CCFFFF'><span class='at'>Harga</span></td>
    <td width='15%' align='center' valign='middle' bgcolor='#CCFFFF'><span class='at'>Sub Total </span></td>
    <td width='11%' align='center' valign='middle' bgcolor='#CCFFFF'><span class='at'>Hapus</span></td>
  </tr>
  ";  
  
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
    <td valign='middle' align='center' bgcolor='$wr'><strong>$no</strong></td>
	
	<input type=hidden name=id[$no] value=$r[id_orders_temp]>
	
    <td valign='middle' align='center' bgcolor='$wr'>
	<img src=foto/foto_produk/$r[gambar] width='50' height='50' class='gb5'></td>
	
    <td valign='middle' align='center' bgcolor='$wr'>$r[nama_produk]</td>
    <td valign='middle' align='center' bgcolor='$wr'>$r[berat]</td>
    <td valign='middle' align='center' bgcolor='$wr'>
	
	<select name='jml[$no]' value=$r[jumlah] onChange='this.form.submit()'>";
              for ($j=1;$j <= $r[stok];$j++){
                  if($j == $r[jumlah]){
                   echo "<option selected>$j</option>";
                  }else{
                   echo "<option>$j</option>";
                  }
              }
        echo "</select></td>
    <td valign='middle' align='center' bgcolor='$wr'>$hargadisc</td>
    <td valign='middle'align='center'  bgcolor='$wr'>$subtotal_rp</td>
    <td valign='middle'align='center' bgcolor='$wr'>
	<a href='aksi.php?module=keranjang&act=hapus&id=$r[id_orders_temp]'>
    <img src=assets/images/kali.png border=0 title=Hapus></a></td>
  </tr>
  ";
    $no++; 
  } 
  echo "
  <tr>
    <td colspan='8' align='right'>
	
	<strong>Total : Rp. <b>$total_rp</strong></b>
	
	</td>
  </tr>
</table></form><br><br><br>
<div class='kiri'><a href='javascript:history.go(-1)' class='button'>Lanjutkan</a></div>

<div class='kanan'><a href='index.php?l=lihat&aksi=cekout&login=login' class='button'>Selesai </a></div>
<br>
<br />
        *) Total harga diatas belum termasuk ongkos kirim yang akan dihitung saat <b>Selesai Belanja</b>.
";
-->