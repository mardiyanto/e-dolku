<div class='card'>
  <div class='card-header'>

  </div>  
 <div class='card-body'>
  <form class="form-container" method="post" action="log.php?aksi=login&cek=<?=$_GET[cek]?>">

<div class="form-title"><h2>Login Akun</h2></div>
<div class="form-title">Email</div>
<input class="form-field" type='email'name='email'  required="required" placeholder='Masukan Email' /><br />

<div class="form-title">Password</div>
	<input type='password' class="form-field" name='password' placeholder='Masukan Password' required>
<br />
<div class="submit-container">
<input class="submit-button" type="submit" value="LOGIN" />
</div>
</form><br />

   <form class="form-container" method="post" action="log.php?aksi=daftarmember&cek=<?=$_GET[cek]?>">
<div class="form-title"><h2>Daftar Akun Baru</h2></div>

<div class="form-title">Nama Lengkap</div>
<input name="nama"  placeholder="Nama Lengkap" type="text"  required  class="form-field" onKeyUp="this.value=this.value.replace(/[^A-Z | a-z]/g,'')"><br />

<div class="form-title">Alamat Email</div>
	 <input type="email" name="email" placeholder="Email Anda" class="form-field" required>
<br />

<div class="form-title">Password Akun</div>
 <input name="password"  placeholder="Password" type="password" class="form-field" required >
<br />

<div class="form-title">Ulangi Password</div>
 <input name="password1" placeholder="Ulangi Password" class="form-field"  type="password" required>
<br />

<div class="submit-container">
<input class="submit-button" type="submit" value="DAFTAR AKUN" />
</div>
</form> 

  <div class="no_login">
Lakukan Pembayaran Tamu ??
<a href='index.php?l=lihat&aksi=pembayaran_tamu'>KLIK DISINI</a>
</div>
	</div>	</div>




