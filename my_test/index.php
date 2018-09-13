<?php

session_start();
require 'config.php';
require 'template/header.php';

?>

<div class='container-fluid'>
	<div class='main-form'>

		<div class='row' id='main-container'>

			<div class='col-md-12 text-center'>
				<h2>Bem vindo(a) ao <strong>My Test</strong></h2>
				<br/>
			</div>			

			<div class='col-md-6 login-form'>

				<div id='alert-userpass'></div>
				
				<h3>Entrar <i class='fas fa-sign-in-alt'></i></h3>

				<small>Se você já possui cadastro, então faça o login abaixo:</small>

				<br/><br/>

				<form method='POST' id='login'>
					
					<div class='form-group'>
						<input type='text' name='login' class='form-control' placeholder='Login:' id='username' required>

						<div id='alert-login'></div>
					</div>

					<div class='form-group'>
						<input type='password' name='senha' class='form-control' placeholder='Senha:' id='senha' required>

						<div id='alert-senha'></div>
					</div>

					<input type='submit' value='Entrar' class='btn btn-lg btn-default' id='btn-entrar'>

				</form>

			</div>

			<div class='col-md-6'>
				
				<h3>Cadastre-se <i class='fas fa-check'></i></h3>

				<small>Se você ainda não é cadastrado, preencha o formulário e cadastre-se:</small>

				<br/><br/>

				<form method='POST' id='cadastro'>
					
					<div class='form-group'>
						<input type='text' name='nome' class='form-control' placeholder='Nome completo:' id='nome' required>

						<div id='aviso-nome'></div>
					</div>

					<div class='form-group'>
						<input type='email' name='email' class='form-control' placeholder='Email:' id='email' required>

						<div id='aviso-email'></div>
					</div>

					<div class='form-group'>
						<input type='text' name='login' class='form-control' placeholder='Login:' id='login-cadastro' required>

						<div id='aviso-login'></div>
					</div>

					<div class='form-group'>
						<input type='password' name='senha' class='form-control' placeholder='Senha:' id='senha-cadastro' required>

						<div id='aviso-senha'></div>
					</div>

					<input type='submit' value='Cadastrar' class='btn btn-lg btn-info' id='btn-cadastrar'>

				</form>

			</div>

		</div>			
		
	</div>
</div>


<?php
require 'template/footer.php';
?>

