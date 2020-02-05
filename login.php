<?php
include("inc/db.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
    <title>Signin</title>

    <!-- Custom styles for this template -->
	<link type="text/css" rel="stylesheet" href="signin.css">
  </head>
  <body class="text-center">
    <form action ="" method="post" class="form-signin">
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  
  <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
  
  <input type="password" name="password" class="form-control" placeholder="Password" required>
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit" style="width: 100px;margin-left: 100px;">Sign in</button>
  <p>Don't have an account? <a href="/register.php"> Make one here</a></p>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>
</body>
</html>
<?php

if(isset($_POST['submit'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$stmt = $mysqli->prepare("SELECT * from users WHERE email = ?");
	$stmt->bind_param("s", $email);
	if(!$stmt->execute())
		die($stmt->error);
	$stmt->store_result();
	
	if($stmt->num_rows <= 0)
		$message = "Login failed";
	else{
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		
		$password_db = $row['password'];
		if(password_verify($password, $password_db))
			$message = "Login sucessful!";
		else
			$message = "Login failed";
	}
	echo "<script>alert('$message');</script>";
}

?>