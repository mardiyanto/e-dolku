 <? 
 $kostume  = mysql_query("SELECT * FROM  kustomer WHERE  kustomer.id_kustomer=$_SESSION[kustomer] ");
    
    $rkt    = mysql_fetch_array($kostume);?>
<link rel="stylesheet" href="loginmember/registrasi_files/formoid1/formoid-metro-cyan.css" type="text/css" />

<div class='bok2 bok4'>
<form name='NamaForm' class="formoid-metro-cyan" style="background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#000000;" 
method="post" action="log.php?aksi=edit_akun">
	<div class="title"><h2 style="color:#000000">Silahkan Edit Akun Anda Disini</div>
	
	<div class="element-address">

<span class="addr2">
<span class="city">
<label class="">Nama Lengkap</label>
<input name="nama"  placeholder="Nama Lengkap" value="<?=$rkt[nama_lengkap]?>" type="text"  required  onKeyUp="this.value=this.value.replace(/[^A-Z | a-z]/g,'')">
<label class="subtitle">&nbsp;</label></span><span class="state">

<label class="">Alamat Email</label>
 <input type="email" name="email" value="<?=$rkt[email]?>" placeholder="Email Anda" required>
<label class="subtitle">&nbsp;</label></span><span class="zip">

<label class="">Telpone</label>
 <input  type="text" name="HP" value="<?=$rkt[telpon]?>" placeholder="No hp" onKeyUp="this.value=this.value.replace(/[^0-9]/g,'')"  maxlength="12" required>
<label class="subtitle">&nbsp;</label></span><span class="zip">

<label class="">Password</label>
 <input name="password"  placeholder="Password" type="password" required >
<label class="subtitle">&nbsp;</label></span><span class="state">

<label class="">Ulangi Password</label>
 <input name="password1" placeholder="Ulangi Password" type="password" required>
<label class="subtitle">&nbsp;</label></span><span class="zip">

</div>



		<div class="element-email">
	 <input type="submit" value="Simpan" />
	</div><br />



</form>
</div>
