<?php 
	include "../../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../../login/");
	if(isset($_SESSION['type']) && $_SESSION['type'] != "1") header("Location: ../../dashboard/");
	$result;
	if(isset($_GET['id'])) {
		if(is_numeric($_GET['id'])) $id = $_GET['id'];
		else header("Location: ../../usuarios/?update=error");
		$query = $db->query("SELECT * FROM Usuario WHERE idUsuario = '$id'");
		$result = $query->fetch_assoc();
	}
	function checkProfileType($type) {
		if(is_numeric($_GET['id'])) $id = $_GET['id'];

		if($type == "A") {
			echo "<option value='" . $result['tipoPerfil'] . "' selected>Administrador</option>";
			echo "<option value='E'>Funcionário</option>";	
		}
		else {
			echo "<option value='" . $result['tipoPerfil'] . "' selected>Funcionário</option>";	
			echo "<option value='A'>Administrador</option>";
		}
	}
	function checkProfileStatus($status) {
		if(is_numeric($_GET['id'])) $id = $_GET['id'];

		if($status == 1) echo "<input type='checkbox' name='status' checked>";
		else echo "<input type='checkbox' name='status'>"; 
	}
	
	$msg = "";
	//UPDATE
	if((isset($_GET['update'])) && ($_GET['update'] == "true")) {			
		if(is_numeric($_POST['id'])) $id = $_POST['id'];
		
		//trata nome
			$name = fieldValidation($_POST['name']);
			$name = utf8_decode($name);
			
			$login = fieldValidation($_POST['login']);
			$login = utf8_decode($login);

			//trata senha
			$password = fieldValidation($_POST['senha']);

			//trata perfil
			$profile = 	$_POST['profile'] != '1' 
						&& $_POST['profile'] != 'E' 
						? '2' :	$_POST['profile'];
			
			//trata ativo
			$_POST['status'] = !isset($_POST['status']) ? 0 : $_POST['status'];
			$status = (bool) $_POST['status'];
			$status = $status === true ? 1 : 0;

		if($db->query("UPDATE Usuario
					   SET
					   loginUsuario = '$login',
					   senhaUsuario = '$password',
					   nomeUsuario = '$name',
					   tipoPerfil = '$profile',
					   usuarioAtivo = '$status'
					   WHERE
					   idUsuario = $id")) 
			header("Location: ../../usuarios/?update=success");
		else {
			$msg = "Erro ao alterar usuário!";
			$db->close();
		}
	}

	include "edit.tpl.php";
?>