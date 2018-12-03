<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login & Registration</title>
  <link rel="stylesheet" type="text/css" href="LOGINSTYLE.css">
</head>
<body>


	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
	<div class="login">
	<h1>Register</h1>
	 <form method="post">
  	<input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
    <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
  	<input type="password" placeholder="Password" name="password_1">
    <input type="password" placeholder="Confirm password" name="password_2"><br>
  	</form>
	
	<button type="submit" class="btn btn-primary btn-block btn-large" name="reg_user">Register</button>
	<form>
	<br>	
    <input type="button" class="btn btn-primary btn-block btn-large" value="Already a member? Sign in!" onclick="window.location.href='login.php'" />
    </form>
	<br>
  	<button type="submit" class="btn btn-primary btn-block btn-large" name="reg_exit">Home</button>
  	  </form>
  </div>
</body>
</html>