<?php 
	include "../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../login/");
	include "dashboard.tpl.php";
?>