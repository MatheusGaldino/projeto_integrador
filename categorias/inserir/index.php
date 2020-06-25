<?php
	include "../../functions.php";
	if(!isset($_SESSION['user'])) header("Location: ../../login/");

	//grava a categoria no banco
	$erro = "";
	if(isset($_GET['error']) && $_GET['error'] == "true") $erro = "Categoria já existe!";
	
	if(isset($_POST['name'])){	
		//trata categoria
			$nome = utf8_decode($_POST['name']);
			$nome = str_replace('"','',$nome);
			$nome = str_replace("'",'',$nome);
			$nome = str_replace(';','',$nome);
			
			$desc = utf8_decode($_POST['Description']);
			$desc = str_replace('"','',$desc);
			$desc = str_replace("'",'',$desc);
			$desc = str_replace(';','',$desc);
			
		$query = odbc_exec($db, "SELECT nomeCategoria FROM Categoria WHERE nomeCategoria = '$nome'");
		$result = odbc_fetch_array($query);

		if(!empty($result['nomeCategoria'])) {
			header("Location: ?error=true");	
		}
		else {			
			if(odbc_exec($db, "	INSERT INTO
									Categoria
									(nomeCategoria,
									descCategoria)
								VALUES
									('$nome',
									'$desc'
									)")){
				odbc_close($db);
				header("Location: ../../categorias/?add=success");				
			}else{
				$msg = "Erro ao cadastrar categoria";
			}
		}
	}	
	
	include "insere.tpl.php";
?>