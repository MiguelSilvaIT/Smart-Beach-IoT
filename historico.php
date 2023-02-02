<?php

	session_start();
	

	if(!isset($_SESSION['username']))
	{
		header("url=index.php");
		die( "Acesso restrito!");
	}
	
	$username = $_SESSION['username'];
	$nome = "temperatura";
	
	if(isset($_POST['nome']))
	{
		$nome = $_POST['nome'];
		//echo $nome;
	}
	
	if(isset($_GET['nome'])) //recebe valores da dashboard para a filtragem do histórico
	{
		$nome = $_GET['nome'];
		if($nome == "Temp. Agua")
		{
			$nome = "agua"; 
		}
	}

?>


<!DOCTYPE html>
<html lang = "pt">
<head>
	<title>Histórico</title>
	<meta charset="utf-8">
	
	<!--<meta http-equiv="refresh" content="5">-->
	
		<link rel="stylesheet" type="text/css" href="historicoStyle.css">

	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body style = "background-color: #577F91">

	<!--Navbar-->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="sensores.php">
			<img src="imagens/logoTI.png" alt="" width="60" height="48" class="d-inline-block align-text-top">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
		  <ul class="navbar-nav">
			<li class="nav-item">
			  <a class="nav-link active" aria-current="page" href="sensores.php">Sensores</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link active" aria-current="page" href="atuadores.php">Atuadores</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="historico.php">Histórico</a>
			</li>
		  </ul>
		</div>
		<a class="text-white" style = "text-decoration: none">Bem vindo, <?php echo $username?> &nbsp;</a>
		<a href="logout.php" class="btn btn-light btn-lg" tabindex="-1" role="button" >Logout</a>
	  </div>
	</nav>
	<!--Fim Navbar-->

	<!--Select Dropdown Box-->
	<?php
	if($username == "admin")
	{
		echo '
			<div class = "form-center">
				<form action="historico.php" method = "POST" style = "text-align:center;">	
					<div class="dropdown-elementos" style = "text-align:center;">
						<label for="inputState">Sensor/Atuador</label>
						<select id="inputState" name = "nome" class="form-control text center" style = "background-color: black; color: white; text-align: center;">
							<option selected>Temperatura</option>
							<option>Agua</option>
							<option>Vento</option>
							<option>wcF</option>
							<option>wcM</option>
							<option>UV</option>
							<option>Chuveiro_Sensor</option>
							<option>RFID</option>
							<option>Nivel</option>
							<option>Ondas</option>
							<option>Bandeira</option>
							<option>Chuveiro</option>
							<option>Speaker</option>
							<option>Porta</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary">Submeter</button>
				</form>
			</div>
				'
				;
	}
	else
	{
		echo '
				<div class="form-center">
					<form action="historico.php" method = "POST style = "text-align:center;">	
					<div class="dropdown-elementos" style = "text-align:center;">
						<label for="inputState">Sensor/Atuador</label>
						<select id="inputState" name = "nome" class="form-control text center" style = "background-color: black; color: white; text-align: center;">
							<option selected>Temperatura</option>
							<option>Agua</option>
							<option>Vento</option>
							<option>UV</option>
							<option>Chuveiro_Sensor</option>
							<option>RFID</option>
							<option>Nivel</option>
							<option>Ondas</option>
							<option>Bandeira</option>
							<option>Chuveiro</option>
							<option>Speaker</option>
							<option>Porta</option>
						</select>
					</div>
				
					<button type="submit" class="btn btn-primary">Submeter</button>
					</form>
				</div>';
		
	}
	?>
	<!--FIM-Select Dropdown Box-->



	<div class="container" style = "justify-content: center; padding-top: 10px;">
		<table class = "table table-dark table-hover" style = "align-items: center">
			<thead>
				<tr>
					<th scope="col">Data de registo</th>
					<th scope="col">Valor: <?php echo $nome ?></th> 
				</tr>
			</thead>
			<?php
			//$total_linhas = mysqli_num_rows($result);
			
			$filePath = "api/files/".$nome."/log.txt";
			$nLinhas = count(file($filePath));
			
			
			/*for($i = 1; $i <= $nLinhas; $i++)
			{
				
			}*/
			
			$file = "api/files/".$nome."/log.txt";


				$texto = file_get_contents($file);
				#print_r($texto); --> linhas para testes
				
				$linhas_ind = explode(";", $texto);
				
				#print_r($linhas_ind);  --> linhas para testes
				



			if ($nLinhas>0) 
			{
				$i = 0;
				while($i < count($linhas_ind))
				{
					echo "<tr>";
					
					echo "<td>".$linhas_ind[$i]."</td>";
					if($i != (count($linhas_ind)-1))
					{
						$i++;
					}
					echo "<td>".$linhas_ind[$i]."</td>";
					
						$i++;
					
				}
			}
			?>

		</table>
	</div>
</body>