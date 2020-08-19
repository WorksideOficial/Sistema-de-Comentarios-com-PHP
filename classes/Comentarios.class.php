<?php
class Comentarios{
  private $idpost, $idcom, $nome, $email, $site, $comentario;

  public function __construct($idpost, $idcom, $nome, $site, $email, $comentario){
    $this->idpost = htmlentities(strip_tags($idpost), ENT_QUOTES);
    $this->idcom = htmlentities(strip_tags($idcom), ENT_QUOTES);
    $this->nome = htmlentities(strip_tags($nome), ENT_QUOTES);
    $this->email = htmlentities(strip_tags($email), ENT_QUOTES);
    $this->site = htmlentities(strip_tags($site), ENT_QUOTES);
    $this->comentario = htmlentities(strip_tags($comentario), ENT_QUOTES);
    
  }

  public function getIdPost(){
    return $this->idpost;
  }

  public function getIdCom(){
    return $this->idcom;
  }

  public function getNome(){
    return $this->nome;
  }

  public function getEmail(){
    return $this->email;
  }

  public function getSite(){
    return $this->site;
  }

  public function getComentario(){
    return $this->comentario;
  }
}