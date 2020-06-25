<?php 
	include "../../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../../login/");

	function checkUserId($db, $userId) {
		$query = odbc_exec($db, "SELECT nomeUsuario FROM Usuario WHERE idUsuario = '$userId'");
		$result = odbc_fetch_array($query);
		return $result['nomeUsuario'];
	}
	function loadCatedories($db) { 
		$query = odbc_exec($db, "SELECT idCategoria, nomeCategoria FROM Categoria");
		
		while($result = odbc_fetch_array($query)) {
			echo "<option value='" . $result['idCategoria'] . "'>" . utf8_encode($result['nomeCategoria']) . "</option>";
		}
	}
	$msg = "";
	//INSERT
	if((isset($_GET['save'])) && ($_GET['save'] == "true")) {			
		$name = fieldValidation($_POST['prodName']);
		$name = utf8_decode($name);
		
		$description = fieldValidation($_POST['prodDescription']);
		$description = utf8_decode($description);
		
		$price = fieldValidation($_POST['prodPrice']);
		$discount = fieldValidation($_POST['prodDiscount']);
		$idCategory = $_POST['prodCategory'];
		$status = $_POST['prodStatus'];	
		$userId = getSessionUserId();
		$qtd = fieldValidation($_POST['prodQtd']);
		$price = str_replace(",", ".", $price);
		$discount = str_replace(",", ".", $discount);
		$image = $_POST['prodImg'];
		
		if(isset($_FILES['prodImg']) && !empty($_FILES['prodImg']['name'])) {		
			$file = fopen($_FILES['prodImg']['tmp_name'],'rb');
			$image = fread($file, filesize($_FILES['prodImg']['tmp_name']));
			fclose($file);
		}

		if($stmt = odbc_prepare($db, "INSERT INTO Produto
								(nomeProduto,
								 descProduto,
								 precProduto,
								 descontoPromocao,
								 idCategoria,
								 ativoProduto,
								 idUsuario,
								 qtdMinEstoque,
								 imagem)
								VALUES
								(?,?,?,?,?,?,?,?,?)")) {
			odbc_execute($stmt, array($name, $description, $price, $discount, $idCategory, $status, $userId, $qtd, $image));
			odbc_close($db);
			header("Location: ../index.php?add=success");
		}
		else $msg = "Erro ao inserir produto!";
	}

	include "insert.tpl.php";
?>