<?php 
	include "../../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../../login/");

	//ini_set ('odbc.defaultlrl', 9000000);//muda configuração do PHP para trabalhar com imagens no DB

	if(isset($_GET['id'])) {
		if(is_numeric($_GET['id'])) $id = $_GET['id'];
		$query = $db->query("SELECT * FROM Produto WHERE idProduto = '$id'");
		$result = $query->fetch_assoc();
		//odbc_longreadlen($query, 2000000);
	}
	function loadFormCategories($db, $id) { 
		$query = $db->query("SELECT idCategoria, nomeCategoria FROM Categoria");
		
		while($result = $query->fetch_assoc()) {
			if($id == $result['idCategoria'])
				echo "<option value='" . $result['idCategoria'] . "' selected>" . utf8_encode($result['nomeCategoria']) . "</option>";
			else
				echo "<option value='" . $result['idCategoria'] . "'>" . utf8_encode($result['nomeCategoria']) . "</option>";
		}
	}
	function checkUserId($db, $userId) {
		$query = $db->query("SELECT nomeUsuario FROM Usuario WHERE idUsuario = '$userId'");
		$result = $query->fetch_assoc();
		return $result['nomeUsuario'];
	}

	$msg = "";
	//UPDATE
	if((isset($_GET['update'])) && ($_GET['update'] == "true")) {			
		if(is_numeric($_POST['prodID'])) $id = $_POST['prodID'];		
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

		if($stmt = $db->query("UPDATE Produto SET
									 nomeProduto='$name',
									 descProduto='$description',
									 precProduto='$price',
									 descontoPromocao='$discount',
									 idCategoria='$idCategory',
									 ativoProduto='$status',
									 idUsuario='$userId',
									 qtdMinEstoque='$qtd',
									 imagem='$image'
									 WHERE
									 idProduto = '$id'")) {
			
			
			
			$db->close();

			header("Location: ../../produtos/?update=success");
		}
		else {
			$msg = "Erro ao alterar produto!";
			$db->close();
		}
	}

	function checkProfileStatus($status) {
		if(is_numeric($_GET['id'])) $id = $_GET['id'];
		
		if($status == 1) {
			echo "<option selected value='1'>Ativo</option>";
			echo "<option value='2'>Inativo</option>";
		}
		else {
			echo "<option selected value='2'>Inativo</option>";
			echo "<option value='1'>Ativo</option>";
		}
	}
	include "edit.tpl.php";
?>