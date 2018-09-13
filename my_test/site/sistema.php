<?php 
session_start();

if(empty($_SESSION['login'])){

?>

<script> window.location.href = 'https://beta.saulo.bonom.com.br/webroot/my_test/index.php'; </script>

<?php 

}else{
	require '../config.php';
	require '../template/header.php';		
}
?>


<div class='navbar navbar-inverse'>
    <div class='container'>       
        <ul class='nav navbar-nav navbar-right'>          
          <li><a href='sair.php'>Sair <i class="fas fa-sign-out-alt"></i></a></li>
        </ul>
    </div>
</div>

<div class='container'>
	<div class='system-container'>
		<div class='row'>
			
			<div class="col-md-3 col-md-offset-1">
			    <div class="thumbnail">
			      <img src="../assets/img/spinner.gif" id='perfil-avatar'>
			      <div class="caption">

			      	<form id='form-foto' method='POST' enctype='multipart/form-data'>
				      	<label class='btn btn-info' for='update-foto'>Atualizar Foto</label>
				        <input type='file' name='foto' id='update-foto' onchange='uploadFoto()'/>
				        <input type='submit' id='btn-submit' value='Enviar' class='btn btn-default' onclick='atualizarFoto()'/>
				    </form>    

			      </div>
			    </div>
			 </div>

			<div class='col-md-8'>
				<div class="panel panel-info">				  
				  <div class="panel-body">				   

				  	<div id='info-perfil'>
				  		<img src="../assets/img/spinner.gif" id='perfil-avatar'>
				  	</div>

				  	<div id='form-perfil' class='text-center'>

				  		<div id='alert-update'></div>

					  	<form class='form-inline' method='POST' id='form-update'>

							<div class='form-group'>
								<input type='password' name='email' class='form-control' placeholder='Senha' id='senha-update' required>
							</div>

							<input type='submit' value='Atualizar Senha' class='btn btn-info' id='btn-atualizar'>
					  	</form>
				  	</div>

				  </div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php 
	require '../template/footer.php';
?>	

<script type='text/javascript' src='<?= BASE_URL ?>assets/js/perfil.js'></script>

