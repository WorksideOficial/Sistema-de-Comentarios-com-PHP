<?php
	if(isset($_POST)){
    sleep(2);

    function __autoload($classe){
      require'../classes/'.$classe.'.class.php';
    }
    $mysql = new MysqlBase('localhost','root','','blog-comentarios');
    $ComentarioBase = new Comentario($mysql);

    $ArrayPost = filter_input_array(INPUT_POST, array(
      'nome' => FILTER_SANITIZE_STRING,
      'email' => FILTER_SANITIZE_STRING,
      'site' => FILTER_SANITIZE_STRING,
      'comentario' => FILTER_SANITIZE_STRING,
      'id_post' => FILTER_SANITIZE_ENCODED,
      'id_com' =>FILTER_SANITIZE_ENCODED
    ));
    $posts = array_map("strip_tags", $ArrayPost);
    if($posts['id_com'] == ''){
      $comObj = new Comentarios(
        $posts['id_post'],
        $posts['id_com'],
        $posts['nome'],
        $posts['email'],
        $posts['site'],
        $posts['comentario']
      );
      if($ComentarioBase->InsertComentario($comObj)){
        echo true;
      }else{
        echo false;
      }
    }
  }
?>