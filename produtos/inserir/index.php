<?php 
date_default_timezone_set("America/Sao_Paulo");


	include "../../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../../login/");

	function checkUserId($db, $userId) {
		$query = $db->query("SELECT nomeUsuario FROM Usuario WHERE idUsuario = '$userId'");
		$result = $query->fetch-assoc();
		return $result['nomeUsuario'];
	}
	function loadCatedories($db) { 
		$query = $db->query("SELECT idCategoria, nomeCategoria FROM categoria");
		
		while($result = $query->fetch_assoc()) {
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

		$uploadDir = "../../uploads/";
		$_FILES['prodImg']['name'] = date("Y-m-d H-i-s") . $_FILES['prodImg']['name'];
		$fileUpload = $uploadDir.basename($_FILES['prodImg']['name']);
		$image = $_FILES['prodImg']['name'];


		$res = move_uploaded_file($_FILES['prodImg']['tmp_name'], $fileUpload);
		

		if($stmt = $db->query("INSERT INTO Produto
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
								('$name', '$description', '$price', '$discount', '$idCategory', '$status', '$userId', '$qtd', '$image')")) {
			
			$db->close();
			header("Location: ../index.php?add=success");
		}
		else $msg = "Erro ao inserir produto!";
	}

	include "insert.tpl.php";
?>