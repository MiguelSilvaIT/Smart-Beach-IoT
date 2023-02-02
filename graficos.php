<?php
 
 	if(isset($_POST['valorOnda']))//verifica se foi escolhida alguma data na dropdown 
	{
		
		$data = $_POST['valorOnda'];
	}
	
	//fun??o que obt?m as datas em que houveram registos no log
	function getDatas($valores)
	{
		$expValores = explode(" ", $valores); //separa os valores da string e armazena-os numa array
		$datas = array();
		
		//print_r($expValores);
		for($i= 1; $i < sizeof($expValores); $i+=2)
		{
			$expValores1 = explode(";", $expValores[$i]); //separa os valores da string e armazena-os numa array
			//print_r($expValores);
			$oValor = $expValores1[2]; //inicializa a variavel com a terceira posi??o da array que corresponde ao valor desejado

			if(!in_array($oValor, $datas)) //como o log tem muitas datas repetidas aqui ? verificado se essa data j? existe na array
			{
				array_push($datas, $oValor); //adiciona o valor ? ultima posi??o do array
			}
		}
		return $datas;
		
	}
	
	//fun??o para obter os valores correspondentes ? data escolhida
	function getValores($ficheiro, $data)
	{
		echo $data;
		$ficheiro = fopen($ficheiro, "r");
		if ($ficheiro) 
		{
			$horas = array();
			$valores = array_fill(0,23,5); //cria uma array com 24 posi??es com um default value de 5 metros(caso n?o tenham havido registos nessa data)
			while (($line = fgets($ficheiro)) !== false) //percorre linha a linha do ficheiro
			{
				if(str_contains($line,$data)) // caso a linha tenha a data pedida
				{
					$linhaExp = explode(" ",$line);
					$horaExataLinha = explode(":",$linhaExp[1]);
					$horaExata = $horaExataLinha[0];
					
					
					
					$valor = explode(";", $linhaExp[1]);
					

					
					if(!in_array($horaExata , $horas))
					{
						array_push($horas , $horaExata);
						
						array_splice($valores, $horaExata, 0, $valor[1]); //armazena o valor na posi??o respetiva ? hora em que foi registado
						
						//echo "Hora Exata: ".$horaExata.'<br>';
					}
				}
				
			}
						
		fclose($ficheiro);
		}
		return $valores;
	}
	
	

	$file = "api/files/ondas/log.txt";
	$valores = file_get_contents($file);
	$datas = getDatas($valores);
	if(!isset($data))//no caso de n?o ter sido definida nehuma data na dropdown
	{
		$data = '2022-6-8';
	}
	$valoresGraf = getValores($file, $data);
	
	$dataPoints = array(
	
	array("x" => 0, "y" => $valoresGraf[0]),
	array("x" => 1, "y" => $valoresGraf[1]),
	array("x" => 2, "y" => $valoresGraf[2]),
	array("x" => 3, "y" => $valoresGraf[3]),
	array("x" => 4, "y" => $valoresGraf[4]),
	array("x" => 5, "y" => $valoresGraf[5]),
	array("x" => 6, "y" => $valoresGraf[6]),
	array("x" => 7, "y" => $valoresGraf[7]),
	array("x" => 8, "y" => $valoresGraf[8]),
	array("x" => 9, "y" => $valoresGraf[9]),
	array("x" => 10, "y" => $valoresGraf[10]),
	array("x" => 11, "y" => $valoresGraf[11]),
	array("x" => 12, "y" => $valoresGraf[12]),
	array("x" => 13, "y" => $valoresGraf[13]),
	array("x" => 14, "y" => $valoresGraf[14]),
	array("x" => 15, "y" => $valoresGraf[15]),
	array("x" => 16, "y" => $valoresGraf[16]),
	array("x" => 17, "y" => $valoresGraf[17]),
	array("x" => 18, "y" => $valoresGraf[18]),
	array("x" => 19, "y" => $valoresGraf[19]),
	array("x" => 20, "y" => $valoresGraf[20]),
	array("x" => 21, "y" => $valoresGraf[21]),
	array("x" => 22, "y" => $valoresGraf[22]),
	array("x" => 23, "y" => $valoresGraf[23]),
	);
	

 
?>
<!DOCTYPE HTML>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	
	<script>
	
	<!--Codigo do gr?fico-->
	window.onload = function () {
	 
	var chart = new CanvasJS.Chart("chartContainer", {
		animationEnabled: true,
		title:{
			text: "Grafico Ondas"
		},
		axisY: {
			title: "Metros",
			valueFormatString: "#,##0.##",
			suffix: "m",
			//prefix: "$"
		},
		axisX: {
			title: "Hora",
			valueFormatString: "#,##0.##",
			suffix: "h",
			//prefix: "$"
		},
		data: [{
			type: "spline",
			markerSize: 5,
			yValueFormatString: "#,##0.##m",
			xValueFormatString: "#,##0.##h",
			dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
		}]
	});
	 
	chart.render();
	 
	}
	<!--Fim codigo do gr?fico-->
	</script>
</head>
<body>
	
	<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
          <a class="nav-link" href="historico.php">Historico</a>
		</li>
      </ul>
    </div>
  </div>
</nav>
<!--Fim Navbar-->
	<div id="chartContainer" style="height: 370px; width: 100%;"></div>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	
	
	<!--Dropdown dinamico-->
	<form action="graficos.php" method = "post">
		<label>Escolha uma data</label>
			<select name = 'valorOnda'>
				<?php
				for($i=0; $i < sizeof($datas); $i++)
				{
					echo '<option>'.$datas[$i].'</option>';
				}
				?>
			</select>
			<input type="submit">
		
	</form>
	<!--Fim do dropdown dinamico-->
</body>
</html>                              