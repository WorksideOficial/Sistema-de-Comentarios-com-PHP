<?php
interface Database{
  public function execute($strSQL);
  public function open();
  public function close();
}