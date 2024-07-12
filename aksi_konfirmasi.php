<?
  session_start();	
  include "config/koneksi.php";
	include "config/fungsi_indotgl.php";
	include "config/fungsi_thumb2.php";
	include "config/class_paging.php";
	include "config/fungsi_combobox.php";
	include "config/library.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_rupiah.php";
   $aksi=$_GET[aksi];
 
if($_GET[A]=='I'){
$cek_order=mysql_num_rows(mysql_query("SELECT id_orders FROM  orders WHERE id_orders='$_POST[NO]'"));
$cek_email=mysql_num_rows(mysql_query("SELECT id_order_p FROM  konfirmasi WHERE id_order_p='$_POST[NO]'"));

if ($cek_order < 1){
echo "<script>window.alert('Maaf No Order \"$_POST[NO]\" Tidak Terdaftar, Harap Cek Kembali No. Order Pesanan Anda.');
        window.location=('javascript:history.go(-1)')</script>";

}

elseif ($cek_email > 0){
echo "<script>window.alert('Pesanan Dengan No Order <strong>\"$_POST[NO]\"</strong> Sedang Diproses Harap Sabar Menunggu .Terimaksih..');
        window.location=('javascript:history.go(-1)')</script>";

}
elseif ($_POST[BANK]=='null'){
echo "<script>window.alert('Nama Bank Belum Dipilih.');
        window.location=('javascript:history.go(-1)')</script>";

}
elseif ($_POST[MT]=='null'){
echo "<script>window.alert('Metode Tranfer Belum Dipilih.');
        window.location=('javascript:history.go(-1)')</script>";

}else{
$lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadBanner($nama_file);
    mysql_query("INSERT INTO konfirmasi(id_order_p,
										nm_pengirim, 
										nm_bank, 
										mt_tranfer, 
										no_rek, 
										tgl_transfer, 
										j_transfer, 
										status,
										gambar)
	
								VALUES('$_POST[NO]',
										'$_POST[NAMA]',
										'$_POST[BANK]',
										'$_POST[MT]',
										'$_POST[NR]',
										'$_POST[TGL]',
										'$_POST[JT]',
										'Baru', 
										'$nama_file')");
  }
  else{
    mysql_query("INSERT INTO konfirmasi(id_order_p, nm_pengirim, nm_bank, mt_tranfer, no_rek, tgl_transfer, j_transfer, status) 
             VALUES('$_POST[NO]','$_POST[NAMA]','$_POST[BANK]','$_POST[MT]','$_POST[NR]','$_POST[TGL]','$_POST[JT]','Baru')"); 
  }
  
echo "<script>window.location=('?l=lihat&aksi=konfirmasi&A=B')</script>";
}
}
if($_GET[A]=='B'){
echo "<script>window.alert('Konfirmasi Anda Berhasil, Kami Akan Segera Memprosesnya Terimakasih Banyak....');
        window.location=('index.php?l=lihat&aksi=pesanansaya')</script>";

}

?>
