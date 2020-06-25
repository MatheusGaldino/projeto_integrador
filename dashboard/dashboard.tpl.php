<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../css/testeestilo.css">
    
</head>
<body>

	<div id="wrapper">
		<?php include("../layout/menu.php"); ?>    
    
	    <article>
	        <a href="../produtos/"><div id="esquerda" class="bannerdash"><div class="fundo"><p>Produtos</p></div></div></a>
	        <a href="../categorias/"><div id="meio" class="bannerdash"><div class="fundo"><p>Categorias</p></div></div></a>
	        <a href="../usuarios"><div id="direita" class="bannerdash"><div class="fundo"><p>Usuarios</p></div></div></a>
	    </article>
    </div>
    <?php include("../layout/footer.tpl.php") ?>
</body>
</html>