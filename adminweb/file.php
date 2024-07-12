<?
$date=date ('Y-m-d');
$posting=mysql_query("SELECT SUM(stok)as b FROM produk");
$post=mysql_fetch_array($posting);

$kategori=mysql_query("SELECT COUNT(id_kategori)as ka FROM kategori");
$kate=mysql_fetch_array($kategori);

$galeri=mysql_query("SELECT COUNT(id_kustomer)as ga FROM kustomer");
$gale=mysql_fetch_array($galeri);

$order=mysql_query("SELECT COUNT(id_orders)as aws FROM orders,kustomer WHERE orders.id_kustomer=kustomer.id_kustomer AND tgl_order='$date' AND status_order='Lunas' ");
$gh=mysql_fetch_array($order);

$tot=mysql_query(" SELECT * FROM orders,kustomer WHERE orders.id_kustomer=kustomer.id_kustomer AND status_order='Lunas'");
$to=mysql_fetch_array($tot);
$juml=mysql_num_rows($tot);
?>