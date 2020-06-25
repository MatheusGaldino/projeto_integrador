<?php
	  $db_host = "localhost";
    $db_name = "delta"; 
    $db_login = "root";
    $db_pswd = "";
    //$dsn = "Driver={SQL Server};Server=$db_host;Port=1433;Database=$db_name;";

    $db = new mysqli($db_host, $db_login, $db_pswd, $db_name);
    if($db->connect_errno){
		echo $db->conect_error . "Não foi possível acessar o banco de dados";
		exit;
	}
?>