<!DOCTYPE html>
<html>
<head>
	<title>Cadastro Usuário</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/testeestilo.css">
	<link rel="stylesheet" type="text/css" href="../../css/userCatFormStyle.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
<body>
	<?php include("../../layout/menu.in.php"); ?>
	
    <form method="POST">
	<h2>Cadastro</h2>
		<p id="erroMsg"><?php echo $erro; ?></p>
		<p>
			<label for="name">Nome: </label>
			<input type="text" id="name" name="nome" required>
		</p>
		<p>
			<label for="login">login: </label>
			<input type="text" id="login" name="login" required>
		</p>
		<p>
			<label for="password">Senha: </label>
			<input type="password" id="password" name="senha" required>
		</p>
		<p>
			<label for="profileType">Perfil:	</label>
			<select id="profileType" name="perfil">
				<option value="A">Administrador</option>
				<option value="E">Funcionário</option>
			</select>
		</P>
		<p>
			<label for="status">Ativo: </label>
			<input type="checkbox" id="status" name="ativo" checked><br><br>
		</p>
		<p>
			<input type="submit" value="Gravar" name="btnNovoUsuario">
			<a id="btnBack" href="../">Cancelar</a>			
		</p>
	</form>
	<?php include("../../layout/footer.tpl.php") ?>
</body>
</html>
