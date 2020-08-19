<?php
	class Comentario{
		private $adapter;


		public function __construct(Database $base){
			$this->adapter = $base;
		}


		public function insertComentario(Comentarios $comentario){
			$strSQL = sprintf("INSERT INTO `comentarios` SET 
				id_post = '%s',
				id_com = '%s',
				nome = '%s', 
				email = '%s', 
				site = '%s', 
        comentario = '%s'", 
        $comentario->getIdPost(), 
        $comentario->getIdCom(), 
        $comentario->getNome(), 
        $comentario->getEmail(), 
        $comentario->getSite(), 
        $comentario->getComentario());
			
			$stmt = $this->adapter->execute($strSQL);
			return $stmt;
		}


		public function listComentarios($id_post, $limit = false){

			if(!is_null($id_post)){

				if($limit == false)
					$strSQL = sprintf("SELECT * FROM `comentarios` WHERE id_post = '%s' ORDER BY id_com LIMIT 5", $id_post);
				else
					$strSQL = sprintf("SELECT * FROM `comentarios` WHERE id_post = '%s' ORDER BY id_com LIMIT 5, $limit", $id_post);

				$stmt = $this->adapter->execute($strSQL);

				$comItens = array();
				while($row = $stmt->fetchObject()){
					$comItens[$row->id_com][$row->id] = array('id_com' => $row->id, 'nome' => $row->nome, 'comentario' => $row->comentario);
				}
				return $comItens;

			}

		}


		public function printComentarios(array $comTotal, $pai = '', $classe = ''){
			if(isset($comTotal[$pai])){
				foreach($comTotal[$pai] as $idCom => $comItem){
					$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?post='.$_GET['post'];
					echo '<div class="comentario '.$classe.'"><span>'.$comItem['nome'].' disse:</span><p>'.$comItem['comentario'].'</p>
					<a href="'.$url.'&reply='.$comItem['id_com'].'" class="resp btn">Responder</a>';


					if(isset($comTotal[$idCom]))
						$this->printComentarios($comTotal, $idCom, 'resp');

					echo '</div>';
				}
			}

		}

	}
?>