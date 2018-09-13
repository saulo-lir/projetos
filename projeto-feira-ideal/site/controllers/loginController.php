<?php

class loginController extends controller{
  
  public function index(){
    $dados = array();    

    $this->loadTemplate('login', $dados);
  }

}
