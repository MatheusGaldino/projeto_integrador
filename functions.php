<?php	
	session_start();
	include('db/index.php');
	header('Content-type: text/html; charset=utf-8');
	$errorMsg = '';
	
	function fieldValidation($value) {
		return str_replace('"','',
				str_replace("'",'',
				str_replace(';','',
				str_replace("\\",'',
				$value))));
	}
	function getSessionUserName() {
		return $_SESSION['user'];
	}
	function getSessionUserId() {
		return $_SESSION['id'];
	}
	function getSessionUserType() {
		return $_SESSION['type'];
	}
?>
