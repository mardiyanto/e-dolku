
<?php
// PHP 7 Support
$sid = session_id();
$sql = mysqli_query($koneksi, "SELECT * FROM orders_temp INNER JOIN produk ON orders_temp.id_produk = produk.id_produk WHERE id_session='$sid'");
$ketemu = mysqli_num_rows($sql);
$no = 1;
$total = 0;

while ($r = mysqli_fetch_array($sql)) {
    $disc = ($r['diskon'] / 100) * $r['harga'];
    $hargadisc = number_format(($r['harga'] - $disc), 0, ",", ".");
    $subtotal = ($r['harga'] - $disc) * $r['jumlah'];
    $total += $subtotal;
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp = format_rupiah($total);
    $harga = format_rupiah($r['harga']);
    $wr = ($r['best'] == 'Y') ? '#FFCC99' : '#CCCCCC';

    echo "
    <tr>
        <input type='hidden' name='id[$no]' value='{$r['id_orders_temp']}'>
        <td><img src='foto/foto_produk/{$r['gambar']}' width='150'></td>
        <td>
            <div class='NM'>{$r['nama_produk']}</div>";

    if ($r['diskon'] != 0) {
        echo "
            <div class='HG'>Harga Satuan : <strong>Rp.{$harga}</strong></div>
            <div>Diskon <b><div type='button' class='btn btn-danger'>{$r['diskon']}%</b></div></div>";
    } else {
        echo "<div class='HG'>Harga Satuan : <strong>Rp.{$harga}</strong></div>";
    }

    echo "
            <div class='HG'>Total : <b>Rp.{$subtotal_rp}</b></div>
            Jumlah : <select name='jml[$no]' value='{$r['jumlah']}' onChange='this.form.submit()'>";

    for ($j = 1; $j <= $r['stok']; $j++) {
        if ($j == $r['jumlah']) {
            echo "<option selected>{$j}</option>";
        } else {
            echo "<option>{$j}</option>";
        }
    }

    echo "</select> <a type='button' class='btn btn-danger' href='aksi.php?module=keranjang&act=hapus&id={$r['id_orders_temp']}'>
        <i class='fa fa-fw fa-trash'></i></a>
        </td>
    </tr>";
    $no++;
}
?>

<tr>
    <td colspan="1" style="background-color:#E2F8FC;"><div style="float:right;">TOTAL BELANJA :</div></td>
    <td colspan="1" style="background-color:#FCEAD1"><strong>Rp.<?=$total_rp?></strong></td>
</tr>

</table>
</div>
</form>

<link rel="stylesheet" href="loginmember/registrasi_files/formoid1/formoid-metro-cyan.css" type="text/css" />
<script type="text/javascript" src="loginmember/registrasi_files/formoid1/jquery.min.js"></script>

<div class='bok4'>
<form name='NamaForm' class="formoid-metro-cyan" style="background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#000000;" method="post" action="log.php?aksi=pembayaran_tamu">
    <!-- Form content here -->
</form>
</div>

<script language="JavaScript" type="text/JavaScript">
    // JavaScript code here
</script>
