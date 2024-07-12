<form method=post action=aksi.php?module=keranjang&act=update>  
<div class='keranjang'>
<table width="100%" class='table' border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="11%">No.Order</th>
	<th width="19%">Tanggal Order </th>
	<th width="17%">Jam Order </th>
	<th width="47%">Status</th>
	<th width="47%">Konfirmasi Pembayaran</th>
	<th width="6%">&nbsp;</th>
	<th width="6%">&nbsp;</th>
	</tr>
	<?
$tebaru=mysql_query(" SELECT * FROM orders WHERE id_kustomer=$_SESSION[kustomer] ORDER BY id_orders DESC ");
while ($t=mysql_fetch_array($tebaru)){
	?>
  <tr>
    <td><?=$t[id_orders]?></td>
    <td><?=$t[tgl_order]?></td>
    <td><?=$t[jam_order]?></td>
    <td><? if($t[status_order]=='Baru'){echo"<span style=\"color:#FF0000;\">Menunggu Pembayaran</span>";
	}else{echo"Lunas";}
	
	?></td>
   <td><? $konfirmasi=mysql_query(" SELECT * FROM konfirmasi WHERE id_order_p=$t[id_orders]");
$kn=mysql_fetch_array($konfirmasi);					
					if($kn[status]=='Baru'){
					?>
					
					<button class='btn btn-warning' type='button' value=''>Menunggu</button>		
					
					<? 	} 
					elseif($kn[status]=='Berhasil'){
					?>
					
					<button class='btn btn-success' type='button' value=''>Berhasil</button>		
					
					<? 	} else{?>
					<a href='index.php?l=lihat&aksi=konfirmasi&id=<?=$t[id_orders]?>' ><button class='btn btn-primary' type='button' value=''>Konfirmasi</button>		</a>
					
					<? }?></td>
	 <td class="detail"><a href="index.php?l=lihat&aksi=detailorder&id=<?=$t[id_orders]?>" >Detail</a></td>
    </tr>
	<? }?>
</table>


</div>