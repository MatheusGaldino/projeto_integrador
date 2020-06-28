<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Produtos</title>
	<link rel="stylesheet" type="text/css" href="../css/testeestilo.css">
	<script src="https://use.fontawesome.com/11638b2227.js"></script>	
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	
	<?php include("../layout/menu.php"); ?>
    
    <nav id="prodNavigation">
    	<form method="GET" id="searchForm">
    		<!--Search By Name-->
    		<div class="searchByNameContainer">
    			<div class="borderSearch">					
					<input type="text" name="searchByName" placeholder="Digite o nome de um produto" value="<?php if(isset($_GET['searchByName']) && $_GET['searchByName'] != '') echo $_GET['searchByName']; ?>">	
					<input type="image" name="search" src="../imagems/searchIcon.png" alt="botão busca">
				</div>				
    		</div>
    		<!--End Search By Name-->

    		<div class="subSearch">
    			<div id="category">
	    			<label>Categorias: </label>
					<select name="searchByCategory">
						<option value="0">Todos</option>
						<?php loadSearchCatedories($db); ?>
					</select>
				</div>
				<div id="sort">
					<label>Organizar por: </label>
					<select name="sort">
						<option>Selecione uma opção</option>
						<?php loadSortFields(); ?>
					</select>
				</div>
    		</div>
    	</form>
	</nav>
	<div id="btnContainer">
		<a id="addNew" href="inserir/">Adicionar novo produto</a>
	</div>
	<p id="actionMsg"><?php echo $msg; ?></p>
	<table cellspacing='0'>
		<tr>
			<th>Nome</th>
			<th>Preço</th>
			<th>Estoque</th>
			<th>Status</th>
			<th>Ação</th>
		</tr>
		<?php 
			$query = listProducts($db);
			
			while($result = $query->fetch_assoc()):
		?>
				<tr>
					<td class='textocell'><?php echo utf8_encode($result['nomeProduto']); ?></td>
					<td class='textocell'>R$ <?php echo number_format($result['precProduto'], 2, ',', ' '); ?></td>
					<td class='textocell'><?php echo $result['qtdMinEstoque']; ?></td>
					<td class="textocell"><?php echo checkStatus($result['ativoProduto']); ?></td>
					<td id='acoes'>
						<?php  ?>
							<a class='edita' href="editar/?id=<?php echo $result['idProduto']; ?>" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							<a class='deleta' href="?action=delete&id=<?php echo $result['idProduto']; ?>" title="Deletar"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
						<??>
					</td>
				</tr>
			<?php endwhile; $db->close();?>
	</table>
	<?php include("../layout/footer.tpl.php") ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="../js/searchController.js"></script>
</body>
</html>