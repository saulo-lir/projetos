<?php
require '../class/Usuarios.php';

if(isset($_SESSION['login'])){

	$usuario = new Usuarios();

	$dados['perfil'] = $usuario->getUsuario($_SESSION['login']);
	$dados['foto'] = $usuario->getFotoPeril($_SESSION['login']);

	echo json_encode($dados);

}else{
	header('Location: ../index.php');
}