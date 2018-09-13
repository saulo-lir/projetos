<?php

class usuariosController extends controller{
  
  public function index(){}

  public function login(){
  	$array = [];

    if(isset($_POST['dados']) && !empty($_POST['dados'])){

      $dados = $this->unserializeForm($_POST['dados']);

      $u = new Usuarios();
      $array = $u->getUsuario(addslashes($dados['usuario']), addslashes($dados['senha']));

      if($array){
        $_SESSION['login'] = $array['id'];        
        $array = true;
      }

    }   

  	header("Content-Type: application/json");
  	echo json_encode($array);

  	// url: http://localhost/projeto-feira-ideal/api/usuarios/login

  } 

  public function unserializeForm($str) {

    $returndata = array();
    $strArray = explode("&", $str);
    $i = 0;

    foreach ($strArray as $item) {
        $array = explode("=", $item);
        $returndata[$array[0]] = $array[1];
    }

     return $returndata;

  }

}
