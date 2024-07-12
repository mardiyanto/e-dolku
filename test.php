
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Daftar Member Baru Indra Toys</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="blurBg-false" style="background-color:#EBEBEB">

<link rel="stylesheet" href="loginmember/registrasi_files/formoid1/formoid-metro-cyan.css" type="text/css" />
<script type="text/javascript" src="loginmember/registrasi_files/formoid1/jquery.min.js"></script>

<!-- Start Formoid form-->

<form class="formoid-metro-cyan" style="background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#000000;max-width:100%;min-width:150px" method="post" action="?aksi=registrasi&id_p=<?=$_GET[id_p]?>">
<br>

	<div class="element-name"><label class="title">Nama<span class="required">*</span></label><span class="nameFirst">
<input  type="text" size="8" name="nama1" value='<?=$_POST[nama1]?>' onKeyUp="this.value=this.value.replace(/[^A-Z | a-z]/g,'')" required="required"/><label class="subtitle">Nama Depan</label></span><span class="nameLast">
<input  type="text" size="14" name="nama2" value='<?=$_POST[nama2]?>' required="required"/><label class="subtitle">Nama Belakang</label></span></div>
	<div class="element-email"><label class="title">Email<span class="required">*</span></label>
	<input class="large" type="email" name="email" value="<?=$_POST[email]?>" required="required"/></div>
	<div class="element-password"><label class="title">Password<span class="required">*</span></label><input class="large" type="password" name="password" value="" required="required"/></div>
	<div class="element-password"><label class="title">Ulangi Password<span class="required">*</span></label><input class="large" type="password" name="password1" value="" required="required"/></div>
<div class="submitj"><input type="submit" value="Registrasi"/></div><br>
</form>

<script type="text/javascript" src="loginmember/registrasi_files/formoid1/formoid-metro-cyan.js"></script>
<!-- Stop Formoid form-->



</body>
</html>
