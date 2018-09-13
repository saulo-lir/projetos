<?php 
require '../class/Usuarios.php';

$h = $_GET['h'];

if(isset($_GET['h']) && !empty($_GET['h'])){
    
	$usuario = new Usuarios();

	$check = $usuario->ativarUsuario($_GET['h']);

	if($check){
		header('Location: congratulations.php');		
	
	}else{
		header('Location: ../index.php');		
	}

}else{
	header('Location: ../index.php');
}
