<?php
require '../class/Usuarios.php';

if(isset($_FILES['foto']) && !empty($_FILES['foto'])){

	$arquivo = $_FILES['foto'];
	$idUser = $_SESSION['login'];

	$usuario = new Usuarios();
	$response = $usuario->updateFoto($arquivo, $idUser);
	
	if($response){
		echo json_encode($response);
	}	

}elseif(isset($_POST['senha']) && !empty($_POST['senha'])){

	$senha = $_POST['senha'];
	$idUser = $_SESSION['login'];

	$usuario = new Usuarios();
	$response = $usuario->updatePerfil($idUser, $senha);

	if($response){
		echo json_encode($response);
	}	

}else{
	header('Location: ../index.php');
}
