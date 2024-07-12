<div id="sidebar-primary">       
  <ul class="widget-container">
<li id="categories-2" class="widget widget_categories">
<h3 class="widgettitle">Menu</h3>		
<ul>
<li><a href="?aksi=admin"><i class="fa fa-user fa-fw"></i> Data admin</a></li>
                        <li><a href="?aksi=editadmin&id=<?= $_SESSION[kode] ?>"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
<li><a href="?aksi=barang"><i class="fa fa-bar-chart-o fa-fw"></i> Produk</a></li>
<li><a href="?aksi=kategori"><i class="fa fa-bar-chart-o fa-fw"></i>Kategori</a></li>

<li><a href="?aksi=kontak"><i class="fa  fa-qrcode fa-fw"></i> Tentang Kami</a></li>
<? $profil=mysql_query("SELECT * FROM profil ");
while($p=mysql_fetch_array($profil)){
?>
<li><a href="?aksi=editprofil&id_p=<?=$p[id_profil]?>"><i class="fa  fa-qrcode fa-fw"></i><?=$p[nama]?></a></li>
                               <? }?>
<li><a href="?aksi=kontak&id=1"><i class="fa fa-truck fa-fw"></i> Kontak Kami</a></li>
<li><a href="?aksi=dataorder"><i class="fa fa-shopping-cart fa-fw"></i>Orders<span class="fa arrow"></span></a></li>
<li><a href="?aksi=konfirmasi"><i class="fa fa-truck fa-fw"></i> Konfirmasi Pembayaran</a></li>
<li><a href="?aksi=member"><i class="fa fa-male fa-fw"></i> Data Kustomers</a></li>
<li><a href="?aksi=kota"><i class="fa fa-truck fa-fw"></i> Data Pengiriman<span class="fa arrow"></span></a></li>
<li><a href="?aksi=bank"><i class="fa fa-truck fa-fw"></i> Data Bank</a></li>
<li><a href="?aksi=pesan"><i class="fa  fa-qrcode fa-fw"></i> Testimonial</a></li>
<li><a href="?aksi=komentar"><i class="fa  fa-qrcode fa-fw"></i>komentar Produk</a></li>
		</ul>
</li></ul>
      

</div>
