<?php 
	include "../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../login/");

	$msg = "";
	if(isset($_GET['add']) && $_GET['add'] == "success") $msg = "Produto cadastrado com sucesso!";
	if(isset($_GET['update']) && $_GET['update'] == "success") $msg = "Produto alterado com sucesso!";
	
	function listProducts($db) {
		$searchByNameQuery = ""; 
		$searchByCategoryQuery = ""; 
		$sortQuery = "";
		if(isset($_GET['searchByName']) && $_GET['searchByName'] != "") {
			$name = $_GET['searchByName'];
			$searchByNameQuery = "WHERE nomeProduto LIKE '%$name%'";
		}
		if(isset($_GET['searchByCategory']) && $_GET['searchByCategory'] != "") {
			$category = $_GET['searchByCategory'];
			if(isset($_GET['searchByName']) && $_GET['searchByName'] != "")
				$searchByCategoryQuery = " AND idCategoria = $category";
			else
				$searchByCategoryQuery = " WHERE idCategoria = $category";
			if($_GET['searchByCategory'] == "0")
				$searchByCategoryQuery ="";
		}
		if(isset($_GET['sort']) && $_GET['sort'] != "") {
			$sort = $_GET['sort'];
			switch ($sort) {
				case '1':
					$sortQuery = " ORDER BY precProduto ASC";
					break;
				case '2':
					$sortQuery = " ORDER BY precProduto DESC";
					break;
				case '3':
					$sortQuery = " ORDER BY qtdMinEstoque ASC";
					break;
				case '4':
					$sortQuery = " ORDER BY qtdMinEstoque DESC";
					break;				
			}	
		}
		$query = $db->query("SELECT idProduto, nomeProduto, precProduto, qtdMinEstoque, ativoProduto FROM Produto " . $searchByNameQuery . $searchByCategoryQuery . $sortQuery);
		
		return $query;
	}

	function loadSearchCatedories($db) { 
		$query = $db->query("SELECT idCategoria, nomeCategoria FROM Categoria");
	
		while($result = $query->fetch_assoc()) {
			if($_GET['searchByCategory'] == $result['idCategoria'])
				echo "<option selected value='" . $result['idCategoria'] . "'>" . utf8_encode($result['nomeCategoria']) . "</option>";
			else
				echo "<option value='" . $result['idCategoria'] . "'>" . utf8_encode($result['nomeCategoria']) . "</option>";
		}
	}

	function loadSortFields() {
		$fields = array("Preço menor para maior", "Preço maior para menor", "Esqoque menor para maior", "Estoque maior para menor");
		for($i = 1; $i < 5; $i++) {
			if(isset($_GET['sort']) && $_GET['sort'] == $i)
				echo "<option selected value='" . $i . "'>" . $fields[$i-1] . "</option>";
			else
				echo "<option value='" . $i . "'>" . $fields[$i-1] . "</option>";
		}
	}
	
	if((isset($_GET['action'])) && ($_GET['action'] == "delete")) {
		if(is_numeric($_GET['id'])) {
			$id = $_GET['id'];
			deleteItem($db, $id);
		}
	}
	function deleteItem($db, $prodId) {
		if($query = $db->query("DELETE FROM Produto WHERE idProduto = '$prodId'")) {
			if($query)
				$GLOBALS['msg'] = "Produto deletado com sucesso!";
			else
				$GLOBALS['msg'] = "Produto não existe!";
		}
		
	}

	function checkStatus($status) {
		if($status == 1) return "Ativo";
		else return "Inativo";
	}
	include "products.tpl.php";
?>