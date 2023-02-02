<?php
	
	session_start();
	
	include("config.php");

	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		        echo 'teste1';
		// username and password sent from Form
		$username=mysqli_real_escape_string($conn,$_POST['username']);
		$password=mysqli_real_escape_string($conn,$_POST['password']);
		$password=$password; // Encrypted Password
		$sql="SELECT id FROM admin WHERE username='$username' and pass='$password'";
		$result2=mysqli_query($conn,$sql);
		$count=mysqli_num_rows($result2);
    if($count==1)
    {
        echo 'teste2';
		$_SESSION['username'] = $username;
        $_SESSION['password'] = md5($password);
        $_SESSION['admin'] = true;
        header("location: atuadores.php");
    }
    else
    {
      $sql1="SELECT id FROM utilizadores WHERE username='$username' and pass='$password'";
      $result3=mysqli_query($conn,$sql1);
      $count1=mysqli_num_rows($result3);
       if($count1==1)
       {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['admin'] = false;
        header("location: atuadores.php");
       }
       else
       {
        $sql1="SELECT id FROM guardas WHERE username='$username' and pass='$password'";
		$result3=mysqli_query($conn,$sql1);
		$count1=mysqli_num_rows($result3);
		if($count1==1)
		{
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['guarda'] = false;
			header("location: atuadores.php");
       }
       else
       {
        $error="<font color='red'>Login não encontrado!</font>";
        unset ($_SESSION['username']);
        unset ($_SESSION['password']);
       }
       }
    }
    
    
}
	
?>

<!DOCTYPE HTML>
<html lang="pt">

<head>
	
	<title>Login</title>
	<meta charset="UTF-8">
	
	<link rel="stylesheet" type="text/css" href="loginStyle.css">
	<!--<link rel="stylesheet" type="text/css" href="loginStyle.css">-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	

</head>

<body style = "background-color: lightblue;">
		<form method = "POST" action = "index.php" class = "login_form">
				<a href="index.php" >
					<img src="imagens/logoWB_IPL.png"  alt="logo ESTG" width = "350" height = "200" style = "text-align:center; display:block;">
				</a>
			<div class="mb-3">
				<label for="usr" class="form-label">Username:</label>
				<input type="text" class="form-control" name = "username" id="usr" placeholder = "Escreva o username" required>
			</div>
			<div class="mb-3">
				<label for="pwd" class="form-label">Password:</label>
				<input type="password" class="form-control" name = "password" id="pwd" placeholder = "Escreva a password" required>
			</div>
			<button type="submit" class="btn btn-primary">Submeter</button>
		</form>
	
</body>