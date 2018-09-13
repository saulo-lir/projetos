<style>
	body{
		background-image:url('http://localhost/projeto-feira-ideal/site/assets/img/background.jpg');
		background-size: cover;
	}
</style>

<div class='container'>
	<div class='login-form'>

		<div class='row'>
			<div class='col-md-12'>
				<h4>Logo</h4>
			</div>
		</div>

		<div class='row' style='margin-top: 60px'>
			<div class='col-md-12'>
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