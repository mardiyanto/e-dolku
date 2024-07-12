<? if($_GET[l]!='lihat'){
	 ?>	 </br>
        <!-- START ACCORDION & CAROUSEL-->
        <div class="row">
		 <div class="col-md-6">
            <div class="card">
              <div class="card-header">
            
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="foto/foto_banner/iklan.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="foto/foto_banner/iklan1.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="foto/foto_banner/iklan2.png" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
        
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                <div id="accordion">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                          Produk Baru
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                      <div class="card-body">
                        <?php $sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT 6");
  while ($r=mysql_fetch_array($sql)){
    include "diskon_stok.php";
    echo "
	<div class='product-info'>
 <a href='index.php?l=lihat&aksi=detail&id_p=$r[id_produk]'>
<center><img src='foto/foto_produk/$r[gambar]'  title='Lihat $r[nama_produk]' /></center>
</a>
";
     if ($d!=0){echo"
            <div class='diskon'> $r[diskon]% </div>";
    }else{echo"";
    }
            echo"
          
		   <div class='nama_p_besar'>$r[nama_produk]</div>
         $divharga	   
 
</div>
					";
  } ?>
                      </div>
                    </div>
                  </div>
                  <div class="card card-danger">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                          Sering di beli
                        </a>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                        <?php  $sql=mysql_query("SELECT * FROM produk ORDER BY dibeli DESC LIMIT 6");
  while ($r=mysql_fetch_array($sql)){
    include "diskon_stok.php";
    echo "
	<div class='product-info'>
 <a href='index.php?l=lihat&aksi=detail&id_p=$r[id_produk]'>
<center><img src='foto/foto_produk/$r[gambar]'  title='Lihat $r[nama_produk]' /></center>
</a>
";
     if ($d!=0){echo"
            <div class='diskon'> $r[diskon]% </div>";
    }else{echo"";
    }
            echo"
          
		   <div class='nama_p_besar'>$r[nama_produk]</div>
         $divharga	   
 
</div>
					";
  }?>
                      </div>
                    </div>
                  </div>
                  <div class="card card-success">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                          Produk Diskon
                        </a>
                      </h4>
                    </div>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                        <?php $sql=mysql_query("SELECT * FROM produk WHERE diskon !='0' ORDER BY id_produk DESC LIMIT 6");
  while ($r=mysql_fetch_array($sql)){
    include "diskon_stok.php";
    echo "
	<div class='product-info'>
 <a href='index.php?l=lihat&aksi=detail&id_p=$r[id_produk]'>
<center><img src='foto/foto_produk/$r[gambar]'  title='Lihat $r[nama_produk]' /></center>
</a>
";
     if ($d!=0){echo"
            <div class='diskon'> $r[diskon]% </div>";
    }else{echo"";
    }
            echo"
          
		   <div class='nama_p_besar'>$r[nama_produk]</div>
         $divharga	   
 
</div>
					";
  }?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
         
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL--> 
<?php }?>