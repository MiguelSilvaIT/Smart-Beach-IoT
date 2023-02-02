<?php

	header('Content-Type: text/html; charset=utf-8');
	

	//carrega os nomes dos diretorios no array $files1
	$diretorios = "files/";
	$files1 = scandir($diretorios);
	
	//print_r($files1);

	if($_SERVER['REQUEST_METHOD'] == "POST") //verifica se o metodo utilizado foi o POST
	{
		//echo 'recebi um POST';
		print_r($_POST);
		if (isset($_POST['valor']) && isset($_POST['hora']) && isset($_POST['nome']) ) 
		{
			if(in_array($_POST["nome"], $files1))
			{	
				file_put_contents("files/".$_POST['nome']."/valor.txt", $_POST['valor']);
				file_put_contents("files/".$_POST['nome']."/hora.txt", $_POST['hora']);

				file_put_contents("files/".$_POST['nome']."/log.txt", $_POST['hora'].";".$_POST['valor'].";".PHP_EOL, FILE_APPEND);
			}
			else
			{
				http_response_code(400); 
				echo 'Parametro'.$_POST['nome'].' não existe!';
			}
		}
		else
		{
			http_response_code(400); 
			echo 'Parametros recebidos não são válidos';
		}
	}
	else if($_SERVER['REQUEST_METHOD'] == "GET")//verifica se o metodo utilizado foi o GET
	{
		
		//echo 'recebi um GET\n';
		if (isset( $_GET["nome"]) ) 
		{
			if(in_array($_GET["nome"], $files1))
			{
					echo file_get_contents("files/".$_GET['nome']."/valor.txt");
			}
			else
			{
				http_response_code(400); 
				echo "Sensor Inválido";
			}
		}
		else
		{
			echo "Faltam parametros GET";
			http_response_code(400); 
		}	
	}
	else
	{
		echo 'metodo nao permitido';
		http_response_code(403); 
	}	
	
		
	
  ?>