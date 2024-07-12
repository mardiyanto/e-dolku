<div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
							<div class="user-panel">
							<div class="pull-left image">
								<div align="center">
                            	<img src="img/avatar4.png" class="img-circle" alt="User Image" /><br>
								<p>Hello, <?=$_SESSION[nama]?></p>
								</div>
                       		 </div>
                            <!-- /input-group -->
							</div>
                        </li>
                        <li><a href="?aksi=home"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
						 <li><a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Produk<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li><a href="?aksi=kategori"><i class="fa fa-angle-double-right"></i> Data Kategori</a></li>
                               
								<li><a href="?aksi=barang"><i class="fa fa-angle-double-right"></i> Data Barang</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						 <li><a href="?aksi=informasi"><i class="fa fa-dashboard fa-fw"></i> Informasi</a></li>
						<li><a href="?aksi=kontak"><i class="fa  fa-qrcode fa-fw"></i> Tentang Kami<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
							
								<? $profil=mysql_query("SELECT * FROM profil ");
while($p=mysql_fetch_array($profil)){
?>
	
							
								<li><a href="?aksi=editprofil&id_p=<?=$p[id_profil]?>"><i class="fa fa-angle-double-right"></i><?=$p[nama]?></a></li>
                               <? }?>
							   <li><a href="?aksi=kontak&id=1"><i class="fa fa-angle-double-right"></i> Kontak Kami</a></li>
                            </ul>
						</li>
                        <li><a href="#"><i class="fa fa-shopping-cart fa-fw"></i> Orders<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="?aksi=dataorder"><i class="fa fa-angle-double-right"></i> Data Orders</a></li>
                                <!--<li><a href="?aksi=konfirmasi"><i class="fa fa-angle-double-right"></i> Konfirmasi Pembayaran</a></li>-->
                            </ul>
						</li>
                        <li><a href="?aksi=member"><i class="fa fa-male fa-fw"></i> Data Kustomers</a></li>
					
                       
                        <li><a href="#"><i class="fa fa-truck fa-fw"></i> Data Pengiriman<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="?aksi=kota"><i class="fa fa-angle-double-right"></i> Data Kota Pengiriman</a></li>
                                <li><a href="?aksi=bank"><i class="fa fa-angle-double-right"></i> Data Bank</a></li>
                            </ul>
						</li>
                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->