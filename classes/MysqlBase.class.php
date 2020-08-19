<?php
  require 'Database.interface.php';

  class MysqlBase implements Database{
    private $host;
    private $user;
    private $pass;
    private $db;
    private $base;

    /**
     * Class constructor.
     */
    public function __construct($host, $user, $pass, $db)
    {
      $this->host = $host;
      $this->user = $user;
      $this->pass = $pass;
      $this->db = $db;
      $this->open();
    }

    public function open(){
      $dsn = sprintf('mysql:host=%s;dbname=%s', $this->host, $this->db);
      $this->base = new PDO($dsn, $this->user, $this->pass);
    }

    public function close(){
      $this->base = null;
    }

    public function execute($strSql){
      $stmt = $this->base->prepare($strSql);
      $stmt->execute();
      return $stmt;
    }
  }