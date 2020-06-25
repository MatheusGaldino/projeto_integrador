<?php
	include ("../functions.php");
	logOut();
	if(isset($_SESSION['user'])) header("Location: ../dashboard");
	if(isset($_POST['login']) && isset($_POST['password'])) logIn($db);

	function logIn($db) {
		if(!isset($_SESSION['user'])) {
			if(isset($_POST['login'])) $login = fieldValidation($_POST['login']);
			if(isset($_POST['password'])) $password = fieldValidation($_POST['password']);
			
			$result = $db->query("SELECT nomeUsuario, idUsuario, tipoPerfil FROM Usuario WHERE loginUsuario = '$login' AND senhaUsuario = '$password'");
			
			$row = $result->fetch_assoc();
			//var_dump($result);
			//echo "<hr>";
			//var_dump($db);
			//var_dump($row);
		
			if(!empty($row['nomeUsuario'])) {
				$_SESSION['user'] = $row['nomeUsuario'];
				$_SESSION['id'] = $row['idUsuario']; 
				$_SESSION['type'] = $row['tipoPerfil'];
				header("Location: ../dashboard/");
			}
			else $GLOBALS['errorMsg'] = "Email ou Senha Inválidos!";			
		}	
		$db->close();
    }

    function logOut() {
		if(isset($_GET['session'])) {
			$escolha = $_GET['session'];
			if($escolha == "finish")
				session_destroy();
		}
	}

	include "login.tpl.php";

?>
