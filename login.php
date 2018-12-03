<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <title>Login </title>
  <link rel="stylesheet" type="text/css" href="LOGINSTYLE.css">

  </head>
<body>
 <div >
  
	 
   <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
	<div class="login">
	<h1>Login</h1>
    <form method="post">
    	<input type="text" name="username" placeholder="Username" />
        <input type="password" name="password" placeholder="Password" />
       <br>   
	 <!-- <button type="submit" class="btn btn-primary btn-block btn-large" name="login_user">Let me shop.</button> -->
	   <br>
	  
	   <button type="submit" class="btn btn-primary btn-block btn-large" name="login_user" onclick="window.location.href='cos.php'">Let me shop</button>

<form>
<br>
<input type="button" class="btn btn-primary btn-block btn-large" value="Sign up" onclick="window.location.href='register.php'" />
<br>
<button type="submit" class="btn btn-primary btn-block btn-large" name="logout_user" onclick="window.location.href='sapt9.php'">Log Out</button>

</form>
  </form>
	
	</form>
</div>
  	

</body>
</html>