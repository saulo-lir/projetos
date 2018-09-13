<?php 
require '../class/Usuarios.php';

if(isset($_POST['email'])){
	$dados['nome'] = addslashes($_POST['nome']);
	$dados['email'] = addslashes($_POST['email']);
	$dados['login'] = addslashes($_POST['login']);
	$dados['senha'] = $_POST['senha'];

	$usuario = new Usuarios();

	$dados['response'] = $usuario->cadastrar($dados['nome'], $dados['email'], $dados['login'],$dados['senha']);	

	// Enviar email de confirmação
	if($dados['response']['status']){

		$assunto = "My Test: Confirmação de Cadastro";
	    $msg = "Clique no link abaixo para confirmar seu cadastro:\n\n".$dados['response']['link'];
	    $headers = "From: my_test@test.com"."\r\n"."X-Mailer: PHP/".phpversion();
	    
	    mail($dados['email'],$assunto,$msg,$headers);
	}

	echo json_encode($dados);
	
}else{
	header('Location: ../index.php');
}

