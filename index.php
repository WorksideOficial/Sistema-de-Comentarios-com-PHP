<?php
function __autoload($classe){
	require'classes/'.$classe.'.class.php';
}

$mysql = new MysqlBase('localhost','root','','blog-comentarios');

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Index sistema de Comentários</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
<header class="topo">
			<div class="center">
			<h1>Sistema de comentários com PHP e JQUERY</h1>
			</div>
</header>
<nav id="menu-principal">
	<ul class="center">
			<li><a href="" title="Home Page">Home</a></li>
			<li class="hide-mobile"><a href="#sobre" title="Sobre">Sobre</a></li>
			<li><a href="#servicos" title="Serviços">Serviços</a></li>
			<li><a href="#contato" title="Contato">Contato</a></li>
	</ul>
	</div>
</nav>
<div class="conteudo">
		<ul class="publicacoes">
			<?php
				$strSql = sprintf("SELECT * FROM `posts`");
				$stmt = $mysql->execute($strSql);
				while($row = $stmt->fetchObject()){
			?>
			<li>
				<div class="img-pub">
					<a href="single.php?post=<?php echo $row->id;?>" title="<?php echo $row->titulo;?>">
					<img src="uploads/<?php echo $row->imagem;?>">
					</a>
				</div>
				<span class="title-pub left w100">
					<a href="single.php?post=<?php echo $row->id;?>" title="<?php echo $row->titulo;?>"><?php echo $row->titulo;?></a>
				</span>
				<p><?php echo $row->descricao;?></p>
			</li>
		<?php }?>				
		</ul>
</div><!--conteudo-->
	</body>
</html>