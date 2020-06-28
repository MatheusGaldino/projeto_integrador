<?php 
	include "../../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../../login/");
	
	if(isset($_GET['id'])) {
		if(is_numeric($_GET['id'])) $id = $_GET['id'];
		$query = $db->query("SELECT * FROM Categoria WHERE idCategoria = '$id'");
		$result = $query->fetch_assoc();
	}
	
		
	
	
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
				

		if($db->query("UPDATE Categoria SET
					   nomeCategoria =  '$nome',
					   descCategoria = '$desc'
					   WHERE 
					   idCategoria = $id")){ 
			header("Location: ../../categorias/?update=success");
		}else {
			$msg = "Erro ao alterar produto!";
			$db->close();
		}
	}

	include "edit.tpl.php";
?>