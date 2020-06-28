<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Insert</title>
	<link rel="stylesheet" type="text/css" href="../../css/testeestilo.css">
    <link rel="stylesheet" type="text/css" href="../formStyle.css">	
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">		
		#imgContainer {
			background: url('../../imagems/noImage.png') center no-repeat; 
			background-size: cover;
			border: solid 1px #69be28;
			border-bottom: none;
			max-width: 270px;
			padding-bottom: 80%;
			width: 100%;
		}		
	</style>
</head>
<body>

	<?php include("../../layout/menu.in.php"); ?>
    
    <form enctype="multipart/form-data" method="POST" action="?save=true" class="clearFix">
		<p id="message"> <?php echo $msg; ?></p>
		<div id="textDataContainer">
			<p>
				<label for="prodName">Nome:</label><br>
				<input type="text" id="prodName" name="prodName" required placeholder="Digite o nome do produto">
			</p>
			<div id="description">
				<label for="prodDescription">Descrição:</label><br>
				<textarea id="prodDescription" name="prodDescription" placeholder="Descrição do produto"></textarea>
			</div>
			<div id="valuesContainer">
				<p>	
					<label for="prodPrice">Preço:</label><br>
					<input type="text" id="prodPrice" name="prodPrice" required placeholder="00.00">
				</p>
				<p>
					<label for="prodDiscount">Desconto:</label><br>
					<input type="text" id="prodDiscount" name="prodDiscount" required placeholder="00.00">
				</p>
				<p>
					<label for="prodQtd">Estoque:</label><br>
					<input type="text" id="prodQtd" name="prodQtd" required placeholder="0">
				</p>
				<p>
					<label for="prodCategory">Categoria:</label><br>
					<select id="prodCategory" name="prodCategory" required>
						<?php loadCatedories($db); ?>
					</select>
				</p>					
				<p>
					<label for="prodStatus">Status:</label><br>
					<select id="prodStatus" name="prodStatus">
						<option value="1">Ativo</option>
						<option value="0">Inativo</option>
					</select>
				</p>
				<div id="buttons">
					<input type="submit" value="SALVAR">
					<a href="../">CANCELAR</a>
				</div>
			</div>			
			
		</div>
		<div id="imageUpdateContainer">
			<p>
				<label for="prodImg">Imagem</label><br>
				<div id="imgContainer"></div>
			
			<p>	
						
				<input type="file" id="image" name="prodImg" accept="image/*" onchange="readImagesAndSetAsBackground(this.files)">
				<input type="button" id="clearFile" value=" X " title="Excluir imagem selecionada">
			</p>		
		</div>
	</form>
	<?php include("../../layout/footer.tpl.php") ?>
	<script src="js/imageDisplay.js"></script>
</body>
</html>