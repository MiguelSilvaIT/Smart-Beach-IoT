<?php

	function save_file($source_file, $new_location)
	{
		if (move_uploaded_file($source_file, $new_location))
		{
			echo 'Foi realizado com sucesso o upload do ficheiro.';
		}
		else
		{
			echo 'Ocorreu um erro ao fazer upload do ficheiro.';
		}
	}


	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		echo 'recebido um POST <br>';
		
		$nome = $_FILES['imagem']['name'];
		$extensao = strrchr($nome, '.');
		// Converte a extensao para minusculo
		$extensao = strtolower($extensao);
		
		
		if (isset ($_FILES['imagem']))
		{
			if (strstr('.jpg;.png', $extensao))
			{
				print_r($_FILES["imagem"]["name"]);
				echo '<br>';
				print_r($_FILES["imagem"]["size"]);
				echo '<br>';
				print_r($_FILES["imagem"]["type"]);
				echo '<br>';
				
				
				$size = $_FILES['imagem']['size'];
				
				if ($size <= 1024000) //1000kB = 1024000 Bytes
				{
					save_file ($_FILES["imagem"]["tmp_name"], 'imagens/webcam.jpg');
					
				}
				else
				{
					echo 'Tamanho não suportado!!\n';
				}
			}
			else
			{
				echo 'Extensão inválida!!\n';
			}
		}
		else
		{
			echo 'Erro nos dados enviados – não existe elemento imagem';
		}
	}
	else
	{
		http_response_code(403);
		echo 'metodo nao permitido';
	}





?>