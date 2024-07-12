<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Admin Panel</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
			 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                       Komentar <i class="fa fa-comments-o fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
					
						
                        <li>
                            <a href="?aksi=pesan">
                                <div>
                                    <strong>Testimonial</strong>
                             
                                </div>
                           
                            </a>
                        </li>
                        <li class="divider"></li>
                    
						                       <li>
                            <a href="?aksi=komentar">
                                <div>
                                    <strong>Komentar Produk</strong>
                             
                                </div>
                           
                            </a>
                        </li>
                        <li class="divider"></li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
				
			<!-- /.dropdown-user -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Admin Setting <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="?aksi=admin"><i class="fa fa-user fa-fw"></i> Data admin</a>
                        </li>
                        <li><a href="?aksi=editadmin&id=<?= $_SESSION[kode] ?>"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
						<li><a href="../" target="_blank"><i class="fa fa-external-link-square fa-fw"></i> Go Website</a>
                        </li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <? include"menu.php" ?>
        </nav>
