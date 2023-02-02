
<?php

//obter valores associados à bandeira
$valor_bandeira = file_get_contents("api/files/bandeira/valor.txt");
$hora_bandeira = file_get_contents("api/files/bandeira/hora.txt");
$nome_bandeira = file_get_contents("api/files/bandeira/nome.txt");
$estado_bandeira = file_get_contents("api/files/bandeira/estado.txt");

//obter valores associados ao chuveiro
$valor_chuveiro = file_get_contents("api/files/chuveiro/valor.txt");
$hora_chuveiro = file_get_contents("api/files/chuveiro/hora.txt");
$nome_chuveiro = file_get_contents("api/files/chuveiro/nome.txt");
$estado_chuveiro = file_get_contents("api/files/chuveiro/estado.txt");

//obter valores associados ao speaker
$valor_speaker = file_get_contents("api/files/speaker/valor.txt");
$hora_speaker = file_get_contents("api/files/speaker/hora.txt");
$nome_speaker = file_get_contents("api/files/speaker/nome.txt");
$estado_speaker = file_get_contents("api/files/speaker/estado.txt");

//obter valores associados à porta
$valor_porta = file_get_contents("api/files/porta/valor.txt");
$hora_porta = file_get_contents("api/files/porta/hora.txt");
$nome_porta = file_get_contents("api/files/porta/nome.txt");

//obter valores associados à porta
$valor_estadoPorta = file_get_contents("api/files/estadoPorta/valor.txt");
$hora_estadoPorta = file_get_contents("api/files/estadoPorta/hora.txt");
$nome_estadoPorta = file_get_contents("api/files/estadoPorta/nome.txt");

//obter valores associados aos sensores do LCD da WC Masculino
$valor_lcdM = file_get_contents("api/files/lcdM/valor.txt"); 
$hora_lcdM = file_get_contents("api/files/lcdM/hora.txt");
$nome_lcdM = file_get_contents("api/files/lcdM/nome.txt");

//obter valores associados aos sensores do LCD da WC Feminino
$valor_lcdF = file_get_contents("api/files/lcdF/valor.txt"); 
$hora_lcdF = file_get_contents("api/files/lcdF/hora.txt");
$nome_lcdF = file_get_contents("api/files/lcdF/nome.txt");

//obter valores associados à webcam
$valor_webcam = file_get_contents("api/files/webcam/valor.txt");
$hora_webcam = file_get_contents("api/files/webcam/hora.txt");
$nome_webcam = file_get_contents("api/files/webcam/nome.txt");


?>

<?php

	session_start();
	

	if(!isset($_SESSION['username']))
	{
		header("url=login.php");
		die( "Acesso restrito!");
	}
	
	$username = $_SESSION['username'];
	
	
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if(isset($_POST['bandeira']))
		{
			date_default_timezone_set('Europe/Lisbon');
			$date = date("Y-m-d H:i:s");
			
			file_put_contents("api/files/bandeira/valor.txt", $_POST['bandeira']);
			file_put_contents("api/files/bandeira/hora.txt", $date);
			file_put_contents("api/files/bandeira/log.txt", $date.";".$_POST['bandeira'].";".PHP_EOL, FILE_APPEND);
			header("Refresh:0");
			
		}
		
		if(isset($_POST['webcam']))
		{
			file_put_contents("api/files/webcam/valor.txt", 1);
		}
	}
	
	
	
	$bandeira = file_get_contents("api/files/bandeira/valor.txt")


?>


<!DOCTYPE html>
<html lang = "pt">
<head>
	<title>Praia Inteligente</title>
	<meta charset="utf-8">
	
	<meta http-equiv="refresh" content="3" >
	
		<link rel="stylesheet" type="text/css" href="sensoresStyle.css">

	
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
	<a class ="text-white" style = "text-decoration: none">Bem vindo, <?php echo $username?>&nbsp;</a>
	<a href="logout.php" class="btn btn-light btn-lg" tabindex="-1" role="button">Logout</a>
  </div>
</nav>
<!--Fim Navbar-->


<div class = "content" style = "padding-top: 10px">
	<div class = "container">
		<!--INFO ATUADORES-->
		<div class = "container">
			<div class="card bg-dark text-white">
				<div class = "card-header" style = "text-align: center">
					<p><b>Atuadores</b></p>
				</div>
				<div class = "card-body">
						
							<div class = "container">
							
								<!-- Primeira linha da tabela -->
								<div class = "row">
									
									<!-- Bandeira -->
									<div class="col-sm-4">
										<div class = "card text-black">
											<div class = "card text-center"> 
												<div class = "card-header" >
													<p class = "text-center" ><b><?php echo $nome_bandeira.": ". $valor_bandeira?></b></p>
												</div>
												<div class = "card-body">
													<?php
														if ($username == "guarda")
														{
															echo'<form method="post">';
															
																if ($valor_bandeira == "verde")
																{
																	echo '<input type="hidden" name="bandeira" value="amarela">';
																	echo '<input type="image" height = "100" width = "100" src="imagens/green_flag.png" alt="Submit">';
																}
																else if($valor_bandeira == "amarela")
																{
																	echo '<input type="hidden" name="bandeira" value="vermelha">';
																	echo '<input type="image" height = "100" width = "100" src="imagens/yellow_flag.png" alt="Submit">';
																}
																else
																{
																	echo '<input type="hidden" name="bandeira" value="verde">';
																	echo '<input type="image" height = "100" width = "100" src="imagens/red_flag.png" alt="Submit">';
																}
															
															echo'</form>';
														}
														else
														{
															if ($valor_bandeira == "verde")
																{
																	echo'<img src = "imagens/green_flag.png" alt = "chuveiro" height = "100" width = "100">';
																}
																else if($valor_bandeira == "amarela")
																{
																	echo'<img src = "imagens/yellow_flag.png" alt = "chuveiro" height = "100" width = "100">';
																}
																else
																{
																	echo'<img src = "imagens/red_flag.png" alt = "chuveiro" height = "100" width = "100">';
																}
														}
													?>
												</div>
												
											
												<div class = "card-footer">
													<p class = "text-center"><b>Atualização</b>: <?php echo $hora_bandeira?> <a style="text-decoration: none" class="link-primary" href="./historico.php?nome=<?php echo $nome_bandeira?>"> Histórico </a></p>
												</div>
											</div>
										</div>
									</div>
									
									<!-- Chuveiro -->
									<div class="col-sm-4">
										<div class = "card text-black">
											<div class = "card text-center"> 
												<div class = "card-header" >
													<p class = "text-center" ><b><?php echo $nome_chuveiro.": ". $valor_chuveiro?></b></p>
												</div>
												<div class = "card-body">
													<img src = "imagens/chuveiro.png" alt = "Chuveiro" height = "100" width = "100">
												</div>
												<div class = "card-footer">
													<p class = "text-center"><b>Atualização</b>: <?php echo $hora_chuveiro?> <a style="text-decoration: none" class="link-primary" href="./historico.php?nome=<?php echo $nome_chuveiro?>"> Histórico </a></p>
												</div>
											</div>
										</div>
									</div>
									
									<!-- Speaker -->
									<div class="col-sm-4">
										<div class = "card text-black">
											<div class = "card text-center"> 
												<div class = "card-header" >
													<p class = "text-center" ><b><?php echo $nome_speaker.": ". $valor_speaker?></b></p>
												</div>
												<div class = "card-body">
													<img src = "imagens/tsunami.png" alt = "Speaker" height = "100" width = "100">
												</div>
												<div class = "card-footer">
													<p class = "text-center"><b>Atualização</b>: <?php echo $hora_speaker?> <a style="text-decoration: none" class="link-primary" href="./historico.php?nome=<?php echo $nome_speaker?>"> Histórico </a></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						<!-- Segunda linha da tabela -->
						<div class = "container" style = "padding-top: 10px">	
							<div class = "row">
									
									<!-- Porta -->
									<div class="col-sm-4">
										<div class = "card text-black">
											<?php
											if($valor_porta == 'Trancada')
											{
												echo '<div class="card text-center">
													<div class="card-header">
														<p class = "text-center"><b>'.$nome_porta.': '.$valor_porta.' -- '.$valor_estadoPorta.'</b></p>
													</div>
													<div class="card-body">
														<img src="imagens/closed_door.png" class="float-middle" alt="porta" width = "100px" height = "100px">
													</div>
													<div class="card-footer">
														<p class="text-center"><b>Atualização:</b> '. $hora_porta.' - <a style="text-decoration: none" href="./historico.php?nome='.$nome_porta.'" >Histórico </a></p>
													</div>
												</div>';
											}
											else if ($valor_porta == 'Destrancada')
											{
												if($valor_estadoPorta == 'Fechada')
												{
													echo '<div class="card text-center">
													<div class="card-header">
														<p class = "text-center"><b>'.$nome_porta.': '.$valor_porta.' -- '.$valor_estadoPorta.'</b></p>
													</div>
													<div class="card-body">
														<img src="imagens/closed_door.png" class="float-middle" alt="porta" width = "100px" height = "100px">
													</div>
													<div class="card-footer">
														<p class="text-center"><b>Atualização:</b> '. $hora_porta.' - <a style="text-decoration: none" href="./historico.php?nome='.$nome_porta.'" >Histórico </a></p>
													</div>
												</div>';
												}
												else
												{
													echo '<div class="card text-center">
													<div class="card-header">
														<p class = "text-center"><b>'. $nome_porta.': '.$valor_porta.' -- '.$valor_estadoPorta.'</b></p>
													</div>
													<div class="card-body">
														<img src="imagens/open_door.png" class="float-middle" alt="porta" width = "100px" height = "100px">
													</div>
													<div class="card-footer">
														<p class="text-center"><b>Atualização:</b> '.$hora_porta.' - <a style="text-decoration: none" href="./historico.php?nome='.$nome_porta.'" >Histórico </a></p>
													</div>
												</div>';
												}
											}
											?>
										</div>
									</div>
									
									<!-- LCD's -->
									<div class="col-sm-4">
										<div class = "card text-black">
											<?php
											if($valor_lcdF == 'Livre' && $valor_lcdM == 'Livre')
											{
												echo '<div class="card text-center">
													<div class="card-header">
														<p class = "text-center"><b>'.$nome_lcdF.'Fem.  ||  '.$nome_lcdM.'Masc. </b></p>
													</div>
													<div class="card-body">
														<img src="imagens/livre_livre.png" class="float-middle" alt="porta" width = "100px" height = "100px">
													</div>
													<div class="card-footer">
														<p class="text-center"><b>Atualização:</b> '. $hora_lcdF.' - <a style="text-decoration: none" href="./historico.php?nome='.$nome_lcdF.'" >Histórico </a></p>
													</div>
												</div>';
											}
											else if($valor_lcdF == 'Livre' && $valor_lcdM == 'Ocupado')
											{
												echo '<div class="card text-center">
													<div class="card-header">
														<p class = "text-center"><b>'.$nome_lcdF.'Fem.  ||  '.$nome_lcdM.'Masc. </b></p>
													</div>
													<div class="card-body">
														<img src="imagens/livre-ocupado.png" class="float-middle" alt="porta" width = "100px" height = "100px">
													</div>
													<div class="card-footer">
														<p class="text-center"><b>Atualização:</b> '. $hora_lcdF.' - <a style="text-decoration: none" href="./historico.php?nome='.$nome_lcdF.'" >Histórico </a></p>
													</div>
												</div>';
											}
											else if($valor_lcdF == 'Ocupado' && $valor_lcdM == 'Ocupado')
											{
												echo '<div class="card text-center">
													<div class="card-header">
														<p class = "text-center"><b>'.$nome_lcdF.'Fem.  ||  '.$nome_lcdM.'Masc. </b></p>
													</div>
													<div class="card-body">
														<img src="imagens/ocupado-ocupado.png" class="float-middle" alt="porta" width = "100px" height = "100px">
													</div>
													<div class="card-footer">
														<p class="text-center"><b>Atualização:</b> '. $hora_lcdF.' - <a style="text-decoration: none" href="./historico.php?nome='.$nome_lcdF.'" >Histórico </a></p>
													</div>
												</div>';
											}
											else
											{
												echo '<div class="card text-center">
													<div class="card-header">
														<p class = "text-center"><b>'.$nome_lcdF.'Fem.  ||  '.$nome_lcdM.'Masc. </b></p>
													</div>
													<div class="card-body">
														<img src="imagens/ocupado-livre.png" class="float-middle" alt="porta" width = "100px" height = "100px">
													</div>
													<div class="card-footer">
														<p class="text-center"><b>Atualização:</b> '. $hora_lcdF.' - <a style="text-decoration: none" href="./historico.php?nome='.$nome_lcdF.'" >Histórico </a></p>
													</div>
												</div>';
											}
											?>
										</div>
									</div>
									
									
									<!-- Webcam -->
									<?php
										$dataMod = date ("F d Y H:i:s.", filemtime("imagens/webcam.jpg"));
									?>
									<div class="col-sm-4">
										<div class = "card text-black">
											<div class="card text-center">
												<!--Criacção de um elemento card onde é apresentada a foto da webcam e as infromações de atualização-->
												<div class="card-header">
													<b><?php echo $nome_webcam?></b>
													<?php
														echo'<form method="post">';
														
															echo '<input type="submit" name="webcam" value="Shot">';
															
															
														
														echo'</form>';
													?>
												</div>
												<div class="card-body">
													<?php
														echo "<img src='imagens/webcam.jpg?id=".time()."' style='width:40%'>"
													?>
												</div>
												<div class="card-footer">
													Atualização: <?php echo $hora_webcam ?> 
												</div>
											</div>
										</div>
									</div>
									
									
									
							</div>
					</div>
			</div>
		</div>
		
		<!--TABELA ATUADORES-->
		<div class = "container" style = "padding-top: 10px">
			<div class="card bg-dark text-white">
				<div class = "card-header">
					<p class = "text-center"><b>Tabela de Atuadores</b></p>
				</div>
				<div class = "card-body">
					<table class="table table-dark table-hover">
						<thead>
						<tr>
							<th scope="col">Sensor</th>
							<th scope="col">Valor</th>
							<th scope="col">Data de Atualização</th>
						</tr>
						</thead>
						<tbody>
						<tr>
						<!-- Bandeira -->
							<th scope="row"><?php echo $nome_bandeira?></th>
							<td><?php echo $valor_bandeira?></td>
							<td><?php echo $hora_bandeira?></td>
						</tr>
						
						<tr>
						<!-- Chuveiro -->
							<th scope="row"><?php echo $nome_chuveiro?></th>
							<td><?php echo $valor_chuveiro?></td>
							<td><?php echo $hora_chuveiro?></td>
						</tr>
						
						<tr>
						<!-- Tsunami -->
							<th scope="row"><?php echo $nome_speaker?></th>
							<td><?php echo $valor_speaker?></td>
							<td><?php echo $hora_speaker?></td>
						</tr>
						
						<tr>
						<!-- Nadador Salvador -->
							<th scope="row"><?php echo $nome_porta?></th>
							<td><?php echo $valor_porta?></td>
							<td><?php echo $hora_porta?></td>
						</tr>
						<tr>
						<!-- LCD F -->
							<th scope="row"><?php echo $nome_lcdF.' Feminino';?></th>
							<td><?php echo $valor_lcdF?></td>
							<td><?php echo $hora_lcdF?></td>
						</tr>
						<!-- LCD M -->
							<th scope="row"><?php echo $nome_lcdM.' Masculino';?></th>
							<td><?php echo $valor_lcdM?></td>
							<td><?php echo $hora_lcdM?></td>
						</tr>
						
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</body>