
<?php 
	require 'menu/side_bar.php';
	$idUser = base64_encode($_SESSION['login']);		
?>

<div class='topo' style='background-image: url(<?= BASE_URL ?>assets/img/topo.jpg)'>
	<div class='container-fluid'>
		<div class='row'>

			<div class='col-md-3 menu'>
				<button class='btn btn-default btn-circle' onclick="openNav()" title='Menu'><i class="fas fa-list-ul"></i></button>
			</div>

			<div class='col-md-4 col-md-offset-1'>

				<div class='logo'>
					<img src="<?=BASE_URL?>assets/img/logo.png" width="90px" height="50px"/>
				</div>	


				<div class='estabelecimentos-list'>
					<p id="alert-select">Campo Obrigatório!</p>
					<select id='estabelecimento' class='form-control'>
						<option>ESCOLHA UM ESTABELECIMENTO:</option>

						<?php 
							foreach($estabelecimentos as $loja){ 
								if($loja['ativo'] == 1){
						?>

							<option value='<?= $loja['cnpj'] ?>'><?= ($loja['nome_fantasia'])?''.$loja['nome_fantasia'].'':''.$loja['razao_social'].''; ?></option>

						<?php 

								}	
							} 

						?>	

					</select>
				</div>

			</div>	

		</div>

		<div class='row detalhes-style'>
			<div class='col-md-12'>
				
				<div id="detalhes-loja">
					
				</div>	

				<?php require 'modal/mapa_loja.php'; ?>			

			</div>
		</div>		

	</div>
</div>

<div class='content'>
	<div class='container-fluid'>	

		<div class='row titulos'>
			<div class='col-md-5 titulo-1'>
				<div class='text-center'>
					<h4>PRODUTOS <i class="fas fa-cart-plus"></i></h4>
				</div>
			</div>
			<div class='col-md-7'>
				<div class='text-center'>
					<h4>DETALHES <i class="fas fa-clipboard-list"></i></h4>
				</div>
			</div>
		</div>


		<div class='row'>			
			
			<div class='col-md-5 produto-lista'>
				
				<div id='lista-produtos' style="margin-top: 65px">					
					
				</div>
		
			</div>

			<div class='col-md-7 produto-detalhes'>				

				<div id='detalhes-produtos' style="margin-top: 20px">					
				<div class="table-responsive">	
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Quant.</th>								
								<th>Nome</th>
								<th>Último Registro</th>	
								<th>Preço</th>								
							</tr>							
						</thead>							
						<tbody id="descricao">
														
						</tbody>
					</table>
				</div>	

					
				</div>
				
			</div>									

		</div>		
	</div>
</div>

<div class='painel-calculo'>
	<div class='container-fluid'>
		<div class='row'>			

			<div class='col-md-3'>
				
				<button class='btn btn-lg btn-primary' onclick="calcularFeira()" id='btn-calcular'>Calcular Feira <i style='margin-left:10px' class="fas fa-calculator"></i></button>

			</div>

			<div class='col-md-6 text-center total'>
				<p>Total: R$<span id='valor-total'>0,00</span></p>
			</div>					

			<div class='col-md-3 actions'>

				<a href='javascript:void(0);' onclick='salvarFeira(<?='"'.$idUser.'"'?>);' id='salvar-feira' title='Salvar Feira Ideal'>
					<i class="fas fa-save"></i>
				</a>
				
				<a href='javascript:void(0);' id='imprimir-feira' title='Imprimir Feira Ideal'>
					<i class="fas fa-print"></i>
				</a>				

			</div>						

		</div>
	</div>
</div>

<!-- Modal para salvar o nome da feira -->

<div id="dialog-confirm" title="Digite um Nome para essa Feira:"> 

  <input type="text" id="nome-feira" class="form-control" placeholder="Ex.: Feira Janeiro">

</div>