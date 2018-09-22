<?php

class homeController extends controller{
  
  public function index(){

  	if(empty($_SESSION['login'])){

  		header('Location: http://localhost/projetos_local/projeto-feira-ideal/site/');
  		exit;
  	}  	

    $dados = array();

    $lojas = new Lojas();

    $dados['estabelecimentos'] = $lojas->getLojas();

    $this->loadTemplate('home', $dados);
  }

  public function logout(){

    unset($_SESSION['login']);
    header('Location: http://localhost/projetos_local/projeto-feira-ideal/site');
    exit;
  }

}
