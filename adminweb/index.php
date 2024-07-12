<?
include "../config/timeout.php";
if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}

if($_SESSION[login]==0){
  header('location:logout.php');
}
else{
if (empty($_SESSION['user']) AND empty($_SESSION['pass']) AND $_SESSION['login']==0){
 header("location:login.php"); 
}
else{
    include "../config/koneksi.php";
	include "../config/class_paging.php";
	include "../config/fungsi_rupiah.php";
	include "file.php";
    include "conter.php";
    $aksi=$_GET[aksi];
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Panel</title>

    <!-- Core CSS - Include with every page -->

   <script src="../bootstrap4/js/jquery-3.3.1.slim.min.js" ></script>
<script src="../bootstrap4/js/popper.min.js"></script>
<script src="../bootstrap4/js/bootstrap.min.js"></script>
<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/dataTables.bootstrap.css" rel="stylesheet">
    <!-- SB Admin CSS - Include with every page -->

	<!-- Page-Level Plugin Scripts - data Table -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <!-- Page-Level Demo Scripts - Forms - Use for reference -->
	    <script src="../ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
		 <!-- data tabel -->
		    $(document).ready(function() {
        	$('#style1').dataTable();
    		});
        </script>
</head>
<body >
<nav class="navbar navbar-default" role="navigation" >
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">ADMIN PANEL</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="?aksi=home"><i class="fa fa-dashboard fa-fw"></i> Beranda</a></a></li>						
<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bar-chart-o fa-fw"></i> Produk<b class="caret"></b><span class="fa arrow"></span></a>
    <ul class="dropdown-menu">
	<li><a href="?aksi=kategori"><i class="fa fa-angle-double-right"></i> Data Kategori</a></li>
    <li><a href="?aksi=barang"><i class="fa fa-angle-double-right"></i> Data Barang</a></li>
    </ul>
</li>
<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa  fa-qrcode fa-fw"></i> Tentang Kami<b class="caret"></b><span class="fa arrow"></span></a>
							<ul class="dropdown-menu">
								<? $profil=mysql_query("SELECT * FROM profil ");
while($p=mysql_fetch_array($profil)){?>
								<li><a href="?aksi=editprofil&id_p=<?=$p[id_profil]?>"><i class="fa fa-angle-double-right"></i><?=$p[nama]?></a></li>
                               <? }?>
							   <li><a href="?aksi=kontak&id=1"><i class="fa fa-angle-double-right"></i> Kontak Kami</a></li>
							    <li><a href="?aksi=kontak"><i class="fa fa-angle-double-right"></i> Tentang Kami</a></li>
                            </ul>
</li>
<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart fa-fw"></i> Orders<b class="caret"></b><span class="fa arrow"></span></a>
							<ul class="dropdown-menu">
								<li><a href="?aksi=dataorder"><i class="fa fa-angle-double-right"></i> Data Orders</a></li>
                                <li><a href="?aksi=konfirmasi"><i class="fa fa-angle-double-right"></i> Konfirmasi Pembayaran</a></li>
								 <li><a href="?aksi=laporan"><i class="fa fa-angle-double-right"></i> Laporan Penjualan</a></li>
                            </ul>
</li>
	<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
         <i class="fa fa-male fa-fw"></i> Data Kustomers<b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
		  <li><a href="?aksi=member"><i class="fa fa-angle-double-right"></i>  Data Kustomers</a></li>
		  <li><a href="?aksi=kota"><i class="fa fa-angle-double-right"></i> Data Kota Pengiriman</a></li>
          <li><a href="?aksi=bank"><i class="fa fa-angle-double-right"></i> Data Bank</a></li>
         </ul>
      </li>	
<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-fw"></i>Hello, <?=$_SESSION[nama]?><b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="../" target="_blank"><i class="fa fa-external-link-square fa-fw"></i> Go Website</a></li>
<li><a href="?aksi=admin"><i class="fa fa-user fa-fw"></i> Data admin</a></li>
<li><a href="?aksi=editadmin&id=<?= $_SESSION[kode] ?>"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
<li><a href="?aksi=komentar"><i class="fa fa-comments-o fa-fw"></i>Komentar Produk</a></li>
<li><a href="?aksi=pesan"><i class="fa fa-comments-o"></i>Testimonial </a></li>
<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Keluar</a></li>
</ul>
</li>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="panel panel-success">
  <div class="panel-body">
    <?	include "tengah.php"; ?>
  </div>
</div>						
</body>
</html>
<?
}
}
?>