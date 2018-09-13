<?php
require 'environment.php'; 
$config = array();

if(ENVIRONMENT == 'development'){
  define('BASE_URL', 'http://localhost/samu-informatica/site/');
  $config['dbname'] = 'samu_informatica';
  $config['host'] = 'localhost';
  $config['charset'] = 'utf8';
  $config['dbuser'] = 'root';
  $config['dbpass'] = '';
}else{
  define('BASE_URL', '');
  $config['dbname'] = '';
  $config['host'] = '';
  $config['dbuser'] = '';
  $config['dbpass'] = '';
}

global $db;

try{
  $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'].
  ";charset=".$config['charset'],$config['dbuser'],$config['dbpass']);

}catch(PDOException $ex){
  echo 'Erro de conexão: '.$ex->getMessage();
  exit;
}
