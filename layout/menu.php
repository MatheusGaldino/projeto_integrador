<header id="pageHeader">
	<a href="../dashboard">
		<img src="../imagems/logo.jpg" id="logo" alt="logo" title="home">
	</a>
	<h2><?php echo getSessionUserName(); ?></h2>
</header>

<nav id="productsControlNavigation">
	<ul>
		<li><a href="../produtos/">PRODUTOS</a></li>
		<li><a href="../categorias/">CATEGORIAS</a></li>
		<li><a href="../usuarios/">USUÁRIOS</a></li>
		<li><a href="../login/?session=finish">Sair</a></li>
	</ul>	
</nav>