<link href="assets/css/keranjang.css" rel="stylesheet" type="text/css">
<form method="post" action="aksi.php?module=keranjang&act=update">  
<div class='keranjang'>
<div class="Grup">
<li class="Wk">Produk</li>
<li class="Kk">Sisa Stok </li>

</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$no = 1;
while ($r = mysqli_fetch_array($sql)) {
    $disc = ($r['diskon'] / 100) * $r['harga'];
    $hargadisc = number_format(($r['harga'] - $disc), 0, ",", ".");

    $subtotal = ($r['harga'] - $disc) * $r['jumlah'];
    $total = $total + $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp = format_rupiah($total);
    $harga = format_rupiah($r['harga']);
    $wr = ($r['best'] == 'Y') ? '#FFCC99' : '#CCCCCC';
    echo "
    <tr>
        <input type='hidden' name='id[$no]' value='$r[id_orders_temp]'>
        <td width='22%'><img src='foto/foto_produk/$r[gambar]' width='150'></td>
        <td width='41%' valign='top'>
            <div class='NM'>$r[nama_produk]</div>";
            if ($r['diskon'] != 0) {
                echo "
                <div class='HG2'>Harga Satuan : <span>Rp.$harga</span> 
                <h2>Rp.$hargadisc</h2>
                </div>
                <div class='HG2'>Diskon <b>$r[diskon]%</b> </div>";
            } else {
                echo "
                <div class='HG'>Harga Satuan : <strong>Rp.$harga</strong></div>";
            }
            echo "
        </td>
        <td width='17%' align='center'>";
            if ($r['stok'] != 0) {
                echo "$r[stok]";
            } else {
                echo "<img src='assets/images/kali.png' />";
            }
            echo "
        </td>
        <td width='20%' class='rela'>
            <div class='Bl'><a href='aksi.php?module=keranjang&act=tambah&whis=hapus&id_ps=$r[id_ps]&id=$r[id_produk]'>Beli</a></div>
            <div class='Hl'><a href='aksi.php?module=keranjang&act=hapuswhis&id=$r[id_ps]'>Hapus</a></div>
        </td>
    </tr>
    <tr>
        <td colspan='4'><div class='Ln'></div></td>
    </tr>";
    $no++;
}
?>
</table>
</div>
</form>