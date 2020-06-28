<?php 
	include "../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../login/");

	$msg = "";
	if(isset($_GET['add']) && $_GET['add'] == "success") $msg = "Categoria cadastrada com sucesso!";
	if(isset($_GET['update']) && $_GET['update'] == "success") $msg = "Categoria alterada com sucesso!";
		
	if((isset($_GET['action'])) && ($_GET['action'] == "delete")) {
		if(is_numeric($_GET['id'])) {
			$id = $_GET['id'];
			deleteItem($db, $id);
		}
	}
	function deleteItem($db, $catId) {
		$query = $db->query(" SELECT idCategoria FROM Produto WHERE idCategoria = '$catId'");
		if(empty($result = $query->fetch_assoc())){
			if($query = $db->query("DELETE FROM Categoria WHERE idCategoria = '$catId'")) {
				if($query->num_rows > 0)
					$GLOBALS['msg'] = "Categoria deletado com sucesso!";
				else
					$GLOBALS['msg'] = "Categoria não existe!";
			}		
		}else{
			$GLOBALS['msg'] = "Não é possível deletar esta categoria";
		}
	}
	function listCategories($db) {
		if(isset($_GET['searchByName'])) {
			$name = $_GET['searchByName'];
			$query = $db->query("SELECT idCategoria, nomeCategoria, descCategoria FROM 
				Categoria WHERE nomeCategoria LIKE '%$name%'");
		}
		else 
			$query = $db->query("SELECT idCategoria, nomeCategoria, descCategoria FROM Categoria");
		return $query;
	} 
	include "index.tpl.php";
?>

