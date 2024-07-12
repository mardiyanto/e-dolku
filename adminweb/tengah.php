<?

///////////////////////////lihat/////////////////////////////////////////////
if($aksi=='home'){
echo"
      

				<div class='row'>
                	<div class='col-lg-12'>
                    <h1 class='page-header'>Dashboard</h1>
                	</div>
                <!-- /.col-lg-12 -->
            	</div>	
			    <div class='row'>
                	<div class='col-lg-6'>
                    	<div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-bar-chart-o fa-fw'></i> Statistik Data Website
                            
                        </div>
                                <div class='panel-body'>

									<table class='table table-bordered'>
										<tr><td >Jumlah Stok Barang</td>
										<td ><span class='badge bg-red'>$post[b]</span></td>
										</tr>
										<tr>
										<td >Jumlah kategori</td>
										<td><span class='badge bg-yellow'>$kate[ka]</span></td>
										</tr>
										<tr><td >Jumlah Kustomers</td><td ><span class='badge bg-red'>$gale[ga]</span></td></tr>
										
									</table>
								</div><!-- /.panel-body -->
                        </div><!-- /.panel-default -->
                     </div><!-- /.col -->
					<div class='col-lg-6'>
                    	<div class='panel panel-default'>
							
                        <div class='panel-heading'>
                            <i class='fa fa-bar-chart-o fa-fw'></i> Statistik Pengunjung Website
                        </div>
                                <div class='panel-body'>
		
								<table class='table table-bordered'>
									<tr><td >Pengunjung online</td><td><span class='badge bg-yellow'>$e7</span></td></tr>
									<tr><td >Pengunjung hari ini</td><td ><span class='badge bg-green'>$a7</span></td></tr>
									<tr><td >Total pengunjung</td><td><span class='badge bg-blue'>$b7</span></td></tr>
									<tr><td>Hit hari ini</td><td><span class='badge bg-red'>$c7</span></td></tr>
									<tr><td>Total hit</td><td><span class='badge bg-blue'>$d7</span></td></tr>
								</table>
								
								</div><!-- /.panel-body -->
                        </div><!-- /.panel-default -->
                     </div><!-- /.col -->
					 
					 <div class='col-lg-6'>
                    	<div class='panel panel-default'>
							
                        <div class='panel-heading'>
                            <i class='fa fa-bar-chart-o fa-fw'></i> Order Baru
                            
                        </div>
                                <div class='panel-body'>
		
								<table class='table table-bordered'>
								<tr><td >Nomer Order</td><td>Status</td></tr>
								";
								
$order=mysql_query(" SELECT * FROM orders,kustomer WHERE orders.id_kustomer=kustomer.id_kustomer ORDER BY orders.id_orders DESC limit 4 ");
while ($t=mysql_fetch_array($order)){
echo"
<tr><td >$t[id_orders]</td><td><span class='badge bg-yellow'>$t[status_order]</span></td></tr>";
									}
									echo"
								</table>
								
								</div><!-- /.panel-body -->
                        </div><!-- /.panel-default -->
                     </div><!-- /.col -->
					 
					 	<div class='col-lg-6'>
                    	<div class='panel panel-default'>
							
                        <div class='panel-heading'>
                            <i class='fa fa-bar-chart-o fa-fw'></i>Pembelian Produk
                            
                        </div>
                                <div class='panel-body'>
		
								<table class='table table-bordered'>
								<tr><td >Hari Ini</td><td><span class='badge bg-yellow'>$gh[aws]</span></td></tr>
								
<tr><td >Total Semua Pembelian</td><td><span class='badge bg-yellow'>$juml</span></td></tr>
									
								</table>
								
								</div><!-- /.panel-body -->
                        </div><!-- /.panel-default -->
                     </div><!-- /.col -->
					 
					 
			</div>



";
}
elseif($aksi=='barang'){
echo"<div class='row'>
                	<div class='col-lg-12'>
                    <h1 class='page-header'>Data Barang</h1>
                	</div>
                <!-- /.col-lg-12 -->
            	</div>	
<a href='?aksi=inputbarang' class='ok'><button class='btn btn-primary btn-sm'>Tambah barang</button></a><br /><br />
<div class='row'>
                        <div class='row'>
                	<div class='col-lg-12'>
                    	<div class='panel panel-default'>
							
                        <div class='panel-heading'>
                            <i class='fa fa-bar-chart-o fa-fw'></i> Data Barang
                            
                        </div>
                                <div class='panel-body'>
				 <div class='table-responsive'>
				<table id='style1' class='table table-striped table-bordered table-hover'>
					<thead>
						<tr>
						    <th width=1% >No</th>
							<th width=40% >Nama Barang</th>
							<th width=15% >Kategori</th>
						
							<th width=10%>Stok</th>
							<th>Harga</th>
							<th width=12% >Pilihan</th>
					    </tr>
					</thead>
					<tbody>";
$tebaru=mysql_query(" SELECT * FROM produk,kategori where produk.id_kategori=kategori.id_kategori  ORDER BY id_produk DESC ");

while ($t=mysql_fetch_array($tebaru)){
$harga2 = number_format($t[harga],0,',','.');
$no++;

					   echo"<tr>
					        <td>$no</td>
							<td><strong>$t[nama_produk]</strong></td>
							<td><strong>$t[nama_kategori]</strong></td>
						
							<td>$t[stok]</td>
							<td>Rp.$harga2 </td>
							<td>
					
					<div class='btn-group'>
                                            <button type='button' class='btn btn-info'>Action</button>
                                            <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
                                                <span class='caret'></span>
                                                <span class='sr-only'>Toggle Dropdown</span>
                                            </button>
                                            <ul class='dropdown-menu' role='menu'>
                                                <li><a href='?aksi=editbarang&id_b=$t[id_produk]'>Edit</a></li>
                                                 <li><a href='modul/barang.php?id_b=$t[id_produk]&act=hapus&gbr=$t[gambar]' onclick=\"return confirm ('Apakah yakin ingin menghapus $t[nama_produk] ?')\">Hapus</a></li>
                                            </ul>
                                        </div>
				
					    </td></tr>";
					 	}						
						echo"
					</tbody>
				</table>
				</div>
    </div>
   </div>
 </div> </div> </div>"; 
}
/////////////////////////////////////////////////////////////////////////////////////////////////

elseif($aksi=='inputbarang'){

echo"
<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Input Barang
                    </h1>
	
<a href='javascript:history.go(-1)' class='ok'><button class='btn btn-primary btn-sm'>Kembali</button></a><br /><br />
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form Input Barang
                                 </div>
                                
                                <div class='panel-body'>

<form name='form1' id='form_combo' role='form' enctype='multipart/form-data' method='post' action='modul/barang.php?act=input'>
        <label>Kategori</label>
		    <select class='form-control' name='kat'>
        	<option value='null' selected>----- Pilih Kategori -----</option>";
            $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
            }
              
        echo "</select><br />
    	<label>Nama </label>
        <input type='text' class='form-control'  name='nama'/><br>
		<label>Rekomendasi Produk</label><br />

		  <label>Ya
  <input name='rd' type='radio' value='Y'/>
  </label>
  <label>
  Tidak
  <input name='rd' type='radio' value='N'  checked  />
  </label>
		<br />
<br />

		<label>Harga </label>
        <div class='form-group input-group'>
        <span class='input-group-addon'>Rp</span><input type='text' class='form-control' name='harga' onkeyup=\"this.value=this.value.replace(/[^0-9]/g,'')\" />
		</div>
		<label>Diskon</label>
		<div class='form-group input-group'>
        <input type='text' class='form-control' onkeyup=\"this.value=this.value.replace(/[^0-9]/g,'')\" name='diskon'/><span class='input-group-addon'>%</span></div>
		
		<label>Berat</label>
		<div class='form-group input-group'>
        <input type='text' class='form-control'  name='berat'/><span class='input-group-addon'>Kg</span></div>
		
		
		<label>Stok</label>
		<div class='form-group input-group'>
        <input type='text' class='form-control' onkeyup=\"this.value=this.value.replace(/[^0-9]/g,'')\" name='stok'/><span class='input-group-addon'>pcs</span></div>
		<label>Gambar</label>
        <input type='file' class='smallInput' name='gambar'/><br>
		<label>Isi</label>
         <textarea  id='editor1'  name='ket' class='smallInput wide' rows='7' cols='30'></textarea><script>

			CKEDITOR.replace( 'editor1', {
				fullPage: true,
				allowedContent: true,
				extraPlugins: 'wysiwygarea'
			});

		</script><br />
		<br />
            <button class='btn btn-primary btn-sm' type='submit'>Simpan</button>
            <button class='btn btn-primary btn-sm' type='reset'>Reset</button>
    </form>
	       </div>
                        </div>
                    </div> </div> </div> </div>
";
}
///////////////////////////////////////////////////////////////////////////////////////////////////

elseif($aksi=='editbarang'){
$tebaru=mysql_query(" SELECT * FROM produk  WHERE id_produk='$_GET[id_b]'");
$t=mysql_fetch_array($tebaru);
echo"
<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Input Barang
                    </h1>
	
<a href='javascript:history.go(-1)' class='ok'><button class='btn btn-primary btn-sm'>Kembali</button></a><br /><br />
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form Edit Barang
                                 </div>
                                
                                <div class='panel-body'>
								<img class=img-thumbnail src='../foto/foto_produk/$t[gambar]'  width=20% />
<form name='form2' id='form_combo' role='form' enctype='multipart/form-data' method='post' action='modul/barang.php?act=edit&id_b=$t[id_produk]&gb=$t[gambar]'>
        <label>Kategori</label>
		    <select class='form-control' name='kat' >";
      $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
          if ($t[id_kategori]==0){
            echo "<option value='null' selected>- Pilih Kategori -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($t[id_kategori]==$w[id_kategori]){
              echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }
            else{
              echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }

        echo "</select><br>
		
    	<label>Nama </label>
        <input type='text' class='form-control' value='$t[nama_produk]'  name='nama'/><br>
		
		
		<label>Rekomendasi Produk</label><br />

		  <label>Ya
  <input name='rd' type='radio' value='Y'/>
  </label>
  <label>
  Tidak
  <input name='rd' type='radio' value='N'  checked  />
  </label>
		<br />
<br />
		
		
		<label>Harga </label>
		<div class='form-group input-group'>
        <span class='input-group-addon'>Rp</span><input type='text' class='form-control' value='$t[harga]' name='harga' onkeyup=\"this.value=this.value.replace(/[^0-9]/g,'')\" />
		</div>
		<label>Diskon</label>
		<div class='form-group input-group'>
        <input type='text' class='form-control' onkeyup=\"this.value=this.value.replace(/[^0-9]/g,'')\" value='$t[diskon]' name='diskon'/><span class='input-group-addon'>%</span></div>
		<label>Berat</label>
		<div class='form-group input-group'>
        <input type='text' class='form-control' value='$t[berat]' name='berat'/><span class='input-group-addon'>Kg</span></div>
		<label>Stok</label>
		<div class='form-group input-group'>
        <input type='text' class='form-control' onkeyup=\"this.value=this.value.replace(/[^0-9]/g,'')\" value='$t[stok]' name='stok'/><span class='input-group-addon'>pcs</span></div>
		<label>Gambar</label>
        <input type='file' class='smallInput' name='gambar'/><br>
		<label>Isi</label>
        <textarea  id='editor1' name='ket' class='smallInput wide' rows='7' cols='30'>$t[deskripsi]</textarea><script>

			CKEDITOR.replace( 'editor1', {
				fullPage: true,
				allowedContent: true,
				extraPlugins: 'wysiwygarea'
			});

		</script><br />
		<br />
            <button class='btn btn-primary btn-sm' type='submit'>Simpan</button>
            <button class='btn btn-primary btn-sm' type='reset'>Reset</button>
    </form>
	       </div>
                        </div>
                    </div> </div> </div> </div>
";
}
////////////////////////////////////////////////////////////////////////////////////////////

elseif($aksi=='kategori'){
echo"<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Data Kategori
                    </h1>
	
<a href='javascript:history.go(-1)' class='ok'><button class='btn btn-primary btn-sm'>Kembali</button></a><br /><br />
<div class='row'>
                       
                        <div class='col-md-9'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Data Kategori Barang
                                 </div>
                                
                                <div class='panel-body'>";
	
if($_GET[kat]=='edit'){
$detail=mysql_query(" SELECT * FROM kategori WHERE id_kategori='$_GET[id_k]'");
$d=mysql_fetch_array($detail); 
echo"
<form  method='post' action='modul/kategori.php?act=editkategori&id_k=$d[id_kategori]'>
<label>
            <input name='kat' type='text' size='50' value='$d[nama_kategori]' class='smallInput'>
          </label> <label>
            <button class='btn btn-primary btn-sm' type='submit'>Simpan Ulang</button>
          </label>
    </form>    ";
}else{
echo"
<form  method='post' action='modul/kategori.php?act=inputkategori'>
 <label>
            <input name='kat' type='text' size='50' class='smallInput'>
          </label> <label>
            <button class='btn btn-primary btn-sm' type='submit'>Simpan</button>
          </label>
    </form>";
}	
echo"
<div class='table-responsive'>
				<table id='style1' class='table table-striped table-bordered table-hover'>
					<thead>
						<tr>
						    <th>No</th>
							<th>Kategori</th>
							<th>Jumlah Barang</th>
							<th>Pilihan</th>
					    </tr>
					</thead>
					<tbody>";
$kategori=mysql_query("SELECT COUNT(produk.id_produk) as jlh,kategori.id_kategori,kategori.nama_kategori FROM kategori LEFT JOIN produk ON produk.id_kategori = kategori.id_kategori GROUP BY kategori.id_kategori ORDER BY id_kategori DESC");
while ($d=mysql_fetch_array($kategori)){
$no++;

					   echo"<tr class='gradeA' >
					        <td align=center >$no</td>
							<td>$d[nama_kategori]</td>
							<td >$d[jlh]</td>
							<td class='options-width3'  >
									<div class='btn-group'>
                                            <button type='button' class='btn btn-info'>Action</button>
                                            <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
                                                <span class='caret'></span>
                                                <span class='sr-only'>Toggle Dropdown</span>
                                            </button>
                                            <ul class='dropdown-menu' role='menu'>
                                                <li><a href='index.php?aksi=kategori&id_k=$d[id_kategori]&kat=edit'>Edit</a></li>";
                                                if($d[jml]==0){
				echo"<li><a href='modul/kategori.php?id_k=$d[id_kategori]&act=hapus' 			                  onclick=\"return confirm ('Apakah yakin ingin menghapus $d[nama_kategori] ?')\" >Hapus</a></li>";
				}else{
				echo"
				<li><a>Tidak Bisa Di Hapus</a></li>
				";}
                                                
                                            
				
				
				echo"</ul>
                                        </div>
					</td></tr>";
						}						
						echo"</tbody>
				</table>  </div> </div> </div> </div> </div> </div> </div>"; 
}
////////////////////////////////////////////////////////////////////////////////////

elseif($aksi=='subkategori'){
echo"<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Data Kategori
                    </h1>

				<div class='row'>
                       
                        <div class='col-md-6'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>";
									if($_GET[kat]=='edit'){ echo"Form Edit Sub Kategori Barang";}
									else{echo"Form Input Sub Kategori Barang";}
                                 echo"</div>
                                
                                <div class='panel-body'>"; 
if($_GET[kat]=='edit'){
$detail=mysql_query(" SELECT * FROM tipe left join kategori on tipe.id_kategori=kategori.id_kategori WHERE id_tipe='$_GET[id_t]'");
$d=mysql_fetch_array($detail); 
echo"
<form  method='post' action='modul/subkategori.php?act=edit&id_t=$d[id_tipe]'>
<label>Kategori</label>
		    <select class='form-control' name='kat' >
        	<option value=$d[id_kategori] selected>$d[nama_kategori]</option>";
            $tampil=mysql_query("SELECT * FROM kategori where id_kategori!=$d[id_kategori] ORDER BY nama_kategori");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
            }
              
        echo "</select><br>
<label>Sub Kategori </label>
        <input type='text' class='form-control' value='$d[genre]'  name='genre'/><br>

          </label> <label>
            <button class='btn btn-primary btn-sm' type='submit'>Simpan Ulang</button>
          </label>
    </form>    ";
}else{
echo"
<form  method='post' action='modul/subkategori.php?act=inputkategori'>
<label>Kategori</label>
		    <select class='form-control' name='kat'>
        	<option value=0 selected>-----Pilih Kategori------</option>";
      $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
            }
              
        echo "</select><br>
<label>Sub Kategori </label>
        <input type='text' class='form-control' name='genre'/><br>
     
          </label> <label>
            <button class='btn btn-primary btn-sm' type='submit'>Simpan</button>
          </label>
    </form>";
}	
echo" </div></div></div></div>
<div class='row'>
                       
                        <div class='col-md-9'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Data Sub Kategori Barang
                                 </div>
                                
                                <div class='panel-body'>
<div class='table-responsive'>
				<table id='style1' class='table table-striped table-bordered table-hover'>
					<thead>
						<tr>
						    <th>No</th>
							<th>Sub_Kategori</th>
							<th>Dalam Kategori</th>
							<th>Jumlah Barang</th>
							<th>Pilihan</th>
					    </tr>
					</thead>
					<tbody>";
$kategori=mysql_query("select tipe.id_kategori, kategori.id_kategori, kategori.nama_kategori, tipe.genre, tipe.id_tipe,
			count(produk.id_produk) as jml from (tipe left join produk on tipe.id_tipe=produk.id_tipe) left join kategori on tipe.id_kategori=kategori.id_kategori group by id_tipe  order by nama_kategori ASC");
while ($r=mysql_fetch_array($kategori)){
$no++;

					   echo"<tr class='gradeA' >
					        <td align=center >$no</td>
							<td>$r[genre]</td>
							<td><strong>$r[nama_kategori]</strong></td>
							<td >$r[jml]</td>
							<td class='options-width3'  >
									<div class='btn-group'>
                                            <button type='button' class='btn btn-info'>Action</button>
                                            <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
                                                <span class='caret'></span>
                                                <span class='sr-only'>Toggle Dropdown</span>
                                            </button>
                                            <ul class='dropdown-menu' role='menu'>
                                                <li><a href='index.php?aksi=subkategori&id_t=$r[id_tipe]&kat=edit'>Edit</a></li>";
                                                if($d[jml]==0){
				echo"<li><a href='modul/subkategori.php?id_t=$r[id_tipe]&act=hapus' 			                  onclick=\"return confirm ('Apakah yakin ingin menghapus $d[kategori] ?')\" >Hapus</a></li>";
				}else{
				echo"
				<li><a>Tidak Bisa Di Hapus</a></li>
				";}
                                                
                                            
				
				
				echo"</ul>
                                        </div>
					</td></tr>";
						}						
						echo"</tbody>
				</table>
				</div>
					</div>
						</div>
</div>";

}

elseif($aksi=='editprofil'){
$tebaru=mysql_query(" SELECT * FROM profil WHERE id_profil=$_GET[id_p] ");
$t=mysql_fetch_array($tebaru);
echo"
<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Edit $t[nama]
                    </h1>
	

<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form Edit Profil
                                 </div>
                                
                                <div class='panel-body'>
	

<form id='edit' enctype='multipart/form-data' method='post' action='modul/profil.php?act=editpro&id_p=$_GET[id_p]&jd=$t[nama]'>
        <label>Judul</label>
        <input type='text' class='form-control' value='$t[nama]' name='jd' /><br>
		<label>Isi</label>
        <textarea  id='tinymce_basic'  name='isi' class='smallInput wide' rows='7' cols='30'>$t[isi]</textarea><script>

			CKEDITOR.replace( 'tinymce_basic', {
				fullPage: true,
				allowedContent: true,
				extraPlugins: 'wysiwygarea'
			});

		</script><br />

        <button class='btn btn-primary btn-sm' type='submit'>Simpan</button>
            <button class='btn btn-primary btn-sm' type='reset'>Reset</button>
    </form>
	   </div>
                        </div>
                    </div> </div> </div>  </div>
";
}

elseif($aksi=='bukutamu'){
echo"<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Testimonial
                    </h1>
	


";
if($_GET[lihat]=='v'){

	$agenda2=mysql_query(" SELECT * FROM komentar WHERE id_komentar='$_GET[id_bk]'");
	$d2=mysql_fetch_array($agenda2); 
	$komen=wordwrap($d2['isi_komentar'], 50, "<br />\n", 1);

if($d2[status]=='N'){
				echo"<a href='modul/bukutamu.php?act=status&id_bk=$d2[id_komentar]' title='publikasikan' class='ok' > 
				<button class='btn btn-primary btn-sm'>Publikasikan</button></a><br />
";
				}else{echo"<a href='modul/bukutamu.php?act=status&id_bk=$d2[id_komentar]&beku=beku' title='jangan publikasikan' class='ok'><button class='btn btn-danger btn-sm'>Jangan Publikasikan</button></a><br />";
				}

echo" <br />
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form Buku Tamu
                                 </div>
                                
                                <div class='panel-body'> 

<table id='style2' class='table table-striped table-bordered table-hover'>
  <tr>
    <td width='107' valign='top'><strong>Nama</strong></td>
    <td width='12' valign='top'><strong>:</strong></td>
    <td width='502' valign='top'><strong>$d2[nama_komentar]</strong></td>
  </tr>
  <tr>
    <td valign='top'><strong>Waktu</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'>$d2[tgl] &nbsp;&nbsp; $d2[jam]</td>
  </tr>
  <tr>
    <td valign='top'><strong>Email</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'>$d2[email]</td>
  </tr>
  <tr>
    <td valign='top'><strong>Http</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'>$d2[http]</td>
  </tr>
  <tr>
    <td valign='top'><strong>Isi Buku </strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'>$komen</td>
  </tr>
</table><br /></div></div></div></div>
<a href='javascript:history.go(-1)' class='ok'><button class='btn btn-primary btn-sm'>Kembali</button></a><br /><br />
";
  }else{	
echo"<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form Buku Tamu /Testimonial
                                 </div>
                                
                                <div class='panel-body'> 
		<div class='table-responsive'>
<table id='style1' class='table table-striped table-bordered table-hover'>
					<thead>
						<tr>
						    <th >No</th>
							<th >Nama</th>
							<th >Isi</th>
							<th >Tanggal</th>
							<th >Status</th>
							<th >Pilihan</th>
					    </tr>
					</thead>
					<tbody>";
$tebaru=mysql_query(" SELECT * FROM komentar ORDER BY id_komentar DESC");
while ($t=mysql_fetch_array($tebaru)){		
                $isi=substr($t['isi_komentar'], 0, 50); 
                $isi_berita = strip_tags($isi); 
				$komen=wordwrap($isi, 20, "<br />\n", 1);
$no++;

					   echo"<tr class='gradeA' >
					        <td align=center >$no</td>
							<td>$t[nama_komentar]</td>
							<td  >$komen</td>
							<td align=center >$t[tgl]</td>
							<td align=center >";
				if($t[status]=='N'){
				echo"<a href='modul/bukutamu.php?act=status&id_bk=$t[id_komentar]' title='publikasikan'> 
				<button type='button' class='btn btn-danger btn-circle'><i class='fa fa-times'></i>
                            </button></a>";
				}else{echo"<a href='modul/bukutamu.php?act=status&id_bk=$t[id_komentar]&beku=beku' title='jangan publikasikan'> 
				<button type='button' class='btn btn-info btn-circle'><i class='fa fa-check'></i>
                            </button></a>";
				}
				echo"
							
							</td>
							<td class='options-width3'  >
					<center>
				<a href='index.php?aksi=bukutamu&lihat=v&id_bk=$t[id_komentar]' title='Lihat'><button type='button' class='btn btn-primary btn-circle'><i class='fa fa-search'></i>
                            </button></a>&nbsp;
				<a href='modul/bukutamu.php?id_bk=$t[id_komentar]&act=hapus' onclick=\"return confirm ('Apakah yakin ingin menghapus $t[nama] ?')\" title='Hapus'><button type='button' class='btn btn-danger btn-circle'><i class='fa fa-times'></i>
                            </button></a>
				</center>
					    </td></tr>";
					 	}						
						echo"</tbody>
				</table>"; 
				}
}


///////////////////////////lihat/////////////////////////////////////////////
elseif($aksi=='admin'){
echo"<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Admin
                    </h1>
					<a href='?aksi=inputadmin' class='ok'><button class='btn btn-primary btn-sm'>Tambah Admin</button></a><br /><br />
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form admin
                                 </div>
                                
                                <div class='panel-body'> 
		<div class='table-responsive'>
<table id='style1' class='table table-striped table-bordered table-hover'>
					<thead>
					<thead>
						<tr>
						    <th width=1% >No</th>
							<th width=15% >Nama</th>
							<th width=25% >User Name</th>
							<th width=25%>Email</th>
							<th width=8%>Pilihan</th>
					    </tr>
					</thead>
					<tbody>";
$tebaru=mysql_query(" SELECT * FROM users ");
while ($t=mysql_fetch_array($tebaru)){	
$no++;

					   echo"<tr class='gradeA' >
					        <td align=center >$no</td>
							<td>$t[nama_leng]</td>
							<td>$t[username]</td>
							<td >$t[email]</td>
							<td class='options-width3'  >
					<center>
				<a href='index.php?aksi=editadmin&id=$t[id]' title='Edit'><button type='button' class='btn btn-primary btn-circle'><i class='fa fa-pencil'></i>
                            </button></a>&nbsp;
				<a href='modul/admin.php?id=$t[id]&act=hapus' onclick=\"return confirm ('Apakah yakin ingin menghapus $t[nama_lengkap] ?')\" title='Hapus'><button type='button' class='btn btn-danger btn-circle'><i class='fa fa-times'></i>
                            </button></a>
				</center>
					    </td></tr>";
					 	}						
						echo"</tbody>
				</table></div>
                        </div>
                    </div></div></div></div></div>"; 
}
/////////////////////////////////////////////////////////////////////////////////////////////////
elseif($aksi=='inputadmin'){
echo"<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Input Admin
                    </h1>
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form admin
                                 </div>
                                
                                <div class='panel-body'>


<form id='edit'  method='post' action='modul/admin.php?act=inputadmin'>
    	<label>Nama Lengkap</label>
        <input type='text' class='form-control'  name='nm'/><br>
			
		<label>Email</label>
        <input type='text' class='form-control' name='em'/><br>
		
		<label>User Name</label>
        <input type='text' class='form-control'  name='um'/><br>

		<label>Password</label>
        <input type='text' class='form-control'  name='pw'/><br><br />
		
<button class='btn btn-primary btn-sm' type='submit'>Simpan</button>
            <button class='btn btn-primary btn-sm' type='reset'>Reset</button>
    </form></div>
                        </div>
                    </div></div></div></div>
";
}
/////////////////////////////////////////////////////////////////////////////////////////////////
elseif($aksi=='editadmin'){
$tebaru=mysql_query(" SELECT * FROM users WHERE id=$_GET[id]");
$t=mysql_fetch_array($tebaru);
echo"<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Edit Admin
                    </h1>
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form Admin
                                 </div>
                                
                                <div class='panel-body'>

<form id='edit'  method='post' action='modul/admin.php?act=editadmin&id=$t[id]'>
    	<label>Nama Lengkap</label>
        <input type='text' class='form-control'  name='nm' value='$t[nama_leng]'/><br>
			
		<label>Email</label>
        <input type='text' class='form-control' name='em' value='$t[email]' /><br>
		
		<label>User Name</label>
        <input type='text' class='form-control'  name='um' value='$t[username]'/><br>

		<label>Password</label>
        <input type='text' class='form-control'  name='pw'/><br><br />
		
		  <button class='btn btn-primary btn-sm' type='submit'>Simpan</button>
            <button class='btn btn-primary btn-sm' type='reset'>Reset</button>
    </form></div>
                        </div>
                    </div></div></div></div>
";
}
elseif($aksi=='member'){
echo"<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Kustomer              </h1>
				
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Data Kustomer
                                 </div>
                                
                                <div class='panel-body'> 
		<div class='table-responsive'>
<table id='style1' class='table table-striped table-bordered table-hover'>
					<thead>
						<tr>
						   <th >No</th>
							<th >Nama</th>
							<th >Email</th>
							<th width=25% >Alamat</th>
							<th >Telphone</th>
							
	                         <th >Tgl.masuk</th>
							<th ></th>
					    </tr>
					</thead>
					<tbody>";
$tebaru=mysql_query(" SELECT * FROM kustomer  ORDER BY kustomer.id_kustomer DESC ");
while ($t=mysql_fetch_array($tebaru)){
$no++;
                $isi_berita1 = strip_tags($t[alamat]); 
          
					   echo"<tr class='gradeA' >
					       <td>$no</td>
							<td>$t[nama_lengkap]</td>
							<td  >$t[email]</td>
							<td  >$isi_berita1</td>
							<td  >$t[telpon]</td>
							
							<td >$t[tgl]</td>

							<td class='options-width3'  >
					<center>
												
				<a href='modul/member.php?id_ks=$t[id_kustomer]&act=hapus' onclick=\"return confirm ('Apakah yakin ingin menghapus $t[nama_lengkap] ?')\" title='Hapus'><button type='button' class='btn btn-danger btn-circle'><i class='fa fa-times'></i>
                            </button></a>
				</center>
					    </td></tr>";
					 	}						
						echo"</tbody>
				</table></div></div></div></div></div></div></div>"; 

}
elseif($aksi=='kota'){
echo"
<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Data Kota              </h1>
	";
	
if($_GET[kot]=='edit'){
$detail=mysql_query(" SELECT * FROM kota WHERE id_kota='$_GET[id_k]'");
$d=mysql_fetch_array($detail); 
echo"
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Data Kota
                                 </div>
                                
                                <div class='panel-body'> 
<form  method='post' action='modul/kota.php?act=editkota&id_k=$d[id_kota]'>
<p>
<label>Provinsi</label>
<input name='prov' type='text' size='50' value='$d[kabupaten]' class='form-control'>
</p>
<p>
<label>Kota Pengiriman</label>
<input name='kot' type='text' size='50' value='$d[nama_kota]' class='form-control'>
</p>
<p>
<label>Harga Pengiriman</label>
<input name='ok' type='text' size='50' value='$d[ongkos_kirim]' class='form-control' onkeyup=\"this.value=this.value.replace(/[^0-9]/g,'')\" >
</p>

<button class='btn btn-primary btn-sm' type='submit'>Simpan</button>
</form><br /><br /></div></div></div></div>";

}else{

echo"<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Data Kustomer
                                 </div>
                                
                                <div class='panel-body'> 
<form  method='post' action='modul/kota.php?act=inputkota'>
<p>
<label>Provinsi</label>
<input name='prov' type='text' size='50' class='form-control'>
</p>
<p>
<label>Kota Pengiriman</label>
<input name='kot' type='text' size='50' class='form-control'>
</p>
<p>
<label>Harga Pengiriman</label>
<input name='ok' type='text' size='50' onkeyup=\"this.value=this.value.replace(/[^0-9]/g,'')\" class='form-control'>
</p>
            
            <button class='btn btn-primary btn-sm' type='submit'>Simpan</button>

</form>   
<br /><br /></div></div></div></div>";
}	
echo"<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Data Kota
                                 </div>
                                
                                <div class='panel-body'> 
		<div class='table-responsive'>
<table id='style1' class='table table-striped table-bordered table-hover'>
					<thead>
						<tr>
						    <th width=5% >No</th>
							<th width=20% >Provinsi</th>
							<th width=40% >Nama Kota</th>
							<th width=20% >Ongkos Kirim</th>
							<th width=15%>Pilihan</th>
					    </tr>
					</thead>
					<tbody>";
					$p= new Paging;
	$batas=100;
	$posisi=$p->cariposisi($batas);
$kategori=mysql_query("SELECT  * FROM kota ORDER BY id_kota DESC limit $posisi,$batas ");
$no=$posisi+1;
while ($d=mysql_fetch_array($kategori)){


					   echo"<tr class='gradeA' >
					        <td align=center >$no</td>
							<td>$d[kabupaten]</td>
							<td>$d[nama_kota]</td>
							<td >$d[ongkos_kirim]</td>
							<td class='options-width3'  >
									<center>
				<a href='index.php?aksi=kota&id_k=$d[id_kota]&kot=edit' title='Edit'><button type='button' class='btn btn-info btn-circle'><i class='fa fa-pencil'></i>
                            </button></a>&nbsp;&nbsp;<a href='modul/kota.php?id_k=$d[id_kota]&act=hapus' onclick=\"return confirm ('Apakah yakin ingin menghapus $d[nama_kota] ?')\" title='Hapus'><button type='button' class='btn btn-danger btn-circle'><i class='fa fa-times'></i>
                            </button></a>";
				echo"</center>
					</td></tr>";
						$no++;	}						
						echo"</tbody>
				</table></div></div></div></div></div></div></div>"; 
}


elseif($aksi=='dataorder'){
echo"
<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Data Orders              </h1>
 
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Data Order Kustomer
                                 </div>
                                
                                <div class='panel-body'> 
		<div class='table-responsive'>
<table id='style1' class='table table-striped table-bordered table-hover'>
					<thead>
						<tr>
						    <th  >No</th>
							<th  >No.Order</th>
							<th >Nama.Kustomer</th>
							<th >Tgl.Order</th>
							<th >Jam.Order</th>
							<th >Status.Order</th>
							<th ></th>
					    </tr>
					</thead>
					<tbody>";
		
					
$tebaru=mysql_query(" SELECT * FROM orders,kustomer WHERE orders.id_kustomer=kustomer.id_kustomer ORDER BY orders.id_orders DESC ");
while ($t=mysql_fetch_array($tebaru)){
$no++;
                $isi_berita1 = strip_tags($t['deskripsi']); 
                $isi1 = substr($isi_berita1,0,70); 
                $isi1 = substr($isi_berita1,0,strrpos($isi1," ")); 
                $harga2 = number_format($t[harga],0,',','.');
                if($t[status_order]=='Baru'){$ds="gradeX";}
				elseif($t[status_order]=='Batal'){$ds="";}
				else{$ds="gradeA";}
				
				
					   echo"<tr class='$ds' >
					   <td align=center >$no</td>
					        <td align=center >$t[id_orders]</td>
							<td>$t[nama_lengkap]</td>
							<td  ><strong>$t[tgl_order]</strong></td>
							<td   align='center'><strong>$t[jam_order]</strong>	</td>
							<td  align='center'><strong>$t[status_order]</strong></td>
							<td class='options-width3'  >
					<center>
				
				  <a href='index.php?aksi=detailorder&id=$t[id_orders]' title='lihat'><button type='button' class='btn btn-success btn-circle'><i class='fa fa-search'></i></button></a>
				
				
				</center>
					    </td></tr>";
					 	}						
						echo"</tbody>
				</table></div> </div> </div> </div> </div> </div> </div>"; 
}

elseif($aksi=='detailorder'){
   $edit = mysql_query("SELECT * FROM orders,
									   kustomer,
									   kota,
									   bank
									   WHERE kota.id_kota=orders.id_kota_o AND bank.id_bank=orders.id_bank_o AND orders.id_kustomer=kustomer.id_kustomer AND id_orders='$_GET[id]'");

    $r    = mysql_fetch_array($edit);
     $tanggal=$r[tgl_order];
    
    if ($r[status_order]=='Baru'){
        $pilihan_status = array('Baru', 'Lunas');
    }
    elseif ($r[status_order]=='Lunas'){
        $pilihan_status = array('Lunas', 'Batal');    
    }
    else{
        $pilihan_status = array('Baru', 'Lunas', 'Batal');    
    }

    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $r[status_order]) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }

    echo "
<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Data Orders              </h1>
 <a href='javascript:history.go(-1)' ><button type='button' class='btn btn-warning'>KEMBALI</button></a>
 ";
 $konfirmasi=mysql_query(" SELECT * FROM konfirmasi WHERE id_order_p=$r[id_orders]");
$kn=mysql_fetch_array($konfirmasi);					
					if($kn[status]=='Baru'){
						echo"<a href='?aksi=konorder&id=$r[id_orders]' class='btn btn-primary' type='button' value=''>Cek Pembayaran</a>";
					} 
					elseif($kn[status]=='Berhasil'){
						echo"<button class='btn btn-success' type='button' value=''>Pembayaran Selesai</button>";
						} else{
					echo"<button class='btn btn-warning' type='button' value=''>Pembeli Belum Bayar</button>";
					}
 echo"
 
 
 <br />
<br />
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Data Order Kustomer
                                 </div>
                                
                                <div class='panel-body'> 	


          <form method=POST action=modul/aksi_order.php?module=order&act=update>
          <input type=hidden name=id value=$r[id_orders]>

          <table id='style2' class='table table-striped table-bordered table-hover'>
          <tr><td>No. Order</td>        <td> : $r[id_orders]</td></tr>
          <tr><td>Tgl. & Jam Order</td> <td> : $tanggal & $r[jam_order]</td></tr>
		  <tr><td>Keterangan Pengiriman</td> <td> : <textarea name='Ket' style='width: 260px; height: 150px;'>$r[Ket]</textarea></td></tr>
          <tr><td>Status Order      </td><td>: <select name=status_order>$pilihan_order</select> 
          <input type=submit value='Ubah Status'></td></tr>
          </table></form>";

 // tampilkan data kustomer
  echo "<table border=0 width=500 class='table table-striped table-bordered table-hover'>
        <tr><th colspan=2>Data Pembeli</th></tr>
        <tr><td>Nama Kustomer</td><td> : <strong>$r[nama_lengkap]</strong></td></tr>
		<tr><td>No. Telpon/HP</td><td> : <strong>$r[telpon]</strong></td></tr>
	    <tr><td>Email</td><td> : <strong>$r[email]</strong></td></tr>
		</table>
		
		<table border=0 width=500 class='table table-striped table-bordered table-hover'>
        <tr><th colspan=2>Data Pengiriman</th></tr>
        <tr><td>Alamat Pengiriman</td><td> <strong> $r[kabupaten],$r[nama_kota]<br />
		Desa/Kelurahan : $r[kel]<br />
		 				   Alamat Lengkap : $r[alamat]<br />
		 				   Kedo pos : $r[kd_pos] <br />
		</strong></td></tr>
		<tr><td>Pembayaran</td><td> Nama Bank : <strong>$r[nm_bank]</strong><br />
										&nbsp; Atas Nama : <strong>$r[at_nama]</strong><br />
										&nbsp; Nomer Rekening : <strong>$r[no_rek]</strong><br />
										&nbsp; Alamat Bank : <strong>$r[alm_bank]</strong>
										</td></tr>
		</table>

		";
  // tampilkan rincian barang yang di order
  $sql2=mysql_query("SELECT * FROM orders_detail, produk 
                     WHERE orders_detail.id_produk=produk.id_produk 
                     AND orders_detail.id_orders='$_GET[id]'");
  
  echo "<table id='style3' class='table table-striped table-bordered table-hover'>
        <tr><th width='40%' >Nama barang</th><th width='15%'>Berat(kg)</th><th width='15%'>Jumlah</th><th width='15%'>Harga Satuan</th><th width='15%'>Sub Total</th></tr>";
  
  while($s=mysql_fetch_array($sql2)){
     // rumus untuk menghitung subtotal dan total		
      $disc        = ($s[diskon]/100)*$s[harga];
   $discmember  = (2/100)*$s[harga];
   $hargadisc   = number_format(($s[harga]-$disc),0,",",".");
   $subtotal    = ($s[harga]-$disc-$discmember) * $s[jumlah];

    $total       = $total + $subtotal;
    $subtotal_rp = format_rupiah($subtotal);    
    $total_rp    = format_rupiah($total);    
    $harga       = format_rupiah($s[harga]);

   $subtotalberat = $s[berat] * $s[jumlah]; // total berat per item produk 
   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli

    echo "<tr><td><strong>$s[nama_produk]</strong></td><td align=center>$s[berat]</td><td align=center>$s[jumlah]</td>
              <td align=left><strong>Rp.$harga</strong></td><td align='right'><strong>Rp.$subtotal_rp</strong></td></tr>";
  }

  $ongkos=mysql_fetch_array(mysql_query("SELECT * FROM kota,kustomer,orders 
          WHERE kustomer.id_kota=kota.id_kota AND orders.id_kustomer=kustomer.id_kustomer AND id_orders='$_GET[id]'"));
  $ongkoskirim1=$ongkos[ongkos_kirim];
  $ongkoskirim=$ongkoskirim1 * $totalberat;

  $grandtotal    = $total + $ongkoskirim; 

  $ongkoskirim_rp = format_rupiah($ongkoskirim);
  $ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
  $grandtotal_rp  = format_rupiah($grandtotal);    

echo "<tr><td colspan=4 align=right> jika member diskon 2% dari barang Total              Rp. : </td><td align=right><b>$total_rp</b></td></tr>
      <tr><td colspan=4 align=right>Ongkos Kirim       Rp. : </td><td align=right><b>$ongkoskirim1_rp</b>/Kg</td></tr>      
      <tr><td colspan=4 align=right>Total Berat            : </td><td align=right><b>$totalberat</b> Kg</td></tr>      
      <tr><td colspan=4 align=right>Total Ongkos Kirim Rp. : </td><td align=right><b>$ongkoskirim_rp</b></td></tr>      
      <tr><td colspan=4 align=right>Grand Total        Rp. : </td><td align=right><b>$grandtotal_rp</b></td></tr>
      </table>";

  // tampilkan data kustomer
 $konfirmasi=mysql_query(" SELECT * FROM konfirmasi WHERE id_order_p=$r[id_orders]");
$kn=mysql_fetch_array($konfirmasi);					
					if($kn[status]=='Baru'){
						echo"
						<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form konfirmasi
                                 </div>
                                
                                <div class='panel-body'> 

<table id='style2' class='table table-striped table-bordered table-hover'>
       <tr>
    <td valign='top'><strong>Struk Bukti Tranfer</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'><a href='?aksi=konorder&id=$r[id_orders]' ><img class=img-thumbnail src='../foto/foto_bukti/$kn[gambar]'  width=190 /></a></td>
  </tr>

 
</table><br /></div></div></div></div>";
					} 
					elseif($kn[status]=='Berhasil'){
						echo"						<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									konfirmasi Pemabayaran
                                 </div>
                                
                                <div class='panel-body'> 

<table id='style2' class='table table-striped table-bordered table-hover'>
       <tr>
    <td valign='top'><strong>Struk Bukti Tranfer</strong></td>
    <td valign='top'><a href='?aksi=konorder&id=$r[id_orders]' ><img class=img-thumbnail src='../foto/foto_bukti/$kn[gambar]'  width=190 /></a></td>
  </tr>

 
</table><br /></div></div></div></div>";
						} else{
					echo"<button class='btn btn-warning' type='button' value=''>Pembeli Belum Bayar</button>";
					}

    }  


elseif($aksi=='konorder'){

echo"<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Konfirmasi Pembayaran
                    </h1>";
	$agenda2=mysql_query(" SELECT * FROM konfirmasi WHERE id_order_p='$_GET[id]'");
	$d2=mysql_fetch_array($agenda2); 
	$komen=wordwrap($d2['isi_komentar'], 50, "<br />\n", 1);
	$tanggal=$d2[tgl_transfer];

if($d2[status]=='Baru'){
				echo"<a href='modul/kon.php?act=statusorder&id_bk=$d2[id_order_p]' title='konfirmasi' class='ok' > 
				<button class='btn btn-primary btn-sm'>Setujui Pembayaran</button></a><br />
";
				}else{echo"<a href='modul/kon.php?act=status&id_bk=$d2[id_konfrim]&beku=beku' title='Batal' class='ok'><button class='btn btn-danger btn-sm'>Batal</button></a><br />";
				}

echo" <br />
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form konfirmasi
                                 </div>
                                
                                <div class='panel-body'> 

<table id='style2' class='table table-striped table-bordered table-hover'>
  <tr>
    <td width='107' valign='top'><strong>Id Order</strong></td>
    <td width='12' valign='top'><strong>:</strong></td>
    <td width='502' valign='top'><strong><strong>$d2[id_order_p]</strong></strong></td>
  </tr>
  <tr>
    <td width='107' valign='top'><strong>Atas Nama</strong></td>
    <td width='12' valign='top'><strong>:</strong></td>
    <td width='502' valign='top'>$d2[nm_pengirim]</td>
  </tr>
  <tr>
    <td valign='top'><strong>Tanggal.Tranfer</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'>$d2[tgl_transfer]</td>
  </tr>
  <tr>
    <td valign='top'><strong>Nama Bank</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'>$d2[nm_bank]</td>
  </tr>
  <tr>
    <td valign='top'><strong>Metode Transfer</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'>$d2[mt_tranfer]</td>
  </tr>
    <tr>
    <td valign='top'><strong>Jumlah Transfer</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'>Rp. $d2[j_transfer]</td>
  </tr>
       <tr>
    <td valign='top'><strong>Struk Bukti Tranfer</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'><img class=img-thumbnail src='../foto/foto_bukti/$d2[gambar]'  width=190 /></td>
  </tr>
    <tr>
    <td valign='top'><strong>Status Pembayaran</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'>$d2[status]</td>
  </tr>
 
</table><br /></div></div></div></div>
<a href='javascript:history.go(-1)' class='ok'><button class='btn btn-primary btn-sm'>Kembali</button></a><br /><br />
</div></div>
";
  }

////////////////////////////////////////////////////////////////////////////////////

elseif($aksi=='konfirmasi'){
				echo"<div class='row'>
                	<div class='col-lg-12'>
                    <h1 class='page-header'>Data Konfirmasi Pembayaran</h1>
                	</div>
                <!-- /.col-lg-12 -->
            	</div>	
				
			    <div class='row'>
                	<div class='col-lg-12'>
                    	<div class='panel panel-default'>
							
                        <div class='panel-heading'>
                            <i class='fa fa-bar-chart-o fa-fw'></i> Data Konfirmasi
                            
                        </div>
                                <div class='panel-body'>
								<div class='table-responsive'>
				<table id='style1' class='table table-striped table-bordered table-hover'>
					<thead>
						<tr>
						    <th>No</th>
							<th>No Orders</th>
							<th>Atas Nama </th>
						
							
							<th>Jumlah</th>
							<th>Tanggal</th>
							<th>Status</th>
							<th></th>
					    </tr>
					</thead>
					<tbody>";
$tebaru=mysql_query(" SELECT * FROM konfirmasi ORDER BY id_konfrim	DESC ");
while ($t=mysql_fetch_array($tebaru)){
$no++;

					   echo"<tr>
					        <td>$no</td>
							<td>$t[id_order_p]</td>
							<td>$t[nm_pengirim]</td>
						
							
							<td>$t[j_transfer]</td>
							<td>$t[tgl_transfer]</td>
							<td><strong>$t[status]</strong></td>
							<td>
							<center><a href='index.php?aksi=kon&id=$t[id_konfrim]' title='Ubah Status Order'><button type='button' class='btn btn-success btn-circle'><i class='fa fa-search'></i></button></a>&nbsp;
							<a href='modul/konfirm.php?id_k=$t[id_konfrim]' onclick=\"return confirm ('Apakah yakin ingin menghapus  ?')\" title='Hapus'><button type='button' class='btn btn-danger btn-circle'><i class='fa fa-times'></i>
                            </button></a></center>
				
					    </td></tr>";
					 	}						
						echo"
					</tbody>
				</table>
				</div>
    </div>
   </div>
 </div></div>"; 

}
elseif($aksi=='kon'){
echo"<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Konfirmasi Pembayaran
                    </h1>";
	$agenda2=mysql_query(" SELECT * FROM konfirmasi WHERE id_konfrim='$_GET[id]'");
	$d2=mysql_fetch_array($agenda2); 
	$komen=wordwrap($d2['isi_komentar'], 50, "<br />\n", 1);

if($d2[status]=='Baru'){
				echo"<a href='modul/kon.php?act=status&id_bk=$d2[id_konfrim]' title='konfirmasi' class='ok' > 
				<button class='btn btn-primary btn-sm'>Konfirmasi Pembayaran</button></a><br />
";
				}else{echo"<a href='modul/kon.php?act=status&id_bk=$d2[id_konfrim]&beku=beku' title='Batal' class='ok'><button class='btn btn-danger btn-sm'>Batal</button></a><br />";
				}

echo" <br />
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form Konfirmasi
                              </div>
                                
                                <div class='panel-body'> 

<table id='style2' class='table table-striped table-bordered table-hover'>
  <tr>
    <td width='107' valign='top'><strong>Id Order</strong></td>
    <td width='12' valign='top'><strong>:</strong></td>
    <td width='502' valign='top'><strong><strong>$d2[id_order_p]</strong></strong></td>
  </tr>
  <tr>
    <td width='107' valign='top'><strong>Atas Nama</strong></td>
    <td width='12' valign='top'><strong>:</strong></td>
    <td width='502' valign='top'>$d2[nm_pengirim]</td>
  </tr>
  <tr>
    <td valign='top'><strong>Tanggal.Tranfer</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'>$d2[tgl_transfer]</td>
  </tr>
  <tr>
    <td valign='top'><strong>Nama Bank</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'>$d2[nm_bank]</td>
  </tr>
      <tr>
    <td valign='top'><strong>Nama.Rekening.Pengirim</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'>$d2[no_rek]</td>
  </tr>
  <tr>
    <td valign='top'><strong>Metode Transfer</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'>$d2[mt_tranfer]</td>
  </tr>
    <tr>
    <td valign='top'><strong>Jumlah Transfer</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'>Rp. $d2[j_transfer]</td>
  </tr>
    <tr>
    <td valign='top'><strong>Status Pembayaran</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'>$d2[status]</td>
  </tr>
     <tr>
    <td valign='top'><strong>Struk Bukti Tranfer</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'><img class=img-thumbnail src='../foto/foto_bukti/$d2[gambar]'  width=190 /></td>
  </tr>
</table><br /></div></div></div></div>
<a href='javascript:history.go(-1)' class='ok'><button class='btn btn-primary btn-sm'>Kembali</button></a><br /><br />
</div></div>
";
  }
  elseif($aksi=='bank'){
echo"<div class='row'>
                	<div class='col-lg-12'>
                    <h1 class='page-header'>Data Bank</h1>
                	</div>
                <!-- /.col-lg-12 -->
            	</div>	
<a href='?aksi=inputbank' class='ok'><button class='btn btn-primary btn-sm'>Tambah Bank</button></a><br /><br />
<div class='row'>
                        <div class='row'>
                	<div class='col-lg-12'>
                    	<div class='panel panel-default'>
							
                        <div class='panel-heading'>
                            <i class='fa fa-bar-chart-o fa-fw'></i> Data Barang
                            
                        </div>
                                <div class='panel-body'>
				 <div class='table-responsive'>
				<table id='style1' class='table table-striped table-bordered table-hover'>
					<thead>
						<tr>
						    <th></th>
							<th>Nama Bank</th>
							<th>Atas Nama</th>
							<th>No. Rekening</th>
							<th>Alamat Bank</th>
							
							<th width=12%>Pilihan</th>
					    </tr>
					</thead>
					<tbody>";
$tebaru=mysql_query(" SELECT * FROM bank order by id_bank DESC ");
while ($t=mysql_fetch_array($tebaru)){
$no++;

					   echo"<tr>
					       <td><img class=img-thumbnail src='../foto/foto_bank/$t[gb]'  width=50 /></td>
							<td>$t[nm_bank]</td>
							<td>$t[at_nama]</td>
							<td>$t[no_rek]</td>
							<td>$t[alm_bank]</td>
							
							<td>
					
					<div class='btn-group'>
                                            <button type='button' class='btn btn-info'>Action</button>
                                            <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
                                                <span class='caret'></span>
                                                <span class='sr-only'>Toggle Dropdown</span>
                                            </button>
                                            <ul class='dropdown-menu' role='menu'>
                                                <li><a href='?aksi=editbank&id_b=$t[id_bank]'>Edit</a></li>
                                                 <li><a href='modul/bank.php?id_b=$t[id_bank]&act=hapus&gbr=$t[gb]' onclick=\"return confirm ('Apakah yakin ingin menghapus $t[nm_bank] ?')\">Hapus</a></li>
                                            </ul>
                              </div>
				
					    </td></tr>";
					 	}						
						echo"
					</tbody>
				</table>
				</div>
    </div>
   </div>
 </div></div></div>"; 
}

elseif($aksi=='inputbank'){

echo"
<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Input Bank Tranfer
</h1>
	
<a href='javascript:history.go(-1)' class='ok'><button class='btn btn-primary btn-sm'>Kembali</button></a><br /><br />
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form Input Bank
                              </div>
                                
                                <div class='panel-body'>

<form name='form1' id='form_combo' role='form' enctype='multipart/form-data' method='post' action='modul/bank.php?act=input'>
       
    	<label>Nama Bank Tranfer</label>
        <input type='text' class='form-control'  name='nama'/><br>

		<label>Atas Nama</label>
        <input type='text' class='form-control'  name='AT'/><br>
		
		<label>Nomer Rekening</label>
        <input type='text' class='form-control'  name='NR'/><br>
		
			<label>Alamat Bank</label>
        <input type='text' class='form-control'  name='AB'/><br>
		
		<label>Gambar</label>
        <input type='file' class='smallInput' name='gambar'/><br>
		
		<br />
            <button class='btn btn-primary btn-sm' type='submit'>Simpan</button>
            <button class='btn btn-primary btn-sm' type='reset'>Reset</button>
    </form>
	       </div>
                        </div>
                    </div></div></div></div>
";
}

elseif($aksi=='editbank'){
$tebaru=mysql_query(" SELECT * FROM bank WHERE id_bank='$_GET[id_b]' ");
$t=mysql_fetch_array($tebaru);
echo"
<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Edit Bank Tranfer
</h1>
	
<a href='javascript:history.go(-1)' class='ok'><button class='btn btn-primary btn-sm'>Kembali</button></a><br /><br />
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form Input Bank
                              </div>
                                
                                <div class='panel-body'>

<form name='form1' id='form_combo' role='form' enctype='multipart/form-data' method='post' action='modul/bank.php?act=edit&id_b=$t[id_bank]&gb=$t[gb]'>
       
    	<label>Nama Bank Tranfer</label>
        <input type='text' class='form-control' value='$t[nm_bank]' name='nama'/><br>

		<label>Atas Nama</label>
        <input type='text' class='form-control' value='$t[at_nama]' name='AT'/><br>
		
		<label>Nomer Rekening</label>
        <input type='text' class='form-control' value='$t[no_rek]'  name='NR'/><br>
		
			<label>Alamat Bank</label>
        <input type='text' class='form-control' value='$t[alm_bank]' name='AB'/><br>
		
		<label>Gambar</label>
        <input type='file' class='smallInput' name='gambar'/><br>
		
		<br />
            <button class='btn btn-primary btn-sm' type='submit'>Simpan</button>
            <button class='btn btn-primary btn-sm' type='reset'>Reset</button>
    </form>
	       </div>
                        </div>
                    </div></div></div></div>
";
}




else if($aksi=='pesan'){



if($_GET[lihat]=='v'){
echo"
            <div class='inner'>
   <br>


                <div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            Data Testimonial
                        </div>
                        <div class='panel-body'>
                            <div class='table-responsive'>";



 $judul= mysql_query("SELECT * FROM komentar,produk WHERE komentar.id_prod=produk.id_produk AND komentar.id_prod=$_GET[id]  ORDER BY id_komen ASC");
 $dg=mysql_fetch_array($judul);
 
 echo"<h3 class='col_w900 hr_divider'>Komentar di "; if($dg[id_prod]!=0){echo"<strong>$dg[judul]</strong>";}else{echo"<strong>Testimonial</strong>";}
 
 
 echo"</h3>";
 
	 $getComments = mysql_query("SELECT * FROM komentar WHERE id_prod=$_GET[id] AND jwb='0' ORDER BY id_komen ASC");
    if(mysql_num_rows($getComments) > 0){
        while($comments=mysql_fetch_array($getComments)){
		$komen=wordwrap($comments[komentar], 80, "<br />\n", 1);
            echo "

<div class='jr'>
<div class='nk'>$comments[nama]</div>
$comments[email]<br />
<em class='tgl2'>Pada $comments[tgl] | $comments[jam] Mengatakan....</em>		
		<div class='komenbox'>
		$komen<br />
		<div class='kn'><a href='?aksi=balas&id=$_GET[id]&id_km=$comments[id_komen]'>Balas Komentar</a></div>
		<div class='clear'></div>
        </div></div>";
            
            $getReplies = mysql_query("SELECT * FROM komentar WHERE  id_prod=$_GET[id] AND jwb='1' AND balas='$comments[id_komen]' ORDER BY id_komen ASC");
            if(mysql_num_rows($getReplies) > 0){
                while($replies = mysql_fetch_array($getReplies)){
				$komen2=wordwrap($replies[komentar], 90, "<br />\n", 1);
				
				if($replies[admin]=='Y'){
				echo"
	<div class='jk'>
<div class='nad'>$replies[nama]</div>
$comments[email]<br />
<em class='tgl2'>Pada $replies[tgl] | $replies[jam] Mengatakan....</em>		
		<div class='komenbox3'>
		<em>Membalas Komentar <strong>@$replies[nm_bls]</strong></em><br />
		$komen2<br />
		<div class='kn'></div>
		<div class='clear'></div>
        </div></div>
				
				
				";
				}else{
                    
					echo "
					
					<div class='jk'>
<div class='nk'>$replies[nama]</div>
$comments[email]<br />
<em class='tgl2'>Pada $replies[tgl] | $replies[jam] Mengatakan....</em>		
		<div class='komenbox2'>
		<em>Membalas Komentar <strong>@$replies[nm_bls]</strong></em><br />
	$komen2<br />
		<div class='kn'><a href='?aksi=balas&id=$_GET[id]&id_km=$replies[id_komen]'>Balas Komentar</a> </div>
		<div class='clear'></div>
        </div></div>";
					}
                }
            }
        }
echo" <br />";		
}

  }	



echo"<div class='row'>
                	<div class='col-lg-12'>
                    <h1 class='page-header'>Testimonial Pembeli</h1>
                	</div>
                <!-- /.col-lg-12 -->
            	</div>	

<div class='row'>
                        <div class='row'>
                	<div class='col-lg-12'>
                    	<div class='panel panel-default'>
							
                        <div class='panel-heading'>
                            <i class='fa fa-bar-chart-o fa-fw'></i> Testimonial Pembeli
                            
                        </div>
                                <div class='panel-body'>
				 <div class='table-responsive'>
				<table id='style1' class='table table-striped table-bordered table-hover'>
					<thead>
						<tr>
						    <th width=1% >No</th>
							<th width=25% >Nama</th>
							<th width=15% >Balas</th>
						
							<th width=10%>Tanggal</th>
						
							<th width=12% >Pilihan</th>
					    </tr>
					</thead>
					<tbody>";
$tebaru=mysql_query(" SELECT * FROM komentar WHERE id_prod=0 ORDER BY id_komen DESC ");
while ($t=mysql_fetch_array($tebaru)){
$no++;

					   echo"<tr>
					        <td>$no</td>
							<td><strong>$t[nama]</strong></td>
							<td><strong>$t[nm_bls]</strong></td>
						
							<td>$t[tgl]</td>
						
							<td>
					
					<div class='btn-group'>
                                            <button type='button' class='btn btn-info'>Action</button>
                                            <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
                                                <span class='caret'></span>
                                                <span class='sr-only'>Toggle Dropdown</span>
                                            </button>
                                            <ul class='dropdown-menu' role='menu'>
                                                <li><a href='?aksi=pesan&lihat=v&id=$t[id_prod]'>lihat</a></li>
                                                 <li><a href='modul/komen.php?id_k=$t[id_komen]&pilih=hapus&id=$t[id_prod]' onclick=\"return confirm ('Apakah yakin ingin menghapus $t[nama_produk] ?')\">Hapus</a></li>
                                            </ul>
                              </div>
				
					    </td></tr>";
					 	}						
						echo"
					</tbody>
				</table>
				</div>
    </div>
   </div>
 </div></div></div>"; 
}

else if($aksi=='komentar'){



if($_GET[lihat]=='v'){
echo"
            <div class='inner'>
   <br>


                <div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            Data Komentar Produk
                        </div>
                        <div class='panel-body'>
                            <div class='table-responsive'>";



 $judul= mysql_query("SELECT * FROM komentar,produk WHERE komentar.id_prod=produk.id_produk AND komentar.id_prod=$_GET[id]  ORDER BY id_komen ASC");
 $dg=mysql_fetch_array($judul);
 
 echo"<h3 class='col_w900 hr_divider'>Komentar di "; if($dg[id_prod]!=0){echo"<strong>$dg[nama_produk]</strong>";}else{echo"<strong>Testimonial</strong>";}
 
 
 echo"</h3>";
 
	 $getComments = mysql_query("SELECT * FROM komentar WHERE id_prod=$_GET[id] AND jwb='0' ORDER BY id_komen ASC");
    if(mysql_num_rows($getComments) > 0){
        while($comments=mysql_fetch_array($getComments)){
		$komen=wordwrap($comments[komentar], 80, "<br />\n", 1);
            echo "

<div class='jr'>
<div class='nk'>$comments[nama]</div>
$comments[email]<br />
<em class='tgl2'>Pada $comments[tgl] | $comments[jam] Mengatakan....</em>		
		<div class='komenbox'>
		$komen<br />
		<div class='kn'><a href='?aksi=balas&id=$_GET[id]&id_km=$comments[id_komen]'>Balas Komentar</a></div>
		<div class='clear'></div>
        </div></div>";
            
            $getReplies = mysql_query("SELECT * FROM komentar WHERE  id_prod=$_GET[id] AND jwb='1' AND balas='$comments[id_komen]' ORDER BY id_komen ASC");
            if(mysql_num_rows($getReplies) > 0){
                while($replies = mysql_fetch_array($getReplies)){
				$komen2=wordwrap($replies[komentar], 90, "<br />\n", 1);
				
				if($replies[admin]=='Y'){
				echo"
	<div class='jk'>
<div class='nad'>$replies[nama]</div>
$comments[email]<br />
<em class='tgl2'>Pada $replies[tgl] | $replies[jam] Mengatakan....</em>		
		<div class='komenbox3'>
		<em>Membalas Komentar <strong>@$replies[nm_bls]</strong></em><br />
		$komen2<br />
		<div class='kn'></div>
		<div class='clear'></div>
        </div>
				
				
				";
				}else{
                    
					echo "
					
					<div class='jk'>
<div class='nk'>$replies[nama]</div>
$comments[email]<br />
<em class='tgl2'>Pada $replies[tgl] | $replies[jam] Mengatakan....</em>		
		<div class='komenbox2'>
		<em>Membalas Komentar <strong>@$replies[nm_bls]</strong></em><br />
	$komen2<br />
		<div class='kn'><a href='?aksi=balas&id=$_GET[id]&id_km=$replies[id_komen]'>Balas Komentar</a> </div>
		<div class='clear'></div>
        </div></div>";
					}
                }
            }
        }
echo" <br /></div></div></div></div></div></div>";		
}

  }	



echo"<div class='row'>
                	<div class='col-lg-12'>
                    <h1 class='page-header'> Data Komentar Produk</h1>
                	</div>
                <!-- /.col-lg-12 -->
            	</div>	

<div class='row'>
                        <div class='row'>
                	<div class='col-lg-12'>
                    	<div class='panel panel-default'>
							
                        <div class='panel-heading'>
                            <i class='fa fa-bar-chart-o fa-fw'></i>  Data Komentar Produk
                            
                        </div>
                                <div class='panel-body'>
				 <div class='table-responsive'>
				<table id='style1' class='table table-striped table-bordered table-hover'>
					<thead>
						<tr>
						    <th width=1% >No</th>
							<th width=25% >Nama</th>
							<th width=15% >Balas</th>
						
							<th width=10%>Tanggal</th>
						
							<th width=12% >Pilihan</th>
					    </tr>
					</thead>
					<tbody>";
$tebaru=mysql_query(" SELECT * FROM komentar WHERE id_prod!=0 ORDER BY id_komen DESC ");
while ($t=mysql_fetch_array($tebaru)){
$no++;

					   echo"<tr>
					        <td>$no</td>
							<td><strong>$t[nama]</strong></td>
							<td><strong>$t[nm_bls]</strong></td>
						
							<td>$t[tgl]</td>
						
							<td>
					
					<div class='btn-group'>
                                            <button type='button' class='btn btn-info'>Action</button>
                                            <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
                                                <span class='caret'></span>
                                                <span class='sr-only'>Toggle Dropdown</span>
                                            </button>
                                            <ul class='dropdown-menu' role='menu'>
                                                <li><a href='?aksi=komentar&lihat=v&id=$t[id_prod]'>lihat</a></li>
                                                 <li><a href='modul/komen.php?id_k=$t[id_komen]&pilih=hapus&id=$t[id_prod]' onclick=\"return confirm ('Apakah yakin ingin menghapus $t[nama_produk] ?')\">Hapus</a></li>
                                            </ul>
                              </div>
				
					    </td></tr>";
					 	}						
						echo"
					</tbody>
				</table>
				</div>
    </div>
   </div>
 </div></div></div>"; 
}


else if($aksi=='balas'){
  $bls = mysql_query("SELECT * FROM komentar WHERE id_komen=$_GET[id_km]");
      $bl=mysql_fetch_array($bls);	 
echo"  

<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Input Buku tamu
                    </h1>
	
<a href='javascript:history.go(-1)' class='ok'><button class='btn btn-primary btn-sm'>Kembali</button></a><br /><br />
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form buku tamu
                              </div>
                                
                                <div class='panel-body'>
								
	<form class='form-horizontal' id='block-validate' enctype='multipart/form-data' method='post' action='modul/komen.php?id=$_GET[id]&id_km=$bl[id_komen]&pilih=balas'>
		

		<label>Nama Kamu : <strong>$_SESSION[nama]</strong></label><br>
		<label>Balas Ke : <strong>$bl[nama]</strong></label><br>
		<label>Email Kamu :  <strong>$_SESSION[email]</strong></label><br>
		<label>Komentar : </label><br>
		$bl[komentar]<br><br>


    	
        <input type='hidden' name='nama' value='$_SESSION[nama]'/>
		<input type='hidden' name='bls' value='$bl[nama]'/>
		<input type='hidden' name='email' value='$_SESSION[email]'/>

		  
		<strong>Balas Komentar</strong><br>
        <textarea id='tinymce_basic' class='form-control' name='isi' rows='10'></textarea><script>

			CKEDITOR.replace( 'tinymce_basic', {
				fullPage: true,
				allowedContent: true,
				extraPlugins: 'wysiwygarea'
			});

		</script>
		
   
<br>

        
            <input type='submit' name='Submit' value='Simpan' class='btn btn-success'>
            <input type='reset' name='Submit2' value='Ulangi' class='btn btn-warning'>
			<div class='cleaner h10'></div>
    </form>
	
                                </div>
                            </div>
                        </div>
                    </div>
               

                    
                    </div></div>";
                    
					}
/////////////////////////////////////////////////////////////////////////////////////////////////

elseif($aksi=='informasi'){
echo"<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Data Informasi
</h1>


<a href='?aksi=inputinfo' class='ok'><button class='btn btn-primary btn-sm'>Tambah Informasi</button></a> <br /><br />


<div class='row'>
                	<div class='col-lg-12'>
        
                	</div>
                <!-- /.col-lg-12 -->
</div>	

<div class='row'>
                        <div class='row'>
                	<div class='col-lg-12'>
                    	<div class='panel panel-default'>
							
                        <div class='panel-heading'>
                            <i class='fa fa-bar-chart-o fa-fw'></i> Data Informasi
                            
                        </div>
                                <div class='panel-body'>
				 <div class='table-responsive'>
				<table id='style1' class='table table-striped table-bordered table-hover'>
					<thead>
						<tr>
						    <th width='5%'>No</th>
							<th width='10%'></th>
							<th width='30%'>Judul</th>
							<th width='20%'>Tanggal Input</th>
							<th width=12%>Pilihan</th>
					    </tr>
					</thead>
					<tbody>";
					
$tebaru=mysql_query(" SELECT * FROM berita order by id_berita DESC ");
while ($t=mysql_fetch_array($tebaru)){
$no++;

					   echo"<tr>
					        <td>$no</td>
							<td><img src='../foto/data/$t[gambar]' width='80' /></td>
							<td>
							<strong>$t[judul]</strong>
							</td>
					<td>
							<strong>$t[tanggal] | $t[jam]</strong>
						 </td>
							<td>
					
					<div class='btn-group'>
                                            <button type='button' class='btn btn-info'>Action</button>
                                            <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
                                                <span class='caret'></span>
                                                <span class='sr-only'>Toggle Dropdown</span>
                                            </button>
                                            <ul class='dropdown-menu' role='menu'>
                                                <li><a href='?aksi=editinfo&id_b=$t[id_berita]'>Edit</a></li>
                                                 <li><a href='modul/artikel.php?id_b=$t[id_berita]&act=hapus&gbr=$t[gambar]' onclick=\"return confirm ('Apakah yakin ingin menghapus $t[judul] ?')\">Hapus</a></li>
                                            </ul>
                              </div>
				
					    </td></tr>";
					 	}						
						echo"
					</tbody>
				</table>
				</div>
    </div>
   </div>
 </div> </div> </div> </div> </div>"; 
}
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

elseif($aksi=='inputinfo'){

echo"
<div class='row'>
                	<div class='col-lg-12'>

	<br />

<a href='javascript:history.go(-1)' class='ok'><button class='btn btn-primary btn-sm'>Kembali</button></a><br /><br />
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form Input Informasi
                              </div>
                                
                                <div class='panel-body'>

<form name='form1' id='form_combo' role='form' enctype='multipart/form-data' method='post' action='modul/artikel.php?act=input'>
        
    	<label>Judul</label>
        <input type='text' class='form-control'  name='jd' required/><br>
		
		
		<label>Gambar</label>
        <input type='file' class='smallInput' name='gambar' required/><br>
		<label>Isi</label>
        <textarea  id='tinymce_basic'  name='isi' class='smallInput wide' rows='7' cols='30'></textarea><script>

			CKEDITOR.replace( 'tinymce_basic', {
				fullPage: true,
				allowedContent: true,
				extraPlugins: 'wysiwygarea'
			});

		</script><br />
		<br />
            <button class='btn btn-primary btn-sm' type='submit'>Simpan</button>
            <button class='btn btn-primary btn-sm' type='reset'>Reset</button>
    </form>
	       </div>
                        </div>
                    </div> </div> </div> </div> 
";
}
///////////////////////////////////////////////////////////////////////////////////////////////////
elseif($aksi=='editinfo'){
$detail=mysql_query(" SELECT * FROM berita where id_berita='$_GET[id_b]' ");
$d=mysql_fetch_array($detail); 
echo"
<div class='row'>
                	<div class='col-lg-12'>

	<br />

<a href='javascript:history.go(-1)' class='ok'><button class='btn btn-primary btn-sm'>Kembali</button></a><br /><br />
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form Input Informasi
                              </div>
                                
                                <div class='panel-body'>

<form name='form1' id='form_combo' role='form' enctype='multipart/form-data' method='post' action='modul/artikel.php?act=edit&id_b=$d[id_berita]&gb=$d[gambar]'>
        
    	<label>Judul</label>
        <input type='text' class='form-control' value='$d[judul]' name='jd' required/><br>
		
		
		<label>Gambar</label>
        <input type='file' class='smallInput' name='gambar' /><br>
		<label>Isi</label>
        <textarea  id='tinymce_basic'  name='isi' class='smallInput wide' rows='7' cols='30'>$d[isi]</textarea><script>

			CKEDITOR.replace( 'tinymce_basic', {
				fullPage: true,
				allowedContent: true,
				extraPlugins: 'wysiwygarea'
			});

		</script><br />
		<br />
            <button class='btn btn-primary btn-sm' type='submit'>Simpan</button>
            <button class='btn btn-primary btn-sm' type='reset'>Reset</button>
    </form>
	       </div>
                        </div>
                    </div> </div> </div>  </div>
";
}
///////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
elseif($aksi=='kontak'){
$tebaru=mysql_query(" SELECT * FROM kontak order by id_kontak DESC");
$t=mysql_fetch_array($tebaru);
echo"
<br />
<br />

<a href='index.php?aksi=kontak_edit&id=1' title='publikasikan' class='ok' > 
				<button class='btn btn-primary btn-sm'>Edit Kontak</button></a><br /><br />

<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Kontak Perusahaan
                                 </div>
                                
                                <div class='panel-body'> 

<table id='style2' class='table table-striped table-bordered table-hover'>
  <tr>
    <td width='107' valign='top'><strong>Peta </strong></td>
    <td width='12' valign='top'><strong>:</strong></td>
    <td width='502' valign='top'>$t[peta] <img src='../foto/foto_profil/$t[foto]' align='right' height='350' /></td>
  </tr>

  <tr>
    <td valign='top'><strong>Aktifkan Peta</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'><strong>$t[aktif]</strong></td>
  </tr>
  <tr>
    <td valign='top'><strong>Nama Perusahaan</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'><strong>$t[nama_perusahaan]</strong></td>
  </tr>
  <tr>
    <td valign='top'><strong>Alamat Perusahaan</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'><strong>$t[alamat]</strong></td>
  </tr>
  <tr>
    <td valign='top'><strong>Telepon </strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'><strong>$t[telepon]</strong></td>
  </tr>
    <tr>
    <td valign='top'><strong>Telepon 2</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'><strong>$t[telepon_2]</strong></td>
  </tr>
  <tr>
    <td valign='top'><strong>Email</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'><strong>$t[email]</strong></td>
  </tr>
  <tr>
    <td valign='top'><strong>Email 2</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'><strong>$t[email_2]</strong></td>
  </tr>
    <tr>
    <td valign='top'><strong>Jam Buka</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'><strong>$t[jam_buka]</strong></td>
  </tr>
      <tr>
    <td valign='top'><strong>Sambutan</strong></td>
    <td valign='top'><strong>:</strong></td>
    <td valign='top'>$t[sambutan]</td>
  </tr>
  
  
  
  
</table><br /></div></div></div></div>

";
}
////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////
elseif($aksi=='kontak_edit'){
$tebaru=mysql_query(" SELECT * FROM kontak WHERE id_kontak=$_GET[id]");
$t=mysql_fetch_array($tebaru);

echo"
<div class='row'>
                	<div class='col-lg-12'>
<h1 class='page-header'>
Data Kontak
                    </h1>
	
<a href='javascript:history.go(-1)' class='ok'><button class='btn btn-primary btn-sm'>Kembali</button></a><br /><br />
<div class='row'>
                       
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
									Form Edit Kontak
                                 </div>
                                
                                <div class='panel-body'>
								
     
			$t[peta] <img src='../foto/foto_profil/$t[foto]' align='right' height='350' /><br />

<form name='form1' id='form_combo' role='form' enctype='multipart/form-data' method='post' action='modul/kontak.php?act=edit&id=$t[id_kontak]&gb=$t[foto]&gl=$t[logo]'>			
    	<label>Peta</label>
        <input type='text' class='form-control' value='$t[peta]'  name='peta'/><br>
		
		<label>Aktifkan Peta </label>";
        if($t[aktif] =='Y'){$ab='checked';}
		if($t[aktif] =='N'){$ac='checked';}
        echo" <input type='radio' name='pi' value='Y' $ab >
		<strong>YA</strong>
		<input type='radio' name='pi' value='N' $ac >
        <strong>TIDAK</strong>
		<br /><br />
		";
		echo"
		<label>Nama Perusahaan</label>
        <input type='text' class='form-control' value='$t[nama_perusahaan]'  name='nama_p' required/><br>
		
		<label>Alamat Toko</label>
        <input type='text' class='form-control' value='$t[alamat]'  name='alamat' required/><br>
		
		<label>Telepon </label>
        <input type='text' class='form-control' value='$t[telepon]' name='telepon' required/><br>
		
		<label>Telepon 2</label>
        <input type='text' class='form-control' value='$t[telepon_2]' name='telepon2'/><br>
	
		<label>Email</label>
        <input type='email' class='form-control' value='$t[email]' name='email' required/><br>
		
		<label>Email 2</label>
        <input type='email' class='form-control' value='$t[email_2]' name='email2' /><br>
		
		
		<label>Foto Perusahaan</label>
        <input type='file' class='smallInput' name='gambar' /><br>
		
		


		<label>Jam Buka</label>
        <textarea  id='tinymce_basic' name='ket' class='smallInput wide' rows='7' cols='30'>$t[jam_buka]</textarea><script>

			CKEDITOR.replace( 'tinymce_basic', {
				fullPage: true,
				allowedContent: true,
				extraPlugins: 'wysiwygarea'
			});

		</script><br />
		<label>Sambutan</label>
        <textarea  id='tinymce_basic2' name='sambutan' class='smallInput wide' rows='7' cols='30'>$t[sambutan]</textarea><script>

			CKEDITOR.replace( 'tinymce_basic2', {
				fullPage: true,
				allowedContent: true,
				extraPlugins: 'wysiwygarea'
			});

		</script><br />
		<br />
            <button class='btn btn-primary btn-sm' type='submit'>Simpan</button>
            <button class='btn btn-primary btn-sm' type='reset'>Reset</button>
    </form>
	   </div></div></div></div></div></div>
";
}
////////////////////////////////////////////////////////////////////////////////////////////
elseif($aksi=='laporan'){
echo"<div class='row'>
                	<div class='col-lg-12'>
                    <h1 class='page-header'>Laporan Penjualan</h1>
                	</div>
                <!-- /.col-lg-12 -->
            	</div>	

                        <div class='row'>
                	<div class='col-lg-12'>
                    	<div class='panel panel-default'>
							
                        <div class='panel-heading'>
                            <i class='fa fa-bar-chart-o fa-fw'></i> Laporan Penjualan
                            
                        </div>
                                <div class='panel-body'>
				 <div class='table-responsive'>";
				 
				 include"mod_laporan/laporan.php";
				 
				 echo"
					</div>
    </div>
   </div>
 </div></div>"; 
}

?>
