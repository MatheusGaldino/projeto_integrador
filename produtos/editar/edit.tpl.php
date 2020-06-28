<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../../css/testeestilo.css">
    <link rel="stylesheet" type="text/css" href="../formStyle.css">	
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<?php include("../../layout/menu.in.php"); ?>
    
    <form enctype="multipart/form-data" method="POST" action="?id=<?php echo $_GET['id']; ?>&update=true" class="clearFix">
		<p id="message"> <?php echo $msg; ?></p>
		<p>
			<input class="id" type="hidden" name="prodID" value="<?php echo $result['idProduto']; ?>">
		</p>
		<div id="textDataContainer">
			<p>
				<label for="prodName">Nome</label><br>
				<input type="text" id="prodName" name="prodName" required value="<?php echo utf8_encode($result['nomeProduto']); ?>">
			</p>
			<div id="description">
				<label for="prodDescription">Descrição</label><br>
				<textarea type="text" id="prodDescription" name="prodDescription"><?php echo utf8_encode($result['descProduto']); ?></textarea>
			</div>
			<div id="valuesContainer">
				<p>	
					<label for="prodPrice">Preço</label><br>
					<input type="text" id="prodPrice" name="prodPrice" required value="<?php echo str_replace(",", ".", number_format($result['precProduto'], 2, ',', ' ')); ?>">
				</p>
				<p>
					<label for="prodDiscount">Desconto</label><br>
					<input type="text" id="prodDiscount" name="prodDiscount" value="<?php echo $result['descontoPromocao']; ?>">
				</p>
				<p>
					<label for="prodQtd">Estoque</label><br>
					<input type="text" id="prodQtd" name="prodQtd" value="<?php echo $result['qtdMinEstoque']; ?>">
				</p>
				<p>
					<label for="prodCategory">Categoria</label><br>
					<select id="prodCategory" name="prodCategory" required>
						<?php loadFormCategories($db, $result['idCategoria']); ?>
					</select>
				</p>					
				<p>
					<label for="prodStatus">Status</label><br>
					<select id="prodStatus" name="prodStatus">
						<?php checkProfileStatus($result['ativoProduto']); ?>
					</select>
				</p>
				<p id="userName">
					<label>Cadastrado por: <?php echo checkUserId($db, $result['idUsuario']); ?></label>
				</p>
				<div id="buttons">
					<input type="submit" value="SALVAR">
					<a href="../">CANCELAR</a>
				</div>
			</div>			
			
		</div>
		<div id="imageUpdateContainer">
			<p>
				<label for="prodImg">Imagem</label>
				<div id="imgContainer">
					<?php if(!empty($result['imagem'])): ?>
						<img id="currentImage" src="/projeto_integrador/uploads/<?php echo $result['imagem'] ?>">
					<?php endif; ?>
				</div>
			</p>
			<p>				
				<input type="file" id="prodImg" name="prodImg" accept="image/*" onchange="readImagesAndSetAsBackground(this.files)">
				<input type="button" id="clearFile" value=" X " title="Excluir imagem selecionada">
			</p>		
		</div>
	</form>
	<?php include("../../layout/footer.tpl.php") ?>
	<script src="js/editImageDisplay.js"></script>
</body>
</html>