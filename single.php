<?php
function __autoload($classe){
	require'classes/'.$classe.'.class.php';
}

$mysql = new MysqlBase('localhost','root','','blog-comentarios');
$comentario = new Comentario($mysql);
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
		<?php
		$id_post = (int)strip_tags($_GET['post']);
		$str = sprintf("SELECT * FROM `posts` WHERE id = '%s'", $id_post);
		$execute = $mysql->execute($str);
		foreach($execute as $linha);
		
		?>
		<div class="imagem-destaque">
			<a href="#" title="">
				<img src="uploads/<?php echo $linha['imagem'];?>" alt="" title="">
			</a>
		</div>
		<div class="info-destaque">
			<h1>
			<?php echo $linha['titulo'];?>
			</h1>

			<p><?php echo $linha['descricao'];?></p>

			<a href="javascript/criando-timer-com-notificacoes" class="button right top10">Continuar Lendo</a>
		</div>
		<div id="all">
		<h2>Este é um post de exemplo</h2>

			<div id="comentarios">
			<?php
				$strQuery = sprintf("SELECT * FROM `comentarios` WHERE id_post = '%s'", $id_post);
				$stmt = $mysql->execute($strQuery);
				$restante = $stmt->rowCount();				
				$arrayComentarios = $comentario->listComentarios($id_post);				
				$comentario->printComentarios($arrayComentarios);
			?>
			</div><!-- comentarios -->
			<a href="javascript:void(0);" id="load" class="btn">Carregar todos os comentários</a>
			<span class="restante" id="id_restante"></span>
			
			<div id="erros"></div>

			<div id="formulario">
				<form action="" method="post" enctype="multipart/form-data">
					<label>
						<span>Seu nome:</span>
						<input type="text" name="nome" id="nome" />
					</label>

					<label>
						<span>Seu email:</span>
						<input type="text" name="email" id="email" />
					</label>

					<label>
						<span>Seu site:</span>
						<input type="text" name="site" id="site" />
					</label>

					<label>
						<span>Seu comentário:</span>
						<textarea name="comentario" id="comentario" cols="30" rows="5"></textarea>
					</label>

					<input type="button" id="comentar" value="Comentar" class="btn"/>
				</form>
			</div><!-- formulário -->
		</div><!-- all -->
		</div><!--conteudo-->
		<script src="js/jquery.js"></script>
		<script type="text/javascript">
$(function(){
	$('#comentar').on('click', function(){
		var nome = $('#nome').val();
		var email = $('#email').val();
		var site = $('#site').val();
		var comentario = $('#comentario').val();
		var id_post = '<?php echo $id_post;?>';
		var id_com = '<?php echo (isset($_GET["reply"])) ? strip_tags($_GET["reply"]) : ""?>';

		if(nome == '' || email == '' || comentario == ''){
			$('#erros').html('<div class="erro">Erro: Preencha todos os campos corretamente</div>');
		}else{

			$('#erros').html('<div class="erro">Enviando comentário, aguarde...</div>');
			$.post('sys/functions.php',{
				nome: nome,
				email: email,
				site: site,
				comentario: comentario,
				id_post: id_post,
				id_com: id_com
			})
			.done(function(callback){
				
				if(callback == true){

					$('#erros').html('<div class="ok">Ok: Sua mensagem foi enviada com sucesso, e está aguardando aprovação.</div>');
					$('#nome').val('');
					$('#email').val('');
					$('#site').val('');
					$('#comentario').val('');

				}else{
					$('#erros').html('<div class="erro">Erro: Não foi possível inserir seu comentário, tente novamente.</div>');
				}

			});

		}
	});

	/*$('#load').on('click', function(){
		beforeSend: $(this).hide();
		var restante = $('.restante').attr('id');
		$.post('init/functions.php'{load: 'sim', restante: restante})
		.done(function(novosComents){
			$('#comentarios').append(novosComents);
		});
	})*/
});
		</script>
	</body>
</html>