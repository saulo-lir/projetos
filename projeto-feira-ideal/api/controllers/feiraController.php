<?php

class feiraController extends controller{
  
  public function index(){}

  public function selecionarProduto(){
  	$array = [];

  	if(isset($_GET['loja']) && !empty($_GET['loja'])){

  		$loja = addslashes($_GET['loja']);
  		$codBarras = addslashes($_GET['produto']);

  		$p = new Produtos();
  		$array = $p->getProduto($loja, $codBarras);
  	}  	

  	header("Content-Type: application/json");
  	echo json_encode($array);

  	// url: http://localhost/projetos_local/projeto-feira-ideal/api/feira/selecionarProduto

  }

  public function selecionarLoja(){
    $array = [];

    if(isset($_GET['loja']) && !empty($_GET['loja'])){

      $loja = addslashes($_GET['loja']);

      $p = new Lojas();
      $array = $p->getLoja($loja);

    }

    header("Content-Type: application/json");
    echo json_encode($array);

  }

  public function salvarFeira(){
    $check;
    $registro = [];    

    if(isset($_POST['id_user']) && !empty($_POST['id_user'])){      

      $registro = [
        'id_user' => base64_decode($_POST['id_user']),
        'cnpj' => $_POST['cnpj'],
        'nome_feira' => $_POST['nome_feira'],
        'cod_barras' => $_POST['cod_barras'],
        'quantidade' => $_POST['quantidade'],
        'descricao' => $_POST['descricao'],
        'ult_registro' => $_POST['ult_registro'],
        'preco' => $_POST['preco']
      ];       
                
      $p = new Produtos();
      $check = $p->registrarPesquisa($registro);

    }    

    header("Content-Type: application/json");
    echo json_encode($check);
  }

}
