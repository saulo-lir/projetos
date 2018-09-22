<style>
	body{
		background-image:url('http://localhost/projetos_local/projeto-feira-ideal/site/assets/img/background.jpg');
		background-size: cover;
	}
</style>

<div class='container'>
	<div class='login-form'>

		<div class='row'>
			<div class='col-md-12 text-center'>
				<img src="<?=BASE_URL?>assets/img/logo.png" width="130px" height="70px" title="Feira Ideal"/>
			</div>
		</div>

		<div class='row' style="margin-top: 50px">
			<div class='col-md-12'>

				<div id="alert-login"></div>

				<form id='login' type='POST'>

					<div class='form-group'>
						<label for='usuario'>Usuário: <span>teste</span></label>
						<input type='text' name='usuario' id='usuario' class='form-control' required/>	
					</div>

					<div class='form-group'>
						<label for='senha'>Senha: <span>teste</span></label>
						<input type='password' name='senha' id='senha' class='form-control' required/>
					</div>

					<div class='form-group' style='margin-top: 40px'>						
						<button type='submit' class='btn btn-lg btn-info' id='btn-entrar'>Entrar <i class="fas fa-sign-in-alt"></i></button>
					</div>

				</form>
			</div>
		</div>
		
	</div>	
</div>