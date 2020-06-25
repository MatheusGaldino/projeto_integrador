<?php 
	include "../../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../../login/");
	
	if(isset($_GET['id'])) {
		if(is_numeric($_GET['id'])) $id = $_GET['id'];
		$query = odbc_exec($db, "SELECT * FROM Categoria WHERE idCategoria = '$id'");
		$result = odbc_fetch_array($query);
	}
	
		odbc_close($db);
	
	
	$msg = "";
	//UPDATE
	if((isset($_GET['update'])) && ($_GET['update'] == "true")) {			
		if(is_numeric($_POST['id'])) $id = $_POST['id'];		
		//trata categoria
			$nome = utf8_decode($_POST['name']);
			$nome = str_replace('"','',$nome);
			$nome = str_replace("'",'',$nome);
			$nome = str_replace(';','',$nome);
			
			$desc = utf8_decode($_POST['Description']);
			$desc = str_replace('"','',$desc);
			$desc = str_replace("'",'',$desc);
			$desc = str_replace(';','',$desc);
				

		if(odbc_exec($db, "UPDATE Categoria SET
					   nomeCategoria =  '$nome',
					   descCategoria = '$desc'
					   WHERE 
					   idCategoria = $id")) 
			header("Location: ../../categorias/?update=success");
		else {
			$msg = "Erro ao alterar produto!";
			odbc_close($db);
		}
	}

	include "edit.tpl.php";
?>