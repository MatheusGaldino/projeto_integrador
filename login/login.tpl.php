<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="http://fonts.googleapis.com/css?family=Roboto:400,300,100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="loginStyle.css">    
</head>
<body>
	<header id="pageHeader">
		<img id="logo" alt="logo" title="DeltaSports" src="../imagems/logo.jpg">
	</header>
	
	<div id="wrapper">
		<h1>Delta Materiais Esportivos</h1>
		<form method="POST">
			<h2>Login</h2>
			
			<span class="errorMsg"><?php echo $errorMsg; ?></span>
			<p>
				<label for="login">Login:</label>
				<input type="text" name="login" id="login" required>
			</p>
			<p>
				<label for="password">Senha:</label>
				<input type="password" name="password" id="password" required>
			</p>		
			<p>
				<input type="submit" value="Entrar">
			</p>
		</form>
    </div>
</body>
</html>
