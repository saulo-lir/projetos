<?php

$config = array();

$config['dbname'] = 'feira_ideal';
$config['host'] = 'localhost';
$config['charset'] = 'utf8';
$config['dbuser'] = 'root';
$config['dbpass'] = '';

try{
  $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'].
  ";charset=".$config['charset'],$config['dbuser'],$config['dbpass']);

}catch(PDOException $ex){
  echo 'Erro de conexão: '.$ex->getMessage();
  exit;
}
