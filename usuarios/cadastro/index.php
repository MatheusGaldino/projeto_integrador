<?php
	include "../../functions.php";
	if(!isset($_SESSION['user'])) header("Location: ../../login/");
	if(isset($_SESSION['type']) && $_SESSION['type'] != "1") header("Location: ../../dashboard/");
	if(isset($_POST['login']) && isset($_POST['senha']) && isset($_POST['nome'])) newUser($db);
	$erro = "";
	if(isset($_GET['error']) && $_GET['error'] == "true") $erro = "Usuário já existe!";
	function newUser($db) {				
		$login = fieldValidation($_POST['login']);
			
		$query = $db->query("SELECT loginUsuario FROM Usuario WHERE loginUsuario = '$login'");
		$result = $query->fetch_assoc();
		if(!empty($result['loginUsuario'])) {
			header("Location: ?error=true");	
		}
		else {			
			$name = fieldValidation($_POST['nome']);
			$name = utf8_decode($name);
			
			$password = fieldValidation($_POST['senha']);
			
			$perfil = 	$_POST['perfil'] != '1' 
						&& $_POST['perfil'] != '2' 
						? 'E' :	$_POST['perfil'];
			
			$_POST['ativo'] = !isset($_POST['ativo']) ? 0 : $_POST['ativo'];
			$ativo = (bool) $_POST['ativo'];
			$ativo = $ativo === true ? 1 : 0;
			
			if($db->query("	INSERT INTO
									Usuario
									(loginUsuario,
									senhaUsuario,
									nomeUsuario,
									tipoPerfil,
									usuarioAtivo)
								VALUES
									('$login',
									'$password',
									'$name',
									'$perfil',
									$ativo)")){
				$db->close();
				header("Location: ../../usuarios/?add=success");				
			}else{
				$GLOBALS["erro"] = "Erro ao cadastrar usuário";
			}
		}
		
	}
	include "signup.tpl.php";
?>