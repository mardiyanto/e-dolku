<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login Form</title>
        <link rel="stylesheet" href="../bootstrap4/bootstrap.min.css">
   <script src="../bootstrap4/js/jquery-3.3.1.slim.min.js" ></script>
<script src="../bootstrap4/js/popper.min.js"></script>
<script src="../bootstrap4/js/bootstrap.min.js"></script>
  </head>

  <body>
<div class="card">
  <div class="card-header">Login</div>
  <div class="card-body">
    <form class="login-form" action="log-member.php" method="post">
      <input class="form-control mr-sm-2" type="text" placeholder="username"  name="user"  autofocus /></br>
      <input class="form-control mr-sm-2" type="password" placeholder="password" name="pass" />
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">login</button>

	  <? if($_GET[salah]=='salah')
		{echo"LOGIN GAGAL";}
		else{echo"";} ?><p>
					<? if($_GET[salah]=='salah')
		{echo"					
                                Username dan Password Tidak Cocok.</p>
Mohon Ulangi
                            ";}
		else{echo"";} ?>
      
    </form>
  </div>
</div>
  </body>
</html>


