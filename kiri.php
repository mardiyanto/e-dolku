
<script type="text/javascript" src="tab/jquery22.js"></script>


<div class="l_k">

	<div class='keranjangb'>
	<? include"item.php";?>
		
	</div>

<img src="seafood/keranjang.png" />
</div>



        <div class='latest-product '>
              <h2 >Alamat <span>Toko</span></h2>
			 <br />
		<?
             
		   echo"
		    <center>
		 $k_k[alamat]<br /><br />

$k_k[telepon], $k_k[telepon_2]<br /><br />
$k_k[email], $k_k[email_2]<br /><br />

Jam Buka Toko:<br />
$k_k[jam_buka]


		 
		  </center>

		   ";
		
		?>
			 
			  </div>		
	          <div class="latest-product ">
              <h2>Kategori <span>Produk</span></h2>
			  
              <ul class="info">
			  <?php
			  
            $kategori=mysql_query("select nama_kategori, kategori.id_kategori,  
                                  count(produk.id_produk) as jml 
                                  from kategori left join produk 
                                  on produk.id_kategori=kategori.id_kategori 
                                  group by nama_kategori");
          
            while($k=mysql_fetch_array($kategori)){
            echo"
			<li><img src='seafood/banner-desc-marker.png' /><a href='index.php?l=lihat&aksi=kategori&id_k=$k[id_kategori]'> $k[nama_kategori] ($k[jml])</a></li>
			";
			}
			?>
          </ul>
         </div>
	  
	   <div class="latest-product ">
              <h2>Informasi <span></span></h2>
			  
              <ul class="info">
			  <?php
			  
            $kategori=mysql_query("select * from berita order by id_berita desc limit 6");
          
            while($k=mysql_fetch_array($kategori)){
            echo"
			<li><a href='index.php?l=lihat&aksi=detail_b&id_b=$k[id_berita]&nama=$k[judul]'> $k[judul]</a></li>
			";
			}
			?>
          </ul>
         </div>
		 
		 
 
	<br />

 <div class='latest-product'>
          
 <h2>Testimonial</span></h2>
<div style="width: 225px; max-height: 300px; overflow: auto; padding:5px; ">
<? 
 $getComments = mysql_query("SELECT * FROM komentar WHERE id_prod=0 AND jwb='0' ORDER BY id_komen DESC");
    if(mysql_num_rows($getComments) > 0){
        while($comments=mysql_fetch_array($getComments)){
		$komen=wordwrap($comments[komentar], 39, "<br />\n", 1);
            echo "
		
<div class='jr'>
	
		<div class='komenbox'>
		<div class='nk'>$comments[nama]</div>
<div class='tgl2'>Pada $comments[tgl] | $comments[jam] Mengatakan....</div>	<br />

		$komen<br />
		<div class='kn'><a href='
		index.php?l=lihat&aksi=testi&bls=balas&id_km=$comments[id_komen]'>Balas Komentar</a></div>
		<div class='clear'></div>
        </div></div>";
            
            $getReplies = mysql_query("SELECT * FROM komentar WHERE  id_prod=0 AND jwb='1' AND balas='$comments[id_komen]' ORDER BY id_komen ASC");
            if(mysql_num_rows($getReplies) > 0){
                while($replies = mysql_fetch_array($getReplies)){
				$komen2=wordwrap($replies[komentar],28, "<br />\n", 1);
				if($replies[admin]=='Y'){
				echo"
	<div class='jk'>
	
		<div class='komenbox3'>
		<div class='nad'>$replies[nama]</div>
<em class='tgl2'>Pada $replies[tgl] | $replies[jam] Mengatakan....</em>	
		<em>Membalas Komentar <strong>@$replies[nm_bls]</strong></em><br />
		$komen2<br />
		<div class='kn'><a href='index.php?l=lihat&aksi=testi&bls=balas&id_km=$replies[id_komen]'>Balas Komentar</a></div>
		<div class='clear'></div>
        </div></div>
				
				
				";
				}else{
                    
					echo "
					
					<div class='jk'>
		<div class='komenbox2'>
		<div class='nk'>$replies[nama]</div>
<em class='tgl2'>Pada $replies[tgl] | $replies[jam]</em>		

		<em>Membalas Komentar <strong>@$replies[nm_bls]</strong></em><br />
		$komen2<br />
		<div class='kn'><a href='index.php?l=lihat&aksi=testi&bls=balas&id_km=$replies[id_komen]'>Balas Komentar</a></div>
		<div class='clear'></div>
        </div></div>";
					}
                }
            }
        }
echo" <br />";		
}
 
 ?>


</div> <!-- #container -->

			  </div>
         
	        <div class='latest-product '>
              <h2 >Bank <span>Pengiriman</span></h2>
			 <br />
		<?
             $query=mysql_query("select * from bank  ");

           while($z=mysql_fetch_array($query)){
		   echo"
		   <center>
		   <img src='foto/foto_bank/$z[gb]'  width='90%' />
		  A/N $z[at_nama]<br />
$z[no_rek]<br />
$z[alm_bank]
		   </center><br />

		   ";
		}
		?>
			 
			  </div>		
       			  
	
			
			
        <div class='latest-product '>
              <h2 >Pengunjung</h2>
			 <br />
		
      
		
			 
			  </div>
      
	 	
			<!--
			  
			 
			          <div class='latest-product f-des'>
         <h2>Best Selling</h2>
<div class='plugin'>             
              <div id='fb-root'></div>
              <div class='fb-like-box' data-href='http://www.facebook.com/webgranth' data-width='289' data-show-faces='true' data-stream='false' data-header='true'></div>
</div>            </div>
-->