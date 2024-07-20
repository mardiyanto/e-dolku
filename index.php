<?php 
  session_start();	
  include "config/koneksi.php";
  include "config/fungsi_indotgl.php";
  include "config/class_paging.php";
  include "config/fungsi_combobox.php";
  include "config/library.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_rupiah.php";
  $aksi=$_GET['aksi'];
?>
<!DOCTYPE html>
<html>
<head>
<title><?php
if (empty($_GET['nama'])) {
    echo "Selamat Datang di Toko " . htmlspecialchars($k_k['nama_perusahaan']);
} else {
    echo htmlspecialchars($_GET['nama']);
}
?>
</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<link rel="stylesheet" href="bootstrap4/bootstrap.min.css">

<link rel="stylesheet" href="bootstrap4/produk.css" type="text/css" media="screen">
<link rel="stylesheet" href="bootstrap4/icon/font/css/font-awesome.min.css">
<link rel="stylesheet" href="bootstrap4/icon/ionicons.min.css">
<script src="bootstrap4/js/jquery-3.3.1.slim.min.js"></script>
<script src="bootstrap4/js/popper.min.js"></script>
<script src="bootstrap4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container1">
  <header id="header">
    <div class="row">
      <div class="col-lg-12 col-md-12">
	  <nav class="navbar fixed-top navbar-light" style="background-color:#63b592;">
	      <form action='index.php?l=lihat&aksi=cariproduk' method='post' >
		  <div class='input-group'>
                    <input type='text' name='cari' class='form-control' placeholder='Cari Produk...'>
                    <span class='input-group-btn'>
					<input style="color:#fffdfc;" type='submit' name='submit' class='btn btn-outline-success ' value='CARI'>
                    </span>
                  </div>
	       </form>
	 <a style="color:#fffdfc;" href="index.php"><i class="fa fa-home"></i> </a>
	 <a style="color:#fffdfc;" href="index.php?l=lihat&aksi=testi"><i class="fa fa-envelope"></i></a>
	 <a style="color:#fffdfc;" href='index.php?l=lihat&aksi=ongkir'><i class="fa fa-truck fa-fw"></i></a>
 
    </nav> 
   </div></br></br></br>
     <div class="col-lg-12 col-md-12">  
        <a href="#"><img src="foto/foto_banner/logo.png" alt=""></a>
    </div>
     </br>
    </div>
  </header>
  <div id="navarea">
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#63b592;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="color: #fffdfc">
    <i class="fa fa-reorder fa-fw fa-2x"></i>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" >
      <li class="nav-item">
        <a class="nav-link" href="index.php" style="color: #fffdfc" ><i class="fa fa-home fa-lg"></i> Beranda </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?l=lihat&aksi=allproduk" style="color: #fffdfc"><i class="fa fa-list-alt fa-lg"></i> Semua Produk</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fffdfc">
          <i class="fa fa-file-text fa-lg"></i> Profil Kami
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		<?php $profil=mysqli_query($koneksi, "SELECT * FROM profil ");
while($p=mysqli_fetch_array($profil)){
?>
								<a class="dropdown-item" href="?l=lihat&aksi=profil&id_p=<?=$p[id_profil]?>"><?=$p[nama]?></a>
                               <?php }?>
							   <a class="dropdown-item" href='index.php?l=lihat&aksi=kontak'>Kontak Kami </a>
        </div>
      </li>
	  <?php if( $_SESSION[kustomer]==''){?>
    <li class="nav-item">
        <a style="color: #fffdfc" class="nav-link" href="index.php?l=lihat&aksi=login&cek=cek"><i class="fa fa-users fa-lg"></i> Member</a>
      </li>
 <?php }else{?>
 <?php 
$order=mysqli_query($koneksi, "SELECT COUNT(id_kustomer) as Od  FROM orders WHERE id_kustomer=$_SESSION[kustomer] ");
$Od=mysqli_fetch_array($order);
		?>
		  <li class="nav-item dropdown">
        <a style="color: #fffdfc" class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fa fa-users fa-lg"></i>  Pesanan Anda (<?=$Od[Od]?>)
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
<a class="dropdown-item" href='index.php?l=lihat&aksi=pesanansaya'>Pesanan Saya <b>(<?=$Od[Od]?>)</b></a>
<a class="dropdown-item" href='index.php?l=lihat&aksi=gantilogin'> Edit Paswd</a>
<a class="dropdown-item" href='index.php?l=lihat&aksi=buattoko'> Jual Produk</a>
<a class="dropdown-item"  href='logout.php'>Keluar</a>

        </div>
      </li>	
	
 <?php }?>
      <li class="nav-item">
        <a style="color: #fffdfc" class="nav-link" href="?l=lihat&aksi=testi"><i class="fa fa-file-text fa-lg"></i> Testimoni</a>
      </li>
    </ul>
  </div>
</nav>
  </div>
  <section id="mainContent">
  
  				<?php if($_GET[l]=='lihat'){include"utama.php";}
			   else{include"tengah.php";}
			?>
	
  </section>
</div>
 <footer class="navbar navbar-expand-lg">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>&copy; 2017-2018 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
</footer>
<nav class="navbar navbar-expand fixed-bottom d-md-none d-lg-none d-xl-none p-0" style="background-color:#63b592;">
    <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item">
            <a style="color:#fffdfc;" href="index.php" class="nav-link text-center">
          <i class="fa fa-home"></i> 
                <span class="small d-block">Home</span>
            </a>
        </li>
        <li class="nav-item">
            <a style="color:#fffdfc;" href="index.php" class="nav-link text-center">
          <i class="fa fa-fw fa-refresh"></i>
                <span class="small d-block">refresh</span>
            </a>
        </li>
   <li class="nav-item">
            <a style="color:#fffdfc;" href="index.php?l=lihat&aksi=kranjang" class="nav-link text-center">
         <i class="fa fa-fw fa-shopping-cart"></i><?php
	$sid = session_id();
	$sql = mysqli_query($koneksi, "SELECT SUM(jumlah*(harga-(diskon/100)*harga)) as total,SUM(jumlah) as totaljumlah FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
    //$disc        = ($r[diskon]/100)*$r[harga];
    //$subtotal    = ($r[harga]-$disc) * $r[jumlah];                
	while($r=mysqli_fetch_array($sql)){
  if ($r['totaljumlah'] != ""){
    $total_rp    = format_rupiah($r['total']);    
    echo " <span class='badge badge-light'>$r[totaljumlah]</span>
";
  }
  else{
        echo "<span class='badge badge-light'>$r[totaljumlah]</span>
";			  
  }
  }
?>
                <span class="small d-block">Keranjang</span>
            </a>
        </li>
			  <?php if( $_SESSION[kustomer]==''){?>
			  	<li class="nav-item">
            <a style="color:#fffdfc;" href="index.php?l=lihat&aksi=login&cek=cek" class="nav-link text-center">
         <i class="fa fa-fw fa-sign-in"></i>
                <span class="small d-block">Login</span>
            </a>
        </li> 
 <?php }else{?>
 <?php 
$order=mysqli_query($koneksi, "SELECT COUNT(id_kustomer) as Od  FROM orders WHERE id_kustomer=$_SESSION[kustomer] ");
$Od=mysqli_fetch_array($order);
		?>
     <li class="nav-item dropup">
            <a style="color:#fffdfc;" href="#" class="nav-link text-center" role="button" id="dropdownMenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
              <i class="fa fa-fw  fa-users"></i>
                <span class="small d-block"><?=$_SESSION[namamember]?>(<?=$Od[Od]?>)</span>
            </a>
            <!-- Dropup menu for profile -->
            <div class="dropdown-menu" aria-labelledby="dropdownMenuProfile">
                <a class="dropdown-item" href='index.php?l=lihat&aksi=pesanansaya'>Pesanan Saya <b>(<?=$Od[Od]?>)</b></a>
 <a class="dropdown-item" href='index.php?l=lihat&aksi=gantilogin'> Edit Paswd</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </li>		
 <?php }?>
	
		
   
    </ul>
</nav>
</body>
</html>