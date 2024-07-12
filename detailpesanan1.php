
<form method=post action=aksi.php?module=keranjang&act=update>  
<div class='keranjang'>

<?
    $edit = mysql_query("SELECT * FROM orders,
									   kustomer,
									   kota,
									   bank
									   WHERE kota.id_kota=orders.id_kota_o AND bank.id_bank=orders.id_bank_o AND id_orders='$_GET[id]' AND kustomer.id_kustomer=$_SESSION[kustomer] ");
    $r    = mysql_fetch_array($edit);
    

    echo "

<div class='content-module-main'>
<div class='cetak'><a href='index.php?l=lihat&aksi=pesanansaya'>Pesanan Saya</a></div>";

$konfirmasi=mysql_query(" SELECT * FROM konfirmasi WHERE id_order_p=$r[id_orders]");
$kn=mysql_fetch_array($konfirmasi);	
	if($kn[status]=='Baru'){
				echo"
					
					<div class='cetak' ><a>Menunggu konfirmasi</a></div>";		
					
					 	} 
					elseif($kn[status]=='Berhasil'){
				echo"					
					<div class='cetak2' ><a>Berhasil </a></div>";		
					
					} else{
					echo"<div class='cetak' ><a href='index.php?l=lihat&aksi=konfirmasi&id=$r[id_orders]' >Konfirmasi Pembayaran</a></div>";
					
					}
echo"
          <table class='table'>
		  <tr>
		    <th  colspan=2 > Data Order</th>
          </tr>
          <tr>
		 	 <td>No. Order</td>       
			  <td> : <strong>$r[id_orders]</strong></td>
		  </tr>
          <tr>
		 	 <td>Tgl. & Jam Order</td> 
			 <td> : <strong>$r[tgl_order]</strong> & <strong>$r[jam_order]</strong></td>
		  </tr>
          <tr>
		      <tr>
		 	 <td>Status Pengiriman Barang</td> 
			 <td> : <strong>$r[Ket]</strong></td>
		  </tr>
          <tr>
		  	<td>Status Order</td>
			<td>";
			if($r[status_order]=='Baru'){echo"<span style=\"color:#FF0000;\">Menunggu Pembayaran</span>";
	}else{echo"Lunas";}
			echo"</td>
		  </tr>
          </table><br />
";
  // tampilkan data kustomer
  echo "<table border=0 width=500 class='table'>
        <tr><th colspan=2>Data Anda</th></tr>
        <tr><td>Nama Kustomer</td><td> : <strong>$r[nama_lengkap]</strong></td></tr>
		<tr><td>No. Telpon/HP</td><td> : <strong>$r[telpon]</strong></td></tr>
	    <tr><td>Email</td><td> : <strong>$r[email]</strong></td></tr>
		</table></div><br />
		
		<table border=0 width=500 class='table'>
        <tr><th colspan=2>Data Pengiriman</th></tr>
        <tr><td>Alamat Pengiriman</td><td> <strong>$r[alamat]</strong></td></tr>

        <tr><td>Metode pengiriman</td><td> : <strong>$r[m_pengiriman]</strong></td></tr>
		<tr><td>Metode Pembayaran</td><td> : <strong>$r[m_pembayaran]</strong></td></tr>";
		if($r[m_pembayaran]=='Bank Transfer'){
		echo"
		<tr><td>Pilihan Bank</td><td> : Nama Bank : <strong>$r[nm_bank]</strong><br />
										&nbsp; Atas Nama : <strong>$r[at_nama]</strong><br />
										&nbsp; Nomer Rekening : <strong>$r[no_rek]</strong><br />
										&nbsp; Alamat Bank : <strong>$r[alm_bank]</strong>
										</td></tr>
			";
			}
			echo"
		</table><br />

		KETERANGAN : Untuk Metode Pengiriman <strong>KURIR KAMI</strong> Dikenakan Biaya Pengiriman
		<br /><br />
<br />

		";

  // tampilkan rincian produk yang di order
  $sql2=mysql_query("SELECT * FROM orders_detail, produk 
                     WHERE orders_detail.id_produk=produk.id_produk 
                     AND orders_detail.id_orders='$_GET[id]'");
  
  echo "<table border=0  class='table'>
        <tr>
		<th width='25%' ><div class='panjang'>Nama Produk</div></th>
        <th width='10%'>Jumlah</th>
		<th width='10%'>Diskon</th>
        <th width='20%'>Harga Satuan</th>
        <th width='50%'>Sub Total</th>
        </tr>";
  
  while($s=mysql_fetch_array($sql2)){
     // rumus untuk menghitung subtotal dan total		
   $disc        = ($s[diskon]/100)*$s[harga];
   $hargadisc   = number_format(($s[harga]-$disc),0,",","."); 
   $subtotal    = ($s[harga]-$disc) * $s[jumlah];

    $total       = $total + $subtotal;
    $subtotal_rp = format_rupiah($subtotal);    
    $total_rp    = format_rupiah($total);    
    $harga       = format_rupiah($s[harga]);

   $subtotalberat = $s[berat] * $s[jumlah]; // total berat per item produk 
   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli

    echo "<tr>
	<td><strong>$s[nama_produk]</strong></td>
	<td align=center>$s[jumlah]</td>
	<td align=center>$s[diskon]%</td>
    <td align=left><strong>Rp.$harga</strong></td>
	<td align='right'><strong>Rp.$subtotal_rp</strong></td>
	</tr>";
  }

  $ongkos=mysql_fetch_array(mysql_query("SELECT * FROM kota,kustomer,orders 
          WHERE orders.id_kota_o=kota.id_kota AND orders.id_kustomer=kustomer.id_kustomer AND id_orders='$_GET[id]'"));
  $ongkoskirim1=$ongkos[ongkos_kirim];
  $ongkoskirim=$ongkoskirim1 * $totalberat;

  $grandtotal    = $total + $ongkoskirim1; 

  $ongkoskirim_rp = format_rupiah($ongkoskirim);
  $ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
  $grandtotal_rp  = format_rupiah($grandtotal);    

echo "
      </table>";
if($r[m_pengiriman]=='Kirim Kurir Kami'){
echo"
	  <div class='Total2'>

<table width='100%' border='0' cellspacing='0' class='wew' cellpadding='7'>
  <tr>
    <td width='53%' align='left'>Total </td>
    <td width='15%'>: Rp </td>
    <td width='32%' align='left'><b>$total_rp</b></td>
  </tr>
  <tr>
    <td align='left'>Ongkos Kirim </td>
    <td>: Rp </td>
    <td align='left'><b>$ongkoskirim1_rp</b></td>
  </tr>
  
    <tr class='garis'>
      <td >Grand Total </td>
    <td>: Rp </td>
    <td align='left'><b>$grandtotal_rp</b></td>
  </tr>
</table>

</div>";
}else{
echo"
 <div class='Total2'>

<table width='100%' border='0' cellspacing='0' class='wew' cellpadding='7'>
  <tr>
    <td width='53%' align='left'>Total </td>
    <td width='15%'>: Rp </td>
    <td width='32%' align='left'><b>$total_rp</b></td>
  </tr>
  <tr>
    <td align='left'>Ongkos Kirim </td>
    <td>: Rp </td>
    <td align='left'><b>Rp.0</b></td>
  </tr>
  
    <tr class='garis'>
      <td >Grand Total </td>
    <td>: Rp </td>
    <td align='left'><b>$total_rp</b></td>
  </tr>
</table>

</div>";
}
	  



?>

</div>
