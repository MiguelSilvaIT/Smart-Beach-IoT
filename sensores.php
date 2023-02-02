
<?php

//obter valores associados aos sensores da temperatura
$valor_temperatura = number_format(file_get_contents("api/files/temperatura/valor.txt"), 2);
$hora_temperatura = file_get_contents("api/files/temperatura/hora.txt");
$nome_temperatura = file_get_contents("api/files/temperatura/nome.txt");
$estado_temperatura = file_get_contents("api/files/temperatura/estado.txt");

//obter valores associados aos sensores da radiação UV
$valor_uv = file_get_contents("api/files/uv/valor.txt");
$hora_uv = file_get_contents("api/files/uv/hora.txt");
$nome_uv = file_get_contents("api/files/uv/nome.txt");
$estado_uv = file_get_contents("api/files/uv/estado.txt");

//obter valores associados aos sensores do vento
$valor_vento = number_format(file_get_contents("api/files/vento/valor.txt"), 2);
$hora_vento = file_get_contents("api/files/vento/hora.txt");
$nome_vento = file_get_contents("api/files/vento/nome.txt");

//obter valores associados aos sensores do WC Masculino
$valor_wcM = file_get_contents("api/files/wcM/valor.txt"); 
$hora_wcM = file_get_contents("api/files/wcM/hora.txt");
$nome_wcM = file_get_contents("api/files/wcM/nome.txt");

//obter valores associados aos sensores do WC Feminino
$valor_wcF = file_get_contents("api/files/wcF/valor.txt"); 
$hora_wcF = file_get_contents("api/files/wcF/hora.txt");
$nome_wcF = file_get_contents("api/files/wcF/nome.txt");

//obter valores associados à agua
$valor_agua = number_format(file_get_contents("api/files/agua/valor.txt"), 2);
$hora_agua = file_get_contents("api/files/agua/hora.txt");
$nome_agua = file_get_contents("api/files/agua/nome.txt");

//obter valores associados ao chuveiro
$valor_chuveiro_sensor = file_get_contents("api/files/chuveiro_sensor/valor.txt");
$hora_chuveiro_sensor = file_get_contents("api/files/chuveiro_sensor/hora.txt");
$nome_chuveiro_sensor = file_get_contents("api/files/chuveiro_sensor/nome.txt");

//obter valores associados ao rfid
$valor_cartoes = file_get_contents("api/files/rfid/valor.txt");
$hora_cartoes = file_get_contents("api/files/rfid/hora.txt");
$nome_cartoes = file_get_contents("api/files/rfid/nome.txt");

//obter valores associados ao nível da água
$valor_nivel = file_get_contents("api/files/nivel/valor.txt");
$hora_nivel = file_get_contents("api/files/nivel/hora.txt");
$nome_nivel = file_get_contents("api/files/nivel/nome.txt");

//obter valores associados à altura das ondas
$valor_ondas = file_get_contents("api/files/ondas/valor.txt");
$hora_ondas = file_get_contents("api/files/ondas/hora.txt");
$nome_ondas = file_get_contents("api/files/ondas/nome.txt");




?>

<?php

	session_start();
	

	if(!isset($_SESSION['username']))
	{
		header("url=login.php");
		die( "Acesso restrito!");
	}
	
	$username = $_SESSION['username'];


?>


<!DOCTYPE html>
<html lang = "pt">
<head>
	<title>Praia Inteligente</title>
	<meta charset="utf-8">
	
	<meta http-equiv="refresh" content="3">
	
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
		<!--INFO SENSORES-->
		<div class = "container">
			<div class="card bg-dark text-white">
				<div class = "card-header" style = "text-align: center">
					<p><b>Sensores</b></p>
				</div>
				<div class = "card-body">
						
							<div class = "container">
							
								<!-- Primeira linha da tabela -->
								<div class = "row">
								
									<!-- Temperatura -->
									<div class="col-sm-3">
										<div class = "card text-black">
											<div class = "card text-center"> 
												<div class = "card-header">
													<p class = "text-center"><b><?php echo $nome_temperatura.": ". $valor_temperatura?> ºC</b></p>
												</div>
												<div class = "card-body">
													<img src = "imagens/temperature.png" alt = "Temperatura" height = "100" width = "100">
												</div>
												<div class = "card-footer">
													<p class = "text-center"><b>Atualização</b>: <?php echo $hora_temperatura?> <a style="text-decoration: none" class="link-primary" href="./historico.php?nome=<?php echo $nome_temperatura?>"> Histórico </a></p>
												</div>
											</div>
										</div>
									</div>
									
									<!-- Temperatura da Água -->
									<div class="col-sm-3">
										<div class = "card text-black">
											<div class = "card text-center"> 
												<div class = "card-header">
													<p class = "text-center"><b><?php echo $nome_agua.": ". $valor_agua?> ºC</b></p>
												</div>
												<div class = "card-body">
													<img src = "imagens/water-temperature.png" alt = "Temperatura da agua" height = "100" width = "100">
												</div>
												<div class = "card-footer">
													<p class = "text-center"><b>Atualização</b>: <?php echo $hora_agua?> <a style="text-decoration: none" class="link-primary" href="./historico.php?nome=agua"> Histórico </a></p>
												</div>
											</div>
										</div>
									</div>
									
									<!-- Radiação UV -->
									<div class="col-sm-3">
										<div class = "card text-black">
											<div class = "card text-center"> 
												<div class = "card-header">
													<p class = "text-center"><b><?php echo $nome_uv.": ". $valor_uv?></b></p>
												</div>
												<div class = "card-body">
													<img src = "imagens/uv.png" alt = "Radiação UV" height = "100" width = "100">
												</div>
												<div class = "card-footer">
													<p class = "text-center"><b>Atualização</b>: <?php echo $hora_uv?> <a style="text-decoration: none" class="link-primary" href="./historico.php?nome=<?php echo $nome_uv?>"> Histórico </a></p>
												</div>
											</div>
										</div>
									</div>
									
									<!-- Vento -->
									<div class="col-sm-3">
										<div class = "card text-black">
											<div class = "card text-center"> 
												<div class = "card-header" >
													<p class = "text-center"><b><?php echo $nome_vento.": ". $valor_vento?> km/h</b></p>
												</div>
												<div class = "card-body">
													<img src = "imagens/wind.png" alt = "velocidade do vento" height = "100" width = "100">
												</div>
												<div class = "card-footer">
													<p class = "text-center"><b>Atualização</b>: <?php echo $hora_vento?> <a style="text-decoration: none" class="link-primary" href="./historico.php?nome=<?php echo $nome_vento?>"> Histórico </a></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
					
						
						
						<!-- Segunda linha da tabela -->
						<div class = "container" style = "padding-top: 10px">	
							<div class = "row">
								
									<!-- WC -->
									<div class="col-sm-3">
										<div class = "card text-black">
											<div class = "card text-center"> 
												<div class = "card-header" style="  line-height: 16px;">
													<p class = "text-center"><b><?php echo $nome_wcF?></b></p>
													<p class = "text-center" style = "white-space: nowrap;"><?php echo "<span style='color:#ff33cc;'>".$valor_wcF."</span> | <span style='color:blue;'>".$valor_wcM."</span>" ?> </p>
												</div>
												<div class = "card-body">
													<img src = "imagens/wc.png" alt = "WC" height = "100" width = "100">
												</div>
												<div class = "card-footer">
													<?php
													if($username == "admin")
													{
														echo '<p class = "text-center"><b>Atualização</b>:   '.$hora_wcM.' <a style="text-decoration: none" class="link-primary" href="./historico.php?nome=wcM"> Histórico </a></p>';
													}
													?>
												</div>
											</div>
										</div>
									</div>
									
									<!-- Chuveiro -->
									<div class="col-sm-3">
										<div class = "card text-black">
											<div class = "card text-center"> 
												<div class = "card-header" >
													<p class = "text-center"><b><?php echo $nome_chuveiro_sensor.": <br>". $valor_chuveiro_sensor?></b></p>
												</div>
												<div class = "card-body">
													<img src = "imagens/chuveiro_sensor.png" alt = "chuveiro" height = "100" width = "100">
												</div>
												<div class = "card-footer">
													<p class = "text-center"><b>Atualização</b>: <?php echo $hora_chuveiro_sensor?> <a style="text-decoration: none" class="link-primary" href="./historico.php?nome=chuveiro_sensor"> Histórico </a></p>
												</div>
											</div>
										</div>
									</div>
									
									<!-- Leitor de Cartões -->
									<div class="col-sm-3">
										<div class = "card text-black">
											<div class = "card text-center"> 
												<div class = "card-header" >
													<p class = "text-center"><b><?php echo $nome_cartoes.": <br>". $valor_cartoes?></b></p>
												</div>
												<div class = "card-body">
													<img src = "imagens/rfid.png" alt = "rfid" height = "100" width = "100">
												</div>
												<div class = "card-footer">
													<p class = "text-center"><b>Atualização</b>: <?php echo $hora_cartoes?> <a style="text-decoration: none" class="link-primary" href="./historico.php?nome=rfid"> Histórico </a></p>
												</div>
											</div>
										</div>
									</div>
									
									<!-- Altura das ondas -->
									<div class="col-sm-3">
										<div class = "card text-black">
											<div class = "card text-center"> 
												<div class = "card-header" >
													<p class = "text-center"><b><?php echo $nome_ondas.": <br>". $valor_ondas?> metros</b></p>
												</div>
												<div class = "card-body">
													<img src = "imagens/nivel.png" alt = "nivel" height = "100" width = "100">
													<br>
														<form action = "graficos.php">
															<button type="submit" action = "graficos.php" ><img src = "imagens/graph.png" height = "10" width = "10"></button> 
														</form>
												</div>
												<div class = "card-footer">
													<p class = "text-center"><b>Atualização</b>: <?php echo $hora_ondas?> <a style="text-decoration: none" class="link-primary" href="./historico.php?nome=ondas"> Histórico </a></p>
												</div>
											</div>
										</div>
									</div>
							</div>
					</div>
			</div>
		</div>
		
		<!--TABELA SENSORES-->
		<div class = "container" style = "padding-top: 10px">
			<div class="card bg-dark text-white">
				<div class = "card-header">
					<p class = "text-center"><b>Tabela de Sensores</b></p>
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
						
						<!-- Temperatura -->
							<th scope="row"><?php echo $nome_temperatura?></th>
							<td><?php echo $valor_temperatura?> ºC</td>
							<td><?php echo $hora_temperatura?></td>
							
						</tr>
						<tr>
						
						<!-- Temperatura da Água -->
							<th scope="row"><?php echo $nome_agua?></th>
							<td><?php echo $valor_agua?> ºC</td>
							<td><?php echo $hora_agua?></td>
						</tr>
						<tr>
						
						<!-- Radiação UV -->
							<th scope="row"><?php echo $nome_uv?></th>
							<td><?php echo $valor_uv?></td>
							<td><?php echo $hora_uv?></td>
						</tr>
						
						<!-- WC -->
						<!-- Apenas é permitido o acesso ao histórico pelo admin -->
						<?php
						if($username == "admin")
						{
							echo '
							<tr>
								<th scope="row" style = "color:pink;">'.$nome_wcF.'</th>
								<td>'.$valor_wcF.'</td>
								<td>'.$hora_wcF.'</td>
								';	
							echo ' </tr>';
							echo '
							<tr>
								<th scope="row" style = "color:blue;">'.$nome_wcM.'</th>
								<td>'.$valor_wcM.'</td>
								<td>'.$hora_wcM.'</td>';
							echo '</tr>';
						}
						?>
						<tr>
						
						<!-- Vento -->
							<th scope="row"><?php echo $nome_vento?></th>
							<td><?php echo $valor_vento." km/h"?></td>
							<td><?php echo $hora_vento?></td>
						</tr>
						
						<tr>
						
						<!-- Sensor Chuveiro  -->
							<th scope="row"><?php echo $nome_chuveiro_sensor?></th>
							<td><?php echo $valor_chuveiro_sensor?></td>
							<td><?php echo $hora_chuveiro_sensor?></td>
						</tr>
						
						<!-- Leitor de Cartões  -->
							<th scope="row"><?php echo $nome_cartoes?></th>
							<td><?php echo $valor_cartoes?></td>
							<td><?php echo $hora_cartoes?></td>
						</tr>
						
						<!-- Nível da Água  -->
							<th scope="row"><?php echo $nome_nivel?></th>
							<td><?php echo $valor_nivel?> metros</td>
							<td><?php echo $hora_nivel?></td>
						</tr>
						
						<!-- Altura das Ondas  -->
							<th scope="row"><?php echo $nome_ondas?></th>
							<td><?php echo $valor_ondas?> metros</td>
							<td><?php echo $hora_ondas?></td>
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