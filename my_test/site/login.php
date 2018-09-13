<?php 
require '../class/Usuarios.php';

if(isset($_POST['login'])){	
	$dados['login'] = addslashes($_POST['login']);
	$dados['senha'] = $_POST['senha'];

	$usuario = new Usuarios();

	$dados['response'] = $usuario->login($dados['login'],$dados['senha']);		

	echo json_encode($dados);	
	
}else{
	header('Location: ../index.php');	
}