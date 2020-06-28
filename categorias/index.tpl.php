<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Categorias</title>
	<link rel="stylesheet" type="text/css" href="../css/testeestilo.css">
	<script src="https://use.fontawesome.com/11638b2227.js"></script>	
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php  include("../layout/menu.php"); ?>
    
    <nav id="prodNavigation">
    	<form method="GET" id="searchForm">
    		<!--Search By Name-->
    		<div class="searchByNameContainer">
    			<div class="borderSearch">					
					<input type="text" name="searchByName" placeholder="Digite o nome da categoria" value="<?php if(isset($_GET['searchByName']) && $_GET['searchByName'] != '') echo $_GET['searchByName']; ?>">	
					<input type="image" name="search" src="../imagems/searchIcon.png" alt="botão busca">
				</div>				
    		</div>
    		<!--End Search By Name-->
    	</form>
	</nav>

	<div id="btnContainer">
		<a id='addNew' href='inserir/'>Adicionar nova Categoria</a>
	</div>
	
	<p id="actionMsg"><?php echo $msg; ?></p>
	<table cellspacing='0' id="categoryTable">
		<tr>
			<th>Nome</th>
			<th>Descrição</th>
			<th>Ação</th>
		</tr>
		<?php 
			$query = listCategories($db);
			
			while($result = $query->fetch_assoc()):
		?>
				<tr>
					<td class='textocell'><?php echo utf8_encode($result['nomeCategoria']); ?></td>
					<td class='textocell'><?php echo utf8_encode($result['descCategoria']); ?></td>
					<td id='acoes'>
						<?php  ?>
							<a class='edita' href="editar/?id=<?php echo $result['idCategoria']; ?>" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							<a class='deleta' href="?action=delete&id=<?php echo $result['idCategoria']; ?>" title="Deletar"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
						<?php ?>
					</td>
				</tr>
			<?php endwhile; $db->close();?>
	</table>
	<?php include("../layout/footer.tpl.php") ?>
</body>
</html>