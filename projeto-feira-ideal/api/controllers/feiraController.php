<?php

class feiraController extends controller{
  
  public function index(){}

  public function selecionarProduto(){
  	$array = [];

  	if(isset($_GET['loja']) && !empty($_GET['loja'])){

  		$loja = $_GET['loja'];
  		$codBarras = $_GET['produto'];

  		$p = new Produtos();
  		$array = $p->getProduto($loja, $codBarras);
  	}  	

  	header("Content-Type: application/json");
  	echo json_encode($array);

  	// url: http://localhost/projeto-feira-ideal/api/feira/selecionarProduto

  }

  public function selecionarLoja(){
    $array = [];

    if(isset($_GET['loja']) && !empty($_GET['loja'])){

      $loja = $_GET['loja'];

      $p = new Lojas();
      $array = $p->getLoja($loja);

    }

    header("Content-Type: application/json");
    echo json_encode($array);

  }

}
